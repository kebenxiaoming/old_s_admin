<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 9:16
 */
namespace Admin\Controller;

class LoginController extends AdminController{

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index(){
        if(IS_POST){
            $verify=$_POST['verify_code'];
            //先检测验证码
            if($this->check_verify($verify)){
                $username=$_POST['user_name'];
                $password=$_POST['password'];
                $remember=$_POST['remember'];
                //在检测用户名和密码
                $result=D("User")->login($username,$password);
                if($result){
                    if($remember){
                            $encrypted = encrypt(session("user")['user_id']);
                            setCookieRemember(urlencode($encrypted),30);
                    }
                    $ip=getIp();
                    Adminlog( session("user")['user_name'], 'LOGIN', 'User' ,session("user")['user_id'],json_encode(array("IP" => $ip)));
                    $this->redirect("Index/index");
                }else{
                    $this->showError("用户名或密码错误");
                }
            }else{
                $this->showError("验证码错误");
            }
        }
        $this->display();
    }

    public function verify(){
        $Verify =     new \Think\Verify();
        $Verify->fontSize = 10;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->entry();
    }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    function check_verify($code, $id = '')
    {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

    public function logout(){
        //清空session和缓存
        session("user",null);
        cookie("sunny_remember",null);
        //跳转到登录页
        $this->redirect("Login/index");
    }

}