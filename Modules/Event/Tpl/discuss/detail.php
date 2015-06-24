<include file="./Tpl/Public/header.php" title="{$post['title']}"/>
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
	<?php $index=0;?>
	<?php foreach($comments as $comment):?>
	<div class="item-wrap">
	<div class="replyBox">
		<div style="overflow: hidden">
			<a href="javascript:void(0);" class="reBoxLink">
				<img src="<?php if(strlen($comment['user']['avatar'])):?>__PUBLIC__/upload/thumb/s_{$comment['user']['avatar']}<?php else:?>__PUBLIC__/images/gender_1.gif<?php endif;?>" style="display: inline; visibility: visible;">
				<p> {$comment['user']['nickname']}<em>{++$index}#</em></p>
				<span>{:date('m-d H:i', $comment['time'])}</span>
			</a>
		</div>
		<div class="reBoxWho">
			{$comment['content']}
		</div>
	</div>
	</div>
	<?php endforeach;?>
	<form action="{:U('Discuss/comment')}" method="post" enctype="multipart/form-data" name="post_form" id="post_form">
		<input type="hidden" name="pid" value="{:(string)$post['_id']}" />
		<input type="hidden" name="eid" value="{$post['eid']}" />
		<input type="hidden" name="replyUid" value="{$post['uid']}" />
		<div class="cp-layout-body-gray">
			<div class="item-wrap">
				<h2>评论内容：</h2>
				<div class="item-list">
					<p><textarea name="content" id="content" style="height:150px;"></textarea></p>
				</div>
			</div>
			<div class="cp-album-upload">
				<ul>
					<li>
						<span class="spanbtn2" id="input_file" style="float: left;">选择照片</span>
						<div class="clear"></div>
						<input type="file" name="image" id="fileurl" style="display: none">
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="hr-t"></div>
			<div class="spanbtn0" id="btn_post" style="margin-top:15px;margin-bottom:15px;">评论</div>
			<div class="hr-b"></div>
		</div>
	</form>
</div>
<include file="./Tpl/Public/footer.php"/>
<script type="text/javascript">
	$(function(){
		var up_tips = function(){
			if (document.getElementById("upload_form").style.display == "none") { //展开
				$("#upload_form").show();
				$("#up_tips").html("取消上传");
			}
			else { //隐藏
				$("#upload_form").hide();
				$("#up_tips").html("上传照片");
			}
		}
		$("#input_file").click(function(){ //选择照片
			$("#fileurl").trigger('click');
		});

		$("#fileurl").bind("change", function(){ //选择照片后提示
			$("#input_file").html("已选，重选");
		});
		$("#up_tips").click(up_tips);
		$("#up_tips2").click(up_tips);

		//提交上传
		$("#btn_post").click(function(){
			var file = $("#fileurl");
			var file_val = $("#fileurl").val();
			var img_size = 0;
			var max_size = 2*1024*1024;
			if (file_val != "") {
				if(!/.(gif|jpg|jpeg|png)$/.test(file_val)){
					ToastShow("照片格式不正确");
					return false;
				}
				img_size = file[0].files[0].size;
				if (img_size > max_size) {
					ToastShow("照片大小不能超过2M");
					return false;
				}
			}
			if ($("#content").val()=="") {
				ToastShow("请填写内容");
				return false;
			}
			$("#post_form").submit();
		});
	});
</script>
</body>
</html>