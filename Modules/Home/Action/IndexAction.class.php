<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends BaseAction {

	private function appendUserInfo(&$posts) {
		foreach ($posts as &$p) {
			$p['user'] = MongoFactory::table("user")->findOne(['_id'=>new MongoId($p['uid'])], ['nickname', 'avatar']);
		}
	}

    public function index(){

        $uid = $this->getUid();
        if($uid) {
            $this->notify($uid);
        }

		$eid = "0"; //综合讨论组的活动号
		// 首页增加帖子
		$rt = MongoFactory::table("discuss_post")->find(['eid'=>$eid,])->sort(["time"=>-1])->limit(4);
		$posts = MongoUtil::asList($rt);
		$this->appendUserInfo($posts);
		$event = [];
		$event['title'] = "吃喝玩乐综合讨论区";

		$query = [
			'avatar'=>['$ne'=>"", '$exists'=>true],
		];
		// 匹配相反性别的用户
		if (isset($_COOKIE['gender'])) {
			$query['gender'] = $_COOKIE['gender'] == '2' ? '1' : '2';
		}
		$query['birthday'] = ['$ne'=>"", '$exists'=>true];
		$query['height'] = ['$ne'=>"", '$exists'=>true];
		$query['robot'] = ['$ne'=>"1", '$exists'=>false];
		$query['password'] = ['$ne'=>"", '$exists'=>true];
		// 首页推荐一些最新用户
		$rt = MongoFactory::table("user")->find($query)->sort(['login_time'=>-1]);
		$users = MongoUtil::asList($rt);
		shuffle($users);
        // 首页最新注册用户
        $new = UserModel::getNewUsers(6);
		$this->assign([
			"login"=>isset($_SESSION['login']),
			"users"=>array_slice($users, 0, 6),
			"posts"=>$posts,
			"event"=>$event,
            "new"  => $new,
			"cur_home"=>"1"
		]);
        $this->display();
    }

	/**
	 * 申请推送到微信公众平台
	 */
	public function push() {
		$this->display();
	}

	/**
	 * 游戏排行
	 */
	public function top() {
		$redis = new Redis();
		$redis->connect("localhost");
		if (isset($_REQUEST['sc']) && $this->getUid()) {
			$userScore = $redis->hGet("game_top", $this->getUid());
			if ($userScore < $_REQUEST['sc']) {
				$redis->hSet("game_top", $this->getUid(), $_REQUEST['sc']);
			}
		}
		$userIds = $redis->hGetAll("game_top");
		uasort($userIds, function($a, $b) {
			return $a < $b;
		});
		$userIds = array_slice($userIds, 0, 10);
		$query = [];
		foreach ($userIds as $id=>$score) {
			$query[] = new MongoId($id);
		}
		$rt = MongoFactory::table("user")->find(["_id"=>['$in'=>$query]], ['_id', 'avatar', 'gender', 'nickname']);
		$users = MongoUtil::asList($rt);
		foreach ($users as &$u) {
			$u['score'] = $userIds[(string)$u['_id']];
		}
		uasort($users, function($a, $b) {
			return $a['score'] < $b['score'];
		});
		$this->assign("users", $users);
		$this->display();
	}
}