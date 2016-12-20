<?php
/*
作者：李小雨
日期：2016.12.20
描述：论坛后台控制器
*/
namespace Admin\Controller;
use Think\Controller;
class ForumController extends Controller {
	//论坛查看帖子页
     public function index(){
     	$Model=M();
        $forum=$Model->field('typename,username,forumid,title,posttime,readcount')
    		  			->table(array('users'=>'a','forum'=>'b','forum_sort'=>'c'))
    		  			->where("a.userid=b.userid AND b.typeid=c.typeid")
    		  			->order('readcount desc')->select();
       	//$forum = M("forum")->select();
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
    
    //论坛帖子删除函数
     public function delete($forumid){
        if (M("forum")->delete($forumid)) {
            $this->success("删除成功！");
        }
    }
    public function test(){ 
      $forum= M('forum');
      $data = $forum->select();
      $data=$this->ajaxReturn($data,'JSON');
      //dump($data);

      $this->assign("data",$data);

        //输出结果
        $this->display('test','utf-8', 'text/json');
    }
 }
