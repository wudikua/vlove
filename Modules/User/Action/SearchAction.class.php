<?php
class SearchAction extends UserLoginAction {

	private function updateField($fields) {
		$update = [];
		foreach ($fields as $f) {
			$update[$f] = $this->_post($f);
		}
		MongoFactory::table("user")->update(['_id'=>new MongoId($this->userId)],
			['$set'=> $update]
		);
	}

	public function filter() {
		if ($this->ispost()) {
			$fields = [
				's_dist1', 's_dist2', 's_dist3',
				's_avatar',
				's_age_gt', 's_age_lt',
				's_height', 's_education',
				// 高级选项
				's_salary', 's_housing', 's_caring'
			];
			$this->updateField($fields);
		}
		$this->assign(
			['user'=>$this->getLoginUser()]
		);
		$this->display();
	}

	public function index() {

	}

}