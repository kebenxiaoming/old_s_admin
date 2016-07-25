<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/25
 * Time: 9:16
 */
namespace Admin\Controller;

class WorkController extends AdminController{
    //修改作品信息
    public function editWork(){
        if(IS_POST){
            $data=M("Work")->create();
            if(empty($data['title']||empty($data['desc']))){
                $this->error("标题和描述禁止为空!");die;
            }
            $data['updatetime']=time();
            $res=M("Work")->save($data);
            if($res){
                $this->success("修改作品成功！",U("Designer/workList"));die;
            }else{
                $this->error("修改作品失败！",U("Designer/workList"));die;
            }
        }
        $this->display();
    }
}