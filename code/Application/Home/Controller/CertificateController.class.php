<?php
namespace Home\Controller;
use Think\Controller;
class CertificateController extends Controller {
	public function index(){
		$this->display();
	}
	 public function certificatelist(){
	      $certificate=M("certificate")->select();
	      $this->assign("certificate",$certificate);
	      $this->display();
	}
	public function content($cid){
		$certificate=M("certificate")->find($cid);
		$this->assign("ccontent",$certificate);
		$tcertificate=M("certificate")->limit(3)->select();//比赛推荐部分
	      $this->assign("tcertificate",$tcertificate);
		$this->display();
	}

}
