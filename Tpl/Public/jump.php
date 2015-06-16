<include file="./Tpl/Public/header.php" title="信息提示"/>
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
				}, 1500);
			});
		</script>
		<span onclick="goUrl('{$jumpUrl}');">如果没有跳转，点击这里。</span>
	</p>
</div>
<include file="./Tpl/Public/footer.php"/>
</body>
</html>