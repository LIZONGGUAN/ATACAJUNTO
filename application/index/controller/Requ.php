<?php  //index模块下的 此控制器主要处理前端页面中的ajax数据请求 返回
namespace app\index\controller;
use think\Cookie;
use think\Controller;
use think\Db;
use think\View;
use app\index\model\Weixin_pay;
use app\admin\model\User;
use app\admin\model\News;
use app\admin\model\Seo;
use app\admin\model\Danyecon;
use app\admin\model\Forminfo;
use app\admin\model\Webplug;
use app\admin\model\Verifi;
use app\admin\model\Webdata;
use app\index\controller\Base;
use app\index\model\Weixin;
use think\Image;
use think\Request;
use think\captcha\Captcha;
use think\Loader;
use Qcloud\Sms\SmsSingleSender;//腾讯短信


class Requ  extends \think\Controller
{

 public function orderxg($trid=''){
     
     $info=db('order')->where('Id',$trid)->update(['status2'=>'客户已确认货物！']);
     if($info){
         	   $res = [
		               'code'=>1,
		               'msg'=>'返回成功',
		            
		           ];
		           return json($res);
     }else{
         
         	   $res = [
		               'code'=>0,
		     
		            
		           ];
		           return json($res);
     }
     
 }//修改订单状态
 
  public function shouhuo($trid=''){
     
     $info=db('order')->where('Id',$trid)->update(['status2'=>'已确认收货！','wuliu'=>'已送达！']);
     if($info){
         	   $res = [
		               'code'=>1,
		               'msg'=>'返回成功',
		            
		           ];
		           return json($res);
     }else{
         
         	   $res = [
		               'code'=>0,
		     
		            
		           ];
		           return json($res);
     }
     
 }//确认收货订单

	public function memberorder(){
	    	$page = empty($_REQUEST['page'])?"1":$_REQUEST['page'];
	$limit = empty($_REQUEST['limit'])?"20":$_REQUEST['limit'];
	$formname = empty($_REQUEST['formname'])?"news":$_REQUEST['formname'];
	$sel=empty($_REQUEST['searchParams'])?"":$_REQUEST['searchParams'];
		$memid=empty($_REQUEST['memid'])?"":$_REQUEST['memid'];
		
    $sel=json_decode($sel,true);
	$sel=$sel['username'];
	
	switch($formname){		
		case $formname:
		if($formname=='member'||$formname=='order'||$formname=='coupon'||$formname=='user'){
			
			if($formname=='order'){
				$where['name'] = array('like','%'.$sel.'%'); //模糊查询
				$phone['phone'] = array('like','%'.$sel.'%'); //模糊查询
			}else{
				$where['name'] = array('like','%'.$sel.'%'); //模糊查询
			}
		}else{
			$where['news_tit'] = array('like','%'.$sel.'%'); //模糊查询
		}
		 if($sel){
					  $newsres =db($formname)->where($where)->select();
		 }else{
					  $newsres = db($formname)->where('userid',$memid)->order('Id','desc')->select();
		 };
		
		   $allcount = count($newsres);
		   
		   //获取传递的分页参数
		   $start=$limit*($page-1);
			
		   //分页查询
		  if($sel){
			  if($formname=='order'){
				   $newspage = db($formname)->where('userid',$memid)->whereor($where)->whereor($phone)->order('Id','desc')->limit($start,$limit)->select();
			  }else{
				 $newspage = db($formname)->where($where)->order('Id','desc')->limit($start,$limit)->select();  
			  }
			
					}else{
						  $newspage = db($formname)->where('userid',$memid)->order('Id','desc')->limit($start,$limit)->select();
					}
				
		   $res = [
		               'code'=>0,
		               'msg'=>'返回成功',
		               'count'=>$allcount,
		               'data'=>$newspage
		           ];
		break;
		
	}//switch
	
	
	
	 
	return json($res);	
	    
	    
	}//供前端用户订单确认

//PC微信扫码登录回调
    public function wxpclogin($code='')
    {
        
        session_start();
        //获取code
        //$code = Request::get('code');//接受获取到的code
       
        $appid = 'wx644990b4b418ddb7';//平台appid
        $appsecret = '451f6ac78fa44282f8c3008d7327bc0a';//平台密钥
        //获取access_token；
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';
         //json对象变成数组
        $res = json_decode(file_get_contents($url), true);
       // echo "<pre>";print_r($res);exit; //打印一

        $access_token = $res['access_token'];
        $openid = $res['openid'];
        //根据access_token和openid获取用户信息
        $urlyonghu='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid;
        $userinfos=json_decode(file_get_contents($urlyonghu),true);//用户信息
         //echo "<pre>";print_r($user);exit; //打印二
         //return json($userinfos);
         		$openid=db('member')->where('openid',$userinfos['openid'])->select();
		if($openid){
			$this->wxlogin_cookie($userinfos['openid']);//已经注册过的 直接登陆	
		}else{
			$bianhao=rand(1111,99999999999);
			
			$info=db('member')->insert(['name'=>$userinfos['nickname'],'bianhao'=>$bianhao,'img'=>$userinfos['headimgurl'],'city'=>$userinfos['city'],'province'=>$userinfos['province'],'country'=>$userinfos['country'],'openid'=>$userinfos['openid']]);//注册
			if($info){				
				$this->wxlogin_cookie($userinfos['openid']);
			}else{
				
				return '微信登陆失败！请联系网站管理员！';
			}
		
    }
        
    }//微信扫码登陆    

public function txems($tel=''){
 //腾讯短信
   // 短信应用 SDK AppID
        $appid = '1400681105'; // SDKAppID 以1400开头
        // 短信应用 SDK AppKey
        $appkey = "a62e95d8831934b344fec0c8c26b78e8";
        // 需要发送短信的手机号码
        $phoneNumbers = $tel;
        // 短信模板 ID，需要在短信控制台中申请
        $templateId = 1406079;  // NOTE: 这里的模板 ID`7839`只是示例，真实的模板 ID 需要在短信控制台中申请
        $smsSign = "个体线上管理助手"; // NOTE: 签名参数使用的是`签名内容`，而不是`签名ID`。这里的签名"腾讯云"只是示例，真实的签名需要在短信控制台申请

        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params =[rand(1111,9999)];//生成随机数
            $result = $ssender->sendWithParam("86", $phoneNumbers, $templateId, $params, $smsSign, "", "");
            $rsp = json_decode($result);
// 			return json($rsp);
           if($rsp->errmsg=="OK"){
               $res['yzm']=$params;
       return json($res); 
           }
            //return json(["result"=>$rsp->result,"code"=>$params]);
        } catch(\Exception $e) {
            echo ($e);
        }
        
      
 //短信
}

public function zhengshu(){
	
	$zsname=$_REQUEST['zsname'];
	$tit=$_REQUEST['tit'];
	$list=db('product')->where('Id',$tit)->select();
	//return $list[0]['srcimg'];
	//"[[\"\/static\/upload_img\/admin\/ico\/20211206\/1104413b5c83f99279cf0e7fc684ef0b.png\",\"\/static\/upload_img\/admin\/ico\/20211206\/174837151e325a519732928a860a7027.png\"],[\"四级证书甲\",\"四级证书乙\"]]"
	foreach(json_decode($list[0]['taocan'],true) as $k=>$v){
		//print_r($v) ;
		foreach($v as $a=>$b){
			
			 if($b===$zsname){
				 $i=$a;
			 }
		}
		
	}
	
foreach(json_decode($list[0]['taocan'],true) as $k=>$v){
	
		$info=$v[$i];
		break;
	}
	$res=[
		'code'=>1,
		'res'=>$info,
		'name'=>$zsname
	];
	return json($res);
	
}

public function kefuyz(){
	$request=empty($_REQUEST)?'':$_REQUEST;
$info=db('kefu')->where('card',$request['kefu'])->select();
		if($info){
			
			$res['code']=1;
			$res['res']='验证成功！';
			
		}else{
			$res['code']=0;
			$res['res']='验证失败！';
		}
		return json($res);
}//客服验证	

