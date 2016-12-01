<?php
namespace Admin\Controller;
use Think\Controller;
class MatchController extends Controller {
    public function index(){
        $match = M("match")->
select();
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
    public function add(){
    	if(!IS_POST){
            exit("bad request");
        }
         $data=array(
    			'mname' =>I('post.mname'),
    			'mtime'  =>I('post.mtime'),
    			'mrequest'=>I('post.mrequest'),
    			'mfee'    =>I('post.mfee'),
    			'murl'   =>I('post.murl'),
    			'mcontent'  =>I('post.mcontent')
    			);

        $Model=D("match");
        $Model->create();
        $num=$Model->add($data);
        if($num>0){
        	$this->success("添加成功！",U("bid"));
        }else{
        	$this->error("添加失败！",U("bid"));
        }

        $this->display();
    }
    public function editmatch($mid){
	  $match=M("match")->find($mid);
	  $this->assign("mcontent",$match);
	  $this->display();
	}
}
