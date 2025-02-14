<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:86:"/www/wwwroot/tb.youanfutang.cn/public/../application/admin/view/admin/table/order.html";i:1715743140;s:65:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/layout.html";i:1658590062;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/header.html";i:1658677912;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/footer.html";i:1658590072;}*/ ?>

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


<style>
.layui-table tbody tr:hover, .layui-table thead tr, .layui-table-click, .layui-table-header, .layui-table-hover, .layui-table-mend, .layui-table-patch, .layui-table-tool, .layui-table-total, .layui-table-total tr, .layui-table[lay-even] tr:nth-child(even) {
    background-color: #ffffff;
}

   .layui-table-box tbody .layui-table-cell{line-height: 90px!important;height: 90px!important;  text-align:center!important;} /* layui内容区域设置 */
   
</style>
<div class="layuimini-container">
    <div class="layuimini-main">

        <fieldset class="table-search-fieldset">
            <legend><?php echo $languageObj['搜索信息']['name_' . $language]; ?></legend>
            <div style="margin: 10px 10px 10px 10px">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label"><?php echo $languageObj['内容标题']['name_' . $language]; ?></label>
                            <div class="layui-input-inline">
                                <input type="text" name="username" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                    
                        <div class="layui-inline">
                            <button type="submit" class="layui-btn layui-btn-primary"  lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> <?php echo $languageObj['搜索']['name_' . $language]; ?></button>
                        </div>
                    </div>
                </form>
            </div>
			<input type="text" class="layui-input delpwd" placeholder="<?php echo $languageObj['请输入后台登录密码']['name_' . $language]; ?>" style="width: 30%;display: none;">
        </fieldset>

        <script type="text/html" id="toolbarDemo">
            <div class="layui-btn-container">
            
               <button class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn" lay-event="delete"> <?php echo $languageObj['批量删除']['name_' . $language]; ?> </button>
            </div>
        </script>

        <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>

        <script type="text/html" id="currentTableBar">
       
              <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="edit"><?php echo $languageObj['编辑状态']['name_' . $language]; ?></a>
               <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="edithw"><?php echo $languageObj['编辑货物']['name_' . $language]; ?></a>
                <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="dayin"><?php echo $languageObj['打印面单']['name_' . $language]; ?></a>
           <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete"><?php echo $languageObj['删除']['name_' . $language]; ?></a>
        </script>

    </div>
</div>
<style type="text/css">
	.editmem{display: none;padding-top: 20px;}
	.editmem>div{width: 90%;margin: auto;height: auto;line-height: 45px;}
	.editmem select{width: 70%; height: 35px;padding-left: 10px;}
	.editmem input{height: 35px;width: 67%;padding-left: 5px;}
	.submitedit{display: block;margin:20px auto;}
</style>
<div class="editmem">
	<div><span><?php echo $languageObj['付款状态']['name_' . $language]; ?>：</span>
	    <select name="status">
		<option value="未付款"><?php echo $languageObj['未付款']['name_' . $language]; ?></option>
		<option value="已付款"><?php echo $languageObj['已付款']['name_' . $language]; ?></option>
	</select>
	</div>
		<div><span><?php echo $languageObj['配送状态']['name_' . $language]; ?>：</span>
	    <select name="wuliu">
				<option value="未配送"><?php echo $languageObj['未配送']['name_' . $language]; ?></option>
				<option value="配送中"><?php echo $languageObj['配送中']['name_' . $language]; ?></option>
	</select>
	</div>

	
		<button type="button" class="layui-btn submitedit"><?php echo $languageObj['保存信息']['name_' . $language]; ?></button>
	
</div>

