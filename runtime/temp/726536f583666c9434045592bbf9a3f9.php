<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:92:"/www/wwwroot/tb.youanfutang.cn/public/../application/admin/view/admin/table_edi/editpro.html";i:1715908510;s:65:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/layout.html";i:1658590062;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/header.html";i:1658677912;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/footer.html";i:1658590072;}*/ ?>

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
	.news {
		width: 100%;
		margin-top: 30px;
		height: auto;
		min-height: 1750px;
		border: 1px solid gainsboro;
	}

	#news_class {
		width: 80%;
	}

	#news_class>span {
		color: #606266;
		font-size: 14px;
		width: 100px;
		display: inline-block;
		text-align: center;
		min-width: 100px;
	}

	#news_class>select {
		width: 80%;
		display: inline-block;
		border: 1px solid #dcdfe6;
		height: 40px;
		padding-left: 10px;
		margin-left: -3px;
		margin-bottom: 20px;
	}

	#news_title,
	#pics {
		width: 80%;
	}

	#pics {
		margin-top: 20px;
		min-height: 50px;
		height: auto;
	}

	#news_title>span,
	#pics>span {
		color: #606266;
		font-size: 14px;
		width: 100px;
		display: inline-block;
		text-align: center;
		min-width: 100px;
	}

	#news_title>input {
		width: 80%;
		display: inline-block;
		border: 1px solid #dcdfe6;
		height: 30px;
		padding-left: 10px;
	}

	#news_jianjie {
		width: 80%;
		margin-top: 50px;
	}

	#news_jianjie>span {
		color: #606266;
		font-size: 14px;
		width: 20%;
		;
		width: 100px;
		display: inline-block;
		text-align: center;
		min-width: 100px;
	}

	#news_jianjie>textarea,
	#bianhao {
		width: 80%;
		display: inline-block;
		border: 1px solid #dcdfe6;
		height: 100px;
		padding-left: 10px;
		margin-top: -20px;
	}

	#news_slt {
		width: 80%;
		margin: 30px 0px;
		min-height: 100px;
		max-height: 250px;
		cursor: pointer;
	}

	#news_slt>span {
		float: left;
		color: #606266;
		font-size: 14px;
		width: 20%;
		;
		width: 100px;
		display: inline-block;
		text-align: center;
		min-width: 100px;
	}

	#zx_img {
		opacity: 0;
		width: 100px;
		height: 100px;
		;
		margin-top: -100px;
		z-index: 999;
		position: absolute;
	}

	#img_preview,
	#slide-pc {
		/* margin-left: 100px;margin-top: -20px; */
		border: 1px solid #dcdfe6
	}


	/* #edui1140_iframeholder{height: 100%!important;} */
	#news_sub {
		width: 80%;
		text-align: right;
		margin-top: 150px;
		height: 150px;
		margin-bottom: 0px;
	}

	#news_submit {
		border: 0;
		width: 100px;
		height: 40px;
		color: white;
		background-color: rgba(0, 150, 136, 1);
		border-radius: 8px;
		cursor: pointer;
		margin-right: 10%;
		float: right;
	}

	#news_time,
	#news_view,
	#news_sort {
		width: 80%;
		margin-top: 30px;
	}

	#news_time>span,
	#news_view>span,
	#news_sort>span {
		color: #606266;
		font-size: 14px;
		;
		width: 100px;
		display: inline-block;
		text-align: center;
		min-width: 100px;
	}

	#news_time>input,
	#news_view>input,
	#news_sort>input {
		width: 80%;
		display: inline-block;
		border: 1px solid #dcdfe6;
		height: 30px;
		padding-left: 10px;
	}

	select {
		cursor: pointer;
	}

	div>i {
		cursor: pointer;
	}

	.layui-form-checkbox>span {
		background-color: white;
		color: #0a0a0a;
		border: 1px solid rgb(210, 210, 210);
	}

	.layui-form-checkbox>i {
		height: 30px;
	}

	.layui-form-checked>span {
		background-color: #5FB878 !important
	}

	#slide-pc-priview .item_img img {
		width: 200px !important;
		height: 200px !important;
	}

	.pic-more li {
		width: 200px !important;
	}

	#slide-pc-priview li .toleft {

		top: 100px !important;

	}

	#slide-pc-priview li .toright {

		top: 100px !important;

	}
</style>

