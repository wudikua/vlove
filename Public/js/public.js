/*----------- 支持div滚动条 方式1 touch begin  noBarsOnTouchScreen(divid)---------------*/
function noBarsOnTouchScreen(arg) {
	var elem, tx, ty;
	if('ontouchstart' in document.documentElement ) {
		if (elem = document.getElementById(arg)) {
			//elem.style.overflow = 'hidden';
			elem.ontouchstart = ts;
			elem.ontouchmove = tm;
		}
	}

	function ts(e) {
		var tch;
		if(e.touches.length == 1) {
			e.stopPropagation();
			tch = e.touches[ 0 ];
			tx = tch.pageX;
			ty = tch.pageY;
		}
	}
	function tm(e) {
		var tch;
		if (e.touches.length == 1 ) {
			e.preventDefault();
			e.stopPropagation();
			tch = e.touches[ 0 ];
			this.scrollTop +=  ty - tch.pageY;
			ty = tch.pageY;
		}
	}
}


function isTouchDevice(){
    try{
        document.createEvent("TouchEvent");
        return true;
    }catch(e){
        return false;
    }
}
//支持div滚动条 方式2  touchScroll("MyElement");
function touchScroll(id){
    if(isTouchDevice()){ //if touch events exist...
        var el=document.getElementById(id);
        var scrollStartPos=0;

        document.getElementById(id).addEventListener("touchstart", function(event) {
            scrollStartPos=this.scrollTop+event.touches[0].pageY;
            event.preventDefault();
        },false);

        document.getElementById(id).addEventListener("touchmove", function(event) {
            this.scrollTop=scrollStartPos-event.touches[0].pageY;
            event.preventDefault();
        },false);
    }
}
/*----------- andriod touch end ---------------*/


//判断字符长度，一个汉字为2个字符
function strlen(s){
	var l = 0;
	var a = s.split("");
	for (var i=0;i<a.length;i++){
		if (a[i].charCodeAt(0)<299){
			l++;
		}else{
			l+=2;
		}
	}
	return l;
}

//判断字体个数
function strQuantity(s){
	var l = 0;
	var a = s.split("");
	for (var i=0;i<a.length;i++){
		if (a[i].charCodeAt(0)<299){
			l++;
		}else{
			l++;
		}
	}
	return l;
}

