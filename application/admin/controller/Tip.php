<?
// 1.ajax 传入json，复杂多维数组 格式：	

var data = {data:{data0:[{proname:proname,propri:propri,proxs:proxs,qipri:qipri,timedata:timedata,data1:[{proname1:proname1,propri1:propri1,proxs1:proxs1,qipri1:qipri1,timedata1:timedata1}],data2:[{proname2:proname2,propri2:propri2,proxs2:proxs2,qipri2:qipri2,timedata2:timedata2}]}]}};

控制器取值：
$data = empty($_REQUEST['data'])?"":$_REQUEST['data'];


 $res=$data['data']['data0'][0]['data2'];
return $res;

return $data['data']['data0'][0]['data1'][0]['proname1'];
需要保证数组里的每个键都有值.

//数据库存了json，取出时用return会把json识别成字符串，应该用 直接打印数据	 print_r($main[0]['role']); 
//print_r（） 可以打印出复杂类型变量的值(如数组,对象)
// 2.jq获取后台数据循环输出+控制器遍历数组输出

{volist name='newsc' id='m'}
                        <div class="news_item">
                            <div class="news_item_title" dataname="{$m.name}">
                                <div>{$m.name}</div>
                                <i class="fa fa-angle-up display"></i>
                                <i class="fa fa-angle-down"></i>
                            </div>
                            <div dataid="{$m.Id}" dataname="{$m.name}" class="news_item_list display {$m.name}">
                              
                                
                            </div>
                        </div>
						   {/volist}

	$(document).ready(function(){
		$.post("/index.php/index/article/articlelist?newscalss=gsxw",function(str) {
			console.log(str);
			let htmlclass=''
			str.forEach(x=>{
				// console.log(x.Id);
				// console.log(x.class);
				// console.log(x.version);  
				news_tit=x.news_tit;
			
				 news_tit=news_tit.substr(0,21);
			
			htmlclass +='<div><a href="/login.php/newsad/newslist_detail?trid='+x.Id+'" target="_blank"><span>></span><span>'+news_tit+'</span> <span> '+x.newstime+'</span></a></div>';
			});
		$("#artlist").html(htmlclass);
		});
		
		});
//   htmlclass += `<option value="${x.name}">${x.class}</option>`; es6语法解决空格value错误问题		
// 3.利用foreach 把数组的某一组删掉
	 foreach($list as $k=>$v){
		if($v['class'] == ''){
		unset($list[$k]);
		}
		}  
	
//4. on方法包含很多事件，点击，双击等等事件。和$().click()的用法一样，最大的区别即优点是如果动态创建的元素在该选择器选中范围内是能触发回调函数。例如$().html();				
$(document).on('click','要选择的元素',function(){})
　　

//4.layui 动态添加多个日期选择控件
<table>
	<thead>
		<tr>
			<th>开始时间</th>
			<th>结束时间</th>
		</tr>
	</thead>
	<form action="">
	<tbody id="tableContent">
	<tr>
		<td><input type="text" class="layui-input datetime" placeholder="yyyy-MM-dd"></td>
		<td><input type="text" class="layui-input datetime" placeholder="yyyy-MM-dd"></td>
	</tr>
	</tbody>
	</form>
</table>

<script src="/xxx/layui.js"></script>

<script>
//主要是用到laydate
layui.use( 'laydate', function () {
	var laydate = layui.laydate;
	//核心方法
	function timeAdd(){
         lay('.datetime').each(function() {
             laydate.render({
                 elem : this,
                 trigger : 'click'
             });
         });
     }
     //初始化时先调用一次，确保静态的那一行可点
     timeAdd();
     //给新增按钮添加点击事件
     $('.addBtn').click(function(){
	     tableHtml2 = "<tr>
		<td><input type='text' class='layui-input datetime' placeholder='yyyy-MM-dd'></td>
		<td><input type='text' class='layui-input datetime' placeholder='yyyy-MM-dd'></td>
	</tr>";
	     $("#tableContent").append(tableHtml)
         form.render(); 
         timeAdd()
     })
})
</script>

//5.for循环增加 $list数组里面的条数。
$list = [];


