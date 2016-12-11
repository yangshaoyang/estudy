<?php
namespace Admin\Controller;
use Think\Controller;
class BlogrollController extends Controller {
    public function index(){
        $url = M("blogroll")->select();
        $this->assign("blogroll",$url);
        $this->display();
    }
    public function edit($id){
        $url = M("blogroll")->find($id);
        $this->assign("blogroll",$url);
        $this->display();
    }
    public function add(){
        $data=array(
        	'url'   =>I('post.url'),
        	'name'  =>I('post.name')
        );
        $Model=D("blogroll");
        $Model->create();
        $num=$Model->add($data);
        if($num>0){
            $this->success("添加成功！");
        }else{
            $this->error("添加失败！");
        }
        $this->display();
    }
    public function editblogroll($id){
        $data=array(
            'url'   =>I('post.url'),
            'name'  =>I('post.name')
        );
        $Model=M("blogroll");
        $num=$Model->where('id='.$id)->save($data);
        if($num>0){
            $this->success("修改成功！");
        }else{
            $this->error("修改失败！");
        }
        $this->display();
    }
    public function delete($id){
        $id = $_GET['id'];
        if (M("blogroll")->delete($id)) {
            $this->success("删除成功！");
    }
}
}
