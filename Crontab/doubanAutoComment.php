<?php
require_once __DIR__."/vender/autoload.php";
use \Curl\Curl;
$curl = new Curl();
$curl->setUserAgent('api-client/2.0 com.douban.group/3.3.9(339) Android/22 hammerhead LGE Nexus 5');
$curl->setHeader("Authorization", "Bearer 68e7437c4512891e3ab5ca74cf379b5a");
$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
$rt = $curl->post(
	'https://api.douban.com/v2/group/topic/76947624/add_comment?udid=07a7d18a9f38be8932ed1a41fad89391ded77aae',
	[
		'content'=>array_rand(
			[
				'坚持不懈的顶上去', '关注一个买不了吃亏买不了上当',
				'微信关注wxdanshenba', '做个小站不容易',
				'1','2','3','4','5','6','7','8','9',
				'我真的不是发广告','这样吧不会被封号吧','人数突破500~\(≧▽≦)/~啦啦啦',
			]
		)
	]
);
echo json_encode($rt).PHP_EOL;