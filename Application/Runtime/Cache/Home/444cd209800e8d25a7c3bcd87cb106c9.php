<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>热水器CRM</title>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/main.css">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/animate.css">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/swiper.min.css">
</head>
<body <?php if(CONTROLLER_NAME.'/'.ACTION_NAME == 'Work/index' || CONTROLLER_NAME.'/'.ACTION_NAME == 'Message/index' || CONTROLLER_NAME.'/'.ACTION_NAME == 'Person/index'): ?>style="background:#f4f4f4"<?php endif; ?>>
<div class="header-wrap">
    <div class="header-content">
        <img src="/Public/Home/img/index_logo.png" style="margin-top:20px">
        <?php if($userinfo): ?><a href="<?php echo U('Login/logout');?>"  style="background:#541b86">退出</a>
            <a href="<?php echo U('Person/index');?>" >欢迎 , <?php echo ($userinfo["real_name"]); ?></a>
            <?php else: ?>
            <a href="<?php echo U('Login/register');?>" style="background:#541b86">注册</a>
            <a href="<?php echo U('Login/index');?>">登陆</a><?php endif; ?>

    </div>
</div>
<div class="my-content">
    <div class="title06"></div>
    <div class="left">
        <div class="l-header">
            个人中心<div class="xiugai"></div>
        </div>
        <?php if($userinfo['imgurl']): ?><img src="<?php echo ($userinfo["imgurl"]); ?>" class="face">
        <?php else: ?>
            <img src="/Public/Home/img/allimg.png" class="face"><?php endif; ?>
        <div class="p-info">
            <p>登陆账号：<?php echo substr_replace($userinfo['mobile'],'****',3,4); ?></p>
            <p>会员等级：<?php echo getLevel($userinfo['level']); ?><a href="">等级规则</a></p>
            <P style="margin-top:40px;">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：<?php echo ($userinfo["real_name"]); ?></p>
            <p>所在地区：<?php echo getLocation($userinfo['city_id'],$userinfo['area_id']); ?></p>
            <p>邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱：<span><?php echo ($userinfo["email"]); ?></span></p>
            <p>联系方式：<?php echo substr_replace($userinfo['mobile'],'****',3,4); ?></p>
        </div>
        <div class="registered">
            <div id="close"></div>
            <p class="xg-title">修改信息<span style="padding-left:20px;font-size:14px;">MODIFY</span></p>
            <div class="xg-wrap">
                <div class="l">
                    <form method="post" action="" id="modifyform" enctype="multipart/form-data">
                        <div><label>原密码</label><input type="password" id="oldpassword" name="oldpassword" placeholder="请输入您的原密码"></div>
                    <div><label>新的密码</label><input type="password"  id="newpassword" name="newpassword" placeholder="请输入您的新密码"></div>
                    <div><label>重复密码</label><input type="password"   id="newrepassword" name="newrepassword" placeholder="请再次输入新密码"></div>
                    <div><label>姓&nbsp;&nbsp;&nbsp;名</label><input name="real_name" id="real_name" type="text" value="<?php echo ($userinfo["real_name"]); ?>" placeholder="请输入您的姓名"></div>
                    <div><label>邮&nbsp;&nbsp;&nbsp;箱</label><input type="text" id="email" name="email" placeholder="请输入您的邮箱" value="<?php echo ($userinfo["email"]); ?>"></div>
                    <div style="height:40px;float:left;"><label style="float:left">所在地区</label>
                        <script>
                            var choose_province="<?php echo U('Area/getProvinces');?>",choose_city="<?php echo U('Area/getCities');?>",choose_area="<?php echo U('Area/getAreas');?>";
                        </script>
                        <span id="choose_cityarea" province_id="<?php echo ($userinfo["province_id"]); ?>" city_id="<?php echo ($userinfo["city_id"]); ?>" area_id="<?php echo ($userinfo["area_id"]); ?>"></span>
                    </div>
                    <div><label>供职企业</label><input type="text" id="company" name="company" placeholder="请填写供职企业" value="<?php echo ($userinfo["company"]); ?>"></div>
                </div>
                </form>
                <div class="r">
                    <div class="image-editor">
                        <div class="cropit-preview"></div>
                        <label for="file-input" id="filelabel">选择头像</label>
                        <input type="file" name="imgurl" class="cropit-image-input" id="file-input">
                        <input type="range" class="cropit-image-zoom-input">
                        <button class="export" >确定修改</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="right">
        <div class="add-work">
            <div id="closeblack"></div>
            <form action="<?php echo U('Work/addWork');?>" method="post" enctype="multipart/form-data">
                <div class="in1">
                    <label>作品名称</label>
                    <input type="text" name="title" placeholder="请输入您的作品名称">
                </div >
                <div class="in2">
                    <label>作品描述</label>
                    <textarea name="desc" placeholder="请输入作品描述"></textarea>
                </div>
                <div class="in3">
                    <label>上传图片</label>
                    <div class="uploadlist">
                        <div class="imgbox">
                            <span class='delet'>×</span>
                            <label for="img1">
                                <input type="file" id="img1" name="pictrue[]" accept="image/jpeg, image/png ,image/gif"/>
                            </label>
                        </div>
                    </div>
                </div>
                <div style="margin:18px 0 0 130px;height:21px;">
                    <!--<label id="upload-img-btn" for="upload-input"></label--><span class="upload-ts">（上传产品缩略图 141*59）</span>
                    <!--<input type="file" accept="image/png, image/jpeg" id="upload-input">-->
                </div>
                <input type="submit" class="subwork" value="提	交">
            </form>
        </div>
        <div class="add"></div>
        <ul class="work-list">
            <?php if(is_array($works)): $i = 0; $__LIST__ = $works;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$work): $mod = ($i % 2 );++$i;?><li>
                    <img stype="width:196px;height:155px;" src="<?php echo getImg($work['pics']); ?>">
                    <div class="work-info">
                        <p class="p1"><?php echo ($work["title"]); ?></p>
                        <p class="p2"><?php echo ($work["desc"]); ?></p>
                    </div>
                    <div class="redit"><a href="<?php echo U('Person/editWork',array('id'=>$work['id']));?>">修改作品</a></div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div><?php echo ($page_html); ?></div>
    </div>
