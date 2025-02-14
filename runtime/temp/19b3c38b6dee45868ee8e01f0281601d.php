<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:86:"/www/wwwroot/tb.youanfutang.cn/public/../application/admin/view/admin/table/webpv.html";i:1715435934;s:65:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/layout.html";i:1658590062;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/header.html";i:1658677912;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/footer.html";i:1658590072;}*/ ?>

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
	#addclass{display: none;background-color: white;}
	#addclass>div{color: rgb(102, 102, 102);height: 40px;margin: auto;padding: 15px;}
	#addclass>div span{height: 30px;width: 30%;}
	#addclass>div input{width: 60%;height: 30px;margin-left: 10px;padding-left: 10px;}
	#add-confirm{margin-top: 10px;float: right;margin-bottom: 10px;margin-right: 10px;}
	/* 	.layui-table-body{overflow: hidden;} */
	   .layui-table-view .layui-table[lay-size=sm] tbody .layui-table-cell{line-height: 40px!important;height: 40px!important;  text-align:center!important;} /* layui内容区域设置 */
		.layui-table-view .layui-table[lay-size=sm] thead .layui-table-cell{height:30px;line-height: 30px!important;background-color:white;  text-align:center!important;}  /* layui头部区域设置 */
		
		  .layui-table thead tr, .layui-table-click, .layui-table-header, .layui-table-mend, .layui-table-patch, .layui-table-tool, .layui-table-total{background-color:white!important;} /* layui头部背景 */
		  .layui-table img{max-width: 95%!important;}
</style>

<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
  <ul class="layui-tab-title">
    <li class="layui-this"><?php echo $languageObj['数据列表']['name_' . $language]; ?></li>
   <!-- <li>内容分类</li>
    <li>发布内容</li>
    <li>网站公告</li>
    <li>评论管理</li> -->
  </ul>
  
  <style type="text/css">
  	.articlelist{width: 100%;}
	.articlelist>div:nth-of-type(1){width: 100%; margin-top: 10px;margin-bottom: 20px;}
	.articlelist>div:nth-of-type(2)>div:nth-of-type(1),#articlelist{width: 100%; background: rgb(240, 241, 245);
	color: rgb(102, 102, 102);height: 50px;display: flex;line-height: 50px;}
	.articlelist>div:nth-of-type(2)>div:nth-of-type(1)>span,#articlelist>span{display: block;text-align: center;width: 33%;}
	
	#articlelist{background: white;border-bottom: 1px solid rgba(130,126,126,0.3)/* 灰色线条阴影 */;transition: background-color .25s ease;}
	#articlelist:hover{background-color: rgb(240, 241, 245);}


	
  </style>

  <div class="layui-tab-content">
	<div class="layui-tab-item layui-show">   <!-- 文章列表 --><table id="newslist" lay-filter="test"></table></div>    <!-- 文章列表 -->
	<div class="layui-tab-item articlelist"><!-- 文章分类 -->
		<div><button type="button" class="layui-btn add-class">添加分类</button></div>
		<div>
			<div>
			<span>分类名称</span>
			<span>分类语言</span>
			<span>操作</span>
			</div>
			<div id="listdiv">
			
			
				
			</div>
		</div>
		
	</div>    <!-- 文章分类 -->
	<div class="layui-tab-item upnews" id="" ></div>  
	<div class="layui-tab-item">131</div>  
	<div class="layui-tab-item">141</div>  
	  
  </div>
  
</div> <!-- //选项卡 -->    
 <script  type="text/javascript" charset="utf-8">

 	$(document).ready(function(){
 	$.post("/login.php/newsad/classlist",function(str) {
 		let htmlclass='';
 		str.forEach(x=>{
 			// console.log(x.Id);
 			// console.log(x.class);
 			// console.log(x.version);  
 		
 		htmlclass +='	<div class="newslist" id="articlelist"><span class="xclassname" >'+x.class+'</span><span>'+x.version+'</span><span ><button onclick=""  type="button" class="layui-btn  layui-btn-danger delclass" data="'+x.Id+'">删除</button></span></div></br>';
 		})
 	 $("#listdiv").html(htmlclass);
	
 	})
 	
 	});


 	
 </script>  <!-- 文章class获取 -->
      <div id="addclass" style="display:none;">
      		<div> <span>请输入分类名称：</span><input type="text" name="" id="classname" value="" /></div>
      		 <div><span>请选择分类语言：</span><input type="text" name="" id="version" value="简体中文" disabled="disabled"  /></div> 
      		 <button type="button" class="layui-btn add-class" id="add-confirm">确认添加</button>
      	  </div> <!-- 添加文章分类 -->
    

