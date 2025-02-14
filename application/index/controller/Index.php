<?php  //index模块下的  此控制器主要处理页面输出
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;
use think\Cookie;
use app\admin\model\User;
use app\admin\model\News;
use app\admin\model\Seo;
use app\admin\model\Forminfo;
use app\admin\model\Webplug;
use app\admin\model\Verifi;
use app\admin\model\Webdata;
use app\index\controller\Base;
use think\Image;
use think\Request;
use think\captcha\Captcha;//引用验证码类库


class Index  extends Base
{

public function index ($pro='消防产品',$newsd='公司新闻')
{

$view=View::instance();

//登录处理：输出页面前检查 cookie和IP是否有记录。没记录就登陆
	$khdcookie=Cookie::get('memcookie','think_');
	 $IP = request()->ip();
	
	 $iflogin=Db::table('webdata')->where('webip',$IP)->where('ucookie',$khdcookie)->select();	
	//return $iflogin[0]['name'];
	if(!$iflogin){
		
		//$this->redirect('/index/requ/wxlogin');//没有登陆就 跳转到微信授权登陆
		$this->assign(['iflogin'=>'no']);
		return $view->fetch('login1');
	}else{
		  $member=db('member')->where('user',$iflogin[0]['name'])->select();
		  $this->assign(['iflogin'=>'yes']);
		
	}
//登录处理	
  //会员信息

 //$member=db('member')->select();
  //会员信息
//微信图文分享处理 全局
$wxfx=db('seo')->where('Id',1)->select();
$this->assign(['wxfx'=>$wxfx]);//将值复制给JS全局变量
//微信图文分享处理
//获取IP
$IP = request()->ip();

$Seores = new Seo();
$seoinfo=$Seores->findseo();

  //单页内容
  $res = db('danyecon')->select();

  $danyeres =$res[0]['content'];
  //单页内容
  //网站插件
  $webplug = new Webplug();
  $res=$webplug->find(1);
  $webjsone =$res['jsone'];
   $webjstwo =$res['jstwo'];
  $weburl =$res['weburl'];
  //网站插件

  //文章列表
    $newsres=Db::table('news')->order('newssort')->select();


$userres = new User();
$user=$userres->find(1);	 
 

$this->assign([
	'seo'=>$seoinfo[0],
			'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
			'danyeres'=>$danyeres,
			'webjsone'=>$webjsone,
			'webjstwo'=>$webjstwo,
		    'member'=>$member,
			"IP"=>$IP,
			"weburl"=>$weburl,
			"news"=>$newsres,
			'user'=>$user
			
		]);
	


$this->view->engine->layout(false);  //打开layout模板

$arr=empty($_GET)?['p'=>'']:$_GET;
$ifpay=empty($_GET['ifpay'])?'不限':$_GET['ifpay'];
if(isset($arr['p'])){

switch($arr['p']){
  
	case'cart':
	//[["3",[["EDGE 30","NaN","2"],["EDGE 30 PRO","NaN","2"]]],["2",[["G5","3","2"],["G5 PLUS","3","1"]]]]
         $out_trade_no= date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);//订单号 

	 $this->assign(['pro'=>cookie('gwcdata'),'out_trade_no'=>$out_trade_no]);
	 
	  return $view->fetch('cart');
	  	  
	break;
		case'order':
	$orderdata=db('order')->where('Id',$arr['trid'])->where('hsz','Normal')->select();
	
	//return json($orderdata);
	 $this->assign(['orderdata'=>$orderdata]);  
	 
	  return $view->fetch('userorder');
	  	  
	break;
		case'orderlist':
	$orderkhsh=db('order')->where('userid',$member[0]['Id'])->where('status2','待客户审核')->where('hsz','Normal')->select();
	
	$testgwc=db('order')->where('hsz','Normal')->find(24);
	   
	 //print_r(json_decode($testgwc['buyarr'],true));
	   
	 $this->assign(['orderkhsh'=>$orderkhsh,'ddd'=>$testgwc['buyarr'],'memid'=>$member[0]['Id']]);  
	 
	  return $view->fetch('orderlist');
	  	  
	break;
	case'classification':
	$banner=db('banner')->where('class','zoujin')->select();
	 $this->assign(['banner'=>$banner]);
	  return $view->fetch('classification');
	break;
	case'complaint':
	  return $view->fetch('complaint');
	break;
	case'my':
	  return $view->fetch('my');
	break;
	case'product':
	
	if(isset($arr['sel'])&&$arr['sel']!==''){
		
			 $product=db('product')->where('newsclass|ejclass|sjclass|news_tit|zhlx','like','%'.$arr['sel'].'%')->where('hsz','Normal')->where('status','checked')->order('Id','desc')->paginate(40);
			$ejclassdata='';
			//搜索
		}else{
			if(isset($arr['class'])&&$arr['class']!==''){
	//检索第一个条件，第一个条件作为参数是默认在筛选条件里具备的		
			 if(isset($arr['ejclass'])&&$arr['ejclass']!==''&&$arr['sjclass']==''){
					
						 $product=db('product')->where('ejclass','like','%'.$arr['ejclass'].'%')->where('hsz','Normal')->where('status','checked')->order('Id','desc')->paginate(40);
					}else if(isset($arr['sjclass'])&&$arr['sjclass']!==''){
						
						 $product=db('product')->where('newsclass|ejclass|sjclass','like','%'.$arr['sjclass'].'%')->where('hsz','Normal')->where('status','checked')->order('Id','desc')->paginate(40);
					}else{
						$product=db('product')->where('newsclass|ejclass|sjclass','like','%'.$arr['class'].'%')->where('hsz','Normal')->where('status','checked')->order('Id','desc')->paginate(40);
						
					}
		
		//return json($product);
		 
		  $ejclassdata=self::newspage($arr['class'],'productc','');//二级分类
		  //return json($ejclassdata);
					 
			}else{
					      $product=db('product')->order('Id','desc')->where('status','checked')->where('hsz','Normal')->paginate(40);//全部产品，没有条件
						  $ejclassdata='';
			}
		}//selend	
	      $yjclass=db('productc')->where('parent_id',0)->select();//一级分类		
		 if(isset($arr['ejclass'])&&$arr['ejclass']!==''){
			 //return $arr['ejclass'];
			  $sjclassdata=self::newspage($arr['ejclass'],'productc','');//三级分类
			 
		 }else{
			  $sjclassdata='';
		 };
		  $this->assign(['yjclass'=>$yjclass,'product'=>$product,'ejclassdata'=>$ejclassdata,'sjclassdata'=>$sjclassdata]);
	
	  return $view->fetch('product');
	break;

    default:
    $banner=db('banner')->where('class','index')->where('status','checked')->order('sort','desc')->select();
	$productc=db('productc')->where('parent_id',0)->where('zhu','推荐')->order('sort','desc')->select();//一级分类
	$promf=db('product')->where('jiage',0)->where('hsz','Normal')->where('status','checked')->order('newstime','desc')->limit(8)->select();
	
	$fenlei=$this->newsTree('productc');
	
	
	 //分类的组装
	 $flarr=[];
	 foreach($productc as $a=>$b){
          $flarr[]=$b;
	     
		 $flarr[$a]['two']=db('productc')->where('parent_id',$b['Id'])->where('zhu','推荐')->order('sort','desc')->select();//查找二级分类
		 
		 if($flarr[$a]['two']){
			 foreach($flarr[$a]['two'] as $k=>$v){
				 
				  $flarr[$a]['two'][$k]['three']=db('productc')->where('parent_id',$v['Id'])->order('sort','desc')->where('zhu','推荐')->select();//查找三级分类
				  
			 } 
		 }
		
	 };
	 
	 //分类的组装
	  //print_r($flarr);
	  // return json($flarr);
	
	
	$zdpro=db('product')->where('status','checked')->where('hsz','Normal')->order('Id','desc')->limit(5)->select();//置顶产品
	$bkpro=db('product')->where('status','checked')->where('hsz','Normal')->order('views','desc')->limit(8)->select();//爆款清单
	
	$sjlike=db('product')->where('status','checked')->where('hsz','Normal')->orderRaw('rand()')->limit(8)->select();//猜你喜欢
	
	//计算 用户的 订单状态
	$orderkhtj=db('order')->where('hsz','Normal')->where('userid',$member[0]['Id'])->count();//提交订单
	$orderwuliu=db('order')->where('hsz','Normal')->where('userid',$member[0]['Id'])->where('wuliu','配送中')->count();//配送订单
	$orderkhsh=db('order')->where('hsz','Normal')->where('userid',$member[0]['Id'])->where('status2','待客户审核')->count();//待确认订单
		$ordersjqr=db('order')->where('hsz','Normal')->where('userid',$member[0]['Id'])->where('wuliu','未配送')->where('status2','客户提交')->count();//商店确认订单
		$orderqrsh=db('order')->where('hsz','Normal')->where('userid',$member[0]['Id'])->where('status2','已确认收货！')->count();//完成的订单
	//计算 用户的 订单状态
	
	$this->assign(['banner'=>$banner,'promf'=>$promf,'pro'=>$pro,'flarr'=>$flarr,'zdpro'=>$zdpro,'bkpro'=>$bkpro,'sjlike'=>$sjlike,'orderkhtj'=>$orderkhtj,'orderkhsh'=>$orderkhsh,'orderwuliu'=>$orderwuliu,'ordersjqr'=>$ordersjqr,'orderqrsh'=>$orderqrsh]);
	return $view->fetch('index');
}
	
}//if如果有电脑端链接



}


