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
    	$password = md5(I('post.adpassword'));
    	$data = M('admin');
    	$adminid = $data->getFieldByAdminid($name,'adminid');
    	$adname =  $data->getFieldByAdname($name,'adname');
    	$adpassword =  $data->getFieldByAdname($name,'adpassword');
        // var_dump($adminid,$adname,$adpassword);
        // exits;
    	if($password == $adpassword){
    			session('name',$name);
    			$this->success('登陆中...',U('admin/index/index'));
    	}else{
    		$this->error('用户名或密码不正确',U('admin/login/login'));
    	}
    }
    public function exits(){
    	session('name',null);
    	$this->redirect('admin/login/login');
    }
}