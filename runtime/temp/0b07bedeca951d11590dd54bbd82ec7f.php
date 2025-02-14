<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"/www/wwwroot/tb.youanfutang.cn/public/../application/index/view/index/orderlist.html";i:1714225148;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
            <div></div>
        </div>
		<script>
			$(".selpro").click(function(){
				window.location.href='?p=product&sel='+$(".seach input").val();
			})
		</script>
        <ul class="nav-ul main display display-center">
            <li class="nav-li">
                <a href="?p=index">Página inicial</a>
            </li>
            <li class="nav-li">
                <a href="?p=product">Todos os produtos</a>
            </li>
            <li class="nav-li">
                <a href="?p=cart" class="nav-active">carrinho de compras</a>
            </li>
            <li class="nav-li">
                <a href="?p=my">Sobre nós</a>
            </li>
        </ul>
    </header>
    <div class="page-img">
        <!--<img src="/static/page/image/product.jpg" alt="">-->
    </div>
    <div class="kong kong1"></div>
    <div class="main">

     <style>
.layui-table tbody tr:hover, .layui-table thead tr, .layui-table-click, .layui-table-header, .layui-table-hover, .layui-table-mend, .layui-table-patch, .layui-table-tool, .layui-table-total, .layui-table-total tr, .layui-table[lay-even] tr:nth-child(even) {
    background-color: #ffffff;
}

   .layui-table-box tbody .layui-table-cell{line-height: 90px!important;height: 90px!important;  text-align:center!important;} /* layui内容区域设置 */
   
</style>
<div class="layuimini-container">
    <div class="layuimini-main">

   

        <script type="text/html" id="toolbarDemo">
            <div class="layui-btn-container">
            
      
            </div>
        </script>

        <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>

        <script type="text/html" id="currentTableBar">
       
              <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="edit">审核货物</a>
  <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="shouhuo">确认收货</a>
        </script>

    </div>
</div>
<style type="text/css">
	.editmem{display: none;padding-top: 20px;}
	.editmem>div{width: 90%;margin: auto;height: 45px;line-height: 45px;}
	.editmem select{width: 70%; height: 35px;padding-left: 10px;}
	.editmem input{height: 35px;width: 67%;padding-left: 5px;}
	.submitedit{display: block;margin:20px auto;}
