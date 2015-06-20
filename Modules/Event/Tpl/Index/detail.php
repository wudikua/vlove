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
			<h2>参加的人(8人)</h2>
			<div class="home-itemlist">
				<ul>
					<li>男：<span>3人(剩余7人)</span></li>
					<li>
						<img width="50" height="50" src="/Public/upload/thumb/s_558455dc9fb02.jpg">
						<img width="50" height="50" src="/Public/upload/thumb/s_558455dc9fb02.jpg">
						<img width="50" height="50" src="/Public/upload/thumb/s_558455dc9fb02.jpg">
					</li>
					<li>女：<span>5人(剩余5人)</span></li>
					<li>
						<img width="50" height="50" src="/Public/upload/thumb/m_5584563ba88f1.jpg">
						<img width="50" height="50" src="/Public/upload/thumb/m_5584563ba88f1.jpg">
						<img width="50" height="50" src="/Public/upload/thumb/m_5584563ba88f1.jpg">
						<img width="50" height="50" src="/Public/upload/thumb/m_5584563ba88f1.jpg">
						<img width="50" height="50" src="/Public/upload/thumb/m_5584563ba88f1.jpg">
					</li>
				</ul>
				<div class="clear"></div>
			</div>
		</div>

		<div class="spanbtn0" style="margin-top:15px;margin-bottom:15px;" onclick="goUrl('{:U('Index/apply')}?eid={$event['_id']}');">报名参加</div>
	</div>
</div>
<include file="./Tpl/Public/footer.php"/>
</body>
</html>