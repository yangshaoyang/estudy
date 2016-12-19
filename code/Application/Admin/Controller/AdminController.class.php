<?php
/**
*开发者：胡琪
*开发功能：实现后台管理员对管理员的操作功能
*修改时间：2016/12/09
*/

namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
  public function _before_index() {
    //执行index之前会自动调用该方法
    if ($_SESSION['adminname'] == NULL) {
      $this->error('请先登录', U('./admin/login/login'));
    }
  }
  public function index() {
    $admin = M("admin")->select();
    $this->assign("admessage", $admin);
    $this->display();
  }
  public function adminmessage($adminid) {
    $admin = M("admin")->find($adminid);
    $this->assign("admessage", $admin);
    $this->display();
  }
  //添加管理员
  public function add() {
    //先判断管理员是否登录
    if ($_SESSION['adminname'] == NULL) {
      $this->redirect('admin/login/login');
    } else {
      if (!IS_POST) {
        exit("bad request");
      }
      $data = array(
        'adname' => I('post.adname'),
        'ademail' => I('post.ademail'),
        'adpassword' => md5(I('post.adpassword')),
        'adphonenum' => I('post.adphonenum'),
        );
      $Model = D("admin");
      $Model->create();
      $num = $Model->add($data);
      if ($num > 0) {
        $this->success("添加成功！", U("admin"));
      } else {
        $this->error("添加失败！", U("admin"));
      }
      $this->display();
    }
  }
  public function editadmin($adminid) {
    $admin = M("admin")->find($adminid);
    $this->assign("admessage", $admin);
    $this->display();
  }
  //修改管理员
  public function edit($adminid) {
    //先判断管理员是否登录
    if ($_SESSION['adminname'] == NULL) {
      $this->redirect('admin/login/login');
    } else {
      $data = array(
        'adname' => I('post.adname'),
        'ademail' => I('post.ademail'),
        'adphonenum' => I('post.adphonenum')
      );
      $Model = M('admin');
      $num = $Model->where('adminid=' . $adminid)->save($data);
      if ($num > 0) {
        $this->success("修改成功！");
      } else {
        $this->error("修改失败！");
      }
      $this->display();
    }
  }
  //修改管理员密码
  public function changepswd($adminname) {
    //先判断管理员是否登录
    if ($_SESSION['adminname'] == NULL) {
      $this->redirect('admin/login/login');
    } else {
      $admin = M("admin");
      $adpassword = $admin->getFieldByAdname($adminname, 'adpassword');
      //提交修改密码表单
      $data = array('password' => md5(I('post.password')));
      if (md5(I('post.oldpassword')) == $adpassword) {
        $num = $admin->where('adminname=' . $adminname)->save($data);
        // var_dump($num);
        // exit;
        if ($num > 0) {
          $this->success("修改成功！");
        } else {
          $this->error("修改失败！");
        }
      } else {
        $this->error('旧密码不正确，请重新输入！', U("admin/index/index"));
      }
      $this->display();
    }
  }
  //删除管理员
  public function delete($adminid) {
    //先判断管理员是否登录
    if ($_SESSION['adminname'] == NULL) {
      $this->redirect('admin/login/login');
    } else {
      $articleid = $_GET['adminid'];
      if (M("admin")->delete($adminid)) {
        $this->success("删除成功！");
      }
    }
  }
}
