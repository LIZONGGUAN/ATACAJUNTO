<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/www/wwwroot/tb.youanfutang.cn/public/../application/index/view/index/index.html";i:1714447336;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=0,user-scalable=no">
  <meta name="viewport" content="width=device-width,initial-scale=0.1">
    <title><?php echo $seotitle; ?> - Página inicial</title>
	<meta name="Keywords" content="<?php echo $seoseokey; ?>"/>
	<meta name="description" content="<?php echo $seoseodsc; ?>">
	<?php echo $seoseoheader; ?>
	
	
    <link rel="stylesheet" href="/static/page/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/static/page/css/style.css">
    <link rel="stylesheet" href="/static/page/font/css/font-awesome.min.css">
    <link rel="stylesheet" href="/static/page/layui/css/layui.css">
    <!--<link rel="stylesheet" href="/static/page/css/media.css">-->
    <script src="/static/page/js/jquery-1.10.2.min.js"></script>
    <script src="/static/page/js/swiper-bundle.min.js"></script>
    <script src="/static/page/layui/layui.js"></script>
</head>
<style type="text/css" media="all">
    .content-list1{    flex-wrap: wrap;}
    .content1-item{    width: 22.5%;margin-right: 2.5%;margin-top:15px}
	.main-middle {
	    width: 600px;
	    height: 100%;
	    margin-left: 16px;
	}
	.main-left {
	    width: 280px;
	    height: 100%;
	}
