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

	/**
	 * @var array 登录用户的mongo返回对象
	 */
	private $loginUser;

    public function _initialize() {
		parent::_initialize();
		if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
			$this->userId = $_SESSION['login'];
		} else {
			$u = MongoFactory::table("user")->findOne(['sid'=>(string)$_COOKIE['sid']], ['_id']);
			if (!isset($u['_id'])) {
				$this->jump(U('User/Login/index'), "请先登录");
			}
			$this->userId = (string) $u['_id'];
			if (strlen($this->userId) == 0) {
				$this->jump(U('User/Login/index'), "请先登录");
			}
			// 写临时登录态 更新登录时间
			MongoFactory::table("user")->update(['_id'=> new MongoId($this->userId)],
				['$set'=> ['login_time'=>time()]]);
			$_SESSION['login'] = $this->userId;
		}

		$this->assign("login", true);
    }

	/**
	 * 获取登录用户的详细信息
	 */
	public function getLoginUser() {
		if (!isset($this->loginUser)) {
			$this->loginUser = MongoFactory::table("user")->findOne(['_id'=>new MongoId($this->userId)]);
		}
		return $this->loginUser;
	}

	/**
	 * 判断会员是否是VIP
	 */
	public function isVip() {
		return true;
	}
}