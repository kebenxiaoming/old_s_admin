<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 14:00
 */
namespace Home\Controller;


class FileController extends HomeController{
    public function _initialize(){
        parent::_initialize();
    }

    public function uploadEdit(){

        $return  = array('error' => 0, 'url' => '');
        /* 调用文件上传组件上传文件 */
        $File = D('File');
        $file_driver = C('DOWNLOAD_UPLOAD_DRIVER');
        $info = $File->upload(
            $_FILES,
            C('PICTURE_UPLOAD'),
            C('PICTURE_UPLOAD_DRIVER'),
            C("UPLOAD_{$file_driver}_CONFIG")
        );

        /* 记录附件信息 */
        if($info){
            $return['url'] = __ROOT__ .$info['imgFile']['path'];
        } else {
            $return['error']=1;
        }

        /* 返回JSON数据 */
        $this->ajaxReturn($return);
    }

    //编辑器上传文件
    public function uploadPicture(){
        $return  = array('status' => 1, 'info' => '上传成功', 'data' => '');
        /* 调用文件上传组件上传文件 */
        $File = D('File');
        $file_driver = C('DOWNLOAD_UPLOAD_DRIVER');
        $info = $File->upload(
            $_FILES,
            C('PICTURE_UPLOAD'),
            C('PICTURE_UPLOAD_DRIVER'),
            C("UPLOAD_{$file_driver}_CONFIG")
        );
        /* 记录附件信息 */
        if($info){
            $return['data'] = $info;
            $return['info'] = "上传成功！";
        } else {
            $return['status'] = 0;
            $return['info']   = $File->getError();
        }

        /* 返回JSON数据 */
        $this->ajaxReturn($return);
    }
}