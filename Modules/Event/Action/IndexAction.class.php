<?php
class IndexAction extends UserLoginAction {
	public function index(){
		$this->assign([
			"login"=>isset($_SESSION['login']),
			"cur_event"=>"1"
		]);
		$this->display();
	}
}