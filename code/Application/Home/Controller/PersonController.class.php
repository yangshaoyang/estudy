<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
class PersonController extends Controller {
    public function index(){
        if ($_SESSION['name'] == NULL) {
          $this->redirect('home/login/login','请登录');
        }else{
          // $this->display();
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
          
          //消息获取
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
        $upload = new \Think\Upload();//
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        //$upload->rootPath  =     THINK_PATH; // 设置附件上传根目录
        $upload->savePath  =     '../Public/Uploads/uploads';  // 设置附件上传（子）目录
        $info   =   $upload->upload();
        //dump($info);
        $image = $info['avatar_url']['savepath'].$info['avatar_url']['savename'];
        // dump($image);
        $data['avatar_url']=$image;
        // dump($data);
        $Model=M("users");
        $map['username']=$username;
        // dump($map);
        $num=$Model->where($map)->save($data);
        if($num>0){
            $this->success("添加成功！",U('home/Person/homepage'));
          }else{
            $this->error("添加失败！");
          }
        
        $Model=M("users");
        $Model->create();
        $map['username']=$username;
        $num=$Model->where($map)->save($data);
        $this->redirect('home/person/homepage');
        }
    }

    public function repassword(){
        if ($_SESSION['name'] == NULL) {
          $this->redirect('home/login/login','请登录');
        }else{
          $map['username']=$_SESSION['name'];
          $users=M("users")->where($map)->select();
          $this->assign("users",$users[0]);
          $this->display();
        }
    }

      public function changepswd($username){
        //先判断是否登录
        if($_SESSION['name'] == NULL){
        $this->redirect('home/login/login');
      }else{
            $users=M("users");
            $password =$users->getFieldByusername($username,'password');
            //dump($password);
           //提交修改密码表单
            $data=array(
                'password' => md5(I('post.newpassword'))
                );
            // dump($data);
           if(md5(I('post.oldpassword')) == $password){
              $map['username']=$username;
              $num=$users->where($map)->save($data);
              // var_dump($num);
              // exit;
              if($num>0){
               $this->success("修改成功！",U("home/login/login"));
              }else{
               $this->error("修改失败！");
            }
           }else{
            $this->error('旧密码不正确，请重新输入！',U("home/person/repassword"));
           }
           $this->display();
         }
        }
    // public function addimage($username){
    //     $upload = new \Think\Upload();//
    //     $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    //     //$upload->rootPath  =     THINK_PATH; // 设置附件上传根目录
    //     $upload->savePath  =     '../Public/Uploads/uploads';  // 设置附件上传（子）目录
    //     $info   =   $upload->upload();
    //     //dump($info);
    //     $image = $info['avatar_url']['savepath'].$info['avatar_url']['savename'];
    //     // dump($image);
    //     $data['avatar_url']=$image;
    //     // dump($data);
    //     $Model=M("users");
    //     $map['username']=$username;
    //     // dump($map);
    //     $num=$Model->where($map)->save($data);
    //     if($num>0){
    //         $this->success("添加成功！",U('home/Person/permessage'));
    //       }else{
    //         $this->error("添加失败！");
    //       }
    // }

}