<script type="text/javascript">
	$("#listdiv").on("click",function(e){
			//console.log(e.target);
			let dataVal = e.target.getAttribute('data'); //获得循环输出的 div的 某个点击元素的值 e.target
		
		layer.confirm('确定删除？',function(){
			
			$.ajax({
				type:'post', // 规定请求的类型（GET 或 POST）
				url:'/login.php/newsad/delclass', // 请求的url地址
			 	cache:false,// 否在缓存中读取数据的读取
				dataType:'json', //预期的服务器响应的数据类型 
				data:{
				dataVal:dataVal,
					
			},//规定要发送到服务器的数据
			success:function(){
					
			 	layer.msg('删除成功！', {
			                icon:1,
			 	                shade: 0.05,
				                time: 1000
			            });
					
			},
			error:function(result){ //失败的函数
			layer.msg('删除失败！', {
			                icon:2,
			 	                shade: 0.05,
				                time: 800
				            });
							
							
							
							
			}
			  }) //ajax
		});
		
			
			});

	 //删除分类
</script>
  <script type="text/javascript">
	  var index ;
  	$(".add-class").click(function(){
	
	var index =layer.open({
		  type: 1, 
		  content: $('#addclass') //这里content是一个普通的String
		  ,area: ['400px'],
		  title: ['添加文章分类']
		   ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
		});
	
		$(".layui-layer-shade").remove(); //移除遮罩		
	});
	
	
	$("#add-confirm").click(function(){
		
		var classname=$("#classname").val();
		var version=$("#version").val();
		
		
		$.ajax({
			type:'post', // 规定请求的类型（GET 或 POST）
			url:'/login.php/newsad/addclass', // 请求的url地址
			cache:false,// 否在缓存中读取数据的读取
			dataType:'json', //预期的服务器响应的数据类型 
			data:{
				classname:classname,
				version:version
			},//规定要发送到服务器的数据
			success:function(){
			
			layer.msg('添加成功！', {
			                icon:1,
			                shade: 0.05,
			                time: 1000
			            },function(){
							layer.closeAll();  //关闭所有弹层
							 $(".layui-layer-shade").remove(); //移除遮罩
					
						});
			
			},
			error:function(result){ //失败的函数
			layer.msg('分类名称不能为空！', {
			                icon:2,
			                shade: 0.05,
			                time: 800
			            },function(){
							 layer.closeAll();  //关闭所有弹层
						
				
						});
					
					
					
					
			}
		 }) //ajax
		
	}); //添加分类JS
	
	
  </script>
 


<script type="text/javascript">
   
  $(document).ready(function(){
	    $.post("/login.php/admin/loadright?page=up&id=news",function(res){
		   $('.upnews').html(res);
		 
	   });
   }); 	//ajax判断选项卡

