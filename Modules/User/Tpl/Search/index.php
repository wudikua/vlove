<include file="./Tpl/Public/header.php" title="搜索结果"/>
<div class="hr-shadow"></div>
<div class="tab-layout">
	<ul>
		<li style="width:50%" class="tab-selected">搜索结果</li>
		<li onclick="goUrl('{:U('Search/filter')}');" style="width:50%">条件搜索</li>
	</ul>
	<div class="clear"></div>
</div>

<div class="layout-body">
	<div class="user-list">
		<ul id="json_data">
			<?php if (count($users)==0):?>
			<h6><div>目前已经没有更多会员了。</div><div>您可以尝试放宽择偶条件进行搜索。</div></h6>
			<?php else:?>
			<?php foreach($users as $user):?>
			<li onclick="userDetail('{:(string)$user['_id']}');">
				<img class="userlist-img" src="<?php if(strlen($user['avatar'])):?>__PUBLIC__/upload/thumb/s_{$user['avatar']}<?php else:?>__PUBLIC__/images/gender_1.gif<?php endif;?>" />
				<div class="user-inner">
					<h5>{$user['nickname']}<span>{:ProfileConst::$gender[$user['gender']]}</span></h5>
					<p>
						{:age($user['birthday'])} | {:ProfileConst::$marrystatus[$user['marrystatus']]} | {$user['height']}CM<br />
						{:constellation($user['birthday'])} {:Province::getProvinceName($user['dist1'])} {:Province::getCityName($user['dist1'], $user['dist2'])} {:Province::getAreaName($user['dist1'], $user['dist2'], $user['dist3'])}
					</p>
					<p>
						{:ProfileConst::$education[$user['education']]}
					</p>
				</div>
			</li>
			<?php endforeach;?>
			<?php endif;?>
		</ul>
		<div class="clear"></div>
	</div>
	<!--//list End-->
	<div class="page-layout">
		{$page}
	</div>
	<!--//ShowPage End-->

</div>

<include file="./Tpl/Public/footer.php"/>


</body>
</html>