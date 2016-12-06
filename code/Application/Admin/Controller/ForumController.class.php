<?php
namespace Admin\Controller;
use Think\Controller;
class ForumController extends Controller {
     public function index(){
       $forum = M("forum")->select();
	   $this->assign("forum",$forum);
	   $this->display();
     }
     public function forumdetails($forumid){
	   $forum=M("forum")->find($forumid);
	   $this->assign("forumcontent",$forum);
	   $this->display();
	 }
     public function edit($forumid){
	   $this->display();
	 }
     public function addforum(){
         $this->display();
     }
	public function add(){
    	if(!IS_POST){
            exit("bad request");
        }
         $data=array(   	    
    			'forumtitle' =>I('post.forumtitle'),
    			'forumauthor' =>I('post.forumauthor'),
    			'forumtime'  =>I('post.forumtime'),
    			'forumintroduction' =>I('post.forumintroduction'),	
    			'forumcontent'  =>I('post.forumcontent')
    			);

        $Model=D("forum");
        $Model->create();
        $num=$Model->add($data);
        if($num>0){
        	$this->success("添加成功！",U("bid"));
        }else{
        	$this->error("添加失败！",U("bid"));
        }

        $this->display();
    }
     public function editforum($forumid){
	  $forum=M("forum")->find($forumid);
	   $this->assign("forumcontent",$forum);
	   $this->display();
	 }
 }
