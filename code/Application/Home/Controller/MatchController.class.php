<?php
namespace Home\Controller;
use Think\Controller;
use \Library\Page;
/**
 *比赛管理控制器
 */

class MatchController extends Controller {
	public function index(){
		$this->display();
	}
	 public function matchlist(){
	 	/*选取分类1数据*/
	 	$matchpage=M("match")->where("mid");
	 	/*分页码*/
		// 1. 获取记录总条数
		$count =$matchpage->count();
		// 2. 设置（获取）每一页显示的个数
		$pageSize =8;
		// 3. 创建分页类对象
		$page = new Page($count, $pageSize);
		// 4.构造查询条件
		$condition=array();
		$condition['mid'] != NULL;
		// 5. 分页查询
	      $matchpage = $matchpage->where($condition)->order('mid desc')
	          ->limit($page->firstRow.','.$page->listRows)
	          ->select();
	      // 6. 定义分页样式
	      $page->setConfig('prev','上一页');
	      $page->setConfig('next','下一页');
	      // 7. 输出查询结果
	      $this->assign('match', $matchpage);//遍历数据数据
	      $pages=$page->show();
	      $this->assign('pages',$pages);

	      //$match=M("match")->select();
	      //$this->assign("match",$match);
	      $this->display();
	}
	public function content($mid){
		$match=M("match")->find($mid);
		$this->assign("mcontent",$match);
		$tmatch=M("match")->limit(3)->select();//比赛推荐部分
	      $this->assign("tmatch",$tmatch);
	      $this->display();
	}
	public function user($mid){
		//
		$user = $_SESSION['name'];
		$match=M("user_match");

		$data=array(
		    	'mname' =>I('post.mname'),
		    	'mtime'  =>I('post.mtime'),
		    	'mrequest'=>I('post.mrequest'),
		    	'mfee'    =>I('post.mfee'),
		             'mthumb'    => $image,
		    	'murl'   =>I('post.murl'),
		    	'mcontent'  =>I('post.mcontent')
		    	);
	        $Model=D("match");
	        $Model->create();
	        $num=$Model->add($data);
	        if($num>0){
	        	$this->success("添加成功！",U("match"));
	        }else{
	        	$this->error("添加失败！",U("match"));
	        }


	}

}
