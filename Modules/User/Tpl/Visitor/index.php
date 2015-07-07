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
                    <li onclick="goUrl('<?php echo __APP__?>/user/profile/other?uid=<?php echo $value['userid'];?>');">
                        <div class="cplist-img" >
                            <img src="<?php if(strlen($value['fromuser']['avatar'])){?>__PUBLIC__/upload/thumb/s_<?php echo $value['fromuser']['avatar'];?><?php }else{?>__PUBLIC__/images/gender_1.gif<?php } ?>"></div>
                        <div class="cplist-info" style="width: 275px;">
                            <h2>
                                <span><?php echo date('m/d H:i', $value['create_time']);?></span>
                                <b> <?php echo $value['username'];?></b></h2>
                            <p><?php echo age($value['fromuser']['birthday']);?>岁 <?php echo ProfileConst::$marrystatus[$value['fromuser']['marrystatus']];?> <?php echo $value['fromuser']['city'] . '  ' .$value['fromuser']['area'];?></p>
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