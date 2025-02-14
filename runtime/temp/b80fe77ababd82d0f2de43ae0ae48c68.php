<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:85:"/www/wwwroot/tb.youanfutang.cn/public/../application/admin/view/admin/page/index.html";i:1715412707;s:65:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/layout.html";i:1658590062;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/header.html";i:1658677912;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/footer.html";i:1658590072;}*/ ?>

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
	h5{font-size: 100%;margin: 0;}
	.layui-tab-title li{
		    padding: 0 20px!important;
	}
	
   iframe .c-ffffff a {
	    color: #565353!important;
	    font-size: 10px;
	}
</style>
<body class="layui-layout-body layuimini-all">
<div class="layui-layout layui-layout-admin">

    <div class="layui-header header">
        <div class="layui-logo layuimini-logo"></div>

        <div class="layuimini-header-content">
            <a>
                <div class="layuimini-tool"><i title="open" class="fa fa-outdent" data-side-fold="1"></i></div>
            </a>

            <!--电脑端头部菜单-->
            <ul class="layui-nav layui-layout-left layuimini-header-menu layuimini-menu-header-pc layuimini-pc-show">
				
            </ul>
           
            <!--手机端头部菜单-->
            <ul class="layui-nav layui-layout-left layuimini-header-menu layuimini-mobile-show">
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="fa fa-list-ul"></i> <?php echo $languageObj['选择模块']['name_' . $language]; ?></a>
                    <dl class="layui-nav-child layuimini-menu-header-mobile">
                    </dl>
                </li>
            </ul>

            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item" >
                    <a href="javascript:indexurl();" style="background-color: white;" ><i class="fa fa-home"></i></a>
                </li>
				<script type="text/javascript">
				
					function indexurl(){
						layer.msg('loading...', {
						                icon:16,
						                shade: 0.05,
						                time: 800
						            },function(){
										
								window.open("/","top");
									}
									
									);
					}
			
				
				</script>
                <li class="layui-nav-item" id="refresh" lay-unselect>
                    <a href="javascript:;"  data-refresh="刷新"><i class="fa fa-refresh"></i></a>
                </li>
                <li class="layui-nav-item" lay-unselect>
                    <a href="javascript:;" data-clear="清理" class="layuimini-clear"><i class="fa fa-trash-o"></i></a>
                </li>
				
				
                <li class="layui-nav-item mobile layui-hide-xs" lay-unselect>
                    <a href="javascript:;" data-check-screen="full"><i class="fa fa-arrows-alt"></i></a>
                </li>
				

                <li class="layui-nav-item" lay-unselect>
                    <a href="javascript:;" layuimini-content-href="admin/loadright?page=language" data-title="<?php echo $languageObj['语言配置']['name_' . $language]; ?>" title="<?php echo $languageObj['语言配置']['name_' . $language]; ?>"><i class="fa fa-language"></i></a>
                </li>


                <li class="layui-nav-item layuimini-setting">
                    <a href="javascript:;">
                        <?php if($language == 'pt'): ?>
                        <?php echo $languageObj['葡萄牙语']['name_' . $language]; else: ?>
                        <?php echo $languageObj['中文']['name_' . $language]; endif; ?>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <?php if($language != 'zh'): ?><a href="javascript:;" data-lang="zh" class="setLang"><?php echo $languageObj['中文']['name_' . $language]; ?></a><?php endif; if($language != 'pt'): ?><a href="javascript:;" data-lang="pt" class="setLang"><?php echo $languageObj['葡萄牙语']['name_' . $language]; ?></a><?php endif; ?>
                        </dd>
                    </dl>
                </li>

                <script>
                    $(".setLang").click(function() {
                        $.get("/login.php/language/setLang?lang=" + $(this).attr('data-lang'), function(res) {
                            location.reload()
                        })
                    })
                </script>
				
                <li class="layui-nav-item layuimini-setting">
                    <a href="javascript:;"><img src="<?php echo $ico; ?>" class="layui-nav-img"><?php echo $user; ?></a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" layuimini-content-href="admin/loadright?page=basic" data-title="基本资料" data-icon="fa fa-gears"><?php echo $languageObj['基本资料']['name_' . $language]; ?><span class="layui-badge-dot"></span></a>
                        </dd>
                        <dd>
                            <a href="javascript:;" layuimini-content-href="admin/loadright?page=modifypw" data-title="修改密码" data-icon="fa fa-gears"><?php echo $languageObj['修改密码']['name_' . $language]; ?></a>
                        </dd>
                        <dd>
                            <hr>
                        </dd>
                        <dd>
                            <a href="javascript:;" class="login-out"><?php echo $languageObj['退出登录']['name_' . $language]; ?></a>
                        </dd>
                    </dl>
                </li>
             <li class="layui-nav-item layuimini-select-bgcolor" lay-unselect>
                 <a href="" ></a>
             </li>
            </ul>
        </div>
    </div>

    <!--无限极左侧菜单-->
    <div class="layui-side layui-bg-black layuimini-menu-left">
    </div>

    <!--初始化加载层-->
    <div class="layuimini-loader">
        <div class="layuimini-loader-inner"></div>
    </div>

    <!--手机端遮罩层-->
    <div class="layuimini-make"></div>

    <!-- 移动导航 -->
    <div class="layuimini-site-mobile"><i class="layui-icon"></i></div>

    <div class="layui-body">

        <div class="layuimini-tab layui-tab-rollTool layui-tab" lay-filter="layuiminiTab" lay-allowclose="true">
            <ul class="layui-tab-title">
                <li class="layui-this" id="layuiminiHomeTabId" lay-id=""></li>
            </ul>
            <div class="layui-tab-control">
                <li class="layuimini-tab-roll-left layui-icon layui-icon-left"></li>
                <li class="layuimini-tab-roll-right layui-icon layui-icon-right"></li>
                <li class="layui-tab-tool layui-icon layui-icon-down">
                    <ul class="layui-nav close-box">
                        <li class="layui-nav-item">
                            <a href="javascript:;"><span class="layui-nav-more"></span></a>
                            <dl class="layui-nav-child">
                                <dd><a href="javascript:;" layuimini-tab-close="current">关 闭 当 前</a></dd>
                                <dd><a href="javascript:;" layuimini-tab-close="other">关 闭 其 他</a></dd>
                                <dd><a href="javascript:;" layuimini-tab-close="all">关 闭 全 部</a></dd>
                            </dl>
                        </li>
                    </ul>
                </li>
            </div>
            <div class="layui-tab-content">
                <div id="layuiminiHomeTabIframe" class="layui-tab-item layui-show"></div>
            </div>
        </div>

    </div>
