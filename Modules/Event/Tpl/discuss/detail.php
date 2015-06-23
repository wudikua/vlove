<include file="./Tpl/Public/header.php" title="讨论"/>
<div class="cp-layout-body-gray">
	<div class="item-wrap">
		<div class="art_tit"><span>标题</span>{$post['title']}</div>
		<div class="landlord">
			<a href="javascript:userDetail('{:(string)$post['user']['_id']}');" class="landmsg">
				<img src="<?php if(strlen($post['user']['avatar'])):?>__PUBLIC__/upload/thumb/s_{$post['user']['avatar']}<?php else:?>__PUBLIC__/images/gender_1.gif<?php endif;?>" style="display: inline; visibility: visible;">
				<p>{$post['user']['nickname']}<em>楼主</em></p>
				<span>
					浏览：{$post['view']}&nbsp;&nbsp;&nbsp;发布时间：{:date('m-d H:i', $post['time'])}
				</span>
			</a>
		</div>
	</div>
	<div class="item-wrap">
		<div class="replyBox">
			<p>{$post['content']}</p>
		</div>
	</div>
	<?php foreach($comments as $i=>$comment):?>
	<div class="item-wrap">
	<div class="replyBox">
		<div class="clear">
			<a href="javascript:void(0);" class="reBoxLink">
				<img src="" style="display: inline; visibility: visible;"><p> {$comment['user']['nickname']}<em>{$i}#</em></p>
				<span><i></i>{:date('m-d H:i', $comment['time'])}</span>
			</a>
		</div>
		<div class="reBoxWho">
			<img src="<?php if(strlen($comment['user']['avatar'])):?>__PUBLIC__/upload/thumb/s_{$comment['user']['avatar']}<?php else:?>__PUBLIC__/images/gender_1.gif<?php endif;?>" smilieid="12" border="0" alt="" style="display: inline; visibility: visible;">
			{$comment['content']}
		</div>
	</div>
	</div>
	<?php endforeach;?>
	<div class="hr-t"></div>
	<div class="spanbtn0" style="margin-top:15px;margin-bottom:15px;">评论</div>
	<div class="hr-b"></div>
</div>
<include file="./Tpl/Public/footer.php"/>
</body>
</html>