//供页面输出分类用
	
	  public static function newspage($class,$form,$arr)
	    {
		
	    $post=$_GET;
		
			$data=db($form)->select();
			 $pid=db($form)->where('name',$class)->select();
			 
			
			  $info=self::Sortpage($data,$pid[0]['Id'],$arr);
			 
	    return $info;
	    }
	  /**
	 对数据进行无极限分类
	**/
	    public static function Sortpage($data = [], $parent_id = 0, $level = 0,$arr='')
	    {     
			
	        if (!$data){
	            return false;
	        }
	         $arr = [];
	        foreach ($data as $k => $v) {
	            if ($v['parent_id'] == $parent_id) {
	               $v['level'] =$level;
	                $arr[]= $v;
	                unset($data[$k]);
	               //self::Sortpage($data, $v['Id'], $level+1);  
				
	            }
	        }
	         return $arr;
	    }
	
	//供页面输出分类用
	



    public static function screen($class,$name)
    {
	   
	  
	    $name_data=db($class)->where('name',$name)->select(); 
	   
		  $data=db($class)->select(); 
	
		  $info=self::newsSort($data,$name_data[0]['Id']);
		 
    return $info;
    }//供商品筛选细分分类使用

/**
     * 无限极分类
     * @param $data  数据
     * @return array|bool
     */
    public static function newsTree($class)
    {
	   
	    $data=db($class)->select(); 
		
		  $info=self::newsSort($data);
		 
    return $info;
    }
  /**
 对数据进行无极限分类
**/
 
	
	public static function newsSort($data = [], $parent_id = 0, $level = 0)
	{
	    if (!$data){
	        return false;
	    }
	    static $arr = [];
	    foreach ($data as $k => $v) {
	        if ($v['parent_id'] == $parent_id) {
	           $v['level'] =$level;
	            $arr[]= $v;
	            unset($data[$k]);
	           self::newsSort($data, $v['Id'], $level+1);
	        }
	    }
	    return $arr;
	}




