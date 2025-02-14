<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:80:"/www/wwwroot/tb.youanfutang.cn/public/../application/admin/view/index/index.html";i:1658590072;s:65:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/layout.html";i:1658590062;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/header.html";i:1658677912;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/footer.html";i:1658590072;}*/ ?>

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


<style type="text/css">
       html,body{width: 100%;height: 100%;margin: 0;background-image: url(/static/img/login-bg.gif) !important;background-repeat: repeat !important;background-color: #0a0a0a !important}
		.login-box{width:900px;height:480px;;display: flex;box-shadow:0px 12px  50px #000000;position: fixed;left:50%;margin-left: -450px;top:0%;margin-top: -240px;opacity:0;border-radius: 20px}
		#login-left{width: 55%;height:100%;background-image: url(/static/img/login-bg.png);background-size:cover;background-repeat: no-repeat;border-top-left-radius: 10px;border-bottom-left-radius: 10px}
		#login-right{width: 45%;height:100%;border-top-right-radius: 10px;border-bottom-right-radius:10px}
		#left-p{color: white;height:100px;line-height:100px;font-weight:100;margin:150px auto;padding-left:30px;}
		#login-right{background-color: white;}
		#right-logo{width: 60%;height:120px;margin:30px auto;display: flex;flex-direction:column;text-align: center;opacity: 0;}
		#right-logo img{width:80%;display: inline-block;margin:auto}
		#right-login{width: 60%;height:250px;margin:10px auto;}
		#login-form{height: 160px;}
		#right-login>form{}
		#right-login>form input{border: 0;border-bottom: 1px solid DarkGray/*灰色*/;width:80%;margin:15px;height:25px;padding-left:10px;}
		#login-button{width: 180px;height: 35px;line-height: 35px;border-radius: 15px;margin:30px auto;display: block;cursor: pointer;}
		#login-button:hover{background-color: rgba(0,70,156,1);color: white;}
		#login-footer{font-size:5px;width:100%;margin:20px auto;text-align: center;}
		#login-footer p span{margin-right: 5px;}
		.layui-btn-primary:hover{border-color:rgba(0,70,156,1)}
	</style>

	<div class="login-box">
		<div id="login-left">
		
		</div>
		<div id="login-right">
			<div id="right-logo">
				<img src="/static/img/admin/logo.png"/>
				<p style="color: rgb(53,74,123);font-weight: bold;">C M S 网 站 后 台 管 理 系 统</p>
			</div>
			<div id="right-login">
				<form id="login-form" action="" method="post">
					<input type="text" name="admin_user" id="admin_user" value=""  placeholder="登录账号"/>
					<input type="password" name="admin_psd" id="admin_psd" value="" placeholder="登录密码" />
					<input style="width: 40%;float: left;margin-right: 5px;" type="text" name="yzm" id="admin_psd" value="" placeholder="验证码" /><img width="110px"  height="40px" style="float: left;cursor: pointer;" src="/login.php/index/captcha" onclick="this.src='/login.php/index/captcha'"/>
					
				</form>
				
				<button id="login-button" class="layui-btn layui-btn-primary">登录</button>
				
			</div>
			<div id="login-footer">
			<p><span>Powered by jaychen </span>
			<span>Copyright © 2001-2025 </span>
			<span>. All rights reserved</span></p>
		    </div>
		
		</div>
	
	</div>


	<script type="text/javascript">
		
			 $(".login-box").animate({top:"50%",opacity:"1"},500);
		       $("#right-logo").animate({opacity:"1"},2000)
		</script>
<script>
	
$(document).ready(function(){
	function loginadmin(){
		var adminuser=$("#admin_user").val();
		var adminpaw=$("#admin_psd").val();
		var yzm=$("input[name='yzm']").val();
		
	if(!adminuser||!adminpaw){
		layer.msg('请输入账号和密码！',{
			icon:2,
			shade:0.05,
			time:500
		})
	}else if(!yzm){
		layer.msg('请输入验证码！',{
			icon:2,
			shade:0.05,
			time:500
		})
	}else{
		$.ajax({
			type:'post', // 规定请求的类型（GET 或 POST）
			url:'/login.php/index/logincheck', // 请求的url地址
			cache:false,// 在缓存中读取数据的读取
			dataType:'json', //预期的服务器响应的数据类型 
			data:{
				 admin_user:adminuser,
				 admin_psd:adminpaw,
				 code:yzm
			},//规定要发送到服务器的数据
			beforeSend:function(){ //发送请求前运行的函数（发送之前就会进入这个函数）
				// ....
			},
			success: function(res){ // 当请求成功时运行的函数
			// console.log(result);
			if(res.code==1&&res.yzm==1){
				layer.msg('登录成功！', {
				                icon:1,
				                shade: 0.05,
				                time: 800
				            },function(){
								window.location.href="/login.php/admin?user="+res.user;  
							}
							);
					
			}else if(res.code==0){
				layer.msg('用户名密码错误！', {
				                icon:2,
				                shade: 0.05,
				                time: 800
				            });
			}else if(res.yzm==0){
				layer.msg('验证码错误！', {
				                icon:2,
				                shade: 0.05,
				                time: 800
				            });
			}else if(res.msg=='账号已停用！'){
				
				layer.msg(res.msg, {
				                icon:2,
				                shade: 0.05,
				                time: 800
				            });
			}
		
			},
			error:function(result){ //失败的函数
					
					layer.msg('链接服务器失败！', {
					                icon:2,
					                shade: 0.05,
					                time: 800
					            });
			},
			complete:function(){ //请求完成时运行的函数（在请求成功或失败之后均调用，即在 success 和 error 函数之后，不管成功还是失败 都会进这个函数）
				// ...
			}
		})
	}//if	
	}//loginadmin
		
	
	$(document).keyup(function(event){
	  if(event.keyCode ==13){
	  loginadmin();
	
	  }
	});
     $("#login-button").click(
	  function(){
		  loginadmin();
		
	  }

	)//click

	
})	

</script>

<script src="/static/layui/layui.all.js"></script>


</body>
</html>

<div class="wxfxanli-con" style="display: none;text-align: center;">
	             <b style="font-size: 22px;margin: 10px 0px;display: block;">案例1</b>
				 
				<img width="90%" style="display: block;margin: auto;" src="/static/img/admin/wxfx.png" >
				   <b style="font-size: 22px;margin: 10px 0px;display: block;">案例2</b>
				<img width="90%" style="display: block;margin: auto;" src="/static/img/admin/pyqfx.png" >
</div>
		