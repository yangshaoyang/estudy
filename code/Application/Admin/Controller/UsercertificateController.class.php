<?php
namespace Admin\Controller;
use Think\Controller;
class UsercertificateController extends Controller{
	public function index(){
		$user_certificate = M("user_certificate")->select();
		$this->assign("user_certificate",$user_certificate);
		$this->display();
	}
}