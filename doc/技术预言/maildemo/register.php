<?php
include_once("connect.php");
//检测用户名是否存在
$username = $_POST['username'];
$sql = "select id from t_user where username='$username'";
$result = $pdo ->query($sql);
var_dump($result);
$num = $result->rowCount();
var_dump($num);
if($num==1){
	echo '<script>alert("用户名已存在，请换个其他的用户名");window.history.go(-1);</script>';
	exit;
}
$password = md5(trim($_POST['password']));
var_dump($password);
$email = trim($_POST['email']);
var_dump($email);
$regtime = time();
var_dump($regtime);

$token = md5($username.$password.$regtime); //创建用于激活识别码
$token_exptime = time()+60*60*24;//过期时间为24小时后

$sql = "INSERT INTO `t_user` SET username='$username',password='$password',email='$email',token='$token',token_exptime='$token_exptime',status='0',regtime='$regtime'";
//$sql = "insert into `t_user` (`username`,`password`,`email`,`token`,`token_exptime`,`status`,`regtime`) values ('$username','$password','$email','$token','$token_exptime','0','$regtime')";
var_dump($sql);
$result = $pdo->exec("$sql");
var_dump($result);
if($result){//写入成功，发邮件
	include_once("smtp.class.php");
	$smtpserver = "smtp.126.com"; //SMTP服务器
    $smtpserverport = 25; //SMTP服务器端口
    $smtpusermail = "zykjinghuashuiyue@126.com"; //SMTP服务器的用户邮箱
    $smtpuser = "zykjinghuashuiyue@126.com"; //SMTP服务器的用户帐号
    $smtppass = "zyk1350316"; //SMTP服务器的用户密码
    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
    $smtpemailto = $email;
    $smtpemailfrom = $smtpusermail;
    $emailsubject = "用户帐号激活";
    $emailbody = "亲爱的".$username."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://localhost/demo/mail/active.php?verify=".$token."' target='_blank'>http://www.helloweba.com/demo/register/active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- Hellwoeba.com 敬上</p>";
    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
	if($rs==1){
		$msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';	
	}else{
		$msg = $rs;	
	}

echo $msg;
}
?>