for($i = 1; $i <= $num; $i++) {
$ran=mt_rand(1,99999);
if($sel=='本科论文'){
	$list[] = ['name'=>$sel,'tel'=>'B.bbkkss.com/login.php/newsad/newslist_detail?trid='.$ran,'jiangpin'=>$ran];
}else if($sel=='研究生论文'){
	$list[] = ['name'=>$sel,'tel'=>'Y.bbkkss.com/login.php/newsad/newslist_detail?trid='.$ran,'jiangpin'=>$ran];
}

//6.把数组以字符串的形式存入数据库
存入json_encode()
取出json_decode()

	$json = '{"a":"php","b":"mysql","c":3}';  
3	$json_Class=json_decode($json);   
4	$json_Array=json_decode($json, true); 
//当该参数$assoc为 TRUE 时，将返回 array 否则返回 object 。 
//php 将json 转换成 数组	可用json_decode($user[0]['role'],true)；转换后才能用foreach去遍历数组	
//json: $user[0]['role']={ "homeInfo": { "title": "首页", "href": "admin/loadright?page=welcome-1" }},
//json_decode($user[0]['role'],true)
数组:Array
(
    [homeInfo] => Array
        (
            [title] => 首页
            [href] => admin/loadright?page=welcome-1
        )
)		

5	print_r($json_Class);   
6	print_r($json_Array);   
访问对象类型$json_Class的a的值

	echo $json_Class->{'a'};
	
	访问数组类型$json_Array的a的值
	
	echo $json_Array['a'];
	


//7.json_encode()存入数据库的字段为数组时不好修改，重新定义新的数组，进行输出。
//例:['buyarr':{"tcarr":["\u6210\u4eba","\u513f\u7ae5","\u8001\u4eba"],"buyarr":["1","1","1"]}]

 $newspage=['Id'=>$newspage[0]['Id'],'name'=>$newspage[0]['name'],'phone'=>$newspage[0]['phone'],'userid'=>$newspage[0]['userid'],'ortext'=>$newspage[0]['ortext'],'trdate'=>$newspage[0]['trdate'],'prisum'=>$newspage[0]['prisum'],'buyarr'=>json_decode($newspage[0]['buyarr'])];
 
 
 //8.数组不存在时 用isset 三元运算符
 
 $pid1=isset($tcboj[1]['id'])?$tcboj[1]['id']:'';
 
 
 //9.遍历修改数组，常常用遍历数组直接$priarr[0]['arr'][$a]['data']=15修改的方式
	$prires=db::table('tpiao')->where('Id',$tcsz[0]['id'])->select();
				
				
			$pri=json_decode($prires[0]['price'],true) ;
			
			    //return $pri[0]['date'];
			$priarr[]=['arr'=>$pri];
				//return $priarr[0]['arr'];
				foreach($priarr[0]['arr'] as $a=>$b){
					
					 if($b['date']==$ydate."-".$mdate."-".$ddate){
					 	
						  //return $a['date'];
					 	//$b->{'data'}=$propri;
						$priarr[0]['arr'][$a]['data']=15;
						
						return $priarr[0]['arr'];
					 
					 }
					 
//10.新定义的数组$priarr[]=['arr'=>$pri]; 如果在多个套餐中用，需要改变名称重新定义一个。					 
 
 $priarr1[]=['arr'=>$pri]; 
 $priarr2[]=['arr'=>$pri]; 
 
 //11.原始数据是数组，经过unset后，多出了下标，变成了对象。可以使用array_values函数，让数组只返回值，不返回键名。
$a=array("Name"=>"Bill","Age"=>"60","Country"=>"USA");
print_r(array_values($a));

//12.常用扩展
//const定义不可改变的常量后，在方法中调用
 const APPID = 'wxe09c2196a5253aa6';
 self::APPID
 //  通过实例化类来调用类的方法
 $obj = new \app\index\controller\Base();
    $prepay_id = $obj->getPrepayId($money, $order_no);
//加载extend扩展 然后实例化类去调用方法 import助手函数
   import('alipayex.pay.wappay.service.AlipayTradeService',EXTEND_PATH,'.php');
  $payResponse = new \AlipayTradeService($config);
  $result = $payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);
//加载 vendor的扩展第三方不规范的类
 vendor('alipay.AlipayTradeService');
 $alipaySevice = new \AlipayTradeService(); 
 $alipaySevice->writeLog(var_export($_POST,true));
 
 //js全局变量 如果在函数内获取值时 用var定义，会变成方法内的变量，相当于重新定义。
 var coupon='';
   coupon=$("input[name='coupon']").val();
  //jq获取不到input默认值，请检查下 是否存在多个同ID  类名，name的input
   <input class="layui-input" name="user-name" type="text"  placeholder="请输入搜索值">
  <input class="layui-input" name="user-name" type="text"  placeholder="请输入管理员昵称">
   var username=$('input[name="user-name"]').val();
 
 //13.Illegal string offset 'res.err_msg'  非法字符串偏移'res.err_msg',一般指数组里面没有该建值
 $res['res.err_msg']
//JS获取url参数  常用于产品分类选择
  function getQueryString(name) {   
		                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象  
		                var r = window.location.search.substr(1).match(reg);  //匹配目标参数
		                if( r != null ){
							return decodeURI( r[2] );
						}else{
							return null; 
						} 
						   
		            } //获取url的参数
					
				var url_class=getQueryString('class');
				
//14.微信复制及 滚动偏移
				
var weixin="微信号码";
							var input = document.getElementById("weixin");
							input.value = weixin; // 修改文本框的内容
							input.select(); // 选中文本
							document.execCommand("copy"); // 执行浏览器复制命令
							layer.msg('微信号复制成功！赶快去微信添加吧!');
							window.location.href = 'weixin://';
						
}
						