<script type="text/javascript">
	var  trid='';
	$(function(){
		
		$(".submitedit").click(function(){
			var status=$('select[name="status"]').val();
			var wuliu=$('select[name="wuliu"]').val();
			
		
			$.ajax({
				type:'post', // 规定请求的类型（GET 或 POST）
				url:'/login.php/admin/ordersa', // 请求的url地址
				cache:false,// 否在缓存中读取数据的读取
				dataType:'json', //预期的服务器响应的数据类型 
				data:{
					trid:trid,
					status:status,
					wuliu:wuliu
					
				},//规定要发送到服务器的数据
				success:function(res){
					if(res.code==1){
						layer.msg(`<?php echo $languageObj['保存成功']['name_' . $language]; ?>`, {
						                icon:1,
						                shade: 0.05,
						                time: 800
						            },function(){
										window.location.href='/login.php/admin/loadright?page=order';
									});
					}else{
						layer.msg(`<?php echo $languageObj['请勿选择相同状态！']['name_' . $language]; ?>`);
					}
					
				}
			 }) //ajax
			
			
		})
		
	})
</script>
<style type="text/css" media="all">
    .layui-table-box tbody .layui-table-cell:not(.laytable-cell-1-0-0) {
    line-height: 90px!important;
    height: 90px!important;
    text-align: left!important;
}
/*.laytable-cell-1-0-0{*/
/*    text-align:center!important*/
/*}*/
</style>
<script src="/static/layui/layui.all.js"></script>
<script>
    layui.use(['form', 'table'], function () {
        var $ = layui.jquery,
            form = layui.form,
            table = layui.table;

        table.render({
            elem: '#currentTableId',
            url: '/login.php/newsad/newslist?formname=order',
            toolbar: '#toolbarDemo',
            defaultToolbar: ['filter', 'exports', 'print', {
                title: `<?php echo $languageObj['提示']['name_' . $language]; ?>`,
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [[
                {type: "checkbox", width: 50},
                {field: 'Id', width: 100, title: `<?php echo $languageObj['订单ID']['name_' . $language]; ?>`, sort: true},
                {field: 'userid', width: 80, title: `<?php echo $languageObj['用户Id']['name_' . $language]; ?>`},
                {field: 'name', width: 100, title: `<?php echo $languageObj['用户名字']['name_' . $language]; ?>`},
                {field: 'shouhuo', width:170, title: `<?php echo $languageObj['收货地址']['name_' . $language]; ?>`},
                {field: 'beizhu', width:150, title: `<?php echo $languageObj['订单备注']['name_' . $language]; ?>`},
				
								{field: 'prisum', width:100, title: `<?php echo $languageObj['订单价格']['name_' . $language]; ?>`},
								{field: 'trade', width:100, title: `<?php echo $languageObj['订单号码']['name_' . $language]; ?>`},
								{field: 'trdate', width:120, title: `<?php echo $languageObj['下单时间']['name_' . $language]; ?>`, sort: true},
								{field: 'status', width:100, title: `<?php echo $languageObj['购买状态']['name_' . $language]; ?>`},
								{field: 'wuliu', width:100, title: `<?php echo $languageObj['配送状态']['name_' . $language]; ?>`,edit:true},
								{field: 'status2', width:150, title: `<?php echo $languageObj['订单状态']['name_' . $language]; ?>`},
			
                
                 {title: `<?php echo $languageObj['操作']['name_' . $language]; ?>`, minWidth: 150, toolbar: '#currentTableBar', align: "center"}
            ]],
            limits: [50, 100, 150, 200, 250, 300],
            limit: 50,
            page: true,
            skin: 'line',
            height:'full-150'
            
        });

        // 监听搜索操作
        form.on('submit(data-search-btn)', function (data) {
            var result = JSON.stringify(data.field);
          
		 
            //执行搜索重载
            table.reload('currentTableId', {
                page: {
                    curr: 1
                }
                , where: {
                    searchParams: result
                }
            }, 'data');

            return false;
        });

        /**
         * toolbar监听事件
         */
        table.on('toolbar(currentTableFilter)', function (obj) {
			
			var data = obj.data; //获得当前行数据
			var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
			
            if (obj.event === 'add') {  // 监听添加操作
         
		         window.location.href="/login.php/admin/loadright?page=upkc&formname=order";
				 
            } else if (obj.event === 'delete') {  // 监听删除操作
                var checkStatus = table.checkStatus('currentTableId')
                    , data = checkStatus.data;
            
			console.log(data);
			var delpwd=$(".delpwd").val();
			$(".delpwd").show(300);
			
		    if(data==''){
				layer.msg(`<?php echo $languageObj['请选择数据']['name_' . $language]; ?>`);
			}else if(delpwd==''){
				layer.msg(`<?php echo $languageObj['请输入后台登录密码']['name_' . $language]; ?>`);
				return false;
			}else{
				layer.confirm('删除选中的数据吗？',function(index){
				  layer.close(index);
								 $.ajax({
								 	type:'post', // 规定请求的类型（GET 或 POST）
								 	url:'/login.php/newsad/newslist_del', // 请求的url地址
								 	cache:false,// 否在缓存中读取数据的读取
								 	dataType:'json', //预期的服务器响应的数据类型 
								 	data:{
								 		data:JSON.stringify(data),
										formname:'order',
											delpwd:delpwd
								 	},//规定要发送到服务器的数据
									success:function(s){
									   if(s.code==1){
										  //执行表格重载
										  table.reload('currentTableId'); 
									   }else if(s.code==5){
										layer.msg(`<?php echo $languageObj['密码错误']['name_' . $language]; ?>`, {
										                icon:2,
										                shade: 0.05,
										                time: 800
										            });
										   return false;
									   }else{
										    layer.msg(`<?php echo $languageObj['删除失败']['name_' . $language]; ?>`);
									   }
										
									}
								  }) //ajax
								 
				});
			}
			
				
            }
        });

        //监听表格复选框选择
        table.on('checkbox(currentTableFilter)', function (obj) {
            console.log(obj)
        });

        table.on('tool(currentTableFilter)', function (obj) {
            var data = obj.data;
			var tr = obj.tr; //获得当前行 tr 的 DOM 对象（如果有的话）
			 trid=$($(tr).find('td')[1]).text();
            if (obj.event === 'edit') {

                layer.open({
                                  title: `<?php echo $languageObj['编辑状态']['name_' . $language]; ?>`,
                                  type: 1,
                                  shade: 0.2,
                                  maxmin:true,
                					anim:1,
                                  shadeClose: true,
                                  area: ['300px', 'auto'],
                                  content: $('.editmem')
                				   
                              });
			  
            }else if(obj.event === 'dayin'){
                
                window.open('/login.php/admin/loadright?page=dayin&trid='+trid)
                
            }  else if (obj.event === 'edithw') {

              window.location.href='/login.php/admin/loadright?page=edigwc&orderid='+trid;
			  
            } else if (obj.event === 'delete') {
                layer.confirm(`<?php echo $languageObj['确定删除数据吗']['name_' . $language]; ?>`, function (index) {
                  var delpwd=$(".delpwd").val();
                  $(".delpwd").show(300);
                  if(delpwd==''){
                  	layer.msg(`<?php echo $languageObj['请输入后台登录密码']['name_' . $language]; ?>`);
                  	return false;
                  }
					$.ajax({
						type:'post', // 规定请求的类型（GET 或 POST）
						url:'/login.php/newsad/newslist_del', // 请求的url地址
						cache:false,// 否在缓存中读取数据的读取
						dataType:'json', //预期的服务器响应的数据类型 
						data:{
							trid:trid,
							formname:'order',
								delpwd:delpwd
						},//规定要发送到服务器的数据
						success:function(s){
						   if(s.code==1){
							  //执行表格重载
							  layer.msg(`<?php echo $languageObj['删除成功']['name_' . $language]; ?>`, {
							                  icon:1,
							                  shade: 0.05,
							                  time: 800
							              },function(){
											   table.reload('currentTableId'); 
										  });
							 
						   }else if(s.code==5){
							 layer.msg(`<?php echo $languageObj['密码错误']['name_' . $language]; ?>`, {
							                 icon:2,
							                 shade: 0.05,
							                 time: 800
							             });
							   return false;
						   }else{
							    layer.msg(`<?php echo $languageObj['删除失败']['name_' . $language]; ?>`);
						   }
							
						}
					 }) //ajax
                });
            }
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
		