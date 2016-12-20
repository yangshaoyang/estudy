<?php
/**
*开发者：胡琪
*开发功能：前台界面励志人生模块功能实现
*修改时间：2016/12/15
*/

namespace Home\Controller;
use Think\Controller;
use \Library\Page;
class ArticleController extends Controller {
    protected $_db;
    protected function _initialize(){
    	$this->_db = M('article');
    }
    public function index(){
    	$this->display();
    }
     
    public function article(){
        //获取帖子列表
    	$article = M('article')->limit(4)->select();
    	$this->assign('article',$article);
        //热门资讯部分
        $news=M("news")->order("newsid desc")->limit(7)->select();
        $this->assign("news",$news);
    	$this->display();
    }
    //励志人生内容页
    public function articledetails($articleid){
        //获取帖子文章内容
        $article = M('article')->find($articleid);
        $this->assign('articlecontent',$article);
        //热门资讯部分
        $news=M("news")->order("newsid desc")->limit(7)->select();
        $this->assign("news",$news);
        $this->display();
    }
    //分页功能实现
    public function pages (){
    	// //1.获取记录总条数
    	// $count = $this->_db->count();
    	// //2.设置（获取）每一页显示的个数
    	// $pageSize = C('PAGE_SIZE');
    	// //3.创建分类对象
    	// $page = new Page($count,$pageSize);
    	// $condition = array();
    	// $condition['articleid'] = 1;
    	// $results = $this->_db->limit($page->firstRow.','.$page->listRows)->select();
    	// //4.输出查询结果
    	// $this->assign('article',$results);
    	// //5.输出分页码
    	// $page->setConfig('prev','上一页');
     //    $page->setConfig('next','下一页');
     //    //6.显示视图文件
     //    $this->display();

        /*选取数据*/
        $articlepage=M("article")->order("articleid desc")->where("articleid");
        /*分页码*/
        // 1. 获取记录总条数
        $count =$articlepage->count();
        // 2. 设置（获取）每一页显示的个数
        $pageSize =4;
        // 3. 创建分页类对象
        $page = new Page($count, $pageSize);
        // 4. 构造查询条件
        $condition=array();
        $condition['mid'] != NULL;
        // 5. 分页查询
          $$articlepage = $articlepage->where($condition)->order('articleid desc')
              ->limit($page->firstRow.','.$page->listRows)
              ->select();
          // 6. 定义分页样式
          $page->setConfig('prev','上一页');
          $page->setConfig('next','下一页');
          // 7. 输出查询结果
          $this->assign('article', $articlepage);//遍历数据数据
          $pages=$page->show();
          $this->assign('pages',$pages);
          $this->display();
    }
}
