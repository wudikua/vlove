<?php
class ProfileAction extends UserLoginAction {

	private function updateField($fields) {
		$update = [];
		foreach ($fields as $f) {
			$update[$f] = $this->_post($f);
		}
		$rt = MongoFactory::table("user")->update(['_id'=>new MongoId($this->userId)],
			['$set'=> $update]
		);
		$this->jump(U("Profile/index"), "修改成功");
	}

	/**
	 * 修改详细资料
	 */
	public function detail() {
		if($this->ispost()) {
			$fields = [
				'hometown1', 'hometown2',
				'birthhometown1', 'birthhometown2',
				'housing', 'caring', 'tophome',
				'national', 'cnage'//属相
			];
			$this->updateField($fields);
			die;
		}
		$this->assign([
			'user'=>$this->getLoginUser(),
			"cur_user"=>"1"
		]);
		$this->display();
	}

	/**
	 * 修改基本资料
	 */
	public function base() {
		if($this->ispost()) {
			$fields = [
				'nickname',
				'marrystatus', 'lovesort', 'birthday', 'height', 'weight',
				'education', 'school',
				'dist1', 'dist2', 'dist3',
				'salary', 'job', 'company', 'industry',
			];
			$this->updateField($fields);
			die;
		}
		$this->assign([
			'user'=>$this->getLoginUser(),
			"cur_user"=>"1"
		]);
		$this->display();
	}

	/**
	 * 修改个人独白
	 */
	public function content() {
		if($this->ispost()) {
			$fields = [
				'content',
			];
			$update = [];
			foreach ($fields as $f) {
				$update[$f] = $this->_post($f);
			}
			$this->updateField($fields);
			die;
		}
		$this->assign([
			'user'=>$this->getLoginUser(),
		]);
		$this->display();
	}

	/**
	 * 修改联系方式
	 */
	public function contact() {
		if($this->ispost()) {
			$fields = [
				'mobile', 'qq', 'wechat',
			];
			$this->updateField($fields);
			die;
		}
		$this->assign([
			'user'=>$this->getLoginUser(),
			"cur_user"=>"1"
		]);
		$this->display();
	}

	/**
	 * 修改择偶要求
	 */
	public function req() {
		if($this->ispost()) {
			$fields = [
				'req_age_gt', 'req_age_lt', 'req_height',
				'req_salary', 'req_education'
			];
			$this->updateField($fields);
			die;
		}
		$this->assign([
			'user'=>$this->getLoginUser(),
			"cur_user"=>"1"
		]);
		$this->display();
	}

	public function changepwd() {
		if($this->ispost()) {
			$newpassword = $this->_post("newpassword");
			$oldpassword = $this->_post("oldpassword");
			$confirmpassword = $this->_post("confirmpassword");
			if ($newpassword != $confirmpassword) {
				$this->ajaxReturn([
					"response"=>0,
					"result"=>"新密码不一致",
				]);
			}
			$update["password"] = $newpassword;
			$rt = MongoFactory::table("user")->update(
				[
					'_id'=>new MongoId($this->userId),
					'password'=>$oldpassword,
				],
				['$set'=> $update]
			);
			if (!$rt['updatedExisting'] && $oldpassword != $newpassword) {
				$this->ajaxReturn([
					"response"=>0,
					"result"=>"原密码错误",
				]);
			}
			$this->ajaxReturn([
				"response"=>1,
				"result"=>"",
			]);
		}
		$this->assign([
			"cur_user"=>"1"
		]);
		$this->display();
	}

	public function logout() {
		$this->removeLoginStatus($this->userId);
		$this->jump("Login/index", "退成成功");
	}

	public function index() {
		$this->assign([
			"cur_user"=>"1"
		]);
		$this->display();
	}

	public function other() {
		$uid   = $this->_get("uid");

        //增加最近访客
        if($this->userId != $uid) {
            UserNotifyModel::addVisitor($uid, $this->userId);
        }
		$this->assign([
			"user"     => MongoFactory::table("user")->findOne(["_id"=>new MongoId($uid)]),
            "username" => $this->nickName,
            "atten"    => AttenModel::isAtten($this->userId, $uid)
		]);
		$this->display();
	}

	public function push() {
		$redis = new Redis();
		$redis->connect('localhost');
		$redis->zAdd("wx_push_list", time(), $this->userId);
		$redis->hSet("user_push_requirement", $this->userId, $this->_post('content'));
		$this->jump(U("Home/Index/index"), "您的申请已经收到，我们确认后会进行推送", 3000);
	}
}