<include file="./Tpl/Public/header.php" title="修改基本资料"/>

<div class="cp-bartitle">基本资料</div>

<form name="myform" id="myform" method="post" action="{:U('Profile/base')}">
	<div class="cp-layout-body">
		<div class="profile-layout">
			<ul>

				<li>
					<div class="profile-item">婚姻状况：</div>
					<div class="profile-value">
						<select name='marrystatus' id='marrystatus'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$marrystatus as $k=>$v):?>
							<option value='{$k}' <?php if($user['marrystatus'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">交友类型：</div>
					<div class="profile-value" id="lovesort_text">
						<select name='lovesort' id='lovesort'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$lovesort as $k=>$v):?>
							<option value='{$k}' <?php if($user['lovesort'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">生&#12288;&#12288;日：</div>
					<div class="profile-value">
						<input type="text" name='birthday' id='birthday' value="{$user['birthday']}" placeholder="(格式:19920501)">
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">身&#12288;&#12288;高：</div>
					<div class="profile-value">
						<select name='height' id='height'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$height as $k=>$v):?>
							<option value='{$k}' <?php if($user['height'] == $k):?>selected<?php endif;?>>{$v}CM</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">体&#12288;&#12288;重：</div>
					<div class="profile-value">
						<input type="text" name='weight' id='weight' value="{$user['weight']}" placeholder="输入体重的KG数">&nbsp;KG
					</div>
					<div class="clear"></div>
				</li>

				<li onclick="areaPopup('所在地区', 'dist');">
					<div class="profile-item">所在地区：</div>
					<div class="profile-value" id="dist_text">
						<?php echo Province::getProvinceName($user['dist1']);?>
						<?php echo Province::getCityName($user['dist1'], $user['dist2']);?>
						<?php echo Province::getAreaName($user['dist1'], $user['dist2'], $user['dist3']);?>
					</div>
					<div class="clear"></div>
					<input type="hidden" name="dist1" id="dist1" value="{$user['dist1']}" />
					<input type="hidden" name="dist2" id="dist2" value="{$user['dist2']}" />
					<input type="hidden" name="dist3" id="dist3" value="{$user['dist3']}" />
				</li>

				<li>
					<div class="profile-item">学&#12288;&#12288;历：</div>
					<div class="profile-value">
						<select name='education'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$education as $k=>$v):?>
								<option value='{$k}' <?php if($user['education'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">学&#12288;&#12288;校：</div>
					<div class="profile-value">
						<input type="text" name='school' id='school' value="{$user['school']}">
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">年&#12288;&#12288;薪：</div>
					<div class="profile-value" id="salary_text">
						<select name='salary' id='salary'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$salary as $k=>$v):?>
							<option value='{$k}' <?php if($user['salary'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>


				<li>
					<div class="profile-item">行&#12288;&#12288;业：</div>
					<div class="profile-value" id="industry_text">
						<select name='industry' id='industry'>
							<option value=''>=请选择=</option>
							<?php foreach(ProfileConst::$industry as $k=>$v):?>
							<option value='{$k}' <?php if($user['industry'] == $k):?>selected<?php endif;?>>{$v}</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">职&#12288;&#12288;业：</div>
					<div class="profile-value">
						<input type="text" name='job' id='job' value="{$user['job']}" placeholder="职业">
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="profile-item">工作单位：</div>
					<div class="profile-value">
						<input type="text" name='company' id='company' value="{$user['company']}" placeholder="工作单位">
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