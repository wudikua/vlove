<include file="./Tpl/Public/header.php" title="用户搜索"/>
<div class="hr-shadow"></div>
<div class="tab-layout">
	<ul>
		<li onclick="goUrl('{:U('Search/index')}');" style="width:50%">搜索结果</li>
		<li class="tab-selected" style="width:50%">条件搜索</li>
	</ul>
	<div class="clear"></div>
</div>

<form name="search_form" id="search_form" action="{:U('Search/filter')}" method="post">
	<div class="adv-search">
		<dl>
			<dt>地&#12288;区：</dt>
			<dd>
				<span onclick="areaPopup('选择地区', 's_dist');" id="s_dist_text">
					<?php if(!$user['s_dist1']) :?>
						选择
					<?php else:?>
					<?php echo Province::getProvinceName($user['s_dist1']);?>
					<?php echo Province::getCityName($user['s_dist1'], $user['s_dist2']);?>
					<?php echo Province::getAreaName($user['s_dist1'], $user['s_dist2'], $user['s_dist3']);?>
					<?php endif;?>
				</span>
				<input type="hidden" name="s_dist1" id="s_dist1" value="0" />
				<input type="hidden" name="s_dist2" id="s_dist2" value="0" />
				<input type="hidden" name="s_dist3" id="s_dist3" value="0" />
			</dd>
			<div class="clear"></div>
		</dl>

		<dl>
			<dt>头&#12288;像：</dt>
			<dd>
				<select name='s_avatar' id='s_avatar'>
					<option value=''>不限</option>
					<option value='1' <?php if ($user['s_avatar']):?>selected<?php endif;?>>有</option>
				</select>
			</dd>
			<div class="clear"></div>
		</dl>

		<dl>
			<dt>年&#12288;龄：</dt>
			<dd>
				<select name='s_age_gt' id='s_age_gt'>
					<option value=''>=不限=</option>
					<?php for($i =18;$i<50; $i++):?>
						<option value='{$i}' <?php if($user['s_age_gt'] == $i):?>selected<?php endif;?>>{$i}岁</option>
					<?php endfor;?>
				</select> 岁
				<select name='s_age_lt' id='s_age_lt'>
					<option value=''>=不限=</option>
					<?php for($i =18;$i<50; $i++):?>
						<option value='{$i}' <?php if($user['s_age_lt'] == $i):?>selected<?php endif;?>>{$i}岁</option>
					<?php endfor;?>
				</select> 岁
			</dd>
			<div class="clear"></div>
		</dl>

		<dl>
			<dt>身&#12288;高：</dt>
			<dd>
				<select name='s_height' id='s_height'>
					<option value=''>=不限=</option>
					<?php foreach(ProfileConst::$height as $k=>$v):?>
						<option value='{$k}' <?php if($user['s_height'] == $k):?>selected<?php endif;?>>{$v}CM</option>
					<?php endforeach;?>
				</select> CM以上
			</dd>
			<div class="clear"></div>
		</dl>

		<dl>
			<dt>学&#12288;历：</dt>
			<dd>
				<select name='s_education' id='s_education'>
					<option value=''>=不限=</option>
					<?php foreach(ProfileConst::$education as $k=>$v):?>
						<option value='{$k}' <?php if($user['s_education'] == $k):?>selected<?php endif;?>>{$v}</option>
					<?php endforeach;?>
				</select>
			</dd>
			<div class="clear"></div>
		</dl>

		<dl>
			<dt>年&#12288;薪：</dt>
			<dd>
				<select name='s_salary' id='s_salary'>
					<option value=''>=不限=</option>
					<?php foreach(ProfileConst::$salary as $k=>$v):?>
						<option value='{$k}' <?php if($user['s_salary'] == $k):?>selected<?php endif;?>>{$v}</option>
					<?php endforeach;?>
				</select>
			</dd>
			<div class="clear"></div>
		</dl>

		<dl>
			<dt>住房情况：</dt>
			<dd>
				<select name='s_housing' id='s_housing'>
					<option value=''>=不限=</option>
					<?php foreach(ProfileConst::$housing as $k=>$v):?>
						<option value='{$k}' <?php if($user['s_housing'] == $k):?>selected<?php endif;?>>{$v}</option>
					<?php endforeach;?>
				</select>
			</dd>
			<div class="clear"></div>
		</dl>

		<dl style="border-bottom:none;">
			<dt>购车情况：</dt>
			<dd>
				<select name='s_caring' id='s_caring'>
					<option value=''>=不限=</option>
					<?php foreach(ProfileConst::$caring as $k=>$v):?>
						<option value='{$k}' <?php if($user['s_caring'] == $k):?>selected<?php endif;?>>{$v}</option>
					<?php endforeach;?>
				</select>
			</dd>
			<div class="clear"></div>
		</dl>

		<div class="clear"></div>
	</div>
</form>
<div class="spanbtn0" id="btn_submit">立即搜索</div>
<script type="text/javascript">
	$("#btn_submit").click(function(){
		$("#search_form").submit();
	});
</script>
<div class="hr-b"></div>


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


<include file="./Tpl/Public/footer.php"/>

</body>
</html>