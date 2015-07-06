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

    public $userName;
    public $nickName;

	/**
	 * @var array 登录用户的mongo返回对象
	 */
	private $loginUser;

    public function _initialize() {
		parent::_initialize();
		if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
			$this->userId = $_SESSION['login'];
            $this->nickName = $_SESSION['nickname'];
		} else {
			// 自己平台的sid登录
			$u = MongoFactory::table("user")->findOne(['sid'=>(string)$_COOKIE['sid']], ['_id', 'nickname' ,'username']);
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
            $_SESSION['nickname'] = $u['nickname'] ? $u['nickname'] : $u['username'];
            $this->nickName = $_SESSION['nickname'];
		}

		if ($this->getActionName() != "Bind") {
			$this->loginUser = $this->getLoginUser();
			if (!isset($this->loginUser['password'])) {
				$this->jump(U("User/Bind/index"), "我们检测到您是微信用户，需要绑定账号", 3000);
			}
			if (isset($this->loginUser['wgateid']) && $this->loginUser['wgateid'] == $this->loginUser['username']) {
				$this->jump(U("User/Bind/index"), "我们检测到您是微信用户，需要绑定账号", 3000);
			}
			if (!$this->isFull($this->loginUser)) {
				$this->jump(U("User/Bind/base"), "我们检测到您的资料不完整，需要完善交友资料", 3000);
			}
		}

        // 是否有新的关注和msg
        $this->assign("new_msg", UserNotifyModel::isNewMsg($this->userId));
        $this->assign("new_atten", UserNotifyModel::isNewAtten($this->userId));

		$this->assign("login", true);
    }

	/**
	 * 资料是否完整
	 */
	private function isFull($user) {
		if (!isset($user['education']) || strlen($user['education']) == 0) {
			return false;
		}
		if (!isset($user['marrystatus']) || strlen($user['marrystatus']) == 0) {
			return false;
		}
		if (!isset($user['birthday']) || strlen($user['birthday']) == 0) {
			return false;
		}
		if (!isset($user['job']) || strlen($user['job']) == 0) {
			return false;
		}
		if (!isset($user['height']) || strlen($user['height']) == 0) {
			return false;
		}
		if (!isset($user['dist1']) || strlen($user['dist1']) == 0) {
			return false;
		}
		return true;
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


    /**
     * @brief 通过用户id查询 用户相信信息
     * @param $data
     * @return mixed
     */
    public function getUserInfo($data) {
        $userIds = [];
        foreach($data as $value) {
            array_push($userIds, $value['userid']);
        }
        if($userIds) {
            $usersInfo = UserModel::getUserByIds($userIds, ['username', 'marrystatus' ,
                'birthday' , 'dist1' ,'dist2' ,'dist3', 'avatar', 'gender', 'education']);
            $usersInfo = MongoUtil::asMap($usersInfo, '_id');
            foreach($data as &$msg) {
                $info = $usersInfo[$msg['userid']];
                $msg['fromuser'] = $info;
                $msg['fromuser']['city'] = ProvinceData::$data[$info['dist1']]['city'][$info['dist2']]['city_name'];
                $msg['fromuser']['area'] = ProvinceData::$data[$info['dist1']]['city'][$info['dist2']]['area'][$info['dist3']];
            }
        }
        return $data;
    }
}