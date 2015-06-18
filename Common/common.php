<?php
require_once "area.php";
require_once "profile.php";

function get_image_name(){
    static $imageCount = 0;
    $imageCount++;
    return time().rand(10000, 999999) . $imageCount;
}

function age($YTD){
	if ($YTD instanceof MongoDate) {
		$YTD = $YTD->sec;
	} else {
		$YTD = strtotime($YTD);
	}
	$year = date('Y', $YTD);
	if(($month = (date('m') - date('m', $YTD))) < 0){
		$year++;
	}else if ($month == 0 && date('d') - date('d', $YTD) < 0){
		$year++;
	}
	return (date('Y') - $year) < 0 ? 0 : (date('Y') - $year);
}

function rage($num) {
	$year = date('Y', time());
	$year -= $num;
	return "$year".date("md", time());
}

function constellation($YTD){
	if ($YTD instanceof MongoDate) {
		$birthdayDate = $YTD->sec;
	} else {
		$birthdayDate = strtotime($YTD);
	}
	// 年龄
	$month  = (int)date('m', $birthdayDate);
	$day    = (int)date('d', $birthdayDate);
	// 星座
	if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) {
		$constellation = '水瓶座';
	} else if (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
		$constellation = '双鱼座';
	} else if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) {
		$constellation = '白羊座';
	} else if (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
		$constellation = '金牛座';
	} else if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 21)) {
		$constellation = '双子座';
	} else if (($month == 6 && $day >= 22) || ($month == 7 && $day <= 22)) {
		$constellation = '巨蟹座';
	} else if (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) {
		$constellation = '狮子座';
	} else if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
		$constellation = '处女座';
	} else if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 23)) {
		$constellation = '天秤座';
	} else if (($month == 10 && $day >= 24) || ($month == 11 && $day <= 22)) {
		$constellation = '天蝎座';
	} else if (($month == 11 && $day >= 23) || ($month == 12 && $day <= 21)) {
		$constellation = '射手座';
	} else if (($month == 12 && $day >= 22) || ($month == 1 && $day <= 19)) {
		$constellation = '摩羯座';
	} else {
		$constellation = '';
	}
	return $constellation;
}

class Guid
{
	var $valueBeforeMD5;
	var $valueAfterMD5;
	public static function currentTimeMillis() {
		list($usec, $sec) = explode(" ",microtime());
		return $sec.substr($usec, 2, 3);
	}
	public static function nextLong() {
		$tmp = rand(0,1)?'-':'';
		return $tmp.rand(1000, 9999).rand(1000, 9999).rand(1000, 9999).rand(100, 999).rand(100, 999);
	}
	public static function getLocalHost() {
		if (!isset($_SERVER["SERVER_ADDR"])) {
			$_SERVER["SERVER_ADDR"] = '127.0.0.1';
		}
		return strtolower('localhost/'.$_SERVER["SERVER_ADDR"]);
	}
	public function __construct()
	{
		$this->getGuid();
	}
	private function getGuid()
	{
		$address = self::getLocalHost();
		$this->valueBeforeMD5 = $address.':'.self::currentTimeMillis().':'.self::nextLong();
		$this->valueAfterMD5 = md5($this->valueBeforeMD5);
	}
	public function toString()
	{
		$raw = strtolower($this->valueAfterMD5);
		return substr($raw,0,8).substr($raw,8,4).substr($raw,12,4).substr($raw,16,4).substr($raw,20);
	}
}

class MongoUtil {

	public static function asList($result) {
		$list = [];
		foreach($result as $u) {
			if (!empty($u)) {
				$list[] = $u;
			}
		}
		return $list;
	}
}

class MongoFactory {

	private static $db;

	/**
	 * @param $table
	 * @return MongoCollection
	 */
	public static function table($table) {
		if (isset($db[$table])) {
			return self::$db[$table];
		}
		self::$db[$table] = new MongoClient();
		return self::$db[$table]->vlove->$table;
	}
}