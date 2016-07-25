<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 16:32
 */
namespace Admin\Controller;

class ModuleController extends AdminController{
    public function index(){
        $count=M("Module")->count();
        $listrows=C("LISTROWS")?C("LISTROWS"):10;
        $page=new \Think\Page($count,$listrows);
        $modules=M("Module")->limit($page->firstRow,$page->listRows)->select();
        $this->assign("modules",$modules);
        $this->assign("page_html",$page->show());
        $acjs=renderJsConfirm("icon-remove");
        $this->assign("action_confirm",$acjs);
        $this->display();
    }
    //修改模块内容
    public function edit(){
        if(IS_POST) {
            $module = M("Module");
            $data = $module->create();
            $data['module_id']=intval($_GET['module_id']);
            $res = $module->save($data);
            if ($res) {
                Adminlog(session("user")['user_name'],"MODIFY" , "Module", $data['module_id'] ,json_encode($data) );
                $this->success("修改成功！", U("Module/index"));
                die;
            } else {
                $this->error("修改失败！", U("Module/index"));die;
            }
        }else{
            $module_id=intval($_GET['module_id']);
            $module=M("Module")->find($module_id);
            $this->assign("currentmodule",$module);
            $this->display();
        }
    }

    public function add(){
        if(IS_POST) {
            $module = M("Module");
            $data = $module->create();
            $res = $module->add($data);
            if ($res) {
                Adminlog(session("user")['user_name'],"ADD" , "Module",$res ,json_encode($data) );
                $this->success("添加成功！", U("Module/index"));
                die;
            } else {
                $this->error("添加失败！", U("Module/index"));
                die;
            }
        }else{
            $this->display();
        }
    }

    //删除模块内容
    public function delete(){
            $data['module_id']=intval($_GET['module_id']);
            //先查找是否存在
            $module=M("Module")->where($data)->find();
            if(empty($module)){
                $this->error("不存在该模块");die;
            }
            $res = M("Module")->where($data)->delete();
            if ($res) {
                Adminlog(session("user")['user_name'],"DEL" , "Module",$data['module_id'] ,json_encode($module) );
                $this->success("删除成功！", U("Module/index"));
                die;
            } else {
                $this->error("删除失败！", U("Module/index"));die;
            }
    }
}