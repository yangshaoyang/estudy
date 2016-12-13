<?php
namespace Admin\Controller;
use Think\Controller;
class CertificateController extends Controller {
    public function index(){
        $certificate = M("certificate")->select();
        $this->assign("certificate",$certificate);
        $this->display();
    }
    public function content($cid){
        $certificate=M("certificate")->find($cid);
        $this->assign("ccontent",$certificate);
        $this->display();
    }
    public function add(){
        if(!IS_POST){
            exit("bad request");
        }
        $data=array(
    		'cname' =>I('post.cname'),
    		'ctime'  =>I('post.ctime'),
    		'crequest'=>I('post.crequest'),
    		'cfee'    =>I('post.cfee'),
    		'curl'   =>I('post.curl'),
    		'ccontent'  =>I('post.ccontent')
    	);
        $Model=D("certificate");
        $Model->create();
        $num=$Model->add($data);
        if($num>0){
        	$this->success("添加成功！");
        }else{
        	$this->error("添加失败！");
        }
        $this->display();
    }
    public function editcertificate($cid){
        $certificate=M("certificate")->find($cid);
        $this->assign("ccontent",$certificate);
        $this->display();
    }
    public function edit($cid){
        $data=array(
            'cname' =>I('post.cname'),
            'ctime'  =>I('post.ctime'),
            'crequest'=>I('post.crequest'),
            'cfee'    =>I('post.cfee'),
            'curl'   =>I('post.curl'),
            'ccontent'  =>I('post.ccontent')
        );
        $Model=M("certificate");
        $num=$Model->where('cid='.$cid)->save($data);
        if($num>0){
            $this->success("修改成功！");
        }else{
            $this->error("修改失败！");
        }
        $this->display();

    }
    public function delete($cid){
        $cid = $_GET['cid'];
        if (M("certificate")->delete($cid)) {
            $this->success("删除成功！");
        }
    }
}
