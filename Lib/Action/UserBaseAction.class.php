<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/15
 * Time: 12:39
 */
class UserBaseAction extends BaseAction {

    public function _initialize() {

    }

	public function setLoginSid($id) {
		$g = new Guid();
		$sid = $g->toString();
		MongoFactory::table("user")->update(['_id'=> new MongoId($id)],
			['$set'=> ['sid'=>$sid]]);
		setcookie('sid', $sid, time() + 3600*24*7, "/");
		return $sid;
	}

	public function setLoginGender($gender) {
		setcookie('gender', $gender, time() + 3600*24*7, "/");
	}

	public function removeLoginStatus($id) {
		MongoFactory::table("user")->update(['_id'=> new MongoId($id)], ['$unset'=> ['sid'=>1]]);
		setcookie('sid', "", -1, "/");
		setcookie('gender', "", -1, "/");
		session_destroy();
	}

	public function jump($url, $msg, $timeout=1500) {
		$this->assign([
			'msg'=>$msg,
			'jumpUrl'=>$url,
			'timeout'=>$timeout,
		]);
		$this->display("./Tpl/Public/jump.php");
		die;
	}
}