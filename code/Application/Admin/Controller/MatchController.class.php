<?php
namespace Admin\Controller;
use Think\Controller;
class MatchController extends Controller {
    public function index(){
        $match = M("match")->select();
	  $this->assign("match",$match);
	  $this->display();
    }
    public function content($mid){
	  $match=M("match")->find($mid);
	  $this->assign("mcontent",$match);
	  $this->display();
	}
    public function edit($mid){
	  $match=M("match")->find($mid);
	  $this->assign("mcontent",$match);
	  $this->display();
	}
    public function addmatch(){
        $this->display();
    }
    public function editmatch($mid){
	  $match=M("match")->find($mid);
	  $this->assign("mcontent",$match);
	  $this->display();
	}
}
