<include file="./Tpl/Public/header.php" title="活动"/>
<div class="tab-layout-2">
    <ul>
        <li style="width:100%;" class="tab-selected">我的访客</li>
    </ul>
    <div class="clear"></div>
</div>
<?php if($list){?>
    <div class="cp-layout-body">
        <div class="cplist-box">
            <ul id="json_data">
                <?php foreach($list as $value){?>
                    <li onclick="goUrl('<?php echo __APP__?>/user/profile/other?uid=<?php echo (string)$value['_id'];?>');">
                        <div class="cplist-img" >
                            <img src="<?php if(strlen($value['avatar'])){?>__PUBLIC__/upload/thumb/s_<?php echo $value['avatar'];?><?php }else{?>__PUBLIC__/images/gender_1.gif<?php } ?>"></div>
                        <div class="cplist-info" style="width: 275px;">
                            <h2>
                                <span><?php echo date('m/d H:i', $value['login_time']);?></span>
                                <b> <?php echo $value['nickname'] ? $value['nickname'] : $value['username'];?> &nbsp;&nbsp;&nbsp; <?php echo ProfileConst::$gender[$value['gender']];?></b></h2>
                            <p><?php echo age($value['birthday']);?>岁 <?php echo ProfileConst::$marrystatus[$value['marrystatus']];?> <?php echo Province::getCityName($value['dist1'], $value['dist2']);?>
                                <?php echo Province::getAreaName($value['dist1'], $value['dist2'], $value['dist3']);?></p>
                        </div>
                        <div class="clear"></div>
                    </li>
                <?php }?>
            </ul>
            <div class="clear"></div>
        </div>
        <!--//List End-->
    </div>
<?php }else{?>
    <div class="cplist-box">
        <h6>No data</h6>
    </div>
<?php }?>

<include file="./Tpl/Public/footer.php"/>
</body>
</html>
<script type="text/javascript">
    $(function(){
        //maxwidth
        var max_width = (WIN_WIDTH-100);
        $(".cplist-box .cplist-info").css({"width":max_width});

    });
</script>