public function product()
{

   $selval=empty($_REQUEST['selval'])?'':$_REQUEST['selval'];



    return json($list);
// $view=View::instance();
// $this->view->engine->layout(true);  //打开layout模板
// $Seores = new Seo();
// $seoinfo=$Seores->findseo();
// $this->assign([
// 		   'seotitle'=>$seoinfo[0]['seotitle'],
// 			'seoseokey'=>$seoinfo[0]['seokey'],
// 			'seoseodsc'=>$seoinfo[0]['seodsc'],
// 			'seoseoheader'=>$seoinfo[0]['seoheader'],
// 			'selval'=>$selval
		
// 	]);

// return $view->fetch('product');



}




public function selnews(){
	$selval=empty($_REQUEST['selval'])?'':$_REQUEST['selval'];	//搜索关键词
	// 查询状态为1的用户数据 并且每页显示10条数据
		$where['news_tit'] = array('like','%'.$selval.'%'); //模糊查询
		
	$list = Db::name('news')->whereor($where)->order('id desc')->paginate();
	
	// 把分页数据赋值给模板变量list
	$this->assign('list', $list);

	// 查询状态为1的用户数据 并且每页显示10条数据
	$list = Db::name('articleclass')->paginate();
	// 把分页数据赋值给模板变量list

	// unset($arr['']);  
	// $arr = array_flip($arr);

  foreach($list as $k=>$v){
  if($v['class'] == ''){
  unset($list[$k]);
  }
  }  //利用foreach 把数组的某一组删掉


	$this->assign('listclass', $list);
	
	
	// 查询状态为1的用户数据 并且每页显示10条数据
	$list = Db::name('articleclass')->paginate();
	

	// 把分页数据赋值给模板变量list
	$this->assign('classitem', $list);
	
$view=View::instance();
$this->view->engine->layout(true);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
			'selval'=>$selval
		
	]);

