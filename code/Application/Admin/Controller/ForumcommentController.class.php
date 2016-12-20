<?php
/**
*开发者：胡琪
*开发功能：后台消息推送论坛评论信息模块
*修改时间：2016/12/19
*/

namespace Admin\Controller;
use Think\Controller;
class ForumCommentController extends Controller{
	public function index(){
		$forum_comment = M("forum_comment")->select();
		$this->assign("forum_comment",$forum_comment);
		$this->display();
	//消息推送
	//获取比赛时间的时间戳
	$mtime = strtotime('$time,00:00:00');
	//获取比赛三天前的时间戳
	$btime = strtotime('-3 $time');

}
}
