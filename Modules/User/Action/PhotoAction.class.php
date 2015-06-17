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
		$this->assign(['images'=>$user['images']]);
		$this->display();
	}

	/**
	 * 删除图片
	 * @param $imageIndex 图片下标
	 */
	public function remove($id) {
		$user = $this->getLoginUser();
		unset($user['images'][intval($id) - 1]);
		$update = [];
		if ($user['images'][intval($id) - 1] == $user['avatar']) {
			// 关联删除头像
			$update['avatar'] = '';
		}
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
		import('ORG.Net.UploadFile');
		$config['savePath'] = APP_PATH.'Public/upload/';
		$config['thumb'] = true;
		$config['thumbPath'] = APP_PATH.'Public/upload/thumb/';
		$config['thumbPrefix'] = 'm_,s_';
		$config['thumbMaxWidth'] = '200,50';
		$config['thumbMaxHeight'] = '200,50';
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
		import('ORG.Net.UploadFile');
		$config['savePath'] = APP_PATH.'Public/upload/';
		$config['thumb'] = true;
		$config['thumbPath'] = APP_PATH.'Public/upload/thumb/';
		$config['thumbPrefix'] = 'm_,s_';
		$config['thumbMaxWidth'] = '200,50';
		$config['thumbMaxHeight'] = '200,50';
		$upload = new UploadFile($config);
		if(!$upload->upload()) {
			$this->assign([
				"response"=>0,
				"msg"=>$upload->getErrorMsg(),
			]);
			$this->display();
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