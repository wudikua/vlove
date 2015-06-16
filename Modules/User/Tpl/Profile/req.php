<include file="./Tpl/Public/header.php" title="修改择偶要求"/>

<div class="cp-bartitle">择偶要求</div>

<form name="myform" id="myform" method="post" action="{:U('Profile/req')}">
	<div class="cp-layout-body">
		<div class="profile-layout">
			<ul>

				<li>
					<div class="profile-item">年&#12288;&#12288;龄：</div>
					<div class="profile-value">
						<select name='req_age_gt' id="req_age_gt">
							<option value=''>=请选择=</option>
							<?php for($i =18;$i<50; $i++):?>
								<option value='{$i}' <?php if($user['req_age_gt'] == $i):?>selected<?php endif;?>>{$i}岁</option>
							<?php endfor;?>
						</select>
						到
						<select name='req_age_lt' id="req_age_lt">
							<option value=''>=请选择=</option>
							<?php for($i =18;$i<50; $i++):?>
								<option value='{$i}' <?php if($user['req_age_lt'] == $i):?>selected<?php endif;?>>{$i}岁</option>
							<?php endfor;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">身&#12288;&#12288;高：</div>
					<div class="profile-value">
						<select name='req_height' id='height'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$height as $k=>$v):?>
							<option value='{$k}' <?php if($user['req_height'] == $k):?>selected<?php endif;?>>{$v}CM</option>
							<?php endforeach;?>
						</select>
						以上
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">学&#12288;&#12288;历：</div>
					<div class="profile-value">
						<select name='req_education'>
							<option value=''>=不限=</option>
							<?php foreach(ProfileConst::$education as $k=>$v):?>
								<option value='{$k}' <?php if($user['req_education'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
						以上
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">年&#12288;&#12288;薪：</div>
					<div class="profile-value" id="salary_text">
						<select name='req_salary' id='req_salary'>
							<option value=''>=不限=</option>
							<?php foreach(ProfileConst::$salary as $k=>$v):?>
							<option value='{$k}' <?php if($user['req_salary'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
						以上
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
		if (parseInt($("#req_age_gt").val()) > parseInt($("#req_age_lt").val())) {
			ToastShow("年龄范围填写有误");
			return false;
		}
		$("#myform").submit();
	});
</script>