return $view->fetch('news');

	
	
}






public function openhours ()
{
	
  $res=Db::table('danyecon')->order('ID')->where('ID','1')->select();
	  
$view=View::instance();
$this->view->engine->layout(false);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
		    'res'=>$res[0]['content']
	]);

return $view->fetch('openhours');

}
public function tips ()
{
	
	 $res=Db::table('danyecon')->order('ID')->where('ID','2')->select();
$view=View::instance();
$this->view->engine->layout(false);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
		    'res'=>$res[0]['content']
	]);

return $view->fetch('tips');

}


public function captcha(){
	
	$config =    [
	    // 验证码字体大小
	    'fontSize'    =>    38,    
	    // 验证码位数
	    'length'      =>    4,   
	    // 关闭验证码杂点
	    'useNoise'    =>    true, 
	];
	$captcha = new Captcha($config);
	return $captcha->entry();	
	
}//验证码

public function shop ()
{
$view=View::instance();
$this->view->engine->layout(false);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
		
	]);

return $view->fetch('shop');

}

public function allprice(){
	
	$selval=empty($_REQUEST['id'])?'':$_REQUEST['id'];	
	
	$res=db::table('news')->where('item',$selval)->select();
	
	$nowtime=date('Y-m-d', time());
	$time=explode('-',$nowtime);
	
	
	foreach($res as $a=>$b){
		$resend=json_decode($b['price'],true);
		
		foreach($resend as $c=>$d){
			
			$timedate=explode('-',$d['date']);
			
			if($timedate[2]<$time[2]&&$timedate[1]==$time[1]){
				unset($resend[$c]);
			}else if($timedate[0]<$time[0]){
				unset($resend[$c]);
			}
			
		}
		
		
	}
	
	
	
	foreach($res as $k=>$v){
	
		$data[]=['id'=>''.$v['Id'].'','product_price'=>array_values($resend),'pt_name'=>"\u6210\u4eba"];
	};
	
	$respri=['success'=>true,'data'=>$data,'message'=>'\u64cd\u4f5c\u6210\u529f','code'=>0];


     return json($respri);
	 


}

public function price(){
	
	$selval=empty($_REQUEST['id'])?'1':$_REQUEST['id'];	
	$dateval=empty($_REQUEST['date'])?'':$_REQUEST['date'];
		
	$res=db::table('news')->where('item',$selval)->select();
	
	foreach($res as $k=>$v){
		$pri=json_decode($v['price']) ;
		    $id=$v['Id'];
	   foreach($pri as $a=>$b){
		
			if($b->{'date'}==$dateval){
				
			$data[]=['id'=>''.$id.'','product_price'=>$b->{'data'}];
				
			}
		    
			 
		  
	   }   
		
	};
	    $res=['success'=>true,'data'=>$data,'code'=>0];
	
	return json($res);
// $res='{"success":true,"data":[{"id":"93","product_price":"1498","pt_name":"\u6210\u4eba\u7968"},{"id":"94","product_price":"1373","pt_name":"\u513f\u7ae5\u7968"},{"id":"95","product_price":"1373","pt_name":"\u8001\u4eba\u7968"}],"message":"\u64cd\u4f5c\u6210\u529f","code":0}';

// print_r($res);
}



public function content ()
{
$view=View::instance();
$this->view->engine->layout(true);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
		
	]);

return $view->fetch('content');

}
public function shaitu ()
{
$view=View::instance();
$this->view->engine->layout(true);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
		
	]);

return $view->fetch('shaitu');

}
public function wcdj ()
{
$view=View::instance();
$this->view->engine->layout(true);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
		
	]);

return $view->fetch('wcdj');

}

