<?php
/**
*开发者：胡琪
*开发功能：后台消息推送用户考证信息模块
*修改时间：2016/12/15
*/
namespace Admin\Controller;
use Think\Controller;
class UsercertificateController extends Controller{
	public function index(){
		$user_certificate = M("user_certificate")->select();
		$this->assign("user_certificate",$user_certificate);
		$this->display();
	}
}