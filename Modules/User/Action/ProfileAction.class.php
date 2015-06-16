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
		$this->assign([
			'jumpUrl'=>U("Profile/index")
		]);
		$this->display("./Tpl/Public/jump.php");
	}

	/**
	 * 修改详细资料
	 */
	public function detail() {
		if($this->ispost()) {
			$fields = [
				'hometown1', 'hometown2',
				'housing', 'caring', 'tophome',
				'national', 'cnage'//属相
			];
			$this->updateField($fields);
			die;
		}
		$this->assign([
			'user'=>$this->getLoginUser(),
		]);
		$this->display();
	}

	/**
	 * 修改基本资料
	 */
	public function base() {
		if($this->ispost()) {
			$fields = [
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
		]);
		$this->display();
	}

	public function index() {
		$this->display();
	}

}