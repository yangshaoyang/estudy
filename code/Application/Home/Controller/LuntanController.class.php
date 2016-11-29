<?php
namespace Home\Controller;
use Think\Controller;
use \Library\Page;
class LuntanController extends Controller {
    public function index(){
    	/*选取数据*/
	    	$forum=M("forum")->where("typeid=1")->select();
	    /*分页码*/
		     // 1. 获取记录总条数
	        $count = count($forum);
	        // 2. 设置（获取）每一页显示的个数
	        $pageSize =3;
	        // 3. 创建分页类对象
	        $page=new Page($count,$pageSize);
	        // 5. 分页查询
	        $results = M("forum")->where($condition)
	            ->limit($page->firstRow.','.$page->listRows)
	            ->select();
	        //6定义分页样式
	        $page->setConfig('prev','上一页');
	        $page->setConfig('next','下一页');
	        // 7. 输出查询结果
	         $this->assign("forum",$forum);
	       // 8. 输出分页码
	        $this->assign('pages', $page->show());
	        // 9. 显示视图文件
	        $this->display();
    }
    public function question($forumid){
    	$forum=M("forum")->find($forumid);
		$this->assign("fcontent",$forum);
		/*$tmatch=M("match")->limit(3)->select();//比赛推荐部分
	      $this->assign("tmatch",$tmatch);
		$this->display();*/
        $this->display();
    }
}
