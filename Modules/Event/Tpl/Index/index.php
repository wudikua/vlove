<include file="./Tpl/Public/header.php" title="活动"/>
<div class="layout-body">
	<div class="user-list">
		<ul id="json_data">
		<?php if (count($events)==0):?>
			<h6><div>目前还没有活动</div><div>活动承办商请与我们联系</div></h6>
		<?php else:?>
			<?php foreach($events as $event):?>
				<li onclick="eventDetail('{:(string)$event['_id']}');">
					<?php if ($event['status'] == EventBaseAction::$EVENT_STATUS_OPEN):?>
					<div class="opage_tag pa" style="background:url(__PUBLIC__/images/green.png) left top no-repeat;">
						报名中
					</div>
					<?php elseif($event['status'] == EventBaseAction::$EVENT_STATUS_FULL):?>
					<div class="opage_tag pa" style="background:url(__PUBLIC__/images/red.png) left top no-repeat;">
						已满
					</div>
					<?php elseif($event['status'] == EventBaseAction::$EVENT_STATUS_CLOSE):?>
					<div class="opage_tag pa" style="background:url(__PUBLIC__/images/yellow.png) left top no-repeat;">
						已结束
					</div>
					<?php endif;?>

					<img class="userlist-img" src="<?php if(strlen($user['cover'])):?>__PUBLIC__/upload/thumb/s_{$user['cover']}<?php else:?>__PUBLIC__/images/gender_1.gif<?php endif;?>" />
					<div class="user-inner">
						<h5>{$event['title']}</h5>
						<p>时间：<span>{:interval2date($event['start_time'], $event['end_time'])}</span></p>
						<p>地点：
							<span>{:Province::getProvinceName($event['dist1'])} {:Province::getCityName($event['dist1'], $event['dist2'])} {:Province::getAreaName($event['dist1'], $event['dist2'], $event['dist3'])}</span>
						</p>
						<p>费用：<span>{$event['fee']}元</span></p>
					</div>
				</li>
			<?php endforeach;?>
		<?php endif;?>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="page-layout">
		{$page}
	</div>

</div>
<include file="./Tpl/Public/footer.php"/>
</body>
</html>