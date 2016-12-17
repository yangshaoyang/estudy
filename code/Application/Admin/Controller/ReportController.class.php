<?php
namespace Admin\Controller;
use Think\Controller;
class ReportController extends Controller {
    public function index(){
    	   $m = M("report")->select();
        $this->assign("report",$m);
        $this->display();
    }
}