layui.use('table', function(){
	
	var table = layui.table;
   var ins1=table.render({
     elem: '#newslist'
     ,height: 700
	 ,method:'post'
     ,url: '/login.php/admin/webpvlist' //数据接口
	 ,page:  { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
      layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] ,//自定义分页布局
	  limit:40
	  ,limits : [40,80,120]
      ,curr:1 //设定初始在第 1 页
      ,groups: 2 //只显示 1 个连续页码
      ,first: false //不显示首页
      ,last: false //不显示尾页
	  
      
    }
	
	,request: {
	            pageName: 'page',//页码的参数名称，默认：page
		 } 
	 ,size:'sm'
     ,cols: [[ //表头
       {field: 'Id', title: 'ID', width:70, sort: true, fixed: 'left'}
       ,{field: 'viewip', title: `<?php echo $languageObj['访客IP']['name_' . $language]; ?>`, width:110}
	    ,{field: 'ipnum', title: `<?php echo $languageObj['访客次数']['name_' . $language]; ?>`, width:80}
        ,{field: 'opertime', title: `<?php echo $languageObj['访问时间']['name_' . $language]; ?>`, width:150}
		,{field: 'ipvip', title: `<?php echo $languageObj['用户等级']['name_' . $language]; ?>`, width:150}
	    ,{field: 'operation', title: `<?php echo $languageObj['访客操作']['name_' . $language]; ?>`, width:130},
	 
       
	  
	   // ,{field: 'newssort', title: '排序',sort: true, width:100}
       // ,{field: 'wealth', title: '编辑操作', width:180,  toolbar: '#bardemo'}
     ]],
	 done: function (res, curr, count) {
	                 exportData=res.data;//结束后获取返回的json表
	 					 console.log(exportData);
	             }
   });
   //监听工具条
   table.on('tool(test)', function(obj){ 
     var data = obj.data; //获得当前行数据
	 var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
	  
     var tr = obj.tr; //获得当前行 tr 的 DOM 对象（如果有的话）
	 
	 var trid=$($(tr).find('td')[0]).text();
     
     if(layEvent === 'detail'){ //查看
	layer.confirm('查看内容？',function(index){
	 layer.close(index);
	 $.ajax({
	 	type:'get', // 规定请求的类型（GET 或 POST）
	 	url:'/login.php/newsad/newslist_detail', // 请求的url地址
	 	cache:false,// 否在缓存中读取数据的读取
	 	dataType:'json', //预期的服务器响应的数据类型 
	 	data:{
	 		trid:trid
	 	},//规定要发送到服务器的数据
		success: function(data){ // 当请求成功时运行的函数
		  // console.log(data);
		  layer.msg('努力加载中...', {
		  	icon: 16,
		  	shade: 0.05,
		  	time: 700
		  }, function() {
		    window.open('/login.php/newsad/newslist_detail?trid='+trid,'_blank')
		  });
		  
		 
			
		},
	  }) //ajax
	 }) 
       
     } else if(layEvent === 'del'){ //删除
       layer.confirm('确定删除这条数据吗？', function(index){
	    
	     obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
         layer.close(index);  //关闭指令
       
		 $.ajax({
		 	type:'post', // 规定请求的类型（GET 或 POST）
		 	url:'/login.php/Jianglist/newslist_del', // 请求的url地址
		 	cache:false,// 否在缓存中读取数据的读取
		 	dataType:'json', //预期的服务器响应的数据类型 
		 	data:{
		 		trid:trid
		 	}//规定要发送到服务器的数据
		  }) //ajax
		 
       });
     } else if(layEvent === 'edit'){ //编辑
       //do something
	
		table.exportFile(ins1.config.id,exportData, 'xls');
       
       //同步更新缓存对应的值
       obj.update({
         username: '123'
         ,title: 'xxx'
       });
     } else if(layEvent === 'LAYTABLE_TIPS'){
       layer.alert('Hi，头部工具栏扩展的右侧图标。');
     }
   });   
   });

</script>
<script type="text/html" id="bardemo">

  <a class="layui-btn layui-btn-xs" lay-event="edit">下载表格</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
  
<!--  注意：属性 lay-event="" 是模板的关键所在，值可随意定义。 -->
</script>




</body>
</html>

<div class="wxfxanli-con" style="display: none;text-align: center;">
	             <b style="font-size: 22px;margin: 10px 0px;display: block;">案例1</b>
				 
				<img width="90%" style="display: block;margin: auto;" src="/static/img/admin/wxfx.png" >
				   <b style="font-size: 22px;margin: 10px 0px;display: block;">案例2</b>
				<img width="90%" style="display: block;margin: auto;" src="/static/img/admin/pyqfx.png" >
</div>
		