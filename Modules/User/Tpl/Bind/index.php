<include file="./Tpl/Public/header.php" title="账号绑定"/>

<div class="reg-layout">
<!--	<div class="spanbtn0" id="reg_btn">我没有账号</div>-->
<!--	<div class="spanbtn0" id="bind_btn">我已经有账号</div>-->
	<h1>为了您的账号安全，我们现在需要对微信自动登陆用户进行账号绑定</h1>
	<div class="reg-wrap" id="reg_form" >
		<h2>微信用户绑定账号的作用，除了可以用微信登陆，还可以在浏览器用账号密码登陆</h2>
		<div class="reg-itemlist">
			<dl id="reg_li_username">
				<dt>用户名：</dt>
				<dd><input type="text" id="reg_username" name="reg_username" placeholder="输入用户名称" class="input" onblur="checkUserName();" /></dd>
			</dl>
			<dl style="border:none;">
				<dt>密 码：</dt>
				<dd><input type="password" id="reg_password" name="reg_password" placeholder="输入6~16位密码" class="input" /></dd>
			</dl>
			<div class="clear"></div>
		</div>
		<div class="spanbtn0" id="reg_post">下一步</div>
	</div>
<!--	<div class="reg-wrap" id="bind_form" style="display: none">-->
<!--		<h2>已有账号，输入绑定账号的用户名，密码</h2>-->
<!--		<div class="reg-itemlist">-->
<!--			<dl id="bind_li_username">-->
<!--				<dt>用户名：</dt>-->
<!--				<dd><input type="text" id="bind_username" name="bind_username" placeholder="输入用户名称" class="input" onblur="checkBindUserName();" /></dd>-->
<!--			</dl>-->
<!--			<dl style="border:none;">-->
<!--				<dt>密 码：</dt>-->
<!--				<dd><input type="password" id="bind_password" name="bind_password" placeholder="输入6~16位密码" class="input" /></dd>-->
<!--			</dl>-->
<!--			<div class="clear"></div>-->
<!--		</div>-->
<!--		<div class="spanbtn0" id="bind_post">下一步</div>-->
<!--	</div>-->
</div>

<!--//area_box ajax End-->

<include file="./Tpl/Public/footer.php"/>

<script>
	$(function(){
//		$("#reg_btn").click(function(){ //提交 下一步
//			$("#bind_form").hide();
//		});
		$("#reg_form").show();
//		$("#bind_btn").click(function(){ //提交 下一步
//			$("#reg_form").hide();
//			$("#bind_form").show();
//		});

		$("#reg_post").click(function(){
			$("#reg_post").html("注册中，请稍等...");
			var username = $("#reg_username").val();
			if (username == "") {
				ToastShow("请填写用户名");
				return false;
			}

			var password = $("#reg_password").val();
			if (password == "") {
				ToastShow("请填写登录密码");
				return false;
			}
			$.ajax({
				type: "POST",
				url: "{:U('User/Bind/reg')}",
				cache: false,
				data: {
					username:username, password:password
				},
				dataType: "json",
				success: function(data) {
					var json = eval(data);
					var response = json.response;
					var result = json.result;
					if (response == '1') {
						ToastShow("注册成功");
						setTimeout(function(){
							goUrl("{:U('User/Bind/base')}");
						}, 1000);
					}
					else {
						if (result.length > 0) {
							ToastShow(result);
						}
						else {
							ToastShow("注册失败，请检查网络...");
						}
						$("#reg_post").html("下一步");
					}
				},
				error: function() {
					ToastShow("提交失败，请检查网络...");
					$("#reg_post").html("下一步");
				}
			});
		});

		$("#bind_post").click(function(){
			$("#bind_post").html("绑定中，请稍等...");
			var username = $("#bind_username").val();
			if (username == "") {
				ToastShow("请填写绑定账号用户名");
				return false;
			}

			var password = $("#bind_password").val();
			if (password == "") {
				ToastShow("请填写绑定账号密码");
				return false;
			}
			$.ajax({
				type: "POST",
				url: "{:U('User/Bind/bind')}",
				cache: false,
				data: {
					username:username, password:password
				},
				dataType: "json",
				success: function(data) {
					var json = eval(data);
					var response = json.response;
					var result = json.result;
					if (response == '1') {
						ToastShow("绑定成功");
						setTimeout(function(){
							goUrl("{:U('User/Bind/base')}");
						}, 1000);
					}
					else {
						if (result.length > 0) {
							ToastShow(result);
						}
						else {
							ToastShow("绑定失败，请检查网络...");
						}
						$("#bind_post").html("下一步");
					}
				},
				error: function() {
					ToastShow("提交失败，请检查网络...");
					$("#bind_post").html("下一步");
				}
			});
		});
	});

	//check username
	function checkUserName() {
		var li_tips = $("#reg_li_username");
		var value = $("#reg_username").val();
		if (value == "") {
			ToastShow("用户名不能为空");
			li_tips.addClass("error-border");
			return false;
		}
		else {
			li_tips.removeClass("error-border");
		}
		$.ajax({
			type: "POST",
			url: "{:U('User/Reg/checkusername')}",
			cache: false,
			data: {username:value, r:get_rndnum(8)},
			dataType: "json",
			success: function(data) {
				var json = eval(data);
				var response = json.response;
				var result = json.result;
				if (response == '1') {
					li_tips.removeClass("error-border");
					ToastShow("用户名可用");
				}
				else {
					li_tips.addClass("error-border");
					if (result.length > 0) {
						ToastShow(result);
					}
					else {
						ToastShow("用户名不可用");
					}
				}
			},
			error: function() {
				ToastShow("提交失败，请检查网络...");
			}
		});
	}

	//check username
	function checkBindUserName() {
		var li_tips = $("#bind_li_username");
		var value = $("#bind_username").val();
		if (value == "") {
			ToastShow("用户名不能为空");
			li_tips.addClass("error-border");
			return false;
		}
		else {
			li_tips.removeClass("error-border");
		}
		$.ajax({
			type: "POST",
			url: "{:U('User/Reg/checkusername')}",
			cache: false,
			data: {username:value, r:get_rndnum(8)},
			dataType: "json",
			success: function(data) {
				var json = eval(data);
				var response = json.response;
				var result = json.result;
				if (response != '0') {
					li_tips.addClass("error-border");
					if (result.length > 0) {
						ToastShow(result);
					}
					else {
						ToastShow("用户名不存在");
					}
				}
			},
			error: function() {
				ToastShow("提交失败，请检查网络...");
			}
		});
	}
</script>

</body>
</html>