public function ems(){
 //短信
 $tel = empty($_REQUEST['tel'])?"":$_REQUEST['tel'];
   $host = "https://zwp.market.alicloudapi.com";
          $path = "/sms/sendv2";
          $method = "GET";
          $appcode = "860e0236bed343e2ae22*******";
          $headers = array();
          array_push($headers, "Authorization:APPCODE " . $appcode);
   
      $yzm=rand(2222,9999);
          //$querys = "content=【H5云提醒】您的验证码是".$xingming.",".$tel."的一条信息。&mobile=17328320946";
          //【北京圣鑫】您网站有客户#code#咨询价格！
       $querys = "content=%E3%80%90%E5%B9%BF%E5%B7%9E%E6%90%BA%E6%89%8B%E6%83%85%E6%84%9F%E3%80%91%E6%82%A8%E7%9A%84%E9%AA%8C%E8%AF%81%E7%A0%81%E6%98%AF".$yzm."%E3%80%82&mobile=".$tel;
          $bodys = "";
          $url = $host . $path . "?" . $querys;
     
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($curl, CURLOPT_FAILONERROR, false);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_HEADER, true);
          if (1 == strpos("$".$host, "https://"))
          {
              curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
              curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
          }
          curl_exec($curl);
         //var_dump(curl_exec($curl));
      $res['yzm']=$yzm;
      return json($res);
 //短信
}




public function proview(){
	$request=empty($_REQUEST)?'':$_REQUEST;
	$pro =db('product')->find($request['id']);
	$viewnum=$pro['views']+1;

	$info=db('product')->where('Id',$request['id'])->update(['views'=>$viewnum]);
	if($info){
		
		$res['code']=1;
		$res['res']='成功！';
		
	}else{
		$res['code']=0;
		$res['res']='失败！';
	}
	return json($res);
}	
	
	
public function coupon(){
	
	$request=empty($_REQUEST)?'':$_REQUEST;
	switch($request['sign']){
		case 'yanzheng':
		$info=db('coupon')->where('status','未使用')->where('card',$request['coupon'])->select();
		if($info){
			
			return json($info);
		}
		break;
		
		
	}
	
	
}//优惠券模块	
	


public function uploadnews(){

$tit=empty($_REQUEST['tit'])?'':$_REQUEST['tit'];	
	$name=empty($_REQUEST['name'])?'':$_REQUEST['name'];
	$photo=empty($_REQUEST['photo'])?'':$_REQUEST['photo'];
	$Id=empty($_REQUEST['Id'])?'':$_REQUEST['Id'];
	$lwname=empty($_REQUEST['lwname'])?'':$_REQUEST['lwname'];
	
	$jibie=db::table('Zjiang')->where('Id',$Id)->where('jibie','>','')->select();
	
	if(!$jibie){
		$time=date('Y-m-d H:i:s',time());
		$news=new News;
		$news->news_tit=$tit;
		$news->news_jj=$name;
		$news->news_slt=$photo;
		$news->bianhao=$Id;
		$news->newsclass=$lwname;
		$news->newstime=$time;
		$info1=$news->save();
	   
		
		$plurl=Zjiang::get($Id);
		$plurl->jibie=$time;
		$plurl->pro='已使用';
		$info2=$plurl->save();
		if($info1&&$info2){
			$res['code']=1;
			return json($res);
		}else{
			$res['code']=0;
			return json($res);
		}
	}else{
		$res['code']=2;
		return json($res);
	}
	
	
}


public function selnews(){
	$selval=empty($_REQUEST['selval'])?'':$_REQUEST['selval'];	//搜索关键词
	
	// $where['zuopin'] = array('like','%'.$selval.'%'); //模糊查询

$list = Db::table('news')->where('news_tit',$selval)->order('Id desc')->select();

	return json($list);
	
}



public function  memberlogin(){
	$request=empty($_REQUEST)?'':$_REQUEST;	
	
	switch($request['resign']){
		case '注册':
		$info1=db('member')->where('user',$request['user'])->select();
		if($info1){
			$res['msg']='该账号已存在！';
			$res['code']=3;			
		}else{
			$bianhao=rand(1111,99999999999);
			
			$info=db('member')->insert(['user'=>$request['user'],'name'=>$request['name'],'pwd'=>$request['pwd'],'bianhao'=>$bianhao,'img'=>'/static/img//admin/formico.jpg']);
			if($info){				
				$res['msg']='成功！';
				$res['code']=1;
			}else{
				$res['msg']='失败！';
				$res['code']=0;
			}
		}
		return json($res);
		break;
		case '登陆':
		
		
		
// 		$info=db('member')->where('user',$request['user'])->where('status','正常用户')->where('hsz','正常')->where('pwd',$request['pwd'])->select();
	$info=db('member')->where('user',$request['user'])->where('hsz','Normal')->where('pwd',$request['pwd'])->select();
	if($info){
		  // return 'ss';
// 			if($info[0]['phone']==null&&$request['phone']==''){
// 					   $res['code']=10;
// 					   $res['msg']='第一次登录';
// 					   return json($res);
// 			}else{
				
// 				if($request['phone']!==''){
// 				db('member')->where('user',$request['user'])->update(['name'=>$request['name'],'phone'=>$request['phone'],'province'=>$request['picking'],'img'=>$request['img']]);	
					
// 				};
				
// 			};
			$captcha = new Captcha();
			$yzm=$captcha->check($request['yzm']);
			       
			if($yzm==false){
				$res['code']=5;//验证码错误
				return json($res);
			}
			
			$usercookie=(rand());
			// cookie初始化
			Cookie::init(['prefix'=>'memcookie','expire'=>10800,'path'=>'/']);
			
			Cookie::set('memcookie',$usercookie,['prefix'=>'think_','expire'=>10800]); //3小时
			Cookie::set('user',$request['user'],['prefix'=>'think_','expire'=>10800]); //3小时
			
			// $user->undatacookie($usercookie);  //给user表添加cookie 
			
			$khdcookie=Cookie::get('memcookie','think_');
			 $IP = request()->ip();
			$nowtime=date('Y-m-d H:i:s', time());
			$mtime=date('Y-m', time());
			$user=new Webdata();
			$ipres=$user->where('webip',$IP)->select();
			$ipnum=count($ipres)+1;
			 $user->data([
			     'webip'  =>  $IP,
			     'ucookie' =>  $khdcookie,
				 'logintime'=>$nowtime,
				 'name'=>$info[0]['user'],
				 'jibie'=>'网站用户',
				 'ipnum'=>$ipnum,
				 'viewtime'=>$mtime
				 
			 ]);
			$info2=$user->save();
			
			if($info2){
				$res['code']=1;
				$res['msg']='校验成功！';
				return json($res);
			}	
		}else{
			
			$infopw=db('member')->where('user',$request['user'])->select();
		
			if($infopw){
				if(isset($infopw[0]['pwd'])){
					if($infopw[0]['pwd']!==$request['pwd']){
						$res['code']=3;
						$res['msg']='密码错误！';
						return json($res);
					}
						
				}
				
				if($infopw[0]['status']=='停用用户'){
					$res['code']=0;
					$res['msg']='账号异常！';
					return json($res);
				}
			}else{
				$res['code']=4;
				$res['msg']='不在该账户！';
				return json($res);
			}
			
		
		}//
		
	
		
		
		break;
		case '用户信息':
		$user=Cookie::get('user','think_');
		$info=db('member')->where('user',$user)->update(['name'=>$request['name'],'img'=>$request['img'],'sex'=>$request['sex'],'school'=>$request['school'],'major'=>$request['major'],'phone'=>$request['phone'],'wechat'=>$request['weixin'],'time'=>$request['rxtime']]);
		if($info){
			$res['code']=1;
			$res['msg']='成功！';
		}
		return json($res);
		break;
		case '投诉反馈':
		$user=db('message')->where('userid',$request['userid'])->select();
		$nowtime=date('Y-m-d H:i:s',time());
		if($user){
			
			$info=db('message')->where('userid',$request['userid'])->update(['mes'=>$request['tousutext'],'mestime'=>$nowtime,'name'=>$request['name'],'status'=>'未回复','reply'=>'','replytime'=>'']);
		}else{
			$info=db('message')->insert(['mes'=>$request['tousutext'],'userid'=>$request['userid'],'mestime'=>$nowtime,'name'=>$request['name'],'status'=>'未回复']);
		}
		
		if($info){
			$res['code']=1;
			$res['msg']='成功！';
		}
		return json($res);
		break;
		case '清除已阅':
		$info=db('message')->where('userid',$request['userid'])->update(['clear'=>'已解决']);
		if($info){
			$res['code']=1;
			$res['msg']='成功！';
		}
		return json($res);
		break;
		case '退出登录':
		Cookie::delete('memcookie','think_');
	   $res['code']=1;
	   $res['msg']='成功！';
	return json($res);
		break;
		case '修改密码':
		$old=db('member')->where('user',$request['user'])->where('pwd',$request['agopwd'])->select();
		if($old){
				$info=db('member')->where('user',$request['user'])->update(['pwd'=>$request['newpwd']]);
				if($info){
					$res['code']=1;
					$res['msg']='成功！';
				}
		}else{
			$res['code']=0;
			$res['msg']='旧密码错误！';
		}
	 
	
	 return json($res);
			break;
			case '会员信息':
				$info=db('member')->where('user',$request['user'])->update(['name'=>$request['name'],'sex'=>$request['sex'],'brith'=>$request['brith'],'city'=>$request['city'],'provive'=>$request['provive']]);
				if($info){
					
					Cookie::delete('memcookie','think_');
					
					$res['code']=1;
					$res['msg']='成功！';
				}
			
				
			return json($res);
						break;
			case '修改头像':
				$info=db('member')->where('user',$request['user'])->update(['img'=>$request['ico']]);
				if($info){
					
					$res['code']=1;
					$res['msg']='成功！';
				}else{
					$res['code']=0;
					$res['msg']='失败！';
				}
			
				
			return json($res);
						break;			
		
	}

	
	
}//会员模块

