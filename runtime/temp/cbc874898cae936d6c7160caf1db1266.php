<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:88:"/www/wwwroot/tb.youanfutang.cn/public/../application/admin/view/admin/page/modifypw.html";i:1715437218;s:65:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/layout.html";i:1658590062;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/header.html";i:1658677912;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/footer.html";i:1658590072;}*/ ?>

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
    .layui-form{height: auto;min-height: 800px;}
	.layui-textarea{width: 50%;margin-left: -10px;}
	.layui-form-label{width: 100px;}
</style>



<form class="layui-form"   lay-filter="formDemo"   οnsubmit="return false">
	
	<div class="headertip">
	   <li><?php echo $languageObj['账号密码']['name_' . $language]; ?></li>	
	</div>
   <div class="layui-form-item">
	      <label class="layui-form-label"><?php echo $languageObj['管理账号']['name_' . $language]; ?></label> 
		  <div class="layui-input-inline">
		    <input type="text" id="user" name="user" required lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo $user; ?>" disabled="disabled">
		  </div>
   </div>
  <div class="layui-form-item">
    <label class="layui-form-label"><?php echo $languageObj['原密码']['name_' . $language]; ?></label>
    <div class="layui-input-inline">
      <input type="password" id="password" name="password" required lay-verify="required" placeholder="<?php echo $languageObj['请输入']['name_' . $language]; ?>" autocomplete="off" class="layui-input">
    </div>
    </div>
	<div class="layui-form-item">
	  <label class="layui-form-label"><?php echo $languageObj['新密码']['name_' . $language]; ?></label>
	  <div class="layui-input-inline">
	    <input type="text" id="newspw" name="password" required lay-verify="required" placeholder="<?php echo $languageObj['请输入']['name_' . $language]; ?>" autocomplete="off" class="layui-input">
	  </div>
	  </div>


	<div class="layui-form-item">
	  <label class="layui-form-label"><?php echo $languageObj['密码提示']['name_' . $language]; ?></label>
	  <textarea name="desc" id="tippw" placeholder="<?php echo $languageObj['请输入密码提示语句']['name_' . $language]; ?>" class="layui-textarea"><?php echo $tippw; ?></textarea>
	  </div>

   
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit ><?php echo $languageObj['立即提交']['name_' . $language]; ?></button>
  	   <button class="layui-btn" id="userbtn" type="button" ><?php echo $languageObj['修改账号']['name_' . $language]; ?></button>
      <button type="reset" class="layui-btn layui-btn-primary"><?php echo $languageObj['重置']['name_' . $language]; ?></button>
    </div>
  </div>
</form>


<script>
$("#userbtn").click(function(){
			
		$("#user").removeAttr("disabled","false");	
		});	

layui.use('form', function(){
  var form = layui.form;
     form.render();
  //监听提交
  form.on('submit(formDemo)', function(data){
	  var user=$("#user").val();
	  var password=$("#password").val();
	  var newspw=$("#newspw").val();
	  var tippw=$("#tippw").val();
	  
	if(newspw.length<6){
		layer.msg(`<?php echo $languageObj['密码不能小于6位数！']['name_' . $language]; ?>`);
		return false;
	};

  $.ajax({
  	type:'POST', // 规定请求的类型（GET 或 POST）
  	url:'/login.php/newsad/userrole', // 请求的url地址
  	cache:true,// 否在缓存中读取数据的读取
  	dataType:'json', //预期的服务器响应的数据类型 
  	data:{
		Id:'<?php echo $userid; ?>',
  		 tippw:tippw,
		 user:user,
		 newspw:newspw,
		 password:password,
		 sign: `<?php echo $languageObj['修改密码']['name_' . $language]; ?>`
  	
  	},//规定要发送到服务器的数据
  	
  	success: function(res){ // 当请求成功时运行的函数
  		if(res.code==1){
			layer.msg('您的账号：'+user+'&nbsp;&nbsp;密码:'+newspw, {
			                icon:1,
			                shade: 0.05,
			                time: 3000
			            },function(){
							
							$.ajax({
								type: 'POST', // 规定请求的类型（GET 或 POST）
								url: '/login.php/admin/clearcookie', // 请求的url地址
								cache: true, // 否在缓存中读取数据的读取
								dataType: 'json', //预期的服务器响应的数据类型 
								data: {
									clear: "clearcookie",
									
								}, //规定要发送到服务器的数据
									
								success: function(result) { // 当请求成功时运行的函数
									
									layer.msg('请重新登录...', {
										icon: 16,
										shade: 0.05,
										time: 1000
									}, function() {
										window.open('/login.php','top');
									});
									
									
									
								},
								error: function(result) { //失败的函数
									layer.msg('退出失败！', {
										icon: 5,
										shade: 0.05,
										time: 800
									});
									
									
									
									
								}
									
							}); //ajax-end
						});
		}else if(res.code==3){
			
			layer.msg(`<?php echo $languageObj['原密码错误！']['name_' . $language]; ?>`, {
			                icon:2,
			                shade: 0.05,
			                time: 3000
			            });
		}else if(res.code==0){
			
			layer.msg('更新出错！', {
			                icon:2,
			                shade: 0.05,
			                time: 3000
			            });
		}
  		
 		
  		
  	},
  	error:function(result){ //失败的函数
  	layer.msg('服务器故障！', {
  	                icon:2,
  	                shade: 0.05,
  	                time: 800
  	            });
  			
  			
  			
  			
  	}
  	
  })//ajax-end
  
  
    return false;
  });
});
</script>






</body>
</html>

<div class="wxfxanli-con" style="display: none;text-align: center;">
	             <b style="font-size: 22px;margin: 10px 0px;display: block;">案例1</b>
				 
				<img width="90%" style="display: block;margin: auto;" src="/static/img/admin/wxfx.png" >
				   <b style="font-size: 22px;margin: 10px 0px;display: block;">案例2</b>
				<img width="90%" style="display: block;margin: auto;" src="/static/img/admin/pyqfx.png" >
</div>
		