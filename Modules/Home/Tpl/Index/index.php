<include file="./Tpl/Public/header.php" title="首页"/>
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
			<img class="<?php if($j == 0):?>b-li-img<?php else:?>s-li-img<?php endif;?>" src="<?php if(strlen($users[$j]['avatar'])):?>__PUBLIC__/upload/thumb/s_{$users[$j]['avatar']}<?php else:?>__PUBLIC__/images/gender_1.gif<?php endif;?>" />
			<?php if($j==0):?>
			<p>{$users[$j]['nickname']}|{:age($users[$j]['birthday'])}岁|{$users[$j]['height']}</p>
			<?php endif;?>
		</li>
		<?php endfor;?>
	</ul>
	<div class="clear"></div>
	<?php endfor;?>
</div>
<script type="text/javascript">
	//var scWidth = $(window).width();
	scWidth = $(".index-user-list").width()+8;
	var tWidth = (scWidth); //减去padding的10px
	//平均分三等份
	var onewidth = parseInt((tWidth-30)/3);
	var oneheight = parseInt(onewidth/110*135); //高度按照110x135缩放比例
	//大图的图片大小：+10margin右边和下边的
	var bigimg_width = (onewidth*2+10);
	var bigimg_height = (oneheight*2+10);
	$(".b-li, .b-li-img").css({"width":bigimg_width+"px", "height":bigimg_height+"px"});
	$(".s-li, .s-li-img").css({"width":onewidth+"px", "height":oneheight+"px"});
	//alert("小图："+onewidth+"x"+oneheight+"大图："+bigimg_width+"x"+bigimg_height);
</script>

<include file="./Tpl/Public/footer.php"/>
</body>
</html>