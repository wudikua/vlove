<?php
class IndexAction extends EventBaseAction {

	public function add() {
		$event = [
			// 活动标题
			"title"=>"高学历专场相亲聚会",
			// 活动开始时间
			"start_time"=>time(),
			// 活动结束时间
			"end_time"=>time() + 3600*3,
			// 活动地点
			"dest"=>"北京语言大学5层食堂东区；学院路15号，地铁五道口下车，北语南门进，50米西清宴楼5层。",
			"dist1"=>"1",
			"dist2"=>"1",
			"dist3"=>"1",
			// 活动要求
			"require"=>"<p>男生40岁以下，本科学历以上，年薪10W+</p><p>女生35岁以下，颜值中等以上。</p>",
			// 活动费用
			"fee"=>"80",
			// 活动详细描述和流程
			"detail"=>"<p>1.暖场游戏</p><p>2.自我介绍</p><p>3.真情互相刨根问题</p><p>4.真诚告白</p><p>5.心动男生女生互选</p>",
			// 活动状态
			"status"=>self::$EVENT_STATUS_OPEN
		];
		MongoFactory::table("event")->insert($event);
		echo "success";
	}

	public function index() {
		import('ORG.Util.Page');
		$count = MongoFactory::table("event")->find([])->count();
		$page = new Page($count);
		$page->setConfig('prev', '<span onclick="goUrl(\'$url\');\">上一页</span>');
		$page->setConfig('next', '<span onclick="goUrl(\'$url\');\">下一页</span>');
		$page->setConfig('theme', '%first% %upPage% %linkPage% %downPage%  %end%');
		$rt = MongoFactory::table("event")->find()->sort(['begin_time'=>1])->skip($page->firstRow)->limit($page->listRows);
		$events = MongoUtil::asList($rt);
		$this->assign([
			"page"=>$page->show(),
			"events"=>$events,
			"login"=>isset($_SESSION['login']),
			"cur_event"=>"1"
		]);
		$this->display();
	}

	public function detail($eid){
		$event = MongoFactory::table("event")->findOne(["_id"=> new MongoId($eid)]);
		$rt = MongoFactory::table("event_apply")->find(["eid"=>$eid]);
		$query = [];
		// 活动所有申请的人
		$applys = MongoUtil::asMap($rt, "uid");
		if (count(array_keys($applys)) > 0) {
			foreach (array_keys($applys) as $uid) {
				$query[] = new MongoId($uid);
			}
		}
		$rt = MongoFactory::table("user")->find(["_id"=>['$in'=>$query]], ['_id', 'avatar', 'gender']);
		$userInfo = MongoUtil::asMap($rt, "_id");
		$applyFemale = [];
		$applyMale = [];
		foreach ($applys as $uid=>$apply) {
			if (!isset($userInfo[$uid])) {
				continue;
			}
			if ($userInfo[$uid]['gender'] == '1') {
				$applyMale[$uid] = [
					'avatar'=>$userInfo[$uid]['avatar']
				];
			} else {
				$applyFemale[$uid] = [
					'avatar'=>$userInfo[$uid]['avatar']
				];
			}
		}
		// 用户自己对这个活动的状态
		if (isset($applys[$this->userId])) {
			$myApplyStatus = $applys[$this->userId]['status'];
		} else {
			$myApplyStatus = '0';
		}

		$this->assign([
			"myApplyStatus"=>$myApplyStatus,
			"userId"=>$this->userId,
			"applyFemale"=>$applyFemale,
			"applyMale"=>$applyMale,
			"event"=>$event,
			"login"=>isset($_SESSION['login']),
			"cur_event"=>"1"
		]);
		$this->display();
	}

	public function apply($eid) {
		$apply = [
			'eid'=>$eid,
			'uid'=>$this->userId,
			'status'=>self::$EVENT_APPLY_WAIT,
			'time'=>time(),
		];
		MongoFactory::table("event_apply")->insert($apply);
		$this->jump("Index/detail", "申请已经收到，确保个人资料中的联系方式正确，工作人员会联系您", 1000*10);
	}
}