<div class="news">
	<div class="headertip">
		<li><?php echo $languageObj['信息发布']['name_' . $language]; ?></li>
	</div>
	<li class="layui-btn layui-btn-primary fanhui" style="margin:0px 0px 20px 100px "><?php echo $languageObj['返回上一页']['name_' . $language]; ?></li>
	 <script type="text/javascript" charset="utf-8">
	     $(".fanhui").click(function(){
	        window.history.back(-1);
	     })
	 </script>
	<div id="news_class">
		<span><?php echo $languageObj['产品大类']['name_' . $language]; ?>：</span>
		<select name="" id="newsclass">


		</select>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function () {
				$.post("/login.php/newsad/newsclass?formname=productc", function (str) {
					let htmlclass = '<option  value="<?php echo $newsclass; ?>"><?php echo $newsclass; ?></option>';
					console.log(str);
					str.forEach(x => {


						htmlclass += `<option  value='${x.name}'>${x.name}</option>`;

					});
					$("#newsclass").html(htmlclass);
					$("#newsclass option").each(function () {

						var getText = $(this).text();

						if ($("#newsclass option:contains(" + getText + ")").length > 1)   /*作用:select option:contains("+text+")")包含text的个数 */ {

							$("#newsclass option:contains(" + getText + "):gt(0)").remove();  /*作用:包含text大于个数0的选项就移除*/

						}

					})

				});



			})

		</script>
	</div>

	<!-- <div id="news_class">
<span>二级分类:</span>	
 <select name="" id="newsclass2">
		<option  value="<?php echo $detail['0']['ejclass']; ?>"><?php echo $detail['0']['ejclass']; ?></option>			
</select>

</div>


<script type="text/javascript">

	$.post("/login.php/newsad/newspage?form=productc&class=语文",function(str) {
				console.log(str);
				let htmlclass=''
				str.forEach(x=>{
				
				htmlclass +=`<option value ="${x.name}" class="语文">${x.name}</option>`;
				});
			$("#newsclass2").html(htmlclass);
			console.log(htmlclass);
			});

	$("#newsclass").click(function(){
		
		val=$(this).val();
		console.log(val);
		$.post("/login.php/newsad/newspage?form=productc&class="+val,function(str) {
				console.log(str);
				let htmlclass=''
				str.forEach(x=>{
				
				
				htmlclass +=`<option value ="${x.name}" class="'+val+'">${x.name}</option>`;
				});
			$("#newsclass2").html(htmlclass);
			console.log(htmlclass);
			});
	
	})  //一级分类点击 
	
	$("#newsclass2").click(function(){
		
		val=$(this).val();
		console.log(val);
		$.post("/login.php/newsad/newspage?form=productc&class="+val,function(str) {
				console.log(str);
				let htmlclass=''
				str.forEach(x=>{
				
				
				htmlclass +=`<option value ="${x.name}" class="'+val+'">${x.name}</option>`;
				});
			$("#newsclass3").html(htmlclass);
			console.log(htmlclass);
			});
	
	})  //2级分类点击 
	
	
</script> 

<div id="news_class">
<span>三级分类:</span>	
 <select name="" id="newsclass3">
		<option  value="<?php echo $detail['0']['sjclass']; ?>"><?php echo $detail['0']['sjclass']; ?></option>			
</select>

</div>

<script type="text/javascript">


