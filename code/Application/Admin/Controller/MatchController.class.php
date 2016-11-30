<?php
namespace Admin\Controller;
use Think\Controller;
class MatchController extends Controller {
    public function index(){
        $match = M("match")->select();
	  $this->assign("match",$match);
	  $this->display();
    }
    public function base(){
        $this->display();
    }
}
