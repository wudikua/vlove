<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends BaseAction {

    public function index(){
		// 首页推荐一些最新用户
		$rt = MongoFactory::table("user")->find([
			'avatar'=>['$ne'=>""]
		])->sort(['login_time'=>1])->limit(10);
		$users = MongoUtil::asList($rt);
		$users = array_merge($users, $users);
		$users = array_merge($users, $users);
		$users = array_merge($users, $users);
		$this->assign([
			"login"=>isset($_SESSION['login']),
			"users"=>array_slice($users, 0, 6)
		]);
        $this->display();
    }
}