</script> -->
	<style>
		.layui-form-checkbox {
			margin-top: 5px;
		}

		.classbk {
			border: 1px dotted gray;
			padding: 5px;
			margin-top: 10px
		}
	</style>
	<div id="news_class" style="width: 100%;">

		<div class="layui-form" style="display: flex;
    flex-wrap: wrap;display: none;padding-left: 12px;">


		</div>
		<button class="openclass layui-btn layui-bg-cyan" style="margin: 10px;"><?php echo $languageObj['展开分类列表']['name_' . $language]; ?></button>
	</div>

	<div style="opacity:0" class="hidechecked">
		<?php if(is_array($dxclass) || $dxclass instanceof \think\Collection || $dxclass instanceof \think\Paginator): $i = 0; $__LIST__ = $dxclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><i><?php echo $m; ?></i> <?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<script>



		var oepnclass = false;
		$(document).ready(function () {

			$(".openclass").click(function () {
				if (oepnclass == false) {
					$(".layui-form").show(800);
					$(this).text(`<?php echo $languageObj['隐藏分类列表']['name_' . $language]; ?>`);
					oepnclass = true;
				} else {
					$(".layui-form").hide();
					$(this).text(`<?php echo $languageObj['展开分类列表']['name_' . $language]; ?>`);
					oepnclass = false;
				}

			})



			$.post("/login.php/newsad/newsTree?formname=productc", function (str) {
				let oneclass = '';
				let twoclass = '';
				let threeclass = '';
				let formdiv = '';
				let funum = 0;
				let fuid = 'one';

				str.data.forEach(x => {
					//  console.log(x.name);
					if (x.level == 0) {
						// funum=1;
						if (fuid == 'one') {
							oneclass = `<?php echo $languageObj['一级分类']['name_' . $language]; ?>：<input type="checkbox" class="first" name="${x.name}" title="${x.name}" >`;
							fuid = x.Id;
						} else {

							formdiv += '<div class="classbk" >' + oneclass + `<br><br><?php echo $languageObj['二级分类']['name_' . $language]; ?>：` + twoclass + `<br><br><?php echo $languageObj['三级分类']['name_' . $language]; ?>：` + threeclass + '</div>';
							oneclass = '';
							twoclass = '';
							threeclass = '';


							oneclass = `<?php echo $languageObj['一级分类']['name_' . $language]; ?>：<input type="checkbox" class="first" name="${x.name}" title="${x.name}" >`;
						}


						funum++;

					};
					//   console.log(fuid)
					if (x.level == 1) {
						//   console.log(x.name)
						twoclass += `<input type="checkbox" class="second" lay-filter="second" name="${x.name}" title="${x.name}" >`;
					}

					if (x.level == 2) {
						//   console.log(x.name)
						threeclass += `<input type="checkbox" class="third" lay-filter="third" disabled name="${x.name}" title="${x.name}" >`;
					}


				});

				layui.use(['form'], function () {
					var form = layui.form,
						$ = layui.$;

					form.on('checkbox(second)', function (data) {
						if (data.elem.checked) {
							$(data.elem).parents(".classbk").find(".first").next(".layui-form-checkbox").addClass("layui-form-checked");
							$(data.elem).parents(".classbk").find(".third").next(".layui-form-checkbox").removeClass("layui-checkbox-disbaled");
							$(data.elem).parents(".classbk").find(".third").next(".layui-form-checkbox").removeClass("layui-disabled");
							$(data.elem).parents(".classbk").find(".third").removeAttr("disabled");
						} else {
							let flag = $(data.elem).parents(".classbk").find(".second").next(".layui-form-checkbox").hasClass("layui-form-checked");
							if (!flag) {
								$(data.elem).parents(".classbk").find(".first").next(".layui-form-checkbox").removeClass("layui-form-checked");
								$(data.elem).parents(".classbk").find(".third").next(".layui-form-checkbox").removeClass("layui-form-checked");
								$(data.elem).parents(".classbk").find(".third").next(".layui-form-checkbox").addClass("layui-checkbox-disbaled");
								$(data.elem).parents(".classbk").find(".third").next(".layui-form-checkbox").addClass("layui-disabled");
								$(data.elem).parents(".classbk").find(".third").attr("disabled", "");
							}
						}
					});
				});

				$("#news_class .layui-form").html(formdiv);

				$(".hidechecked i").each(function () {
					var itit = $(this).text();
					$(".layui-form input").each(function () {

						if (itit == $(this).attr('title')) {
							$(this).attr('checked', 'checked');
						}

					})


				})//把已选择的分类 选择上

				layui.use('form', function () {
					var form = layui.form;
					form.render(); //更新全部
					//各种基于事件的操作，下面会有进一步介绍
				});
			});
		})




	</script>

	<div id="news_title"><span><?php echo $languageObj['产品标题']['name_' . $language]; ?>：</span><input type="text" name="news_title" id="news_tit" value="<?php echo $news_tit; ?>"
			placeholder="" /></div>
	<div id="news_slt"><span><?php echo $languageObj['缩略图']['name_' . $language]; ?>：</span>
		<div style="float: left;"><img id="img_preview" src="<?php echo $news_slt; ?>" style="max-width: 300px;max-height: 120px">
		</div>
	</div>
	<!-- <div id="news_jianjie"><span>考试科目：</span><textarea rows="10" cols="50" id="news_jj"></textarea></div>	
 -->
	<style>
		.layui-upload-img {
			width: 90px;
			height: 90px;
			margin: 0;
		}

		.pic-more {
			width: 100%;
			margin: 10px 0px 0px 0px;
		}

		.pic-more li {
			width: 90px;
			float: left;
			margin-right: 5px;
		}

		.pic-more li .layui-input {
			display: initial;
		}

		.pic-more li a {
			position: absolute;
			top: 0;
			display: block;
		}

		.pic-more li a i {
			font-size: 24px;
			background-color: #008800;
		}

		#slide-pc-priview .item_img img {
			width: 90px;
			height: 90px;
		}

		#slide-pc-priview li {
			position: relative;
		}

		#slide-pc-priview li .operate {
			color: #000;
			display: none;
		}

		#slide-pc-priview li .toleft {
			position: absolute;
			top: 40px;
			left: 1px;
			cursor: pointer;
		}

		#slide-pc-priview li .toright {
			position: absolute;
			top: 40px;
			right: 1px;
			cursor: pointer;
		}

		#slide-pc-priview li .close {
			position: absolute;
			top: 5px;
			right: 5px;
			cursor: pointer;
		}

		#slide-pc-priview li:hover .operate {
			display: block;
		}

		.pic-more>span {
			float: left;
			color: #606266;
			font-size: 14px;
			width: 20%;
			width: 100px;
			display: inline-block;
			text-align: center;
			min-width: 100px;
		}
	</style>
	<div class="layui-form-item" id="pics">
		<span style="float: left;"><?php echo $languageObj['相册图集']['name_' . $language]; ?>：</span> <button type="button" class="layui-btn layui-btn-primary "
			id="slide-pc"><?php echo $languageObj['选择多图']['name_' . $language]; ?></button>
		<div class="layui-input-block" style="width: 100%;margin-left: 0px;">
			<div class="layui-upload">

				<div class="pic-more">
					<span>&nbsp;</span>
					<ul class="pic-more-upload-list" id="slide-pc-priview">
						<?php if(is_array($srcimg) || $srcimg instanceof \think\Collection || $srcimg instanceof \think\Paginator): $i = 0; $__LIST__ = $srcimg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
						<li class="item_img">
							<div class="operate"><i class="toleft layui-icon"></i><i class="toright layui-icon"></i><i
									class="close layui-icon"></i></div><img src="<?php echo $m; ?>" class="img"><input type="hidden"
								name="pc_src[]" value="<?php echo $m; ?>" />
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>

					</ul>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">

		// 多图上传
		layui.use('upload', function () {
			var $ = layui.jquery;
			var upload = layui.upload;
			upload.render({
				elem: '#slide-pc',
				url: '/login.php/admin/basicicoapi',// 多图上传
				size: 900,
				exts: 'jpg|png|jpeg|gif|bmp|webp',
				multiple: true,
				before: function (obj) {
					layer.msg('loading...', {
						icon: 16,
						shade: 0.01,
						time: 0
					})
				},
				done: function (res) {
					layer.close(layer.msg());//关闭上传提示窗口
					if (res.status == 0) {
						return layer.msg(res.message);
					}
					//$('#slide-pc-priview').append('<input type="hidden" name="pc_src[]" value="' + res.filepath + '" />');
					$('#slide-pc-priview').append('<li class="item_img"><div class="operate"><i class="toleft layui-icon"></i><i class="toright layui-icon"></i><i  class="close layui-icon"></i></div><img src="' + res.filepath + '" class="img" ><input type="hidden" name="pc_src[]" value="' + res.filepath + '" /></li>');
				}
			});
		});
		//点击多图上传的X,删除当前的图片    
		$("body").on("click", ".close", function () {
			$(this).closest("li").remove();
		});
		//多图上传点击<>左右移动图片
		$("body").on("click", ".pic-more ul li .toleft", function () {
			var li_index = $(this).closest("li").index();
			if (li_index >= 1) {
				$(this).closest("li").insertBefore($(this).closest("ul").find("li").eq(Number(li_index) - 1));
			}
		});
		$("body").on("click", ".pic-more ul li .toright", function () {
			var li_index = $(this).closest("li").index();
			$(this).closest("li").insertAfter($(this).closest("ul").find("li").eq(Number(li_index) + 1));
		});

	// 多图上传
	</script>
	<!-- <div id="news_jianjie"><span>产品简介：</span>