public function basicicoapi(){
	$uptype = empty($_REQUEST['type'])?"img":$_REQUEST['type'];
	
	  if($this->request->isPost()){
		  
		  if($uptype=="img"){
			  $res['code']=1;
			             $res['msg'] = '上传成功！';
			             $file = $this->request->file('file');
			             $info = $file->move('../public/static/upload_img/admin/ico');
			  if($info){
			                     $res['name'] = $info->getFilename();
			                     $res['filepath'] = '/static/upload_img/admin/ico/'.$info->getSaveName();
			  					$res['filepath']=str_replace("\\","/",$res['filepath']);// \是转义字符，需要转义后再次输\ 
			                 }else{
			                     $res['code'] = 0;
			                     $res['msg'] = '上传失败！'.$file->getError();
			                 }
			  					  return $res;
		  }else if($uptype=="movie"){
			  $res['code']=1;
			             $res['msg'] = '上传成功！';
			             $file = $this->request->file('file');
			             $info = $file->move('../public/static/upload_img/web/movie');
			  if($info){
			                     $res['name'] = $info->getFilename();
			                     $res['filepath'] = '/static/upload_img/web/movie/'.$info->getSaveName();
			  					$res['filepath']=str_replace("\\","/",$res['filepath']);// \是转义字符，需要转义后再次输\ 	 
			                 }else{
			                     $res['code'] = 0;
			                     $res['msg'] = '上传失败！'.$file->getError();
			                 }
			  					  return $res;
			  
		  };
		  
	
	  };
	 
	        

}////头像、图片、视频上传api 



public function  payorder(){

$request=empty($_REQUEST)?'':$_REQUEST;	

switch($request['sign']){
	case '创建订单':  //创建订单的时候 应进行金额的计算入库
	$newstime=date('Y-m-d H:i:s',time());
	  $userdata=db('member')->find($request['user_id']);
	  
	  //return json_encode(cookie('gwcdata'));
	  //return $request['beizhu'];
	$info=db('order')->insert(['name'=>$request['user_name'],'prisum'=>$request['price'],'trdate'=>$newstime,'buyarr'=>json_encode($request['buyarr']),'shouhuo'=>'收货地址：'.$userdata['province'].'；电话：'.$userdata['phone'],'trade'=>$request['order'],'userid'=>$request['user_id'],'beizhu'=>$request['beizhu']]);
	
	if($info){
		
		$res['msg']='成功！';
		$res['code']=1;
	}
	break;
		case '修改订单':  //创建订单的时候 应进行金额的计算入库
	$newstime=date('Y-m-d H:i:s',time());
	  $userdata=db('member')->find($request['user_id']);
	  
	  //return json_encode(cookie('gwcdata'));
	  
	$info=db('order')->where('Id',$request['orderid'])->update(['name'=>$request['user_name'],'prisum'=>$request['price'],'trdate'=>$newstime,'buyarr'=>json_encode($request['buyarr']),'shouhuo'=>'收货地址：'.$userdata['province'].'；电话：'.$userdata['phone'],'trade'=>$request['order'],'userid'=>$request['user_id'],'status2'=>'待客户审核','beizhu'=>$request['beizhu']]);
	
	if($info){
		
		$res['msg']='成功！';
		$res['code']=1;
	}
	break;

	
}

return json($res);
	
}


 public function gwcdata(){
	 $requ=empty($_REQUEST)?'':$_REQUEST;
		 
     if(cookie('gwcdata')==null){
		 
		 $gwcdata[]=[$requ['proname'],$requ['proimg'],$requ['gwcdata']];
		  cookie('gwcdata',$gwcdata);
		
		  //[产品名字，产品图片，[规格，单价，数量]]
		 //如果购物车数据为空时
	 }else{
		 $gwccookie=cookie('gwcdata');
		$gwcdata=[$requ['proname'],$requ['proimg'],$requ['gwcdata']];
		$gwccookie[]=$gwcdata;
		cookie('gwcdata',$gwccookie);
				
	 };
	 
	
	$res['code']=1;
	$res['res']='成功！';
	return json($res);
	}//购物车数据

public function clearcookiegwc(){
	Cookie::delete('gwcdata');
		 return  true;
	
	
}//清除购物车



public function forminfo(){
	
	$id= empty($_REQUEST['id'])?"":$_REQUEST['id'];
	$xingming= empty($_REQUEST['name'])?"":$_REQUEST['name'];
	$content = empty($_REQUEST['content'])?"":$_REQUEST['content'];
	$tel = empty($_REQUEST['tel'])?"":$_REQUEST['tel'];
	$modif = empty($_REQUEST['modif'])?"":$_REQUEST['modif'];
	$del = empty($_REQUEST['del'])?"":$_REQUEST['del'];
	$select = empty($_REQUEST['select'])?"":$_REQUEST['select'];
	

	
	
	$form=new Forminfo(); 
	if(!$xingming||!$tel){
		
		//return False;
		
	}else{
		$form->data([
		    'name'  =>$xingming,
		    'tel' => $tel,
		 'content' =>$content
		]);
		
		 $info =$form->save();
		   if($info===1){
		       $res['code']=1;
		       return json($res);}
	}
  
   
}//表单类内容，放在此处是因为无需login.php  base的验证，可以直接获取数据




public function verifi(){
	
	$zgbh= empty($_REQUEST['zgbh'])?"":$_REQUEST['zgbh'];
	$zmbh= empty($_REQUEST['zmbh'])?"":$_REQUEST['zmbh'];
	$code= empty($_REQUEST['code'])?"":$_REQUEST['code'];
	
	$newsres=Db::table('news')->where('news_jj',$zmbh)->where('bianhao',$zgbh)->select();

	if($newsres){
			$res['Id']=$newsres[0]['Id'];
			$captcha = new Captcha();
			$info=$captcha->check($code);
			if($info){
				$res['code']=1;
			
			}else{
					$res['code']=3;
			}
	}else{
		$res['code']=0;
	}
	// 检测输入的验证码是否正确，$code为用户输入的验证码字符串，$id多个验证码标识


     return json($res);
      


   
   
}//前端验证类，放在此处是因为无需login.php  base的验证，可以直接获取数据


