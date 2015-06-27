<include file="./Tpl/Public/header.php" title="活动"/>
<div class="cp-bartitle">
    收信箱 <b onclick="goUrl('{:U('msg/index/send')}')">发信箱</b>
</div>
<div class="tab-layout-2">
    <ul>
        <li onclick="goUrl('{:U('msg/index/index')}')" style="width:33.3%;" <?php if($type==0){?>class="tab-selected"<?php }?>>全部</li>
        <li onclick="goUrl('{:U('msg/index/index')}?type=1')" style="width:33.3%;" <?php if($type==1){?>class="tab-selected"<?php }?>>已读</li>
        <li onclick="goUrl('{:U('msg/index/index')}?type=2')" style="width:33.3%;" <?php if($type==2){?>class="tab-selected"<?php }?>>未读</li>
    </ul>
    <div class="clear"></div>
</div>
<include file="list" title="活动"/>