<textarea rows="10" cols="50" id="news_jj">

</textarea></div> -->
	<style type="text/css">
		.taocan {
			width: 80%;
		}

		.product {
			width: 100%;
			margin: 20px 0px;
		}

		.tcdiv {
			height: 40px;
			line-height: 40px;
			margin-top: 20px;
			min-width: 1400px;
			display: flex
		}

		.tcdiv>span,
		.zwf {
			color: #606266;
			font-size: 14px;
			width: 100px;
			display: inline-block;
			text-align: center;
			min-width: 100px;
		}

		.tcdiv input {
			margin-right: 10px;
			padding-left: 10px;
		}

		.addpro {}

		.close {
			cursor: pointer;
		}
	</style>
	<div class="taocan">
		<div class="product guige">
			<?php if(is_array($taocan) || $taocan instanceof \think\Collection || $taocan instanceof \think\Paginator): $i = 0; $__LIST__ = $taocan;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
			<div class="tcdiv guigediv"><span><?php echo $languageObj['规格']['name_' . $language]; ?>：</span><i
					class="layui-icon-up layui-icon guige-up"></i> &nbsp;<i
					class="guige-dow layui-icon-down layui-icon"></i> &nbsp;<input style="width:40%" type="text"
					class="layui-input" name="proname" id="" placeholder="<?php echo $languageObj['规格的名称（不能为空）']['name_' . $language]; ?>" value="<?php echo $m['0']; ?>" /><input
					class="layui-input" style="width:60%" type="text" name="videosrc" id="" value="<?php echo $m['1']; ?>"
					placeholder="<?php echo $languageObj['规格参数（不能为空）']['name_' . $language]; ?>" /><i class="close layui-icon"></i></div>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="zwf"></div> <button class="layui-btn addpro2" type="button"><?php echo $languageObj['添加规格']['name_' . $language]; ?></button>
		<input id="fsmb" type="text" style="opacity: 0;">
	</div>
	<script type="text/javascript">
		//点击多图上传的X,删除当前的图片
		$("body").on("click", ".close", function () {
			$(this).closest("div").remove();
		});


		$(".addpro2").click(function () {
			$('.guige').append(`<div class="tcdiv guigediv"><span><?php echo $languageObj['规格']['name_' . $language]; ?>：</span><i class="layui-icon-up layui-icon guige-up"></i> &nbsp;<i class="guige-dow layui-icon-down layui-icon"></i> &nbsp;<input style="width:40%" type="text" class="layui-input" name="proname" id=""  placeholder="规格的名称（不能为空）"  value="" /><input  class="layui-input" style="width:60%" type="text" name="videosrc" id="" value="" placeholder="" /><i   class="close layui-icon"></i></div>`);
		})

		//规格点击<>上下移动图片
		$("body").on("click", ".guige-up", function () {
			var li_index = $(this).closest("div").index();

			if (li_index >= 1) {

				$(this).closest("div").insertBefore($(".guigediv").eq(Number(li_index) - 1));
			}
		});
		$("body").on("click", ".guige-dow", function () {

			var li_index = $(this).closest("div").index();
			console.log(li_index)
			$(this).closest("div").insertAfter($(".guigediv").eq(Number(li_index) + 1));
		});
	</script>

	<div class="taocan">
		<div class="product yanse">
			<?php if(is_array($yanse) || $yanse instanceof \think\Collection || $yanse instanceof \think\Paginator): $i = 0; $__LIST__ = $yanse;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
			<div class="tcdiv yanse-div"><span><?php echo $languageObj['颜色']['name_' . $language]; ?>：</span><i
					class="layui-icon-up layui-icon yanse-up"></i> &nbsp;<i
					class="yanse-dow layui-icon-down layui-icon"></i> &nbsp;<input style="width:40%" type="text"
					class="layui-input" name="proname" id="" placeholder="<?php echo $languageObj['颜色的名称（不能为空）']['name_' . $language]; ?>" value="<?php echo $m; ?>" /><i
					class="close layui-icon"></i></div>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="zwf"></div> <button class="layui-btn addpro3" type="button"><?php echo $languageObj['添加颜色']['name_' . $language]; ?></button>
		<input id="fsmb" type="text" style="opacity: 0;">
	</div>
	<script type="text/javascript">

		$(".addpro3").click(function () {
			$('.yanse').append(`<div class="tcdiv yanse-div"><span><?php echo $languageObj['颜色']['name_' . $language]; ?>：</span><i class="layui-icon-up layui-icon yanse-up"></i> &nbsp;<i class="yanse-dow layui-icon-down layui-icon"></i> &nbsp;<input style="width:40%" type="text" class="layui-input" name="proname" id=""  placeholder=""  value="" /><i   class="close layui-icon"></i></div>`);
		})
		//规格点击<>上下移动图片
		$("body").on("click", ".yanse-up", function () {
			var li_index = $(this).closest("div").index();

			if (li_index >= 1) {
				$(this).closest("div").insertBefore($(".yanse-div").eq(Number(li_index) - 1));
			}
		});
		$("body").on("click", ".yanse-dow", function () {

			var li_index = $(this).closest("div").index();
			console.log(li_index)
			$(this).closest("div").insertAfter($(".yanse-div").eq(Number(li_index) + 1));
		});
	</script>

	<div class="taocan">
		<div class="product xinghao">
			<?php if(is_array($xinghao) || $xinghao instanceof \think\Collection || $xinghao instanceof \think\Paginator): $i = 0; $__LIST__ = $xinghao;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
			<div class="tcdiv xinghao-div"><span><?php echo $languageObj['型号']['name_' . $language]; ?>：</span><i
					class="layui-icon-up layui-icon xinghao-up"></i> &nbsp;<i
					class="xinghao-dow layui-icon-down layui-icon"></i> &nbsp;<input style="width:40%" type="text"
					class="layui-input" name="proname" id="" placeholder="<?php echo $languageObj['型号的名称（不能为空）']['name_' . $language]; ?>" value="<?php echo $m['0']; ?>" /><input
					class="layui-input" style="width:60%" type="text" name="videosrc" id="" value="<?php echo $m['1']; ?>"
					placeholder="<?php echo $languageObj['价格（不能为空）']['name_' . $language]; ?>" /><i class="close layui-icon"></i></div>
			<?php endforeach; endif; else: echo "" ;endif; ?>

		</div>
		<div class="zwf"></div> <button class="layui-btn addpro4" type="button"><?php echo $languageObj['添加型号']['name_' . $language]; ?></button>
		<div class="zwf"></div> <button class="layui-btn layui-bg-red edixh" type="button"><?php echo $languageObj['批量修改型号价格']['name_' . $language]; ?></button><input placeholder="<?php echo $languageObj['批量价格']['name_' . $language]; ?>" type="text" class="edixhnum layui-input" style="width:100px;display: inline-block;margin-left: 10px;" value="">
		<input id="fsmb" type="text" style="opacity: 0;">
	</div>
	<script type="text/javascript">
        $(".edixh").click(function(){
			var edixhnum=$(".edixhnum").val();
			if(!edixhnum){
				layer.msg(`<?php echo $languageObj['请输入要批量的价格']['name_' . $language]; ?>`);
				return false;
			}
			$(".xinghao-div>input:nth-of-type(2)").each(function(){
			
				$(this).val(edixhnum);
				 layer.msg(`<?php echo $languageObj['修改成功']['name_' . $language]; ?>`);
				
			})
			
		})//批量修改型号价格



		$(".addpro4").click(function () {
			$('.xinghao').append(`<div class="tcdiv xinghao-div"><span><?php echo $languageObj['型号']['name_' . $language]; ?>：</span><i class="layui-icon-up layui-icon xinghao-up"></i> &nbsp;<i class="xinghao-dow layui-icon-down layui-icon"></i> &nbsp;<input style="width:40%" type="text" class="layui-input" name="proname" id=""  placeholder="型号的名称（不能为空）"  value="" /><input  class="layui-input" style="width:60%" type="text" name="videosrc" id="" value="" placeholder="" /><i   class="close layui-icon"></i></div>`);
		});
		//规格点击<>上下移动图片
		$("body").on("click", ".xinghao-up", function () {
			var li_index = $(this).closest("div").index();

			if (li_index >= 1) {
				$(this).closest("div").insertBefore($(".xinghao-div").eq(Number(li_index) - 1));
			}
		});
		$("body").on("click", ".xinghao-dow", function () {

			var li_index = $(this).closest("div").index();
			console.log(li_index)
			$(this).closest("div").insertAfter($(".xinghao-div").eq(Number(li_index) + 1));
		});
	</script>
	<div id="news_view"><span><?php echo $languageObj['产品价格']['name_' . $language]; ?>:</span><input type="text" class="layui-input" id="jiage" value="<?php echo $detail['0']['jiage']; ?>">
	</div>

	<div id="news_time"><span><?php echo $languageObj['发布时间']['name_' . $language]; ?>:</span><input type="text" class="layui-input" id="newstime"
			value="<?php echo $detail['0']['newstime']; ?>"></div>

	<script>
		var newstime = '';
		layui.use('laydate', function () {
			var laydate = layui.laydate;

			//执行一个laydate实例
			laydate.render({
				elem: '#newstime' //指定元素
				, done: function (value, date, endDate) {

					newstime = value;
				}
			});
		});
	</script>
	<div id="news_xq" style="    width: 100%;
    margin-top: 30px;"><span style="color: #606266;
    font-size: 14px;
   
    width: 100px;
    display: inline-block;
    text-align: center;

    min-width: 100px;
    float: left;"><?php echo $languageObj['产品介绍']['name_' . $language]; ?>:</span>
		<script id="editor" style=" 
    height: 600px;
    margin-bottom: 15px;
    display: inline-block;
    width: 90%;" type="text/plain" style=""><?php echo $detail['0']['news_editor']; ?></script>
	</div>



	<div id="news_sub"><button type="button" id="news_submit"><?php echo $languageObj['提交保存']['name_' . $language]; ?></button></div>
