<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>[title]</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<script src="{:version('__PUBLIC__/js/zepto.min.js')}"></script>
	<script type="text/javascript">
		var WIN_WIDTH = $(window).width();
		if (Zepto.mozilla) {
			WIN_WIDTH = window.screen.width; //兼容Mozilla
		}
	</script>
	<script src="{:version('__PUBLIC__/js/toast.js')}"></script>
	<script src="{:version('__PUBLIC__/js/public.js')}"></script>
	<link rel="stylesheet" href="{:version('__PUBLIC__/style/main.css')}" />
	<link rel="stylesheet" href="{:version('__PUBLIC__/style/user.css')}" />
	<link rel="stylesheet" href="{:version('__PUBLIC__/style/append.css')}" />
</head>
<body>
<div id="loading"></div>
<script type="text/javascript">
	$(function(){
		setTimeout(function(){
			$("#loading").hide();
		}, 100);
	});

	var regProvince = "{:U('User/Reg/province')}";
	var regCity = "{:U('User/Reg/city')}";
	var regArea = "{:U('User/Reg/area')}";
	var regHometown = "{:U('User/Reg/hometown')}";
	var profileOther = "{:U('User/Profile/other')}";
	var eventDetailUrl = "{:U('Event/Index/detail')}";
</script>
<div class="navbar-layout">
	<ul>
		<li <?php if($cur_home):?>class="cur"<?php endif;?> onclick="goUrl('{:U('Home/Index/index')}');">首页</li>
		<li <?php if($cur_event):?>class="cur"<?php endif;?> onclick="goUrl('{:U('Event/Index/index')}');">活动</li>
		<li <?php if($cur_search):?>class="cur"<?php endif;?> onclick="goUrl('{:U('User/Search/index')}');">搜索</li>
		<li onclick="goUrl('#');">消息</li>
		<?php if ($login):?>
			<li <?php if($cur_user):?>class="cur"<?php endif;?>  onclick="goUrl('{:U('User/Index/index')}')">我的</li>
		<?php else:?>
		<li <?php if($cur_user):?>class="cur"<?php endif;?>  onclick="goUrl('{:U('User/Login/index')}')">登录</li>
		<?php endif;?>
	</ul>
	<div class="clear"></div>
</div>
<!--<div class="square-layout">-->
<!--	<ul>-->
<!--		<li onclick="goUrl('/wap.php?c=cp_info');"><span><img src="__PUBLIC__/images/1121789.png" />我的资料</span></li>-->
<!--		<li onclick="goUrl('/wap.php?c=cp_match');"><span><img src="__PUBLIC__/images/1121884.png" />缘分速配</span></li>-->
<!--		<li onclick="goUrl('/wap.php?c=cp_message');"><span><img src="__PUBLIC__/images/1121746.png" />收件箱</span></li>-->
<!--		<li onclick="goUrl('/wap.php?c=cp_outmsg');"><span><img src="__PUBLIC__/images/1121867.png" />发件箱</span></li>-->
<!--		<li onclick="goUrl('/wap.php?c=cp_visitme');"><span><img src="__PUBLIC__/images/1121945.png" />谁看过我</span></li>-->
<!--		<li onclick="goUrl('/wap.php?c=cp_visit');"><span><img src="__PUBLIC__/images/1121946.png" />我看过谁</span></li>-->
<!--		<li onclick="goUrl('/wap.php?c=cp_fans');"><span><img src="__PUBLIC__/images/1121949.png" />我的粉丝</span></li>-->
<!--		<li onclick="goUrl('/wap.php?c=cp_listen');"><span><img src="__PUBLIC__/images/1121950.png" />我的关注</span></li>-->
<!--	</ul>-->
<!--	<div class="clear"></div>-->
<!--</div>-->