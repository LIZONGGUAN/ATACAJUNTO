<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"/www/wwwroot/tb.youanfutang.cn/public/../application/index/view/index/product.html";i:1714447590;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=0,user-scalable=no">
    <meta name="viewport" content="width=device-width,initial-scale=0.1">
 
	
	<title><?php echo $seotitle; ?> -Catálogo de Produtos</title>
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
<style type="text/css">   				
   				.f_page{text-align: center;}
   				.product_list img{max-width: 162px;max-height: 122px;}
   				.pagination {
   				    display: inline-block;
   				    padding-left: 0;
   				    margin: 20px 0;
   				    border-radius: 4px;
   				}
   				.pagination>li {
   				    display: inline;
   				}
   				.disabled {
   				    cursor: default;
   				    background-color: #DCDCDC !important;
   				    color: black !important;
   				}
   				li {
   				    list-style: none;
   				}
   				.pagination>li:first-child>a, .pagination>li:first-child>span {
   				    margin-left: 0;
   				    border-top-left-radius: 4px;
   				    border-bottom-left-radius: 4px;
   				}
   				.pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>span:hover {
   				    color: #777;
   				    cursor: not-allowed;
   				    background-color: #fff;
   				    border-color: #ddd;
   				}
   				.pagination>li>a, .pagination>li>span {
   				    position: relative;
   				    float: left;
   				    padding: 6px 12px;
   				    margin-left: -1px;
   				    line-height: 1.42857143;
   				    color: #337ab7;
   				    text-decoration: none;
   				    background-color: #fff;
   				    border: 1px solid #ddd;
   				}
   				.pagination>li>a, .pagination>li>span {
   				    position: relative;
   				    float: left;
   				    padding: 6px 12px;
   				    margin-left: -1px;
   				    line-height: 1.42857143;
   				    color: #337ab7;
   				    text-decoration: none;
   				    background-color: #fff;
   				    border: 1px solid #ddd;
   				}
   				.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
   				    z-index: 3;
   				    color: #fff;
   				    cursor: default;
   				    background-color: #337ab7;
   				    border-color: #337ab7;
   				}
   				
   				.pagination>li>a, .pagination>li>span {
   				    position: relative;
   				    float: left;
   				    padding: 6px 12px;
   				    margin-left: -1px;
   				    line-height: 1.42857143;
   				    color: #337ab7;
   				    text-decoration: none;
   				    background-color: #fff;
   				    border: 1px solid #ddd;
   				}
   				.pagination>li>a, .pagination>li>span {
   				    position: relative;
   				    float: left;
   				    padding: 6px 12px;
   				    margin-left: -1px;
   				    line-height: 1.42857143;
   				    color: #337ab7;
   				    text-decoration: none;
   				    background-color: #fff;
   				    border: 1px solid #ddd;
   				}
   				.pagination>li>a, .pagination>li>span {
   				    position: relative;
   				    float: left;
   				    padding: 6px 12px;
   				    margin-left: -1px;
   				    line-height: 1.42857143;
   				    color: #337ab7;
   				    text-decoration: none;
   				    background-color: #fff;
   				    border: 1px solid #ddd;
   				}
   			</style>
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
  </style>