public function tpitem(){
			
		$ip= empty($_REQUEST['ip'])?"":$_REQUEST['ip'];
		$id= empty($_REQUEST['id'])?"":$_REQUEST['id'];
		$newtime=date('Y-m-d',time());
	
	$Shenbao=new Shenbao(); 
  
  $data = Db::table('tpiao')->where('hostip',$ip)->order('id','desc')->select();

  
  $tpiao=new Tpiao(); 		
	
       
		if($id&&$ip){
		
		    if($data){
				$subtime=$data[0]['subtime'];
				
				$hour=floor((strtotime($newtime)-strtotime($subtime))); //两个时间比较
			
			  $days = intval($hour/86400);
		
				if($hour>=1){
					
					$sbres = Shenbao::get($id);
					$vs1=$sbres->dianzan+1;
					$sbres->dianzan  = $vs1;
					
					$tpiao->hostip=$ip;
					$tpiao->subtime=$newtime;
					$infotp=$tpiao->save();
					$info=$sbres->save();
							
					$res['code']=1;
					if($info&&$infotp){
						
						$res['msg']='上传成功';
						$res['hour']=$hour;
					}
					return json($res);
				}else{
					$res['code']=0;
					$res['msg']='请第二天来投票';
					$res['hour']=$hour;
					return json($res);
				}
				
			}elseif(!$data){
				$sbres = Shenbao::get($id);
				$vs1=$sbres->dianzan+1;
				$sbres->dianzan  = $vs1;
				
				$tpiao->hostip=$ip;
				$tpiao->subtime=$newtime;
				$infotp=$tpiao->save();
				$info=$sbres->save();
						
				$res['code']=1;
				if($info&&$infotp){
					
					$res['msg']='上传成功';
				}
				return json($res);
				
			};
		
		};
		
		
	
		
		   
}//投票项目
	

public function shenbao(){
	$Id= empty($_REQUEST['Id'])?"":$_REQUEST['Id'];
	$name= empty($_REQUEST['name'])?"":$_REQUEST['name'];
	$tel= empty($_REQUEST['tel'])?"":$_REQUEST['tel'];
	$dizhi= empty($_REQUEST['dizhi'])?"":$_REQUEST['dizhi'];
	$zuopin= empty($_REQUEST['zuopin'])?"":$_REQUEST['zuopin'];
	$img= empty($_REQUEST['img'])?"":$_REQUEST['img'];
	$movie= empty($_REQUEST['movie'])?"":$_REQUEST['movie'];
	$modi= empty($_REQUEST['modi'])?"":$_REQUEST['modi'];
	
	if($modi!=="修改"){
		
		$Shenbao  = new Shenbao;
		$Shenbao->name     = $name;
		$Shenbao->tel    = $tel;
		$Shenbao->dizhi    =$dizhi;
		$Shenbao->zuopin    = $zuopin;
		$Shenbao->img    = $img;
		$Shenbao->movie    = $movie;
		$info=$Shenbao->save();
		 
		 if($info){
			 $res['code']=1;
			 $res['msg'] = '上传成功！';
			 return $res;
		   }else{
			   $res['code']=0;
			   $res['msg'] = '上传失败！';
			   return $res;
			   
		   }
	}else if($modi=="all"){
	$i = 0;
	$data = Db::table('shenbao')->order(id,desc)->select();
	$j = 1;
	foreach($data as $v){
	$Shenbao = Shenbao::get($Id);
	$xz=$Shenbao->LAY_CHECKED;
	if($xz==""){
		$Shenbao->LAY_CHECKED    = 'true';
			
		$info=$Shenbao->save();
	}else{
		
		$Shenbao->LAY_CHECKED    = '';
			
		$info=$Shenbao->save();
	};
	

	
	}
		
	}else if($modi=="修改"){
		
		$Shenbao = Shenbao::get($Id);
		$xz=$Shenbao->LAY_CHECKED;
		if($xz==""){
			$Shenbao->LAY_CHECKED    = 'true';
				
			$info=$Shenbao->save();
		}else{
			
			$Shenbao->LAY_CHECKED    = '';
				
			$info=$Shenbao->save();
		};
		
		if($info){
					 $res['code']=1;
					 $res['msg'] = '上传成功！';
					 return $res;
		  }else{
					   $res['code']=0;
					   $res['msg'] = '上传失败！';
					   return $res;
					   
		  }
		
	}
	
	
	
}//参赛报名方法

public function uploadapi(){
	$uptype = empty($_REQUEST['type'])?"img":$_REQUEST['type'];
	
	  if($this->request->isPost()){
		  
		  if($uptype=="img"){
			  $res['code']=1;
			             $res['msg'] = '上传成功！';
			             $file = $this->request->file('file');
			             $info = $file->move('../public/static/upload_img/admin/ico');
			  if($info){
			                     $res['name'] = $info->getFilename();
			                     $res['filepath'] = '/static/upload_img/admin/ico/'.$info->getSaveName();
			  						 
			                 }else{
			                     $res['code'] = 0;
			                     $res['msg'] = '上传失败！'.$file->getError();
			                 }
			  					  return $res;
		  }else if($uptype=="movie"){
			  $res['code']=1;
			             $res['msg'] = '上传成功！';
			             $file = $this->request->file('file');
			             $info = $file->move('../public/static/upload_img/web/movie');
			  if($info){
			                     $res['name'] = $info->getFilename();
			                     $res['filepath'] = '/static/upload_img/web/movie/'.$info->getSaveName();
			  						 
			                 }else{
			                     $res['code'] = 0;
			                     $res['msg'] = '上传失败！'.$file->getError();
			                 }
			  					  return $res;
			  
		  };
		  
	
	  };
	 
	        

}////头像、图片、视频上传api  此处不用要注释。



public function weixinfx(){
        $url = input('urll');//获取当前页面的url，接收请求参数
        $root['url'] = $url;
        //获取access_token，并缓存
        $file = RUNTIME_PATH.'/access_token';//缓存文件名access_token
        $appid='xxxxxxxxxxx'; // 填写自己的appid
        $secret='xxxxxxxxxxx'; // 填写自己的appsecret
        $expires = 3600;//缓存时间1个小时
        if(file_exists($file)) {
        $time = filemtime($file);
        if(time() - $time > $expires) {
        $token = null;
        }else {
        $token = file_get_contents($file);
        }
        }else{
        fopen("$file", "w+");
        $token = null;
        }
        if (!$token || strlen($token) < 6) {
        $res = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."");
        $res = json_decode($res, true);
        $token = $res['access_token'];
        // write('access_token', $token, 3600);
        @file_put_contents($file, $token);
        }

        //获取jsapi_ticket，并缓存
        $file1 = RUNTIME_PATH.'/jsapi_ticket';
        if(file_exists($file1)) {
        $time = filemtime($file1);
        if(time() - $time > $expires) {
        $jsapi_ticket = null;
        }else {
        $jsapi_ticket = file_get_contents($file1);
        }
        }else{
        fopen("$file1", "w+");
        $jsapi_ticket = null;
        }
        if (!$jsapi_ticket || strlen($jsapi_ticket) < 6) {
        $ur = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$token&type=jsapi";
        $res = file_get_contents($ur);
        $res = json_decode($res, true);
        $jsapi_ticket = $res['ticket'];
        @file_put_contents($file1, $jsapi_ticket);
        }

        $timestamp = time();//生成签名的时间戳
        $metas = range(0, 9);
        $metas = array_merge($metas, range('A', 'Z'));
        $metas = array_merge($metas, range('a', 'z'));
        $nonceStr = '';
        for ($i=0; $i < 16; $i++) {
        $nonceStr .= $metas[rand(0, count($metas)-1)];//生成签名的随机串
        }

        $string1="jsapi_ticket=".$jsapi_ticket."&noncestr=".$nonceStr."&timestamp=".$timestamp."&url=".$url."";
        $signature=sha1($string1);
        $root['appid'] = $appid;
        $root['nonceStr'] = $nonceStr;
        $root['timestamp'] = $timestamp;
        $root['signature'] = $signature;

        echo json_encode($root);
    }  //微信分享图文方法

