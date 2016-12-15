<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
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
     public function addnews(){
        $this->display();
     }
     //添加文章
    public function add(){
        if(!IS_POST){
            exit("bad request");
        }
        $upload = new \Think\Upload();// 实例化上传类
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =      './Uploads'; // 设置附件上传目录
        $upload->savePath  =     '/Uploads'; // 设置附件上传（子）目录
        $info   =   $upload->upload();
        //dump($info);
        $image = 'Uploads'.$info['newsthumb']['savepath'].$info['newsthumb']['savename'];
        //dump($image);
        $data=I('post.');
        $data['newsthumb']=$image;
        //dump($data);
        $Model=D("news");
        $Model->create();
        $num=$Model->add($data);
        
         if($num>0){
          	$this->success("添加成功！");
          }else{
          	$this->error("添加失败！");
          }
    }
    //修改文章
     public function editnews($newsid){
        $news=M("news")->find($newsid);
        $this->assign("news",$news);
        $this->display();
    }
    //修改提交文章
    public function editnewscontent($newsid){
        $data = I('post.');
        $Model=M("news");
        $num=$Model->where('newsid='.$newsid)->save($data);
        if($num>0){
            $this->success("修改成功");
        }else{
            $this->error("修改失败");
        }
    }
    //删除文章
    public function delete($newsid){
        $newsid = $_GET['newsid'];
        if (M("news")->delete($newsid)) {
            $this->success("删除成功！");
        }
    }
}
