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
<div class="m-wrap">
    <div class="title01"></div>
    <div class="yinyan">大赛引言</div>
    <div class="yinyan-content">
        <div class="yinyan-wz">
            <?php echo ($article["content"]); ?>
        </div>
        <div class="yinyan-pic">
            <div class="swiper-container" id="swiper2">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" style="background:url(/Public/Home/img/yinyanpic1.jpg) center center"></div>
                    <div class="swiper-slide" style="background:url(/Public/Home/img/yinyanpic1.jpg) center center"></div>
                    <div class="swiper-slide" style="background:url(/Public/Home/img/yinyanpic1.jpg) center center"></div>
                    <div class="swiper-slide" style="background:url(/Public/Home/img/yinyanpic1.jpg) center center"></div>
                </div>
            </div>
            <!-- 如果需要分页器 -->
            <div class="swiper-pagination" id="my-pagination2"></div>
        </div>
    </div>
</div>

<div class="footer-wrap" style="position:relative">
    <div style="background:#000;margin-top:20px;">
        <ul class="footer-menu">
            <li <?php if(CONTROLLER_NAME.'/'.ACTION_NAME == 'Index/instruction'): ?>class="active"<?php endif; ?>>
                <a href="<?php echo U('Index/instruction');?>">
                    <img src="/Public/Home/img/menu01.png" class="zh-cn">
                    <div class="cn">大赛简介</div>
                    <img src="/Public/Home/img/purple.png" class="purple">
                    <img src="/Public/Home/img/gray.png" class="gray">
                </a>
            </li>
            <li <?php if(CONTROLLER_NAME.'/'.ACTION_NAME == 'Product/index'): ?>class="active"<?php endif; ?>>
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
            <li>
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
<script type="text/javascript" src="/Public/Home/js/swiper.min.js"></script>
<script type="text/javascript">
    // $(".swiper-container").height($(window).height()-213);
    var mySwiper = new Swiper ('.swiper-container', {
        direction: 'vertical',
        loop: true,
        autoplay : 3000,
        pagination: '.swiper-pagination',
        // paginationClickable :true
    });

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
</script>

</body>
</html>