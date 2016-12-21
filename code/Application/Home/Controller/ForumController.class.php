<?php
/*
作者：李小雨
日期：2016.12.6
描述：论坛控制器
*/
namespace Home\Controller;
use Think\Controller;
use \Library\Page;

//编码方式
header("Content-Type: text/html; charset=UTF-8");
class ForumController extends Controller {
    //论坛list页获取分类数据的方法
    protected function _tag($id){
        /*选取分类1数据*/
        $forum=M("forum")->where("typeid=$id");
        /*分页码*/
        // 1. 获取记录总条数
        $count =$forum->count();
        // 2. 设置（获取）每一页显示的个数
        $pageSize =4;
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

    //论坛content页获取评论数据的方法
    protected function _comment($id){
    	/*对应id的评论*/
        $forum_comment=M("forum_comment")->where("forumid=$id");
	    /*分页码*/
		// 1. 获取记录总条数
        $count =$forum_comment->count();
        // 2. 设置（获取）每一页显示的个数
        $pageSize =3;
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

    //搜索功能
    public function search(){
		if(isset($_GET['text'])){
			$data=$_GET['text'];
			/*选取数据*/
		 	$forum_search=M("forum")->where("title like '%$data%'");
		 	/*分页码*/
			// 1. 获取记录总条数
			$count =$forum_search->count();
			// 2. 设置（获取）每一页显示的个数
			$pageSize =4;
			// 3. 创建分页类对象
			$page = new Page($count, $pageSize);
			// 4. 分页查询
		    $forum_search = $forum_search->where("title like '%$data%'")
		    			->order('readcount desc')
		          		->limit($page->firstRow.','.$page->listRows)
		         		->select();
			// 6. 定义分页样式
			$page->setConfig('prev','上一页');
			$page->setConfig('next','下一页');
			// 7. 输出查询结果
			$this->assign('forum_search', $forum_search);
			if ($forum_search == NULL) {
				$this->error("搜索无结果",U("index"));
			}
			$pages=$page->show();
			$this->assign('pages',$pages);
		    //热议榜数据
        	$forum_hot=M("forum")->order('readcount desc')->limit(10)->select();
        	$this->assign('forum_hot', $forum_hot);
		      $this->display();
	    	}else{
	    		$this->error("您肿么到这里了/(ㄒoㄒ)/~~，快回去",U("index"));
	    	}
    }

    //论坛list页展示分类数据的方法
    public function tag($id){
    	/*分类数据*/
        $sort=$this->_tag($id);
    	/*热议榜数据*/
        $forum_hot=M("forum")->order('readcount desc')->limit(10)->select();
        $this->assign('forum_hot', $forum_hot);
        //输出结果
        $this->assign('id', $sort['id']);
        $this->assign('forum', $sort['forum']);
        $this->assign('pages', $sort['pages']);
        $this->display('index');
    }

    //处理论坛提交表单方法
    public function addForum(){
        if(IS_POST){
        	//1.I函数获取数据
        	//dump(session());
        	$data=array();
        	$data=I('post.');
        	$data['content']=$data['editorValue'];
        	$data['userid']=session('id');
        	//dump($data);
        	//2插入数据
            $editModel = M('forum');
        	if($editModel->add($data)){
        		$typeid=$data['typeid'];
        		$this->redirect("/home/forum/tag/id/$typeid");
        	}
        }
    }

    //处理评论提交表单方法
    public function addComment(){
        if(IS_POST){
        	//1.I函数获取数据
        	$data=array();
        	$data=I('post.');
        	$data['userid']=session('id');
        	$data['forum_comment']=$data['editorValue'];
        	$data['forum_answerid']=0;
        	//dump($data);
        	//2插入数据
        	$editModel = M('forum_comment');
        	if($editModel->add($data)){
        		$id=$data['forumid'];
        		$this->redirect("/home/forum/questions/forumid/$id");
        	}
        }
    }

    //论坛list页的控制器
    public function index(){
        /*分类数据*/
        $sort=$this->_tag(1);
        /*热议榜数据*/
        $forum_hot=M("forum")->order('readcount desc')->limit(10)->select();
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
        //热议榜数据
        $forum_hot=M("forum")->order('readcount desc')->limit(10)->select();
        $this->assign('forum_hot', $forum_hot);
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

    //论坛内容页的控制器
    public function suggestions(){
        //输出结果
        $this->display();
    }

    //举报功能控制器
    public function report($username,$forumid){
        if ($_SESSION['name'] == NULL) {
            $this->redirect('home/login/login','请登录');
        }else{
            $data=array(
                    'username'  =>$username,
                    'forumid' =>$forumid
                    );
               $Model=D("report");
               $Model->create();
               $num=$Model->add($data);
               if($num>0){
                $this->success("举报成功！管理员处理后将及时给您反馈",U("home/forum/questions/forumid/$forumid"),5);
               }else{
                $this->error("举报失败 /(ㄒoㄒ)/~~，请重试",U("home/forum/questions/forumid/$forumid"),5);
               }
            }
    }



}
