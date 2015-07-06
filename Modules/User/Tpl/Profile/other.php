<include file="./Tpl/Public/header.php" title="资料"/>
<div class="home-info-layout">
	<div class="img-box"><img src="<?php if(strlen($user['avatar'])):?>__PUBLIC__/upload/thumb/s_{$user['avatar']}<?php else:?>__PUBLIC__/images/gender_1.gif<?php endif;?>" /></div>
	<div class="name-box">
		<h2>
			<span class="user-name">{$user['nickname']}</span>
			<span class="rz-mobile-n rz-line-25"></span>
			<span class="rz-email-n rz-line-25"></span>
		</h2>
		<p>{:age($user['birthday'])}岁|{:ProfileConst::$gender[$user['gender']]}|{:Province::getProvinceName($user['dist1'])} {:Province::getCityName($user['dist1'], $user['dist2'])} {:Province::getAreaName($user['dist1'], $user['dist2'], $user['dist3'])}</p>
		<p>{:constellation($user['birthday'])} {:ProfileConst::$marrystatus[$user['marrystatus']]} {:ProfileConst::$education[$user['education']]} {$user['height']}CM</p>
	</div>
	<div class="clear"></div>
</div>
<div class="home-time">
	最后登录时间：
	<span>{:date('m-d H:i', $user['login_time'])}</span>
</div>

<div class="home-tac">
	<ul>
		<li id="act_hi">打招呼</li>
		<li id="act_message" onclick="goUrl('{:U('msg/send/index')}?uid=<?php $u = '$id'; echo $user['_id']->$u;?>')">写信件</li>
		<?php if($atten) {?>
            <li id="tip_unlisten" style="border-right:none;color: red">
                <span >已关注</span>
            </li>
        <?php }else{?>
        <li id="tip_listen" style="border-right:none;">
			<span >加关注</span>
		</li>
        <?php }?>
	</ul>
	<div class="clear"></div>
</div>
<div id="fade" class="black_overlay" onclick="closeImage()"></div>
<div class="swiper-container" style="width: 100%;top: 10%;display: none;position: fixed;background-color: white;z-index:1002;">
	<div class="swiper-wrapper">
		<?php foreach($user['images'] as $image):?>
			<div class="swiper-slide">
				<img width="100%" height="105%" class="swiper-lazy" data-src="__PUBLIC__/upload/thumb/m_{$image}" src="__PUBLIC__/upload/thumb/s_{$image}">
				<div class="swiper-lazy-preloader"></div>
			</div>
		<?php endforeach;?>
	</div>
	<div class="swiper-pagination"></div>

	<div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div>

	<div class="per-pop-close" onclick="closeImage()"></div>
</div>

<script type="text/javascript">
	$(function(){
        var flag = true;
		$(".swiper-container").css("height", parseInt($("body").css("width"))/118*120 +"px");
		window.swiper = new Swiper('.swiper-container', {
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
			pagination: '.swiper-pagination',
			paginationClickable: true,
			speed: 300,
			preloadImages: false,
			lazyLoading: true
		});
        $("#act_hi").click(function(){
            $.ajax({
                type: "POST",
                url: "{:U('msg/send/send')}",
                cache: false,
                data: {touid:'<?php echo (string)$user['_id'];?>', content:'hi,我是<?php echo $username;?>,交个朋友吧！', r:get_rndnum(8)},
                dataType: "json",
                success: function(data) {
                    if (data == '1') {
                        alert("发送成功");
                    } else {
                        alert("发送失败");
                    }
                },
                error: function() {
                    alert("操作失败，请检查网络状态。");
                }
            });
        });
        $("#tip_listen").click(function(){
            if(!flag) return false;
            flag = false;
            $.ajax({
                type: "POST",
                url: "{:U('user/atten/add')}",
                cache: false,
                data: {touid:'<?php echo (string)$user['_id'];?>', r:get_rndnum(8)},
                dataType: "json",
                success: function(data) {
                    if (data == '1') {
                        alert("关注成功");
                        $("#tip_listen").css('color', 'red');
                        $("#tip_listen").find('span').html('已关注');
                    } else if(data == 2) {
                        alert("您已关注");
                    } else {
                        flag = true;
                        alert("关注失败");
                    }
                },
                error: function() {
                    alert("操作失败，请检查网络状态。");
                }
            });
        });
        $("#tip_listen").click(function(){
            if(!flag) return false;
            flag = false;
            $.ajax({
                type: "POST",
                url: "{:U('user/atten/add')}",
                cache: false,
                data: {touid:'<?php echo (string)$user['_id'];?>', r:get_rndnum(8)},
                dataType: "json",
                success: function(data) {
                    if (data == '1') {
                        alert("关注成功");
                        $("#tip_listen").css('color', 'red');
                        $("#tip_listen").find('span').html('已关注');
                    } else if(data == 2) {
                        alert("您已关注");
                    } else {
                        flag = true;
                        alert("关注失败");
                    }
                },
                error: function() {
                    alert("操作失败，请检查网络状态。");
                }
            });
        });
	});

	function viewImage(index) {
		$('#fade').show();
		$('#fade').css("height", $("body").height()+ 'px');
		$('.swiper-container').show();
		window.swiper.update();
		window.swiper.slideTo(index, 300);
	}

	function closeImage() {
		$('#fade').hide();
		$(".swiper-container").hide();
	}

