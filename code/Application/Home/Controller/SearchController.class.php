<?php
/**
*编写人：周钰凯
*项目名称：eStudy
*日期：2016-12-15
**/
namespace Home\Controller;
use Think\Controller;
class SearchController extends Controller {
   public function search(){
      if(isset($_GET['text'])){
        $data=$_GET['text'];

        $mresult=M('match')->where("mname like '%$data%' ")->select();
        $this->assign('mresult',$mresult);
        $cresult=M('certificate')->where("cname like '%$data%' ")->select();
        $this->assign('cresult',$cresult);
        if ($cresult == NULL && $mresult == NULL) {
            $this->error("搜索无结果",U("/"));
        }

        $this->display();
    }
  }
}
