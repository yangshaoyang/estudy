<?php
namespace Home\Controller;
use Think\Controller;
use \Library\Page;
class MatchController extends Controller {
	public function index(){
		$this->display();
	}
	 public function matchlist(){
	 	/*选取分类1数据*/
	 	$matchpage=M("match")->where("typeid=1");
	 	/*分页码*/
		// 1. 获取记录总条数
		$count =$matchpage->count();
		// 2. 设置（获取）每一页显示的个数
		$pageSize =5;
		// 3. 创建分页类对象
		$page = new Page($count, $pageSize);
		// 4.构造查询条件
		$condition=array();
		$condition['typeid']=1;
		// 5. 分页查询
	      $forum1 = $forum1->where($condition)->order('forumid desc')
	          ->limit($page->firstRow.','.$page->listRows)
	          ->select();
	      // 6. 定义分页样式
	      $page->setConfig('prev','上一页');
	      $page->setConfig('next','下一页');
	      // 7. 输出查询结果
	      $this->assign('forum', $forum1);
	      $pages=$page->show();
	      $this->assign('pages',$pages);

	      $match=M("match")->select();
	      $this->assign("match",$match);
	      $this->display();
	}
	public function content($mid){
		$match=M("match")->find($mid);
		$this->assign("mcontent",$match);
		$tmatch=M("match")->limit(3)->select();//比赛推荐部分
	      $this->assign("tmatch",$tmatch);
	      $this->display();
	}

}
