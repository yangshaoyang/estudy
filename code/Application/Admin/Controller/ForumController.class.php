<?php
/*
作者：李小雨
日期：2016.12.20
描述：论坛后台控制器
*/
namespace Admin\Controller;
use Think\Controller;
use \Library\Page;

class ForumController extends Controller {
  //论坛content页获取评论数据的方法
    protected function _comment($id){
      /*对应id的评论*/
        $forum_comment=M("forum_comment")->where("forumid=$id");
      /*分页码*/
         // 1. 获取记录总条数
        $count =$forum_comment->count();
        // 2. 设置（获取）每一页显示的个数
        $pageSize =10;
        // 3. 创建分页类对象
        $page = new Page($count, $pageSize);
        // 4. 分页查询
        $Model=M();
        $forum_comment=$Model->field('username,avatar_url,createtime,forum_comment,forum_answerid')
                ->table(array('users'=>'a','forum_comment'=>'b'))
                ->where("a.userid=b.userid AND forumid=$id")->order('createtime')
                ->limit($page->firstRow.','.$page->listRows)
                  ->select();
        // 5.定义分页样式
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        // 6. 输出查询结果

        $pages=$page->show();
        // 7.构建返回结果
        $res['id']=$id;
        $res['pages']=$pages;
        $res['count']=$count;
        $res['forum_comment']=$forum_comment;
        return $res;
    }

	//论坛管理帖子页
  public function index(){
    $Model=M();
    $forum=$Model->field('typename,username,forumid,title,posttime,readcount')
  	  			->table(array('users'=>'a','forum'=>'b','forum_sort'=>'c'))
  	  			->where("a.userid=b.userid AND b.typeid=c.typeid")
  	  			->order('posttime desc')->select();
  	$this->assign("forum",$forum);
  	$this->display();
  }

  //论坛管理评论页
  public function questions($forumid){
  	//找id对应的帖子内容
  	$forum=M("forum");
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
    //评论数据
    $res=$this->_comment($forumid);
    $comment=$res['forum_comment'];
    $this->assign('id', $res['id']);
    $this->assign('pages', $res['pages']);
    $this->assign('count_comment',$res['count']);
    $this->assign('comment',$comment);
    //输出结果
    $this->display();
  }

  //论坛帖子删除函数
  public function delete($forumid){
    //删帖
    $delforum=M("forum")->delete($forumid);
    //删除帖子的评论
    $comment=M("forum_comment")->where("forumid=$forumid");
    $delcomment=$comment->delete();
    if(!$comment->select){
      $delcomment='1';
    }
    if($delforum&&$delcomment){
        $this->success("删除成功！");
    }else{
      $this->error("删除出错啦/(ㄒoㄒ)/~~");
    }
  }

    //论坛管理评论
    public function comment(){
        $Model=M();
        $forum_comment=$Model->field('username,forum_commentid,title,createtime,forum_comment,b.forumid')
    		  			->table(array('users'=>'a','forum_comment'=>'b','forum'=>'c'))
    		  			->where("a.userid=b.userid AND b.forumid=c.forumid")
    		  			->order('createtime desc')->select();
        $this->assign("comment",$forum_comment);
        $this->display();
    }
    //论坛管理评论
    public function deleteComment($forum_commentid){
        if (M("forum_comment")->delete($forum_commentid)) {
            $this->success("删除成功！");
        }else{
            $this->error("删除出错啦/(ㄒoㄒ)/~~");
        }
    }
 }
