<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends Controller {
    public function index(){
      $article = M("article")->select();
	  $this->assign("article",$article);
	  $this->display();
    }
    public function content($articleid){
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
    public function editarticle($articleid){
	  $article=M("article")->find($articleid);
	  $this->assign("articlecontent",$article);
	  $this->display();
	}
}
