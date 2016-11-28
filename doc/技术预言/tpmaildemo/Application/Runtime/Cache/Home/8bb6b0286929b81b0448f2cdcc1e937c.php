<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title></title>
<!--<link rel="stylesheet" type="text/css" href="../css/main.css" />-->
<style type="text/css">
.demo{width:400px; margin:40px auto 0 auto; min-height:250px;}
.demo p{line-height:30px; padding:4px}
.input{width:180px; height:20px; padding:1px; line-height:20px; border:1px solid #999}
.btn{position: relative;overflow: hidden;display:inline-block;*display:inline;padding:4px 20px 4px;font-size:14px;line-height:18px;*line-height:20px;color:#fff;text-align:center;vertical-align:middle;cursor:pointer;background-color:#5bb75b;border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px; margin-left:48px}
</style>
<script type="text/javascript">
function chk_form(){
	var user = document.getElementById("user");
	if(user.value==""){
		alert("用户名不能为空！");
		return false;
		//user.focus();
	}
	var pass = document.getElementById("pass");
	if(pass.value==""){
		alert("密码不能为空！");
		return false;
		//pass.focus();
	}
	var email = document.getElementById("email");
	if(email.value==""){
		alert("Email不能为空！");
		return false;
		//email.focus();
	}
	var preg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; //匹配Email
	if(!preg.test(email.value)){ 
		alert("Email格式错误！");
		return false;
		//email.focus();
	}
}
</script>
</head>

<body>

<div id="main">
 
   <div class="demo">
   		<form id="reg" action="<?php echo U('home/register/register');?>" method="post" onsubmit="return chk_form();">
        	<p>用户名：<input type="text" class="input" name="username" id="user"></p>
            <p>密 &nbsp; 码：<input type="password" class="input" name="password" id="pass"></p>
            <p>E-mail：<input type="text" class="input" name="email" id="email"></p>
            <p><input type="submit" class="btn" value="提交注册"></p>
        </form>
	</div>
 <!--<br/><div class="ad_76090"><script src="/js/ad_js/bd_76090.js" type="text/javascript"></script></div><br/>-->
</div>

<div id="footer">
   
</div>
<!--<p id="stat"><script type="text/javascript" src="/js/tongji.js"></script></p>-->
</body>
</html>