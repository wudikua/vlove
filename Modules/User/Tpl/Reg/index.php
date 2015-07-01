<include file="./Tpl/Public/header.php" title="用户注册"/>

<div class="reg-layout">


	<div class="reg-wrap">
		<h2>会员帐号信息 必填</h2>
		<div class="reg-itemlist">
			<dl id="li_username">
				<dt>用户名：</dt>
				<dd><input type="text" id="username" name="username" placeholder="输入用户名称" class="input" onblur="checkUserName();" /></dd>
			</dl>
			<dl style="border:none;">
				<dt>密 码：</dt>
				<dd><input type="password" id="password" name="password" placeholder="输入6~16位密码" class="input" /></dd>
			</dl>
			<div class="clear"></div>
		</div>
	</div>
	<!--/reg-wrap End-->


	<div class="reg-wrap">
		<h2>会员基本资料 带*号必填</h2>
		<div class="reg-itemlist">
			<dl>
				<dt><font color="red">*</font>所在地区：</dt>
				<dd>
					<span onclick="areaPopup('选择地区', 'dist');" id="dist_text">选择</span>
					<input type="hidden" name="dist1" id="dist1" value="0" />
					<input type="hidden" name="dist2" id="dist2" value="0" />
					<input type="hidden" name="dist3" id="dist3" value="0" />
				</dd>
			</dl>
			<dl>
				<dt><font color="red">*</font>性别：</dt>
				<dd>
					<select name="gender" id="gender">
						<option value="">=请选择=</option>
						<option value="1">男</option>
						<option value="2">女</option>
					</select>
				</dd>
			</dl>
			<dl>
				<dt><font color="red">*</font>生日：</dt>
				<dd><input type="text" name="birthday" id="birthday" placeholder="(格式:19920501)" class="input" style="width:120px" /></dd>
			</dl>
			<dl>
				<dt><font color="red">*</font>婚姻：</dt>
				<dd><select name='marrystatus' id='marrystatus'><option value=''>=请选择=</option><option value='1'>未婚</option><option value='2'>已婚</option><option value='3'>离异</option><option value='4'>丧偶</option></select></dd>
			</dl>
			<dl>
				<dt><font color="red">*</font>学历：</dt>
				<dd><select name='education' id='education'><option value=''>=请选择=</option><option value='1'>中专以下学历</option><option value='2'>中专</option><option value='3'>大专</option><option value='4'>本科</option><option value='5'>硕士</option><option value='6'>博士</option><option value='7'>博士后</option></select></dd>
			</dl>
			<dl>
				<dt><font color="red">*</font>身高：</dt>
				<dd><select name='height' id='height'><option value=''>=请选择=</option><option value='130'>130</option><option value='131'>131</option><option value='132'>132</option><option value='133'>133</option><option value='134'>134</option><option value='135'>135</option><option value='136'>136</option><option value='137'>137</option><option value='138'>138</option><option value='139'>139</option><option value='140'>140</option><option value='141'>141</option><option value='142'>142</option><option value='143'>143</option><option value='144'>144</option><option value='145'>145</option><option value='146'>146</option><option value='147'>147</option><option value='148'>148</option><option value='149'>149</option><option value='150'>150</option><option value='151'>151</option><option value='152'>152</option><option value='153'>153</option><option value='154'>154</option><option value='155'>155</option><option value='156'>156</option><option value='157'>157</option><option value='158'>158</option><option value='159'>159</option><option value='160' selected>160</option><option value='161'>161</option><option value='162'>162</option><option value='163'>163</option><option value='164'>164</option><option value='165'>165</option><option value='166'>166</option><option value='167'>167</option><option value='168'>168</option><option value='169'>169</option><option value='170'>170</option><option value='171'>171</option><option value='172'>172</option><option value='173'>173</option><option value='174'>174</option><option value='175'>175</option><option value='176'>176</option><option value='177'>177</option><option value='178'>178</option><option value='179'>179</option><option value='180'>180</option><option value='181'>181</option><option value='182'>182</option><option value='183'>183</option><option value='184'>184</option><option value='185'>185</option><option value='186'>186</option><option value='187'>187</option><option value='188'>188</option><option value='189'>189</option><option value='190'>190</option><option value='191'>191</option><option value='192'>192</option><option value='193'>193</option><option value='194'>194</option><option value='195'>195</option><option value='196'>196</option><option value='197'>197</option><option value='198'>198</option><option value='199'>199</option><option value='200'>200</option></select> CM</dd>
			</dl>
			<div class="clear"></div>
		</div>
	</div>
	<!--/reg-wrap End-->


	<div class="spanbtn0" id="btn_post">下一步</div>
</div>

