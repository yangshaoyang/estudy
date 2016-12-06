<?php
namespace Home\Controller;
use Think\Session\Driver;
use Think\Controller;

class LoginController extends Controller {
    public function login(){
        $this->display();
    }
    public function validation(){
        $data = I('post.');
    	$User = M('users');
        $email = $data['yourname'];
        $password = md5($data['yourpassword']);
        dump($password);
        $result = $User->getFieldByEmail($email,'password');
        dump($result);
        $username = $User->getFieldByEmail($email,'username');
        if ($result == $password) {
        	session('name',$username); 
        	$this->redirect('/');
        	
        }else{
        	$this->error('用户名或密码不正确',U('home/login/login'));
        }
    }
}
