<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/19
 * Time: 15:42
 */
namespace Admin\Controller;

class DealerController extends AdminController{
    //经销商列表
    public function index(){
        $search=strval($_GET['search']);
        if(!empty($search)) {
            $condition['u.user_name']=array("LIKE","%".$search."%");
            $count =  D("Dealerinfo")->alias("d")->join(C("DB_PREFIX")."user u ON d.user_id=u.user_id")->where($condition)->count();
            $listrows = C("LISTROWS") ? C("LISTROWS") : 10;
            $page = new \Think\Page($count, $listrows);
            $dealers = D("Dealerinfo")->alias("d")->join(C("DB_PREFIX")."user u ON d.user_id=u.user_id")->where($condition)->limit($page->firstRow, $page->listRows)->select();
        }else{
            $count = D("Dealerinfo")->count();
            $listrows = C("LISTROWS") ? C("LISTROWS") : 10;
            $page = new \Think\Page($count, $listrows);
            $dealers = D("Dealerinfo")->alias("d")->join(C("DB_PREFIX")."user u ON d.user_id=u.user_id")->limit($page->firstRow, $page->listRows)->select();
        }
        $this->assign("dealers",$dealers);
        $this->assign("page_html",$page->show());
        //删除确认
        $acjs=renderJsConfirm("icon-remove");
        $this->assign("action_confirm",$acjs);
        $this->display();
    }
    //添加经销商
    public function add(){
        //先插入到用户表中然后将返回的id作为主键插入到关联的经销商信息表中
        if(IS_POST) {
            $user = M("User")->create();
            $user['user_type']=1;
            $user['user_group']=3;
            $user['user_desc']="经销商";
            $user['status']=1;
            $user['password']=md5($user['password']);
            M()->startTrans();
            $res=M("User")->add($user);
            if($res){
                $dealerinfo=M("Dealerinfo")->create();
                $dealerinfo['user_id']=$res;
                $dealerinfo['createtime']=time();
                $flag=M("Dealerinfo")->add($dealerinfo);
                if($flag){
                    M()->commit();
                    $data=array_merge($user,$dealerinfo);
                    Adminlog(session("user")['user_name'],"ADD" , "Dealer",$flag ,json_encode($data) );
                    $this->success("添加经销商成功！",U("Dealer/index"));die;
                }else{
                    M()->rollback();
                    $this->error("添加经销商失败！",U("Dealer/add"));die;
                }
            }else{
                M()->rollback();
            }
        }
        $this->display();
    }

    //编辑经销商
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
            $dealerinfo=M("Dealerinfo")->create();
            $dealerinfo['user_id']=$user_id;
            $res=M("Dealerinfo")->save($dealerinfo);
            if($res||$flag){
                    M()->commit();
                    Adminlog(session("user")['user_name'],"MODIFY" , "Dealer",$user_id ,json_encode($user) );
                    $this->success("修改经销商成功！",U("Dealer/index"));die;
            }else{
                    M()->rollback();
                    $this->error("修改经销商失败！",U("Dealer/edit",array('user_id'=>$user_id)));die;
            }
        }
        $where['d.user_id']=$user_id;
        $dealer=M("Dealerinfo")->alias("d")->join(C("DB_PREFIX")."user u ON d.user_id=u.user_id")->where($where)->find();
        $this->assign("dealer",$dealer);
        $this->display();
    }

    //删除经销商
    public function del(){
        $user_id=intval($_GET['user_id']);
        $where=array(
            "user_id"=>$user_id
        );
        //先查找是否存在该用户
        $dealer=M("User")->where($where)->find();
        if(empty($dealer)){
            $this->error("不存在该用户！");die;
        }
        M()->startTrans();
        $flag=M("User")->where($where)->delete();
        if($flag){
            $res=M("Dealerinfo")->where($where)->delete();
            if($res){
                M()->commit();
                Adminlog(session("user")['user_name'],"DEL" , "Dealer",$user_id ,json_encode($dealer) );
                $this->success("删除经销商成功！",U("Dealer/index"));die;
            }else{
                M()->rollback();
                $this->error("删除经销商失败！",U("Dealer/index"));die;
            }
        }else{
            M()->rollback();
        }
    }
}