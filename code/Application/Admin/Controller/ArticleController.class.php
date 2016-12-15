<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends Controller {
     public function index(){
       $article = M("article")->select();
	   $this->assign("article",$article);
	   $this->display();
     }
     public function articledetails($articleid){
	   $article=M("article")->find($articleid);
	   $this->assign("articlecontent",$article);
	   $this->display();
	 }
     public function edit($articleid){
       $article=M("article")->find($articleid);
       $this->assign("articlecontent",$article);
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
         $data=array(   	    
    			'articletitle' =>I('post.articletitle'),
    			'articleauthor' =>I('post.articleauthor'),
    			'articletime'  =>I('post.articletime'),
    			'articleintroduction' =>I('post.articleintroduction'),	
    			'articlecontent'  =>I('post.articlecontent')
    			);

        $Model=D("article");
        $Model->create();
        $num=$Model->add($data);
        if($num>0){
        	$this->success("添加成功！",U("bid"));
        }else{
        	$this->error("添加失败！",U("bid"));
        }

        $this->display();
    }
    //要修改文章的具体信息
     public function editarticle($articleid){
	  $article=M("article")->find($articleid);
	   $this->assign("articlecontent",$article);
	   $this->display();
	 }
     //修改帖子
     // public function edit($articleid){
     //    $data=array(
     //        'articletitle'=>I('post.articletitle'),
     //        'articleauthor'=>I('post.articleauthor'),
     //        'articletime'=>I('post.articletime'),
     //        'articleintroduction'=>I('post.articleintroduction'),
     //        'articlecontent'=>I('post.articlecontent')
     //        );
     //    $Model=M('article');
     //    $num=$Model->where('articleid='.$articleid)->save($data);
     //    if($num>0){
     //        $this->success("修改成功！");
     //    }else{
     //        $this->error("修改失败！");
     //    }
     //    $this-.display();
     // }
    //删除帖子
      public function delete($articleid){
        $articleid = $_GET['articleid'];
        if (M("article")->delete($articleid)) {
            $this->success("删除成功！");
    }
}
 }