$('html,body').animate({scrollTop:$('.title').offset().top}, 800);


//15.同个数据表格，查询一级分类【下载中心】下的  多个子分类的数据返回前端

$sel=empty($_REQUEST['sel'])?'':$_REQUEST['sel'];	if($sel){		$kecheng=self::newsTree('下载中心'); 	foreach($kecheng as $k=>$v){				$fujian=db('news')->whereor('newsclass',$v['name'])->where(['news_tit'=>['like','%'.$sel.'%']])->select();				foreach($fujian as $i=>$l){								$selres[]=$l;			}				}	   return json($selres);
   
 //TP分页+JS接受URL参数
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">	
										
										
										
	<style type="text/css">   				
   				.f_page{text-align: center;}
   				.product_list img{max-width: 162px;max-height: 122px;}
   				.pagination {
   				    display: inline-block;
   				    padding-left: 0;
   				    margin: 20px 0;
   				    border-radius: 4px;
   				}
   				.pagination>li {
   				    display: inline;
   				}
   				.disabled {
   				    cursor: default;
   				    background-color: #DCDCDC !important;
   				    color: black !important;
   				}
   				li {
   				    list-style: none;
   				}
   				.pagination>li:first-child>a, .pagination>li:first-child>span {
   				    margin-left: 0;
   				    border-top-left-radius: 4px;
   				    border-bottom-left-radius: 4px;
   				}
   				.pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>span:hover {
   				    color: #777;
   				    cursor: not-allowed;
   				    background-color: #fff;
   				    border-color: #ddd;
   				}
   				.pagination>li>a, .pagination>li>span {
   				    position: relative;
   				    float: left;
   				    padding: 6px 12px;
   				    margin-left: -1px;
   				    line-height: 1.42857143;
   				    color: #337ab7;
   				    text-decoration: none;
   				    background-color: #fff;
   				    border: 1px solid #ddd;
   				}
   				.pagination>li>a, .pagination>li>span {
   				    position: relative;
   				    float: left;
   				    padding: 6px 12px;
   				    margin-left: -1px;
   				    line-height: 1.42857143;
   				    color: #337ab7;
   				    text-decoration: none;
   				    background-color: #fff;
   				    border: 1px solid #ddd;
   				}
   				.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
   				    z-index: 3;
   				    color: #fff;
   				    cursor: default;
   				    background-color: #337ab7;
   				    border-color: #337ab7;
   				}
   				
   				.pagination>li>a, .pagination>li>span {
   				    position: relative;
   				    float: left;
   				    padding: 6px 12px;
   				    margin-left: -1px;
   				    line-height: 1.42857143;
   				    color: #337ab7;
   				    text-decoration: none;
   				    background-color: #fff;
   				    border: 1px solid #ddd;
   				}
   				.pagination>li>a, .pagination>li>span {
   				    position: relative;
   				    float: left;
   				    padding: 6px 12px;
   				    margin-left: -1px;
   				    line-height: 1.42857143;
   				    color: #337ab7;
   				    text-decoration: none;
   				    background-color: #fff;
   				    border: 1px solid #ddd;
   				}
   				.pagination>li>a, .pagination>li>span {
   				    position: relative;
   				    float: left;
   				    padding: 6px 12px;
   				    margin-left: -1px;
   				    line-height: 1.42857143;
   				    color: #337ab7;
   				    text-decoration: none;
   				    background-color: #fff;
   				    border: 1px solid #ddd;
   				}
   			</style>
								
   					
   					 function getQueryString(name) {   
   										                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象  
   										                var r = window.location.search.substr(1).match(reg);  //匹配目标参数
   										                if( r != null ){
   															return decodeURI( r[2] );
   														}else{
   															return null; 
   														} 
   														   
   										            } //获取url的参数
   													
   												var url_a=getQueryString('class');
   								
   								<div class="f_page">
   								    {$list->render();}
   								</div>
   								
   								$(".pagination li a").each(function(){
   									
   									pagsrc=$(this).attr("href");
   									pag=pagsrc+"&p=anli&class="+url_a;
   									$(this).attr("href",pag)
   								})	
   									
