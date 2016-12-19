<?php
namespace Admin\Controller;
use Think\Controller;
class PersonController extends Controller {
    public function index(){
        $users=M("users")->select();
        $this->assign("users",$users);
        $this->display();
    }
    public function editmessage($userid){
        $users=M("users")->find($userid);
        //dump($users);
        $this->assign("users",$users);
        $this->display();
    }
    public function edit($userid){
        $data=array(
          'username' =>I('post.username'),
          'email'=>I('post.email'),
          'sex'=>I('post.sex'),
          'major'=>I('post.major'),
          'colleage'=>I('post.colleage'),
          'city'=>I('post.city'),
          'hobby'=>I('post.hobby')
        );
        // dump($data);
        $Model=M("users");
        $num=$Model->where('userid='.$userid)->save($data);
        if($num>0){
            $this->success("修改成功！",U('admin/Person/index'));
        }else{
            $this->error("修改失败！");
        }
        $this->display();
        // $users=M("users")->find($userid);
        // //dump($users);
        // $this->assign("users",$users);
        // $this->display();
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
