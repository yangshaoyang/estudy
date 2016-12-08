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
    public function edit($mid){
        $this->display();
    }

    public function addimage($mid){
        $upload = new \Think\Upload();//
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
    // 上传文件
        $info   =   $upload->upload();
//dump($info);
        $image = $info['mthumb']['savename'];
        $data = array();
        $data['statusCode']=200;
        $data['message']="上传成功";
        $data['filename']='tttt';

        echo json_encode($data);
    }
    public function add(){
        if(!IS_POST){
            exit("bad request");
    }

        // $upload = new \Think\Upload();
        // $upload->rootPath   = './Public/home';
        // $upload->savePath  ='/Upload';
        // $info = $upload->uploadOne($_FILES['image']);
        // $image = $info['upload']['savename'];
        // dump($image);
        $upload = new \Think\Upload();//
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
    // 上传文件
        $info   =   $upload->upload();
//dump($info);
        $image = $info['mthumb']['savename'];
  //       dump($image);
        $data=array(
    	'mname' =>I('post.mname'),
    	'mtime'  =>I('post.mtime'),
    	'mrequest'=>I('post.mrequest'),
    	'mfee'    =>I('post.mfee'),
             'mthumb'    => $image,
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
    public function delete($mid){
        $mid = $_GET['mid'];
        if (M("match")->delete($mid)) {
            $this->success("删除成功！");
    }
}
}
