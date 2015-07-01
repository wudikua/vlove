<include file="./Tpl/Public/header.php" title="首页"/>
<div class="cp-layout-body-gray">
	<div class="item-wrap">
		<div class="art_tit">关于申请微信公众平台群发</div>
	</div>
	<div class="item-wrap">
		<div class="replyBox">
			<p style="line-height: 20px;">1.需要先进行注册</p>
			<p style="line-height: 20px;">2.注册以后请上传头像和照片</p>
			<p style="line-height: 20px;">3.需要填写基本资料，详细资料，择偶要求</p>
			<p style="line-height: 20px;">4.务必保证联系方式三种一直填写正确，这样方便客服沟通，在最后群发前会让您重新review</p>
			<p style="line-height: 20px;">5.如果考虑到资料中有些隐私或者特殊要求请在以下特殊要求写清</p>
			<p style="line-height: 20px;">6.任何问题都可以直接回复微信进行咨询</p>
		</div>
	</div>
	<form action="{:U('User/Profile/push')}" method="post" enctype="multipart/form-data" name="post_form" id="post_form">
		<div class="item-wrap">
			<h2>特殊要求：</h2>
			<div class="item-list">
				<p><textarea name="content" id="content" style="height:150px;"></textarea></p>
			</div>
		</div>
		<div class="cp-layout-body-gray">
			<div class="hr-t"></div>
			<div class="spanbtn0" id="btn_post" style="margin-top:15px;margin-bottom:15px;">申请推送</div>
			<div class="hr-b"></div>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(function(){
		//提交上传
		$("#btn_post").click(function(){
			$("#post_form").submit();
		});
	});
</script>
<include file="./Tpl/Public/footer.php"/>
</body>
</html>