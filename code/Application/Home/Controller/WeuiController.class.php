<?php
namespace Home\Controller;
use Think\Controller;
class WeuiController extends Controller {
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

        $url = M("blogroll")->select();
        $this->assign("blogroll",$url);

        $this->display();
    }

    public function matchlist(){
        $match=M("match")->order("mid desc")->limit(2)->select();
        $this->assign("hotmatch",$match);

        $match=M("match")->select();
        $this->assign("match",$match);

        $this->display();
    }

    public function matchcontent($mid){
        $match=M("match")->find($mid);
        $this->assign("mcontent",$match);
        $this->display();
    }

    public function certificatelist(){
        $certificate=M("certificate")->order("cid desc")->limit(2)->select();
        $this->assign("hotmatch",$certificate);

        $certificate=M("certificate")->select();
        $this->assign("certificate",$certificate);

        $this->display();
    }

    public function certificatecontent($cid){
        $certificate=M("certificate")->find($cid);
        $this->assign("ccontent",$certificate);

        $this->display();
    }

    public function mclist(){
        $match=M("match")->order("mid desc")->limit(2)->select();
        $this->assign("hotmatch",$match);

        $match=M("match")->select();
        $this->assign("match",$match);

        $certificate=M("certificate")->order("cid desc")->limit(2)->select();
        $this->assign("hotcerticate",$certificate);

        $certificate=M("certificate")->select();
        $this->assign("certificate",$certificate);

        $this->display();
    }

    public function articlelist(){
        $article=M("article")->order("articleid desc")->select();
        $this->assign("article",$article);

        $this->display();
    }

    public function articlecontent($aid){
        $articleid = $aid;
        $article=M("article")->find($articleid);
        $this->assign("acontent",$article);

        $this->display();
    }

}
