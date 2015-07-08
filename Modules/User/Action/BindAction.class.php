<?php
/**
 * Created by PhpStorm.
 * User: mengjun
 * Date: 15-7-5
 * Time: 下午10:57
 */
class BindAction extends UserLoginAction {

	private function updateField($fields) {
		$update = [];
		foreach ($fields as $f) {
			$update[$f] = $this->_post($f);
		}
		$rt = MongoFactory::table("user")->update(['_id'=>new MongoId($this->userId)],
			['$set'=> $update]
		);
	}

	public function index() {
		$this->display();
	}

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
			if (isset($_COOKIE['backurl'])) {
				setcookie("backurl", "", -1);
				$this->jump($_COOKIE['backurl'], "恭喜您已经可以正常使用“单身吧”，正在跳转到他人资料");
			} else {
				$this->jump(U("User/Photo/index"), "恭喜您已经可以正常使用“单身吧”，最后再上传几张照片，可以大大增加您的魅力");
			}

			die;
		}
		$this->assign([
			'user'=>$this->getLoginUser(),
			"cur_user"=>"1"
		]);
		$this->display();
	}

	public function bind() {
		if (strlen($this->_post("username")) ==0 ) {
			$this->ajaxReturn([
				"response"=>0,
				"result"=>"用户名不能为空",
			]);
		}
		if (strlen($this->_post("password")) ==0 ) {
			$this->ajaxReturn([
				"response"=>0,
				"result"=>"密码不能为空",
			]);
		}
		try {
			$user = $this->getLoginUser();
			$rt = MongoFactory::table("user")->findOne([
				"username"=>$this->_post("username"),
				"password"=>$this->_post("password"),
			]);
			if (!isset($rt['_id'])) {
				$this->ajaxReturn([
					"response"=>0,
					"result"=>"用户名或密码错误",
				]);
			}
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

	public function reg() {
		if (strlen($this->_post("username")) ==0 ) {
			$this->ajaxReturn([
				"response"=>0,
				"result"=>"用户名不能为空",
			]);
		}
		if (strlen($this->_post("password")) ==0 ) {
			$this->ajaxReturn([
				"response"=>0,
				"result"=>"密码不能为空",
			]);
		}
		try {
			$user = $this->getLoginUser();
			MongoFactory::table("user")->update(['_id'=>new MongoId((string)$user['_id'])],
				['$set'=>['username'=>$this->_post("username"),'password'=>$this->_post("password")]]
			);
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

}