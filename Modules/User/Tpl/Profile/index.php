<include file="./Tpl/Public/header.php" title="修改资料"/>

<div class="cp-bartitle">修改资料</div>

<div class="cp-layout-body-gray">

	<div class="cp-index-bar">
		<ul>
			<li onclick="goUrl('{:U('Profile/base')}');"><i class="mob_pro_01"></i>基本资料</li>
			<li onclick="goUrl('{:U('Profile/detail')}');"><i class="mob_pro_10"></i>详细资料</li>
		</ul>
		<div class="clear"></div>
	</div>

	<div class="cp-index-bar" style="margin-top:20px;">
		<ul>
			<li onclick="goUrl('/wap.php?c=cp_info&a=monolog');"><i class="mob_pro_04"></i>内心独白</li>
		</ul>
		<div class="clear"></div>
	</div>

	<div class="cp-index-bar" style="margin-top:20px;">
		<ul>
			<li onclick="goUrl('/wap.php?c=cp_info&a=interest');"><i class="mob_pro_07"></i>兴趣爱好</li>
			<li onclick="goUrl('/wap.php?c=cp_info&a=contact');" style="border-bottom:none;"><i class="mob_pro_08"></i>联系方式</li>
		</ul>
		<div class="clear"></div>
	</div>
</div>

<include file="./Tpl/Public/footer.php"/>
</body>
</html>