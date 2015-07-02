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