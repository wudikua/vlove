<?php
class SearchAction extends UserLoginAction {

	private function updateField($fields) {
		$update = [];
		foreach ($fields as $f) {
			if ($this->_post($f) == "undefined") {
				$update[$f] = "0";
			} else {
				$update[$f] = $this->_post($f);
			}
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
			$this->jump(U('Search/index'), "设置成功");
		}
		$user = $this->getLoginUser();
		// 如果在这里不是会员，高级搜索重置
		if (!$this->isVip()) {
			$user['s_salary'] = "";
			$user['s_housing'] = "";
			$user['s_caring'] = "";
		}
		$this->assign([
			'user'=>$user,
			"cur_search"=>"1"
		]);
		$this->display();
	}

	private function buildQuery($fields) {
		$query = [];
		$user = $this->getLoginUser();
		foreach ($fields as $field) {
			// 设置了这个选项，字符串大于0，并且不能是0，因为字段里不会是0，一般0是未填写或者不限
			if (isset($user[$field]) && strlen($user[$field]) > 0 && !empty($user[$field])) {
				if ($field == "s_avatar") {
					// 处理头像
					$query["avatar"]['$ne'] = "";
				} else if ($field == "s_height") {
					// 处理大于等于
					$query["height"]['$gte'] = $user[$field];
				} else if ($field == "s_age_gt") {
					// 处理范围
					$query["birthday"]['$lte'] = rage($user[$field]);
				} else if ($field == "s_age_lt") {
					// 处理范围
					$query["birthday"]['$gte'] = rage($user[$field]);
				} else if ($field == 's_salary' || $field == 's_education') {
					// 处理大于等于
					$query[substr($field, 2, strlen($field))]['$gte'] = $user[$field];
				} else {
					$query[substr($field, 2, strlen($field))] = $user[$field];
				}
			}
		}
		return $query;
	}

	public function index() {
		$fields = [
			's_dist1', 's_dist2', 's_dist3',
			's_avatar',
			's_age_gt', 's_age_lt',
			's_height', 's_education',
		];
		$query = $this->buildQuery($fields);
		$advFields = [
			// 高级选项
			's_salary', 's_housing', 's_caring'
		];
		// 判断是会员 开启高级搜索
		if ($this->isVip()) {
			$query = array_merge($query, $this->buildQuery($advFields));
		}
		// 一个基础限制是只可以query异性
		$loginUser = $this->getLoginUser();
		$query['gender'] = $loginUser['gender'] == '1' ? '2' : '1';
		// 分页展示
		import('ORG.Util.Page');
		$count = MongoFactory::table("user")->find($query)->count();
		$page = new Page($count);
		$page->setConfig('prev', '<span onclick="goUrl(\'$url\');\">上一页</span>');
		$page->setConfig('next', '<span onclick="goUrl(\'$url\');\">下一页</span>');
		$page->setConfig('theme', '%first% %upPage% %downPage%');
		$rt = MongoFactory::table("user")->find($query)->skip(intval($page->firstRow))->limit(intval($page->listRows));
		$users = MongoUtil::asList($rt);
		$this->assign([
			'page'=>$page->show(),
			'users'=>$users,
			"cur_search"=>"1"
		]);
		$this->display();
	}

}