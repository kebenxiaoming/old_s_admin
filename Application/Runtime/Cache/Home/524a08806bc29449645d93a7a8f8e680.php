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
        <a href="" style="width:160px;letter-spacing:2px;">账号注册</a>
    </div>
</div>
<div class="loginbg">
    <div class="logincontent">
        <img src="/Public/Home/img/sjssl2.png" style="margin-top:130px;">
        <div class="regform">
            <div style="height:62px;background:url(/Public/Home/img/regformbg.png);margin-bottom:24px;"></div>
            <form method="post" action="" id="regform">
                <ul>
                    <li><label>手机号</label><input type="text" name="mobile" id="mobile" placeholder="请输入您的手机号" value="<?php echo ($_POST["mobile"]); ?>" required="true"></li>
                    <li><label>验证码</label><input type="text" name="verify" placeholder="请输入验证码" id="telphone" value="<?php echo ($_POST["verify"]); ?>" required="true"><div class="getcode">点此获取</div></li>
                    <li><label>登陆密码</label><input type="password" name="password" id="password" value="" placeholder="请输入密码" required="true"></li>
                    <li><label>重复密码</label><input type="password" name="repassword" id="repassword" value="" placeholder="请再次输入密码" required="true"></li>
                    <li><label>姓  名</label><input type="text" name="real_name" id="real_name" placeholder="请输入您的真实姓名" value="<?php echo ($_POST["real_name"]); ?>" required="true"></li>
                    <li><label>邮  箱</label><input type="text" name="email" id="email" placeholder="请输入您的邮箱" value="<?php echo ($_POST["email"]); ?>" required="true"></li>
                    <li style="height:40px;">
                        <label>所在地区</label>
                        <script>
                            var choose_province="<?php echo U('Area/getProvinces');?>",choose_city="<?php echo U('Area/getCities');?>",choose_area="<?php echo U('Area/getAreas');?>";
                        </script>
                        <span id="choose_cityarea" province_id="<?php echo ($_POST["province_id"]); ?>" city_id="<?php echo ($_POST["city_id"]); ?>" area_id="<?php echo ($_POST["area_id"]); ?>"></span>
                    </li>
                    <li><label>供职企业</label><input type="text" name="company" id="company" placeholder="请填写供职企业" value="<?php echo ($_POST["company"]); ?>"></li>
                </ul>
                <input type="button" id="submitbtn" value="立即注册">
                <div class="tolog"><a href="<?php echo U('Login/index');?>">已有账号？去登陆》</a></div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/Home/js/jquery-2.1.4.js"></script>
<script src="/Public/Home/js/area.js"></script>
<script type="text/javascript">
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
    $(".getcode").click(
            function(){
                var mobile=$("#mobile").val();
                if(mobile=="") {
                    alert("当前电话号码为空，请先输入!");return;
                }
                $.post("<?php echo U('Login/sendSmsVerify');?>", { mobile: mobile }, function (text, status) {
                   if(status=="success"){
                       alert(text);
                   }else{
                       alert(text);
                   }
                });
            }
    );
    $("#submitbtn").click(
            function(){
                //提交之前验证
                var mobile=$("#mobile").val();
                var verify=$("#telphone").val();
                var password=$("#password").val();
                var repassword=$("#repassword").val();
                var real_name=$("#real_name").val();
                var email=$("#email").val();
                var company=$("#company").val();
                if(mobile==""||verify==""||password==""||repassword==""||real_name==""||email==""||company==""){
                    alert("有参数为空，请先填写！");return;
                }
                //判断密码
                if(password!=repassword){
                    alert("密码和重复密码不同！");return;
                }
                $("#regform").submit();
            }
    );
</script>
</body>
</html>