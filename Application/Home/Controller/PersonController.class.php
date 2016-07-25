<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/20
 * Time: 17:23
 */
namespace Home\Controller;

class PersonController extends HomeController{
    public function index(){
        if(IS_POST){
            $modifypass=false;
            $data=I('post.');

            //先看是否存在填写原密码，如果有则证明有修改密码
            $oldpassword=$data['oldpassword'];
            if(!empty($oldpassword)){
                //比较原密码和数据库中密码
                $user=M("User")->find(session("sunny_user")['user_id']);
                if($user['password']!=md5($oldpassword)){
                    $result=array("info"=>"原密码输入错误！","status"=>0);
                    $this->ajaxReturn($result);
                }else{
                    $modifypass=true;
                }
            }
            //比较完密码之后
            $newpassword=$data['newpassword'];
            $newrepassword=$data['newrepassword'];
            if($newpassword!=$newrepassword){
                $result=array("info"=>"新旧密码不一致！","status"=>0);
                $this->ajaxReturn($result);
            }
            $resdata=M("User")->create();
            $resdata=array_filter($resdata);
            if($modifypass){
                $resdata['password']=md5($newrepassword);
            }
            //如果存在上传文件则保存文件并保存url
            if($data['filedata']!=""){
                $newname="sunny_".time();
                $path="./Uploads/Picture/".date('Y-m-d',time());
                if(is_dir($path)) {
                    if (preg_match('/^(data:\s*image\/(\w+);base64,)/',$data['filedata'], $result)) {
                        $type = $result[2];
                        $filepath = $path . "/" . $newname . ".$type";
                        if(file_put_contents($filepath, base64_decode(str_replace($result[1], '', $data['filedata'])))){
                            $data['imgurl']="/Uploads/Picture/".date('Y-m-d',time()).'/'.$newname.".$type";
                        }
                    }
                }else{
                    if(mkdir($path, 0777, true)) {
                        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $data['filedata'], $result)) {
                            $type = $result[2];
                            $filepath = $path . "/" . $newname . ".$type";
                            if(file_put_contents($filepath, base64_decode(str_replace($result[1], '', $data['filedata'])))){
                                $data['imgurl']="/Uploads/Picture/".date('Y-m-d',time()).'/'.$newname.".$type";
                            }
                        }
                    }
                }
            }
            M()->startTrans();
            $res1=false;
            $res2=false;
            if(!empty($resdata)) {
                $resdata['user_id'] = session("sunny_user")['user_id'];
                $res1 = M("User")->save($resdata);
            }
            $designerinfo=M("Designerinfo")->create($data);
            $designerinfo=array_filter($designerinfo);
            if(!empty($designerinfo)) {
                $designerinfo['user_id'] = session("sunny_user")['user_id'];
                $res2 = M("Designerinfo")->save($designerinfo);
            }
            if($res1||$res2){
                M()->commit();
                $result=array("info"=>"保存成功！","status"=>1);
                //重新刷新用户信息
                D('User')->reload();
                $this->ajaxReturn($result);
            }else{
                M()->rollback();
                $result=array("info"=>"保存失败！","status"=>0);
                $this->ajaxReturn($result);
            }
        }
        //作品列表
        $user_id=session('sunny_user')['user_id'];
        $condition=array(
            "user_id"=>$user_id,
        );
        $count = M("Work")->where($condition)->count();
        $listrows = C("LISTROWS") ? C("LISTROWS") : 10;
        $page = new \Think\Page($count, $listrows);
        $works = M("Work")->where($condition)->limit($page->firstRow, $page->listRows)->order('createtime DESC')->select();
        $this->assign("works",$works);
        $this->assign("page_html",$page->show());
        $this->display();
    }
    //修改作品
    public function editWork(){
        $id=I('get.id');
        $work=M("Work")->find($id);
        //查询出对应的图片预览信息
        if(!empty($work['pics'])) {
            $where['id'] = array(
                "IN", $work['pics']
            );
            $files = M("File")->where($where)->select();
            $this->assign("pics", $files);
        }
        $this->assign("work",$work);
        $this->display();
    }
}