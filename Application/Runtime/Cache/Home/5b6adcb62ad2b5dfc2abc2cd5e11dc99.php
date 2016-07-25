<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>热水器CRM</title>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/main.css">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/swiper.min.css">
</head>
<body>
<div class="header-wrap">
    <div class="header-content">
        <img src="/Public/Home/img/index_logo.png" style="margin-top:20px">
        <a href="" style="width:160px;letter-spacing:2px;">账号登陆</a>
    </div>
</div>
<div class="loginbg">
    <div class="logincontent">
        <img src="/Public/Home/img/sjssl.png" style="margin-top:120px;">
        <div class="loginform">
            <form method="post" action="" id="loginform">
                <div style="height:62px;background:url(/Public/Home/img/loginformbg.png);margin-bottom:24px;"></div>
                <div class="dianhua"><input type="text" name="user_name" placeholder="请输入您的手机号" value="<?php echo ($_POST["user_name"]); ?>"></div>
                <div class="mima"><input type="password" name="password" placeholder="请输入您的密码" ></div>
                <div class="yzm">验证码<input type="text" name="verify_code" placeholder="输入验证码"><img id="verify_code" style="cursor:pointer;" src="<?php echo U('Login/verify');?>"><span style="color:red;"><?php echo ($error); ?></span></div>
                <div class="jizhu"><span class="check"><p><input type="checkbox" id="jizhu"></p><img src="/Public/Home/img/checked.png" class="checkedimg"></span><label for="jizhu">记住我</label><span class="tip">1个月内不用再次登入</span></div>
                <input type="button" class="submit" value="登  陆">
                <div class="toreg"><a href="<?php echo U('Login/register');?>">没有账号？立即注册》</a></div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/Home/js/jquery-2.1.4.js"></script>
<script type="text/javascript">
    $(".loginbg").height($(window).height()-68);
    var checked=false;
    $('.check').click(function(){
        if(!checked){
            $(".checkedimg").css('visibility','visible');
            checked=true;
        }else{
            $(".checkedimg").css('visibility','hidden');
            checked=false;
        }

    });
    $(".submit").click(
            function(){
                $('#loginform').submit();
            }
    );
    $("#verify_code").click(function(){
        $(this).attr("src","<?php echo U('Login/verify');?>");
    });
</script>
</body>
</html>