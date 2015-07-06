<include file="./Tpl/Public/header.php" title="首页"/>
<div style="text-align: center">
	<h1 style="font-size: 25px;">排行</h1>
<?php foreach($users as $user):?>
	<h3>
		<span>
			<img src="<?php if(strlen($user['avatar'])):?>__PUBLIC__/upload/thumb/s_{$user['avatar']}<?php else:?>__PUBLIC__/images/gender_1.gif<?php endif;?>" />
		</span>
		<span>{$user['nickname']}</span>
		<span>{$user['score']}分</span>
		<br>
	</h3>
<?php endforeach;?>
</div>
<include file="./Tpl/Public/footer.php"/>
</body>
</html>