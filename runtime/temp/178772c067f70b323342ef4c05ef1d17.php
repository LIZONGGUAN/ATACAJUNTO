<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:87:"/www/wwwroot/tb.youanfutang.cn/public/../application/admin/view/admin/page/huishou.html";i:1715435362;s:65:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/layout.html";i:1658590062;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/header.html";i:1658677912;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/footer.html";i:1658590072;}*/ ?>

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
	
.layui-table-cell,.laytable-cell-1-0-3,.layui-table img{height:auto;max-height:85px;}
.layui-table img{max-width: 85px;}
	::-webkit-scrollbar {
		display: block;
		width: 15px;
		height: 15px;
		cursor: pointer;
	}

	::-webkit-scrollbar-thumb {
		background-color: rgba(193, 193, 193, 1);
		border-radius: 1em !important;

	}

	::-webkit-scrollbar-thumb:hover {
		background-color: rgba(157, 157, 157, 1.0);
	}

	/* .layui-table-cell{border: 1px solid red;} */
	.layui-table td,
	.layui-table th {
		padding: 4px !important;
	}
	.layui-table-page>div {
	    height: 35px;
	   
		padding: 6px 0px;
	}
</style>
<div class="layuimini-container">
    <div class="layuimini-main">

  <!--      <fieldset class="table-search-fieldset">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">内容标题</label>
                            <div class="layui-input-inline">
                                <input type="text" name="username" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                    
                        <div class="layui-inline">
                            <button type="submit" class="layui-btn layui-btn-primary"  lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset> -->

        <script type="text/html" id="toolbarDemo">
            <div class="layui-btn-container">
              <!-- <button class="layui-btn layui-btn-normal layui-btn-sm data-add-btn" lay-event="add"> 添加 </button> -->
               <!-- <button class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn" lay-event="delete"> 批量删除 </button> -->
			   <button class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn" lay-event=""> <?php echo $languageObj['回收站列表']['name_' . $language]; ?> </button> 
            </div>
        </script>

        <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>

        <script type="text/html" id="currentTableBar">
            <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="edit"><?php echo $languageObj['回收']['name_' . $language]; ?></a>
            <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete"><?php echo $languageObj['删除']['name_' . $language]; ?></a>
        </script>

    </div>
