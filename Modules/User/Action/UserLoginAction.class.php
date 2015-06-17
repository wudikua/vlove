<?php

/**
 * 需要登录用户权限的控制器继承这个类
 * Class UserLoginAction
 */
class UserLoginAction extends UserBaseAction {

	/**
	 * @var string 已经登录用户的id
	 */
	public $userId;

    public function _initialize() {
		parent::_initialize();
		$u = MongoFactory::table("user")->findOne(['sid'=>(string)$_COOKIE['sid']], ['_id']);
		if (!isset($u['_id'])) {
			$this->jump(U('Login/index'), "请先登录");
		}
		$this->userId = (string) $u['_id'];
		if (strlen($this->userId) == 0) {
			$this->jump(U('Login/index'), "请先登录");
		}
		$this->assign("login", true);
    }

	/**
	 * 获取登录用户的详细信息
	 */
	public function getLoginUser() {
		return MongoFactory::table("user")->findOne(['_id'=>new MongoId($this->userId)]);
	}

	/**
	 * 判断会员是否是VIP
	 */
	public function isVip() {
		return true;
	}
}