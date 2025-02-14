<?php
namespace app\admin\controller;
use think\View;
use think\Db;
use app\admin\model\User;
use app\admin\model\Seo;
use app\admin\model\Webdata;
use think\Cookie;
use think\captcha\Captcha;
// use app\admin\controller\Base;


class Index extends Base{
public function index (){
$user=Db::table('user')->field(['user'])->value('user');
$this->view->engine->layout(true);  //打开layout模板
$view=View::instance();
$view->assign('user',$user);


$Seores = new Seo();
$seoinfo=$Seores->findseo();
  $view->assign([
	  	
	    'webname'=>$seoinfo[0]['webname']
		
		
	  
  ]);

return $view->fetch('index');
  
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
	
}//登陆验证码
	
public function logincheck(){
	
$user = new User();
$name = empty($_POST['admin_user'])?"":$_POST['admin_user'];
$pwd = empty($_POST['admin_psd'])?"":$_POST['admin_psd'];
$code = empty($_POST['code'])?"":$_POST['code'];

  //通过$name查找整条记录
    $ues = $user->where("user","=",$name)->find();
    if($ues){
		if($ues['status']=='停用'){
			$res['msg']='账号已停用！';
			return json($res);
		}
        //②把查询到的记录的密码与用户输入的密码比较
      if($ues['password']===$pwd) {
        $chek=true;
      }else{
		 $res['code']=0;
		 	
		 return json($res); 
	  }
    }
 

if ($chek) {
	$captcha = new Captcha();
	$infoyzm=$captcha->check($code);
	if($infoyzm){
		$res['yzm']=1;
		$usercookie=(rand());
		// cookie初始化
		Cookie::init(['prefix'=>'usercookie','expire'=>21600,'path'=>'/']);
		
		Cookie::set('usercookie',$usercookie,['prefix'=>'think_','expire'=>21600]); //6小时
		
		// $user->undatacookie($usercookie);  //给user表添加cookie 
		Cookie::set('username',$name,['prefix'=>'think_','expire'=>21600]); //3小时 给后台admin.php接收登录名
		
		$khdcookie=Cookie::get('usercookie','think_');
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
			 'name'=>$name,
			 'jibie'=>$ues['name'],
			 'ipnum'=>$ipnum,
			 'viewtime'=>$mtime
			 
		 ]);
		$info=$user->save();
		
		//记录最后登陆时间
		$lasttime=db('user')->where('user',$name)->update(['lasttime'=>$nowtime]);
		//记录最后登陆时间
		
		if($info&&$lasttime){
			$res['code']=1;
			$res['msg']='校验成功！';
			$res['user']=$name;
		}
	
	}else{
			$res['yzm']=0;
	} //验证码
	

	
	return json($res); 


}
	
}//	logincheck



}//class