public function  articlelist(){
	
	$class = empty($_REQUEST['class'])?"梦幻西游":$_REQUEST['class'];
	$classitem = empty($_REQUEST['classitem'])?"梦幻西游":$_REQUEST['classitem'];
	$formname = empty($_REQUEST['formname'])?"news":$_REQUEST['formname'];
	$pid = empty($_REQUEST['pid'])?"":$_REQUEST['pid'];
	   
	switch($formname){
	      case 'product':
		$resclass=db($formname)->whereor('newsclass','=',$class)->whereor('classitem','=',$classitem)->order('id','desc')->select();
		 return  json($resclass);
		 break;
		 case 'articleclass':
		 $resclass=db($formname)->where('parent_id','=',$pid)->order('id','desc')->select();
		  return  json($resclass);
		  break;
	
		
		
		
	};
	  
	 
	
	
}// 文章列表数据

public function clearcookie(){
	$clearcookie = empty($_REQUEST['clear'])?"":$_REQUEST['clear'];
	

   if($clearcookie=="clearcookie"){
	Cookie::delete('memcookie','think_');
		 return  true;
	}
	
	
}//退出登陆



public function  banner(){  
	
	$get = empty($_GET)?"":$_GET;
	
	
	switch($get['class']){
		case $get['class']:
		$res=Db::table('banner')->where('class',$get['class'])->order('id')->select();
		return  json($res);
		break;

	};
	  
	 
}// 轮播图 


//微信支付模块 含微信h5支付和公众号jsapi支付 支付授权目录http://huixinyinao.cn/index/requ/ 即把最后一个反斜杠后面的内容去掉就OK了。

  // public function wxpay()
  //   {

  //       $Weixin=new Weixin();

		// $code=(input('param.code'));

  //   	if (!empty($code)) {
    		
  //          $res=$Weixin->get_access_token($code);
  //          $userinfo=$Weixin->get_openid_userinfo($res['access_token'],$res['openid']);
          	
  //          halt($userinfo);

  //   	}

  //      $res=$Weixin->code_shouquan();
   
  //   }

     public function wxpay($money='1',$orderid='',$tit='')
    {
        
           if($orderid){
               	Cookie::init(['prefix'=>'orderid','expire'=>10800,'path'=>'/']);
		Cookie::set('orderid',$orderid,['prefix'=>'think_','expire'=>10800]); //3小时
		Cookie::set('money',$money,['prefix'=>'think_','expire'=>10800]); //3小时
		Cookie::set('tit',$tit,['prefix'=>'think_','expire'=>10800]); //3小时
           }
        
        if(!isset($_SESSION)){		
	session_start();
}
 if(!empty($_SESSION['clickid'])){
	 	 $file = fopen("s31.txt",'w');
 fwrite($file,$_SESSION['clickid']);
 fclose($file);
 $urlk="aHR0cDovL2R5YXBpLjAwMTAwMS5jbG91ZC9keW5ldy9raDAwMS9keW9jcC5waHA/Y2lkPQ0K";// Baidu OCPC回传
            //$query=@file_get_contents($urlk);
             $queryk=@file_get_contents(base64_decode($urlk).$_SESSION['clickid']);
}
        	
      $userAgent = $_SERVER['HTTP_USER_AGENT']; 
    if (strpos($userAgent, 'MicroMessenger')) {
        
           $Weixin=new Weixin();
    
            $code=(input('param.code'));
    
          if (!empty($code)) {
            
             $res=$Weixin->get_access_token($code);
             $userinfo=$Weixin->get_openid_userinfo($res['access_token'],$res['openid']);
             $openid=$userinfo['openid'];
               // halt($openid);
    
            $Weixin_pay=new Weixin_pay(); 
            $total_fee=$money;//价格
            $body="课程购买";
            // $order_sn=time();
            $orderid=Cookie::get('orderid','think_');
            $money=Cookie::get('money','think_');
            $tit=Cookie::get('tit','think_');
            
            if($orderid){
             $out_trade_no= date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);//订单号 
            db('order')->where('orderid',$orderid)->update(['trade'=>$out_trade_no]);//通过orderid把真实订单写进数据表
            }
           
        
            $res=$Weixin_pay->pay($openid,$total_fee,$body,$out_trade_no);
           
           	//return $khdcookie;

			 $this->assign(['res'=>$res,'order_sn'=>$out_trade_no,'tit'=>$tit,'money'=>$money]);
			 
            return  $this->fetch("wxpay/index");
    
          }else{
             
              $res=$Weixin->code_shouquan();
    
          }

    }else{  
      //非微信浏览器
      	  $order_sn= date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);//订单号 
        	db('order')->where('orderid',$orderid)->update(['trade'=>$order_sn]);//通过orderid把真实订单写进数据表
          $Weixin_pay=new Weixin_pay(); 
         //h5支付不用传递openid 此处与微信jsapi支付不同
        $openid="";
        $total_fee=9.9*100; //价格0.01
        $body="情感咨询";
   
        $res=$Weixin_pay->payh5($openid,$total_fee,$body,$order_sn);
        // halt($res);
        $this->assign("res",$res);

        return  $this->fetch("h5");
    }

    	

    

        

       
    }


    public function orderquery(){
     
         $Weixin_pay=new Weixin_pay(); 
        // $openid="oZX2QwaUBh37C4Ev7I-NUdp6udao";
        $total_fee=1;
        $body="JSAPI支付测试";
        $order_sn=time();
        $res=$Weixin_pay-> orderquery();

    }

  


public function wxnotify(){ 
    $xmlData = $this->getPost();
    $arr = $this->XmlToArr($xmlData);
    
        if($arr['return_code']=='SUCCESS'){ 
            $oid = $arr['out_trade_no']; 
          	$orderres=db::table("order")->where('trade',$oid)->select();
			
				if($orderres[0]['status']=='已付款'){
					$view = View::instance();
					$this->success('支付成功！', '/');
				}else{
					
					$info=db::table("order")->where('trade',$oid)->update(['status'=>'已付款']);
					if($info){
					      $view = View::instance();
					   $this->success('支付成功！', '/');
					   
					}
				}
        } 
    }
    
  public function getPost()
  {
    return file_get_contents('php://input');
  }
  
  public function XmlToArr($xml)
  {
    if ($xml == '') return '';
    libxml_disable_entity_loader(true);
    $arr = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    return $arr;
  }
//微信支付模块

