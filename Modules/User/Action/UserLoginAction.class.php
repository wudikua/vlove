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
		$this->userId = "557f8ae5a1a1a1ba038b456d";
    }

	/**
	 * 获取登录用户的详细信息
	 */
	public function getLoginUser() {
		return MongoFactory::table("user")->findOne(['_id'=>new MongoId($this->userId)]);
	}
}