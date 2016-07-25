<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 14:47
 */
namespace Admin\Controller;

class GroupController extends AdminController{
    //分组列表管理
    public function index(){
        $count=M("UserGroup")->count();
        $listrows=C("LISTROWS")?C("LISTROWS"):10;
        $page=new \Think\Page($count,$listrows);
        $groups=M("UserGroup")->alias("g")->field("g.*,u.user_name as owner_name")->join(C("DB_PREFIX")."user as u ON g.owner_id=u.user_id")->limit($page->firstRow,$page->listRows)->select();
        $this->assign("groups",$groups);
        $this->assign("page_html",$page->show());
        $acjs=renderJsConfirm("icon-remove");
        $this->assign("action_confirm",$acjs);
        $this->display();
    }

    public function edit($group_id){
        $group_id=intval($group_id);
        $group=M("UserGroup")->where("group_id=".$group_id)->find();
        if(empty($group)){
            $this->error("不存在该用户组！",U("Group/edit",array("group_id"=>$group_id)));die;
        }

        if (IS_POST) {
            $group_name=strval($_POST['group_name']);
            if($group_name =="" ){
                $this->error("缺少参数！",U("Group/edit",array("group_id"=>$group_id)));die;
            }else{
                $data=M("UserGroup")->create();
                $data['group_id']=$group_id;
                $result = M("UserGroup")->save($data);

                if ($result>=0) {
                    Adminlog(session("user")['user_name'],"MODIFY" , "UserGroup",$group_id ,json_encode($data) );
                    $this->success( '账号组修改完成',U("Group/index"));die;
                } else {
                    $this->error( '修改过程出现错误！',U("Group/index"));die;
                }
            }
        }

        $groupOptions=D("UserGroup")->getGroupForOptions();
        $this->assign ( 'group', $group );
        $this->assign ( 'groupOptions', $groupOptions );
        $this->display();
    }

    public function del($group_id){
        //先查看该分类下是否存在用户，存在则提醒删除用户再删除分组
        $users=M("User")->where("user_group=".$group_id)->select();
        if(!empty($users)){
            $this->error("请先删除该分组下用户，才允许删除分组！",U("Group/index"));die;
        }
        $result=M("UserGroup")->where("group_id=".$group_id)->delete();
        if($result){
            $this->success("删除成功！",U("Group/index"));die;
        }else{
            $this->error("删除失败！",U("Group/index"));die;
        }
    }

    //权限管理
    public function group_role(){
        $group_id=intval($_GET['group_id']);
        $menu_ids=array();
        $group_id =  $group_id == ""? 1:intval($group_id);

        $group_option_list = D("GroupRole")->getGroupForOptions ();
        $group_info = M("UserGroup")->where("group_id=".$group_id)->find();
        if(!$group_info){
            $group_id =1;
            $group_info =  M("UserGroup")->where("group_id=".$group_id)->find();
        }
        $role_list = D("GroupRole")->getGroupRoles ( $group_id );

        $group_role = $group_info ['group_role'];
        $group_role_array = explode ( ',', $group_role );

        if (IS_POST) {
            $menu_ids=$_POST['menu_ids'];
            if($group_id==1){
                $temp = array();
                foreach ($group_role_array as $group_role){

                    if($group_role>100){
                        $temp[]=$group_role;
                    }
                }

                $admin_role = array_diff($group_role_array,$temp);

                $menu_ids = array_merge($admin_role,$menu_ids);
                $menu_ids = array_unique($menu_ids);
                asort($menu_ids);
            }
            $group_role = join ( ',', $menu_ids );
            $group_data = array ("group_id"=>$group_id,'group_role' => $group_role );
            $result = M("UserGroup")->save($group_data );
            if ($result>=0) {
                Adminlog(session("user")['user_name'], 'MODIFY', 'UserGroup' ,$group_id, json_encode($group_data) );
                //如果属于当前用户的用户组，则必须重新给当前用户菜单权限
                D("User")->reload();
                $this->success("修改权限成功！",U("Group/group_role"));die;
            }else{
                $this->success("修改权限失败！",U("Group/rgoup_role"));die;
            }
        }
        $this->assign ( 'role_list', $role_list );
        $this->assign ( 'group_id', $group_id );
        $this->assign ( 'group_option_list', $group_option_list );
        $this->assign ( 'group_role', $group_role_array );
        $this->display();
    }

    public function add(){
        if (IS_POST) {
            $group_name=strval($_POST['group_name']);
            if($group_name =="" ){
                $this->error("缺少参数！");die;
            }else{
                $data=M("UserGroup")->create();
                $data['group_role']="1,5,17,18,22,23,24,25";
                $data['owner_id']=session("user")['user_id'];
                
                $result = M("UserGroup")->add($data);

                if ($result>=0) {
                    Adminlog(session("user")['user_name'],"ADD" , "UserGroup",$result ,json_encode($data) );
                    $this->success( '新增账号组成功',U("Group/index"));die;
                } else {
                    $this->error( '新增账号组出错！',U("Group/index"));die;
                }
            }
        }

        $this->display();
    }
}