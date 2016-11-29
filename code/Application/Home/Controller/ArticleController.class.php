<?php
namespace Home\Controller;
use Think\Controller;
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
    	$article = M('article')->limit(5)->select();
    	$this->assign('article',$article);
    	$this->display();
    }

    public function articledetails($articleid){
        //获取帖子文章内容
        $article = M('article')->find($articleid);
        $this->assign('articlecontent',$article);
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
    	$condition['articleid'] = 1;
    	$results = $this->_db->limit($page->firstRow.','.$page->listRows)->select();
    	//4.输出查询结果
    	$this->assign('article',$results);
    	//5.输出分页码
    	$page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        //6.显示视图文件
        $this->display();
    }
}
