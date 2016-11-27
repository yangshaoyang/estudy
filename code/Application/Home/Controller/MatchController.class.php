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
		$this->display();
	}

}
