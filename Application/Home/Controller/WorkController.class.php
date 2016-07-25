<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/20
 * Time: 16:55
 */
namespace Home\Controller;

class WorkController extends HomeController{
    public function index(){
        $works = D("Work")->alias("w")->field("w.*,u.real_name,d.company")->join(C("DB_PREFIX")."user  u ON w.user_id=u.user_id")->join(C("DB_PREFIX")."designerinfo d  ON w.user_id=d.user_id")->order("sort DESC")->limit(8)->select();
        $this->assign("works",$works);
        $allworks = D("Work")->alias("w")->field("w.*,u.real_name")->join(C("DB_PREFIX")."user  u ON w.user_id=u.user_id")->order("createtime DESC")->limit(16)->select();
        $this->assign("allworks",$allworks);
        $this->display();
    }
    //添加作品
    public function addWork(){
        if(IS_POST){
            //先检测是否存在标题和描述
            $title=strval($_POST['title']);
            $desc=strval($_POST['desc']);
            if(empty($title)||empty($desc)){
                $this->error("标题或者描述为空，请填写后再提交！");die;
            }
            if(empty($_FILES)){
                $this->error("请上传作品图片！");die;
            }
            /* 调用文件上传组件上传文件 */
            $File = D('File');
            $file_driver = C('DOWNLOAD_UPLOAD_DRIVER');
            $info = $File->upload(
                $_FILES,
                C('PICTURE_UPLOAD'),
                C('PICTURE_UPLOAD_DRIVER'),
                C("UPLOAD_{$file_driver}_CONFIG")
            );
            if(count($info)==1){
                $pics=$info[0]['id'];
            }else{
                foreach($info as $k=>$v){
                    $pictrues[]=$v['id'];
                }
                $pics=implode(",",$pictrues);
            }
            $work=M("Work");
            $data=$work->create();
            $data['pics']=$pics;
            $data['user_id']=session('sunny_user')['user_id'];
            $data['createtime']=time();
            $data['updatetime']=time();
            print_r($data);die;
            $res=$work->add($data);
            if($res){
                $this->success("添加作品成功！",U("Person/index"));die;
            }else{
                $this->error("添加作品失败！",U("Person/index"));die;
            }
        }else{
            $this->error("请求方式不正确！");die;
        }
    }
    //修改作品
    public function editWork(){
        if(IS_POST){
            $data=M("Work")->create();
            if(empty($data['title']||empty($data['desc']))){
                $this->error("标题和描述禁止为空!");die;
            }
            $data['updatetime']=time();
            $res=M("Work")->save($data);
            if($res){
                $this->success("修改作品成功！",U("Person/index"));die;
            }else{
                $this->error("修改作品失败！",U("Person/index"));die;
            }
        }
    }
}