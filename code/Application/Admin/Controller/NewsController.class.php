<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends Controller {
     public function index(){
       $news = M("news")->select();
	   $this->assign("news",$news);
	   $this->display();
     }
     public function articledetails($articleid){
	   $news=M("news")->find($articleid);
	   $this->assign("newscontent",$news);
	   $this->display();
	 }
     public function edit($articleid){
       $news=M("news")->find($articleid);
       $this->assign("news",$news);
	   $this->display();
	 }
     public function addarticle(){
         $this->display();
     }
     //添加帖子
	public function add(){
    	if(!IS_POST){
            exit("bad request");
        }
         $data=I('post.');

        $Model=D("news");
        $Model->create();
        $num=$Model->add($data);
        if($num>0){
        	$this->success("添加成功！",U("bid"));
        }else{
        	$this->error("添加失败！",U("bid"));
        }

        $this->display();
    }
    //修改帖子
     public function editarticle($articleid){
	  $news=M("news")->find($newsid);
	   $this->assign("newscontent",$news);
	   $this->display();
	 }
    //删除帖子
      public function delete($articleid){
        $articleid = $_GET['newsid'];
        if (M("news")->delete($newsid)) {
            $this->success("删除成功！");
    }
}
 }
