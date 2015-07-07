<?php
require_once __DIR__."/vendor/autoload.php";
use \Curl\Curl;
define("LOGIN_STATUS", "9c6ec4ab7c4563b7d54c4e0274d02b25");
define("UDID", "07a7d18a9f38be8932ed1a41fad89391ded77aae");

function upOneTopic($topicId) {
	$cid = file_get_contents($topicId);
	if (strlen($cid) > 0) {
		$curl = new Curl();
		$curl->setUserAgent('api-client/2.0 com.douban.group/3.3.9(339) Android/22 hammerhead LGE Nexus 5');
		$curl->setHeader("Authorization", "Bearer ".LOGIN_STATUS);
		$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
		$rt = $curl->post(
			'https://api.douban.com/v2/group/topic/'.$topicId.'/delete_comment?udid='.UDID,
			[
				'reason'=>'',
				'comment_id'=>$cid
			]
		);
		echo json_encode($rt).PHP_EOL;

	}
	$curl = new Curl();
	$curl->setUserAgent('api-client/2.0 com.douban.group/3.3.9(339) Android/22 hammerhead LGE Nexus 5');
	$curl->setHeader("Authorization", "Bearer ".LOGIN_STATUS);
	$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
	$text = [
		'坚持不懈的顶上去', '关注一个买不了吃亏买不了上当',
		'微信关注wxdanshenba', '做个小站不容易',
		'我真的不是发广告','这样吧不会被封号吧','人数突破500~\(≧▽≦)/~啦啦啦',
		'写写大家捧场，自己也是单身狗，积累些资源',
		'纯属为大家义务劳动'
	];
	$rt = $curl->post(
		'https://api.douban.com/v2/group/topic/'.$topicId.'/add_comment?udid='.UDID,
		[
			'content'=>$text[array_rand($text)]
		]
	);
	echo json_encode($rt).PHP_EOL;
	file_put_contents($topicId, $rt->id);
}


upOneTopic($argv[1]);
//upOneTopic('77030841');
//upOneTopic('77016524');
//
//upOneTopic('77030605');
//upOneTopic('77030687');
//upOneTopic('77030759');
