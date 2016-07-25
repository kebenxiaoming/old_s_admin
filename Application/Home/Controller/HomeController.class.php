<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/20
 * Time: 10:43
 */
namespace Home\Controller;
use Think\Controller;

class HomeController extends Controller{
    public function _initialize()
    {
        //查看是否存在记录cookie
        $user_id=getCookieRemember();

        if($user_id){
            //自动登录
            if(empty(session("sunny_user"))){
                D("User")->autoLogin($user_id);
            }
        }
        if(session('sunny_user')){
            $this->assign("userinfo",session('sunny_user'));
        }else{
            if(CONTROLLER_NAME.'/'.ACTION_NAME=="Person/index"){
                $this->redirect('Login/index');die;
            }
        }
    }

    public function showError($error){
        $this->assign("error",$error);
    }
}