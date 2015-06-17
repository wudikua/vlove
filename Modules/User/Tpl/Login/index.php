<include file="./Tpl/Public/header.php" title="会员登录"/>

<form name="login_form" id="login_form" action="{:U('Login/index')}" method="post">
	<div class="layout-body">
		<div class="login-box">
			<h2>会员登录</h2>
			<ul>
				<li style="margin-bottom:15px;">
					<i>帐号</i>
					<input type="text" id="loginname" name="loginname" placeholder="输入用户名或者邮箱" />
				</li>
				<li>
					<i>密码</i>
					<input type="password" id="password" name="password" placeholder="输入登录密码" />
				</li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="hr-t"></div>
		<div class="spanbtn0" id="btn_login">立即登录</div>
		<div class="hr-b"></div>
		<div class="login-tips" onclick="goUrl('{:U('Reg/index')}');">没有帐号？点击注册。</div>
	</div>
</form>

<include file="./Tpl/Public/footer.php"/>

<script type="text/javascript">
	var forward = "http%3A%2F%2Fzhw5.3.77q3.com%2Fwap.php";
	$(function(){
		$("#btn_login").click(function(){ //登录
			var loginname = $("#loginname").val();
			var password = $("#password").val();
			if (loginname == '') {
				ToastShow("登录帐号不能为空");
				return false;
			}
			if (password == '') {
				ToastShow("登录密码不为空");
				return false;
			}
			$("#login_form").submit();
		});

	});
</script>
</body>
</html>
