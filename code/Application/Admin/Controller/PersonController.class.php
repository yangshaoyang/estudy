<?php
namespace Admin\Controller;
use Think\Controller;
class PersonController extends Controller {
    // public function index(){
    //     $this->display();
    // }

    public function index(){
        $users=M("users")->select();
        // dump($users);
        // $user_certificate=M("user_certificate")->select();
        // $user_match=M("user_match")->select();
        $this->assign("users",$users);
        // $this->assign("user_certificate",$user_certificate);
        // $this->assign("user_match",$user_match);
        $this->display();
    }
    public function message(){
        //$this->display();
          $user_certificate=M("user_certificate")->select();
          $user_match=M("user_match")->select();
          $this->assign("user_certificate",$user_certificate);
          //$this->display();
          
          $this->assign("user_match",$user_match);
          $this->display();
    }
    public function permessage(){
        $this->display();
    }
    public function repassword(){
        $this->display();
    }
}