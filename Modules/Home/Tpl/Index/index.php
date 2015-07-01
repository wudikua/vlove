<include file="./Tpl/Public/header.php" title="首页"/>
<style>
	.swiper-pagination-bullet {
		width: 20px;
		height: 20px;
		text-align: center;
		line-height: 20px;
		font-size: 12px;
		color:#000;
		opacity: 1;
		background: rgba(0,0,0,0.2);
	}
	.swiper-pagination-bullet-active {
		color:#fff;
		background: #007aff;
	}
</style>
<div class="swiper-container">
	<div class="swiper-wrapper">
		<div class="swiper-slide">
			<a href="{:U('Home/Index/push')}">
				<img width="100%" src="__PUBLIC__/images/banner1.jpg" alt="" />
			</a>
		</div>
		<div class="swiper-slide">
			<a href="{:U('Event/Index/index')}">
				<img width="100%" src="__PUBLIC__/images/banner2.jpg" alt="" />
			</a>
		</div>
	</div>
	<!-- Add Pagination -->
	<div class="swiper-pagination"></div>
</div>
<div class="index-user-list-title">
	<a href="#">
		<span><i class="spe_txt">今</i>日缘分</span>
		<span class="arrow_icon fr"></span>
	</a>
</div>

<div class="index-user-list">
	<?php for($i=0; $i<count($users); $i+=3):?>
	<ul <?php if($i != 0):?>style="margin-top:10px;"<?php endif;?>>
		<?php for($j=$i; $j<count($users) && $j<$i+3; $j++):?>
		<li <?php if ($j==1):?>
			style="margin-bottom: 10px; width: 124px; height: 152px;"
			<?php elseif($j%3==1):?>
			style="margin-left: 10px; margin-right: 10px; width: 124px; height: 152px;"
			<?php endif;?> class="<?php if($j == 0):?>b-li<?php else:?>s-li<?php endif;?>" onclick="userDetail('{:(string)$users[$j]['_id']}');">
			<img class="<?php if($j == 0):?>b-li-img<?php else:?>s-li-img<?php endif;?>" src="<?php if(strlen($users[$j]['avatar'])):?>__PUBLIC__/upload/thumb/m_{$users[$j]['avatar']}<?php else:?>__PUBLIC__/images/gender_1.gif<?php endif;?>" />
			<?php if($j==0):?>
			<p>{$users[$j]['nickname']}|{:age($users[$j]['birthday'])}岁|{$users[$j]['height']}</p>
			<?php endif;?>
		</li>
		<?php endfor;?>
	</ul>
	<div class="clear"></div>
	<?php endfor;?>
</div>


<div class="index-user-list-title">
    <a href="#">
        <span>新用户</span>
        <span class="arrow_icon fr"></span>
    </a>
</div>

<div class="index-user-list">
        <ul style="margin-top:10px;">
            <?php for($i=0; $i<3; $i++){?>
                <li class="s-li" <?php if ($i==1){?>
                    style="margin-left: 10px; margin-right: 10px; width: 124px; height: 152px;"
                    <?php }?>
                  onclick="userDetail('{:(string)$new[$i]['_id']}');">
                    <img class="s-li-img" src="<?php if(strlen($new[$i]['avatar'])){?>__PUBLIC__/upload/thumb/m_<?php echo $new[$i]['avatar'];}else{?>__PUBLIC__/images/gender_1.gif<?php }?>" />
                </li>
            <?php }?>
        </ul>
        <div class="clear"></div>

    <ul style="margin-top:10px;">
        <?php for($i=3; $i<6; $i++){?>
        <li class="s-li" <?php if ($i==4){?>
            style="margin-left: 10px; margin-right: 10px; width: 124px; height: 152px;"
        <?php }?>
            onclick="userDetail('{:(string)$new[$i]['_id']}');">
            <img class="s-li-img" src="<?php if(strlen($new[$i]['avatar'])){?>__PUBLIC__/upload/thumb/m_<?php echo $new[$i]['avatar'];}else{?>__PUBLIC__/images/gender_1.gif<?php }?>" />
        </li>
    <?php }?>
    </ul>
    <div class="clear"></div>
</div>
<script type="text/javascript">
	//var scWidth = $(window).width();
	scWidth = parseInt($(".index-user-list").css('width')) - 5;
	var tWidth = (scWidth); //减去padding的10px
	//平均分三等份
	var onewidth = parseInt((tWidth-30)/3);
	var oneheight = parseInt(onewidth/110*135); //高度按照110x135缩放比例
	//大图的图片大小：+10margin右边和下边的
	var bigimg_width = (onewidth*2+10);
	var bigimg_height = (oneheight*2+10);
	$(".b-li, .b-li-img").css({"width":bigimg_width+"px", "height":bigimg_height+"px"});
	$(".b-li-img").css("height", "110%");
	$(".s-li, .s-li-img").css({"width":onewidth+"px", "height":oneheight+"px"});
	$(".s-li-img").css("height", "110%");
	var swiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		spaceBetween: 30,
		centeredSlides: true,
		autoplay: 5000,
		autoplayDisableOnInteraction: false
	});
</script>

<include file="./Tpl/Public/footer.php"/>
</body>
</html>