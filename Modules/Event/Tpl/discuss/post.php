<include file="./Tpl/Public/header.php" title="发布讨论"/>
<div class="cp-bartitle">发布讨论</div>
<form action="{:U('Discuss/post')}" method="post" enctype="multipart/form-data" name="post_form" id="post_form">
	<input type="hidden" name="eid" value="<?php echo $eid;?>" />
	<div class="cp-layout-body-gray">
		<div class="item-wrap">
			<h2 style="display: inline;">标题：</h2>
			<input type="text" name="title" id="title" placeholder="填写帖子标题">
		</div>
		<div class="item-wrap">
			<h2>内容：</h2>
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
		<div class="spanbtn0" id="btn_post">发布</div>
		<div class="hr-b"></div>
	</div>
</form>
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
			if ($("#title").val()=="") {
				ToastShow("请填写标题");
				return false;
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
