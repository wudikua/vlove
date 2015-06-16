<include file="./Tpl/Public/header.php" title="内心独白"/>
<div class="cp-bartitle">联系方式</div>

<form name="myform" id="myform" method="post" action="{:U('Profile/contact')}">
	<div class="cp-layout-body-gray">
		<div class="item-wrap">
			<div class="item-list">
				<dl>
					<dt>手机号码：</dt>
					<dd><input type="text" name="mobile" id="mobile" value="{$user['mobile']}" /></dd>
				</dl>
				<dl>
					<dt>QQ号码：</dt>
					<dd><input type="text" name="qq" id="qq" value="{$user['qq']}" /></dd>
				</dl>
				<dl>
					<dt>微信号：</dt>
					<dd><input type="text" name="wechat" id="wechat" value="{$user['wechat']}" /></dd>
				</dl>
				<div class="clear"></div>
			</div>
		</div>
		<div class="hr-t"></div>
		<div class="spanbtn0" id="btn_post">提交保存</div>
		<div class="hr-b"></div>
	</div>
</form>

<include file="./Tpl/Public/footer.php"/>

</body>
</html>
<script type="text/javascript">
	$("#btn_post").click(function(){
		$("#myform").submit();
	});
</script>