</div>

<script type="text/javascript">
	var news_slt = "";
	$(function () {

		UE.delEditor('editor');

		var ue = UE.getEditor('editor', {
			scaleEnabled: true,//设置不自动调整高度
			autoFloatEnabled: false, //取消悬浮
		});


	});



	// 利用layui来上传图片
	layui.use('upload', function () {
		var upload = layui.upload;

		//执行实例
		var uploadInst = upload.render({
			elem: '#img_preview' //绑定元素
			, url: '/login.php/admin/basicicoapi' //缩略图上传
			, exts: 'jpg|png|jpeg|gif|bmp|webp'
			, multiple: true
			, number: 5
			, drag: true
			, data: {

			}
			, before: function (obj) {
				//预读本地文件示例，不支持ie8
				layer.msg('loading...', {
					icon: 16,
					shade: 0.05,
					time: 500
				});
				;
			}
			, done: function (res) {
				//上传完毕回调
				$('#img_preview').attr('src', res.filepath);
				//  console.log(res.filepath); //图片文件的路径
				news_slt = res.filepath;//赋值给photo 传给ajax丢数据

			}
			, error: function (res) {
				//请求异常回调

				console.log(res);
			}
		});
	});


	// 利用layui来上传图片
	$(function () {

		$("#news_submit").click(function () {

			var datafl = new Array();
			$(".layui-form input[type='checkbox']:checked").each(function () {
				checked = $(this).attr('title');
				datafl.push(checked);
			});
			console.log(datafl)

			var news_slt = $("#img_preview").attr('src');

			var newsclass = $("#newsclass").val();
			var newssort = $("#newssort").val();
			var news_tit = $("#news_tit").val();
			var news_jj = $("#news_jj").val();
			var news_view = $("#view").val();

			var ejclass = $("#newsclass2").val();
			var sjclass = $("#newsclass3").val();
			//新增
			var jiage = $("#jiage").val();
			var bianhao = $("#bianhao").val();
			var daqu = $("#daqu").val();
			var fuwuqi = $("#fuwuqi").val();
			var leixing = $("#leixing").val();
			var dengji = $("#dengji").val();
			var xingbie = $("#xingbie").val();
			var menpai = $("#menpai").val();
			var shenshou = $("#shenshou").val();
			var yijia = $(".product .tcdiv:last-of-type()").find('input[name="proname"]').val();

			var editor = UE.getEditor('editor').getContent();

			var ifpay = $("#vip").val();




			//新增
			//获取多图src
			var si = 0;//多图的数目
			var srcimg = new Array();//创建JS数组
			$("#slide-pc-priview img").each(function () {
				src = $(this).attr("src");
				srcimg[si] = src;
				si++;

			})  //多图链接一条记录存储，前端用逗号分割循环输出。

			srcimg = JSON.stringify(srcimg)
			//获取产品目录src
			// var si=0;//多图的数目
			// var srcimg=new Array();//创建JS数组
			// $(".pic-more-upload-list input:nth-of-type(1)").each(function(){
			// 	src=$(this).val();
			// 	srcimg[si]=src;
			// 	si++;

			// })  //多图链接一条记录存储，前端用逗号分割循环输出。	

			// var sn=0;//多图的数目
			// var srcimg2=new Array();//创建JS数组
			// $(".pic-more-upload-list input:nth-of-type(2)").each(function(){
			// 	src2=$(this).val();
			// 	srcimg2[sn]=src2;
			// 	sn++;

			// })  //多图链接一条记录存储，前端用逗号分割循环输出。	

			// var srcimg3=new Array();//创建JS数组
			// srcimg3=[srcimg,srcimg2];
			//   videores=JSON.stringify(srcimg3);
			//   console.log(videores)


			var numpro = 0;
			var numi = 0;
			var json = {};
			var array = new Array();
			$(".guige input").each(function () {

				if (numpro < 2) {
					proval = $(this).val();
					json[numpro] = proval;
					if (numpro == 1) {
						array[numi] = JSON.stringify(json);
						numi++;
						numpro = 0;
					} else {
						numpro++;
					}

				}
			});
			//以上是规格封装数据过程

			var yansenumpro = 0;
			var yansenumi = 0;
			var yansejson = {};
			var yansearray = new Array();
			$(".yanse input").each(function () {

				yanseproval = $(this).val();
				yansejson[yansenumpro] = yanseproval;

				// yansenumi++;	
				yansenumpro++;
			});
			yansearray = JSON.stringify(yansejson);
			//以上是颜色封装数据过程

			var xinghaonumpro = 0;
			var xinghaonumi = 0;
			var xinghaojson = {};
			var xinghaoarray = new Array();
			$(".xinghao input").each(function () {

				if (xinghaonumpro < 2) {
					xinghaoproval = $(this).val();
					xinghaojson[xinghaonumpro] = xinghaoproval;
					if (xinghaonumpro == 1) {
						xinghaoarray[xinghaonumi] = JSON.stringify(xinghaojson);
						xinghaonumi++;
						xinghaonumpro = 0;
					} else {
						xinghaonumpro++;
					}

				}
			});
			//以上是型号封装数据过程



			if (!news_tit || !newsclass || !jiage || !editor || !news_slt) {
				layer.msg(`<?php echo $languageObj['请填写完整信息']['name_' . $language]; ?>`);
				return false;
			};

			$.ajax({
				type: 'POST', // 规定请求的类型（GET 或 POST）
				url: '/login.php/newsad/upnews?formname=product', // 请求的url地址
				cache: true,// 否在缓存中读取数据的读取
				dataType: 'json', //预期的服务器响应的数据类型 
				data: {
				
					new_delid:<?php echo $Id; ?>,
					ifupdate: "update",
					news_tit: news_tit,
					news_jj: news_jj,
					ifpay: ifpay,
					news_slt: news_slt,
					newsclass: newsclass,
					newstime: newstime,
					news_view: news_view,
					newssort: newssort,

					srcimg: srcimg,
					jiage: jiage,//新增字段
					bianhao: bianhao,
					daqu: daqu,
					fuwuqi: fuwuqi,
					taocan: array,
					dengji: dengji,
					xingbie: xingbie,
					menpai: menpai,
					shenshou: shenshou,
					yijia: yijia,//新增字段
					editor: editor,
					yanse: yansearray,
					xinghao: xinghaoarray,
					ejclass: datafl,
					sjclass: datafl

				},//规定要发送到服务器的数据

				success: function (res) { // 当请求成功时运行的函数
					console.log(res);
					// news_slt=null;
					if (res.code == 1) {
						layer.msg(`<?php echo $languageObj['产品保存中...']['name_' . $language]; ?>`, {
							icon: 16,
							shade: 0.05,
							time: 1000
						}, function () {
							window.location.href = "/login.php/admin/loadright?page=product";
						});

					} else {

						layer.msg(`<?php echo $languageObj['保存失败']['name_' . $language]; ?>`, {
							icon: 2,
							shade: 0.05,
							time: 800
						});
					}





				},
				error: function (result) { //失败的函数
					layer.alert(`<?php echo $languageObj['请检查是否有修改内容']['name_' . $language]; ?>`);
					console.log(result);


				}

			})


		})

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
		