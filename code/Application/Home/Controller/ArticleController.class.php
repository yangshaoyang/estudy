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
        //获取文章列表
    	$article = M('article');
    	/*分页码*/
        // 1. 获取记录总条数
        $count =$article->count();
    	// 2. 设置（获取）每一页显示的个数
        $pageSize =4;
        // 3. 创建分页类对象
        $page = new Page($count, $pageSize);
        // 4. 分页查询
        $article= $article->order('articleid desc')
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        //6定义分页样式
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        // 7. 输出查询结果
        $pages=$page->show();
        $this->assign('pages',$pages);
        //文章首页
    	$this->assign('article',$article);
        //热门资讯部分
        $news=M("news")->order("newstime")->limit(7)->select();
        $this->assign("news",$news);
    	$this->display();
    }
    //励志人生内容页
    public function articledetails($articleid){
        //获取文章内容
        $articledetails = M('article')->find($articleid);
        $this->assign('articlecontent',$articledetails);
        //热门资讯部分
        $news=M("news")->order("newsid asc")->limit(7)->select();
        $this->assign("news",$news);
        $article=M("article")->order("articletime")->limit(5)->select();
        $this->assign("article",$article);
        $this->display();
    }
    //分页功能实现
   /* public function pages (){
        //选取数据
        $articlepage=M("article")->order("articleid desc")->where("articleid");
        //分页码
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
    }*/
}
