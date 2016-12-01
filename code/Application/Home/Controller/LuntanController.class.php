<?php
namespace Home\Controller;
use Think\Controller;
use \Library\Page;
class LuntanController extends Controller {
    public function index(){
    	/*选取数据*/
	    	$forum=M("forum")->where("typeid=1");
	    /*分页码*/
		// 1. 获取记录总条数
        $count =$forum->count();
        // 2. 设置（获取）每一页显示的个数
        $pageSize =7;
        // 3. 创建分页类对象
        $page = new Page($count, $pageSize);
      //4.构造查询条件
        $condition=array();
        $condition['typeid']=1;
        // 5. 分页查询
        $forum = $forum->where($condition)
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        //6定义分页样式
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        // 7. 输出查询结果
        $this->assign('forum', $forum);
        $pages=$page->show();
        $this->assign('pages',$pages);
        $this->display();
    }
    public function questions($forumid){
    	$forum=M("forum");
    	/*文章阅读量+1*/
		$forum->where('forumid=1')->setInc('readcount');
    	$forum=$forum->find($forumid);
		$this->assign("fcontent",$forum);
		
		/*$tmatch=M("match")->limit(3)->select();//比赛推荐部分
	      $this->assign("tmatch",$tmatch);
		$this->display();*/
        $this->display();
    }
}
