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
	 	/*选取数据*/
	 	$matchpage=M("match")->order("mid desc")->where("mid");
	 	/*分页码*/
		// 1. 获取记录总条数
		$count =$matchpage->count();
		// 2. 设置（获取）每一页显示的个数
		$pageSize =8;
		// 3. 创建分页类对象
		$page = new Page($count, $pageSize);
		// 4. 构造查询条件
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
	     $this->display();
	}
	public function content($mid){
		$match=M("match")->find($mid);
		$this->assign("mcontent",$match);
		$tmatch=M("match")->limit(3)->select();//比赛推荐部分
	     $this->assign("tmatch",$tmatch);
	     $news=M("news")->order("newsid desc")->limit(7)->select();//热门资讯获取
		$this->assign("news",$news);
	     $this->display();
	}
	public function user($mid,$mtime){
		if ($_SESSION['name'] == NULL) {
			$this->redirect('home/login/login','请登录');
		}else{
			//session('mingzi',$mid)
			$_SESSION['mid'] = $mid;
			$user = $_SESSION['name'];
			$data=array(
			    	'username'  =>$user,
			    	'matchid' =>$mid,
			    	'umtype' =>'比赛信息',
			    	'time' =>$mtime
			    	);
		       $Model=D("user_match");
		       $Model->create();
		       $num=$Model->add($data);
		       if($num>0){
		       	$this->success("记录成功！将在比赛开始前给您推送通知及注意事项，请尽快前往官网报名",U("matchlist"),7);
		       }else{
		       	$this->error("添加失败 /(ㄒoㄒ)/~~，请重试",U("matchlist"),5);
		       }
	     	}
	}
	public function search(){
		if(isset($_GET['text'])){
			$data=$_GET['text'];
	     		/*选取数据*/
		 	$matchpage=M("match")->order("mid desc")->where("mname like '%$data%'");
		 	/*分页码*/
			// 1. 获取记录总条数
			$count =$matchpage->count();
			// 2. 设置（获取）每一页显示的个数
			$pageSize =8;
			// 3. 创建分页类对象
			$page = new Page($count, $pageSize);
			// 4. 构造查询条件

			// 5. 分页查询
		      $matchpage = $matchpage->where("mname like '%$data%'")->order('mid desc')
		          ->limit($page->firstRow.','.$page->listRows)
		          ->select();
		      // 6. 定义分页样式
		      $page->setConfig('prev','上一页');
		      $page->setConfig('next','下一页');
		      // 7. 输出查询结果
		      $this->assign('result', $matchpage);//遍历数据数据
		      if ($matchpage == NULL) {
		      	$this->error("搜索无结果",U("matchlist"));
		      }
		      $pages=$page->show();
		      $this->assign('pages',$pages);
	      	$this->display();
	    	}else{
	    		$this->error("您肿么到这里了/(ㄒoㄒ)/~~，快回去",U("matchlist"));
	    	}
    }
}
