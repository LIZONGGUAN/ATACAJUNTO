<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"/www/wwwroot/tb.youanfutang.cn/public/../application/index/view/index/product_list.html";i:1714448020;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  
  <title><?php echo $seotitle; ?> -<?php echo $detail['0']['news_tit']; ?></title>
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
  <script src="/static/JS/jquery.cookie.min.js"></script>
</head>
<style>
  @media screen and (max-width:640px) {
      body header{
          display: none;
      }
      body .page-img {
          display: none;
      }
  }
  header{
      display: block;
  }
  .page-img {
      display: block;
  }
  .wrapper-models{width: 200px;text-align: left;}
</style>
<body class="body-bg">
  <header>
    <div class="main display jc-between">
      <a class="logo" href="/">
        <img src="<?php echo $seo['weblogo']; ?>" alt="">
      </a>
      <div class="seach">
        <div>
          <i class="fa fa-search" aria-hidden="true"></i>
          <input type="text" placeholder="Introduz a procura de palavras chave">
        </div>
        <button class="selpro">pesquisa</button>
      </div>
      <div></div>
	  <script>
	  	$(".selpro").click(function(){
	  		window.location.href='/?p=product&sel='+$(".seach input").val();
	  	})
	  </script>
    </div>
    <ul class="nav-ul main display display-center">
            <li class="nav-li">
                <a href="/?p=index">HOME</a>
            </li>
            <li class="nav-li">
                <a href="/?p=product" class="nav-active">TODOS PRODUTOS</a>
            </li>
            <li class="nav-li">
                <a href="/?p=cart">CARRINHO</a>
            </li>
            <li class="nav-li">
                <a href="/?p=my">SOBR NÓS</a>
            </li>
        </ul>
  </header>
  <!--<div class="page-img">-->
  <!--  <img src="/static/page/image/product.jpg" alt="">-->
  <!--</div>-->

    <!-- 移动端返回上一级 -->
     <div class="ret">
        <a href="javascript:history.back(-1)"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
        <span>Detalhes do produto</span>
     </div>

  <div class="kong kong1"></div>
  <style>
      .p-mask{
          width: 100%;
          height: 100%;
          background: rgba(0,0,0,.5);
          position: fixed;
          top: 0;
          left: 0;
          z-index: 999999999999;
          display: none;
          justify-content: center;
          align-items: center;
      }
      .wrapper_sku_btn input{
        width: 50%;
        font-size: 16px;
        text-align: center;
        line-height: 28px;
        border: none;
      }
      input::-webkit-inner-spin-button {
        display: none!important;
          
      }
  </style>
  <div class="p-mask">
      <img src="" alt=""/>
  </div>
  <div class="main">
    <div class="proList display main-bg">
        <div class="proList-img">
            <div class="proList-imgBig">
              <img src="<?php echo $detail['0']['news_slt']; ?>" alt="">
            </div>
            <div class="proList-moreImg">
              <ul class="moreImg-ul">
				  <?php if(is_array($srcimg) || $srcimg instanceof \think\Collection || $srcimg instanceof \think\Paginator): $i = 0; $__LIST__ = $srcimg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
                <li><img src="<?php echo $m; ?>" alt=""></li>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
              </ul>
              <p class="moreImg-left"><img src="/static/page/image/moreImg-left.png" alt=""></p>
              <p class="moreImg-right"><img src="/static/page/image/moreImg-right.png" alt=""></p>
            </div>
        </div>
        <script>
            $(function(){
                //判断手机是移动端还是电脑端还是ipd端
                if (/AppleWebKit.*Mobile/i.test(navigator.userAgent) || /Android/i.test(navigator.userAgent) || /BlackBerry/i.test(
                navigator.userAgent) || /IEMobile/i.test(navigator.userAgent) || (
                /MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/
                .test(navigator.userAgent))) {
                    if (/iPad/i.test(navigator.userAgent)) {
                        console.log("ipad");
                    }else {
                         $(".p-mask img").css("width","80%");
                         $(".p-mask img").css("height","auto");
                    }
                    
                }else {
                    console.log("电脑");
                    $(".p-mask img").css("width","auto");
                    $(".p-mask img").css("height","80%");
                }
            });
                $(".proList-imgBig img").click(function(){
                   $(".p-mask img").attr("src",$(this).attr("src"));
                   $(".p-mask").css("display","flex");
                });
                 $(".p-mask").click(function(){
                    $(".p-mask").css("display","none");
                 });
                 $(".p-mask img").click(function(e){
                     e.stopPropagation();
                 });
        </script>
        <div class="proList-item">
            <div class="proList-information">
              <h4 data="<?php echo $detail['0']['Id']; ?>" img="<?php echo $detail['0']['news_slt']; ?>"><?php echo $detail['0']['news_tit']; ?></h4>
            </div>
            <div class="proInfo_price">
                <div class="prodPrice display">
                 <!-- <p>$9.50</p> -->
                  <span><?php echo $detail['0']['jiage']; ?></span>
                </div>
              <!--  <div class="prodPrice-active">
                  <span>R$ 4.55</span>
                </div> -->
            </div>
            <div class="proInfo_line"></div>
            <div class="proInfo_wrapper">
                <div class="wrapper_top display">
                    <div class="wrapper_module">COR</div>
                    <ul class="wrapper_list display">
						<?php if(is_array($yanse) || $yanse instanceof \think\Collection || $yanse instanceof \think\Paginator): $i = 0; $__LIST__ = $yanse;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;if($i == 1): ?> 
						
						<li class="prop_item prop_active">
						 <!-- <img src="/static/page/image/prop_item1.jpg" alt=""> -->
						    <p><?php echo $m; ?></p>
						    
						</li>
						<?php else: ?> 
						<li class="prop_item ">
						 <!-- <img src="/static/page/image/prop_item1.jpg" alt=""> -->
						    <p><?php echo $m; ?></p>
						</li>
						<?php endif; endforeach; endif; else: echo "" ;endif; ?>
                      
                    </ul>
                </div>
                <div class="wrapper_bottom display">
                  <div class="wrapper_module">MODELO</div>
                  <ul class="wrapper_count">
					  <?php if(is_array($xinghao) || $xinghao instanceof \think\Collection || $xinghao instanceof \think\Paginator): $i = 0; $__LIST__ = $xinghao;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
                    <li class="wrapper_sku display">
                      <div class="wrapper-models">
                        <h4><?php echo $m['0']; ?></h4>
                      </div>
                      <div class="wrapper-subtotals">
                        <h4>R$<span><?php echo $m['1']; ?></span></h4>
                      </div>
                      <div class="wrapper_sku_btn display">
                        <button><i class="fa fa-minus" aria-hidden="true"></i></button>
                        <!--<p>0</p>-->
                        <input type="number" value="0" min="0"  max="999"/>
                        <button><i class="fa fa-plus" aria-hidden="true"></i></button>
                      </div>
                    </li>
					  <?php endforeach; endif; else: echo "" ;endif; ?>
                   
                  </ul>
                </div>
            </div>
            <div class="proInfo_line"></div>
           <div class="probuy display">
              <div class="probuy-text display ">
                <p>TORAL<span id="probuy_piece">0</span>UN</p>
                <p>TOTAL PRODUTOS：R$<i id="probuy-i">0</i></p>
              </div>
              <button>Adicionar Carrinho</button>
            </div>
        </div>
        
    </div> 
    <div class="prod_details main-bg">
      <div class="details-milk">
          <div class="details-ukc">
            <h4>Especificação:</h4>
          </div>
          <ul class="details-ul">
			  <?php if(is_array($taocan) || $taocan instanceof \think\Collection || $taocan instanceof \think\Paginator): $i = 0; $__LIST__ = $taocan;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
              <li class="display">
                <h4><?php echo $m['0']; ?></h4>
                <p><?php echo $m['1']; ?></p>
              </li>
              <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
      </div>
      <div class="details-milk">
        <div class="details-ukc">
          <h4>Descrição do produto</h4>
        </div>
        <ul class="details-ul">
            <li class="details-li">
             <?php echo $detail['0']['news_editor']; ?>
            </li>
        </ul>
    </div>
    </div>
  </div>

<style>
	.footer-top{background-color:rgba(0,0,0,0);}
</style>
  <div class="kong"></div>
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
     <!--   <ul class="display footer-ul footer-item2">
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
  <script src="/static/page/js/scr.js"></script>
</body>

</html>