<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class MatchController extends Controller {
    public function index(){
          $match = M("match")->select();
          $this->assign("match",$match);
          $this->display();
    }
    public function content($mid){
        $match=M("match")->find($mid);
        $this->assign("mcontent",$match);
        $this->display();
    }
    public function addimage(){
        $data = array();
        $data['statusCode']=200;
        $data['message']="上传成功";
        echo json_encode($data);
    }
    public function add(){
        if(!IS_POST){
            exit("bad request");
        }
        $upload = new \Think\Upload();//
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $info   =   $upload->upload();
        $image = $info['mthumb']['savename'];
        $data=array(
    	'mname' =>I('post.mname'),
    	'mtime'  =>I('post.mtime'),
    	'mrequest'=>I('post.mrequest'),
    	'mfee'    =>I('post.mfee'),
             //'mthumb'    => $image,
    	'murl'   =>I('post.murl'),
    	'mcontent'  =>I('post.mcontent')
    	);
        $Model=D("match");
        $Model->create();
        $num=$Model->add($data);
        if($num>0){
        	$this->success("添加成功！",U("match"));
        }else{
        	$this->error("添加失败！",U("match"));
        }
        $this->display();
    }
    public function editmatch($mid){
        $match=M("match")->find($mid);
        $this->assign("mcontent",$match);
        $this->display();
        }
    public function edit($mid){
        $data=array(
            'mname'     =>I('post.mname'),
            'mtime'       =>I('post.mtime'),
            'mrequest'=>I('post.mrequest'),
            'mfee'    =>I('post.mfee'),
            'murl'   =>I('post.murl'),
            'mcontent'  =>I('post.content')
        );
        $Model=M("match");
        $num=$Model->where('mid='.$mid)->save($data);
        if($num>0){
            $this->success("修改成功！");
        }else{
            $this->error("修改失败！");
        }
        $this->display();
    }
    public function delete($mid){
        if (M("match")->delete($mid)) {
            $this->success("删除成功！");
    }
}
}
