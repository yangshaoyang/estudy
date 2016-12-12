<?php
namespace Admin\Controller;
use Think\Controller;
class NewsController extends Controller {
     public function index(){
        $news = M("news")->select();
        $this->assign("news",$news);
        $this->display();
     }
     public function newsetails($newsid){
        $news=M("news")->find($newsid);
        $this->assign("newscontent",$news);
        $this->display();
    }
     public function edit($newsid){
        $news=M("news")->find($newsid);
        $this->assign("news",$news);
	$this->display();
        }
     public function addNews(){
        $this->display();
     }
     //添加帖子
    public function add(){
        if(!IS_POST){
            exit("bad request");
        }
        $data=I('post.');
        $Model=D("news");
        $Model->create();
        $num=$Model->add($data);
        if($num>0){
        	$this->success("添加成功！",U("bid"));
        }else{
        	$this->error("添加失败！",U("bid"));
        }
        $this->display();
    }
    //修改帖子
     public function editNews($newsid){
        $data = I('post.');
        $news=M("news")->find($newsid);
        $num=$Model->where('newsid='.$newsid)->save($data);
        if($num>0){
            $this->success("修改成功！");
        }else{
            $this->error("修改失败！");
        }
        $this->display();
    }
    //删除帖子
    public function delete($newsid){
        $articleid = $_GET['newsid'];
        if (M("news")->delete($newsid)) {
            $this->success("删除成功！");
        }
    }
}
