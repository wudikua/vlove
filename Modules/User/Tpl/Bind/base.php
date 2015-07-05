<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>完善基本资料</title>
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
	<script src="{:version('__PUBLIC__/js/swiper.js')}"></script>
	<link rel="stylesheet" href="{:version('__PUBLIC__/style/swiper.css')}" />
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
	var postDetailUrl = "{:U('Event/Discuss/detail')}";
</script>
<style>
	.notify-circle {
		background-color: #00E2FF;
		width: 0.5rem;
		height: 0.5rem;
		border-radius: 1.5rem;
		display: inline-block;
		position: absolute;
		right: 0.7rem;
		top: 0.7rem;
	}
</style>

<div class="cp-bartitle">完善基本资料后可以进行交友</div>
<h1>完善必填项才可以使用单身吧，如果已经填写可以直接下一步</h1>
<form name="myform" id="myform" method="post" action="{:U('User/Bind/base')}">
	<div class="cp-layout-body">
		<div class="profile-layout">
			<ul>
				<li>
					<div class="profile-item">昵&#12288;&#12288;称：</div>
					<div class="profile-value">
						<input type="text" name='nickname' id='nickname' value="{$user['nickname']}" placeholder="填写昵称">
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">婚姻状况：</div>
					<div class="profile-value">
						<select name='marrystatus' id='marrystatus'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$marrystatus as $k=>$v):?>
								<option value='{$k}' <?php if($user['marrystatus'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					(必填)
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">交友类型：</div>
					<div class="profile-value" id="lovesort_text">
						<select name='lovesort' id='lovesort'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$lovesort as $k=>$v):?>
								<option value='{$k}' <?php if($user['lovesort'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">生&#12288;&#12288;日：</div>
					<div class="profile-value">
						<input type="text" name='birthday' id='birthday' value="{$user['birthday']}" placeholder="(格式:19920501)">
					</div>
					(必填)
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">身&#12288;&#12288;高：</div>
					<div class="profile-value">
						<select name='height' id='height'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$height as $k=>$v):?>
								<option value='{$k}' <?php if($user['height'] == $k):?>selected<?php endif;?>>{$v}CM</option>
							<?php endforeach;?>
						</select>
					</div>
					(必填)
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">体&#12288;&#12288;重：</div>
					<div class="profile-value">
						<input type="text" name='weight' id='weight' value="{$user['weight']}" placeholder="输入体重的KG数">&nbsp;KG
					</div>
					<div class="clear"></div>
				</li>

				<li onclick="areaPopup('所在地区', 'dist');">
					<div class="profile-item">所在地区：</div>
					<div class="profile-value" id="dist_text">
						<?php echo Province::getProvinceName($user['dist1']);?>
						<?php echo Province::getCityName($user['dist1'], $user['dist2']);?>
						<?php echo Province::getAreaName($user['dist1'], $user['dist2'], $user['dist3']);?>
					</div>
					(必填)
					<div class="clear"></div>
					<input type="hidden" name="dist1" id="dist1" value="{$user['dist1']}" />
					<input type="hidden" name="dist2" id="dist2" value="{$user['dist2']}" />
					<input type="hidden" name="dist3" id="dist3" value="{$user['dist3']}" />
				</li>

				<li>
					<div class="profile-item">学&#12288;&#12288;历：</div>
					<div class="profile-value">
						<select name='education'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$education as $k=>$v):?>
								<option value='{$k}' <?php if($user['education'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					(必填)
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">学&#12288;&#12288;校：</div>
					<div class="profile-value">
						<input type="text" name='school' id='school' value="{$user['school']}">
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">年&#12288;&#12288;薪：</div>
					<div class="profile-value" id="salary_text">
						<select name='salary' id='salary'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$salary as $k=>$v):?>
								<option value='{$k}' <?php if($user['salary'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>


				<li>
					<div class="profile-item">行&#12288;&#12288;业：</div>
					<div class="profile-value" id="industry_text">
						<select name='industry' id='industry'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$industry as $k=>$v):?>
								<option value='{$k}' <?php if($user['industry'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">职&#12288;&#12288;业：</div>
					<div class="profile-value">
						<input type="text" name='job' id='job' value="{$user['job']}" placeholder="职业">
					</div>
					(必填)
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">工作单位：</div>
					<div class="profile-value">
						<input type="text" name='company' id='company' value="{$user['company']}" placeholder="工作单位">
					</div>
					<div class="clear"></div>
				</li>

			</ul>
			<div class="clear"></div>
		</div>
		<!--//profile-layout End-->

		<div class="spanbtn0" id="btn_post">下一步</div>
	</div>
</form>
<!--//cp-layout-body End-->

<div id="varpop_shade" class="varpop-shade"></div>

<div class="varpop-layout" id='area_box'>
	<div class="varpop-head">
		<span id="area_title">选择</span>
		<i id="area_loading">loading...</i>
	</div>
	<div id="area_data"></div>
	<!--//area_data End-->
</div>
<!--//area_box ajax End-->

<div class="varpop-layout" id='hometown_box'>
	<div class="varpop-head">
		<span id="hometown_title">选择</span>
		<i id="hometown_loading">loading...</i>
	</div>
	<div id="hometown_data"></div>
</div>
<!--//hometown ajax End-->


<include file="./Tpl/Public/footer.php"/>

</body>
</html>
<script type="text/javascript">
	$("#btn_post").click(function(){
		if ($("#marrystatus").val() == "") {
			ToastShow("请选择婚姻状况");
			return false;
		}

		if ($("#birthday").val() == "") {
			ToastShow("请填写生日");
			return false;
		}

		if ($("#job").val() == "") {
			ToastShow("请选择职业");
			return false;
		}

		if ($("#height").val() == "") {
			ToastShow("请填写身高");
			return false;
		}

		if ($("#dist1").val() == "") {
			ToastShow("请选择地区");
			return false;
		}

		if ($("#education").val() == "") {
			ToastShow("请选择学历");
			return false;
		}

		$("#myform").submit();
	});
</script>