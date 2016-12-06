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
		$result = $User ->getFieldByUsername($username,'userid');
		//dump($User->_sql());
		$num = count($result);
		//dump($num);
		if($num==1){
			echo '<script>alert("用户名已存在，请换个其他的用户名");window.history.go(-1);</script>';
			exit;
		}
		$data['password'] = md5($data['password']);
		$data['email'] = trim($data['email']);
		$regtime = time();
		$token = md5($username.$password.$regtime); //创建用于激活识别码
		$token_exptime = time()+60*60*24;//过期时间为24小时后
		$data['token']=$token;
		$data['token_exptime']=$token_exptime;
		$data['regtime']=$regtime;
		$data['state']=0;
		if($User->add($data)){//写入成功，发邮件
			import("HomeClass.smtp");//引用发送邮件类
			$smtpserver     =     "smtp.126.com";//SMTP服务器
	             $smtpserverport =    25;//SMTP服务器端口
	             $smtpusermail     =     "zykjinghuashuiyue@126.com";//SMTP服务器的用户邮箱
	             $smtpuser         =     "zykjinghuashuiyue@126.com";//SMTP服务器的用户帐号
	             $smtppass         =     "zyk1350316";//SMTP服务器的用户密码

      	             $smtpemailto     =     $data['email'];//发送给谁
	         //dump($smtpemailto);
	             $mailsubject     =     "用户帐号激活";//邮件主题
	             $mailtime        =    date("Y-m-d H:i:s");
	             $mailbody         =     "亲爱的".$data['username']."：<br/>请点击链接激活您的帐号。<br/><a href='http://localhost/project/thinkphp/index.php/home/register/active.html?verify=".$token."' target='_blank'>http://www.helloweba.com/demo/register/active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'></p>";//邮件内容

	             $utfmailbody    =    iconv("GB2312","UTF-8",$mailbody);//转换邮件编码
	             $mailtype         =     "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件

	             $smtp = new \smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	             $smtp->debug = FALSE;//是否显示发送的调试信息 FALSE or TRUE

	             $datas = $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
	        //$this->success("输出的提示信息",U('home/login/login'));
	            $this->redirect('home/login/login');
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
				}
			}else{
			$msg = 'error';
		}

			echo $msg;
    	}
}
