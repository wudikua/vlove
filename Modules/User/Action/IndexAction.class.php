<?php
class IndexAction extends UserLoginAction {

	public function index() {
		$this->assign([
			'user'=>$this->getLoginUser(),
		]);
		$this->display();
	}

}