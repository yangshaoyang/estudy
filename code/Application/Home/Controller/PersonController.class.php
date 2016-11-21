<?php
namespace Home\Controller;
use Think\Controller;
class PersonController extends Controller {
    public function index(){
        $this->display();
    }

    public function homepage(){
        $this->display();
    }
}