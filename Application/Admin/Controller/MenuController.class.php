<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 16:38
 */
namespace Admin\Controller;

class MenuController extends AdminController{
    public function index(){
        $count=M("MenuUrl")->count();
        $listrows=C("LISTROWS")?C("LISTROWS"):10;
        $page=new \Think\Page($count,$listrows);
        $menus=M("MenuUrl")->limit($page->firstRow,$page->listRows)->select();
        $this->assign("menus",$menus);
        $this->assign("page_html",$page->show());

        $module_options_list = D("Module")->getModuleForOptions ();
        $module_options_list[0]="全部";
        ksort($module_options_list);
        $this->assign("module_options_list",$module_options_list);

        $acjs=renderJsConfirm("icon-remove");
        $this->assign("action_confirm",$acjs);
        $this->display();
    }

    /**
     * 添加菜单
     */
    public function add(){
        if(IS_POST) {
            $menu = M("MenuUrl");
            $data = $menu->create();
            $res = $menu->add($data);
            if ($res) {
                Adminlog(session("user")['user_name'],"ADD" , "MenuUrl",$res ,json_encode($data) );
                $this->success("添加成功！", U("Menu/index"));
                die;
            } else {
                $this->error("添加失败！", U("Menu/index"));
                die;
            }
        }else{
            $module_options_list = D("Module")->getModuleForOptions ();
            $this->assign("module_options_list",$module_options_list);
            $father_menu_options_list = D("MenuUrl")->getFatherMenuForOptions ();
            $this->assign("father_menu_options_list",$father_menu_options_list);
            $this->display();
        }
    }

    /**
     * 编辑菜单
     */
    public function edit(){
        $menuurl=M("MenuUrl");
        if(IS_POST) {
            $data = $menuurl->create();
            $data['menu_id']=intval($_GET['menu_id']);
            $res = $menuurl->save($data);
            if ($res) {
                Adminlog(session("user")['user_name'],"MODIFY" , "MenuUrl", $data['menu_id'] ,json_encode($data) );
                $this->success("修改成功！", U("Menu/index"));
                die;
            } else {
                $this->error("修改失败！", U("Menu/index"));die;
            }
        }else{
            $menu_id=intval($_GET['menu_id']);
            $menu=$menuurl->find($menu_id);
            $this->assign("currentmenu",$menu);
            $module_options_list = D("Module")->getModuleForOptions ();
            $this->assign("module_options_list",$module_options_list);
            $father_menu_options_list = D("MenuUrl")->getFatherMenuForOptions ();
            $this->assign("father_menu_options_list",$father_menu_options_list);
            $this->display();
        }
    }

    /**
     * 编辑菜单
     */
    public function del(){
        $data['menu_id']=intval($_GET['menu_id']);
        //先查找是否存在
        $menu=M("MenuUrl")->where($data)->find();
        if(empty($menu)){
            $this->error("不存在该菜单！");die;
        }
        $res = M("MenuUrl")->where($data)->delete();
        if ($res) {
            Adminlog(session("user")['user_name'],"DEL" , "MenuUrl",$data['menu_id'] ,json_encode($menu) );
            $this->success("删除成功！", U("Menu/index"));
            die;
        } else {
            $this->error("删除失败！", U("Menu/index"));die;
        }
    }
}