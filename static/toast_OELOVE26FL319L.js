var Toast = function(config){
	this.context = config.context==null?$('body'):config.context;//上下文
	this.message = config.message;//显示内容
	this.time = config.time == null ? 3000 : config.time;//持续时间
	this.left = config.left;//距容器左边的距离
	this.top = config.top;//距容器上方的距离
	this.init();
}
var msgEntity;
Toast.prototype = {
	//初始化显示的位置内容等
	init : function(){
		$("#ToastBox").remove();
		//设置消息体
		var msgDIV = new Array();
		msgDIV.push('<div id="ToastBox" class="toast">');
		msgDIV.push('<span id="ToastText">'+this.message+'</span>');
		msgDIV.push('</div>');

		msgEntity = $(msgDIV.join('')).appendTo(this.context);
		

		var span_width = msgEntity.width();
		var left_width = (WIN_WIDTH-span_width)/2;

		//设置消息样式
		//var left = this.left == null ? this.context.width()/2-msgEntity.find('span').width()/2 : this.left;
		//var top = this.top == null ? '20px' : this.top;
		msgEntity.css({left:left_width});
		msgEntity.hide();
	},
	//显示动画
	show :function(){
		//msgEntity.fadeIn(this.time/2);
		msgEntity.fadeIn(600);
		setTimeout(function(){
			msgEntity.fadeOut(2000);
		}, 2000);
	}	
}

function ToastShow(text) {
	new Toast({context:$('body'), message:text}).show();
}
