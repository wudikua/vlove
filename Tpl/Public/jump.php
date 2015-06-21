<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>信息提示</title>
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

<div class="navbar-layout">
	<p>信息提示</p>
</div>
<div class="halt-layout">
	<p><?php if(!isset($msg)):?>修改成功<?php else:?>{$msg}<?php endif;?></p>
	<p>
		<script type="text/javascript">
			$(function(){
				setTimeout(function(){
					window.location.href = "{$jumpUrl}";
				}, {$timeout});
			});
		</script>
		<span onclick="goUrl('{$jumpUrl}');">如果没有跳转，点击这里。</span>
	</p>
</div>
<include file="./Tpl/Public/footer.php"/>
</body>
</html>