</style>
<body class='body-bg'>
    <header>
        <div class="main display jc-between">
            <a class="logo" href="/">
                <img src="<?php echo $seo['weblogo']; ?>" alt="">
            </a>
            <div class="seach seach-pc">
                <div>
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input type="text" id="pageSearch" placeholder="Introduz a procura de palavras chave">
                </div>
                <button class="selpro">pesquisa</button>
            </div>
			<script>
				$(".selpro").click(function(){
					window.location.href='?p=product&sel='+$(".seach input").val();
				})
				 $("#pageSearch").keydown(function (event) {
                    if (event.keyCode == 13) {
                        window.location.href='?p=product&sel='+$(".seach input").val();
                    }
                })

			</script>
            <div class="complaint">
                <a href="?p=complaint">Reclamação / Sugestão</a>
            </div>
        </div>
    </header>

    <div class="box main box-margin display">
        <div class="main-left">
            <ul class="main-menu">
                <div class="cate-title-wrap">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                    <p>Categoria de mercado</p>
                </div>
				<?php if(is_array($flarr) || $flarr instanceof \think\Collection || $flarr instanceof \think\Paginator): $i = 0; $__LIST__ = $flarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
                <li class="menu-item">
                    <div class="icon-wrap">
                        <img class="" src="<?php echo $m['ico']; ?>" alt="">
                     <!--   <img class="c-icon-active" src="/static/page/image/icon1-warp2.png" alt=""> -->
                    </div>
                    <a class="menu-item-a" href="?p=product&class=<?php echo $m['name']; ?>"><?php echo $m['name']; ?></a>
               
                    <!-- 二级分类 -->
                    <div class="category">
                        <ul class="category-ul">
							<?php if(is_array($m['two']) || $m['two'] instanceof \think\Collection || $m['two'] instanceof \think\Paginator): $i = 0; $__LIST__ = $m['two'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?>
                            <li class="category-li">
                                <h4><a href="?p=product&ejclass=<?php echo $t['name']; ?>"><?php echo $t['name']; ?></a></h4>
								
							
                                <div class="category-list">
                                  <!--  <h2>女装超级新品</h2> -->
                                    <p class="leaf-line">
										<?php if(is_array($t['three']) || $t['three'] instanceof \think\Collection || $t['three'] instanceof \think\Paginator): $i = 0; $__LIST__ = $t['three'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$h): $mod = ($i % 2 );++$i;?>
                                        <a href="?p=product&sjclass=<?php echo $h['name']; ?>"><?php echo $h['name']; ?></a>
										<?php endforeach; endif; else: echo "" ;endif; ?>
                                     
                                    </p>
                                </div>
								
                               
                            </li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
                        
						
                        </ul>
                    </div>
                </li>
				  <?php endforeach; endif; else: echo "" ;endif; ?>
			
          
			</ul>
        </div>
        <div class="main-middle">
            <div class="page">
                <div class="swiper-container" id="swiper1">
                    <div class="swiper-wrapper">
						<?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
                        <div class="swiper-slide">
                            <a href="<?php echo $m['url']; ?>">
                                <img src="<?php echo $m['imgurl']; ?>" alt="">
                            </a>
                        </div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
                       
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <div class="shortcut-list">
                <a class="shortcut-item" href="/?p=orderlist">
                    <span><?php echo $orderkhtj; ?></span>
                    <span>PEDIDO ENVIADO AO LOJA</span>
                </a>
                <a class="shortcut-item" href="/?p=orderlist">
                    <span><?php echo $orderwuliu; ?></span>
                    <span>PEDIDO SEPARANDO</span>
                </a>
                <a class="shortcut-item" href="/?p=orderlist">
                    <span><?php echo $orderkhsh; ?></span>
                    <span>SUA COMFIRMAÇÃO</span>
                </a>
                <a class="shortcut-item" href="/?p=orderlist">
                    <span><?php echo $ordersjqr; ?></span>
                    <span>COMFIRMAÇÃO DA LOJA</span>
                </a>
                <a class="shortcut-item" href="/?p=orderlist">
                    <span><?php echo $orderqrsh; ?></span>
                    <span>PEDIDO COMPLETOS</span>
                </a>
            </div>
        </div>
        <div class="main-right">
            <div class="user-base-info">
                <div class="user_one">
                    <span class="unlogin-icon">
                        <img src="<?php echo $member['0']['img']; ?>" alt="">
                    </span>
                    <p><?php echo $member['0']['name']; ?></p>
					
                </div>
                <div class="login-btn-group">
                    <button class="login-btn-active" style="width: 80%;text-align:left">&nbsp;&nbsp;&nbsp;Conta:<?php echo $member['0']['user']; ?></button>
                   <!-- <button>免费注册</button> -->
                </div>
            </div>
            <div class="info-shopping">
                <div class="info-shopping-name">
                    <h4>carrinho de compras</h4>
                    <a href="/?p=cart">Ver mais&nbsp;></a>
                </div>
                <ul class="info-shopping-ul">
                    <li>
                        <a href="cart">
                            <p>iPod Touch</p>
                            <span>$200</span>
                            <img src="/static/page/image/shopping1.png" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="cart">
                            <p>iPod Touch</p>
                            <span>$200</span>
                            <img src="/static/page/image/shopping1.png" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="cart">
                            <p>iPod Touch</p>
                            <span>$200</span>
                            <img src="/static/page/image/shopping1.png" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="cart">
                            <p>iPod Touch</p>
                            <span>$200</span>
                            <img src="/static/page/image/shopping1.png" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="cart">
                            <p>iPod Touch</p>
                            <span>$200</span>
                            <img src="/static/page/image/shopping1.png" alt="">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="notice">
                <div class="notice-text">
                    <i class="fa fa-volume-down" aria-hidden="true"></i>
                    <span>circular</span>
                </div>
                <div class="swiper-container" id="swiper2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <p>Se você encontrar algum problema, tente atualizar a página primeiro；</p>
                        </div>
                        <div class="swiper-slide">
                            <p>Se não for resolvido, entre em contato com o atendimento ao cliente！</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="margin main main-bg">
        <div class="content-list1 brand display">
			<?php if(is_array($zdpro) || $zdpro instanceof \think\Collection || $zdpro instanceof \think\Paginator): $i = 0; $__LIST__ = $zdpro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
            <a href="/login.php/newsad/newslist_detail?trid=<?php echo $m['Id']; ?>" target="_blank">
                <img src="<?php echo $m['news_slt']; ?>" alt="">
                <p><?php echo $m['news_tit']; ?></p>
            </a>
			<?php endforeach; endif; else: echo "" ;endif; ?>
			
          
        </div>
    </div>
  <!--  <div class="margin main main-bg">
        <div class="content-list1 brand display">
            <a href="?p=product">
                <img src="/static/page/image/prop_item1.jpg" alt="">
                <p>苹果手机贴膜</p>
            </a>
            <a href="?p=product">
                <img src="/static/page/image/prop_item1.jpg" alt="">
                <p>苹果手机贴膜</p>
            </a>
            <a href="?p=product">
                <img src="/static/page/image/prop_item1.jpg" alt="">
                <p>苹果手机贴膜</p>
            </a>
            <a href="?p=product">
                <img src="/static/page/image/prop_item1.jpg" alt="">
                <p>苹果手机贴膜</p>
            </a>
            <a href="?p=product">
                <img src="/static/page/image/prop_item1.jpg" alt="">
                <p>苹果手机贴膜</p>
            </a>
        </div>
    </div> -->
    <div class="main">
        <div class="name1">
            <h1>Lista Quente</h1>
            <div>
                <span></span>
                <p>EXPLOSION LIST</p>
                <span></span>
            </div>
        </div>
		<style>
			#pro-tit{ width: 100%;

        overflow: hidden;

        text-overflow: ellipsis;

        display: -webkit-box;

        -webkit-line-clamp: 2; //显示行数

        -webkit-box-orient: vertical;height:60px;}
		</style>
        <div class="margin main-bg">
            <div class="content-list1">
				<?php if(is_array($bkpro) || $bkpro instanceof \think\Collection || $bkpro instanceof \think\Paginator): $i = 0; $__LIST__ = $bkpro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
                <a href="/login.php/newsad/newslist_detail?trid=<?php echo $m['Id']; ?>" target="_blank" class="content1-item content2-bg">
                    <div class="tg-img">
                        <img src="<?php echo $m['news_slt']; ?>" alt="">
                    </div>
                    <div class="tg_info">
                        <h4 id="pro-tit"><?php echo $m['news_tit']; ?></h4>
                        <p>preço：<span>￥<?php echo $m['jiage']; ?></span></p>
                    </div>
                   <!-- <div class="secDate secDate-bg">
                        点击抢购
                    </div> -->
                </a>
				   <?php endforeach; endif; else: echo "" ;endif; ?>
           
            </div>
        </div>
  <!--      <div class="picSet">
            <img src="/static/page/image/bg-img1.jpg" alt="">
        </div> -->
      <!--  <div class="name1">
            <h1>每周爆款</h1>
            <div>
                <span></span>
                <p>A WEEKLY BURST</p>
                <span></span>
            </div>
        </div> -->
    <!--    <div class="view_contents display main-bg margin">
            <div class="includeView">
                <a href="?p=product_list">
                    <img class="includeViewImg" src="/static/page/image/includeView-img1.jpg" alt="">
                    <div class="includeView-text display">
                        <div class="includeText-left">
                            <h4>全新飞行堡垒电脑</h4>
                            <p>最高热效率106%</p>
                            <p>超静音</p>
                            <h5>满1000减300</h5>
                        </div>
                        <div class="includeText-right">
                            <img src="/static/page/image/includeView-img2.png" alt="">
                        </div>
                    </div>
                </a>
            </div>
            <div class="includeView">
                <a href="?p=product_list">
                    <div class="includeView-text display">
                        <div class="includeText-right includeText-img2">
                            <img src="/static/page/image/includeView-img3.png" alt="">
                        </div>
                        <div class="includeText-text2">
                            <h4>安心-三联电脑</h4>
                            <p>比平台电脑节约20%以上</p>
                            <h5>满1000减300</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="margin main-bg">
            <div class="content-list1">
                <a href="?p=product_list" class="content1-item content2-item content2-bg">
                    <div class="tg-img">
                        <img src="/static/page/image/content1-item1.png" alt="">
                    </div>
                    <div class="tg_info tg-line">
                        <h4>灵耀U-代</h4>
                        <div>高清晰屏幕，给人一种超级视觉的美感</div>
                        <p>原价：<span>￥5888</span></p>
                    </div>
                </a>
                <a href="?p=product_list" class="content1-item content2-item  content2-bg">
                    <div class="tg-img">
                        <img src="/static/page/image/content1-item2.png" alt="">
                    </div>
                    <div class="tg_info tg-line">
                        <h4>灵耀U-代</h4>
                        <div>具有不一样的体验，超薄超舒适</div>
                        <p>原价：<span>￥5888</span></p>
                    </div>
                </a>
                <a href="?p=product_list" class="content1-item content2-item  content2-bg">
                    <div class="tg-img">
                        <img src="/static/page/image/content1-item3.png" alt="">
                    </div>
                    <div class="tg_info tg-line">
                        <h4>灵耀U-代</h4>
                        <div>能最好的融入到学生想要的</div>
                        <p>原价：<span>￥5888</span></p>
                    </div>
                </a>
            </div>
        </div>
       -->
		<!-- <div class="picSet">
            <img src="/static/page/image/bg-img2.png" alt="">
        </div> -->
        <div class="name1">
            <h1>Acho que gostas.</h1>
            <div>
                <span></span>
                <p>SUPPOSE YOU LIKE</p>
                <span></span>
            </div>
        </div>
        <div class="margin main-bg">
            <div class="content-list1">
				<?php if(is_array($sjlike) || $sjlike instanceof \think\Collection || $sjlike instanceof \think\Paginator): $i = 0; $__LIST__ = $sjlike;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
                <a href="/login.php/newsad/newslist_detail?trid=<?php echo $m['Id']; ?>" target="_blank" class="content1-item content2-bg">
                    <div class="tg-img">
                        <img src="<?php echo $m['news_slt']; ?>" alt="">
                    </div>
                    <div class="tg_info tg-line">
                        <h4><?php echo $m['newsclass']; ?></h4>
                        <div><?php echo $m['news_tit']; ?></div>
                        <p>preço：<span><?php echo $m['jiage']; ?></span></p>
                    </div>
                </a>
				   <?php endforeach; endif; else: echo "" ;endif; ?>
            
            </div>
        </div>
    </div>
