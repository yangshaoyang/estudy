<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        $this->display();
    }
    //判断该管理员是否存在
    public function checkadmin(){
    	$name = I('post.adname');
    	$password = md5(I('post.passwordhash'));
    	$data = M('admin');
    	$adpassword =  $data->getFieldByadname($name,'adpassword');
    	if($password == $adpassword){
    			session('name',$name);
    			$this->success('登陆中...',U('admin/index/index'));
    	}else{
    		$this->error('用户名或密码不正确',U('admin/login/login'));
    	}
    }

    public function exits(){
    	session('name',null);
    	$this->redirect('/');
    }
}
