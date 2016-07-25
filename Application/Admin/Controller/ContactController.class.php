<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/20
 * Time: 9:20
 */
namespace Admin\Controller;

class ContactController extends AdminController{
    //联络列表
    public function index(){
        $condition['senduid']=session('user')['user_id'];
        $count = M("Message")->where($condition)->count();
        $listrows = C("LISTROWS") ? C("LISTROWS") : 10;
        $page = new \Think\Page($count, $listrows);
        $messages = M("Message")->where($condition)->limit($page->firstRow, $page->listRows)->select();
        $this->assign("messages",$messages);
        $this->assign("page_html",$page->show());

        $acjs=renderJsConfirm("icon-remove");
        $this->assign("action_confirm",$acjs);

        $this->display();
    }
    //新增联络
    public function addMsg(){
        //查询设计师
        $condition['user_type']=2;
        $designers=M("User")->where($condition)->select();
        $this->assign("designers",$designers);
        if(IS_POST){
            $data=M("Message")->create();
            $data['senduid']=session("user")['user_id'];
            //如果发送的touid为0，则全部发送
            if($data['touid']==0){
                foreach($designers as $k=>$v){
                    $data['touid']=$v['user_id'];
                    $data['createtime']=time();
                    $dataList[]=$data;
                }
                if(!empty($dataList)){
                    M()->startTrans();
                    $res=M("Message")->addAll($dataList);
                    if($res){
                        M()->commit();
                        Adminlog(session("user")['user_name'],"ADD" , "Message",$res ,json_encode($dataList) );
                        $this->sendAllMsg($dataList);
                        $this->success("新增联络成功！",U("Contact/addMsg"));die;
                    }else{
                        M()->rollback();
                        $this->error("新增联络失败！",U("Contact/addMsg"));die;
                    }
                }
            }
            $data['createtime']=time();
            $flag=M("Message")->add($data);
            if($flag){
                Adminlog(session("user")['user_name'],"ADD" , "Message",$flag ,json_encode($data) );
                $this->sendMsg($data);
                $this->success("新增联络成功！",U("Contact/addMsg"));die;
            }else{
                $this->error("新增联络失败！",U("Contact/addMsg"));die;
            }
        }
        $this->display();
    }
    //联络详情
    public function show(){
        $id=intval($_GET['id']);
        $message=M("Message")->find($id);
        $this->assign("message",$message);
        $this->display();
    }
    //我的消息
    public function myMsg(){
        $this->display();
    }

    //根据发送类型决定发送的方式（发送一个）
    private function sendMsg($data){
        $flag=false;
        switch($data['msg_type']){
            case 1:
                //发送短信
                break;
            case 2:
                //发送邮件
                break;
            case 3:
                //发送站内信
                break;
            default:
                //发送站内信
                break;
        }
        return $flag;
    }

    //根据发送类型决定发送的方式(发送多个)
    private function sendAllMsg($data){
        $flag=false;
        foreach($data as $k=>$v){
            $flag=$this->sendMsg($v);
        }
       return $flag;
    }
}