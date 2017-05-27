<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户登录</title>

<link href="/Company_crm/Public/css/login.css" type="text/css" rel="stylesheet" />
<script type="Text/JavaScript" src="/Company_crm/Public/js/jquery-1.12.4.js"></script>

</head>
<body id="userlogin_body">

<div id="user_login">
	<dl>
	<form action="/Company_crm/index.php/Home/Login/login_list"  method="post"  onsubmit="return checkSel();">
		<dd id="user_top">
			<ul>
				<li class="user_top_l"></li>
				<li class="user_top_c"></li>
				<li class="user_top_r">
					 <ul style="padding-top:60px;">		
					</ul>
				</li>
			</ul>
		</dd>
		<dd id="user_main">
			<ul>
				<li class="user_main_l"></li>
				<li class="user_main_c">
					<div class="user_main_box">
						<ul>
							<li class="user_main_text">用户名： </li>
							<li class="user_main_input"><input name="user_name" maxlength="20" id="TxtUserName" class="txtusernamecssclass"> </li>
						</ul>
						<ul>
							<li class="user_main_text">密 码： </li>
							<li class="user_main_input"><input type="password" name="password" id="TxtPassword" class="txtpasswordcssclass"> </li>
						</ul>
						<ul>
							<li class="user_main_text">验证码： </li>
                            <li class="user_main_input"><input name="code" maxlength="20" id="TxtUserCode" type="text" class="txtusernamecssclass"> </li>
						</ul>
						<ul>
						<li class="user_main_input">
						    <img src="<?php echo U('Home/Login/yzm');?>" style="margin-left:60px; width:160px;" id="img">
						</li>						    
						</ul>
					</div>
				</li>
				<li class="user_main_r">
					<input type="submit" name="IbtnEnter" style="background:url('/Company_crm/Public/img/user_botton.gif')" class="ibtnentercssclass" id="submit">
					
				</li>
			</ul>
	</form>
		</dd>
		<dd id="user_bottom">
			<ul>
				<li class="user_bottom_l"></li>
				<li class="user_bottom_c"></li>
				<li class="user_bottom_r"></li>
			</ul>
		</dd>
	</dl>
</div>

<script>
$(function(){
	//图片刷新
	$("#img").click(function(){
		$(this).attr("src","/Company_crm/index.php/Home/Login/yzm/"+Math.random());
	})	
})
//检查函数
function checkSels(){
	var name = $("#TxtUserName").val();
	var pass = $("#TxtPassword").val();
	var code = $("#TxtUserCode").val();
	if(name==""){
		alert("用户名不能为空");
		$("#TxtUserName").focus();
		return false;
	}
	if(pass==""){
		alert("密码不能为空");
		$("#TxtPassword").focus();
		return false;
	}
	if(code==""){
		alert("验证码不能为空");
		$("#TxtUserCode").focus();
		return false;
	}
	return true;
}

</script>

</body>
</html>