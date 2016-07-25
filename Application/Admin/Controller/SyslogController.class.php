<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 16:18
 */
namespace Admin\Controller;

class SyslogController extends AdminController{
    //日志列表
    public function index(){
        $count=M("SysLog")->count();
        $listrows=C("LISTROWS")?C("LISTROWS"):10;
        $page=new \Think\Page($count,$listrows);
        $logs=M("SysLog")->limit($page->firstRow,$page->listRows)->order("op_time DESC")->select();
        foreach($logs as &$log){

            if(array_key_exists($log['action'],C("COMMAND_FOR_LOG"))){
                $log['action']=C("COMMAND_FOR_LOG")[$log['action']];
            }



            $class_obj = $log['class_obj'];
            if(array_key_exists($log['class_name'],C("CLASS_FOR_LOG"))){
                $log['class_name'] = C("CLASS_FOR_LOG")[$log['class_name']];
            }


            if($log['class_obj']==""){
                $log['class_obj']='null';
            }

            if(empty($log['result'])){
                $log['result'] = '成功';
            }else{
                $result =json_decode($log['result'],true);
                if(is_array($result)){
                    $temp = null;
                    foreach($result as $key => $value){
                        $temp[] = "$key=>$value";
                    }
                    if(!empty($temp)) {
                        $log['result'] = implode(';', $temp);
                    }
                }else{
                    $log['result']=$result;
                }
            }
            $record=$log['action'] . " " . $log['result'];
            if(mb_strlen($record,"utf8")>50) {
                $log['record'] = mb_substr($log['action'] . " " . $log['result'], 0,50, "utf8")."...";
            }else{
                $log['record']=$record;
            }
        }
        $this->assign("logs",$logs);
        $this->assign("page_html",$page->show());
        $this->display();
    }
}