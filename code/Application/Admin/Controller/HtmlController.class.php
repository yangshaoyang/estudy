<?php
namespace Admin\Controller;
use Think\Controller;
class HtmlController extends Controller {
    public function index(){
        $this->display();
    }
    public function base(){
        $this->display();
    }
}
