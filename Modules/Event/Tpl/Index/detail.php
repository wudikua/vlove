<include file="./Tpl/Public/header.php" title="活动"/>

<div class="home-data">
		<div class="home-wrap">
			<h2>活动介绍</h2>
			<div class="home-itemlist">
				<ul>
					<li>时间：<span>{:interval2date($event['start_time'], $event['end_time'])}</span></li>
					<li>地点：
						<p>{$event['dest']}</p>
					</li>
					<li>要求：
						{$event['require']}
					</li>
					<li>费用：<span>{$event['fee']}元</span></li>
					<li>流程：
						{$event['detail']}
					</li>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
		<div class="home-wrap">
			<h2>参加的人({:count($applyFemale)+count($applyMale)}人)</h2>
			<div class="home-itemlist">
				<ul>
					<li>男：<span>{:count($applyMale)}人</span></li>
					<li>
						<?php if(count($applyMale) == 0):?>
							还没有男生参加，快来抢沙发
						<?php else:?>
						<?php foreach($applyMale as $uid=>$info):?>
						<a onclick="userDetail('<?php if($uid == EventBaseAction::$EVENT_APPLY_PASS):?>{$uid}<?php endif;?>')">
							<img width="50" height="50" src="/Public/upload/thumb/s_{$info['avatar']}">
						</a>
						<?php endforeach;?>
						<?php endif;?>
					</li>
					<li>女：<span>{:count($applyFemale)}人</span></li>
					<li>
						<?php if(count($applyFemale) == 0):?>
							还没有女生参加，快来抢沙发
						<?php else:?>
						<?php foreach($applyFemale as $uid=>$info):?>
							<a onclick="userDetail('<?php if($uid == EventBaseAction::$EVENT_APPLY_PASS):?>{$uid}<?php endif;?>')">
								<img width="50" height="50" src="/Public/upload/thumb/s_{$info['avatar']}">
							</a>
						<?php endforeach;?>
						<?php endif;?>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
		<?php if($myApplyStatus == EventBaseAction::$EVENT_APPLY_WAIT):?>
			<div class="spanbtn0" style="margin-top:15px;margin-bottom:15px;">已经申请，等待确认</div>
		<?php elseif($myApplyStatus == EventBaseAction::$EVENT_APPLY_PASS):?>
			<div class="spanbtn0" style="margin-top:15px;margin-bottom:15px;">您的活动申请已通过</div>
		<?php elseif($myApplyStatus == EventBaseAction::$EVENT_APPLY_REJECT):?>
			<div class="spanbtn0" style="margin-top:15px;margin-bottom:15px;">您的活动申请被拒绝</div>
		<?php elseif($event['status'] == EventBaseAction::$EVENT_STATUS_OPEN):?>
			<div class="spanbtn0" style="margin-top:15px;margin-bottom:15px;" onclick="goUrl('{:U('Index/apply')}?eid={$event['_id']}');">报名参加</div>
		<?php elseif($event['status'] == EventBaseAction::$EVENT_STATUS_FULL):?>
			<div class="spanbtn0" style="margin-top:15px;margin-bottom:15px;">活动报名已满</div>
		<?php else:?>
			<div class="spanbtn0" style="margin-top:15px;margin-bottom:15px;">活动结束</div>
		<?php endif;?>
	</div>
</div>
<include file="./Tpl/Public/footer.php"/>
</body>
</html>