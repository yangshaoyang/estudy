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
    public function editmessage($userid){
        $users=M("users")->find($userid);
        //dump($users);
        $this->assign("users",$users);
        $this->display();
    }
    public function permessage($userid){
      $users=M("users")->find($userid);;
        //dump($users);
        $this->assign("users",$users);
        $this->display();
     
    }
    public function delete($userid){
        $userid = $_GET['userid'];
        if (M("users")->delete($userid)) {
            $this->success("删除成功！");
    }
  }
}