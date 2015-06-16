<?php
class ProfileAction extends UserLoginAction {

	private function editBase() {
		$fields = [
			'marrystatus', 'lovesort', 'birthday', 'height', 'weight',
			'education', 'school',
			'dist1', 'dist2', 'dist3',
			'salary', 'job', 'company', 'industry',
		];
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

	private function editDetail() {
		$fields = [
			'hometown1', 'hometown2',
			'national', 'housing', 'caring',
		];
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

	public function detail() {
		if($this->ispost()) {
			$this->editDetail();
			die;
		}
		$this->assign([
			'user'=>$this->getLoginUser(),
		]);
		$this->display();
	}


	public function base() {
		if($this->ispost()) {
			$this->editBase();
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