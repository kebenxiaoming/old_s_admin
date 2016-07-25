<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/20
 * Time: 10:43
 */
namespace Home\Controller;

class LoginController extends HomeController{
    //登录页面
    public function index(){
        if(IS_POST){
            $verify=strval($_POST['verify_code']);
            //先检测验证码
            if($this->check_verify($verify)){
                $username=strval($_POST['user_name']);
                $password=strval($_POST['password']);
                $remember=$_POST['remember'];
                //在检测用户名和密码
                $result=D("User")->login($username,$password);
                if($result){
                    if($remember){
                        $encrypted = encrypt(session("user")['user_id']);
                        setCookieRemember(urlencode($encrypted),30);
                    }
                    $ip=getIp();
                    Homelog( session("sunny_user")['user_name'], 'LOGIN', 'User' ,session("user")['user_id'],json_encode(array("IP" => $ip)));
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
    //注册
    public function register(){
        if(IS_POST){
            $mobile=I("post.mobile");
            $password=I("post.password");
            $repassword=I("post.repassword");
            $real_name=I("post.real_name");
            $email=I("post.email");
            $company=I("post.company");
            $verify=I("post.verify");
            if(empty($mobile)||empty($password)||empty($repassword)||empty($real_name)||empty($email)||empty($company)||empty($verify)){
                $this->error("参数有空值，请填写后再提交！");die;
            }
            //先判断参数合理性
            if($password!=$repassword){
                $this->error("密码和重复密码不一致，请确认再提交！");die;
            }
            //验证验证码
            $flag=$this->checkSmsVerify($mobile,$verify);
            if(!$flag){
                $this->error("验证码验证失败或者已经过期！");die;
            }
            $user = M("User")->create();

            $user['user_name']=$user['mobile'];
            $user['user_type']=2;
            $user['user_group']=4;
            $user['user_desc']="设计师";
            $user['status']=1;
            $user['password']=md5($user['password']);
            M()->startTrans();
            $res=M("User")->add($user);
            if($res){
                $dealerinfo=M("Designerinfo")->create();
                $dealerinfo['user_id']=$res;
                $dealerinfo['createtime']=time();
                $flag=M("Designerinfo")->add($dealerinfo);
                if($flag){
                    M()->commit();
                    $data=array_merge($user,$dealerinfo);
                    session("user",$data);
                    Homelog(session("sunny_user")['user_name'],"ADD" , "Designer",$flag ,json_encode($data) );
                    $this->success("注册成功！",U("Index/index"));die;
                }else{
                    M()->rollback();
                    $this->error("注册失败！",U("Index/add"));die;
                }
            }else{
                M()->rollback();
            }
        }
        $this->display();
    }

    //生成验证码
    public function sendSmsVerify(){
        //判断手机号是否合法
        $mobile=strval($_POST['mobile']);
        if(!preg_match("/^0{0,1}(13[0-9]|15[7-9]|153|17[0-9]|156|18[5-9])[0-9]{8}$/",$mobile)){
            $this->ajaxReturn("手机号格式不正确，请重新输入！");
        }
        //查询当前用户三分钟之内是否已经生成验证码，如果有则提示不再生成
        $condition['createtime']=array("gt",time()-3*60);
        $condition['mobile']=$mobile;
        $condition['type']=1;
        $condition['status']=1;
        $res=M("Sms")->where($condition)->find();
        if(!empty($res)){
            $this->ajaxReturn("三分钟内禁止生成多个验证码，请先输入当前手机中获取到的验证码！");
        }
        $code=$this->createCode();
        //发送到手机

        //本来需要在发送短信种存储验证码，这里暂时这样存
        $data['mobile']=$mobile;
        $data['content']=$code;
        $data['createtime']=time();
        $data['status']=1;
        $data['type']=1;
        $result=M("Sms")->add($data);
        if($result){
            $this->ajaxReturn("发送成功，验证码10分钟内有效！");
        }else{
            $this->ajaxReturn("发送失败！");
        }
    }
    //检测验证码
    private function checkSmsVerify($mobile,$code){
        $condition['createtime']=array("gt",time()-3*60);
        $condition['mobile']=$mobile;
        $condition['type']=1;
        $condition['status']=1;
        $res=M("Sms")->where($condition)->find();
        if($res){
            if($res['content']==$code){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    //生成6位数字验证码方法
    private function createCode(){
        $code="";
        for($i=0;$i<6;$i++){
            $code.=rand(0,9);
        }
        return $code;
    }

    public function verify(){
        $Verify =     new \Think\Verify();
        $Verify->fontSize = 13;
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
    //退出
    public function logout(){
        //清空session和缓存
        session("sunny_user",null);
        cookie("sunny_remember",null);
        //跳转到登录页
        $this->redirect("Login/index");
    }
}