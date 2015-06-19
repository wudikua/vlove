<include file="./Tpl/Public/header.php" title="我的相册"/>
<div class="cp-bartitle">我的相册 <b id="up_tips">上传照片</b></div>
<div class="cp-layout-body">

	<form action="{:U('Photo/upload')}" method="post" enctype="multipart/form-data" name="upload_form" id="upload_form" target="uploadiframe" style="display:none;">
		<input type="hidden" name="thumbfiles" id="thumbfiles" />
		<div class="cp-album-upload">
			<ul>
				<li>
					<span class="spanbtn2" id="input_file">选择照片</span>
					<div class="clear"></div>
					<input type="file" name="image" id="fileurl" style="display: none"/>
				</li>
			</ul>
			<div class="clear"></div>

			<div class="spanbtn0" style="margin-top:10px;margin-bottom:10px;" id="btn_upload">上传</div>

		</div>
		<iframe name="uploadiframe" id="uploadiframe" style="display:none;"></iframe>
	</form>
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
			$("#btn_upload").click(function(){
				var file = $("#fileurl");
				var file_val = $("#fileurl").val();
				var img_size = 0;
				var max_size = 2*1024*1024;
				if (file_val == "") {
					ToastShow("请选择要上传的照片");
					return false;
				}
				if(!/.(gif|jpg|jpeg|png)$/.test(file_val)){
					ToastShow("照片格式不正确");
					return false;
				}
				img_size = file[0].files[0].size;
				if (img_size > max_size) {
					ToastShow("照片大小不能超过2M");
					return false;
				}
				$("#btn_upload").html("上传中，请稍等...");
				$("#upload_form").submit();
			});
		});
		//iframe callback parent.uploadCallBack();
		function uploadCallBack(res, msg) {
			if (res == "1") {
				ToastShow("上传成功");
				setTimeout(function(){
					$("#upload_form").remove();
					window.location.reload();
				}, 1000);

			}
			else {
				$("#btn_upload").html("上传");
				if (msg.length >0) {
					ToastShow(msg);
				}
				else {
					ToastShow("上传失败，请检查网络情况。");
				}
			}
		}
	</script>


	<div class="cp-album-list">
		<ul id="json_data">

			<?php foreach($images as $i=>$m):?>
			<li id="id_{$i+1}">
				<div class="album-inner">
					<h2><img src="__PUBLIC__/upload/thumb/s_{$m}" /></h2>
					<p><span onclick="setAvatar('{$i+1}');">设为头像</span></p>
					<p><span onclick="delAlbum('{$i+1}');">删除</span></p>
				</div>
			</li>
			<?php endforeach;?>

			<li>
				<div class="album-inner">
					<h2><img id="up_tips2" src="__PUBLIC__/images/d.png" /></h2>
				</div>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<!--//List End-->


</div>
<include file="./Tpl/Public/footer.php"/>
</body>
</html>
<script type="text/javascript">
	function setAvatar(id) {
		if (id > 0) {
			$.ajax({
				type: "POST",
				url: "{:U('Photo/setavatar')}",
				cache: false,
				data: {id:id, r:get_rndnum(8)},
				dataType: "json",
				success: function(data) {
					var json = eval(data);
					var response = json.response;
					var result = json.result;
					if (response == '1') {
						ToastShow("设置成功");
					}
					else {
						if (result.length > 0) {
							ToastShow(result);
						}
						else {
							ToastShow("设置失败，请检查网络...");
						}
					}
				},
				error: function() {
					ToastShow("设置失败，请检查网络...");
				}
			});
		}
	}
	//删除
	function delAlbum(id) {
		if (id > 0) {
			$.ajax({
				type: "POST",
				url: "{:U('Photo/remove')}",
				cache: false,
				data: {id:id, r:get_rndnum(8)},
				dataType: "json",
				success: function(data) {
					var json = eval(data);
					var response = json.response;
					var result = json.result;
					if (response == '1') {
						ToastShow("删除成功");
						$("#id_"+id).remove();
					}
					else {
						if (result.length > 0) {
							ToastShow(result);
						}
						else {
							ToastShow("删除失败，请检查网络...");
						}
					}
				},
				error: function() {
					ToastShow("删除失败，请检查网络...");
				}
			});
		}
	}
</script>