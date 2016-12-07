<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
     public function index(){
                $admin = M("admin")->select();
	   $this->assign("admessage",$admin);
	   $this->display();
     }
     public function adminmessage($adminid){
	   $admin=M("admin")->find($adminid);
	   $this->assign("admessage",$admin);
	   $this->display();
	 }
     //添加管理员
     public function add(){
    	if(!IS_POST){
            exit("bad request");
        }
         $data=array(
    			'adname' =>I('post.adname'),
    			'ademail' =>I('post.ademail'),
    			'adphonenum'  =>I('post.adphonenum'),
    			);

        $Model=D("admin");
        $Model->create();
        $num=$Model->add($data);
        if($num>0){
        	$this->success("添加成功！",U("admin"));
        }else{
        	$this->error("添加失败！",U("admin"));
        }

        $this->display();
    }
    //修改管理员
     public function editadmin($adminid){
        $admin=M("admin")->find($adminid);
        $this->assign("admessage",$admin);
        $this->display();
    }
    //删除管理员
    public function delete($adminid){
        $articleid = $_GET['adminid'];
        if (M("admin")->delete($adminid)) {
            $this->success("删除成功！");
    }
}
 }