//16.JQ选择器适用于css的选择
<style>
input[type='checkbox']:checked{color:red};
</style>
 	
	
<input type="checkbox" name="wzgl" title="网站管理" checked="">
var name=$("input[type='checkbox']:checked").attr('title');		
	
//复选框选择+js添加数组+数组转换成json。
	var data=new Array();
		
		 $(".editrole .layui-form input[type='checkbox']:checked").each(function(){
			 checked=$(this).attr('title');//js添加数组
			
			data.push(checked);
		});
		console.log(JSON.stringify(data));//数组转换成json					 
   									
   						
//layer.open 弹出层关闭  如果遇到关闭层时 打开了div的display：block，需要检查是否引入了多个layui.js（导致事件多次发生） 和jquery.js，jquery.js有没有先引入
						
//17.JSON.parse(res.role) 将服务端的json值转成数组对象，用for循环JS数组。each遍历结束后执行
	
	var rolenum=0;
	$(".editrole input").each(function(){
		roletit=$(this).attr('title');
		for(x=0;x<JSON.parse(res.role).length;x++){
			console.log(JSON.parse(res.role)[x])
			if(JSON.parse(res.role)[x]==roletit){
				$(this).attr('checked','checked');
			}
		}
		rolenum++;
	})
	
	if(rolenum>=$(".editrole input").length){
		
		layui.use('form', function(){
		  var form = layui.form;
		    form.render();//select和复选框 这些需要表单重载
		
		});
		
	}//each遍历完成执行
	
	
	layer.open({
					  type: 1, 
					  area:['350px','410px'],
					  title:'编辑权限',
					  anim:1,
					  content: $(".editrole"),
					  end:function(){
						location.reload();
					  }//弹窗结束后 重载页面
					  
					}); 
				
				
 //18.发现each遍历甲乙出错时，要单独声明JS变量，没有var 相当于全局定义了
 
 过程体内(包括方法,对象)内的对象加var保留字则为局部变量,而不加var保留字即为全局变量   加var为局部变量(在方法内)，不加var为全局变量(当方法内有一次使用后)。
  
  
$_SERVER['REQUEST_URI'];//获取主机URL连接
$_SERVER['HTTP_HOST']//获取域名

//19.解决图片模糊image-rendering: -moz-crisp-edges; /* Firefox */     image-rendering: -o-crisp-edges; /* Opera */      image-rendering: -webkit-optimize-contrast; /*Webkit (non-standard naming) */ image-rendering: crisp-edges; \-ms-interpolation-mode: nearest-neighbor; /* IE (non-standard property) *///下载重命名：	  var a=document.createElement('a');		   a.setAttribute('href',durl);		  a.setAttribute('download',dname);		 		  a.click();
//20.	//上一篇 下一篇
		$prxt=db($formname)->where('Id','=',$new_delid-1)->select() ;	
		$next=db($formname)->where('Id','=',$new_delid+1)->select() ;
		if(!$prxt||!$next){
			$prxt[]=['Id'=>$new_delid,'news_tit'=>'没有了'];
			$next[]=['Id'=>$new_delid,'news_tit'=>'没有了'];
		}
		$this->assign(['prxt'=>$prxt,'next'=>$next]);
		//上一篇 下一篇
		
	//21.代码去重：一般用于制作后台时，编辑产品分类时，出现的多余分类的删除。
	
	$("#newsclass option").each(function(){
	
	var getText = $(this).text();
	
	if($("#newsclass option:contains("+getText+")").length > 1)   /*作用:select option:contains("+text+")")包含text的个数 */
	
	{
	
	$("#newsclass option:contains("+getText+"):gt(0)").remove();  /*作用:包含text大于个数0的选项就移除*/
	
	}
	
	})	

//22.在后台添加不确定个input字段，将值用json封装，再用数组封装json，通过ajax将数组传入方法，将数组用 json_encode的方式入库，取出时应检查该数据是否符合数组的格式，无论用volist 还是res.forEach(x=>{方法})的方式将数据循环输出到前端上，都应该将数据进行处理成标准的数组格式（参考db查询的结果集）
	var numpro=0;				var numi=0;				var json={};				var array=new Array();				$(".product input").each(function(){										if(numpro<3){					proval=$(this).val();					json[numpro]=proval;					if(numpro==2){						array[numi]=JSON.stringify(json);											numi++;						numpro=0;											}else{						numpro++;					}															}									});			//以上是封装数据过程
				$taocan=json_decode($list[0]['taocan'],true);	foreach($taocan as $a=>$b){						$taocan[$a]=json_decode($b,true);						};//以上是将数组里的json数据转换成数组，确保我们要使用的数据都是标准数组格式，在前端里面，也可以用x = JSON.parse(x) 的方式将某个json格式的字符串改成数组来获取23.//时间范围选择，数据库字段要date类型
 $newspage = db($formname)->where('day','between time',['2022-8-27','2022-8-30'])->where($citydata)->where($mdzdata)->order('Id','desc')->limit($start,$limit)->select();// 获取本月的文章
