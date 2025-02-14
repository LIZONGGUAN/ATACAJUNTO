<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:86:"/www/wwwroot/tb.youanfutang.cn/public/../application/admin/view/admin/page/edigwc.html";i:1715743488;s:65:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/layout.html";i:1658590062;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/header.html";i:1658677912;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/footer.html";i:1658590072;}*/ ?>

<!DOCTYPE html>  
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="" http-equiv="refresh" content=""/>
		<title><?php echo $webname; ?>-管理后台</title>
	
	  <!-- mini后台 -->
	  <meta name="renderer" content="webkit">
	     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	     <meta http-equiv="Access-Control-Allow-Origin" content="*">
<!-- 	     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
	     <meta name="apple-mobile-web-app-status-bar-style" content="black">
	     <meta name="apple-mobile-web-app-capable" content="yes">
	     <meta name="format-detection" content="telephone=no">
		 
	  <link rel="stylesheet" href="/static/layui/css/layui.css">
	     <link rel="stylesheet" href="/static/layui/admin/layuimini/css/layuimini.css?v=2.0.4.2" media="all">
	     <link rel="stylesheet" href="/static/layui/admin/layuimini/css/themes/default.css" media="all">
	     <link rel="stylesheet" href="/static/layui/admin/layuimini/lib/font-awesome-4.7.0/css/font-awesome.min.css" media="all">
	       <link rel="stylesheet" href="/static/layui/admin/layuimini/css/public.css" media="all">
	  
	  	<!-- mini后台 -->
		
    <script src="/static/JS/jquery.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.config.js"></script>
	<!-- <script type="text/javascript" charset="utf-8" src="../static/ueditor/ueditor.all.min.js"> </script> -->
	<script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.all.js"> </script>
	<script type="text/javascript" charset="utf-8" src="/static/ueditor/lang/zh-cn/zh-cn.js"></script>

	<script src="/static/JS/jquery.cookie.min.js"></script>

	<script type="text/javascript" src="/static/JS/jquery.qrcode.min.js"></script>  <!-- JQ二维码生成 -->
 <script src="/static/layui/layui.all.js"></script>
	
	</head>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


	
    <link rel="stylesheet" href="/static/page/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/static/page/css/style.css">
    <link rel="stylesheet" href="/static/page/font/css/font-awesome.min.css">
    <link rel="stylesheet" href="/static/page/layui/css/layui.css">
    <link rel="stylesheet" href="/static/page/css/media.css">
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
 

    <div class="kong kong1"></div>
    <div class="main">
        <ul class="cart-title display cart-bg">
            <li class="cart-li1">
                <label for="checkAll">
                    <input type="checkbox" id="checkAll" /><?php echo $languageObj['全选']['name_' . $language]; ?>
                </label>
            </li>
            <li class="cart-li2"><?php echo $languageObj['商品名称']['name_' . $language]; ?></li>
            <li class="cart-li3"><?php echo $languageObj['单价']['name_' . $language]; ?></li>
            <li class="cart-li4"><?php echo $languageObj['数量']['name_' . $language]; ?></li>
            <li class="cart-li5"><?php echo $languageObj['小计']['name_' . $language]; ?></li>
            <li class="cart-li6"><?php echo $languageObj['备注']['name_' . $language]; ?></li>
            <li class="cart-li7"><?php echo $languageObj['操作']['name_' . $language]; ?></li>
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
                            <td class="cart-li6 cart-textarea"><textarea></textarea></td>
                            <td class="cart-li7 cart-button"><i class="fa fa-times" aria-hidden="true"></i></td>
                        </tr>
						 
                         <?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                </div>
                <div class="total">
                    <p><?php echo $languageObj['共计']['name_' . $language]; ?>：<span>R$<i>5.58</i></span></p>
                </div>
            </li>
			  <?php endforeach; endif; else: echo "" ;endif; ?>
      
		</ul>
        <div class="cart-bg" style="margin-top: 20px;">
            <div class="display total-footer">
                <p><?php echo $languageObj['合计']['name_' . $language]; ?>：<i>R$</i> <span id="total">0</span></p>
                <button><?php echo $languageObj['提交订单']['name_' . $language]; ?></button>
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
                        <p><?php echo $languageObj['客户名称']['name_' . $language]; ?>：</p><span><?php echo $memberda['0']['name']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $languageObj['订单号码']['name_' . $language]; ?>：</p><span><?php echo $memberda['0']['trade']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $languageObj['下单时间']['name_' . $language]; ?>：</p><span id="time"><?php echo $memberda['0']['trdate']; ?></span>
                    </div>
                </li>
                <li class="order-li1 display">
                    <div>
                        <p><?php echo $languageObj['电话']['name_' . $language]; ?>：</p><span><?php echo $memberda['0']['phone']; ?></span>
                    </div>
                 <!--   <div>
                        <p>跟单员：</p><span>xxxxxxxxx</span>
                    </div> -->
                </li>
                <li class="order-li1 display">
                    <div>
                        <!--<p>客户地址：</p>-->
                        <span><?php echo $memberda['0']['shouhuo']; ?>
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
                        <p><?php echo $languageObj['备注']['name_' . $language]; ?>：</p><textarea class="beizhu"><?php echo $memberda['0']['beizhu']; ?></textarea>
                    </div>
                </li>
            </ul>
        </div>
        <div class="order-product">
            <div class="order-product-div">

            </div>
            <div class="order-button display">
                <div class="order-button-text">
                    <?php echo $languageObj['总计']['name_' . $language]; ?>：R$<span class="priceall">0</span>
                </div>
                <button id="cancel"><?php echo $languageObj['取消']['name_' . $language]; ?></button>
                <button id="determine"><?php echo $languageObj['确认提交']['name_' . $language]; ?></button>
            </div>
        </div>
    </div>
