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

    //修改密码
    public function changepswd($adminid){
    	//提交修改密码表单
    		$oldpassword = trim($_POST['oldpassword']);
    		$password = trim($_POST['password']);
    		$repassword = trim($_POST['repassword']);
    		$data = M('admin');
    		if($oldpassword == md5($data['adpassword'])){
    				$Model=D('admin');
    				$Model->update();
    				$num=$Model->where('adminid='.$adminid)->save($repassword);
    				if($num>0){
                        $this->success("修改成功！",U("admin"));
                    }else{
                        $this->error("修改失败！",U("admin"));
                    }
    		}else{
    			$this->error('旧密码不正确，请重新输入！',U("admin/index/index"));
    		}

    }
}
