<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/19
 * Time: 17:04
 */
namespace Admin\Controller;

class DesignerController extends AdminController{
    //经销商列表
    public function index(){
        $search=strval($_GET['search']);
        if(!empty($search)) {
            $condition['u.real_name']=array("LIKE","%".$search."%");
            $count =  D("Designerinfo")->alias("d")->join(C("DB_PREFIX")."user u ON d.user_id=u.user_id")->where($condition)->count();
            $listrows = C("LISTROWS") ? C("LISTROWS") : 10;
            $page = new \Think\Page($count, $listrows);
            $designers = D("Designerinfo")->alias("d")->join(C("DB_PREFIX")."user u ON d.user_id=u.user_id")->where($condition)->limit($page->firstRow, $page->listRows)->select();
        }else{
            $count = D("Designerinfo")->count();
            $listrows = C("LISTROWS") ? C("LISTROWS") : 10;
            $page = new \Think\Page($count, $listrows);
            $designers = D("Designerinfo")->alias("d")->join(C("DB_PREFIX")."user u ON d.user_id=u.user_id")->limit($page->firstRow, $page->listRows)->select();
        }
        $this->assign("designers",$designers);
        $this->assign("page_html",$page->show());
        //删除确认
        $acjs=renderJsConfirm("icon-remove");
        $this->assign("action_confirm",$acjs);
        $this->display();
    }
    //添加设计师
    public function add(){
        //先插入到用户表中然后将返回的id作为主键插入到关联的经销商信息表中
        if(IS_POST) {
            $user = M("User")->create();
            $user['user_name']=$user['mobile'];
            $user['user_type']=2;
            $user['user_group']=4;
            $user['user_desc']="设计师";
            $user['status']=1;
            $user['password']=md5($user['password']);
            M()->startTrans();
            $res=M("User")->add($user);
            if($res){
                $dealerinfo=M("Designerinfo")->create();
                $dealerinfo['user_id']=$res;
                $dealerinfo['createtime']=time();
                $flag=M("Designerinfo")->add($dealerinfo);
                if($flag){
                    M()->commit();
                    $data=array_merge($user,$dealerinfo);
                    Adminlog(session("user")['user_name'],"ADD" , "Designer",$flag ,json_encode($data) );
                    $this->success("添加设计师成功！",U("Designer/index"));die;
                }else{
                    M()->rollback();
                    $this->error("添加设计师失败！",U("Designer/add"));die;
                }
            }else{
                M()->rollback();
            }
        }
        $this->display();
    }
    //删除设计师
    public function del(){
        $user_id=intval($_GET['user_id']);
        $where=array(
            "user_id"=>$user_id
        );
        //先查找是否存在该用户
        $designer=M("User")->where($where)->find();
        if(empty($designer)){
            $this->error("不存在该用户！");die;
        }
        M()->startTrans();
        $flag=M("User")->where($where)->delete();
        if($flag){
            $res=M("Designerinfo")->where($where)->delete();
            if($res){
                M()->commit();
                Adminlog(session("user")['user_name'],"DEL" , "Designer",$user_id ,json_encode($designer) );
                $this->success("删除设计师成功！",U("Designer/index"));die;
            }else{
                M()->rollback();
                $this->error("删除设计师失败！",U("Designer/index"));die;
            }
        }else{
            M()->rollback();
        }
    }

    //编辑设计师
    public function edit(){
        $user_id=intval($_GET['user_id']);
        if(IS_POST){
            $user = M("User")->create();
            $user['user_id']=$user_id;
            if(empty($user['password'])){
                unset($user['password']);
            }else{
                $user['password']=md5($user['password']);
            }
            M()->startTrans();
            $flag=M("User")->save($user);
            $designerinfo=M("Designerinfo")->create();
            $designerinfo['user_id']=$user_id;
            $res=M("Designerinfo")->save($designerinfo);
            if($res||$flag){
                M()->commit();
                Adminlog(session("user")['user_name'],"MODIFY" , "Designer",$user_id ,json_encode($user) );
                $this->success("修改设计师成功！",U("Designer/index"));die;
            }else{
                M()->rollback();
                $this->error("修改设计师失败！",U("Designer/edit",array('user_id'=>$user_id)));die;
            }
        }
        $where['d.user_id']=$user_id;
        $designer=M("Designerinfo")->alias("d")->join(C("DB_PREFIX")."user u ON d.user_id=u.user_id")->where($where)->find();
        $this->assign("designer",$designer);
        $this->display();
    }

    //作品列表
    public function workList(){
        $count = D("Work")->count();
        $listrows = C("LISTROWS") ? C("LISTROWS") : 10;
        $page = new \Think\Page($count, $listrows);
        $works = D("Work")->alias("w")->field("w.*,u.real_name")->join(C("DB_PREFIX")."user u ON w.user_id=u.user_id")->limit($page->firstRow, $page->listRows)->select();
        $this->assign("works",$works);
        $this->assign("page_html",$page->show());
        $this->display();
    }

}