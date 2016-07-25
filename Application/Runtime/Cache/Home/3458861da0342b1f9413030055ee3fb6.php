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
    <div class="title02"></div>
    <ul class="p-menu">
        <li>燃气热水器<img src="/Public/Home/img/p-tip.png"></li>
        <li>电热水器<img src="/Public/Home/img/p-tip.png"></li>
    </ul>
</div>
<div class="p-wrap">
    <div class="p-item" style="height:540px;">
        <img src="/Public/Home/img/chanpinbig.jpg">
        <div class="swiper-container" id="quanxin">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="/Public/Home/img/chnpins1.jpg">
                </div>
                <div class="swiper-slide">
                    <img src="/Public/Home/img/chnpins2.jpg">
                </div>
            </div>
        </div>
        <!-- 如果需要导航按钮 -->
        <div class="swiper-button-prev quanxinnext" id="quanxinnext"></div>
    </div>
    <div class="p-item"  style="display:block;margin-bottom:33px">
        <div class="swiper-container" id="ranqi">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <ul class="p-list-wrap">
                        <?php $products=getProductsByCate(10); ?>
                        <?php if(count($products) >= 8): $__FOR_START_24506__=0;$__FOR_END_24506__=8;for($i=$__FOR_START_24506__;$i < $__FOR_END_24506__;$i+=1){ ?><li>
                                    <img src="<?php echo ($products[$i]['picpath']); ?>" class="rsq">
                                    <div class="zibg">
                                        <a href="">
                                            <p style="margin-top:36px"><?php echo ($products[$i]['title']); ?></p>
                                            <p><?php echo ($products[$i]['parameter']); ?></p>
                                        </a>
                                    </div>
                                    <div class="huibg"></div>
                                </li><?php } ?>
                            <?php else: ?>
                            <?php $end=count($products); ?>
                            <?php $__FOR_START_7787__=0;$__FOR_END_7787__=$end;for($i=$__FOR_START_7787__;$i < $__FOR_END_7787__;$i+=1){ ?><li>
                                    <img src="<?php echo ($products[$i]['picpath']); ?>" class="rsq">
                                    <div class="zibg">
                                        <a href="">
                                            <p style="margin-top:36px"><?php echo ($products[$i]['title']); ?></p>
                                            <p><?php echo ($products[$i]['parameter']); ?></p>
                                        </a>
                                    </div>
                                    <div class="huibg"></div>
                                </li><?php } endif; ?>
                    </ul>
                </div>
                <?php if($products): if(count($products) > 8): ?><div class="swiper-slide">
                    <ul class="p-list-wrap">
                            <?php $end=count($products); ?>
                            <?php $__FOR_START_15816__=8;$__FOR_END_15816__=$end;for($i=$__FOR_START_15816__;$i < $__FOR_END_15816__;$i+=1){ ?><li>
                                    <img src="<?php echo ($products[$i]['picpath']); ?>" class="rsq">
                                    <div class="zibg">
                                        <a href="">
                                            <p style="margin-top:36px"><?php echo ($products[$i]['title']); ?></p>
                                            <p><?php echo ($products[$i]['parameter']); ?></p>
                                        </a>
                                    </div>
                                    <div class="huibg"></div>
                                </li><?php } ?>
                    </ul>
                </div><?php endif; endif; ?>
            </div>
        </div>
        <!-- 如果需要导航按钮 -->
        <div class="swiper-button-prev ranqinext" id="ranqinext"></div>
        <div class="swiper-button-next ranqiprev" id="ranqiprev"></div>
    </div>
    <div class="p-item">
        <div class="swiper-container" id="dian" >
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <?php $products=getProductsByCate(9); ?>
                    <ul class="p-list-wrap">
                        <?php if($products): if(count($products) >= 8): $__FOR_START_28257__=0;$__FOR_END_28257__=7;for($i=$__FOR_START_28257__;$i < $__FOR_END_28257__;$i+=1){ ?><li>
                                    <img src="<?php echo ($products[$i]['picpath']); ?>" class="rsq">
                                    <div class="zibg">
                                        <a href="">
                                            <p style="margin-top:36px"><?php echo ($products[$i]['title']); ?></p>
                                            <p><?php echo ($products[$i]['parameter']); ?></p>
                                        </a>
                                    </div>
                                    <div class="huibg"></div>
                                </li><?php } ?>
                            <?php else: ?>
                            <?php $end=count($products); ?>
                            <?php $__FOR_START_15750__=0;$__FOR_END_15750__=$end;for($i=$__FOR_START_15750__;$i < $__FOR_END_15750__;$i+=1){ ?><li>
                                    <img src="<?php echo ($products[$i]['picpath']); ?>" class="rsq">
                                    <div class="zibg">
                                        <a href="">
                                            <p style="margin-top:36px"><?php echo ($products[$i]['title']); ?></p>
                                            <p><?php echo ($products[$i]['parameter']); ?></p>
                                        </a>
                                    </div>
                                    <div class="huibg"></div>
                                </li><?php } endif; endif; ?>
                    </ul>
                </div>
                <?php if($products): if(count($products) > 8): ?><div class="swiper-slide">
                    <ul class="p-list-wrap">
                            <?php $end=count($products); ?>
                            <?php $__FOR_START_13895__=0;$__FOR_END_13895__=$end;for($i=$__FOR_START_13895__;$i < $__FOR_END_13895__;$i+=1){ ?><li>
                                    <img src="<?php echo ($products[$i]['picpath']); ?>" class="rsq">
                                    <div class="zibg">
                                        <a href="">
                                            <p style="margin-top:36px"><?php echo ($products[$i]['title']); ?></p>
                                            <p><?php echo ($products[$i]['parameter']); ?></p>
                                        </a>
                                    </div>
                                    <div class="huibg"></div>
                                </li><?php } ?>
                    </ul>
                </div><?php endif; endif; ?>
            </div>
        </div>
        <!-- 如果需要导航按钮 -->
        <div class="swiper-button-prev diannext" id="diannext"></div>
        <div class="swiper-button-next dianprev" id="dianprev"></div>
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
            <li class="active">
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
    $(function(){
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
        var quanxin = new Swiper ('#quanxin', {
            direction: 'horizontal',
            loop: true,
            autoplay : false,
            nextButton: '.quanxinnext'
            // paginationClickable :true
        });
    });

    $('.p-menu li').each(function(index){
        $(this).click(function(){
            $(this).addClass('on').siblings().removeClass('on');
            $('.p-item').eq(index+1).css('display','block').siblings().css('display','none');
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