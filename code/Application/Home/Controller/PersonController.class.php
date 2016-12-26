<?php
/*
作者：徐稳越
日期：2016.12.26  15:04
描述：个人中心控制器
*/
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
class PersonController extends Controller {
    public function index(){
        if ($_SESSION['name'] == NULL) {
          $this->redirect('home/login/login','请登录');
        }else{
        }
    }

    public function homepage(){
       if ($_SESSION['name'] == NULL) {
          $this->success('请先登录',U('home/login/login'));
        }else{

          //输出个人信息
          $map['username']=$_SESSION['name'];
          $username=$_SESSION['name'];
          $users=M("users")->where($map)->select();
          $this->assign("users",$users[0]);
          $certificate=M("certificate")->table(array('user_certificate'=>'a','certificate'=>'b'))
                                       ->where(" a.certificateid=b.cid AND num=0 AND username='$username'")
                                       ->order('time desc')->limit(4)->select();
          $match=M("match")->table(array('user_match'=>'a','match'=>'b'))
                                       ->where(" a.matchid=b.mid AND num=0 AND username='$username'")
                                       ->order('time desc')->limit(4)->select();
          $this->assign("certificate",$certificate);
          $this->assign("match",$match);
          $this->display();
      }
    }
    public function message(){
       if ($_SESSION['name'] == NULL) {
          $this->success('请先登录',U('home/login/login'));
        }else{
          //消息获取
          $map['username']=$_SESSION['name'];
          $username=$_SESSION['name'];
          $users=M("users")->where($map)->select();
          $certificate=M("certificate")->table(array('user_certificate'=>'a','certificate'=>'b'))
                                       ->where(" a.certificateid=b.cid AND username='$username'") ->select();
          $match=M("match")->table(array('user_match'=>'a','match'=>'b'))
                                       ->where(" a.matchid=b.mid AND username='$username' ") ->select();
          $this->assign("users",$users[0]);
          $this->assign("certificate",$certificate);
          $this->assign("match",$match);
          $this->display();
        }
    }
    public function permessage(){
        if ($_SESSION['name'] == NULL) {
          $this->success('请先登录',U('home/login/login'));
        }else{
          $map['username']=$_SESSION['name'];
          $users=M("users")->where($map)->select();
          $this->assign("users",$users[0]);
          $this->display();
    }
  }
    public function add($username){
        if ($_SESSION['name'] == NULL) {
          $this->success('请先登录',U('home/login/login'));
        }else{
         $data=array(
          'username' =>session('name'),
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
        if(empty($image)){
          $data1=array('avatar_url1'=>I('post.avatar_url'));//avatar_url1
          $image=$data1;
        }else{
        $data['avatar_url']=$image;
        }
        // $data['avatar_url']=$image;
        // dump($data);
        $Model=M("users");
        $map['username']=$username;
        // dump($map);
        $num=$Model->where($map)->save($data);
        if($num>0){
            $this->success("添加成功！",U('home/Person/homepage'));
          }else{
            // $this->error("添加失败！");
             $this->redirect('home/person/permessage');
          }
        }
    }

    public function repassword(){
        if ($_SESSION['name'] == NULL) {
          $this->success('请先登录',U('home/login/login'));
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
         $this->success('请先登录',U('home/login/login'));
       }else{
          $users=M("users");
          $password =$users->getFieldByusername($username,'password');
          //dump($password);
         //提交修改密码表单
          $data=array(
              'password' => md5(I('post.newpassword'))
              );
          $Data=array(
            'password' => md5(I('post.repassword'))
            );
          // dump($data);
         if(md5(I('post.oldpassword')) == $password && $data==$Data  ){

            if(strlen(I('post.newpassword'))>=6){
             $map['username']=$username;
             $num=$users->where($map)->save($data);
             $this->success("修改成功！",U("home/login/login"));
            }else{
             $this->error("修改失败,密码应至少6位！",U("home/person/repassword"));
          }
         }else{
          if (md5(I('post.oldpassword')) !== $password) {
            $this->error("旧密码不正确，请重新输入！",U("home/person/repassword"));
          }else{
          $this->error('确认密码与新密码不相同，请重新输入！',U("home/person/repassword"));
           }
         }
         $this->display();
       }
      }
     public function uccontent($cid){
      $certificate=M("certificate")->find($cid);
      $this->assign("ccontent",$certificate);
      $tcertificate=M("certificate")->limit(3)->select();//比赛推荐部分
      $this->assign("tcertificate",$tcertificate);
      $news=M("news")->order("newsid desc")->limit(7)->select();//热门资讯获取
      $this->assign("news",$news);
      //消息点击数量加1
      $user_certificate=M("user_certificate")->table(array('user_certificate'=>'a','certificate'=>'b'))
                             ->where("a.certificateid=b.cid AND cid=$cid")
                             ->setInc('num');
      $this->assign("user_certificate",$user_certificate);
      $this->display();
    }
    public function umcontent($mid){
      $match=M("match")->find($mid);
      $this->assign("mcontent",$match);
      $tmatch=M("match")->limit(3)->select();//比赛推荐部分
      $this->assign("tmatch",$tmatch);
      $news=M("news")->order("newsid desc")->limit(7)->select();//热门资讯获取
      $this->assign("news",$news);
      //消息点击数量加1
      $user_match=M("user_match")->table(array('user_match'=>'a','match'=>'b'))
                             ->where("a.matchid=b.mid AND mid=$mid")
                             ->setInc('num');
      $this->assign("user_match",$user_match);
      $this->display();
    }
    public function search(){
        if(isset($_GET['text'])){
          $data=$_GET['text'];
            // dump($data);
          $map['username']=$_SESSION['name'];
          $username=$_SESSION['name'];
          $users=M("users")->where($map)->select();
          $this->assign("users",$users[0]);
          $certificate=M("certificate")->table(array('user_certificate'=>'a','certificate'=>'b'))
                                       ->where(" a.certificateid=b.cid AND cname like '%$data%' AND username='$username'") ->select();
          $match=M("match")->table(array('user_match'=>'a','match'=>'b'))
                                       ->where(" a.matchid=b.mid  AND mname like '%$data%' AND username='$username'") ->select();
          $this->assign("certificate",$certificate);
          $this->assign("match",$match);
          if ($match == NULL && $certificate == NULL) {
            $this->error("搜索无结果",U("message"));
          }else{
          $this->display();
          }
        }
          else{
          $this->error("您肿么到这里了/(ㄒoㄒ)/~~，快回去",U("message"));
          }
      }

}
