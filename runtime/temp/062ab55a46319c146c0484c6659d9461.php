<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"/www/wwwroot/tb.youanfutang.cn/public/../application/index/view/index/login1.html";i:1714223764;}*/ ?>
<style type="text/css">
       html,body{width: 100%;height: 100%;margin: 0;background-image: url(/static/img/login-bg.gif) !important;background-repeat: repeat !important;background-color: #0a0a0a !important}
		.login-box{width:900px;height:480px;;display: flex;box-shadow:0px 12px  50px #000000;position: fixed;left:50%;margin-left: -450px;top:0%;margin-top: -240px;opacity:0;border-radius: 20px}
		#login-left{width: 55%;height:100%;background-image: url(/static/page/image/bgleft.png);background-size:100% 100%;background-repeat: no-repeat;border-top-left-radius: 10px;border-bottom-left-radius: 10px}
		#login-right{width: 45%;height:100%;border-top-right-radius: 10px;border-bottom-right-radius:10px}
		#left-p{color: white;height:100px;line-height:100px;font-weight:100;margin:150px auto;padding-left:30px;}
		#login-right{background-color: white;}
		#right-logo{width: 60%;height:120px;margin:20px auto;display: flex;flex-direction:column;text-align: center;opacity: 0;}
		#right-logo img{width:100%;display: inline-block;margin:auto}
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
  <script src="/static/JS/jquery.min.js"></script>
  <script src="/static/layui/layui.all.js"></script>
  <link rel="stylesheet" href="/static/layui/css/layui.css">
	<div class="login-box">
		<div id="login-left">
		
		</div>
		<div id="login-right">
			<div id="right-logo">
				<img src="/static/page/image/loginlogo.png"/>
				<!-- <p style="color: rgb(53,74,123);font-weight: bold;">C M S 网 站 后 台 管 理 系 统</p> -->
			</div>
			<div id="right-login">
				<form id="login-form" action="" method="post">
					<input type="text" name="admin_user" id="account" value=""  placeholder="登录账号"/>
					
					<input type="password" name="admin_psd" id="password" value="" placeholder="登录密码" />
					<input class="login-input" type="text" id="uname" placeholder="收货人姓名" style="display: none;">
					<input class="login-input" type="text" id="phone" placeholder="收货人电话" style="display: none;">
					<input class="login-input" type="text" id="picking" placeholder="取货地址" style="display: none;">
					<div class="box2-tx" style="display: none;">
					    <label for="box2-btn" id="lab-btn" class="uploadico">Pode optar por enviar avatares</label>
					 
					</div>
					<input style="width: 40%;float: left;margin-right: 5px;" type="text" name="yzm"  value="" placeholder="验证码" /><img width="110px"  height="40px" style="float: left;cursor: pointer;" src="/login.php/index/captcha" onclick="this.src='/login.php/index/captcha'"/>
					
				</form>
				
				<button id="login-button" class="layui-btn layui-btn-primary" >Login</button>
				
			</div>
		<!-- 	<div id="login-footer">
			<p><span>Powered by jaychen </span>
			<span>Copyright © 2001-2025 </span>
			<span>. All rights reserved</span></p>
		    </div> -->
		
		</div>
	
	</div>


	<script type="text/javascript">
		
			 $(".login-box").animate({top:"50%",opacity:"1"},500);
		       $("#right-logo").animate({opacity:"1"},2000)
		</script>
<!-- <script>
	
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

	
})	 -->

</script>

<script>
	
