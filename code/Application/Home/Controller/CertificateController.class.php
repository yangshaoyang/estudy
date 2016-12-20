<?php
namespace Home\Controller;
use Think\Controller;
use \Library\Page;
class CertificateController extends Controller {
	public function index(){
		$this->display();
	}
	 public function certificatelist(){
	 	/*选取数据*/
	 	$certificatepage=M("certificate")->order("cid desc")->where("cid");
	 	/*分页码*/
		// 1. 获取记录总条数
		$count =$certificatepage->count();
		// 2. 设置（获取）每一页显示的个数
		$pageSize =8;
		// 3. 创建分页类对象
		$page = new Page($count, $pageSize);
		// 4.构造查询条件
		$condition=array();
		$condition['cid'] != NULL;
		// 5. 分页查询
	     $certificatepage = $certificatepage->where($condition)->order('cid desc')
	         ->limit($page->firstRow.','.$page->listRows)
	         ->select();
	     // 6. 定义分页样式
	     $page->setConfig('prev','上一页');
	     $page->setConfig('next','下一页');
	     // 7. 输出查询结果
	     $this->assign('certificate', $certificatepage);//遍历数据数据
	     $pages=$page->show();
	     $this->assign('pages',$pages);
	     //$certificate=M("certificate")->select();
	     //$this->assign("certificate",$certificate);
	     $this->display();
	}
	public function content($cid){
		$certificate=M("certificate")->find($cid);
		$this->assign("ccontent",$certificate);
		$tcertificate=M("certificate")->limit(3)->select();//比赛推荐部分
	     $this->assign("tcertificate",$tcertificate);
	     $news=M("news")->order("newsid desc")->limit(7)->select();//热门资讯获取
		$this->assign("news",$news);
		$this->display();
	}
	public function user($cid,$ctime){
		if ($_SESSION['name'] == NULL) {
			$this->redirect('home/login/login','请登录');
		}else{
			$user = $_SESSION['name'];
			$data=array(
			    	'username'  =>$user,
			    	'certifcateid' =>$cid,
			    	'uctype' =>'考证信息',
			    	'time' =>$ctime
			    	);
		     $Model=D("user_certificate");
		     $Model->create();
		     $num=$Model->add($data);
		     if($num>0){
		     		$this->success("记录成功！将在证件考试开始前给您推送通知及注意事项，请尽快前往官网报名",U("certificatelist"),10);
		     }else{
		       	$this->error("添加失败 /(ㄒoㄒ)/~~，请重试",U("certificatelist"),4);
		     }
	      }
	}
	public function search(){
		if(isset($_GET['text'])){
			$data=$_GET['text'];
			/*选取数据*/
		 	$certificatepage=M("certificate")->order("cid desc")->where("cname like '%$data%'");
		 	/*分页码*/
			// 1. 获取记录总条数
			$count =$certificatepage->count();
			// 2. 设置（获取）每一页显示的个数
			$pageSize =8;
			// 3. 创建分页类对象
			$page = new Page($count, $pageSize);
			// 4.构造查询条件
			$condition=array();
			$condition['cid'] != NULL;
			// 5. 分页查询
		      $certificatepage = $certificatepage->where("cname like '%$data%'")->order('cid desc')
		          ->limit($page->firstRow.','.$page->listRows)
		          ->select();
		      // 6. 定义分页样式
		      $page->setConfig('prev','上一页');
		      $page->setConfig('next','下一页');
		      // 7. 输出查询结果
		      $this->assign('result', $certificatepage);//遍历数据数据
		      if ($certificatepage == NULL) {
		      	$this->error("搜索无结果",U("certificatelist"));
		      }
		      $pages=$page->show();
		      $this->assign('pages',$pages);
	      	$this->display();
	    	}else{
	    		$this->error("您肿么到这里了/(ㄒoㄒ)/~~，快回去",U("matchlist"));
	    	}
    }

}
