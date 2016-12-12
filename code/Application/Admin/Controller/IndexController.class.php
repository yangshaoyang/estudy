<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function _before_index(){
		//执行index之前会自动调用该方法
		if($_SESSION['name'] == NULL){
			$this->error('请先登录','admin/login');
		}
	}
    public function index(){
        $this->display();
    }
}
