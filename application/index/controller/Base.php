<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;
use app\admin\model\User;
use app\admin\model\News;
use app\admin\model\Seo;
use app\admin\model\Webdata;


class Base  extends \think\Controller
{


function _initialize(){

 $mtime=date('Y-m', time());
  $time=date('Y-m-d H:i:s', time());

 $Webdata = new Webdata();

$IP = request()->ip();

 $opertime=Db::table('webdata')->where('viewip',$IP)->order('Id desc')->limit(1)->select();
 
$res=Db::table('webdata')->where('viewtime',$mtime)->order('Id desc')->limit(1)->select();

		
 
 if($opertime&&$res){
	 
	 if(floor((strtotime($opertime[0]['opertime'])-strtotime($time))/86400)<-1){
	 	   
			$user=new Webdata();
			$ipres=$user->where('viewip',$IP)->select();
			$ipnum=count($ipres)+1;
			if($ipnum>20&&$ipnum<100){
				$ipvip='潜在用户';
			}elseif($ipnum>100){
				$ipvip='忠实网友';
			}else{
					$ipvip='普通网友';
				
			}
	 	 
	 	   $webpv =$res[0]['webpv'];
	 	
	 	  $webpv=$webpv+1;
	 	  	 $Webdata->data([
	 	  	     'viewip'  => $IP,
	 	  	     'webpv' => $webpv,
	 	  		 'viewtime'=>$mtime,
	 	  		 'operation'=>'访客-浏览网页',
	 	  		 'opertime'=> $time,
	 	  		 'ipnum'=>$ipnum,
	 	  		 'ipvip'=>$ipvip
	 	  		 
	 	  
	 	  	 ]);
	 	  	 $Webdata->save(); 
	 }
 }else{
	
	$user=new Webdata();
	$ipres=$user->where('viewip',$IP)->select();
	$ipnum=count($ipres)+1;
	
	  $webpv =1;
	  $Webdata->data([
	      'viewip'  => $IP,
	      'webpv' => $webpv,
	  	 	  		 'viewtime'=>$mtime,
	  	 	  		 'operation'=>'访客-浏览网页',
	  	 	  		 'opertime'=> $time,
	  	 	  		 'ipnum'=>$ipnum,
	  	 	  		 'ipvip'=>'普通网友'
	  	 	  		 
	  	 	  
	  ]);
	  $Webdata->save(); 
	 
 }//ifend
  

 }//基礎的網站訪客記錄
 
 
}