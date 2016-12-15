<?php
namespace Admin\Controller;
use Think\Controller;
class UsermatchController extends Controller{
	public function index(){
		$user_match = M("user_match")->select();
		$this->assign("user_match",$user_match);
		$this->display();
	}
}