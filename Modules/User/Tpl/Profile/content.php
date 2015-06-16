<include file="./Tpl/Public/header.php" title="内心独白"/>
<div class="cp-bartitle">内心独白</div>

<form name="myform" id="myform" method="post" action="{:U('Profile/content')}">
	<div class="cp-layout-body-gray">
		<div class="item-wrap">
			<h2>独白不能出现联系方式，否则无法通过。</h2>
			<div class="item-list">
				<p><textarea name="content" id="content" style="height:150px;">{$user['content']}</textarea></p>
			</div>
		</div>
		<div class="hr-t"></div>
		<div class="spanbtn0" id="btn_post">提交保存</div>
		<div class="hr-b"></div>
	</div>
</form>

<include file="./Tpl/Public/footer.php"/>

<script type="text/javascript">
	$("#btn_post").click(function(){
		if ($("#content").val() == "") {
			ToastShow("请填写内心独白");
			return false;
		}
		$("#myform").submit();
	});
</script>
</body>
</html>
