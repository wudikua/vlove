<include file="./Tpl/Public/header.php" title="活动讨论"/>
<div class="layout-body">
	<div class="cp-bartitle">“{$event['title']}”讨论组<b><a href="{:U('Discuss/post')}?eid={$eid}">发布新话题</a></b></div>
	<div class="user-list">
		<ul id="json_data">
			<?php if (count($posts)==0):?>
				<h6><div>目前还没有讨论话题</div><div>试试发布话题</div></h6>
			<?php else:?>
				<?php foreach($posts as $post):?>
					<li onclick="postDetail('{:(string)$post['_id']}');">
						<img onclick="user(event, '{:(string)$post['user']['_id']}')" class="userlist-img" src="__PUBLIC__/upload/thumb/s_{$post['user']['avatar']}">
						<div class="user-inner">
							<h5>{$post['title']}</h5>
							<p>浏览：<span>{:intval($post['view'])}次</span></p>
							<p>时间：<span>{:date('m-d H:i', $post['time'])}</span></p>
							<p>发布者：<span>{$post['user']['nickname']}</span></p>
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
<script>
	function user(event, id) {
		userDetail(id);
		event.stopPropagation();
	}
</script>
</body>
</html>
