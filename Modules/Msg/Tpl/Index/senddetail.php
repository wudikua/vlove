<include file="./Tpl/Public/header.php" title="活动"/>
<div class="cp-bartitle">查看<?php if($result['type'] == 2){echo '收到';}else{echo '已发';}?>信件</div>
<div class="cp-layout-body">

    <div class="cp-data" onclick="goUrl('{:U('user/profile/other')}?uid=<?php echo $result['userid'];?>')">
        <div class="cp-data-avatar">
            <img src="<?php if(strlen($result['fromuser']['avatar'])){?>__PUBLIC__/upload/thumb/s_<?php echo $result['fromuser']['avatar'];?><?php }else{?>__PUBLIC__/images/gender_1.gif<?php } ?>" />
        </div>
        <div class="cp-data-info">
            <h2><b><?php echo $result['fromuser']['nickname'];?></b>(<?php if($result['type'] == 2){echo '发';}else{echo '收';}?>件人)</h2>
            <ul>
                <li>
                    <?php echo ProfileConst::$gender[$result['fromuser']['gender']];?>  <?php echo age($result['fromuser']['birthday']);?> 岁 <?php echo ProfileConst::$marrystatus[$result['fromuser']['marrystatus']];?>
                </li>
                <li>
                    <?php echo $result['fromuser']['city'] . '  ' .$result['fromuser']['area'];?>
                    <?php echo ProfileConst::$education[$result['fromuser']['education'] ? $result['fromuser']['education'] : 1];?>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="message-box">
        <h2><?php echo $nickname;?></h2>
        <h3><?php echo date('Y-m-d H:i',$result['create_time']);?></h3>
        <p><?php echo $result['msg'];?></p>
    </div>
<?php if($result['type'] == 2){?>
    <div class="spanbtn0" onclick="goUrl('<?php echo U('msg/send/index') . '?uid=' . $result['userid'];?>')">回复</div>
<?php } ?>
    <div class="spanbtn0" onclick="history.back();">返回上一页</div>
    <div class="hr-b"></div>
</div>
<include file="./Tpl/Public/footer.php"/>