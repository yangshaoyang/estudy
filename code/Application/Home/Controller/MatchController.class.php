<?php
namespace Home\Controller;
use Think\Controller;
class MatchController extends Controller {
	public function index(){
		$this->display();
	}
	 public function matchlist(){
	      $match=M("match")->select();
	      $this->assign("match",$match);
	      $this->display();
	}
	public function content($mid){
		$match=M("match")->find($mid);
		$this->assign("mcontent",$match);
		$tmatch=M("match")->limit(3)->select();//比赛推荐部分
	      $this->assign("tmatch",$tmatch);
		$this->display();
	}

}
