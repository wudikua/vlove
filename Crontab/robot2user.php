<?php
require dirname(__DIR__)."/Common/common.php";
$robots = MongoFactory::table("robot")->find();
foreach ($robots as $r) {
	unset($r['_id']);
	if (!isset($r['images'])) {
		MongoFactory::table("user")->remove(['username'=>$r['uid']]);
		continue;
	} else {
		$r['avatar'] = $r['images'][0];
	}
	$r['email'] = $r['uid']."@robot.com";
	$r['username'] = $r['uid'];
	$r['birthday'] = str_replace("_", "", $r['birthday']);
	$r['height'] = (string)$r['height'];
	$r['weight'] = (string)$r['weight'];
	$r['dist1'] = "1";
	$r['dist2'] = "1";
	$r['dist3'] = mt_rand(1, 8);
	$r['salary'] = mt_rand(1, 3);
	$r['robot'] = "1";
	$r['gender'] = "2";
	try {
	MongoFactory::table("user")->update(
		['username'=>$r['uid']],
		$r
	);
		echo "insert {$r['uid']}".PHP_EOL;
	} catch(Exception $e) {

	}
}
echo "success".PHP_EOL;