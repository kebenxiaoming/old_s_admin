<?php
namespace Admin\Controller;

class IndexController extends AdminController {
    public function index(){
       $this->display();
    }

    public function competition_inst(){
        $article=M("Article")->where("id=1")->find();
        if(!empty($article)){
            $this->assign("article",$article);
        }

        if (IS_POST) {
            $id=intval($_POST['id']);
            $content=strval($_POST['content']);
            if(empty($content)){
               $this->error("内容参数不能为空！",U("Index/competition_inst"));die;
            }
            if(!empty($id)){
                $input_data = array ('id'=>$id,'content' => $content,"updatetime"=>time());
                $result = M("Article")->save($input_data);
                if($result) {
                    Adminlog(session("user")['user_name'], 'MODIFY', 'Article', $id, json_encode($input_data));
                    $this->success('大赛简介内容修改成功！!',U("Index/competition_inst"));die;
                }
            }else{
                $input_data = array ('content' => $content,"createtime"=>time(),"updatetime"=>time());
                $id = M("Article")->add($input_data);
                if($id) {
                    Adminlog(session("user")['user_name'], 'Add', 'Article', $id, json_encode($input_data));
                    $this->success('大赛简介内容新增成功！!',U("Index/competition_inst"));die;
                }
            }
        }
        $this->display();
    }
    //发送的短信列表
    public function sms(){
        $count = M("Sms")->count();
        $listrows = C("LISTROWS") ? C("LISTROWS") : 10;
        $page = new \Think\Page($count, $listrows);
        $smss = M("Sms")->limit($page->firstRow, $page->listRows)->select();
        $this->assign("smss",$smss);
        $this->assign("page_html",$page->show());
        $this->display();
    }
}