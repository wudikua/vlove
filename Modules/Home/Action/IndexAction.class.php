<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends BaseAction {

	private function appendUserInfo(&$posts) {
		foreach ($posts as &$p) {
			$p['user'] = MongoFactory::table("user")->findOne(['_id'=>new MongoId($p['uid'])], ['nickname', 'avatar']);
		}
	}

    public function index(){
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
		// 首页推荐一些最新用户
		$rt = MongoFactory::table("user")->find($query)->sort(['login_time'=>1])->limit(10);
		$users = MongoUtil::asList($rt);

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
}