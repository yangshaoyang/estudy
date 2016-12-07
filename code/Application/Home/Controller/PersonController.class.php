<?php
namespace Home\Controller;
use Think\Controller;
class PersonController extends Controller {
    public function index(){
        if ($_SESSION['name'] == NULL) {
          $this->redirect('home/login/login','请登录');
        }else{
          $this->display();
        }
    }

    public function homepage(){
       if ($_SESSION['name'] == NULL) {
          $this->redirect('home/login/login','请登录');
        }else{
          $map['userid']=1;
          $users=M("users")->where($map)->select();
          $user_certificate=M("user_certificate")->select();
          $user_match=M("user_match")->select();
          $this->assign("users",$users[0]);
          $this->assign("user_certificate",$user_certificate);
          $this->assign("user_match",$user_match);
          $this->display();
      }
    }
    public function message(){
       if ($_SESSION['name'] == NULL) {
          $this->redirect('home/login/login','请登录');
        }else{
          $user_certificate=M("user_certificate")->select();
          $user_match=M("user_match")->select();
          $this->assign("user_certificate",$user_certificate);
          $this->assign("user_match",$user_match);
          $this->display();
        }
    }
    public function permessage(){
        if ($_SESSION['name'] == NULL) {
          $this->redirect('home/login/login','请登录');
        }else{
          $this->display();
        }
    }
    public function add(){
        if ($_SESSION['name'] == NULL) {
          $this->redirect('home/login/login','请登录');
        }else{
          $this->display();
        }
    }

    public function repassword(){
        if ($_SESSION['name'] == NULL) {
          $this->redirect('home/login/login','请登录');
        }else{
          $this->display();
        }
    }

}
