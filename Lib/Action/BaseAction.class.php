<?php
// 类改了名字，临时Fix找不到类的问题
require_once dirname(dirname(__DIR__))."/ThinkPHP/Lib/Core/Action.class.php";
/**
 * Created by PhpStorm.
 * User: zzq
 * Date: 14-7-15
 * Time: 下午10:00
 */
class BaseAction extends CoreAction {

    public function _initialize() {
        // 数组操作
        import('ORG.Util.ArrayMap');
		// 微信之门登录
		if (isset($_REQUEST['wgateid'])) {
			$u = MongoFactory::table("user")->findOne(['wgateid'=>$_REQUEST['wgateid']], ['_id', 'nickname' ,'username']);
			if (!isset($u['_id'])) {
				// 获取Oauth信息，用户注册
				$user = UserModel::getWeChatGateOAuthInfo();
				if (!$user) {
					return;
				}
				$this->wgateRegister($user);
			} else {
				// 微信之门登录成功，写自己登录系统的sid
				setcookie('sid', $u['sid'], time() + 3600*24*7, "/");
				$_COOKIE['sid'] = (string)$u['sid'];
			}
		}
    }

	private function wgateRegister($user) {
		$data = [];
		$data['create_time'] = time();
		$data['login_time']  = time();
		$data['email']       = "";
		$data['birthday'] = date('Ymd', time());
		$data['dist1'] = "";
		$data['dist2'] = "";
		$data['dist3'] = "";
		$data['nickname'] = $user['nickname'];
		if ($user['sex'] == '1' || $user['sex'] == '2') {
			$data['gender'] = (string)$user['sex'];
		} else {
			// 微信Oauth没获取到性别，这不知道概率有多大
			$data['gender'] = '0';
		}
		$data['username'] = $_REQUEST['wgateid'];
		$data['wgateid'] = $_REQUEST['wgateid'];
		$data['wg_openid'] = (string)$user['openid'];
		$data['wg_city'] = (string)$user['city'];
		$data['wg_province'] = (string)$user['province'];
		$data['wg_country'] = (string)$user['country'];
		import('ORG.Net.UploadFile');
		$config['savePath'] = APP_PATH.'Public/upload/';
		$config['thumb'] = true;
		$config['thumbType'] = 0;
		$config['thumbPath'] = APP_PATH.'Public/upload/thumb/';
		$config['thumbPrefix'] = 'm_,s_';
		$config['thumbMaxWidth'] = '480,100';
		$config['thumbMaxHeight'] = '480,120';
		$upload = new UrlUploadFile($config);
		$data['avatar'] = $upload->saveRemote($user['headimgurl']);
		$data['images'][0] = $data['avatar'];
		$g = new Guid();
		$sid = $g->toString();
		$data['sid'] = $sid;
		setcookie('sid', $sid, time() + 3600*24*7, "/");
		$_COOKIE['sid'] = $sid;
		$rt = UserModel::add($data);
	}
}