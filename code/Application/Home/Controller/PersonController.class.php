<!-- 
文件：前台个人中心控制器
作者：徐稳越
最后修改日期：2016年12月12日 
-->
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
          
          //输出个人信息
          $map['username']=$_SESSION['name'];
          $users=M("users")->where($map)->select();
          $user_certificate=M("user_certificate")->order('time desc')->limit(4)->select();
          $user_match=M("user_match")->order('time desc')->limit(4)->select();
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
          $user_certificate=M("user_certificate")->order('time desc')->limit(4)->select();
          $user_match=M("user_match")->order('time desc')->limit(4)->select();
          $this->assign("user_certificate",$user_certificate);
          $this->assign("user_match",$user_match);
          $this->display();
        }
    }
    public function permessage(){
        if ($_SESSION['name'] == NULL) {
          $this->redirect('home/login/login','请登录');
        }else{
          $map['username']=$_SESSION['name'];
          $users=M("users")->where($map)->select();
          $this->assign("users",$users[0]);
          $this->display();
    }
  }
    public function add($username){
        if ($_SESSION['name'] == NULL) {
          $this->redirect('home/login/login','请登录');
        }else{
         $data=array(
          'username' =>I('post.username'),
          'sex'=>I('post.sex'),
          'major'=>I('post.major'),
          'colleage'=>I('post.colleage'),
          'city'=>I('post.city'),
          'hobby'=>I('post.hobby')
         );
        
        $Model=M("users");
        $Model->create();
        $map[username]=$username;
        $num=$Model->where($map)->save($data);
        // if($num>0){
        //   $this->success("添加成功！",U("users"));
        // }else{
        //   $this->error("添加失败！",U("users"));
        // }
          $this->redirect('home/person/homepage');
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