</div>
<div class="footer-wrap" style="position:relative">
    <div style="background:#000;margin-top:20px;">
        <ul class="footer-menu">
            <li>
                <a href="<?php echo U('Index/instruction');?>">
                    <img src="/Public/Home/img/menu01.png" class="zh-cn">
                    <div class="cn">大赛简介</div>
                    <img src="/Public/Home/img/purple.png" class="purple">
                    <img src="/Public/Home/img/gray.png" class="gray">
                </a>
            </li>
            <li>
                <a href="<?php echo U('Product/index');?>">
                    <img src="/Public/Home/img/menu02.png" class="zh-cn">
                    <div class="cn">产品展示</div>
                    <img src="/Public/Home/img/purple.png" class="purple">
                    <img src="/Public/Home/img/gray.png" class="gray">
                </a>
            </li>
            <li>
                <a href="<?php echo U('Work/index');?>">
                    <img src="/Public/Home/img/menu03.png" class="zh-cn">
                    <div class="cn">作品展示</div>
                    <img src="/Public/Home/img/purple.png" class="purple">
                    <img src="/Public/Home/img/gray.png" class="gray">
                </a>
            </li>
            <li>
                <a href="<?php echo U('Message/index');?>">
                    <img src="/Public/Home/img/menu04.png" class="zh-cn">
                    <div class="cn">消息中心</div>
                    <img src="/Public/Home/img/purple.png" class="purple">
                    <img src="/Public/Home/img/gray.png" class="gray">
                </a>
            </li>
            <li  class="active">
                <a href="<?php echo U('Person/index');?>">
                    <img src="/Public/Home/img/menu05.png" class="zh-cn">
                    <div class="cn">个人中心</div>
                    <img src="/Public/Home/img/purple.png" class="purple">
                    <img src="/Public/Home/img/gray.png" class="gray">
                </a>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript" src="/Public/Home/js/jquery-2.1.4.js"></script>
