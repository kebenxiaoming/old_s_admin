<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 9:59
 */
namespace Admin\Model;
use Think\Model;

class UserModel extends Model{
    //检测用户
    public function  login($username,$password){
        $where=array(
            "user_name"=>$username,
        );
        $user=$this->where($where)->find();
        if($user){
            if($user['password']==md5($password)){
                $data=array("group_id"=>$user['user_group']);
                $user_group = M("User_group")->where($data)->find();
                $user['group_id']=$user_group['group_id'];
                $user['user_role']=$user_group['group_role'];
                //更新登录信息
                $user['login_time']=time();
                $user['login_ip']=getIp();
                $this->save($user);

                session("user",$user);
                return true;
            }
        }
        return false;
    }
    //自动登录
    public function autoLogin($user_id){
        if($user_id){
            $data=array("user_id"=>$user_id);
            $user=$this->where($data)->find();
            if(!empty($user)){
                $data=array("group_id"=>$user['user_group']);
                $user_group = M("User_group")->where($data)->find();
                $user['group_id']=$user_group['group_id'];
                $user['user_role']=$user_group['group_role'];

                //更新登录信息
                $user['login_time']=time();
                $user['login_ip']=getIp();
                $this->save($user);

                session("user",$user);
            }
        }
    }
    //重新登录一下
    public function reload(){
        $user=$this->where("user_id=".session("user")['user_id'])->find();
        if($user){
                $data=array("group_id"=>$user['user_group']);
                $user_group = M("User_group")->where($data)->find();
                $user['group_id']=$user_group['group_id'];
                $user['user_role']=$user_group['group_role'];
                session("user",$user);
                return true;
        }
        return false;
    }
}