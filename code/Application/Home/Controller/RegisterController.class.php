<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type: text/html; charset=UTF-8");
class RegisterController extends Controller {
	public function index(){
		$this->display();
	}
	public function register(){
	    	$data = I('post.');
	    	//dump($data);
	    	$User = M('users');
	      $username = $data['username'];
	      $email=$data['email'];
		$result = $User ->getFieldByUsername($username,'userid');
		//dump($User->_sql());
		$num = count($result);
		//dump($num);
		if($num==1){
			echo '<script>alert("用户名已存在，请换个其他的用户名");window.history.go(-1);</script>';
			exit;
		}
		$result = $User ->getFieldByEmail($email,'userid');
		$num = count($result);
		if($num==1){
			echo '<script>alert("邮箱已存在，请换其他邮箱");window.history.go(-1);</script>';
			exit;
		}
		$data['password'] = md5($data['password']);
		//dump($password);
		$data['email'] = trim($data['email']);
		//dump($email);
		$regtime = time();
		//dump($regtime);
		$token = md5($username.$password.$regtime); //创建用于激活识别码
		//dump($token);
		$token_exptime = time()+60*60*24;//过期时间为24小时后
		$data['token']=$token;
		$data['token_exptime']=$token_exptime;
		$data['regtime']=$regtime;
		$data['state']=0;
		//dump($data);
		if($User->add($data)){//写入成功，发邮件
		Vendor('PHPMailer.PHPMailerAutoload');//引用发送邮件类
		//Vendor('PHPMailer.class.smtp');//引用发送邮件类
			$mail = new \PHPMailer();
 
		//是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
		$mail->SMTPDebug = 0;
 
		//使用smtp鉴权方式发送邮件，当然你可以选择pop方式 sendmail方式等 本文不做详解
		//可以参考http://phpmailer.github.io/PHPMailer/当中的详细介绍
		$mail->isSMTP();
		//smtp需要鉴权 这个必须是true
		$mail->SMTPAuth=true;
		//链接qq域名邮箱的服务器地址
		$mail->Host = 'smtp.qq.com';
		//设置使用ssl加密方式登录鉴权
		$mail->SMTPSecure = 'ssl';
		//设置ssl连接smtp服务器的远程服务器端口号 可选465或587
		$mail->Port = 465;
		//设置smtp的helo消息头 这个可有可无 内容任意
		$mail->Helo = 'Hello smtp.qq.com Server';
		//设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
		$mail->Hostname = 'csbroswer.cn';
		//设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
		$mail->CharSet = 'UTF-8';
		//设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
		$mail->FromName = '易学助手邮箱验证';
		//smtp登录的账号 这里填入字符串格式的qq号即可
		$mail->Username ='2290403594';
		//smtp登录的密码 这里填入“授权码” 
		$mail->Password = 'uiukwkdvwtylebjd';
		//设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
		$mail->From = 'estudy@csbroswer.cn';
		//邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
		$mail->isHTML(true); 
		//设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
		$mail->addAddress($data['email'],'易学助手用户');
		//添加多个收件人 则多次调用方法即可
		//$mail->addAddress('xxx@163.com','晶晶在线用户');
		//添加该邮件的主题
		$mail->Subject = '易学助手邮箱验证';
		//添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
		$mail->Body =  "亲爱的".$data['username']."：<br/>请点击链接激活您的帐号。<br/><a href='http://estudy.csbroswer.cn/home/register/active.html?verify=".$token."' target='_blank'>http://estudy.csbroswer.cn/register/active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'></p>";//邮件内容
		//为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
		//$mail->addAttachment('./d.jpg','mm.jpg');
		//同样该方法可以多次调用 上传多个附件
		//$mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');
 
 
		//发送命令 返回布尔值 
		//PS：经过测试，要是收件人不存在，若不出现错误依然返回true 也就是说在发送之前 自己需要些方法实现检测该邮箱是否真实有效
		$status = $mail->send();
	    $this->success('请接收邮件进行验证,没有验证的用户无法登陆',U('/'),10);
		}
	}
	public function findpassword(){
		$this->display();
       }
       public function active(){
       	$User = M('users');
       	$verify = stripslashes(trim($_GET['verify']));
		//dump($verify);
		$nowtime = time();
		$result = $result = $User ->getByToken($verify);
		//dump($result);
		$condition['userid'] = $result['userid'];
		$data['state'] = 1;
		if($result){
			if($nowtime>$result['token_exptime']){
				$msg = '您的激活有效期已过，请登录您的帐号重新发送激活邮件.';
			}else{
				//$data[]
				if(!($User->where($condition)->save($data))) die(0);
					$msg = '激活成功！';
					$this->success('激活成功！',U('home/login/login'),5);
				}
			}else{
				$msg = 'error';
		}
    	}
}
