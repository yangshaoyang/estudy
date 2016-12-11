<?php
namespace Admin\Controller;
use Think\Controller;
class ForumController extends Controller {
     public function index(){
       $forum = M("forum")->select();
	   $this->assign("forum",$forum);
	   $this->display();
     }
      public function questions($forumid){
    	//找id对应的帖子内容
    	$forum=M("forum");
    		//阅读量
				$forum->where("forumid=$forumid")->setInc('readcount');
    	$forum=$forum->find($forumid);
		$this->assign("fcontent",$forum);
		
		//分类名称
			//1.构造查询条件
			$condition=array();
			$condition['typeid']=M("forum")->where("forumid=$forumid")->getField('typeid');
			//2.查询分类名称
			$typename=M("forum_sort")->where($condition)->getField('typename');
			//dump($typename);
			$this->assign("typename",$typename);

		//发帖人名称
			//1.构造查询条件
			$condition=array();
			$condition['userid']=M("forum")->where("forumid=$forumid")->getField('userid');
			//2.查询分类名称
			$username=M("users")->where($condition)->getField('username');
			//dump($typename);
			$this->assign("username",$username);

        //输出结果
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