</div>


<script src="/static/layui/admin/layuimini/js/lay-config.js?v=2.0.0" charset="utf-8"></script>
<script>
    layui.use(['jquery', 'layer', 'miniAdmin','miniTongji'], function () {
        var $ = layui.jquery,
            layer = layui.layer,
            miniAdmin = layui.miniAdmin,
            miniTongji = layui.miniTongji;

        var options = {
            iniUrl: "/login.php/base/getSystemInit",    // 初始化接口
            clearUrl: "/static/layui/admin/layuimini/api/clear.json", // 缓存清理接口
            urlHashLocation: true,      // 是否打开hash定位
            bgColorDefault: false,      // 主题默认配置
            multiModule: true,          // 是否开启多模块
            menuChildOpen: false,       // 是否默认展开菜单
            loadingTime: 0,             // 初始化加载时间
            pageAnim: true,             // iframe窗口动画
            maxTabNum: 20,              // 最大的tab打开数量
        };
        miniAdmin.render(options);
      setTimeout(function(){var htmlpc=$(".layuimini-menu-header-pc").html();
       htmlpc=htmlpc+'<div data-menu="multi_module_2" style="float:right;width: 190px;height: 60px;;line-height:85px;color:black"><iframe allowtransparency="true" frameborder="0" width="180" height="36" scrolling="no" src="//tianqi.2345.com/plugin/widget/index.htm?s=3&z=2&t=1&v=0&d=2&bd=0&k=000000&f=000000&ltf=009944&htf=cc0000&q=0&e=1&a=1&c=54511&w=180&h=36&align=center"></iframe></div>';
      
       $(".layuimini-menu-header-pc").html(htmlpc);},2000);

       

		
		$(".login-out").click(function() {
		
			layer.confirm(`<?php echo $languageObj['确定要退出吗？']['name_' . $language]; ?>`, {
				icon: 3,
				title: `<?php echo $languageObj['提示']['name_' . $language]; ?>`
			}, function(index) {
		
		
				$.ajax({
					type: 'POST', // 规定请求的类型（GET 或 POST）
					url: 'admin/clearcookie', // 请求的url地址
					cache: true, // 否在缓存中读取数据的读取
					dataType: 'json', //预期的服务器响应的数据类型 
					data: {
						clear: "clearcookie",
		
					}, //规定要发送到服务器的数据
		
					success: function(result) { // 当请求成功时运行的函数
		
						layer.msg(`<?php echo $languageObj['正在退出...']['name_' . $language]; ?>`, {
							icon: 16,
							shade: 0.05,
							time: 1000
						}, function() {
							window.location.href = "/login.php";
						});
		
		
		
					},
					error: function(result) { //失败的函数
						layer.msg('fail', {
							icon: 5,
							shade: 0.05,
							time: 800
						});
		
		
		
		
					}
		
				}); //ajax-end
		
				layer.close(index);
			});
		
		
		
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
		