<?php
class DiscussAction extends EventBaseAction {

	private function appendUserInfo(&$posts) {
		foreach ($posts as &$p) {
			$p['user'] = MongoFactory::table("user")->findOne(['_id'=>new MongoId($p['uid'])], ['nickname', 'avatar']);
		}
	}

	public function index($eid) {
		$query = [
			'eid'=>$eid,
		];
		import('ORG.Util.Page');
		$count = MongoFactory::table("user")->find($query)->count();
		$page = new Page($count);
		$page->setConfig('prev', '<span onclick="goUrl(\'$url\');\">上一页</span>');
		$page->setConfig('next', '<span onclick="goUrl(\'$url\');\">下一页</span>');
		$page->setConfig('theme', '%first% %upPage% %linkPage% %downPage%  %end%');
		$rt = MongoFactory::table("discuss_post")->find($query)->skip(intval($page->firstRow))->limit(intval($page->listRows));
		$posts = MongoUtil::asList($rt);
		$this->appendUserInfo($posts);
		if ($eid != 0) {
			$event = MongoFactory::table("event")->findOne(['_id'=>new MongoId($eid)], ['title']);
		} else {
			$event['title'] = "吃喝玩乐综合讨论区";
		}
		$this->assign([
			'page'=>$page->show(),
			'event'=>$event,
			'posts'=>$posts,
			"cur_event"=>"1",
			'eid'=>$eid,
		]);
		$this->display();
	}

	public function detail($pid) {
		$post = MongoFactory::table("discuss_post")->findOne(["_id"=> new MongoId($pid)]);
		$post['user'] = MongoFactory::table("user")->findOne(['_id'=>new MongoId($post['uid'])], ['nickname', 'avatar']);
		// 浏览量+1 也可以用redis记
		MongoFactory::table("discuss_post")->update(["_id"=> new MongoId($pid)], ['$inc'=>['view'=>1]], ['upsert'=>true]);
		// 评论
		$rt = MongoFactory::table("discuss_comment")->find(["pid"=>$pid]);
		$query = [];
		$comments = MongoUtil::asList($rt);
		if (count($comments) > 0) {
			foreach ($comments as $comment) {
				if (!in_array($comment['uid'], $query)) {
					$query[] = new MongoId($comment['uid']);
				}
			}
		}
		$rt = MongoFactory::table("user")->find(["_id"=>['$in'=>$query]], ['_id', 'avatar', 'gender', 'nickname']);
		$userInfo = MongoUtil::asMap($rt, "_id");

		foreach ($comments as &$comment) {
			if (!isset($userInfo[$comment['uid']])) {
				continue;
			}
			$comment['user'] = $userInfo[$comment['uid']];
		}

		$this->assign([
			"userId"=>$this->userId,
			"post"=>$post,
			"comments"=>$comments,
			"login"=>isset($_SESSION['login']),
			"cur_event"=>"1"
		]);
		$this->display();
	}

	public function post($eid) {
		if ($this->ispost()) {
			$postImage = [];
			if (isset($_FILES['image'])) {
				// 处理图片上传
				import('ORG.Net.UploadFile');
				$config['savePath'] = APP_PATH.'Public/upload/';
				$config['thumb'] = true;
				$config['thumbType'] = 0;
				$config['thumbPath'] = APP_PATH.'Public/upload/thumb/';
				$config['thumbPrefix'] = 'm_,s_';
				$config['thumbMaxWidth'] = '480,64';
				$config['thumbMaxHeight'] = '480,64';
				$upload = new UploadFile($config);
				if(!$upload->upload()) {
					$this->assign([
						"response"=>1,
						"msg"=>$upload->getErrorMsg(),
					]);
					$this->display();
				}
				$info = $upload->getUploadFileInfo();
				$postImage[] = $info[0]['savename'];
			}
			$eventId = $this->_post("eid");
			$postUserId = $this->userId;
			$title = $this->_post("title");
			$content = $this->_post("content");
			MongoFactory::table("discuss_post")->insert([
				'eid'=>$eventId,
				'uid'=>$postUserId,
				'title'=>$title,
				'content'=>$content,
				'images'=>$postImage,
				'time'=>time(),
			]);
			$this->jump(U('Discuss/index')."?eid=$eid", "发布成功");
		}
		$this->assign([
			'eid'=>$eid,
		]);
		$this->display();
	}

	public function comment($pid, $eid, $replyUid, $content) {
		$postImage = [];
		if (!empty($_FILES['image']["name"])) {
			// 处理图片上传
			import('ORG.Net.UploadFile');
			$config['savePath'] = APP_PATH.'Public/upload/';
			$config['thumb'] = true;
			$config['thumbType'] = 0;
			$config['thumbPath'] = APP_PATH.'Public/upload/thumb/';
			$config['thumbPrefix'] = 'm_,s_';
			$config['thumbMaxWidth'] = '480,64';
			$config['thumbMaxHeight'] = '480,64';
			$upload = new UploadFile($config);
			if(!$upload->upload()) {
				$this->jump(U('Discuss/detail')."?pid=$pid", $upload->getErrorMsg());
			}
			$info = $upload->getUploadFileInfo();
			$postImage[] = $info[0]['savename'];
		}
		MongoFactory::table("discuss_comment")->insert([
			'pid'=>$pid,
			'eid'=>$eid,
			'uid'=>$this->userId,
			'replyUid'=>$replyUid,
			'content'=>$content,
			'images'=>$postImage,
			'time'=>time(),
		]);
		$this->jump(U('Discuss/detail')."?pid=$pid", "发布成功");
		die;
	}

	public function postDel($pid) {
		$rt = MongoFactory::table("discuss_post")->remove([
			'uid'=>$this->userId,
			'_id'=>new MongoId($pid),
		], ["justOne"=>true]);
		if ($rt) {
			$this->jump(U('Discuss/detail')."?pid=$pid", "删除成功");
			die;
		} else {
			$this->jump(U('Discuss/detail')."?pid=$pid", "权限不足");
			die;
		}
	}

	public function commentDel($cid, $pid) {
		$rt = MongoFactory::table("discuss_comment")->remove([
			'uid'=>$this->userId,
			'_id'=>new MongoId($cid),
		], ["justOne"=>true]);
		if ($rt) {
			$this->jump(U('Discuss/detail')."?pid=$pid", "删除成功");
			die;
		} else {
			$this->jump(U('Discuss/detail')."?pid=$pid", "权限不足");
			die;
		}
	}

}