<include file="./Tpl/Public/header.php" title="资料"/>

<script src="__PUBLIC__/js/jquery.scrollTo.js"></script>
<script src="__PUBLIC__/js/photo.preview.min.js"></script>
<link rel="stylesheet" href="__PUBLIC__/style/photopreview.css" />

<div class="home-info-layout">
	<div class="img-box"><img src="<?php if(strlen($user['avatar'])):?>__PUBLIC__/upload/thumb/s_{$user['avatar']}<?php else:?>__PUBLIC__/images/gender_1.gif<?php endif;?>" /></div>
	<div class="name-box">
		<h2>
			<span class="user-name">{$user['nickname']}</span>
			<span class="rz-mobile-n rz-line-25"></span>
			<span class="rz-email-n rz-line-25"></span>
		</h2>
		<p>{:age($user['birthday'])}岁|{:ProfileConst::$gender[$user['gender']]}|{:Province::getProvinceName($user['dist1'])} {:Province::getCityName($user['dist1'], $user['dist2'])} {:Province::getAreaName($user['dist1'], $user['dist2'], $user['dist3'])}</p>
		<p>{:constellation($user['birthday'])} {:ProfileConst::$marrystatus[$user['marrystatus']]} {:ProfileConst::$education[$user['education']]} {$user['height']}CM</p>
	</div>
	<div class="clear"></div>
</div>
<div class="home-time">
	最后登录时间：
	<span onclick="goUrl('/wap.php?c=cp_buy');">特权套餐可见</span>
</div>

<div class="home-tac">
	<ul>
		<li id="act_hi">打招呼</li>
		<li id="act_message">写信件</li>
		<li id="tip_listen" style="border-right:none;">
			<span onclick="addToListen();">加关注</span>
		</li>
	</ul>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	$(function(){
		var loginstatus = "1";
		$("#act_hi").click(function(){ //打招呼
			if (loginstatus == "0") {
				goUrl("/wap.php?c=passport&a=login");
				return false;
			}
			else {
				$.ajax({
					type: "POST",
					url: "/wap.php?c=cp_do",
					cache: false,
					data: {a:"hi", touid:"162361", r:"1434551482"},
					dataType: "json",
					success: function(data) {
						var json = eval(data);
						var response = json.response;
						var result = json.result;
						if (response == '1') {
							ToastShow("发送成功");
						}
						else {
							if (result.length > 0) {
								ToastShow(result);
							}
							else {
								ToastShow("发送失败");
							}
						}
					},
					error: function() {
						ToastShow("操作失败，请检查网络状态。");
					}
				});
			}
		});


		$("#act_message").click(function(){ //写信件
			if (loginstatus == "0") {
				goUrl("/wap.php?c=passport&a=login");
				return false;
			}
			else {
				goUrl("/wap.php?c=cp_do&a=writemsg&touid=162361");
			}
		});
	});

	function addToListen() { //加入关注
		$.ajax({
			type: "POST",
			url: "/wap.php?c=cp_do",
			cache: false,
			data: {a:"listen", touid:"162361", r:get_rndnum(8)},
			dataType: "json",
			success: function(data) {
				var json = eval(data);
				var response = json.response;
				var result = json.result;
				if (response == '1') {
					ToastShow("关注成功");
					$("#tip_listen").html("<span onclick='cancelListen();'>取消关注</span>");
				}
				else {
					if (result.length > 0) {
						ToastShow(result);
					}
					else {
						ToastShow("关注失败");
					}
				}
			},
			error: function() {
				ToastShow("操作失败，请检查网络状态。");
			}
		});
	}

	function cancelListen() { //取消关注
		$.ajax({
			type: "POST",
			url: "/wap.php?c=cp_do",
			cache: false,
			data: {a:"dellisten", touid:"162361", r:"1434551482"},
			dataType: "json",
			success: function(data) {
				var json = eval(data);
				var response = json.response;
				var result = json.result;
				if (response == '1') {
					ToastShow("取消成功");
					$("#tip_listen").html("<span onclick='addToListen();'>加关注</span>");
				}
				else {
					if (result.length > 0) {
						ToastShow(result);
					}
					else {
						ToastShow("取消成功");
					}
				}
			},
			error: function() {
				ToastShow("操作失败，请检查网络状态。");
			}
		});
	}

</script>



