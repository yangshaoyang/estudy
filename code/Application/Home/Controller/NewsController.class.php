<?php
namespace Home\Controller;
use Think\Controller;
use \Library\Page;
class NewsController extends Controller {
    protected $_db;
    protected function _initialize(){
    	$this->_db = M('news');
    }
    public function index(){
    	$this->display();
    }
     
    public function newslist(){
      $match=M("match")->order("mid desc")->limit(5)->select();
      $this->assign("match",$match);
      $textual=M("certificate")->order("cid desc")->limit(5)->select();
      $this->assign("textual",$textual);
         /*选取分类1数据*/
        $newspage=M("news")->where("newsid");
        /*分页码*/
        // 1. 获取记录总条数
        $count =$newspage->count();
        // 2. 设置（获取）每一页显示的个数
        $pageSize =8;
        // 3. 创建分页类对象
        $page = new Page($count, $pageSize);
        // 4.构造查询条件
        $condition=array();
        $condition['newsid'] != NULL;
        // 5. 分页查询
          $newspage = $newspage->where($condition)->order('newsid desc')
              ->limit($page->firstRow.','.$page->listRows)
              ->select();
          // 6. 定义分页样式
          $page->setConfig('prev','上一页');
          $page->setConfig('next','下一页');
          // 7. 输出查询结果
          $this->assign('news', $newspage);//遍历数据数据
          $pages=$page->show();
          $this->assign('pages',$pages);
          $this->display();
    }


    public function newscontent($newsid){
        //获取帖子文章内容
        $match=M("match")->order("mid desc")->limit(5)->select();
        $this->assign("match",$match);
        $textual=M("certificate")->order("cid desc")->limit(5)->select();
        $this->assign("textual",$textual);
        $new=M("news")->order("newsid desc")->limit(5)->select();
        $this->assign("news",$new);
        $news = M('news')->find($newsid);
        $this->assign('newscontent',$news);
        $this->display();

    }
    public function pages (){
    	//1.获取记录总条数
    	$count = $this->_db->count();
    	//2.设置（获取）每一页显示的个数
    	$pageSize = C('PAGE_SIZE');
    	//3.创建分类对象
    	$page = new Page($count,$pageSize);
    	$condition = array();
    	$condition['newsid'] = 1;
    	$results = $this->_db->limit($page->firstRow.','.$page->listRows)->select();
    	//4.输出查询结果
    	$this->assign('news',$results);
    	//5.输出分页码
    	$page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        //6.显示视图文件
        $this->display();
    }
}
