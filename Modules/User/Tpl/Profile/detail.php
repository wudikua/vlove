<include file="./Tpl/Public/header.php" title="修改详细资料"/>

<div class="cp-bartitle">详细资料</div>

<form name="myform" id="myform" method="post" action="{:U('Profile/detail')}">
	<div class="cp-layout-body">
		<div class="profile-layout">
			<ul>


				<li onclick="hometownPopup('户口', 'hometown');">
					<div class="profile-item">户&#12288;&#12288;籍：</div>
					<div class="profile-value" id="hometown_text">
						<?php if ($user['hometown1']):?>
						<?php echo Province::getProvinceName($user['hometown1']);?>
						<?php echo Province::getCityName($user['hometown1'], $user['hometown2']);?>
						<?php else:?>
						请填写
						<?php endif;?>
					</div>
					<div class="clear"></div>
					<input type="hidden" name="hometown1" id="hometown1" value="{$user['hometown1']}" />
					<input type="hidden" name="hometown2" id="hometown2" value="{$user['hometown2']}" />
				</li>


				<li>
					<div class="profile-item">住房情况：</div>
					<div class="profile-value" id="housing_text">
						<select name='housing' id='housing'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$housing as $k=>$v):?>
							<option value='{$k}' <?php if($user['housing'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">购车情况：</div>
					<div class="profile-value" id="caring_text">
						<select name='caring' id='caring'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$caring as $k=>$v):?>
							<option value='{$k}' <?php if($user['caring'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">家中排行：</div>
					<div class="profile-value" id="tophome_text">
						<select name='tophome' id='tophome'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$tophome as $k=>$v):?>
								<option value='{$k}' <?php if($user['tophome'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>


				<li>
					<div class="profile-item">民&#12288;&#12288;族：</div>
					<div class="profile-value" id="national_text">
						<select name='national' id='national'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$national as $k=>$v):?>
								<option value='{$k}' <?php if($user['national'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">属&#12288;&#12288;像：</div>
					<div class="profile-value" id="cnage_text">
						<select name='cnage' id='cnage'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$cnage as $k=>$v):?>
								<option value='{$k}' <?php if($user['cnage'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>

			</ul>
			<div class="clear"></div>
		</div>
		<!--//profile-layout End-->

		<div class="spanbtn0" id="btn_post">保存修改</div>
	</div>
</form>
<!--//cp-layout-body End-->

<div id="varpop_shade" class="varpop-shade"></div>

<div class="varpop-layout" id='area_box'>
	<div class="varpop-head">
		<span id="area_title">选择</span>
		<i id="area_loading">loading...</i>
	</div>
	<div id="area_data"></div>
	<!--//area_data End-->
</div>
<!--//area_box ajax End-->

<div class="varpop-layout" id='hometown_box'>
	<div class="varpop-head">
		<span id="hometown_title">选择</span>
		<i id="hometown_loading">loading...</i>
	</div>
	<div id="hometown_data"></div>
</div>
<!--//hometown ajax End-->

<include file="./Tpl/Public/footer.php"/>

</body>
</html>
<script type="text/javascript">
	$("#btn_post").click(function(){
		if ($("#marrystatus").val() == "") {
			ToastShow("请选择婚姻状况");
			return false;
		}

		if ($("#jobs").val() == "") {
			ToastShow("请选择职业");
			return false;
		}

		$("#myform").submit();
	});
</script>