<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function _before_index(){
		//执行index之前会自动调用该方法
		if($_SESSION['adminname'] == NULL){
			$this->error('请先登录','admin/login/login');
		}
	}
    public function index(){
        $this->display();
    }
}
