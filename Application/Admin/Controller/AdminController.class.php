<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 9:30
 */
namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller{
    public function _initialize()
    {
        //查看是否存在记录cookie
        $user_id=getCookieRemember();

        if($user_id){
            //自动登录
            if(empty(session("user"))){
                D("User")->autoLogin($user_id);
            }
        }
        //判断用户是否登录，已经登录直接进入页面内
        $user=session("user");
        if(empty($user)){
            //如果没登录自动跳转到登录页面
            if(CONTROLLER_NAME!="Login") {
                $this->redirect("Login/index");
            }
        }else{
            if(CONTROLLER_NAME=="Login"||ACTION_NAME=="del"||ACTION_NAME=="category_del"){
                    //如果是退出直接不操作
            }else {
                $this->assign("user_info", $user);
                //并且获取用户对应的目录权限
                // 显示菜单、导航条、模板
                $sidebar = D("MenuUrl")->getTrees();
                $menu = D("MenuUrl")->getMenuByUrl(CONTROLLER_NAME."/".ACTION_NAME);
                $this->assign('page_title', $menu['menu_name']);
                $this->assign('content_header', $menu);
                $this->assign('sidebar', $sidebar);
                $this->assign('current_module_id', $menu['module_id']);
                //验证用户权限
                if(CONTROLLER_NAME!="Area"&&CONTROLLER_NAME!="File"){
                    $this->checkAccess($menu, $user);
                }
            }
        }
    }

    //检测用户权限
    private function checkAccess($menu,$user){
        if(!empty($user)) {
            $group_role = M("UserGroup")->field("group_role")->where("group_id=" . $user['user_group'])->find();
        }else{
            $this->error("请先登录！");die;
        }
        if(!in_array($menu['menu_id'],explode(',',$group_role['group_role']))){
            $this->error("对不起，您没有权限访问该地址！");die;
        }
    }

    public function showError($error){
        $this->assign("error",$error);
    }
}