public function juesai ()
{
$view=View::instance();
$this->view->engine->layout(true);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();

  $webplug = new Webplug();
  $res=$webplug->find(1);
  $webjsone =$res['jsone'];
   $webjstwo =$res['jstwo'];
  $weburl =$res['weburl'];
  $IP = request()->ip();
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
			'weburl'=>$weburl,
			'IP'=>$IP
		
	]);
	$listjs = Db::name('shenbao')->where('LAY_CHECKED','true')->where('Id','<','13')->order('dianzan desc')->paginate(6);
	// 把分页数据赋值给模板变量list
	$this->assign('juesai', $listjs);
	
	$lunbo = Db::name('shenbao')->where('LAY_CHECKED','true')->where('Id','<','13')->order('dianzan desc')->paginate(12);
	// 把分页数据赋值给模板变量list
	$this->assign('lunbo', $lunbo);
	

return $view->fetch('juesai');

}

public function dsq ()
{
$view=View::instance();
$this->view->engine->layout(true);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();

  $webplug = new Webplug();
  $res=$webplug->find(1);
  $webjsone =$res['jsone'];
   $webjstwo =$res['jstwo'];
  $weburl =$res['weburl'];
  $IP = request()->ip();
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
			'weburl'=>$weburl,
			'IP'=>$IP
		
	]);
	$listjs = Db::name('shenbao')->where('LAY_CHECKED','true')->where('Id','<','13')->order('dianzan desc')->paginate(6);
	// 把分页数据赋值给模板变量list
	$this->assign('juesai', $listjs);
	
	$lunbo = Db::name('shenbao')->where('LAY_CHECKED','true')->where('Id','<','13')->order('dianzan desc')->paginate(12);
	// 把分页数据赋值给模板变量list
	$this->assign('lunbo', $lunbo);
	

return $view->fetch('disanqi');

}

public function danye ()
{
$view=View::instance();
$this->view->engine->layout(false);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();

$new_class = empty($_GET['class'])?"新闻中心":$_GET['class'];
// 查询状态为1的用户数据 并且每页显示10条数据
$list = Db::name('news')->where('newsclass',$new_class)->order('newstime','desc')->paginate(5);
// 把分页数据赋值给模板变量list
$this->assign('list', $list);

$str=json($list->items());


$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
		     'newsclass'=>'新闻中心'
	]);

return $view->fetch('danye');

}

public function policy ()
{
$view=View::instance();
$this->view->engine->layout(true);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();

$new_class = empty($_GET['class'])?"最新政策":$_GET['class'];
// 查询状态为1的用户数据 并且每页显示10条数据
$list = Db::name('news')->where('newsclass',$new_class)->order('newstime','desc')->paginate(5);
// 把分页数据赋值给模板变量list
$this->assign('list', $list);

$str=json($list->items());


$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
		     'newsclass'=>'最新政策'
	]);

return $view->fetch('policy');

}

public function org_str ()
{
$view=View::instance();
$this->view->engine->layout(true);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
		
	]);

return $view->fetch('org_str');

}

public function zhangcheng ()
{
$view=View::instance();
$this->view->engine->layout(true);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
		
	]);

return $view->fetch('zhangcheng');

}

public function secretariat ()
{
$view=View::instance();
$this->view->engine->layout(true);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
		
	]);

return $view->fetch('secretariat');

}

public function committee ()
{
$view=View::instance();
$this->view->engine->layout(true);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();

$new_class = empty($_GET['class'])?"领导成员":$_GET['class'];
// 查询状态为1的用户数据 并且每页显示10条数据
$list = Db::name('news')->where('newsclass',$new_class)->order('newstime','desc')->paginate(12);
// 把分页数据赋值给模板变量list
$this->assign('list', $list);

$str=json($list->items());


$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
		     'newsclass'=>'领导成员'
	]);


return $view->fetch('committee');

}



public function  baoming ()
{
	
$view=View::instance();
$this->view->engine->layout(true);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
		
	]);
return $view->fetch('baoming');

}





public function  paimin ()
{
$view=View::instance();
$this->view->engine->layout(true);  //打开layout模板
$Seores = new Seo();
$seoinfo=$Seores->findseo();
$gameitem=empty($_REQUEST['gameitem'])?'':$_REQUEST['gameitem'];	
$this->assign([
		   'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
			'gameitem'=>$gameitem,
		     'sl'=>0
	]);
	 
 return $view->fetch('paimin');

}//投票排名



}