<script src="/Public/Home/js/area.js"></script>
<script type="text/javascript" src="/Public/Home/js/swiper.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery.cropit.js"></script>
<script type="text/javascript">
    var mySwiper = new Swiper ('#ranqi', {
        direction: 'horizontal',
        loop: true,
        autoplay : false,
        nextButton: '.ranqiprev',
        prevButton: '.ranqinext'
        // paginationClickable :true
    });
    var myDian = new Swiper ('#dian', {
        direction: 'horizontal',
        loop: true,
        autoplay : false,
        nextButton: '.dianprev',
        prevButton: '.diannext'
        // paginationClickable :true
    });
    $('.mes-menu li').each(function(index){
        $(this).click(function(){
            $(this).addClass('on').siblings().removeClass('on');
            $('.p-item').eq(index).css('display','block').siblings().css('display','none');
        });
    });
    $('.xiugai').click(function(){
        $('.registered').fadeIn();
    });
    $('#close').click(function(){
        $('.registered').fadeOut();
    });
    $('.add').click(function(){
        $('.add-work').fadeIn();
    });
    $('#closeblack').click(function(){
        $('.add-work').fadeOut();
    });
    /**/

    $(".footer-menu li").each(function(){
        if($(this).hasClass('active')){

        }else{
            $(this).hover(
                    function(){
                        $(this).find('.purple').stop().animate({'bottom':0,'left':0,'opacity':1},200,'swing');
                        $(this).find('.gray').stop().animate({'bottom':0,'left':'18px','opacity':1},200,'swing');
                        $(this).find('.zh-cn').css('display','none');
                        $(this).find('.cn').fadeIn();
                    },
                    function(){
                        _thiss=$(this);
                        $(this).find('.purple').stop().animate({'bottom':'-640px','left':'-200px','opacity':1},200,'swing');
                        $(this).find('.gray').animate({'bottom':'-164px','left':"200px",'opacity':0},200,'swing');
                        $(this).find('.zh-cn').fadeIn();
                        $(this).find('.cn').css('display','none');
                    }
            )
        }

    });

    /************************************/
    $(function() {
        $('.image-editor').cropit({
            exportZoom:1,
            imageBackground: true,
            imageBackgroundBorderWidth: 0,
            imageState: {
                src: '',
            },
        });
        $('.export').click(function() {
            var imageData = $('.image-editor').cropit('export');
            //获取密码相关
            var oldpassword=$("#oldpassword").val();
            if(oldpassword!=""){
                var newpassword=$("#newpassword").val();
                var newrepassword=$("#newrepassword").val();
                if(newpassword!=newrepassword){
                    alert("修改密码和重复密码不一致！");return;;
                }
            }
            var real_name=$("#real_name").val();
            var email=$("#email").val();
            if(email!=""){
                var flag=CheckMail(email);
                if(!flag){
                    alert("邮箱格式不正确！");return;
                }
            }
            var company=$("#company").val();
            var province_id=$("#choose_province").val();
            var city_id=$("#choose_city").val();
            var area_id=$("#choose_area").val();
            if(typeof(imageData)=="undefined"){
                imageData="";
            }
            $.post("<?php echo U('Person/index');?>", {oldpassword:oldpassword,newpassword:newpassword,
                newrepassword:newrepassword,real_name:real_name,
                email:email,company:company,province_id:province_id,
                city_id:city_id,area_id:area_id,filedata:imageData},
                    function(res) {
                var result=eval(res);
                if(result.status==1){
                    alert(result.info);
                    window.location.href="<?php echo U('Person/index');?>";
                }else{
                    alert(result.info);
                    return;
                }
            });
        });
    });
    function CheckMail(mail) {
        var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (filter.test(mail)) return true;
        else {
            return false;
        }
    }
    /*******************************************/
