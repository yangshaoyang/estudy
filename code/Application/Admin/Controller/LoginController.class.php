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
        if($password == $adpassword){
    	session('adminname',$name);
        session('adminid',$adminid);
    	$this->redirect('../admin');
        }else{
    	$this->error('用户名或密码不正确',U('admin/login/login'));
        }
    }
//注销用户
    public function exits(){
    	session('adminname',null);
        session('adminid',null);
    	$this->redirect('admin/login/login');
    }
}
