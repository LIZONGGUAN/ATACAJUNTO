<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:89:"/www/wwwroot/tb.youanfutang.cn/public/../application/admin/view/admin/page/userorder.html";i:1715743707;s:65:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/layout.html";i:1658590062;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/header.html";i:1658677912;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/footer.html";i:1658590072;}*/ ?>

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
       <div class="order-info">
            <ul class="order-ul1">
                <li class="order-li1 display">
                    <div>
                        <p><?php echo $languageObj['客户名称']['name_' . $language]; ?>：</p><span><?php echo $orderdata['0']['name']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $languageObj['订单号码']['name_' . $language]; ?>：</p><span><?php echo $orderdata['0']['trade']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $languageObj['下单时间']['name_' . $language]; ?>：</p><span id="time"><?php echo $orderdata['0']['trdate']; ?></span>
                    </div>
                </li>
                <li class="order-li1 display">
                    <div>
                        <p><?php echo $languageObj['电话']['name_' . $language]; ?>：</p><span><?php echo $orderdata['0']['phone']; ?></span>
                    </div>
                 <!--   <div>
                        <p>跟单员：</p><span>xxxxxxxxx</span>
                    </div> -->
                </li>
                <li class="order-li1 display">
                    <div>
                        <!--<p>客户地址：</p>-->
                        <span><?php echo $orderdata['0']['shouhuo']; ?></span>
                    </div>
                </li>
               <!-- <li class="order-li1 display">
                    <div>
                        <p>发货途径：</p><span>xxxxxxxxx</span>
                    </div>
                </li> -->
                <li class="order-li1 display">
                    <div>
                        <p><?php echo $languageObj['备注']['name_' . $language]; ?>：</p><textarea class="beizhu"><?php echo $orderdata['0']['beizhu']; ?></textarea>
                    </div>
                </li>
            </ul>
        </div>
        <div class="order-product">
            <div class="order-product-div">
                <!--<div class="orderProd-item display">-->
                <!--    <div class="orderprod-item-img">-->
                <!--        <img src="/static/upload_img/admin/ico/20230116/b29549322c1afaa408d8bae13f63b511.png" alt="">-->
                <!--    </div>-->
                <!--    <ul class="orderProd-item-ul">-->
                <!--        <h4> PELICULA DE VIDRO 3D , MOTOROLA LINHA </h4>-->
                <!--        <li class="orderprod-item-li display">-->
                <!--            <p>G6 PLAY</p>-->
                <!--            <p>单价：R$<span>3</span></p>-->
                <!--            <p>数量：<span>3</span></p>-->
                <!--            <p>小计：R$<span>9</span></p>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</div>-->
            </div>
            <div class="order-button display">
                <div class="order-button-text">
                    <?php echo $languageObj['总计']['name_' . $language]; ?>：R$<span class="priceall"><?php echo $orderdata['0']['prisum']; ?></span>
                </div>
                <!--<button id="cancel">取消</button>-->
                <!--<button id="determine">确认提交</button>-->
            </div>
        </div>
    </div>
    <script>
        
        var orderArr=<?php echo $orderdata['0']['buyarr']; ?>;
        var html='';
        var orderHtml='';
        for(var i = 0;i<orderArr.length;i++){
            html+='<div class="orderProd-item display">';
            html+='     <div class="orderprod-item-img">';
            html+='         <img src="'+orderArr[i][1]+'" alt="">';
            html+='     </div>';
            html+='     <ul class="orderProd-item-ul">';
            html+='         <h4>'+orderArr[i][0]+'</h4>';
            html+='     </ul>';
            html+='</div>';
            $(".order-product-div").append(html);
            html='';
            for(var j=0;j<orderArr[i][2].length;j++){
                orderHtml+='<li class="orderprod-item-li display">';
                orderHtml+='    <p>'+orderArr[i][2][j][0]+'</p>';
                orderHtml+=`    <p><?php echo $languageObj['单价']['name_' . $language]; ?>：R$<span>`+orderArr[i][2][j][1]+'</span></p>';
                orderHtml+=`    <p><?php echo $languageObj['数量']['name_' . $language]; ?>：<span>`+orderArr[i][2][j][2]+'</span></p>';
                orderHtml+=`    <p><?php echo $languageObj['小计']['name_' . $language]; ?>：R$<span>`+parseInt(orderArr[i][2][j][1])*parseInt(orderArr[i][2][j][2])+'</span></p>';
                orderHtml+='</li>';
                $(".orderProd-item").eq(i).find(".orderProd-item-ul").append(orderHtml);
                orderHtml='';
            }
        }
        
       
       $(document).ready(function(){
           
            window.print();
       })
       
    </script>
    <div class="kong"></div>

  

  

    <script src="/static/page/js/scr.js"></script>
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
		