<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:89:"/www/wwwroot/tb.youanfutang.cn/public/../application/admin/view/admin/table/forminfo.html";i:1715414582;s:65:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/layout.html";i:1658590062;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/header.html";i:1658677912;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/footer.html";i:1658590072;}*/ ?>

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
	.forminfo{width:97%; /* border: 1px solid #ddd */;}
	
   .layui-table-view .layui-table[lay-size=sm] tbody .layui-table-cell{line-height: 90px!important;height: 90px!important;  text-align:center!important;} /* layui内容区域设置 */
	.layui-table-view .layui-table[lay-size=sm] thead .layui-table-cell{height:30px;line-height: 30px!important;background-color:white;  text-align:center!important;}  /* layui头部区域设置 */
	
	  .layui-table thead tr, .layui-table-click, .layui-table-header, .layui-table-mend, .layui-table-patch, .layui-table-tool, .layui-table-total{background-color:white;} /* layui头部背景 */
</style>
<div class="forminfo">
	
	<div id="forminfo"  lay-filter="test">
		
	
	</div>


</div> <!-- forminfo -->


 
 <script type="text/javascript">
    let tdname;
	let tdtel;
	let tdcon;
 layui.use('table', function(){
 	
 	var table = layui.table;
    table.render({
      elem: '#forminfo'
      ,height: 530
 	 ,method:'post'
      ,url: '/login.php/admin/formapi?select=select' //数据接口
	 ,page:  { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
       layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] ,//自定义分页布局
 	  limit:20
 	  ,limits : [20,40,60]
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
        {field: 'Id', title: 'ID',  width:100,fixed: 'left'}
        ,{field: 'formico', width:200,title: `<?php echo $languageObj['会员头像']['name_' . $language]; ?>`,templet:'<div><img  src="/static/img//admin/formico.jpg"></div>'}
        ,{field: 'name', title: `<?php echo $languageObj['姓名']['name_' . $language]; ?>`, width:150,edit:true}
        ,{field: 'tel', title: `<?php echo $languageObj['电话']['name_' . $language]; ?>`, width:150,edit:true} 
        ,{field: 'content', title: `<?php echo $languageObj['反馈信息']['name_' . $language]; ?>`,edit:true}
 	    ,{field: 'wealth', title: `<?php echo $languageObj['操作']['name_' . $language]; ?>`, width:170,  toolbar: '#bardemo'}
      ]]
    });
	//监听单元格编辑
	table.on('edit(test)', function(obj){ //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"
	   console.log(obj.value); //得到修改后的值
	   console.log(obj.field); //当前编辑的字段名
	  // console.log(obj.data); //所在行的所有相关数据  
	     tdfield=obj.field;
		 if(tdfield==="name"){
			tdname =obj.value;
		 }else if(tdfield==="tel"){
			 tdtel =obj.value;
		 }else if(tdfield==="content"){
			  tdcon =obj.value;
		 };
		
		
		
	});
    //监听工具条
    table.on('tool(test)', function(obj){ 
      var data = obj.data; //获得当前行数据
 	 var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
 	  
      var tr = obj.tr; //获得当前行 tr 的 DOM 对象（如果有的话）
 	 
 	 var trid=$($(tr).find('td')[0]).text();
      
	  console.log(trid);
	  
      if(layEvent === 'edit'){ //查看

 	layer.confirm(`<?php echo $languageObj['保存编辑？']['name_' . $language]; ?>`,function(index){
			
 	 layer.close(index);
	 
 	 $.ajax({
 	 	type:'get', // 规定请求的类型（GET 或 POST）
 	 	url:'/login.php/admin/formapi', // 请求的url地址
 	 	cache:false,// 否在缓存中读取数据的读取
 	 	dataType:'json', //预期的服务器响应的数据类型 
 	 	data:{
 	 		id:trid,
			tdname:tdname,
			tdtel:tdtel,
			tdcon:tdcon,
			modif:"modif"
 	 	},//规定要发送到服务器的数据
 		success: function(data){ // 当请求成功时运行的函数
 		   console.log(data);
 		  layer.msg(`<?php echo $languageObj['修改成功']['name_' . $language]; ?>`, {
 		  	icon: 1,
 		  	shade: 0.05,
 		  	time: 700
 		  });
 		  
 		 
 			
 		},
		error:function(result){ //失败的函数
		console.log(result) ; 
		layer.msg('空值或重复！', {
		                icon:2,
		                shade: 0.05,
		                time: 800
		            });
				
				
				
				
		},
 	  }) //ajax
 	 }) 
        
      } else if(layEvent === 'del'){ //删除
        layer.confirm(`<?php echo $languageObj['确定删除这条数据吗？']['name_' . $language]; ?>`, function(index){
 	    
 	     obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
          layer.close(index);  //关闭指令
       
 		 $.ajax({
 		 	type:'post', // 规定请求的类型（GET 或 POST）
 		 	url:'/login.php/admin/formapi', // 请求的url地址
 		 	cache:false,// 否在缓存中读取数据的读取
 		 	dataType:'json', //预期的服务器响应的数据类型 
 		 	data:{
 		 		id:trid,
				del:"del"
 		 	}//规定要发送到服务器的数据
 		  }) //ajax
 		 
        });
      } else if(layEvent === 'LAYTABLE_TIPS'){
        layer.alert('Hi，头部工具栏扩展的右侧图标。');
      }
    });   //end工具栏
  

	});
	

 
 </script>
 <script  type="text/html" id="bardemo">
   
 
	   <button lay-event="edit" type="button" class="layui-btn layui-btn-primary layui-btn-sm">
	     <i class="layui-icon">&#xe642;</i>
	   </button>
	   <button lay-event="del" type="button" class="layui-btn layui-btn-primary layui-btn-sm">
	     <i class="layui-icon">&#xe640;</i>
	   </button>

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
		