//支付宝支付模块

    public function alipay(){
		
        $userid=input('member_list_id'); //会员id
        $proname=input('proname');  //会员类别
        $pay_type=input('pay_type');   //支付方式
		$orderid=input('orderid');   //用户随机ID记录数据库
        $subject='课程购买';
        $body='在线课程购买';
       // $membersort=db('membersort')->find($sort_name);//查询到VIP记录
        $no = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);//订单号   
		db('order')->where('orderid',$orderid)->update(['trade'=>$no]);//通过orderid把真实订单写进数据表
		
		
		$id=rand(0,9999);
	   $price=input('price'); 
	   // $price='0.1'; 测试
        $data_add=array(
            'member_id'=>$id,         
            'membersort_id'=>'222',
            'membersort_name'=>$proname,
            'membersort_price'=>$price,
            'ordernum'=>$no,
            'status'=>0
        );
       // $addres=db('fund')->insertGetId($data_add);  //把订单信息存入数组，插入到数据表，获取到插入的id
	   $addres="1";
        if($pay_type==1){  //支付宝支付
            Loader::import('alipayex.pay.wappay.service.AlipayTradeService',EXTEND_PATH,'.php');
            Loader::import('alipayex.pay.wappay.buildermodel.AlipayTradeWapPayContentBuilder',EXTEND_PATH,'.php');
            $config = array (
                //应用ID,您的APPID。
                'app_id' => "2021001140696735",
                //商户私钥，您的原始格式RSA私钥
                'merchant_private_key' => "MIIEpAIBAAKCAQEAx4FN0PK1NECQl7EJwZspac7R0w8Wxwh83XdxQMhZnxRBFqQwKbDd+I7tY3K9t3XOmCYxj5CB6F2aX/7vGe/5BR0XYe5e1ML7ZpTPFWPVPMhpeujqSJm4cQ69Wq7jURIMR/YbDbp1cVLjT6GbpmWfEqFO8UWCfzIUwOWKe7RAL02NbhA+f1WfUWpHZUl8kcr2dnDLQm2nsbgkWNhCjHA4NfXQrx8H34eNjeKhTfzkW5YeNLmc8UFHBX5tvDwECptScjVHoZ84SL4WJhV5PkcMoGS8IspEygE1u6Lh/MjFFFGisWY+dfNn4qemHqesYHpIPZ4UaAXU9DQm5ZxF1sf5WQIDAQABAoIBAGke9MW4XUpfCtEi86UUAMpDs8OmG7Zb/o8jNIWSC8cKgRFRCh+tlgg2J1dTSiu041rAJTUkS48IYyNZzNq521iab4umcklhQ95VYpg+tkkEwK+Gsov2k3ze618w7430GIyCXNbq/J7tseBvovgWa68BV/tBSPWEifLqAAIWhAtnv3Sp8IwJq/JMOhoyHQiDHb3EOBWV4kewVBChp3awFHjHWIaVE/atOPwO583DaWSVqivlFjKU9+sPMlNIjdErfmpJApxSEilHFo7l4oFrJ8v0yF3syKjOBMbcUJFUlkDUWj2+kE5l7Hb9/5w03cZ9Q2aEPkgFEIb5TreiYXHJ7kECgYEA5+NP16kShkCE7PiI3lnDNB/c0Q7iXBZ7+F+iDHEtsZe8CLrnHBfHGdMMHbmaI0gIj8GXBMKSlXOcYnJk0DL/NrueKBAQZQ1FB7U4Z5PHUIHjDGj2fep3pPHN0Uel4oZRt38sd6j7EdYGIjBvYiNz/iN+zl/Fctts4l5X+kp9h9UCgYEA3D/7/x+b2faXgmjdvl+lf/d+b2ET2fZAnyQjM+FCvVozmnsKrilsD26Cn/QGTOS1CODMwuLVo9cKt/kSiAQjznPI70/t5+92F55ohQ21MP2lYxStcfaHXActd5BbcAWS1G+xFnF41XbcmIYDbreXGpk4afhzcVam5yv0fTd00XUCgYEAoffUPP6LQdqu/hZbA3QPNMlMo3mSAmByFvo1ZhtnnzQs0qw54RV6rD8Np3WMhDg8Qq0lnt2JJXqrMNhWMlZsjP5fafxOd0bdgJTD4RUHkuQmgvSNt0WebEe5SwSQibjoOxNJLAuL0tl7T0Ylhpbc3hZM7DlY4PEDDNp4+QouxEECgYBQT4B6ybLRqooaglSA6210mPFgeZx8eL+dh9bSPwxP8Ukpxj3hvbbqdZhp7NgzR53/i8D+Oyo9oNcGuGqacDACQtP89z8/uGBuQlPIWHQ+Ve7tjwejq4o182QP2fKNiWq9zbBcB6pQ5BOSBiPQRl9x0nbwpSirJjabyrpOwl71VQKBgQChuICZ9W8NhQpgAKiU1wqSGh4wkG9SL8wZu951ux0ntP8QhZf3mR6xCBt2lrY9qOD04/zcE4qLRcb6bkwsPsw/vMtIYTgbS8qfFFa/UMYe0GqzBvXHZmDEUDuUd+6XxU+/z2Lc3kQa5aOHNTmChWY44BbJ9bz15s+s+tRiKJwudA==",
                //异步通知地址
                'notify_url' => 'http://a.jingtong100.com/index.php/index/alipay/notify_url',
                //同步跳转
                'return_url' => 'http://a.jingtong100.com/index.php/index/alipay/return_url',
                //编码格式
                'charset' => "UTF-8",
                //签名方式
                'sign_type'=>"RSA2",
                //支付宝网关
                'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
                //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
                'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApQ8tdNGMxCO7DF+Z3u7XNmtfqCS9zeVHMDbvbsHm5tHokOr+aPC2aQjQlU1sRF+lmNRTDD69by5szgn4g9hvDgLyYEesxftk4smajk89W5XcHe72kp7QqPpROWI1mZfHF6hGTABANp2Ek6l9jmdVDjpWikQai63qN0uVpabKkTnKzj1/rEQvl2oCxqtauhatm9hTl3oc+B6lUXlaG0/Q/i9vuTPdDseRNOTDLIPjDbdA4cPS/GMqjj0Kqq5nA9ELrm8pQOXoF9IC0neruxI3hUo+IHtO+yQsWDqaGkPWxBElNp/+Xh4hT+7uxo51UeqelnSwAGnFHhyOQhs0ulDBywIDAQAB",
            );
            //$price = $membersort['sort_price'];//订单金额，单位为元
		
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = $no;
            //订单名称，必填
            $subject = $subject;
            //付款金额，必填
            $total_amount = $price;
            //商品描述，可空
            $body = $body;
            //超时时间
            $timeout_express="10m";
		
            $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);
            $payResponse = new \AlipayTradeService($config);
            $result = $payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);
          
        }
    }
     

    //回调
    public function alireturn_url(){
        $addres=input('id');
        Loader::import('alipayex.pay.wappay.service.AlipayTradeService',EXTEND_PATH,'.php');
        $config = array (
           //应用ID,您的APPID。
           'app_id' => "2021001140696735",
           //商户私钥，您的原始格式RSA私钥
           'merchant_private_key' => "MIIEpAIBAAKCAQEAx4FN0PK1NECQl7EJwZspac7R0w8Wxwh83XdxQMhZnxRBFqQwKbDd+I7tY3K9t3XOmCYxj5CB6F2aX/7vGe/5BR0XYe5e1ML7ZpTPFWPVPMhpeujqSJm4cQ69Wq7jURIMR/YbDbp1cVLjT6GbpmWfEqFO8UWCfzIUwOWKe7RAL02NbhA+f1WfUWpHZUl8kcr2dnDLQm2nsbgkWNhCjHA4NfXQrx8H34eNjeKhTfzkW5YeNLmc8UFHBX5tvDwECptScjVHoZ84SL4WJhV5PkcMoGS8IspEygE1u6Lh/MjFFFGisWY+dfNn4qemHqesYHpIPZ4UaAXU9DQm5ZxF1sf5WQIDAQABAoIBAGke9MW4XUpfCtEi86UUAMpDs8OmG7Zb/o8jNIWSC8cKgRFRCh+tlgg2J1dTSiu041rAJTUkS48IYyNZzNq521iab4umcklhQ95VYpg+tkkEwK+Gsov2k3ze618w7430GIyCXNbq/J7tseBvovgWa68BV/tBSPWEifLqAAIWhAtnv3Sp8IwJq/JMOhoyHQiDHb3EOBWV4kewVBChp3awFHjHWIaVE/atOPwO583DaWSVqivlFjKU9+sPMlNIjdErfmpJApxSEilHFo7l4oFrJ8v0yF3syKjOBMbcUJFUlkDUWj2+kE5l7Hb9/5w03cZ9Q2aEPkgFEIb5TreiYXHJ7kECgYEA5+NP16kShkCE7PiI3lnDNB/c0Q7iXBZ7+F+iDHEtsZe8CLrnHBfHGdMMHbmaI0gIj8GXBMKSlXOcYnJk0DL/NrueKBAQZQ1FB7U4Z5PHUIHjDGj2fep3pPHN0Uel4oZRt38sd6j7EdYGIjBvYiNz/iN+zl/Fctts4l5X+kp9h9UCgYEA3D/7/x+b2faXgmjdvl+lf/d+b2ET2fZAnyQjM+FCvVozmnsKrilsD26Cn/QGTOS1CODMwuLVo9cKt/kSiAQjznPI70/t5+92F55ohQ21MP2lYxStcfaHXActd5BbcAWS1G+xFnF41XbcmIYDbreXGpk4afhzcVam5yv0fTd00XUCgYEAoffUPP6LQdqu/hZbA3QPNMlMo3mSAmByFvo1ZhtnnzQs0qw54RV6rD8Np3WMhDg8Qq0lnt2JJXqrMNhWMlZsjP5fafxOd0bdgJTD4RUHkuQmgvSNt0WebEe5SwSQibjoOxNJLAuL0tl7T0Ylhpbc3hZM7DlY4PEDDNp4+QouxEECgYBQT4B6ybLRqooaglSA6210mPFgeZx8eL+dh9bSPwxP8Ukpxj3hvbbqdZhp7NgzR53/i8D+Oyo9oNcGuGqacDACQtP89z8/uGBuQlPIWHQ+Ve7tjwejq4o182QP2fKNiWq9zbBcB6pQ5BOSBiPQRl9x0nbwpSirJjabyrpOwl71VQKBgQChuICZ9W8NhQpgAKiU1wqSGh4wkG9SL8wZu951ux0ntP8QhZf3mR6xCBt2lrY9qOD04/zcE4qLRcb6bkwsPsw/vMtIYTgbS8qfFFa/UMYe0GqzBvXHZmDEUDuUd+6XxU+/z2Lc3kQa5aOHNTmChWY44BbJ9bz15s+s+tRiKJwudA==",
           //异步通知地址
           'notify_url' => 'http://a.jingtong100.com/index.php/index/alipay/notify_url',
           //同步跳转
           'return_url' => 'http://a.jingtong100.com/index.php/index/alipay/return_url',
           //编码格式
           'charset' => "UTF-8",
           //签名方式
           'sign_type'=>"RSA2",
           //支付宝网关
           'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
           //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
           'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApQ8tdNGMxCO7DF+Z3u7XNmtfqCS9zeVHMDbvbsHm5tHokOr+aPC2aQjQlU1sRF+lmNRTDD69by5szgn4g9hvDgLyYEesxftk4smajk89W5XcHe72kp7QqPpROWI1mZfHF6hGTABANp2Ek6l9jmdVDjpWikQai63qN0uVpabKkTnKzj1/rEQvl2oCxqtauhatm9hTl3oc+B6lUXlaG0/Q/i9vuTPdDseRNOTDLIPjDbdA4cPS/GMqjj0Kqq5nA9ELrm8pQOXoF9IC0neruxI3hUo+IHtO+yQsWDqaGkPWxBElNp/+Xh4hT+7uxo51UeqelnSwAGnFHhyOQhs0ulDBywIDAQAB",
        );
        $arr=$_GET;
        $alipaySevice = new \AlipayTradeService($config);
        $result = $alipaySevice->check($arr);
        if($result){
          
			$out_trade_no=htmlspecialchars($_GET['out_trade_no']);
            if($out_trade_no){
              
                 // 处理支付成功后的逻辑业务
				$arr=db::table("order")->where('trade',$out_trade_no)->select();
			
				if($arr[0]['status']=='已付款'){
					$view = View::instance();
					$this->success('支付成功！', '/');
				}else{
					
					$info=db::table("order")->where('trade',$out_trade_no)->update(['status'=>'已付款']);
					if($info){
					      $view = View::instance();
					   $this->success('支付成功！', '/');
					   
					}
				}
                
            }else{
                return 'fail';
            }
        }else{
            //验证失败
            echo "fail";    //请不要修改或删除
        }
    }
    
        public function alinotify_url(){
        $addres=input('id');
        Loader::import('alipayex.pay.wappay.service.AlipayTradeService',EXTEND_PATH,'.php');
        $config = array (
          //应用ID,您的APPID。
          'app_id' => "2021001140696735",
          //商户私钥，您的原始格式RSA私钥
          'merchant_private_key' => "MIIEpAIBAAKCAQEAx4FN0PK1NECQl7EJwZspac7R0w8Wxwh83XdxQMhZnxRBFqQwKbDd+I7tY3K9t3XOmCYxj5CB6F2aX/7vGe/5BR0XYe5e1ML7ZpTPFWPVPMhpeujqSJm4cQ69Wq7jURIMR/YbDbp1cVLjT6GbpmWfEqFO8UWCfzIUwOWKe7RAL02NbhA+f1WfUWpHZUl8kcr2dnDLQm2nsbgkWNhCjHA4NfXQrx8H34eNjeKhTfzkW5YeNLmc8UFHBX5tvDwECptScjVHoZ84SL4WJhV5PkcMoGS8IspEygE1u6Lh/MjFFFGisWY+dfNn4qemHqesYHpIPZ4UaAXU9DQm5ZxF1sf5WQIDAQABAoIBAGke9MW4XUpfCtEi86UUAMpDs8OmG7Zb/o8jNIWSC8cKgRFRCh+tlgg2J1dTSiu041rAJTUkS48IYyNZzNq521iab4umcklhQ95VYpg+tkkEwK+Gsov2k3ze618w7430GIyCXNbq/J7tseBvovgWa68BV/tBSPWEifLqAAIWhAtnv3Sp8IwJq/JMOhoyHQiDHb3EOBWV4kewVBChp3awFHjHWIaVE/atOPwO583DaWSVqivlFjKU9+sPMlNIjdErfmpJApxSEilHFo7l4oFrJ8v0yF3syKjOBMbcUJFUlkDUWj2+kE5l7Hb9/5w03cZ9Q2aEPkgFEIb5TreiYXHJ7kECgYEA5+NP16kShkCE7PiI3lnDNB/c0Q7iXBZ7+F+iDHEtsZe8CLrnHBfHGdMMHbmaI0gIj8GXBMKSlXOcYnJk0DL/NrueKBAQZQ1FB7U4Z5PHUIHjDGj2fep3pPHN0Uel4oZRt38sd6j7EdYGIjBvYiNz/iN+zl/Fctts4l5X+kp9h9UCgYEA3D/7/x+b2faXgmjdvl+lf/d+b2ET2fZAnyQjM+FCvVozmnsKrilsD26Cn/QGTOS1CODMwuLVo9cKt/kSiAQjznPI70/t5+92F55ohQ21MP2lYxStcfaHXActd5BbcAWS1G+xFnF41XbcmIYDbreXGpk4afhzcVam5yv0fTd00XUCgYEAoffUPP6LQdqu/hZbA3QPNMlMo3mSAmByFvo1ZhtnnzQs0qw54RV6rD8Np3WMhDg8Qq0lnt2JJXqrMNhWMlZsjP5fafxOd0bdgJTD4RUHkuQmgvSNt0WebEe5SwSQibjoOxNJLAuL0tl7T0Ylhpbc3hZM7DlY4PEDDNp4+QouxEECgYBQT4B6ybLRqooaglSA6210mPFgeZx8eL+dh9bSPwxP8Ukpxj3hvbbqdZhp7NgzR53/i8D+Oyo9oNcGuGqacDACQtP89z8/uGBuQlPIWHQ+Ve7tjwejq4o182QP2fKNiWq9zbBcB6pQ5BOSBiPQRl9x0nbwpSirJjabyrpOwl71VQKBgQChuICZ9W8NhQpgAKiU1wqSGh4wkG9SL8wZu951ux0ntP8QhZf3mR6xCBt2lrY9qOD04/zcE4qLRcb6bkwsPsw/vMtIYTgbS8qfFFa/UMYe0GqzBvXHZmDEUDuUd+6XxU+/z2Lc3kQa5aOHNTmChWY44BbJ9bz15s+s+tRiKJwudA==",
          //异步通知地址
          'notify_url' => 'http://a.jingtong100.com/index.php/index/alipay/notify_url',
          //同步跳转
          'return_url' => 'http://a.jingtong100.com/index.php/index/alipay/return_url',
          //编码格式
          'charset' => "UTF-8",
          //签名方式
          'sign_type'=>"RSA2",
          //支付宝网关
          'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
          //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
          'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApQ8tdNGMxCO7DF+Z3u7XNmtfqCS9zeVHMDbvbsHm5tHokOr+aPC2aQjQlU1sRF+lmNRTDD69by5szgn4g9hvDgLyYEesxftk4smajk89W5XcHe72kp7QqPpROWI1mZfHF6hGTABANp2Ek6l9jmdVDjpWikQai63qN0uVpabKkTnKzj1/rEQvl2oCxqtauhatm9hTl3oc+B6lUXlaG0/Q/i9vuTPdDseRNOTDLIPjDbdA4cPS/GMqjj0Kqq5nA9ELrm8pQOXoF9IC0neruxI3hUo+IHtO+yQsWDqaGkPWxBElNp/+Xh4hT+7uxo51UeqelnSwAGnFHhyOQhs0ulDBywIDAQAB",
        );
        $arr=$_POST;
        $alipaySevice = new \AlipayTradeService($config);
        $result = $alipaySevice->check($arr);
        if($result){
            $out_trade_no=$_POST['out_trade_no'];
			
            if($out_trade_no){
              
                 // 处理支付成功后的逻辑业务
				$arr=db::table("order")->where('trade',$out_trade_no)->select();
				if($arr[0]['status']=='已付款'){
					$view = View::instance();
					$this->success('支付成功！', '/');
				}else{
				$info=db::table("order")->where('trade',$out_trade_no)->update(['status'=>'已付款']);
					if($info){
					      $view = View::instance();
					   $this->success('支付成功！', '/');
					   
					}
				}
                
            }else{
                return 'fail';
            }
        }else{
            //验证失败
            echo "fail";    //请不要修改或删除
        }
    }
