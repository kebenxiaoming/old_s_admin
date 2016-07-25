<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 11:53
 */
namespace Admin\Controller;

class UserController extends AdminController{
    public function index(){
        $count=M("User")->count();
        $listrows=C("LISTROWS")?C("LISTROWS"):10;
        $page=new \Think\Page($count,$listrows);
        $user_infos=M("User")->limit($page->firstRow,$page->listRows)->select();
        $this->assign("user_infos",$user_infos);
        $this->assign("page_html",$page->show());
        $this->display();
    }

    public function showGroup(){
       $group_id=intval($_GET['group_id']);
        $count=M("User")->where("user_group=".$group_id)->count();
        $listrows=C("LISTROWS")?C("LISTROWS"):10;
        $page=new \Think\Page($count,$listrows);
        $user_infos=M("User")->where("user_group=".$group_id)->limit($page->firstRow,$page->listRows)->select();
        $this->assign("user_infos",$user_infos);
        $this->assign("page_html",$page->show());
        $this->display();
    }
}