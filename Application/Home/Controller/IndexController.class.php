<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends HomeController {
    public function index(){
        $this->display();
    }

    public function instruction(){
        $article=M("Article")->find(1);
        $this->assign("article",$article);
        $this->display();
    }
}