<script>
// 确认提交订单
$('#determine').click(function(){
//     console.log(edigwcdata);
//   return false;
    $.ajax({
    	type:'POST', // 规定请求的类型（GET 或 POST）
    	url:'/index.php/index/requ/payorder', // 请求的url地址
    	cache:true,// 否在缓存中读取数据的读取
    	dataType:'json', //预期的服务器响应的数据类型 
    	data:{
    	    orderid:'<?php echo $orderid; ?>',
    		buyarr:edigwcdata,
    		order:'<?php echo $out_trade_no; ?>',
			user_name:'<?php echo $member['0']['name']; ?>',
			user_id:'<?php echo $member['0']['Id']; ?>',
			price:$(".priceall").text(),
			beizhu:$(".beizhu").val(),
			sign:`<?php echo $languageObj['修改订单']['name_' . $language]; ?>`
			
    	},//规定要发送到服务器的数据
    	
    	success: function(res){ // 当请求成功时运行的函数
    		if(res.code==1){
    			
    		 layer.msg(`<?php echo $languageObj['订单已修改！请等待客户确认！']['name_' . $language]; ?>`); 
    		 setTimeout(function(){
    			 window.location.href='/login.php/admin/loadright?page=order';
    		 },1500)
    		}
    		
    		
    	}
    	
    })//ajax-end
})
</script>

 

<style>
    .layui-layer-page{
        height: 80%!important;
        overflow-y: auto;
    }
    
</style>
    <script src="/static/page/js/scr1.js"></script>
</body>

</html>


</body>
</html>

<div class="wxfxanli-con" style="display: none;text-align: center;">
	             <b style="font-size: 22px;margin: 10px 0px;display: block;">案例1</b>
				 
				<img width="90%" style="display: block;margin: auto;" src="/static/img/admin/wxfx.png" >
				   <b style="font-size: 22px;margin: 10px 0px;display: block;">案例2</b>
				<img width="90%" style="display: block;margin: auto;" src="/static/img/admin/pyqfx.png" >
</div>
		