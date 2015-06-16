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
		$user['images'] = array_values($user['images']);
		MongoFactory::table("user")->update(
			["_id"=>new MongoId($this->userId)],
			['images'=>$user['images']]
		);
		$this->ajaxReturn([
			"response"=>1,
			"result"=>"",
		]);
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
			$this->ajaxReturn([
				"response"=>1,
				"result"=>$upload->getErrorMsg(),
			]);
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