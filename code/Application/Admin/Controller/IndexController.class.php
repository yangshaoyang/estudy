<?php
/**
*开发者：胡琪
*开发功能：检测后台管理员是否登录
*修改时间：2016/12/01
*/

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
