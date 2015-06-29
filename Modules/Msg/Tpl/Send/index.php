<include file="./Tpl/Public/header.php" title="活动"/>
<div class="cp-bartitle">【给<?php echo $user['nickname'];?>写信件】</div>

<div class="cp-layout-body-gray">
    <div class="item-wrap">
        <h2>信件不能出现联系方式，否则无法提交。</h2>
        <div class="item-list">
            <p>
                <input type="hidden" name="touid" id="touid" value="<?php echo $uid;?>" />
                <textarea name="content" id="content" style="height:150px;"></textarea></p>
        </div>
    </div>
    <div class="hr-t"></div>

    <div class="spanbtn0" id="btn_post">免费发信</div>
    <div class="hr-b"></div>
</div>

<include file="./Tpl/Public/footer.php"/>
</body>
</html>
<script type="text/javascript">
    $("#btn_post").click(function(){ //提交
        var touid = $("#touid").val();
        var content = $("#content").val();
        if (touid < 1) {
            alert("参数错误");
            return false;
        }
        if (content == "") {
            alert("内容不能为空");
            return false;
        }

        $.ajax({
            type: "POST",
            url: "{:U('msg/send/send')}",
            cache: false,
            data: {touid:touid, content:content, r:get_rndnum(8)},
            dataType: "json",
            success: function(data) {
                if (data == '1') {
                    alert("发送成功");
                    history.back();
                }
                else {
                    alert("发送失败");
                }
            },
            error: function() {
                alert("操作失败，请检查网络状态。");
            }
        });

    });
</script>