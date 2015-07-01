<?php
// 本类由系统自动生成，仅供测试用途
class RegAction extends UserBaseAction {


    /**
     * 初始化方法
     */
    public function _initialize() {
        parent::_initialize();
    }

	/**
	 * 地区三级联动
	 */
	public function province($item, $dist1, $dist2, $dist3) {
		$province = "";
		foreach (Province::getProvince() as $k=>$v) {
			$province .= "<option value=\"$k\">$v</option>".PHP_EOL;
		}

		$this->ajaxReturn([
			"response"=>1,
			"result"=>sprintf(Province::getTemplate($item), $province),
		]);
	}

	public function city($provinceId) {
		$c = [];
		foreach (Province::getCity($provinceId) as $k=>$v) {
			$t['areaid'] = $k;
			$t['areaname'] = $v;
			$c[] = $t;
		}
		$this->ajaxReturn([
			"response"=>1,
			"result"=>$c,
		]);
	}

	public function area($provinceId, $cityId) {
		$c = [];
		foreach (Province::getArea($provinceId, $cityId) as $k=>$v) {
			$t['areaid'] = $k;
			$t['areaname'] = $v;
			$c[] = $t;
		}
		$this->ajaxReturn([
			"response"=>1,
			"result"=>$c,
		]);
	}

	public function hometown($item, $dist1, $dist2) {
		$province = "";
		foreach (Province::getProvince() as $k=>$v) {
			$province .= "<option value=\"$k\">$v</option>".PHP_EOL;
		}
		$this->ajaxReturn([
			"response"=>1,
			"result"=>sprintf(Province::getTemplateHometown($item), $province),
		]);
	}

	/**
	 * ajax检测邮箱占用
	 * @param $email
	 * @return ajax返回 0不可用 1可用
	 */
	public function checkemail($email) {
		if ($email) {
			$exists = MongoFactory::table("user")->findOne(['email'=> $email]);
			if ($exists) {
				$this->ajaxReturn([
					"response"=>0,
					"result"=>"",
				]);
			}
		}
		$this->ajaxReturn([
			"response"=>1,
			"result"=>"",
		]);
	}

	/**
	 * ajax用户名占用
	 * @param $email
	 * @return ajax返回 0不可用 1可用
	 */
	public function checkusername($username) {
		if ($username) {
			$exists = MongoFactory::table("user")->findOne(['username'=> $username]);
			if ($exists) {
				$this->ajaxReturn([
					"response"=>0,
					"result"=>"",
				]);
			}
		}
		$this->ajaxReturn([
			"response"=>1,
			"result"=>"",
		]);
	}

	private function innerReg() {
		try {
			$fields = [
				'username', 'password', //登录信息
				'dist1', 'dist2', 'dist3',		 //区域信息
				'gender', 'birthday',
				'marrystatus', 'education', 'height', 'weight',
				'lovesort', 'salary', 'mobile', 'qq', 'idnumber'
			];
			$data = [];
			foreach ($fields as $f) {
				if ($this->_post($f) == "undefined") {
					$data[$f] = "0";
				} else {
					$data[$f] = $this->_post($f);
				}
			}
			if (!isset($data['nickname'])) {
				$data['nickname'] = $data['username'];
			}
            //
            $data['create_time'] = time();
            $data['login_time']  = time();
			$data['email']       = "";
			$g = new Guid();
			$sid = $g->toString();
			$data['sid'] = $sid;
			setcookie('sid', $sid, time() + 3600*24*7, "/");
			setcookie('gender', $data['gender'], time() + 3600*24*7, "/");
			$rt = MongoFactory::table("user")->insert($data);
			$this->ajaxReturn([
				"response"=>1,
				"result"=>"",
			]);
		} catch (Exception $e) {
			$this->ajaxReturn([
				"response"=>0,
				"result"=>"服务器错误 ".$e->getMessage(),
			]);
		}
	}

    public function index(){
        if($this->ispost()) {
			$this->innerReg();
			die;
        }
        $this->assign([
			"cur_user"=>"1"
		]);
        $this->display();

    }
}