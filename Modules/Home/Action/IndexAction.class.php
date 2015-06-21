<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends BaseAction {

    public function index(){
		$query = [
			'avatar'=>['$ne'=>""],
		];
		// 匹配相反性别的用户
		if (isset($_COOKIE['gender'])) {
			$query['gender'] = $_COOKIE['gender'] == '2' ? '1' : '2';
		}
		// 首页推荐一些最新用户
		$rt = MongoFactory::table("user")->find($query)->sort(['login_time'=>1])->limit(10);
		$users = MongoUtil::asList($rt);
		$users = array_merge($users, $users);
		$users = array_merge($users, $users);
		$users = array_merge($users, $users);
		$this->assign([
			"login"=>isset($_SESSION['login']),
			"users"=>array_slice($users, 0, 6),
			"cur_home"=>"1"
		]);
        $this->display();
    }
}