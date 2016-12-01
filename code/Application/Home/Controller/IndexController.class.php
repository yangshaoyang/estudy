<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		$match=M("match")->order("mid desc")->limit(5)->select();
	    $this->assign("match",$match);
	    $matchs=M("match")->order("mid desc")->limit(2)->select();
	    $this->assign("matchs",$matchs);

		$textual=M("certificate")->order("cid desc")->limit(5)->select();
	    $this->assign("textual",$textual);
	    $textuals=M("certificate")->order("cid desc")->limit(2)->select();
	    $this->assign("textuals",$textuals);

		$news=M("news")->order("newsid desc")->limit(5)->select();
	    $this->assign("news",$news);
	    $new=M("news")->order("newsid desc")->limit(1)->select();
	    $this->assign("new",$new);
		$this->display();
    }
}
