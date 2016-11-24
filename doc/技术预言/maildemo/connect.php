
<?php
$timezone="Asia/Shanghai";
$dsn = "mysql:host=localhost;dbname=mail";
$dbUser= 'root';
$dbPswd= '';
$pdo = new PDO($dsn,$dbUser,$dbPswd);
if($pdo){
	echo '成功';
}else{
	echo '失败';
}

header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set($timezone); //北京时间

//$sql = "INSERT INTO `t_user` SET username='11',password='111',email='11',token='11',token_exptime='111',status='0',regtime='1111'"
//$result = $pdo->exec($sql);
//var_dump($result);
?>