<!--//album End-->


<div class="home-data">

	<div class="home-wrap">
		<h2>内心独白</h2>
		<div class="home-itemlist">
			<p>{$user['content']}</p>
		</div>
	</div>

	<div class="home-wrap">
		<h2>择友要求</h2>
		<div class="home-itemlist">
			<ul>
				<li>年龄要求：<span><?php if($user['req_age_gt']):?>{$user['req_age_gt']}<?php else:?>不限<?php endif;?>~<?php if($user['req_age_lt']):?>{$user['req_age_lt']}<?php else:?>不限<?php endif;?>岁</span></li>
				<li>身高要求：<span><?php if($user['req_height']):?>{$user['req_height']}CM以上<?php else:?>不限<?php endif;?></span></li>
				<li>学历要求：<span><?php if($user['req_education']):?>{:ProfileConst::$education[$user['req_education']]}以上<?php else:?>不限<?php endif;?></span></li>
				<li style="border-bottom:none;">年薪要求：<span><?php if($user['req_salary']):?>{:ProfileConst::$salary[$user['req_salary']]}以上<?php else:?>不限<?php endif;?></span></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<div class="home-wrap">
		<h2>联系方式</h2>
		<div class="home-itemlist">
<!--			<p style="padding:10px;text-align:center;">互相点赞可见</p>-->
			<ul>
				<li>微信：<span>{$user['wechat']}</span></li>
				<li style="border-bottom:none;">QQ：<span>{$user['qq']}</span></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="home-wrap">
		<h2>基本资料</h2>
		<div class="home-itemlist">
			<ul>
				<li>所在地区：<span>{:Province::getProvinceName($user['dist1'])} {:Province::getCityName($user['dist1'], $user['dist2'])} {:Province::getAreaName($user['dist1'], $user['dist2'], $user['dist3'])}</span></li>
				<li>婚&#12288;&#12288;姻：<span>{:ProfileConst::$marrystatus[$user['marrystatus']]}</span></li>
				<li>交友类型：<span>{:ProfileConst::$lovesort[$user['lovesort']]}</span></li>
				<li>年&#12288;&#12288;龄：<span>{:age($user['birthday'])}岁</span></li>
				<li>身&#12288;&#12288;高：<span>{$user['height']}CM</span></li>
				<li>体&#12288;&#12288;重：<span>{$user['weight']}KG</span></li>
				<li>学&#12288;&#12288;历：<span>{:ProfileConst::$education[$user['education']]}</span></li>
				<li>学&#12288;&#12288;校：<span>{$user['school']}</span></li>
				<li>年&#12288;&#12288;薪：<span>{:ProfileConst::$salary[$user['salary']]}</span></li>
				<li>行&#12288;&#12288;业：<span>{:ProfileConst::$industry[$user['industry']]}</span></li>
				<li>职&#12288;&#12288;业：<span>{$user['job']}</span></li>
				<li style="border-bottom:none;">工作单位：<span>{$user['company']}</span></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<div class="home-wrap">
		<h2>详细资料</h2>
		<div class="home-itemlist">
			<ul>
				<li>户&#12288;&#12288;口：<span>{:Province::getProvinceName($user['hometown1'])} {:Province::getCityName($user['hometown1'], $user['hometown2'])}</span></li>
				<li>籍&#12288;&#12288;贯：<span>{:Province::getProvinceName($user['birthhometown1'])} {:Province::getCityName($user['birthhometown1'], $user['birthhometown2'])}</span></li>
				<li>婚&#12288;&#12288;姻：<span>{:ProfileConst::$marrystatus[$user['marrystatus']]}</span></li>
				<li>购房情况：<span>{:ProfileConst::$housing[$user['housing']]}</span></li>
				<li>购车情况：<span>{:ProfileConst::$caring[$user['caring']]}</span></li>
				<li>家中排行：<span>{:ProfileConst::$tophome[$user['tophome']]}</span></li>
				<li>民&#12288;&#12288;族：<span>{:ProfileConst::$national[$user['national']]}</span></li>
				<li>属&#12288;&#12288;相：<span>{:ProfileConst::$cnage[$user['cnage']]}</span></li>
				<li style="border-bottom:none;">星座：<span>{:constellation($user['birthday'])}</span></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
</div>
<include file="./Tpl/Public/footer.php"/>
</body>
</html>