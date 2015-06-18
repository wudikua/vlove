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
			$this->jump(U('Search/index'), "设置成功");
		}
		$user = $this->getLoginUser();
		// 如果在这里不是会员，高级搜索重置
		if (!$this->isVip()) {
			$user['s_salary'] = "";
			$user['s_housing'] = "";
			$user['s_caring'] = "";
		}
		$this->assign(
			['user'=>$user]
		);
		$this->display();
	}

	private function buildQuery($fields) {
		$query = [];
		$user = $this->getLoginUser();
		foreach ($fields as $field) {
			if (isset($user[$field]) && strlen($user[$field]) > 0) {
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
				} else if ($field == 's_salary') {
					// 处理大于等于
					$query["salary"]['$gte'] = $user[$field];
				} else {
					$query[strstr($field, "s_")] = $user[$field];
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
		import('ORG.Util.Page');
		$count = MongoFactory::table("user")->find($query)->count();
		$page = new Page($count);
//		'prev'=>'< <','next'=>'> >','first'=>'首页','last'=>'尾页','theme'=>'%first% %upPage% %linkPage% %downPage%  %end%'
		$page->setConfig('prev', '<span onclick="goUrl(\'$url\');\">上一页</span>');
		$page->setConfig('next', '<span onclick="goUrl(\'$url\');\">下一页</span>');
		$page->setConfig('theme', '%first% %upPage% %linkPage% %downPage%  %end%');
		$rt = MongoFactory::table("user")->find($query)->skip(intval($page->firstRow))->limit(intval($page->listRows));
		$users = MongoUtil::asList($rt);
		$this->assign([
			'page'=>$page->show(),
			'users'=>$users
		]);
		$this->display();
	}

}