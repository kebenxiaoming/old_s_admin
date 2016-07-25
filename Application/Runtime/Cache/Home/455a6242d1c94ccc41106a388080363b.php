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
<div class="message-content">
    <div class="title04"></div>
    <div class="left">
        <img src="/Public/Home/img/messageimg.png">
        <div class="contact">联系经销商</div>
        <div class="tel">联系海尔</div>
    </div>
    <div class="right">
        <ul class="mes-menu">
            <li class="on">全部消息<img src="/Public/Home/img/p-tip.png"></li>
            <li>未读消息<img src="/Public/Home/img/p-tip.png"><div class='numtip'>10</div></li>
            <li>已读消息<img src="/Public/Home/img/p-tip.png"></li>
            <li>星标消息<img src="/Public/Home/img/p-tip.png"></li>
        </ul>
        <div class="list-wrap">
            <div class="mes-item tip">
                <p class="origin">来源：经销商</p>
                <p class="mes-item-1">您的订单有了新的物流消息</p>
                <p class="mes-item-2">2016-06-27 14:40:10</p>
                <p class="mes-item-3">您的快件已由友客敦化路店菜鸟驿站代收，免费保管5天。 取货物流详情页/物流详情页/码查询方式：物流详情页/短信/手物流详情页/短信/手机APP ... ...</p>
            </div>
            <div class="mes-item tip">
                <p class="origin">来源：经销商</p>
                <p class="mes-item-1">您的订单有了新的物流消息</p>
                <p class="mes-item-2">2016-06-27 14:40:10</p>
                <p class="mes-item-3">您的快件已由友客敦化路店菜鸟驿站代收，免费保管5天。 取货码查询方式：物流详情页/短信/手机APP ... ...</p>
            </div>
            <div class="mes-item">

            </div>
            <div class="mes-item">

            </div>
        </div>
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
            <li class="active">
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