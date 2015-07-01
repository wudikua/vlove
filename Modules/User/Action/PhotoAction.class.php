<?php
/**
 * Created by PhpStorm.
 * User: mengjun
 * Date: 15-6-16
 * Time: 上午10:31
 */
class PhotoAction extends UserLoginAction {

	/**
	 * 我的相册
	 */
	public function index() {
		$user = $this->getLoginUser();
		$this->assign([
			'images'=>$user['images'],
			"cur_user"=>"1"
		]);
		$this->display();
	}

	/**
	 * 删除图片
	 * @param $imageIndex 图片下标
	 */
	public function remove($id) {
		$user = $this->getLoginUser();
		$update = [];
		if ($user['images'][intval($id) - 1] == $user['avatar']) {
			// 关联删除头像
			$update['avatar'] = '';
		}
		unset($user['images'][intval($id) - 1]);
		$user['images'] = array_values($user['images']);
		$update['images'] = $user['images'];
		MongoFactory::table("user")->update(
			["_id"=>new MongoId($this->userId)],
			['$set'=> $update]
		);
		$this->ajaxReturn([
			"response"=>1,
			"result"=>"",
		]);
	}

	public function setavatar($id) {
		$user = $this->getLoginUser();
		$update = [];
		$update['avatar'] = $user['images'][intval($id) - 1];
		MongoFactory::table("user")->update(
			["_id"=>new MongoId($this->userId)],
			['$set'=> $update]
		);
		$this->ajaxReturn([
			"response"=>1,
			"result"=>"",
		]);
	}

	public function avatar() {
		$user = $this->getLoginUser();
		if (count($user['images']) > 9) {
			$this->assign([
				"response"=>1,
				"msg"=>"一个用户最多上传10张照片",
			]);
			$this->display();
			die;
		}
		import('ORG.Net.UploadFile');
		$config['savePath'] = APP_PATH.'Public/upload/';
		$config['thumb'] = true;
		$config['thumbType'] = 0;
		$config['thumbPath'] = APP_PATH.'Public/upload/thumb/';
		$config['thumbPrefix'] = 'm_,s_';
		$config['thumbMaxWidth'] = '480,100';
		$config['thumbMaxHeight'] = '480,120';
		$upload = new UploadFile($config);
		if(!$upload->upload()) {
			$this->assign([
				"response"=>1,
				"msg"=>$upload->getErrorMsg(),
			]);
			$this->display();
		}
		$info = $upload->getUploadFileInfo();
		MongoFactory::table("user")->update(
			["_id"=>new MongoId($this->userId)],
			['$set'=>['avatar'=>$info[0]['savename']]]
		);
		MongoFactory::table("user")->update(
			["_id"=>new MongoId($this->userId)],
			['$push'=>['images'=>$info[0]['savename']]], ['upsert'=>true]
		);
		$this->assign([
			"response"=>1,
			"msg"=>"",
		]);
		$this->display();
	}

	/**
	 * 上传照片
	 */
	public function upload() {
		$user = $this->getLoginUser();
		if (count($user['images']) > 9) {
			$this->assign([
				"response"=>1,
				"msg"=>"一个用户最多上传10张照片",
			]);
			$this->display();
			die;
		}
		import('ORG.Net.UploadFile');
		$config['savePath'] = APP_PATH.'Public/upload/';
		$config['thumb'] = true;
		$config['thumbPath'] = APP_PATH.'Public/upload/thumb/';
		$config['thumbType'] = 0;
		$config['thumbPrefix'] = 'm_,s_';
		$config['thumbMaxWidth'] = '480,100';
		$config['thumbMaxHeight'] = '480,120';
		$upload = new UploadFile($config);
		if(!$upload->upload()) {
			$this->assign([
				"response"=>0,
				"msg"=>$upload->getErrorMsg(),
			]);
			$this->display();
			die;
		}
		$info = $upload->getUploadFileInfo();
		MongoFactory::table("user")->update(
			["_id"=>new MongoId($this->userId)],
			['$push'=>['images'=>$info[0]['savename']]], ['upsert'=>true]
		);
		$this->assign([
			"response"=>1,
			"msg"=>"",
		]);
		$this->display();
	}
}