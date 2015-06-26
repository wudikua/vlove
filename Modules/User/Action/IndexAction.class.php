<?php
class IndexAction extends UserLoginAction {

	public function index() {
		$this->assign([
			'user'=>$this->getLoginUser(),
			"cur_user"=>"1"
		]);
		$this->display();
	}

}