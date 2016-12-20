<?php
/**
*开发者：胡琪
*开发功能：后台消息推送用户比赛信息模块
*修改时间：2016/12/15
*/

namespace Admin\Controller;
use Think\Controller;
class UserMatchController extends Controller{
	public function index(){
		$user_match = M("user_match")->select();
		$this->assign("user_match",$user_match);
		$this->display();
	}
	// //关联match和user_match的查询
	//  public function content(){
 //        $Model = M();
 //        $user_match=$Model ->table('match match1,user_match match2')->where('match1.mid = match2.matchid')
 //        ->field('match1.mname')->select();
 //        var_dump($user_match);
 //    }

	//消息推送
	//获取比赛时间的时间戳
	//$mtime = strtotime('$time,00:00:00');
	//获取比赛三天前的时间戳
	//$btime = strtotime('-3 $time');

}