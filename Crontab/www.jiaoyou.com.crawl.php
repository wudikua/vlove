<?php
ini_set("display_errors", "on");
error_reporting(E_ALL);
require_once dirname(__DIR__)."/ThinkPHP/Extend/Library/ORG/Util/Image.class.php";
require_once dirname(__DIR__)."/ThinkPHP/Extend/Library/ORG/Net/UploadFile.class.php";
require_once dirname(__DIR__)."/Common/common.php";

class MyUploadFile extends UploadFile {
	public function saveRemote($url) {
		$filename = $this->savePath.substr($url, strrpos($url, "/")+1);
		$extension = substr($filename, strrpos($filename, ".")+1);
		$imageData = file_get_contents("http://www.jiaoyou.com/$url");
		file_put_contents($filename, $imageData);
		$image =  getimagesize($filename);
		if(false !== $image) {
			//是图像文件生成缩略图
			$thumbWidth		=	explode(',',$this->thumbMaxWidth);
			$thumbHeight	=	explode(',',$this->thumbMaxHeight);
			$thumbPrefix	=	explode(',',$this->thumbPrefix);
			$thumbSuffix    =   explode(',',$this->thumbSuffix);
			$thumbFile		=	explode(',',$this->thumbFile);
			$thumbPath      =   $this->thumbPath?$this->thumbPath:dirname($filename).'/';
			$thumbExt       =   $this->thumbExt ? $this->thumbExt : $extension; //自定义缩略图扩展名
			// 生成图像缩略图
			for($i=0,$len=count($thumbWidth); $i<$len; $i++) {
				if(!empty($thumbFile[$i])) {
					$thumbname  =   $thumbFile[$i];
				}else{
					$prefix     =   isset($thumbPrefix[$i])?$thumbPrefix[$i]:$thumbPrefix[0];
					$suffix     =   isset($thumbSuffix[$i])?$thumbSuffix[$i]:$thumbSuffix[0];
					$thumbname  =   $prefix.basename($filename,'.'.$extension).$suffix;
				}
				if(1 == $this->thumbType){
					Image::thumb2($filename,$thumbPath.$thumbname.'.'.$thumbExt,'',$thumbWidth[$i],$thumbHeight[$i],true);
				}else{
					Image::thumb($filename,$thumbPath.$thumbname.'.'.$thumbExt,'',$thumbWidth[$i],$thumbHeight[$i],true);
				}

			}
		}
		return substr($filename, strrpos($filename, "/") + 1);
	}
}
class Photo {
	/**
	 * @var MyUploadFile
	 */
	public static $uploadFile;
}

$config['savePath'] = dirname(__DIR__).'/Public/upload/';
$config['thumb'] = true;
$config['thumbType'] = 0;
$config['thumbPath'] = dirname(__DIR__).'/Public/upload/thumb/';
$config['thumbPrefix'] = 'm_,s_';
$config['thumbMaxWidth'] = '480,64';
$config['thumbMaxHeight'] = '480,64';
Photo::$uploadFile = new MyUploadFile($config);


function request($url, $type="get") {
	return file_get_contents($url);
	$header = [
		'Cookie'=>'PHPSESSID=77e0epgm2jrf68fcivqeoqnf33; user_id=1435303325281899401; password=49f3c77a7c41c4e46f9cac024849fe79; USER_TIMEZONEOFFSET=%2B8; first_from_url=https%3A%2F%2Fwww.baidu.com%2Flink%3Furl%3DjpFC9u1ayV8iqsP1uYZqt5SyxOTJJVQpJQHzUjhsPQnNqASWvjeF9ZOzsTotaAPa%26wd%3D%26eqid%3Dc3d9b1af0000410200000003558cfe01',
	];
	$curl = curl_init (); // 启动一个CURL会话
	curl_setopt ( $curl, CURLOPT_URL, $url ); // 要访问的地址
	curl_setopt ( $curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)' ); // 模拟用户使用的浏览器
	curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 ); // 设置超时限制防止死循环
	curl_setopt ( $curl, CURLOPT_HTTPHEADER, $header ); // 设置HTTP头
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); // 获取的信息以文件流的形式返回
	curl_setopt ( $curl, CURLOPT_CUSTOMREQUEST, $type );
	$result = curl_exec ( $curl ); // 执行操作
	curl_close ( $curl ); // 关闭CURL会话
	return $result;
}

function logError($msg) {
	echo $msg.PHP_EOL;
	file_put_contents(__DIR__."/error.log", $msg.PHP_EOL, FILE_APPEND);
}

function logInfo($msg) {
	echo $msg.PHP_EOL;
	file_put_contents(__DIR__."/info.log", $msg.PHP_EOL, FILE_APPEND);
}

/**
 * @param $uid
 * @return mix
 */
function detail($uid) {
	$user = [];
//	$photos = request(sprintf("http://www.jiaoyou.com/profile.php?act=photo&user_id=%s", $uid));
//	if (!$photos) {
//		logError("$uid get detail page false");
//	}
//	if (!preg_match_all('~album_s\"><a href=\"(.*?)"~', $photos, $matches)) {
//		logError("$uid has no pics");
//	}
//	if (count($matches[1]) == 0) {
//		logError("$uid has no pics2");
//	}
//	foreach ($matches[1] as $m) {
//		$imageName = Photo::$uploadFile->saveRemote($m);
//		if ($imageName) {
//			$user['images'][] = $imageName;
//		}
//	}
	$content = request(sprintf("http://www.jiaoyou.com/profile_%s.html", $uid));
	if (!$content) {
		logError("fetch detail $uid none");
	}
	$info = iconv("gbk", "utf-8", $content);
	if (preg_match("~用户名.*?>(.*?)<~", $info, $m)) {
		$user['nickname'] = $m[1];
	}
	if (preg_match("~身高.*?>(.*?)<~s", $info, $m)) {
		$user['height'] = intval($m[1]);
	}
	if (preg_match("~体重.*?>(.*?)<~s", $info, $m)) {
		$user['weight'] = intval($m[1]);
	}
	if (preg_match("~真情告白.*x;\"?>(.*?)</div>~", $info, $m)) {
		$user['content'] = htmlspecialchars($m[1]);
	}
	if (preg_match("~年龄.*?>(.*?)<~s", $info, $m)) {
		$age = intval($m[1]);
		$year = date('Y', time());
		$year -= $age;
		$begin = strtotime("$year-1-01");
		$end = strtotime("$year-12-30");
		$user['birthday'] = date("Y-m-d", mt_rand($begin, $end));
	}
	$user['uid'] = $uid;
	logInfo(json_encode($user));
	return $user;
}

function lists($gender, $page) {
	$list = request("http://www.jiaoyou.com/search.php?p_sex=$gender&p_age_from=18&p_age_to=35&totalnum=1000&pagenum=$page");
	if (!preg_match_all("~profile_(\d+).html\" target~", $list, $matches)) {
		logError("gender:$gender page:$page lists none");
	}
	return $matches[1];
}

//$uids = lists(2, 2);
//var_dump($uids);
//$rt = detail("1348303326628598100");
//var_dump($rt);

for ($i=1;$i<100;$i++) {
	$uids = lists(2, $i);
	foreach ($uids as $u) {
//		$rt = MongoFactory::table("robot")->findOne(['uid'=>$u]);
//		if (isset($rt['_id'])) {
//			continue;
//		}
		$rt = detail($u);
		if (!$rt) {
			continue;
		}
		MongoFactory::table("robot")->update(['uid'=>$rt['uid']], ['$set'=>['content'=>$rt['content']]]);
	}
}
