<?php
namespace Admin\Controller;
use Think\Controller;
class ReportController extends Controller { //举报管理控制器
    public function index(){
    	   $m = M("report")->order('reportid desc')->select();
        $this->assign("report",$m);
        $this->display();
    }
    public function feedback($rid){
        // $data=array(
        // );
        // $Model=M("report");
        // $num=$Model->where('reportid='.$rid)->save($data);
        // if($num>0){
        //     $this->success("修改成功！");
        // }else{
        //     $this->error("修改失败！");
        // }
        $this->display();
    }
}
