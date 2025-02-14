<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:97:"/www/wwwroot/tb.youanfutang.cn/public/../application/admin/view/admin/page/basic-information.html";i:1715743805;s:65:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/layout.html";i:1658590062;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/header.html";i:1658677912;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/footer.html";i:1658590072;}*/ ?>

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
	
	.layui-btn{margin-top: 15px;}
	.basic-information{height: 1300px;}
	.basic-information-div{width: 100%;height: auto;line-height: 1.5;margin-top: 10px;}
	.basic-information-div input{height: 30px;width:40%;padding-left: 15px;}
	.basic-information-div span{width:120px;display: inline-block;}
	
	.basic-information-layedit{width: 80%;margin-top: 10px;}
	.basic-information-layedit>span:nth-of-type(1){letter-spacing:8px;width:120px;display: inline-block;float: left;}
	#Introduction{width:700px;display: inline-block;height: 380px;}
	.layui-layedit{width:85%;margin-left: 120px;}
	#basic-button{margin-top: 20px;float: right;margin-bottom:100px;margin-right: 40%;}
</style>

<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
  <ul class="layui-tab-title">
    <li class="layui-this"><?php echo $languageObj['基本资料']['name_' . $language]; ?></li>
   
  
	 
  </ul>
  
  <div class="layui-tab-content">
	<div class="layui-tab-item layui-show">
		<div class="basic-information">
			
			<div style="width:100px;height:100px;border-radius: 100px;margin-left: 60px;margin-top: 30px;">
				<img src="<?php echo $ico; ?>" width="100%" style="border-radius: 100px;"   id="photo" >
			</div>
		<button type="button"  class="layui-btn" id="uploadico" style="width: 200px;text-align: center;letter-spacing: 8px;">
		  <i class="layui-icon">&#xe64a;</i><?php echo $languageObj['上传头像']['name_' . $language]; ?>
		</button>
			<div class="basic-information-div"><span><?php echo $languageObj['后台昵称']['name_' . $language]; ?>：</span><input type="text" name="" id="username" value="<?php echo $username; ?>" placeholder="请输入您的后台昵称" /></div>
			<div class="basic-information-div"><span><?php echo $languageObj['公司名称']['name_' . $language]; ?>：</span><input type="text" name="" id="companyname" value="<?php echo $companyname; ?>" placeholder="请输入您的营业执照名称" /></div>
			<div class="basic-information-div"><span><?php echo $languageObj['网站名称']['name_' . $language]; ?>：</span><input type="text" name="" id="webname" value="<?php echo $webname; ?>" placeholder="请输入您的网站名称" /></div>
			<div class="basic-information-div"><span><?php echo $languageObj['底部介绍']['name_' . $language]; ?>：</span><input type="text" name="" id="domain" value="<?php echo $domain; ?>" placeholder="请输入您的底部介绍" /></div>
			<div class="basic-information-div"><span><?php echo $languageObj['详细地址']['name_' . $language]; ?>：</span><input type="text" name="" id="Address" value="<?php echo $Address; ?>" placeholder="请输入您的详细地址" /></div>
			<div class="basic-information-div"><span><?php echo $languageObj['联系人']['name_' . $language]; ?>：</span><input type="text" name="" id="person" value="<?php echo $person; ?>" placeholder="请输入您的联系人名称" /></div>
			<div class="basic-information-div"><span><?php echo $languageObj['电话']['name_' . $language]; ?>：</span><input type="text" name="" id="mobile" value="<?php echo $mobile; ?>" placeholder="请输入您的电话号码" /></div>
			<div class="basic-information-div"><span><?php echo $languageObj['在线QQ']['name_' . $language]; ?>：</span><input type="text" name="" id="qq" value="<?php echo $qq; ?>" placeholder="请输入您的在线QQ" /></div>
			<div class="basic-information-layedit" ><span><?php echo $languageObj['版权信息']['name_' . $language]; ?>：</span>
			<textarea  id="Introduction" style="" lay-verify="content">	<?php echo $Introduction; ?></textarea>
		   </div>
		
				<button type="button" id="basic-button" class="layui-btn"  data-type="content"><?php echo $languageObj['保存资料']['name_' . $language]; ?></button>
		</div><!-- /*end*/ -->
	</div>  <!-- item1 -->


	  
  </div>
  
</div> <!-- //选项卡 --> 

<script>
	
var  photo;
layui.use('upload', function(){
  var upload = layui.upload;
   
  //执行实例
  var uploadInst = upload.render({
    elem: '#uploadico' //绑定元素
    ,url: '/login.php/admin/basicicoapi' ,//上传接口
	//,url: '/login.php/admin/aliossupfile' ,//上传接口
	exts: 'jpg|png|jpeg'
	,multiple:true
	,drag:true
	,data:{
		
	}
    ,before:function(obj){
		//预读本地文件示例，不支持ie8
		     
			  layer.confirm('头像最佳比例是1：1', {icon: 3, title:'提示'}, function(){
				layer.msg('图片上传中...', {
				                icon:16,
				                shade: 0.05,
				                time: 500
				            });});}
	,done: function(res){
      //上传完毕回调
	 $('#photo').attr('src', res.filepath);
	  // console.log(res.filepath); 图片文件的路径
	       photo=res.filepath;//赋值给photo 传给ajax丢数据
    }
    ,error: function(res){
      //请求异常回调

	  console.log(res);
    }
  });
});
</script>
<script>
var Introduction;	//layedit 文本
	$(function() {

	UE.delEditor('Introduction');

	var ue = UE.getEditor('Introduction', {
	   scaleEnabled:true,//设置不自动调整高度
	    autoFloatEnabled:false, //取消悬浮
	});
				
				
				}); 


</script>
<script type="text/javascript">
$(function(){
	$("#basic-button").click(function(){
		
		
		var username=$("#username").val();
		var companyname=$("#companyname").val();
		var webname=$("#webname").val();
		var domain=$("#domain").val();
		var Address=$("#Address").val();
		var person=$("#person").val();
		var mobile=$("#mobile").val();
		var qq=$("#qq").val();
		var photo=$("#photo").attr('src');
	  Introduction=UE.getEditor('Introduction').getContent();
		
		
	
		$.ajax({
			type:'POST', // 规定请求的类型（GET 或 POST）
			url:'/login.php/newsad/userrole', // 请求的url地址
			cache:true,// 否在缓存中读取数据的读取
			dataType:'json', //预期的服务器响应的数据类型 
			data:{
				 Id:'<?php echo $userid; ?>',
				 photo:photo,
				 username:username,
				companyname:companyname,
				webname:webname,
				 domain:domain,
				  Address:Address,
				    person:person,
					 mobile:mobile,
					 qq:qq,
					  Introduction:Introduction,
					  sign:'基本资料'
			},//规定要发送到服务器的数据
			
			success: function(res){ // 当请求成功时运行的函数
				if(res.code==1){
					
					layer.msg('保存成功！', {
					                icon:1,
					                shade: 0.05,
					                time: 800
					            });
				}else{
					layer.msg('检测到数据未修改！', {
					                icon:2,
					                shade: 0.05,
					                time: 800
					            });
					
				}
				
				
				
				
				
			},
			error:function(result){ //失败的函数
			layer.msg('检测到数据未修改！', {
			                icon:2,
			                shade: 0.05,
			                time: 800
			            });
					
					
					
					
			}
			
		})//ajax-end
		
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
		