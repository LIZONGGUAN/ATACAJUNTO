<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/www/wwwroot/tb.youanfutang.cn/public/../application/index/view/index/cart.html";i:1714449388;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=0,user-scalable=no">
  <meta name="viewport" content="width=device-width,initial-scale=0.1">
   
	<title><?php echo $seotitle; ?> - carrinho de compras</title>
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
<body class="body-bg">
    <header>
        <div class="main display jc-between">
            <a class="logo" href="index">
                <img src="<?php echo $seo['weblogo']; ?>" alt="">
            </a>
            <div class="seach">
                <div>
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input type="text" placeholder="Introduz a procura de palavras chave">
                </div>
                <button class="selpro">pesquisa</button>
            </div>
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
                <a href="?p=product">TODOS PRODUTOS</a>
            </li>
            <li class="nav-li">
                <a href="?p=cart" class="nav-active">CARRINHO</a>
            </li>
            <li class="nav-li">
                <a href="?p=my">SOBR NÓS</a>
            </li>
        </ul>
    </header>
    <div class="page-img">
        <!--<img src="/static/page/image/product.jpg" alt="">-->
    </div>
    <div class="kong kong1"></div>
    <div class="main">
        <style type="text/css" media="all">
            .cart-li2 {
    width: 40%!important;
}
        </style>
        <ul class="cart-title display cart-bg">
            <li class="cart-li1">
                <label for="checkAll">
                    <input type="checkbox" id="checkAll" />Tudo
                </label>
            </li>
            <li class="cart-li2">NOME PROTURO</li>
            <li class="cart-li3">Preço un.</li>
            <li class="cart-li4">QUANTI.</li>
            <li class="cart-li5">TOTAL</li>
            <!--<li class="cart-li6">备注</li>-->
            <li class="cart-li7">Operar</li>
        </ul>
        <ul class="cart-content cart-bg">
			<?php if(is_array($pro) || $pro instanceof \think\Collection || $pro instanceof \think\Paginator): $n = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($n % 2 );++$n;?>
            <li class="cart-lis" data-choice="<?php echo $n; ?>">
                <div class="cart-dis display">
                    <div class="cart-li1 cart-div display">
                        <input type="checkbox">
                        <img src="<?php echo $m['1']; ?>" alt="">
                    </div>
                    <table>
						<?php if(is_array($m['2']) || $m['2'] instanceof \think\Collection || $m['2'] instanceof \think\Paginator): $i = 0; $__LIST__ = $m['2'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <tr class="cart-tr">
                            <td class="cart-li2 cart-name">
                               <p> <?php echo $m['0']; ?></p>
                                <span><?php echo $v['0']; ?></span>
                            </td>
                            <td class="cart-li3 cart-price">
                                R$<span><?php echo $v['1']; ?></span>
                            </td>
                            <td class="cart-li4">
                                <div class="cart-quantity">
                                    <button>-</button>
                                    <p><?php echo $v['2']; ?></p>
                                    <button>+</button>
                                </div>
                            </td>
                            <td class="cart-li5 cart-price">R$<span><?php echo $v['2']*$v['1']; ?></span></td>
                            <!--<td class="cart-li6 cart-textarea"><textarea></textarea></td>-->
                            <td class="cart-li7 cart-button"><i class="fa fa-times" aria-hidden="true"></i></td>
                        </tr>
						 
                         <?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                </div>
                <div class="total">
                    <p>Total：<span>R$<i>5.58</i></span></p>
                </div>
            </li>
			  <?php endforeach; endif; else: echo "" ;endif; ?>
      
		</ul>
        <div class="cart-bg" style="margin-top: 20px;">
            <div class="display total-footer">
                <p>Total：<i>R$</i> <span id="total">0</span></p>
                <button class="tjorder">Separar</button>
            </div>
        </div>
    </div>

    <div class="kong"></div>

    <!-- 提交订单 -->
    <div class="order">
        <div class="order-info">
            <ul class="order-ul1">
                <li class="order-li1 display">
                    <div>
                        <p>Nome do Cliente：</p><span><?php echo $member['0']['name']; ?></span>
                    </div>
                    <div>
                        <p>Número de ordem：</p><span><?php echo $out_trade_no; ?></span>
                    </div>
                    <div>
                        <p>Hora da encomenda：</p><span id="time">Dia/Mês/Ano</span>
                    </div>
                </li>
                <li class="order-li1 display">
                    <div>
                        <p>telefone：</p><span><?php echo $member['0']['phone']; ?></span>
                    </div>
                 <!--   <div>
                        <p>跟单员：</p><span>xxxxxxxxx</span>
                    </div> -->
                </li>
                <li class="order-li1 display">
                    <div>
                        <p>Endereço do cliente：</p><span><?php echo $member['0']['province']; ?>
                        </span>
                    </div>
                </li>
               <!-- <li class="order-li1 display">
                    <div>
                        <p>发货途径：</p><span>xxxxxxxxx</span>
                    </div>
                </li> -->
                <li class="order-li1 display">
                    <div>
                        <p>Observações：</p><textarea class="beizhu"></textarea>
                    </div>
                </li>
            </ul>
        </div>
        <div class="order-product">
            <div class="order-product-div">

            </div>
            <div class="order-button display">
                <div class="order-button-text">
                    total：R$<span class="priceall">0</span>
                </div>
                <button id="cancel">cancelar</button>
                <button id="determine">Confirmar a submissão</button>
            </div>
        </div>
    </div>
<script>


// 确认提交订单
$('#determine').click(function(){
    console.log(edigwcdata);
 
    $.ajax({
    	type:'POST', // 规定请求的类型（GET 或 POST）
    	url:'/index.php/index/requ/payorder', // 请求的url地址
    	cache:true,// 否在缓存中读取数据的读取
    	dataType:'json', //预期的服务器响应的数据类型 
    	data:{
    		buyarr:edigwcdata,
    		order:'<?php echo $out_trade_no; ?>',
			user_name:'<?php echo $member['0']['name']; ?>',
			user_id:'<?php echo $member['0']['Id']; ?>',
			price:$(".priceall").text(),
			beizhu:$(".beizhu").val(),
			sign:'Criar uma ordem'
			
			
			
    	},//规定要发送到服务器的数据
    	
    	success: function(res){ // 当请求成功时运行的函数
    		if(res.code==1){
    			 $.post('index.php/index/requ/clearcookiegwc');
    		 layer.msg('A ordem foi enviada! Aguarde por favor a confirmação do webmaster！'); 
    		 
    		 setTimeout(function(){
    		    
    			 window.location.reload();
    		 },1500)
    		}
    		
    		
    	}
    	
    })//ajax-end
})
</script>
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
          <!--      <ul class="display footer-ul footer-item2">
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
                    <p>HOME</p>
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
                    <p>CARRINHO</p>
                </a>
            </li>
            <li>
                <a href="?p=my">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <p>SOBR NÓS</p>
                </a>
            </li>
        </ul>
    </div>

<style>
    .layui-layer-page{
        height: 80%!important;
        overflow-y: auto;
    }
    
</style>
    <script src="/static/page/js/scr.js"></script>
</body>

</html>