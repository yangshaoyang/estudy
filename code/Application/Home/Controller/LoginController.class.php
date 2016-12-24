<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        $this->display();
    }
    public function validation(){
        $data = I('post.');
        $User = M('users');
        $email = $_POST['name'];
        $password = md5($_POST['password']);

        $result = $User->getFieldByEmail($email,'password');
        $username = $User->getFieldByEmail($email,'username');
        $id = $User->getFieldByEmail($email,'userid');
        $num = count($username);
        $state = $User->getFieldByEmail($email,'state');
        $arr['flag']=1;

        if($num == 1){
        if($state==1){  
  
            if($password==$result){  
                $arr['flag']=2; 
                $this->ajaxReturn($arr,json);
        
            }else{  
                $arr['flag']=0; 
                $this->ajaxReturn($arr,json);  
  
                //返回json数据  
  
            }  
  
        }else{  
  
               $this->ajaxReturn($arr,json);  
  
        }
        }else{
            $arr['flag']=0; 
            $this->ajaxReturn($arr,json); 
        }
    }
    public function logined(){
        $data = I('post.');
        $User = M('users');
        $email = $data['yourname'];
        $password = md5($data['yourpassword']);

        $result = $User->getFieldByEmail($email,'password');
        $username = $User->getFieldByEmail($email,'username');
        $id = $User->getFieldByEmail($email,'userid');
        session('name',$username);
        session('id',$id);
        $url=session('path');
         if($url == ""){
             $this->success('登录成功',U('/'));
         }else{
             $this->success('登录成功',$url);
         }

    }
    public function exits(){
        session('name',null);
        session('id',null);
        $this->redirect('/');
    }
}