//随机数
function get_rndnum(n) {
	var chars = ['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
	var res = "";
	for(var i = 0; i < n ; i ++) {
		var id = Math.ceil(Math.random()*35);
		res += chars[id];
	}
	return res;
}

/*----------------------- 公共弹出层 Begin ----------------------*/
//popbox position
function popMakerCenter(){
	//$('.pop-layout').css("display","block");
	$('.pop-layout').css("position","absolute");
	$('.pop-layout').css("top", Math.max(0, (($(window).height() - $('.pop-layout').height()) / 2) + $(window).scrollTop()) + "px");
	$('.pop-layout').css("left", Math.max(0, (($(window).width() - $('.pop-layout').width()) / 2) + $(window).scrollLeft()) + "px");
}

//popbox close
function layoutPopClose() {
	//$('.pop-layout').css("display","none");
	$('.pop-shade').fadeOut(200);
	$('.pop-layout').fadeOut(200);
}

//popbox
function layoutPop() {
	$('.pop-shade').fadeIn(100);
	popMakerCenter();
	$('.pop-layout').fadeIn(200);

}
/*----------------------- 公共弹出层 End -----------------------*/


//url location to
function goUrl(url) {
	$("#loading").fadeIn(1);
	window.location.href = url;
}

//url reload
function urlReload() {
	$("#loading").fadeIn(1);
	window.location.reload();
}

//url go back
function goBack() {
	window.history.go(-1);
	$("#loading").fadeOut();
}

//url go back refresh
function goBackRefresh() {
	window.history.go(-1);
	opener.location.reload();
	//window.location.href = document.referrer;
}

//home detail 
function userDetail(uid) {
    if (uid=="") {
        alert("报名审核通过后可见")
        return;
    }
	$("#loading").fadeIn(1);
	window.location.href = window.profileOther+"?uid="+uid;
}

function eventDetail(eid) {
    $("#loading").fadeIn(1);
    window.location.href = window.eventDetailUrl+"?eid="+eid;
}

//tabpop position
/**
 * 层自适应居中
 * @param:: string $tabid DIV 
 * @return:: 
*/
function tabPopMarginAuto(tabid){
	$('#'+tabid).css("position","absolute");
	$('#'+tabid).css("top", Math.max(0, (($(window).height() - $('#'+tabid).height()) / 2) + $(window).scrollTop()) + "px");
	$('#'+tabid).css("left", Math.max(0, (($(window).width() - $('#'+tabid).width()) / 2) + $(window).scrollLeft()) + "px");
}

/**
 * 层自适应居中
 * @param:: string $tabid DIV 
 * @return:: 
*/
function varPopMarginAuto(tabid){
	$('#'+tabid).css("position","absolute");
	$('#'+tabid).css("top", "100px");
	$('#'+tabid).css("left", Math.max(0, (($(window).width() - $('#'+tabid).width()) / 2) + $(window).scrollLeft()) + "px");
}


/**
 * 关闭所在地区层
 * @return:: NULL;
*/
function areaPopClose() {
	$("#varpop_shade").hide();
	$("#area_box").fadeOut(200);
	$("#area_loading").text("");
	$("#area_data").html("");
}

/**
 * 弹出所在地区选项层
 * @param:: string $title 标题
 * @param:: string $item 参数
 * @return:: NULL;
*/
function areaPopup(title, item) {
	$('#varpop_shade').show(); //遮罩效果
	varPopMarginAuto("area_box"); //自适应居中
	$("#area_box").fadeIn(200); //显示
	$("#area_loading").text("Loading...");
	$("#area_title").text(title);
	var dist1 = $("#"+item+"1").val(); //一级地区value
	var dist2 = $("#"+item+"2").val(); //二级地区value
	var dist3 = $("#"+item+"3").val(); //三级地区value
	//POST
	$.ajax({
		type: "POST",
		url: window.regProvince,
		cache: false,
		data: {item:item, dist1:dist1, dist2:dist2, dist3:dist3, r:get_rndnum(8)},
		dataType: "json",
		success: function(data) {
			var json = eval(data);
			var response = json.response;
			var result = json.result;
			if (response == '1') {
				$("#area_loading").text("");
				//加载数据
				$("#area_data").html(result);
				tabPopMarginAuto("area_box"); //重新居中
			}
			else {
				$("#area_loading").text("");
				ToastShow("数据加载失败，请检查网络...");
			}
		},
		error: function() {
		}
	});
}

/**
 * 关闭出生地层
 * @return:: NULL;
*/
function hometownPopClose() {
	//$("#varpop_shade").fadeOut(200);
	$("#varpop_shade").hide();
	$("#hometown_box").fadeOut(200);
	$("#hometown_loading").text("");
	$("#hometown_data").html("");
}

/**
 * 弹出出生地选项层
 * @param:: string $title 标题
 * @param:: string $item 参数
 * @return:: NULL;
*/
function hometownPopup(title, item) {
	//$('#varpop_shade').fadeIn(100); //遮罩效果
	$('#varpop_shade').show(); //遮罩效果
	varPopMarginAuto("hometown_box"); //自适应居中
	$("#hometown_box").fadeIn(200); //显示
	$("#hometown_loading").text("Loading...");
	$("#hometown_title").text(title);
	var dist1 = $("#"+item+"1").val(); //一级地区value
	var dist2 = $("#"+item+"2").val(); //二级地区value
	//POST
	$.ajax({
		type: "POST",
		url: window.regHometown,
		cache: false,
		data: {item:item, dist1:dist1, dist2:dist2, r:get_rndnum(8)},
		dataType: "json",
		success: function(data) {
			var json = eval(data);
			var response = json.response;
			var result = json.result;
			if (response == '1') {
				$("#hometown_loading").text("");
				//加载数据
				$("#hometown_data").html(result);
				tabPopMarginAuto("hometown_box"); //重新居中
			}
			else {
				$("#hometown_loading").text("");
				ToastShow("数据加载失败，请检查网络...");
			}
		},
		error: function() {
		}
	});
}
;(function($){
    var zepto = $.zepto, oldQsa = zepto.qsa, oldMatches = zepto.matches

    function visible(elem){
        elem = $(elem)
        return !!(elem.width() || elem.height()) && elem.css("display") !== "none"
    }

    // Implements a subset from:
    // http://api.jquery.com/category/selectors/jquery-selector-extensions/
    //
    // Each filter function receives the current index, all nodes in the
    // considered set, and a value if there were parentheses. The value
    // of `this` is the node currently being considered. The function returns the
    // resulting node(s), null, or undefined.
    //
    // Complex selectors are not supported:
    //   li:has(label:contains("foo")) + li:has(label:contains("bar"))
    //   ul.inner:first > li
    var filters = $.expr[':'] = {
        visible:  function(){ if (visible(this)) return this },
        hidden:   function(){ if (!visible(this)) return this },
        selected: function(){ if (this.selected) return this },
        checked:  function(){ if (this.checked) return this },
        parent:   function(){ return this.parentNode },
        first:    function(idx){ if (idx === 0) return this },
        last:     function(idx, nodes){ if (idx === nodes.length - 1) return this },
        eq:       function(idx, _, value){ if (idx === value) return this },
        contains: function(idx, _, text){ if ($(this).text().indexOf(text) > -1) return this },
        has:      function(idx, _, sel){ if (zepto.qsa(this, sel).length) return this }
    }

    var filterRe = new RegExp('(.*):(\\w+)(?:\\(([^)]+)\\))?$\\s*'),
        childRe  = /^\s*>/,
        classTag = 'Zepto' + (+new Date())

    function process(sel, fn) {
        // quote the hash in `a[href^=#]` expression
        sel = sel.replace(/=#\]/g, '="#"]')
        var filter, arg, match = filterRe.exec(sel)
        if (match && match[2] in filters) {
            filter = filters[match[2]], arg = match[3]
            sel = match[1]
            if (arg) {
                var num = Number(arg)
                if (isNaN(num)) arg = arg.replace(/^["']|["']$/g, '')
                else arg = num
            }
        }
        return fn(sel, filter, arg)
    }

    zepto.qsa = function(node, selector) {
        return process(selector, function(sel, filter, arg){
            try {
                var taggedParent
                if (!sel && filter) sel = '*'
                else if (childRe.test(sel))
                // support "> *" child queries by tagging the parent node with a
                // unique class and prepending that classname onto the selector
                    taggedParent = $(node).addClass(classTag), sel = '.'+classTag+' '+sel

                var nodes = oldQsa(node, sel)
            } catch(e) {
                console.error('error performing selector: %o', selector)
                throw e
            } finally {
                if (taggedParent) taggedParent.removeClass(classTag)
            }
            return !filter ? nodes :
                zepto.uniq($.map(nodes, function(n, i){ return filter.call(n, i, nodes, arg) }))
        })
    }

    zepto.matches = function(node, selector){
        return process(selector, function(sel, filter, arg){
            return (!sel || oldMatches(node, sel)) &&
                (!filter || filter.call(node, null, arg) === node)
        })
    }
})(Zepto)
;(function($, undefined){
    var prefix = '', eventPrefix,
        vendors = { Webkit: 'webkit', Moz: '', O: 'o' },
        testEl = document.createElement('div'),
        supportedTransforms = /^((translate|rotate|scale)(X|Y|Z|3d)?|matrix(3d)?|perspective|skew(X|Y)?)$/i,
        transform,
        transitionProperty, transitionDuration, transitionTiming, transitionDelay,
        animationName, animationDuration, animationTiming, animationDelay,
        cssReset = {}

    function dasherize(str) { return str.replace(/([a-z])([A-Z])/, '$1-$2').toLowerCase() }
    function normalizeEvent(name) { return eventPrefix ? eventPrefix + name : name.toLowerCase() }

    $.each(vendors, function(vendor, event){
        if (testEl.style[vendor + 'TransitionProperty'] !== undefined) {
            prefix = '-' + vendor.toLowerCase() + '-'
            eventPrefix = event
            return false
        }
    })

    transform = prefix + 'transform'
    cssReset[transitionProperty = prefix + 'transition-property'] =
        cssReset[transitionDuration = prefix + 'transition-duration'] =
            cssReset[transitionDelay    = prefix + 'transition-delay'] =
                cssReset[transitionTiming   = prefix + 'transition-timing-function'] =
                    cssReset[animationName      = prefix + 'animation-name'] =
                        cssReset[animationDuration  = prefix + 'animation-duration'] =
                            cssReset[animationDelay     = prefix + 'animation-delay'] =
                                cssReset[animationTiming    = prefix + 'animation-timing-function'] = ''

    $.fx = {
        off: (eventPrefix === undefined && testEl.style.transitionProperty === undefined),
        speeds: { _default: 400, fast: 200, slow: 600 },
        cssPrefix: prefix,
        transitionEnd: normalizeEvent('TransitionEnd'),
        animationEnd: normalizeEvent('AnimationEnd')
    }

    $.fn.animate = function(properties, duration, ease, callback, delay){
        if ($.isFunction(duration))
            callback = duration, ease = undefined, duration = undefined
        if ($.isFunction(ease))
            callback = ease, ease = undefined
        if ($.isPlainObject(duration))
            ease = duration.easing, callback = duration.complete, delay = duration.delay, duration = duration.duration
        if (duration) duration = (typeof duration == 'number' ? duration :
            ($.fx.speeds[duration] || $.fx.speeds._default)) / 1000
        if (delay) delay = parseFloat(delay) / 1000
        return this.anim(properties, duration, ease, callback, delay)
    }

    $.fn.anim = function(properties, duration, ease, callback, delay){
        var key, cssValues = {}, cssProperties, transforms = '',
            that = this, wrappedCallback, endEvent = $.fx.transitionEnd,
            fired = false

        if (duration === undefined) duration = $.fx.speeds._default / 1000
        if (delay === undefined) delay = 0
        if ($.fx.off) duration = 0

        if (typeof properties == 'string') {
            // keyframe animation
            cssValues[animationName] = properties
            cssValues[animationDuration] = duration + 's'
            cssValues[animationDelay] = delay + 's'
            cssValues[animationTiming] = (ease || 'linear')
            endEvent = $.fx.animationEnd
        } else {
            cssProperties = []
            // CSS transitions
            for (key in properties)
                if (supportedTransforms.test(key)) transforms += key + '(' + properties[key] + ') '
                else cssValues[key] = properties[key], cssProperties.push(dasherize(key))

            if (transforms) cssValues[transform] = transforms, cssProperties.push(transform)
            if (duration > 0 && typeof properties === 'object') {
                cssValues[transitionProperty] = cssProperties.join(', ')
                cssValues[transitionDuration] = duration + 's'
                cssValues[transitionDelay] = delay + 's'
                cssValues[transitionTiming] = (ease || 'linear')
            }
        }

        wrappedCallback = function(event){
            if (typeof event !== 'undefined') {
                if (event.target !== event.currentTarget) return // makes sure the event didn't bubble from "below"
                $(event.target).unbind(endEvent, wrappedCallback)
            } else
                $(this).unbind(endEvent, wrappedCallback) // triggered by setTimeout

            fired = true
            $(this).css(cssReset)
            callback && callback.call(this)
        }
        if (duration > 0){
            this.bind(endEvent, wrappedCallback)
            // transitionEnd is not always firing on older Android phones
            // so make sure it gets fired
            setTimeout(function(){
                if (fired) return
                wrappedCallback.call(that)
            }, ((duration + delay) * 1000) + 25)
        }

        // trigger page reflow so new elements can animate
        this.size() && this.get(0).clientLeft

        this.css(cssValues)

        if (duration <= 0) setTimeout(function() {
            that.each(function(){ wrappedCallback.call(this) })
        }, 0)

        return this
    }

    testEl = null
})(Zepto)

;(function($, undefined){
    var document = window.document, docElem = document.documentElement,
        origShow = $.fn.show, origHide = $.fn.hide, origToggle = $.fn.toggle

    function anim(el, speed, opacity, scale, callback) {
        if (typeof speed == 'function' && !callback) callback = speed, speed = undefined
        var props = { opacity: opacity }
        if (scale) {
            props.scale = scale
            el.css($.fx.cssPrefix + 'transform-origin', '0 0')
        }
        return el.animate(props, speed, null, callback)
    }

    function hide(el, speed, scale, callback) {
        return anim(el, speed, 0, scale, function(){
            origHide.call($(this))
            callback && callback.call(this)
        })
    }

    $.fn.show = function(speed, callback) {
        origShow.call(this)
        if (speed === undefined) speed = 0
        else this.css('opacity', 0)
        return anim(this, speed, 1, '1,1', callback)
    }

    $.fn.hide = function(speed, callback) {
        if (speed === undefined) return origHide.call(this)
        else return hide(this, speed, '0,0', callback)
    }

    $.fn.toggle = function(speed, callback) {
        if (speed === undefined || typeof speed == 'boolean')
            return origToggle.call(this, speed)
        else return this.each(function(){
            var el = $(this)
            el[el.css('display') == 'none' ? 'show' : 'hide'](speed, callback)
        })
    }

    $.fn.fadeTo = function(speed, opacity, callback) {
        return anim(this, speed, opacity, null, callback)
    }

    $.fn.fadeIn = function(speed, callback) {
        var target = this.css('opacity')
        if (target > 0) this.css('opacity', 0)
        else target = 1
        return origShow.call(this).fadeTo(speed, target, callback)
    }

    $.fn.fadeOut = function(speed, callback) {
        return hide(this, speed, null, callback)
    }

    $.fn.fadeToggle = function(speed, callback) {
        return this.each(function(){
            var el = $(this)
            el[
                (el.css('opacity') == 0 || el.css('display') == 'none') ? 'fadeIn' : 'fadeOut'
                ](speed, callback)
        })
    }

})(Zepto)

