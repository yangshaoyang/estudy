<?php
include_once("connect.php");

$verify = stripslashes(trim($_GET['verify']));
$nowtime = time();

$sql = "select id,token_exptime from t_user where status='0' and `token`='$verify'";
var_dump($sql);
$result = $pdo ->query($sql);
var_dump($result);
$row = $result->fetch();
var_dump($row);
if($row){
	if($nowtime>$row['token_exptime']){ //30min
		$msg = '您的激活有效期已过，请登录您的帐号重新发送激活邮件.';
	}else{
		$sql = "update t_user set status=1 where id=".$row['id'];
		$result = $pdo ->query($sql);
		if($result->rowCount()!=1) die(0);
		$msg = '激活成功！';
	}
}else{
	$msg = 'error.2222';	
}

echo $msg;
?>
