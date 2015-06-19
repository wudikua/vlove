<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="奔跑吧兄弟快乐体验季">
    <meta name="keywords" content="奔跑吧兄弟快乐体验季">
    <meta name="robots" content="all">
    <title>【水动乐】-“奔跑吧兄弟-快乐体验季”</title>
    <meta name="viewport" content=" width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="../Public/css/style.css?v=114005">
</head>

<body class="on">

<div class="indexPage">
    <div class="loader" style="display: none;"></div>
    <div class="titleImg" style="opacity: 1;"></div>
    <div class="titleImg2" style="left: 50%; opacity: 1;"></div>
    <div class="menu_box" style="width: 602px;">
        <a href="__APP__/News/index/" class="menu_bt "  style="color: #fff">
            <h3>新闻动态</h3>
            <i class="icon03"></i>
           
        </a>
        <a href="__APP__/Video/index/" class="menu_bt "  style="color: #fff">
            <h3>精彩视频</h3>
            <i class="icon06"></i>
            
        </a>
        <a href="__APP__/Image/index/" class="menu_bt "  style="color: #fff">
            <h3>照片墙</h3>
            <i class="icon02"></i>
            
        </a>

        <a href="__APP__/Fensi/index/" class="menu_bt " style="color: #fff">
            <h3>粉丝福利社</h3>
            <i class="icon04"></i>
           
        </a>



    </div>
</div>


<sohuadcode></sohuadcode>














<script type="text/javascript" src="../Public/js/jquery-1.3.2.min.js"></script>
<script>

    $(function(){
        var DOC = document;
        var BODY = DOC.body;
        var WIN = window;

        function getPosition(e) {
            var that = this;
            if (!event) {
                return false
            }
            if (e.touches) e = e.touches[0];
            var canRect = BODY.getBoundingClientRect();

            return {
                x: (e.clientX - canRect.left),
                y: (e.clientY - canRect.top)
            }
        }

        $("body").delegate("*[class^=active]","touchstart",function(){});


        WIN.onload = function(){
            BODY.className = "on";
            $(".loader").hide();
        }

        var menu_box = $(".menu_box");
        var menu_bt = $(".menu_bt");
        var initX = "";
        var nowX = "";
        if(menu_box.length>0){
            $(".titleImg").animate({opacity:1},600);
            $(".titleImg2").animate({opacity:1,left:'50%'},800);
            menu_box.width(menu_bt.length*menu_bt.eq(1).width()+1*menu_bt.length);

            menu_box[0].addEventListener("touchstart",function(e){
                menu_box.css("-webkit-transition","");
                var position = getPosition(e);
                initX = position.x;
                var translated = menu_box.css("-webkit-transform");
                if( translated != "none"){
                    nowX = translated.split(",")[4]*1;
                }else{
                    nowX = 0;
                }
            });
            menu_box[0].addEventListener("touchmove",function(e){
                BODY.className = "";
                menu_bt.css("-webkit-transform","translate3D(0,0,0)");
                var position = getPosition(e);
                var zongW = menu_bt.eq(1).width()*menu_bt.length + menu_bt.length;
                if(BODY.clientWidth > zongW){return false }
                menu_box.css("-webkit-transform","translate3D("+(nowX*1+(position.x - initX*1))+"px,0,0)");

                e.preventDefault();
            });
            menu_box[0].addEventListener("touchend",function(e){
                menu_box.css("-webkit-transition",".6s");
                var translated = menu_box.css("-webkit-transform");
                if( translated == "none"){return false}
                nowX = translated.split(",")[4]*1;
                var zongW = menu_bt.eq(1).width()*menu_bt.length + menu_bt.length;
                if(nowX > 0){
                    menu_box.css("-webkit-transform","translate3D(0,0,0)");
                }else if( nowX < -(zongW-BODY.clientWidth) ){
                    menu_box.css("-webkit-transform","translate3D("+(-(zongW-BODY.clientWidth)+1)+"px,0,0)");
                }else{
                    var dis = (nowX/menu_bt.eq(1).width()).toFixed()*menu_bt.eq(1).width();
                    menu_box.css("-webkit-transform","translate3D("+dis+"px,0,0)");
                }
            });
        }

        var slide_bt = $(".slide_bt");
        var b_info_txt2 = $(".b_info_txt2");
        if(slide_bt && b_info_txt2){
            slide_bt.click(function(){
                var indexNum = slide_bt.index(this);
                b_info_txt2.eq(indexNum).toggleClass("on");
                if(this.textContent == "&#8659;展开全文&#8659;"){
                    this.textContent = "&#8657; 收起 &#8657;";
                }else{
                    this.textContent = "&#8659;展开全文&#8659;";
                }

            });
        };

        if (menu_box.length == 0) {
            var foot_nav = '<footer class="foot_nav"><a href="javascript:history.go(-1);"></a><a href="http://tv.sohu.com/s2014/ccnnmobile/"></a><a href="javascript:window.location.reload();"></a></footer>';
            $('body').append(foot_nav);

            /*deal body id*/
            var bid = $("div[bid]");
            $('body').attr('id',bid.attr('bid'));
        }


    });

</script>

</body></html>