</div>
<script src="/static/layui/layui.all.js"></script>
<script>
 let trid='';
 let formname="";
    layui.use(['form', 'table'], function () {
        var $ = layui.jquery,
            form = layui.form,
            table = layui.table;

        table.render({
            elem: '#currentTableId',
            url: '/login.php/admin/huishou',
            toolbar: '#toolbarDemo',
            defaultToolbar: ['filter', 'exports', 'print', {
                title: `<?php echo $languageObj['提示']['name_' . $language]; ?>`,
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
			height: 'full-165',
            cols: [[
                // {type: "checkbox", width: 50},
                {field: 'Id', width: 60, title: 'ID', sort: true},
                {field: 'name', width: 200, title: `<?php echo $languageObj['回收名称']['name_' . $language]; ?>` },
				{field: 'hsc', width: 150, title: `<?php echo $languageObj['数据类型']['name_' . $language]; ?>`, sort: true},
				// {field: 'img', width:150,title: '用户照片',templet: function(d) { return '<div class="qrcode" ><img id="img_preview" src="'+d.img+'" width="100%" height="80px" /></div>'; }},
                {field: 'hstime', width:300, title: `<?php echo $languageObj['删除时间']['name_' . $language]; ?>`, sort: true},
				// {field: 'user', width: 150, title: '操作账号'},
				{field: 'hsip', width: 150, title: `<?php echo $languageObj['操作IP']['name_' . $language]; ?>`},
				// {field: 'dizhi', width: 150, title: '地址'},
				// {field: 'sh', width: 150, title: '公司税号'},
				// {field: 'bh', width: 150, title: '州税编号'},
				// {field: 'bh', width: 150, title: '州税编号'},
				//  {field: 'yg', width: 150, title: '所属员工', sort: true},
			 //    {field: 'provive', title: '地址'},
				//{field: 'user', title: '用户账号'},
                
				  // ,{field: 'jiage', width:100,title: '二维码',templet: function(d) { return '<div class="qrcode" data='+d.jiage+' ></div>'; }}
                {field: 'hsz', title: `<?php echo $languageObj['状态']['name_' . $language]; ?>`, minWidth: 150},
                
                 {title: `<?php echo $languageObj['操作']['name_' . $language]; ?>`,  toolbar: '#currentTableBar',minWidth: 200, align: "center"}
            ]],
            limits: [100, 200, 300, 400, 500],
            limit: 100,
            page: true,
            skin: 'line'
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
			 var tr = obj.tr; //获得当前行 tr 的 DOM 对象（如果有的话）
			  trid=$($(tr).find('td')[3]).text();
			 
            if (obj.event === 'add') {  // 监听添加操作
         
		        layer.open({
		                          title: `<?php echo $languageObj['添加用户']['name_' . $language]; ?>`,
		                          type: 1,
		                          shade: 0.2,
		                          maxmin:true,
		        					anim:1,
		                          shadeClose: true,
		                          area: ['600px', '600px'],
		                          content: $('.addmem')
		        				   
		                      });
				 
            } else if (obj.event === 'delete') {  // 监听删除操作
                var checkStatus = table.checkStatus('currentTableId')
                    , data = checkStatus.data;
            
			console.log(data);
		    if(data==''){
				layer.msg(`<?php echo $languageObj['请选择数据']['name_' . $language]; ?>`);
			}else{
				layer.confirm(`<?php echo $languageObj['删除选中的数据吗']['name_' . $language]; ?>`,function(index){
				  layer.close(index);
								 $.ajax({
								 	type:'post', // 规定请求的类型（GET 或 POST）
								 	url:'/login.php/newsad/newslist_del', // 请求的url地址
								 	cache:false,// 否在缓存中读取数据的读取
								 	dataType:'json', //预期的服务器响应的数据类型 
								 	data:{
								 		data:data,
										formname:'member'
								 	},//规定要发送到服务器的数据
									success:function(){
									
										//执行表格重载
										table.reload('currentTableId');
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
			 trid=$($(tr).find('td')[0]).text();
			 formname=$($(tr).find('td')[2]).text();
            if (obj.event === 'edit') {
				  layer.confirm('确定要回收该数据吗？', function (index) {
					  
					  $.ajax({
					  					type:'post', // 规定请求的类型（GET 或 POST）
					  					url:'/login.php/admin/hsstatus', // 请求的url地址
					  					cache:false,// 否在缓存中读取数据的读取
					  					dataType:'json', //预期的服务器响应的数据类型 
					  					data:{
					  						trid:trid,
					  						formname:formname
					  					},//规定要发送到服务器的数据
					  					success:function(){
					  					  layer.msg('回收成功！', {
					  					                  icon:1,
					  					                  shade: 0.05,
					  					                  time: 800
					  					              },function(){
					  									  
					  								//执行表格重载
					  								table.reload('currentTableId');	  
					  								  });
					  					
					  					}
					  				 }) //ajax
				  });
				

					 
					 
			  
            } else if (obj.event === 'delete') {
                layer.confirm('真的删除行么！', function (index) {
                    obj.del();
                    layer.close(index);
					$.ajax({
						type:'post', // 规定请求的类型（GET 或 POST）
						url:'/login.php/admin/huishoudel', // 请求的url地址
						cache:false,// 否在缓存中读取数据的读取
						dataType:'json', //预期的服务器响应的数据类型 
						data:{
							trid:trid,
							formname:formname
						}//规定要发送到服务器的数据
					 }) //ajax
                });
            }
        });

    });
</script>

<style type="text/css">
	.editmem{display: none;padding-top: 20px;}
	.editmem>div{width: 90%;margin: auto;height: 45px;line-height: 45px;}
	.editmem select{width: 70%; height: 35px;padding-left: 10px;}
	.editmem input{height: 35px;width: 67%;padding-left: 5px;}
	.submitedit{display: block;margin:20px auto;}
</style>
<div class="editmem">
	<div><span>用户状态：</span>
	    <select name="status">
		<option value="正常用户">正常用户</option>
		<option value="停用用户">停用用户</option>
	</select>
	</div>
	<div><span>重置密码：</span>
	    <input type="text" class="text" name="pw" value="" placeholder="&nbsp;&nbsp;输入内容后重置生效">
	</div>
	
		<button type="button" class="layui-btn submitedit">保存信息</button>
	
</div>

<script type="text/javascript">
	$(function(){
		
		$(".submitedit").click(function(){
			var status=$('select[name="status"]').val();
			var pw=$('input[name="pw"]').val();
			if(pw!==''){
				if(pw.length<6){
					layer.msg('密码不能小于6位数！');
					return false;					
				}
			};
		
			$.ajax({
				type:'post', // 规定请求的类型（GET 或 POST）
				url:'/login.php/admin/memberapi', // 请求的url地址
				cache:false,// 否在缓存中读取数据的读取
				dataType:'json', //预期的服务器响应的数据类型 
				data:{
					trid:trid,
					status:status,
					pw:pw,
					resign:'更改状态'
				},//规定要发送到服务器的数据
				success:function(res){
					if(res.code==1){
						layer.msg('保存成功！', {
						                icon:1,
						                shade: 0.05,
						                time: 800
						            },function(){
										window.location.href='/login.php/admin/loadright?page=member';
									});
					}
					
				}
			 }) //ajax
			
			
		})
		
	})
</script>

<style>
	.addmem{width: 500px;height: 900px;margin: auto;}
	.addmem input{margin-top:10px ;}
</style>
<div class="addmem" style="display: none;">
	<br>
	<input type="text" value="" placeholder="请输入账号" name="adduser" class="layui-input">
	<input type="text" value="" placeholder="请输入密码" name="addpwd" class="layui-input">
	<input type="text" value="" placeholder="请输入姓名" name="addname" class="layui-input">
	<input type="text" value="" placeholder="请输入联系电话" name="addtel" class="layui-input">
	<input type="text" value="" placeholder="请输入邮编" name="addemail" class="layui-input">
	<input type="text" value="" placeholder="请输入地址" name="adddizhi" class="layui-input">
	<input type="text" value="" placeholder="请输入公司税号" name="addsh" class="layui-input">
	<input type="text" value="" placeholder="请输入州税编号" name="addbh" class="layui-input">
	<input type="text" value="" placeholder="请输入所属员工" name="yg" class="layui-input">
	<button class="layui-btn layui-bg-cyan" id="adduser" style="margin:10px auto;display: block;">新增账号</button>
	
</div>

<script>
	$("#adduser").click(function(){
		
		var user=$('input[name="adduser"]').val();
		var pwd=$('input[name="addpwd"]').val();
		var name=$('input[name="addname"]').val();
		var tel=$('input[name="addtel"]').val();
		var email=$('input[name="addemail"]').val();
		var dizhi=$('input[name="adddizhi"]').val();
		var sh=$('input[name="addsh"]').val();
		var bh=$('input[name="addbh"]').val();
		var yg=$('input[name="yg"]').val();
	    
		if(!user){
			layer.msg('请添加账号！');
			return false;
		}
		if(!pwd){
			layer.msg('请添加密码！');
			return false;
		}
		if(!name){
			layer.msg('请添加名称！');
			return false;
		}
		if(!tel){
			layer.msg('请添加电话号码！');
			return false;
		}
		if(!email){
			layer.msg('请添加邮箱！');
			return false;
		}
		if(!dizhi){
			layer.msg('请添加地址！');
			return false;
		}
		if(!sh){
			layer.msg('请添加税号！');
			return false;
		}
		if(!bh){
			layer.msg('请添加编号！');
			return false;
		}
		if(!yg){
			layer.msg('请添加所属员工！');
			return false;
		}
		$.ajax({
			type:'POST', // 规定请求的类型（GET 或 POST）
			url:'/login.php/admin/memberapi', // 请求的url地址
			cache:true,// 否在缓存中读取数据的读取
			dataType:'json', //预期的服务器响应的数据类型 
			data:{
				resign:"adduser",
				user:user,
				pwd:pwd,
				name:name,
				phone:tel,
				email:email,
				dizhi:dizhi,
				sh:sh,
				bh:bh,
				yg:yg
			},//规定要发送到服务器的数据
			
			success: function(res){ // 当请求成功时运行的函数
				if(res.code==1){
					
					layer.msg('保存成功！', {
					                icon:1,
					                shade: 0.05,
					                time: 800
					            },function(){
									window.location.realod();
								});
				}else{
					layer.msg('保存失败！', {
					                icon:2,
					                shade: 0.05,
					                time: 800
					            });
					
				}
				
				
				
				
				
			},
			error:function(result){ //失败的函数
			layer.msg('服务器链接失败！', {
			                icon:2,
			                shade: 0.05,
			                time: 800
			            });
					
					
					
					
			}
			
		})//ajax-end
	})
</script>


</body>
</html>

<div class="wxfxanli-con" style="display: none;text-align: center;">
	             <b style="font-size: 22px;margin: 10px 0px;display: block;">案例1</b>
				 
				<img width="90%" style="display: block;margin: auto;" src="/static/img/admin/wxfx.png" >
				   <b style="font-size: 22px;margin: 10px 0px;display: block;">案例2</b>
				<img width="90%" style="display: block;margin: auto;" src="/static/img/admin/pyqfx.png" >
</div>
		