<div id="varpop_shade" class="varpop-shade"></div>
<div class="varpop-layout" id='area_box'>
	<div class="varpop-head">
		<span id="area_title">选择</span>
		<i id="area_loading">loading...</i>
	</div>
	<div id="area_data"></div>
	<!--//area_data End-->
</div>
<!--//area_box ajax End-->

<include file="./Tpl/Public/footer.php"/>


<script type="text/javascript">
$(function(){

	$("#btn_post").click(function(){ //提交 下一步

		var username = $("#username").val();
		if (username == "") {
			ToastShow("请填写用户名");
			return false;
		}

		var password = $("#password").val();
		if (password == "") {
			ToastShow("请填写登录密码");
			return false;
		}

		var dist1 = $("#dist1").val();
		var dist2 = $("#dist2").val();
		var dist3 = $("#dist3").val();
		if (dist1 < 1) {
			ToastShow("请选择地区");
			return false;
		}
		if (dist2 < 1) {
			ToastShow("请选择地区");
			return false;
		}

		var gender = $("#gender").val();
		if (gender < 1) {
			ToastShow("请选择性别");
			return false;
		}

		var birthday = $("#birthday").val();
		if (birthday == "") {
			ToastShow("请填写生日");
			return false;
		}

		var marrystatus = $("#marrystatus").val();
		if (marrystatus == "") {
			ToastShow("请选择婚姻");
			return false;
		}

		var education = $("#education").val();
		if (education == "") {
			ToastShow("请选择学历");
			return false;
		}

		var height = $("#height").val();
		if (height == "") {
			ToastShow("请选择身高");
			return false;
		}

		var weight = "";

		var lovesort = "";

		var salary = "";

		var mobile = "";

		var qq = "";

		var idnumber = "";

		$("#btn_post").html("注册中，请稍等...");
		$.ajax({
			type: "POST",
			url: "{:U('Reg/index')}",
			cache: false,
			data: {
				username:username, password:password,
				dist1:dist1, dist2:dist2, dist3:dist3, gender:gender, birthday:birthday,
				marrystatus:marrystatus, education:education, height:height, weight:weight,
				lovesort:lovesort, salary:salary, mobile:mobile, qq:qq, idnumber:idnumber, r:get_rndnum(8)
			},
			dataType: "json",
			success: function(data) {
				var json = eval(data);
				var response = json.response;
				var result = json.result;
				if (response == '1') {
					ToastShow("注册成功");
					setTimeout(function(){
						goUrl("{:U('Profile/index')}");
					}, 800);
				}
				else {
					if (result.length > 0) {
						ToastShow(result);
					}
					else {
						ToastShow("注册失败，请检查网络...");
					}
					$("#btn_post").html("下一步");

				}
			},
			error: function() {
				ToastShow("提交失败，请检查网络...");
				$("#btn_post").html("下一步");
			}
		});

	});
});


//check username
function checkUserName() {
	var li_tips = $("#li_username");
	var value = $("#username").val();
	if (value == "") {
		ToastShow("用户名不能为空");
		li_tips.addClass("error-border");
		return false;
	}
	else {
		li_tips.removeClass("error-border");
	}
	$.ajax({
		type: "POST",
		url: "{:U('Reg/checkusername')}",
		cache: false,
		data: {username:value, r:get_rndnum(8)},
		dataType: "json",
		success: function(data) {
			var json = eval(data);
			var response = json.response;
			var result = json.result;
			if (response == '1') {
				li_tips.removeClass("error-border");
				ToastShow("用户名可用");
			}
			else {
				li_tips.addClass("error-border");
				if (result.length > 0) {
					ToastShow(result);
				}
				else {
					ToastShow("用户名不可用");
				}
			}
		},
		error: function() {
			ToastShow("提交失败，请检查网络...");
		}
	});
}

//check email
function checkEmail() {
	var li_tips = $("#li_email");
	var value = $("#email").val();
	if (value == "") {
		ToastShow("邮箱不能为空");
		li_tips.addClass("error-border");
		return false;
	}
	else {
		li_tips.removeClass("error-border");
	}
	$.ajax({
		type: "POST",
		url: "{:U('Reg/checkemail')}",
		cache: false,
		data: {email:value, r:get_rndnum(8)},
		dataType: "json",
		success: function(data) {
			var json = eval(data);
			var response = json.response;
			var result = json.result;
			if (response == '1') {
				li_tips.removeClass("error-border");
				ToastShow("邮箱可用");
			}
			else {
				li_tips.addClass("error-border");
				if (result.length > 0) {
					ToastShow(result);
				}
				else {
					ToastShow("邮箱不可用");
				}
			}
		},
		error: function() {
			ToastShow("提交失败，请检查网络...");
		}
	});
}
</script>
</body>
</html>