//    var imgArr=[],index=1,num=3;
//    $('.uploadlist').on('change','input',function(event){
//        var name=$(this).val();
//        _this=$(this);
//        if(jQuery.inArray(name,imgArr)!=-1){
//            alert('已经存在');
//        }else{
//            imgArr.push(name);
//            if(window.FileReader){
//                // var file=document.forms[0].img.files[index];
//                var file=event.target.files[0];
//                var FR=new FileReader();
//                FR.readAsDataURL(file);
//                FR.onload=function(event){
//                    // var imgData=event.target.resuslt;
//                    var SRC=this.result;
//                    index++;
//                    _this.parent().css('background','white url('+SRC+')').css('backgroundSize','100% 100%');
//                    _this.parents('.imgbox').append($("<span class='delet'>×</span>"));
//                    // console.log(imgArr)
//                    if($('.imgbox').length>=num){
//                        return false;
//                    }
//                    _this.parents('.uploadlist').append($("<div class='imgbox'><label for='img"+index+"'><input type='file' name='pictrue[]' id='img"+index+"'></label></div>"));
//                }
//            }
//            else{
//                if($('.imgbox').length>=num){
//                    return false;
//                }
//                _this.parents('.imgbox').append($("<span class='delet'>×</span>"));
//                _this.parents('.uploadlist').append($("<div class='imgbox'><label for='img"+index+"'><input type='file' name='pictrue[]' id='img"+index+"'></label></div>"));
//            }
//        }
//    })
//
//    $('.uploadlist').on('click','.delet',function(event){
//        // $('.uploadlist').remove('.imgbox');
//        $(this).parents('.imgbox').remove();
//
//        var path=$(event.target).parent().find('input').val();
//
//        imgArr=$.grep(imgArr,function(item){
//            return  item != path;
//        });
//        if($('.imgbox').length<num && $('.imgbox').length<=imgArr.length){
//            $('.uploadlist').append($("<div class='imgbox'><label for='img"+index+"'><input type='file' name='picture[]' id='img"+index+"'></label></div>"));
//        }
//        // console.log(imgArr);
//    });
    var imgArr=[],index=1,num=3;
    $('.uploadlist').on('change','input',function(event){
        _this=$(this);

        var path=$(this).val();
        //判断是否是图片
        if( !path.match( /.jpg|.gif|.png|.bmp/i ) ){
            alert('图片格式无效！');
            return false;
        }
        //判断图片是否已经在队列中
        if(jQuery.inArray(path,imgArr)!=-1){
            alert("图片已经在队列中！");
        }else{
            imgArr.push(path);
            if(_this.val()==''){return false}
            if($('.imgbox').length<num){
                index++;
                _this.parents('.uploadlist').append($("<div class='imgbox'><span class='delet'>×</span><label for='img"+index+"'><input accept='image/jpeg, image/png ,image/gif' type='file'  name='pictrue[]' id='img"+index+"'></label></div>"));//插入新的节点
            }
            if(window.FileReader){
                var file=event.target.files[0];
                var FR=new FileReader();
                FR.readAsDataURL(file);
                FR.onload=function(event){
                    var src=this.result;
                    _this.parent().css('background','white url('+src+')').css('backgroundSize','100% 100%');
                    // _this.parents('.imgbox').append($("<span class='delet'>×</span>"));
                    _this.parents('.imgbox').find('.delet').css('visibility','visible');
                }
            }else{
                //IE9预览
                _this.parents('.imgbox').find('input').get(0).select();
                _this.parents('.imgbox').find('input').get(0).blur();
                var fileText = document.selection.createRange().text;
                document.selection.empty();
                _this.parents('.imgbox').css("filter","progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale',src='"+fileText+"')");
                _this.parents('.imgbox').find('.delet').css('visibility','visible');
            }
        }
    });
    $('.uploadlist').on('click','.delet',function(event){

        $(this).parents('.imgbox').remove();

        var path=$(event.target).parent().find('input').val();

        imgArr=$.grep(imgArr,function(item){
            return  item != path;
        });
        if($('.imgbox').length<num && $('.imgbox').length<=imgArr.length){
            $('.uploadlist').append($("<div class='imgbox'><span class='delet'>×</span><label for='img"+index+"'><input accept='image/jpeg, image/png ,image/gif' type='file'  name='pictrue[]' id='img"+index+"'></label></div>"));
        }
        // console.log(imgArr);
    });

</script>
</body>
</html>