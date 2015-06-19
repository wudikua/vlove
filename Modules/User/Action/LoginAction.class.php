<?php
class LoginAction extends UserBaseAction {

	public function index() {
		if($this->ispost()) {
			$rt = MongoFactory::table("user")->findOne([
				'$or'=>[
					['username' => $this->_post("loginname")],
					['email' => $this->_post('loginname')]
				],
				'$and'=>[
					['password' => $this->_post('password')],

				]
			]);
			if (!$rt) {
				$this->jump(U("Login/index"), "用户名或密码错误");
			}
			// 写登录cookie
			$this->setLoginSid((string)$rt['_id']);

			$this->jump(U("Index/index"), "登录成功");
		}
		$this->assign([
			"cur_user"=>"1"
		]);
		$this->display();
	}

}