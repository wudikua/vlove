<include file="./Tpl/Public/header.php" title="最新注册用户"/>
<div class="hr-shadow"></div>
<div class="tab-layout">
    <ul>
        <li style="width:100%" class="tab-selected">最新注册用户</li>
    </ul>
    <div class="clear"></div>
</div>

<div class="layout-body">
    <div class="user-list">
        <ul id="json_data">
                <?php foreach($users as $user):?>
                    <li onclick="userDetail('{:(string)$user['_id']}');">
                        <img class="userlist-img" src="<?php if(strlen($user['avatar'])):?>__PUBLIC__/upload/thumb/s_{$user['avatar']}<?php else:?>__PUBLIC__/images/gender_1.gif<?php endif;?>" />
                        <div class="user-inner">
                            <h5>{$user['nickname']}<span>{:ProfileConst::$gender[$user['gender']]}</span></h5>
                            <p>
                                {:age($user['birthday'])} | {:ProfileConst::$marrystatus[$user['marrystatus']]} | {$user['height']}CM<br />
                                {:constellation($user['birthday'])} {:Province::getProvinceName($user['dist1'])} {:Province::getCityName($user['dist1'], $user['dist2'])} {:Province::getAreaName($user['dist1'], $user['dist2'], $user['dist3'])}
                            </p>
                            <p>
                                {:ProfileConst::$education[$user['education']]}
                            </p>
                        </div>
                    </li>
                <?php endforeach;?>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<include file="./Tpl/Public/footer.php"/>


</body>
</html>