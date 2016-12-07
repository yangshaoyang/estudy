<?php
/*
作者：李小雨
日期：2016.12.6
描述：论坛控制器
*/
namespace Home\Controller;
use Think\Controller;
use \Library\Page;
class ForumController extends Controller {
	//论坛list页获取分类数据的方法
    protected function _tag($id){
    	/*选取分类1数据*/
	    $forum=M("forum")->where("typeid=$id");
	    /*分页码*/
		// 1. 获取记录总条数
        $count =$forum->count();
        // 2. 设置（获取）每一页显示的个数
        $pageSize =5;
        // 3. 创建分页类对象
        $page = new Page($count, $pageSize);
      //4.构造查询条件
        $condition=array();
        $condition['typeid']=$id;
        // 5. 分页查询
        $forum= $forum->where($condition)->order('forumid desc')
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        //6定义分页样式
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        // 7. 输出查询结果
        $pages=$page->show();
        //8.构建返回结果
        $res['id']=$id;
        $res['forum']=$forum;
        $res['pages']=$pages;
        
        return $res;
    }

    //论坛list页展示分类数据的方法
    public function tag($id){
    	/*分类数据*/
    	$sort=$this->_tag($id);
    	/*热议榜数据*/
        $forum_hot=M("forum")->order('readcount desc')->limit(5)->select();
        $this->assign('forum_hot', $forum_hot);
        //输出结果
        $this->assign('id', $sort['id']);
        $this->assign('forum', $sort['forum']);
        $this->assign('pages', $sort['pages']);
        $this->display('index');
    }

    //处理提交表单方法
    public function addForum(){
        if(IS_POST){
        	//1.I函数获取数据
        	$data=array();
        	$data=I('post.');
        	$data['content']=$data['editorValue'];
        	$data['userid']=5;
        	$data['posttime']=2016-12-5;
        	//dump($data);
        	//2插入数据
        	$editModel = M('forum');
        	if($editModel->add($data)){
        		$typeid=$data['typeid'];
        		$this->redirect("/home/forum/tag/id/$typeid");
        	}
        }
    }

	//论坛list页的控制器
    public function index(){
    	/*分类数据*/
    	$sort=$this->_tag(1);

    	/*热议榜数据*/
        $forum_hot=M("forum")->order('readcount desc')->limit(5)->select();
        $this->assign('forum_hot', $forum_hot);
        //输出结果
        $this->assign('id', $sort['id']);
        $this->assign('forum', $sort['forum']);
        $this->assign('pages', $sort['pages']);
        $this->display();
    }

    //论坛内容页的控制器
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

    

}
