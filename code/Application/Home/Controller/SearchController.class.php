<?php
/**
*编写人：周钰凯
*项目名称：eStudy
*日期：2016-12-15
**/
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
   public function search(){
      if(isset($_POST['condition'])){
      $data=$_POST['condition'];
      $map['mname'] = array('link','%'.$data.'%' );
      $match=M('match')->where($map)->select();
      $this->assign('match',$match);

      $map['cname'] = array('link','%'.$data.'%' );
      $certificate=M('certificate')->where($map)->select();
      $this->assign('certificate',$certificate);


      $this->redirect('/home/search/search');
      $this->display();
    }

    public function pages (){
    	  /*选取分类1数据*/
        $newspage=M("match")->where("mid");
        /*分页码*/
        // 1. 获取记录总条数
        $count =$newspage->count();
        // 2. 设置（获取）每一页显示的个数
        $pageSize =8;
        // 3. 创建分页类对象
        $page = new Page($count, $pageSize);
        // 4.构造查询条件
        $condition=array();
        $condition['mid'] != NULL;
        // 5. 分页查询
        $newspage = $newspage->where($condition)->order('mid desc')
              ->limit($page->firstRow.','.$page->listRows)
              ->select();
        // 6. 定义分页样式
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        // 7. 输出查询结果
        $this->assign('pages',$pages);
        $this->display();
    }

}