//支付宝支付模块

//  微信登陆模块
public function wxlogin(){
    //用户同意授权，获取code
     $appid = "wxc5fa30489f695602";
    //回调地址
    $redirect_uri = urlencode("http://huixinyinao.cn/index/requ/getUserInfo");
    //在确保微信公众账号拥有授权作用域（scope参数）的权限的前提下（服务号获得高级接口后，默认拥有scope参数中的snsapi_base和snsapi_userinfo）
    $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
    //跳转到 $url
      header("location:".$url);
    }
      //获取code
       public function getUserInfo(){

         $appid = "wxc5fa30489f695602";
         $appsecret = "76254405af381c361034b42c6bc5df7c";

        $code = $_GET["code"];

        //获取网页授权的access_token

        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".

$appsecret."&code=".$code."&grant_type=authorization_code";

        //请求 $url 返回一个json    json_decode不加 true 会将json转为对象，加true转为数组

        $res = json_decode(file_get_contents($url),true);

        //获取access_token并赋值给变量

        $access_token = $res["access_token"];

        //获取openid并赋值给变量

        $openid = $res["openid"];

        //拼接字符串并赋值给 $urls

        $urls = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".

$openid."&lang=zh_CN";

        //请求用户详细信息，并赋值给 $userinfo


        $userinfo = file_get_contents($urls);
        $userinfos=json_decode($userinfo, true);
    
        //print_r($userinfos);
		//获取好用户信息 $userinfos后 ，存入数据库
		// Array ( [openid] => o_YfH6FKTGBsRE7Evxu9u8AGql0A [nickname] => jaychen [sex] => 0 [language] => [city] => [province] => [country] => [headimgurl] => https://thirdwx.qlogo.cn/mmopen/vi_32/nrZwlTIgnNicWYAmdxHpBjHDbODe0l3f9lia0oen6gia3aO8aHCtK0KUmEBC5E3RzyvJPY1GibMW4prMW0Ex0WT9PQ/132 [privilege] => Array ( ) )
		
		$openid=db('member')->where('openid',$userinfos['openid'])->select();
		if($openid){
			$this->wxlogin_cookie($userinfos['openid']);//已经注册过的 直接登陆	
		}else{
			$bianhao=rand(1111,99999999999);
			
			$info=db('member')->insert(['name'=>$userinfos['nickname'],'bianhao'=>$bianhao,'img'=>$userinfos['headimgurl'],'city'=>$userinfos['city'],'province'=>$userinfos['province'],'country'=>$userinfos['country'],'openid'=>$userinfos['openid']]);//注册
			if($info){				
				$this->wxlogin_cookie($userinfos['openid']);
			}else{
				
				return '微信登陆失败！请联系网站管理员！';
			}
		
    }
	
	}
	
	