<style>
	.footer-top{background-color:rgba(0,0,0,0);}
</style>
    <footer>
        <div class="footer-top">
            <div class="main">
                <ul class="footer-ul footerUl-bg display">
                    <li class="display">
                        <img src="/static/page/image/hao.png" alt="">
                        <h4>Garantia de qualidade e serviço atencioso</h4>
                    </li>
                    <li class="display">
                        <img src="/static/page/image/gou.png" alt="">
                        <h4>Variedade rica e compras convenientes</h4>
                    </li>
                    <li class="display">
                        <img src="/static/page/image/song.png" alt="">
                        <h4>Materiais rápidos e entrega ultra rápida</h4>
                    </li>
                    <li class="display">
                        <img src="/static/page/image/phone.png" alt="">
                        <h4>Serviço pós-venda atencioso, respostas profissionais</h4>
                    </li>
                </ul>
              <!--  <ul class="display footer-ul footer-item2">
                   
					<li>
                        <p>购物指南</p>
                        <a href="">购物流程</a>
                        <a href="">会员介绍</a>
                        <a href="">订购流程</a>
                        <a href="">订购流程</a>
                    </li>
                    <li>
                        <p>购物指南</p>
                        <a href="">购物流程</a>
                        <a href="">会员介绍</a>
                        <a href="">订购流程</a>
                        <a href="">订购流程</a>
                    </li>
                    <li>
                        <p>购物指南</p>
                        <a href="">购物流程</a>
                        <a href="">会员介绍</a>
                        <a href="">订购流程</a>
                        <a href="">订购流程</a>
                    </li>
                    <li>
                        <p>购物指南</p>
                        <a href="">购物流程</a>
                        <a href="">会员介绍</a>
                        <a href="">订购流程</a>
                        <a href="">订购流程</a>
                    </li>
                </ul>
            -->
			</div>
        </div>
        <div class="footer-bottom">
            <div class="main">
                <a href="">
                    Copyright @ 2018-2022 Company name All rights reserved.
                </a>
            </div>
        </div>
    </footer>

    <!-- 移动端底部导航 -->
    <div class="media-footer">
        <ul class="display">
            <li>
                <a href="?p=index" style="color: #ff5212;">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <p>Página inicial</p>
                </a>
            </li>
            <li>
                <a href="?p=classification">
                    <i class="fa fa-th-large" aria-hidden="true"></i>
                    <p>classificação</p>
                </a>
            </li>
            <li>
                <a href="?p=cart">
                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                    <p>carrinho de compras</p>
                </a>
            </li>
            <li>
                <a href="?p=my">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <p>O meu</p>
                </a>
            </li>
        </ul>
    </div>


<script>
	var swiper1 = new Swiper('#swiper1 ', {
	    prevButton: '.swiper-button-prev',
	    nextButton: '.swiper-button-next',
	    pagination: '.swiper-pagination',
	    paginationClickable: true,
	    autoplay: 3000, //可选选项，自动滑动
	    loop: true,
	})
	var swiper2 = new Swiper("#swiper2", {
	    direction: 'vertical',
	    autoplay: 2500,
	    loop: true,
	})
</script>

<script src="/static/page/js/scr.js"></script>
 