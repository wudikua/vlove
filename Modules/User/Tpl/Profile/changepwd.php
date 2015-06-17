<include file="./Tpl/Public/header.php" title="修改密码"/>
<div class="cp-layout-body-gray">

	<div class="item-wrap">
		<h2>修改密码</h2>
		<div class="item-list">
			<dl>
				<dt>旧密码：</dt>
				<dd><input type="password" name="oldpassword" id="oldpassword" maxlength="16" placeholder="输入旧密码" /></dd>
			</dl>
			<dl>
				<dt>新密码：</dt>
				<dd><input type="password" name="newpassword" id="newpassword" maxlength="16" placeholder="输入6~16位的新密码" /></dd>
			</dl>
			<dl style="border-bottom:none;">
				<dt>确认密码：</dt>
				<dd><input type="password" name="confirmpassword" id="confirmpassword" maxlength="16" placeholder="再次输入新密码" /></dd>
			</dl>
			<div class="clear"></div>
		</div>
	</div>
	<div class="hr-t"></div>
	<div class="spanbtn0" id="btn_post">确定修改</div>
	<div class="hr-b"></div>

</div>

<include file="./Tpl/Public/footer.php"/>

<script type="text/javascript">
	$(function(){
		$("#btn_post").click(function(){
			var oldpwd = $("#oldpassword").val();
			var newpwd = $("#newpassword").val();
			var confirmpwd = $("#confirmpassword").val();
			if (oldpwd == "") {
				ToastShow("请输入旧密码");
				return false;
			}
			if (newpwd == "") {
				ToastShow("请输入6-16位的新密码");
				return false;
			}
			if (confirmpwd != newpwd) {
				ToastShow("确认密码不正确");
				return false;
			}
			//save
			$.ajax({
				type: "POST",
				url: "{:U('Profile/changepwd')}",
				cache: false,
				data: {oldpassword:oldpwd, newpassword:newpwd, confirmpassword:confirmpwd, r:get_rndnum(8)},
				dataType: "json",
				success: function(data) {
					var json = eval(data);
					var response = json.response;
					var result = json.result;
					if (response == '1') {
						ToastShow("修改成功");
						setTimeout(function(){
							goUrl("{:U('Index/index')}")
						}, 1000);
					}
					else {
						if (result.length > 0) {
							ToastShow(result);
						}
						else {
							ToastShow("修改失败，请检查网络...");
						}
					}
				},
				error: function() {
					ToastShow("修改失败，请检查网络...");
				}
			});

		});
	});
</script>
</body>
</html>