</style>
<div class="editmem">
	<div><span>付款状态：</span>
	    <select name="status">
		<option value="未付款">未付款</option>
		<option value="已付款">已付款</option>
	</select>
	</div>
		<div><span>配送状态：</span>
	    <select name="wuliu">
	        	<option value="未配送">未配送</option>
		<option value="配送中">配送中</option>
	
	</select>
	</div>

	
		<button type="button" class="layui-btn submitedit">保存信息</button>
	
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
						layer.msg('保存成功！', {
						                icon:1,
						                shade: 0.05,
						                time: 800
						            },function(){
										window.location.href='/login.php/admin/loadright?page=order';
									});
					}else{
						layer.msg('请勿选择相同状态！');
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
</style>
<script src="/static/layui/layui.all.js"></script>
<script>
    layui.use(['form', 'table'], function () {
        var $ = layui.jquery,
            form = layui.form,
            table = layui.table;

        table.render({
            elem: '#currentTableId',
            url: '/index.php/index/requ/memberorder?formname=order&memid=<?php echo $memid; ?>',
            toolbar: '#toolbarDemo',
            defaultToolbar: ['filter', 'exports', 'print', {
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [[
                // {type: "checkbox", width: 50},
                {field: 'Id', width: 100, title: '订单ID', sort: true},
                //{field: 'userid', width: 80, title: '用户Id'},
                {field: 'name', width: 100, title: '用户名字'},
                 //{field: 'orderid', width: 180, title: '订单编号', sort: true},
                {field: 'shouhuo', width:100, title: '收货地址'},
				
			    {field: 'prisum', width:100, title: '订单价格'},
				{field: 'trade', width:100, title: '订单号码'},
			     //{field: 'buyarr', width:250, title: '购买货物',edit:true},
				{field: 'trdate', width:120, title: '下单时间', sort: true},
				{field: 'status', width:100, title: '购买状态'},
				{field: 'wuliu', width:100, title: '配送状态'},
				{field: 'status2',  title: '订单状态',sort: true},
			
				  // ,{field: 'jiage', width:100,title: '二维码',templet: function(d) { return '<div class="qrcode" data='+d.jiage+' ></div>'; }}
                // {field: 'newssort', title: '排序', minWidth: 150},
                
                 {title: '操作', minWidth: 150, toolbar: '#currentTableBar', align: "center"}
            ]],
            limits: [50, 100, 150, 200, 250, 300],
            limit: 50,
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
			
            if (obj.event === 'add') {  // 监听添加操作
         
		         window.location.href="/login.php/admin/loadright?page=upkc&formname=order";
				 
            } else if (obj.event === 'delete') {  // 监听删除操作
                var checkStatus = table.checkStatus('currentTableId')
                    , data = checkStatus.data;
            
			console.log(data);
		    if(data==''){
				layer.msg('请选择数据！');
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
										formname:'order'
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
            if (obj.event === 'edit') {
           
           
           window.location.href='?p=order&trid='+trid;
           
           
           
            } else  if (obj.event === 'edithw') {

              window.location.href='/login.php/admin/loadright?page=edigwc&orderid='+trid;
			  
            } else if (obj.event === 'shouhuo') {

             layer.confirm('是否确认收货该订单?', {icon: 3, title:'提示'}, function(index){
                 $.post('/index.php/index/requ/shouhuo?trid='+trid,function(s){
                     
                     if(s.code==1){
                         
                         layer.msg('您已确认收货！');
                         window.location.reload();
                     }else{
                          layer.msg('请勿重复点击！');
                     }
                     
                     
                 });
                 
             })
			  
            }else if (obj.event === 'delete') {
                layer.confirm('真的删除行么！', function (index) {
                    obj.del();
                    layer.close(index);
					$.ajax({
						type:'post', // 规定请求的类型（GET 或 POST）
						url:'/login.php/newsad/newslist_del', // 请求的url地址
						cache:false,// 否在缓存中读取数据的读取
						dataType:'json', //预期的服务器响应的数据类型 
						data:{
							trid:trid,
							formname:'order'
						}//规定要发送到服务器的数据
					 }) //ajax
                });
            }
        });

    });
</script>

 
    
    </div>
  
    <div class="kong"></div>

  
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
    	
			
			
			
    	},//规定要发送到服务器的数据
    	
    	success: function(res){ // 当请求成功时运行的函数
    		if(res.code==1){
    			
    		 layer.msg('订单已提交！请等待站长确认！'); 
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
                        <h4>品质保证，服务周到</h4>
                    </li>
                    <li class="display">
                        <img src="/static/page/image/gou.png" alt="">
                        <h4>品种丰富，购物方便</h4>
                    </li>
                    <li class="display">
                        <img src="/static/page/image/song.png" alt="">
                        <h4>极速物料，超快配送</h4>
                    </li>
                    <li class="display">
                        <img src="/static/page/image/phone.png" alt="">
                        <h4>贴心售后，专业解答</h4>
                    </li>
                </ul>
            <!--    <ul class="display footer-ul footer-item2">
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
                <a href="?p=index" >
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <p>首页</p>
                </a>
            </li>
            <li>
                <a href="?p=classification">
                    <i class="fa fa-th-large" aria-hidden="true"></i>
                    <p>分类</p>
                </a>
            </li>
            <li>
                <a href="?p=cart" style="color: #ff5212;">
                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                    <p>购物车</p>
                </a>
            </li>
            <li>
                <a href="?p=my">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <p>我的</p>
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