var  photo;
layui.use('upload', function(){
  var upload = layui.upload;
   
  //执行实例
  var uploadInst = upload.render({
    elem: '.uploadico' //绑定元素
    ,url: '/index.php/index/requ/basicicoapi' ,//上传接口
	//,url: '/login.php/admin/aliossupfile' ,//上传接口
	exts: 'jpg|png|jpeg'
	,multiple:true
	,drag:true
	,data:{
		
	}
    ,before:function(obj){
		//预读本地文件示例，不支持ie8
		     
		layer.msg('图片上传中...', {
		                icon:16,
		                shade: 0.05,
		                time: 500
		            });		
							}
	,done: function(res){
      //上传完毕回调
	 $('#photo').attr('src', res.filepath);
	  // console.log(res.filepath); 图片文件的路径
	       photo=res.filepath;//赋值给photo 传给ajax丢数据
		   $(".uploadico").text('可选择上传头像(已上传)')
    }
    ,error: function(res){
      //请求异常回调

	  console.log(res);
    }
  });
});
</script>
   <script>
		var onelogin=false;
     

        // 头像上传
        $('#box2-btn').on("change", function (e) {
            var fileMsg = e.currentTarget.files;
            var fileName = fileMsg.length;
            if (fileName != 0) {
                var reader = new FileReader();
                reader.readAsDataURL(fileMsg[0]);
                reader.onload = function () {
                    $("label").hide()
                    var imgSrc = this.result;
                    upImg = imgSrc;
                    var img = '<img src="' + imgSrc + '" alt="">'
                    $('.box2-tx').append(img);
                }
                $('input[type="file"]').val(null)
            } else {
                return false;
            }
        })
		
		
        // 登录
        $('#login-button').click(function () {
			var yzm=$("input[name='yzm']").val();
			if(!yzm){
				layer.msg('Preencha o código de verificação！');
				return false;
			}
			
            var account = $('#account').val();
            var password = $('#password').val();
            var uname = $('#uname').val();
            var phone = $('#phone').val();
            var picking = $('#picking').val()
            var loginImg = $('.box2-tx').children()
			
            if (account == '') {
                layer.msg('A conta não pode estar vazia！');
                return false;
            }
            if (password == '') {
                layer.msg('A senha não pode estar vazia！');
                return false;
            }
            if (onelogin==true&&uname == '') {
                layer.msg('O nome do destinatário não pode estar vazio！');
                return false;
            }
            if (onelogin==true&&phone == '') {
                layer.msg('O número de telefone do destinatário não pode estar vazio！');
                return false;
            }
            if (onelogin==true&&picking == '') {
                layer.msg('O endereço de recolha não pode estar vazio！');
                return false;
            }
			
			if (onelogin==true&&photo ==null) {
			    layer.msg('O Avatar não pode estar vazio！');
			    return false;
			}
            
            if(loginImg.length == 3){
                console.log(loginImg);
            }
            console.log(account,password,uname,phone,picking);
          
				$.ajax({
														type:'POST', // 规定请求的类型（GET 或 POST）
														url:'/index.php/index/requ/memberlogin', // 请求的url地址
														cache:true,// 否在缓存中读取数据的读取
														dataType:'json', //预期的服务器响应的数据类型 
														data:{
															 user:account,
															 pwd:password,
															 resign:'登陆',
															 name:uname,
															 phone:phone,
															 picking:picking,
															 img:photo,
															 yzm:yzm
															
														},//规定要发送到服务器的数据
														
														success: function(res){ // 当请求成功时运行的函数
														
															if(res.code==1){
																layer.msg('Login bem sucedido！', {
																                icon:1,
																                shade: 0.05,
																                time: 800
																            },function(){
																	
														window.location.href='/index.php?p=center';			
																	});
																
															}else if(res.code==3){
																layer.msg('Erro da senha！', {
																                icon:2,
																                shade: 0.05,
																                time: 800
																            });
															}else if(res.code==10){
																layer.msg('Por favor, preencha o endereço de envio e avatar para o primeiro login', {
																                icon:2,
																                shade: 0.05,
																                time: 800
																            },function(){
																				onelogin=true;
																				$('#uname').show();
																				 $('#phone').show();
																				$('#picking').show();
																				 $('.box2-tx').show();		
																																				
																			});
																	
															}else if(res.code==5){
																
																layer.msg('Erro no código de verificação！', {
																                icon:2,
																                shade: 0.05,
																                time: 800
																            });
																			
															}else{
																layer.msg('Anormalidade da conta, entre em contato com o administrador do site！', {
																                icon:2,
																                shade: 0.05,
																                time: 800
																            });
															}
														
															
															
															
															
														},
														error:function(result){ //失败的函数
														layer.msg('Falha do servidor！', {
														                icon:2,
														                shade: 0.05,
														                time: 800
														            });
																
																
																
																
														}
														
													})//ajax-end
        })
    </script>

<script src="/static/layui/layui.all.js"></script>