</script>

<div class="home-data">
	<div class="home-wrap">
		<h2>相册</h2>
		<div id="imgs" class="imgs">
			<?php foreach($user['images'] as $i=>$image):?>
			<img onclick="viewImage('{$i}')" style="width: 64px;height: 64px;" src="__PUBLIC__/upload/thumb/s_{$image}" >
			<?php endforeach;?>
		</div>
	</div>


	<div class="home-wrap">
		<h2>内心独白</h2>
		<div class="home-itemlist">
			<p>{$user['content']}</p>
		</div>
	</div>

	<div class="home-wrap">
		<h2>择友要求</h2>
		<div class="home-itemlist">
			<ul>
				<li>年龄要求：<span><?php if($user['req_age_gt']):?>{$user['req_age_gt']}<?php else:?>不限<?php endif;?>~<?php if($user['req_age_lt']):?>{$user['req_age_lt']}<?php else:?>不限<?php endif;?>岁</span></li>
				<li>身高要求：<span><?php if($user['req_height']):?>{$user['req_height']}CM以上<?php else:?>不限<?php endif;?></span></li>
				<li>学历要求：<span><?php if($user['req_education']):?>{:ProfileConst::$education[$user['req_education']]}以上<?php else:?>不限<?php endif;?></span></li>
				<li style="border-bottom:none;">年薪要求：<span><?php if($user['req_salary']):?>{:ProfileConst::$salary[$user['req_salary']]}以上<?php else:?>不限<?php endif;?></span></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>


	<div class="home-wrap">
		<h2>基本资料</h2>
		<div class="home-itemlist">
			<ul>
				<li>所在地区：<span>{:Province::getProvinceName($user['dist1'])} {:Province::getCityName($user['dist1'], $user['dist2'])} {:Province::getAreaName($user['dist1'], $user['dist2'], $user['dist3'])}</span></li>
				<li>婚&#12288;&#12288;姻：<span>{:ProfileConst::$marrystatus[$user['marrystatus']]}</span></li>
				<li>交友类型：<span>{:ProfileConst::$lovesort[$user['lovesort']]}</span></li>
				<li>年&#12288;&#12288;龄：<span>{:age($user['birthday'])}岁</span></li>
				<li>身&#12288;&#12288;高：<span>{$user['height']}CM</span></li>
				<li>体&#12288;&#12288;重：<span>{$user['weight']}KG</span></li>
				<li>学&#12288;&#12288;历：<span>{:ProfileConst::$education[$user['education']]}</span></li>
				<li>学&#12288;&#12288;校：<span>{$user['school']}</span></li>
				<li>年&#12288;&#12288;薪：<span>{:ProfileConst::$salary[$user['salary']]}</span></li>
				<li>行&#12288;&#12288;业：<span>{:ProfileConst::$industry[$user['industry']]}</span></li>
				<li>职&#12288;&#12288;业：<span>{$user['job']}</span></li>
				<li style="border-bottom:none;">工作单位：<span>{$user['company']}</span></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<div class="home-wrap">
		<h2>详细资料</h2>
		<div class="home-itemlist">
			<ul>
				<li>户&#12288;&#12288;口：<span>{:Province::getProvinceName($user['hometown1'])} {:Province::getCityName($user['hometown1'], $user['hometown2'])}</span></li>
				<li>籍&#12288;&#12288;贯：<span>{:Province::getProvinceName($user['birthhometown1'])} {:Province::getCityName($user['birthhometown1'], $user['birthhometown2'])}</span></li>
				<li>婚&#12288;&#12288;姻：<span>{:ProfileConst::$marrystatus[$user['marrystatus']]}</span></li>
				<li>购房情况：<span>{:ProfileConst::$housing[$user['housing']]}</span></li>
				<li>购车情况：<span>{:ProfileConst::$caring[$user['caring']]}</span></li>
				<li>家中排行：<span>{:ProfileConst::$tophome[$user['tophome']]}</span></li>
				<li>民&#12288;&#12288;族：<span>{:ProfileConst::$national[$user['national']]}</span></li>
				<li>属&#12288;&#12288;相：<span>{:ProfileConst::$cnage[$user['cnage']]}</span></li>
				<li style="border-bottom:none;">星座：<span>{:constellation($user['birthday'])}</span></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
</div>
<include file="./Tpl/Public/footer.php"/>
</body>
</html>