Db::table(‘think_news’)->whereTime(‘create_time’, ‘m’)->select();

同字段的 多范围搜索 //where("xxx = '1' or xxx = '2'")

24.//rename()支持重命名 和 移动文件  
   //在引入一些非当前命名空间的php类时，实例化时需要用在 类名前加 \ 来进行全局匹配
   
25. //多维数组去重及排序
   $t = array_map('serialize', $info[0]);					//利用serialize()方法将数组转换为以字符串形式的一维数组					$t = array_unique($t);					//去掉重复值					$new_arr = array_map('unserialize', $t);					//然后将刚组建的一维数组转回为php值				//根据字段 Id 对数组 $new_arr 进行降序排列$add_time = array_column($new_arr,'Id');//取出某键值array_multisort($add_time,SORT_DESC,$new_arr);//array_multisort() 可以用来一次对多个数组进行排序，或者根据某一维或多维对多维数组进行排序。

26.//跨域请求数据接口  用curl方法 public function test() {      $phoneRes = $this->httpRequest('http://www.qygsgj.com/back/app/qcclike', json_encode(['enterpriseinfo' => '米枫']), 'GET');      return $phoneRes;      $phoneRes = json_decode($phoneRes, true);    }			function httpRequest($url, $data = '', $method = 'GET')	  {	    $curl = curl_init();	    curl_setopt($curl, CURLOPT_URL, $url);	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);	    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);	    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);	    if ($method == 'POST') {	      curl_setopt($curl, CURLOPT_POST, 1);	      if ($data != '') {	        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	      }	    }	    curl_setopt($curl, CURLOPT_TIMEOUT, 30);	    curl_setopt($curl, CURLOPT_HEADER, 0);	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);	    $result = curl_exec($curl);	    curl_close($curl);	    return $result;	  }27.//多条件筛选前端处理 5千-1万 //选中亮标$(".class>a").each(function(){						if($(this).text()=='{$Request.get.class}'){				 $(this).addClass('slted').siblings().removeClass('slted');			}		})//后端处理 if(isset($arr['sel'])&&$arr['sel']!==''){				 $product=db('product')->where('newsclass|classitem|fuwuqi|jiage','like','%'.$arr['sel'].'%')->paginate(10);				//搜索	}else{		if(isset($arr['class'])){//检索第一个条件，第一个条件作为参数是默认在筛选条件里具备的				  		    if($arr['jiage1']==''&&$arr['jiage2']==''){					  //如果价格为空 就是选择全部时					  					   $product=db('product')->where('newsclass','like','%'.$arr['class'].'%')->where('classitem','like','%'.$arr['classitem'].'%')->where('fuwuqi','like','%'.$arr['huxing'].'%')->paginate(10);					 				  }else{					  //价格不为空					   $product=db('product')->where('newsclass','like','%'.$arr['class'].'%')->where('classitem','like','%'.$arr['classitem'].'%')->where(['jiage'=>[['>=',$arr['jiage1']],['<=',$arr['jiage2']]]])->where('fuwuqi','like','%'.$arr['huxing'].'%')->paginate(10);				  }				 		}else{				      $product=db('product')->paginate(10);//全部产品，没有条件		}	}//selend需要注意的是 where('classitem','like','%'.$arr['classitem'].'%')只能搜索非NULL字段，所以要字段不能为空，或者在后端里面进行空字符串搜索NULL的如果有搜索的话 可以在 分页JS里面加入 sel参数

28.// 微信PC扫码登陆，前端生成二维码，后端wxpclogin进行获取用户数据和登陆校验，用户的openid并不是唯一的，如果是微信内H5要做的话，最好用用户的UNIID
  <script src="https://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>
    var obj = new WxLogin({
        id:"free-cold",
        appid: "wx644990b4b418ddb7",
        scope: "snsapi_login",
        redirect_uri: "http://daveenglish.cn/index/requ/wxpclogin",
        state: "",
        style: "",
        href: ""
    });
	
		
   