<body>
    <header>
        <div class="main display jc-between">
             <a class="logo" href="?p=index">
                 <img src="<?php echo $seo['weblogo']; ?>" alt="">
             </a>
             <div class="seach">
                 <div>
                     <i class="fa fa-search" aria-hidden="true"></i>
                     <input type="text" placeholder="Introduz a procura de palavras chave" value="<?php echo \think\Request::instance()->get('sel'); ?>">
                 </div>
                 <button class="selpro">pesquisa</button>
             </div>
             <div></div>
        </div>
		<script>
			$(".selpro").click(function(){
				window.location.href='?p=product&sel='+$(".seach input").val();
			})
		</script>
        <ul class="nav-ul main display display-center">
            <li class="nav-li">
                <a href="?p=index">HOME</a>
            </li>
            <li class="nav-li">
                <a href="?p=product" class="nav-active">TODOS PRODUTOS</a>
            </li>
            <li class="nav-li">
                <a href="?p=cart">CARRINHO</a>
            </li>
            <li class="nav-li">
                <a href="?p=my">SOBR NÓS</a>
            </li>
        </ul>
     </header>
     <div class="page-img">
        <!--<img src="/static/page/image/product.jpg" alt="">-->
     </div>
     <!-- 移动端返回上一级 -->
     <div class="ret">
        <a href="javascript:history.back(-1)"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
        <span>Classificação do produto</span>
     </div>


     <div class="kong kong1"></div>
     <div class="main">
        <div class="prodscreen">
        <!--    <dl class="ruleSet padding ruleSet-bg" id="ruleSet">
                <dt class="sortzmSet">已选条件：</dt>
                <dd class="select-no">暂时没有选择过滤条件</dd>
                
            </dl> -->
            <ul class="classSet padding">
				<li class="classSet-item">
				    <dl class="ruleSet classSet-dl display sjclass">
				        <dt class="sortzmSet">Reposição da classificação：</dt>
				     
				      <dd><a href="?p=product">Carregue em repor</a></dd>
				   
				    </dl>
				</li> 
                <li class="classSet-item">
                    <dl class="ruleSet classSet-dl display yjclass">
                        <dt class="sortzmSet">Classificação de primeiro nível：</dt>
						<?php if(is_array($yjclass) || $yjclass instanceof \think\Collection || $yjclass instanceof \think\Paginator): $i = 0; $__LIST__ = $yjclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
                       <dd><a href="?p=product&class=<?php echo $m['name']; ?>&ejclass=<?php echo \think\Request::instance()->get('ejclass'); ?>&sjclass=<?php echo \think\Request::instance()->get('sjclass'); ?>"><?php echo $m['name']; ?></a></dd>
					   <?php endforeach; endif; else: echo "" ;endif; ?>
                      
                    </dl>
                </li> <!-- 一级分类 -->
				<li class="classSet-item">
				    <dl class="ruleSet classSet-dl display ejclass">
				        <dt class="sortzmSet">Classificação secundária：</dt>
				       <?php if(is_array($ejclassdata) || $ejclassdata instanceof \think\Collection || $ejclassdata instanceof \think\Paginator): $i = 0; $__LIST__ = $ejclassdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
				       <dd><a href="?p=product&ejclass=<?php echo $m['name']; ?>&class=<?php echo \think\Request::instance()->get('class'); ?>&sjclass=<?php echo \think\Request::instance()->get('sjclass'); ?>"><?php echo $m['name']; ?></a></dd>
				       <?php endforeach; endif; else: echo "" ;endif; ?>
				    </dl>
				</li> <!-- 二级分类 -->
				<li class="classSet-item">
				    <dl class="ruleSet classSet-dl display sjclass">
				        <dt class="sortzmSet">Classificação de terceiro nível：</dt>
				      <?php if(is_array($sjclassdata) || $sjclassdata instanceof \think\Collection || $sjclassdata instanceof \think\Paginator): $i = 0; $__LIST__ = $sjclassdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
				      <dd><a href="?p=product&sjclass=<?php echo $m['name']; ?>&ejclass=<?php echo \think\Request::instance()->get('ejclass'); ?>&class=<?php echo \think\Request::instance()->get('class'); ?>"><?php echo $m['name']; ?></a></dd>
				      <?php endforeach; endif; else: echo "" ;endif; ?>
				    </dl>
				</li> <!-- 三级分类 -->
			
				
             
            </ul>
        </div>
     </div>
	 <script>
		 $(".yjclass>dd>a").each(function(){
		 			
		 			if($(this).text()=='<?php echo \think\Request::instance()->get('class'); ?>'){
		 				 $(this).parent().addClass('dd-avt').siblings().removeClass('dd-avt');
		 			}
		 		})
		
		$(".ejclass>dd>a").each(function(){
				
					if($(this).text()=='<?php echo \think\Request::instance()->get('ejclass'); ?>'){
						 $(this).parent().addClass('dd-avt').siblings().removeClass('dd-avt');
					}
				})
						
						$(".sjclass>dd>a").each(function(){
									
									if($(this).text()=='<?php echo \think\Request::instance()->get('sjclass'); ?>'){
										 $(this).parent().addClass('dd-avt').siblings().removeClass('dd-avt');
									}
								})
	 </script>
     <div class="kong"></div>
     <div class="main">
        <ul class="prod_Ulist">
			
			<?php if(is_array($product) || $product instanceof \think\Collection || $product instanceof \think\Paginator): $i = 0; $__LIST__ = $product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
            <li class="prod_Item">
                <a href="/login.php/newsad/newslist_detail?trid=<?php echo $m['Id']; ?>" target="_blank">
                    <div class="prod-img">
                        <img src="<?php echo $m['news_slt']; ?>" alt="">
                    </div>
                    <div class="prod-info">
                        <div class="prod-price">
                            
                            <span><?php echo $m['jiage']; ?></span>
                        </div>
                        <h4><?php echo $m['newsclass']; ?></h4>
                        <p><?php echo $m['news_tit']; ?></p>
                     <!--   <div class="prod-button">
                            立即抢购
                        </div> -->
                    </div>
                </a>
            </li>
			<?php endforeach; endif; else: echo "" ;endif; ?>
           
        </ul>
   
         
         <div class="f_page page-btn">
             <?php echo $product->render();; ?>
         </div>
      
		<script>
			$(".pagination li a").each(function(){
				
				pagsrc=$(this).attr("href");
				pag=pagsrc+"&p=product&class=<?php echo \think\Request::instance()->get('class'); ?>&ejclass=<?php echo \think\Request::instance()->get('ejclass'); ?>&sjclass=<?php echo \think\Request::instance()->get('sjclass'); ?>&sel=<?php echo \think\Request::instance()->get('sel'); ?>";
				$(this).attr("href",pag)
			})	
		</script>
     </div>
     <div class="kong"></div>
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
         <!--       <ul class="display footer-ul footer-item2">
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