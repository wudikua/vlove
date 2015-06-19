<include file="./Tpl/Public/header.php" title="用户中心"/>

<div class="cp-layout-body">

	<div class="cp-data">
		<div class="cp-data-avatar">
			<img id="avatar_tips" src="<?php if(strlen($user['avatar'])):?>__PUBLIC__/upload/thumb/s_{$user['avatar']}<?php else:?>__PUBLIC__/images/gender_1.gif<?php endif;?>" />
			<i>
				点击上传
			</i>
		</div>
		<div class="cp-data-info">
			<h2>
				<span class="user-name">{$user['nickname']}</span>
				<span class="rz-mobile-n rz-line-30"></span>
				<span class="rz-email-n rz-line-30"></span>
			</h2>
			<ul>
				<li>
					{:age($user['birthday'])}岁 {:ProfileConst::$gender[$user['gender']]}
					{:Province::getProvinceName($user['dist1'])}
					{:Province::getCityName($user['dist1'], $user['dist2'])}
					{:Province::getAreaName($user['dist1'], $user['dist2'], $user['dist3'])}
				</li>
				<li>
					{:constellation($user['birthday'])}
					{:ProfileConst::$marrystatus[$user['marrystatus']]}
					{:ProfileConst::$industry[$user['industry']]}
				</li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div><!--//cp-data End-->

	<form action="{:U('Photo/avatar')}" method="post" enctype="multipart/form-data" name="upload_form" id="upload_form" target="uploadiframe" style="display:none;">
		<div class="cp-avatar-upload">
			<ul>
				<li>
					<i>本地头像：</i>
					<span class="input-file" id="input_file">选择照片</span>
					<div class="clear"></div>
					<input type="file" name="image" id="fileurl" style="display:none;" />
				</li>
			</ul>
			<div class="clear"></div>
			<div class="spanbtn0" style="margin-top:10px;margin-bottom:10px;" id="btn_upload">上传头像</div>
		</div>
		<iframe name="uploadiframe" id="uploadiframe" style="display:none;"></iframe>
	</form>
	<script type="text/javascript">
		$(function(){
			$("#avatar_tips").click(function(){
				if (document.getElementById("upload_form").style.display == "none") { //展开
					$("#upload_form").show();
				}
				else { //隐藏
					$("#upload_form").hide();
				}
			});

			$("#input_file").click(function(){ //选择照片
				$("#fileurl").trigger('click');
			});

			$("#fileurl").bind("change", function(){ //选择照片后提示
				$("#input_file").html("已选，重选");
			});

			//提交上传
			$("#btn_upload").click(function(){
				var file = $("#fileurl");
				var file_val = $("#fileurl").val();
				var img_size = 0;
				var max_size = 2*1024*1024;
				if (file_val == "") {
					ToastShow("请选择要上传的头像");
					return false;
				}
				if(!/.(gif|jpg|jpeg|png)$/.test(file_val)){
					ToastShow("头像格式不正确");
					return false;
				}
				img_size = file[0].files[0].size;
				if (img_size > max_size) {
					ToastShow("头像大小不能超过2M");
					return false;
				}
				$("#btn_upload").html("上传中，请稍等...");
				$("#upload_form").submit();
			});
		});
		//iframe callback parent.uploadCallBack();
		function uploadCallBack(res, msg) {
			if (res == "1") {
				ToastShow("上传成功");
				setTimeout(function(){
					$("#upload_form").remove();
					window.location.reload();
				}, 1000);

			}
			else {
				$("#btn_upload").html("上传头像");
				$("#input_file").html("选择照片");
				if (msg.length >0) {
					ToastShow(msg);
				}
				else {
					ToastShow("上传失败，请检查网络情况。");
				}
			}
		}
	</script>

	<div class="cp-data-tips">
		可用金币：<font color="green">0.00</font>
	</div>
</div>


<div class="cp-layout-body-gray">
	<div class="cp-index-bar">
		<ul>
			<li onclick="goUrl('{:U('Photo/index')}');"><i class="mob_icon_02"></i>我的相片</li>
			<li onclick="goUrl('{:U('Profile/index')}');"><i class="mob_icon_03"></i>修改资料</li>
		</ul>
		<div class="clear"></div>
	</div>

	<div class="cp-index-bar" style="margin-top:20px;">
		<ul>
<!--			<li onclick="goUrl('/wap.php?c=cp_message');"><i class="mob_icon_05"></i>我的信件</li>-->
<!--			<li onclick="goUrl('/wap.php?c=cp_inhi');"><i class="mob_icon_06"></i>收到问候<span>2</span></li>-->
<!--			<li onclick="goUrl('/wap.php?c=cp_listen');"><i class="mob_icon_07"></i>我的关注</li>-->
<!--			<li onclick="needBuyVip();" style="border-bottom:none;"><i class="mob_icon_08"></i>谁看过我-->
<!--				<div class="cp-vip-lock"></div>-->
<!--			</li>-->
		</ul>
		<div class="clear"></div>
	</div>


	<div class="cp-index-bar" style="margin-top:20px;">
		<ul>
			<li onclick="goUrl('{:U('Profile/changepwd')}');" style="border-bottom:none;">&#12288;修改密码</li>
		</ul>
		<div class="clear"></div>
	</div>

	<div class="spanbtn0" style="margin-top:15px;margin-bottom:15px;" id="btn_logout" onclick="goUrl('{:U('Profile/logout')}');">退出登录</div>
</div>

<script type="text/javascript">
	//跳到购买中心
	function needBuyVip() {
		ToastShow("没有使用特权，请购买会员等级。");
		setTimeout(function(){
			goUrl("/wap.php?c=cp_buy");
		}, 1000);
	}
</script>

<include file="./Tpl/Public/footer.php"/>

</body>
</html>
