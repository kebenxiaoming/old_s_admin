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
    <div class="title03"></div>
    <ul class="p-menu">
        <li class="on">热门作品<img src="/Public/Home/img/p-tip.png"></li>
        <li>全部作品<img src="/Public/Home/img/p-tip.png"></li>
    </ul>
    <p style="line-height:60px;color:#541b86;margin:0">综合排序</p>
</div>
<div class="z-wrap">
    <div class="z-item" style="margin-bottom:30px;">
        <div class="swiper-container" id="hot">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <ul class="z-list-wrap">
                        <?php if($works): if(count($works) >= 4): for($i=0;$i<4;$i++){ ?>
                                    <?php if($i%2==0){ ?>
                                        <li class="heavy">
                                            <div class="index">
                                                <div style="background-image:url(/Public/Home/img/0.png)"></div>
                                                <div style="background-image:url(/Public/Home/img/<?php echo ($i+1); ?>.png)"></div>
                                                <strong>+</strong>
                                            </div>
                                            <p class="z-name"><?php echo ($works[$i]['title']); ?></p>
                                            <p class="z-worker"><?php echo ($works[$i]['company']); ?></p>
                                            <p class="z-by">By:</p>
                                            <p class="z-per"><span><?php echo ($works[$i]['real_name']); ?></span><span class="sjs">设计师</span></p>
                                            <img src="<?php echo getImg($works[$i]['pics']); ?>" class="zimg">
                                        </li>
                                        <?php }else{ ?>
                                        <div class="index">
                                            <div style="background-image:url(/Public/Home/img/0.png)"></div>
                                            <div style="background-image:url(/Public/Home/img/<?php echo ($i+1); ?>.png)"></div>
                                            <strong>+</strong>
                                        </div>
                                        <p class="z-name"><?php echo ($works[$i]['title']); ?></p>
                                        <p class="z-worker"><?php echo ($works[$i]['company']); ?></p>
                                        <p class="z-by">By:</p>
                                        <p class="z-per"><span><?php echo ($works[$i]['real_name']); ?></span><span class="sjs">设计师</span></p>
                                        <img src="<?php echo getImg($works[$i]['pics']); ?>" class="zimg">
                                   <?php } ?>
                                <?php } ?>
                                <?php else: ?>
                                <?php $end=count($works); ?>
                                <?php $__FOR_START_28276__=0;$__FOR_END_28276__=$end;for($i=$__FOR_START_28276__;$i < $__FOR_END_28276__;$i+=1){ if($i%2==0){ ?>
                                        <li class="heavy">
                                            <div class="index">
                                                <div style="background-image:url(/Public/Home/img/0.png)"></div>
                                                <div style="background-image:url(/Public/Home/img/<?php echo ($i+1); ?>.png)"></div>
                                                <strong>+</strong>
                                            </div>
                                            <p class="z-name"><?php echo ($works[$i]['title']); ?></p>
                                            <p class="z-worker"><?php echo ($works[$i]['company']); ?></p>
                                            <p class="z-by">By:</p>
                                            <p class="z-per"><span><?php echo ($works[$i]['real_name']); ?></span><span class="sjs">设计师</span></p>
                                            <img src="<?php echo getImg($works[$i]['pics']); ?>" class="zimg">
                                        </li>
                                    <?php }else{ ?>
                                        <li class="light">
                                            <div class="index">
                                                <div style="background-image:url(/Public/Home/img/0.png)"></div>
                                                <div style="background-image:url(/Public/Home/img/<?php echo ($i+1); ?>.png)"></div>
                                                <strong>+</strong>
                                            </div>
                                            <p class="z-name"><?php echo ($works[$i]['title']); ?></p>
                                            <p class="z-worker"><?php echo ($works[$i]['company']); ?></p>
                                            <p class="z-by">By:</p>
                                            <p class="z-per"><span><?php echo ($works[$i]['real_name']); ?></span><span class="sjs">设计师</span></p>
                                            <img src="<?php echo getImg($works[$i]['pics']); ?>" class="zimg">
                                        </li>
                                    <?php } } endif; endif; ?>
                    </ul>
                </div>
                <?php if(count($works) > 4): ?><div class="swiper-slide">
                    <ul class="z-list-wrap">
                    <?php for($i=4;$i<count($works);$i++){ ?>
                    <?php if($i%2==0){ ?>
                    <li class="heavy">
                        <div class="index">
                            <div style="background-image:url(/Public/Home/img/0.png)"></div>
                            <div style="background-image:url(/Public/Home/img/<?php echo ($i+1); ?>.png)"></div>
                            <strong>+</strong>
                        </div>
                        <p class="z-name"><?php echo ($works[$i]['title']); ?></p>
                        <p class="z-worker"><?php echo ($works[$i]['company']); ?></p>
                        <p class="z-by">By:</p>
                        <p class="z-per"><span><?php echo ($works[$i]['real_name']); ?></span><span class="sjs">设计师</span></p>
                        <img src="<?php echo getImg($works[$i]['pics']); ?>" class="zimg">
                    </li>
                    <?php }else{ ?>
                    <div class="index">
                        <div style="background-image:url(/Public/Home/img/0.png)"></div>
                        <div style="background-image:url(/Public/Home/img/<?php echo ($i+1); ?>.png)"></div>
                        <strong>+</strong>
                    </div>
                    <p class="z-name"><?php echo ($works[$i]['title']); ?></p>
                    <p class="z-worker"><?php echo ($works[$i]['company']); ?></p>
                    <p class="z-by">By:</p>
                    <p class="z-per"><span><?php echo ($works[$i]['real_name']); ?></span><span class="sjs">设计师</span></p>
                    <img src="<?php echo getImg($works[$i]['pics']); ?>" class="zimg">
                    <?php } ?>
                    <?php } ?>
                    </ul>
                </div><?php endif; ?>
            </div>
        </div>
        <!-- 如果需要导航按钮 -->
        <div class="swiper-button-prev hotnext" id="ranqinext"></div>
        <div class="swiper-button-next hotprev" id="ranqiprev"></div>
    </div>
    <div class="z-item">
        <div class="swiper-container" id="all" >
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <ul class="p-list-wrap">
                        <?php if($allworks): if(count($allworks) >= 8): $__FOR_START_3997__=0;$__FOR_END_3997__=8;for($i=$__FOR_START_3997__;$i < $__FOR_END_3997__;$i+=1){ ?><li>
                                    <img src="<?php echo getImg($allworks[$i]['pics']); ?>" class="z-all-img">
                                    <div class="z-topic">
                                        <p style="font-weight:bold;font-size:15px;"><?php echo ($allworks[$i]['title']); ?></p>
                                        <p style="font-size:12px;margin-top:2px;">设计师：<?php echo ($allworks[$i]['real_name']); ?></p>
                                    </div>
                                </li><?php } ?>
                                <?php else: ?>
                                <?php $end=count($works); ?>
                                <?php $__FOR_START_11282__=0;$__FOR_END_11282__=$end;for($i=$__FOR_START_11282__;$i < $__FOR_END_11282__;$i+=1){ ?><li>
                                        <img src="<?php echo getImg($allworks[$i]['pics']); ?>" class="z-all-img">
                                        <div class="z-topic">
                                            <p style="font-weight:bold;font-size:15px;"><?php echo ($allworks[$i]['title']); ?></p>
                                            <p style="font-size:12px;margin-top:2px;">设计师：<?php echo ($allworks[$i]['real_name']); ?></p>
                                        </div>
                                    </li><?php } endif; endif; ?>
                    </ul>
                </div>
                <?php if(count($allworks) > 8): ?><div class="swiper-slide">
                    <ul class="p-list-wrap">
                        <?php $end=count($works); ?>
                        <?php $__FOR_START_28643__=8;$__FOR_END_28643__=$end;for($i=$__FOR_START_28643__;$i < $__FOR_END_28643__;$i+=1){ ?><li>
                                <img src="<?php echo getImg($allworks[$i]['pics']); ?>" class="z-all-img">
                                <div class="z-topic">
                                    <p style="font-weight:bold;font-size:15px;"><?php echo ($allworks[$i]['title']); ?></p>
                                    <p style="font-size:12px;margin-top:2px;">设计师：<?php echo ($allworks[$i]['real_name']); ?></p>
                                </div>
                            </li><?php } ?>
                    </ul>
                </div><?php endif; ?>
            </div>
        </div>
        <!-- 如果需要导航按钮 -->
        <div class="swiper-button-prev allnext" id="diannext"></div>
        <div class="swiper-button-next allprev" id="dianprev"></div>
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
            <li  class="active">
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
    var hotSwiper = new Swiper ('#hot', {
        direction: 'horizontal',
        loop: true,
        autoplay : false,
        pagination: '.swiper-pagination',
        nextButton: '.hotprev',
        prevButton: '.hotnext'
    });
    var allSwiper=new Swiper ('#all', {
        direction: 'horizontal',
        loop: true,
        autoplay : false,
        pagination: '.swiper-pagination',
        nextButton: '.allprev',
        prevButton: '.allnext'
        // paginationClickable :true
    });
    $('.p-menu li').each(function(index){
        $(this).click(function(){
            $(this).addClass('on').siblings().removeClass('on');
            $('.z-item').eq(index).css('display','block').siblings().css('display','none');
        });
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
</script>

</body>
</html>