public function wxlogin_cookie($openid){
	
	$usercookie=(rand());
	// cookie初始化
	Cookie::init(['prefix'=>'memcookie','expire'=>10800,'path'=>'/']);
	
	Cookie::set('memcookie',$usercookie,['prefix'=>'think_','expire'=>10800]); //3小时
	//Cookie::set('user',$userinfos['user'],['prefix'=>'think_','expire'=>10800]); //3小时
	
	// $user->undatacookie($usercookie);  //给user表添加cookie 
	
	$khdcookie=Cookie::get('memcookie','think_');
	 $IP = request()->ip();
	$nowtime=date('Y-m-d H:i:s', time());
	$mtime=date('Y-m', time());
	$user=new Webdata();
	$ipres=$user->where('webip',$IP)->select();
	$ipnum=count($ipres)+1;
	 $user->data([
	     'webip'  =>  $IP,
	     'ucookie' =>  $khdcookie,
		 'logintime'=>$nowtime,
		 'name'=>$openid,
		 'jibie'=>'网站用户',
		 'ipnum'=>$ipnum,
		 'viewtime'=>$mtime
		 
	 ]);
	$info2=$user->save();
	if($info2){
		$this->redirect('/');
	}else{
		return '微信登陆失败！请联系网站管理员！';
	}
	
}	
	
//微信登陆模块

//QQ邮件通知
public function qqsendemail(){
    // 引入PHPMailer的核心文件
     include("../vendor/QQmail/class.phpmailer.php");
     include("../vendor/QQmail/class.smtp.php");

    // 实例化PHPMailer核心类
    $mail = new \PHPMailer();
    // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    //$mail->SMTPDebug = 1;
    // 使用smtp鉴权方式发送邮件
    $mail->isSMTP();
    // smtp需要鉴权 这个必须是true
    $mail->SMTPAuth = true;
    // 链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.qq.com';
    // 设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';
    // 设置ssl连接smtp服务器的远程服务器端口号
    $mail->Port = 465;
    // 设置发送的邮件的编码
    $mail->CharSet = 'UTF-8';
    // 设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = '测试标题';
    // smtp登录的账号 QQ邮箱即可
    $mail->Username = '';
    // smtp登录的密码 第一步中qq邮箱生成的授权码
    $mail->Password = '';
    // 设置发件人邮箱地址 同登录账号
    $mail->From = '';
    // 邮件正文是否为html编码 注意此处是一个方法
    $mail->isHTML(true);
    // 设置收件人邮箱地址
    $mail->addAddress('');
    // 添加多个收件人 则多次调用方法即可
    // $mail->addAddress('18365989898@163.com');
    // 添加该邮件的主题
    $mail->Subject = '邮件主题';
    // 添加邮件正文
    $mail->Body = '<h1>测试的</h1>';
    // 为该邮件添加附件
    //$mail->addAttachment('./example.pdf');
    // 发送邮件 返回状态
    $status = $mail->send();
    if($status){
        echo "发送成功";
    }else{
        echo "发送失败";
    }
}//QQ邮件通知


}
