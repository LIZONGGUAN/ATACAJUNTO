<?php

namespace app\admin\controller; //一般处理后台的一些逻辑方法;
use think\Db;
use think\View;
use app\admin\model\User;
use app\admin\model\Forminfo;
use app\admin\model\Webplug;
use app\admin\model\Seo;
use app\admin\model\Banner;
use app\admin\model\Webdata;
use app\admin\controller\Base;
use think\Cookie;
use OSS\OssClient; //阿里云OSS
class Admin extends Base
{

	public function index()
	{

		// 渲染模板输出
		$requ = empty($_REQUEST) ? ['user' => Cookie::get('username', 'think_')] : $_REQUEST;
		$res = db('user')->where("user", $requ['user'])->select(); //接收登陆页的账号查询

		$resico = $res[0]['ico'];
		$resuser = $res[0]['user'];
		$resico = $res[0]['ico'];
		$this->view->engine->layout(true);  //打开layout模板
		$view = View::instance();
		$Seores = new Seo();
		$seoinfo = $Seores->findseo();

		$view->assign([
			'ico' => $resico,
			'user' => $resuser,
			'webname' => $seoinfo[0]['webname'],



		]);

		$languageList = Db::name('language')
			->order('create_at desc')
			->select();
		$languageObj = [];
		foreach ($languageList as $lObj) {
			$languageObj[$lObj['name_zh']] = $lObj;
		}
		$view->assign('languageObj', $languageObj);

		$language = Cookie::get('language');

		if ($language != 'pt') {
			$language = 'zh';
		}
		$view->assign('language', $language);

		return $view->fetch('/admin/page/index'); //管理后台模板页

	}
	public function loadright($trid = '')
	{
		$orderid = empty($_REQUEST['orderid']) ? '' : $_REQUEST['orderid'];
		$page = empty($_REQUEST['page']) ? '' : $_REQUEST['page'];

		$view = View::instance();


		$languageList = Db::name('language')
			->order('create_at desc')
			->select();
		$languageObj = [];
		foreach ($languageList as $lObj) {
			$languageObj[$lObj['name_zh']] = $lObj;
		}
		$view->assign('languageObj', $languageObj);

		$language = Cookie::get('language');

		if ($language != 'pt') {
			$language = 'zh';
		}
		$view->assign('language', $language);


		if ($page == 'language') {
			return $view->fetch('/admin/page/language');
		}


		$id = empty($_REQUEST['id']) ? '' : $_REQUEST['id'];
		$domain = empty($_REQUEST['domain']) ? '' : $_REQUEST['domain'];
		$judge = $page . $id;
		$domain = $_SERVER['HTTP_HOST'];
	
		$this->view->engine->layout(true);  //打开layout模板
		// 获取user数据 并 赋值
		$Htime = date('H', time());
		$Ytime = date('Y', time());
		$nowtime = date('Y-m-d H:i:s', time());
		$domain = $_SERVER['HTTP_HOST'];

		//网站访问量设置 
		//Uv量
		$alluv = db::table('webdata')->where('webpv', '>', '')->order('Id desc')->select();
		$alluv = count($alluv); //Uv量

		$allmb = db('member')->order('Id desc')->select();
		$allmb = count($allmb); //用户统计
		$allorder = db('order')->order('Id desc')->select();
		$allorder = count($allorder); //订单统计
		$allkc = db('news')->order('Id desc')->select();
		$allkc = count($allkc); //资讯统计
		//all
		$one = db::table('webdata')->where('viewtime', $Ytime . '-' . '01')->where('webpv', '>', '')->select();

		if ($one) {
			$one = count($one);
		} else {
			$one = 0;
		}

		$two = db::table('webdata')->where('viewtime', $Ytime . '-' . '02')->where('webpv', '>', '')->select();

		if ($two) {
			$two = count($two);
		} else {
			$two = 0;
		}

		$three = db::table('webdata')->where('viewtime', $Ytime . '-' . '03')->where('webpv', '>', '')->select();
		if ($three) {
			$three = count($three);
		} else {
			$three = 0;
		}

		$four = db::table('webdata')->where('viewtime', $Ytime . '-' . '04')->where('webpv', '>', '')->select();

		if ($four) {
			$four = count($four);
		} else {
			$four = 0;
		}

		$five = db::table('webdata')->where('viewtime', $Ytime . '-' . '05')->where('webpv', '>', '')->select();
		if ($five) {
			$five = count($five);
		} else {
			$five = 0;
		}

		$six = db::table('webdata')->where('viewtime', $Ytime . '-' . '06')->where('webpv', '>', '')->select();

		if ($six) {
			$six = count($six);
		} else {
			$six = 0;
		}

		$seven = db::table('webdata')->where('viewtime', $Ytime . '-' . '07')->where('webpv', '>', '')->select();

		if ($seven) {
			$seven = count($seven);
		} else {
			$seven = 0;
		}

		$eight = db::table('webdata')->where('viewtime', $Ytime . '-' . '08')->where('webpv', '>', '')->select();

		if ($eight) {
			$eight = count($eight);
		} else {
			$eight = 0;
		}

		$nine = db::table('webdata')->where('viewtime', $Ytime . '-' . '09')->where('webpv', '>', '')->select();

		if ($nine) {
			$nine = count($nine);
		} else {
			$nine = 0;
		}

		$ten = db::table('webdata')->where('viewtime', $Ytime . '-' . '10')->where('webpv', '>', '')->select();

		if ($ten) {
			$ten = count($ten);
		} else {
			$ten = 0;
		}


		$eleven = db::table('webdata')->where('viewtime', $Ytime . '-' . '11')->where('webpv', '>', '')->select();
		if ($eleven) {
			$eleven = count($eleven);
		} else {
			$eleven = 0;
		}

		$twelve = db::table('webdata')->where('viewtime', $Ytime . '-' . '12')->where('webpv', '>', '')->select();
		if ($twelve) {
			$twelve = count($twelve);
		} else {
			$twelve = 0;
		}

		$viewpv = "[" . $one . "," . $two . "," . $three . "," . $four . "," . $five . "," . $six . "," . $seven . "," . $eight . "," . $nine . "," . $ten . "," . $eleven . "," . $twelve . "]";  //uv量


		$one = db::table('webdata')->where('name', '>', '')->where('viewtime', $Ytime . '-' . '01')->select(); //登陆量
		$one = count($one);

		$two = db::table('webdata')->where('name', '>', '')->where('viewtime', $Ytime . '-' . '02')->select(); //登陆量
		$two = count($two);
		$three = db::table('webdata')->where('name', '>', '')->where('viewtime', $Ytime . '-' . '03')->select(); //登陆量
		$three = count($three);
		$four = db::table('webdata')->where('name', '>', '')->where('viewtime', $Ytime . '-' . '04')->select(); //登陆量
		$four = count($four);
		$five = db::table('webdata')->where('name', '>', '')->where('viewtime', $Ytime . '-' . '05')->select(); //登陆量
		$five = count($five);
		$six = db::table('webdata')->where('name', '>', '')->where('viewtime', $Ytime . '-' . '06')->select(); //登陆量
		$six = count($six);
		$seven = db::table('webdata')->where('name', '>', '')->where('viewtime', $Ytime . '-' . '07')->select(); //登陆量
		$seven = count($seven);

		$eight = db::table('webdata')->where('name', '>', '')->where('viewtime', $Ytime . '-' . '08')->select(); //登陆量
		$eight = count($eight);
		$nine = db::table('webdata')->where('name', '>', '')->where('viewtime', $Ytime . '-' . '09')->select(); //登陆量
		$nine = count($nine);
		$ten = db::table('webdata')->where('name', '>', '')->where('viewtime', $Ytime . '-' . '10')->select(); //登陆量
		$ten = count($ten);

		$eleven = db::table('webdata')->where('name', '>', '')->where('viewtime', $Ytime . '-' . '11')->select(); //登陆量
		$eleven = count($eleven);
		$twelve = db::table('webdata')->where('name', '>', '')->where('viewtime', $Ytime . '-' . '12')->select(); //登陆量
		$twelve = count($twelve);

		$loginnum = "[" . $one . "," . $two . "," . $three . "," . $four . "," . $five . "," . $six . "," . $seven . "," . $eight . "," . $nine . "," . $ten . "," . $eleven . "," . $twelve . "]";  //登陆量

		//文章访问量
		$one = db::table('webdata')->where('acview', '>', '')->where('viewtime', $Ytime . '-' . '01')->select(); //文章访问量
		$one = count($one);
		$two = db::table('webdata')->where('acview', '>', '')->where('viewtime', $Ytime . '-' . '02')->select();
		$two = count($two);
		$three = db::table('webdata')->where('acview', '>', '')->where('viewtime', $Ytime . '-' . '03')->select();
		$three = count($three);
		$four = db::table('webdata')->where('acview', '>', '')->where('viewtime', $Ytime . '-' . '04')->select();
		$four = count($four);
		$five = db::table('webdata')->where('acview', '>', '')->where('viewtime', $Ytime . '-' . '05')->select();
		$five = count($five);
		$six = db::table('webdata')->where('acview', '>', '')->where('viewtime', $Ytime . '-' . '06')->select();
		$six = count($six);
		$seven = db::table('webdata')->where('acview', '>', '')->where('viewtime', $Ytime . '-' . '07')->select();
		$seven = count($seven);

		$eight = db::table('webdata')->where('acview', '>', '')->where('viewtime', $Ytime . '-' . '08')->select();
		$eight = count($eight);
		$nine = db::table('webdata')->where('acview', '>', '')->where('viewtime', $Ytime . '-' . '09')->select();
		$nine = count($nine);
		$ten = db::table('webdata')->where('acview', '>', '')->where('viewtime', $Ytime . '-' . '10')->select(); //文章访问量
		$ten = count($ten);

		$eleven = db::table('webdata')->where('acview', '>', '')->where('viewtime', $Ytime . '-' . '11')->select(); //文章访问量
		$eleven = count($eleven);
		$twelve = db::table('webdata')->where('acview', '>', '')->where('viewtime', $Ytime . '-' . '12')->select(); //文章访问量
		$twelve = count($twelve);

		$acviewnum = "[" . $one . "," . $two . "," . $three . "," . $four . "," . $five . "," . $six . "," . $seven . "," . $eight . "," . $nine . "," . $ten . "," . $eleven . "," . $twelve . "]";  //文章访问量
		//文章访问量

		//产品访问量
		$one = db::table('webdata')->where('pdview', '>', '')->where('viewtime', $Ytime . '-' . '01')->select(); //文章访问量
		$one = count($one);
		$two = db::table('webdata')->where('pdview', '>', '')->where('viewtime', $Ytime . '-' . '02')->select();
		$two = count($two);
		$three = db::table('webdata')->where('pdview', '>', '')->where('viewtime', $Ytime . '-' . '03')->select();
		$three = count($three);
		$four = db::table('webdata')->where('pdview', '>', '')->where('viewtime', $Ytime . '-' . '04')->select();
		$four = count($four);
		$five = db::table('webdata')->where('pdview', '>', '')->where('viewtime', $Ytime . '-' . '05')->select();
		$five = count($five);
		$six = db::table('webdata')->where('pdview', '>', '')->where('viewtime', $Ytime . '-' . '06')->select();
		$six = count($six);
		$seven = db::table('webdata')->where('pdview', '>', '')->where('viewtime', $Ytime . '-' . '07')->select();
		$seven = count($seven);

		$eight = db::table('webdata')->where('pdview', '>', '')->where('viewtime', $Ytime . '-' . '08')->select();
		$eight = count($eight);
		$nine = db::table('webdata')->where('pdview', '>', '')->where('viewtime', $Ytime . '-' . '09')->select();
		$nine = count($nine);
		$ten = db::table('webdata')->where('pdview', '>', '')->where('viewtime', $Ytime . '-' . '10')->select(); //产品访问量
		$ten = count($ten);

		$eleven = db::table('webdata')->where('pdview', '>', '')->where('viewtime', $Ytime . '-' . '11')->select(); //产品访问量
		$eleven = count($eleven);
		$twelve = db::table('webdata')->where('pdview', '>', '')->where('viewtime', $Ytime . '-' . '12')->select(); //产品访问量
		$twelve = count($twelve);

		$pdviewnum = "[" . $one . "," . $two . "," . $three . "," . $four . "," . $five . "," . $six . "," . $seven . "," . $eight . "," . $nine . "," . $ten . "," . $eleven . "," . $twelve . "]";  //产品访问量
		//产品访问量
		//网站访问量设置end

		$Htime = date('H', time());
		$nowtime = date('Y-m-d H:i:s', time());
		$domain = $_SERVER['HTTP_HOST'];


		if ($Htime >= 0 && $Htime <= 6) {
			$Hamtime = "凌晨了注意休息！";
		} elseif ($Htime > 6 && $Htime <= 9) {
			$Hamtime = "早上好！";
		} elseif ($Htime > 9 && $Htime < 12) {
			$Hamtime = "上午好！";
		} elseif ($Htime >= 12 && $Htime < 14) {
			$Hamtime = "中午好！";
		} elseif ($Htime >= 14 && $Htime <= 18) {
			$Hamtime = "下午好！";
		} elseif ($Htime > 18 && $Htime <= 24) {
			$Hamtime = "晚上好！";
		};

		$khdcookie = Cookie::get('usercookie', 'think_');
		$IP = request()->ip();
		// $ucsel=Db::table('webdata')->where('webip',$IP)->where('ucookie',$khdcookie)->select();//通过IP和cookie查询
		$ucsel = Db::table('webdata')->where('ucookie', $khdcookie)->select();

		$res = db('user')->where("user", $ucsel[0]['name'])->select();
		$resuser = $res[0]['user'];
		$respassword = $res[0]['password'];
		$resico = $res[0]['ico'];
		$resusername = $res[0]['username'];
		$rescompanyname = $res[0]['companyname'];
		$reswebname = $res[0]['webname'];
		$resdomain = $res[0]['domain'];
		$resAddress = $res[0]['Address'];
		$resperson = $res[0]['person'];
		$resmobile = $res[0]['mobile'];
		$userid = $res[0]['Id'];
		$resqq = $res[0]['qq'];
		$resIntroduction = $res[0]['Introduction'];
		$tippw = $res[0]['tippw'];
		// 获取user数据 并 赋值
		$seoinfo = new Seo();
		$res = $seoinfo->find(1);
		$seowebname = $res['webname'];
		$seowebdomain = $res['webdomain'];
		$seoseotitle = $res['seotitle'];
		$seoseokey = $res['seokey'];
		$seoseodsc = $res['seodsc'];
		$seoseoheader = $res['seoheader'];
		$weblogo = $res['weblogo'];
		$appid = $res['appid'];
		$miyao = $res['miyao'];
		$fxtit = $res['fxtit'];
		$fxms = $res['fxms'];
		$wxtit = $res['wxtit'];
		$wxms = $res['wxms'];
		$photo = $res['photo'];
		$photowx = $res['photowx'];
		// 获取seo数据 并 赋值
		$webinfo = new Webplug();
		$res = $webinfo->find(1);
		$jsone = $res['jsone'];
		$jstwo = $res['jstwo'];
		$url = $res['weburl'];
		// 获取jsplug数据 并 赋值
		$danyeres = db('danyecon')->select();

		//单页内容
		// dump ($resclass);
		// 获取articleclass文章分类 数据 并 赋值 
		//备忘录
		$notes = db('danyecon')->where('class', '备忘录')->select();
		//备忘录

		$view->assign([
			'userid' => $userid,
			'user' => $resuser,
			'password' => $respassword,
			'ico' => $resico,
			'username' => $resusername,
			'companyname' => $rescompanyname,
			'webname' => $reswebname,
			'domain' => $resdomain,
			'Address' => $resAddress,
			'person' => $resperson,
			'mobile' => $resmobile,
			'qq' => $resqq,
			'Introduction' => $resIntroduction,
			'tippw' => $tippw,
			'weblogo' => $weblogo,
			'seowebname' => $seowebname,
			'seowebdomain' => $seowebdomain,
			'seoseotitle' => $seoseotitle,
			'seoseokey' => $seoseokey,
			'seoseodsc' => $seoseodsc,
			'seoseoheader' => $seoseoheader,
			'jstwo' => $jstwo,
			'jsone' => $jsone,
			'url' => $url,
			'danyecon' => $danyeres,
			'num' => 1,
			'webdomain' => $domain,
			'appid' => $appid,
			'miyao' => $miyao,
			'fxtit' => $fxtit,
			'fxms' => $fxms,
			'wxtit' => $wxtit,
			'Hamtime' => $Hamtime,
			'photo' => $photo,
			'wxms' => $wxms,
			'photowx' => $photowx,
			'viewUV' => $viewpv,
			'loginnum' => $loginnum,
			'alluv' => $alluv,
			'allmb' => $allmb,
			'allorder' => $allorder,
			'allkc' => $allkc,
			'acviewnum' => $acviewnum,
			'pdviewnum' => $pdviewnum,
			'webname' => $resusername, //后台昵称
			'notes' => $notes[0]['content']


		]);

		switch ($judge) {

			case 'dayin':

				$view = View::instance();

				$orderdata = db('order')->where('Id', $trid)->select();

				//return json($orderdata);
				$this->assign(['orderdata' => $orderdata]);


				return $view->fetch('/admin/page/userorder');
				break;

			case 'edigwc':

				$view = View::instance();

				$out_trade_no = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8); //订单号 

				$memberda = db('order')->where('Id', $orderid)->select();

				$memdata = db('member')->where('Id', $memberda[0]['userid'])->select();

				// print_r(json_decode($memberda[0]['buyarr'],true));
				// return false;
				$this->assign(['pro' => json_decode($memberda[0]['buyarr'], true), 'out_trade_no' => $out_trade_no, 'member' => $memdata, 'orderid' => $orderid, 'memberda' => $memberda]);


				return $view->fetch('/admin/page/edigwc');
				break;
				//上传页面first	
			case 'seo':
				$domain = 'seo2';
				$view = View::instance();
				$view->assign('domain', $domain);

				return $view->fetch('/admin/page/seo');
				break;
			case 'huishou':
				$view = View::instance();
				return $view->fetch('/admin/page/huishou');
				break;
				//上传页面first	
			case 'upnews':
				$get = empty($_GET) ? ['formname' => 'news'] : $_GET;
				$view->assign("formname", $get['formname']);
				$view = View::instance();
				return $view->fetch('/admin/table_edi/upnews');
				break;
			case 'upzt':
				$get = empty($_GET) ? ['formname' => 'news'] : $_GET;
				$view->assign("formname", $get['formname']);
				$view = View::instance();
				return $view->fetch('/admin/table_edi/upzt');
				break;
			case 'upproduct':
				$get = empty($_GET) ? ['formname' => 'news'] : $_GET;
				$view->assign("formname", $get['formname']);
				$view = View::instance();
				return $view->fetch('/admin/table_edi/upproduct');
				break;

			case 'uphelp':
				$get = empty($_GET) ? ['formname' => 'help'] : $_GET;
				$view->assign("formname", $get['formname']);
				$view = View::instance();
				return $view->fetch('/admin/table_edi/uphelp');
				break;
			case 'upzhiwei':
				$get = empty($_GET) ? ['formname' => 'news'] : $_GET;
				$view->assign("formname", $get['formname']);
				$view = View::instance();
				return $view->fetch('/admin/table_edi/upzhiwei');
				break;
			case 'upyoulian':
				$get = empty($_GET) ? ['formname' => 'news'] : $_GET;
				$view->assign("formname", $get['formname']);
				$view = View::instance();
				return $view->fetch('/admin/table_edi/upyoulian');
				break;
				//上传页面	end
			case 'editornews':
				$view = View::instance();
				return $view->fetch('/admin/table_edi/editornews');
				break;


				//表格数据页first		
			case 'newslist':
				$sel = empty($_REQUEST['sel']) ? '' : $_REQUEST['sel'];
				$view->assign([
					'sel' => $sel
				]);
				$view = View::instance();
				return $view->fetch('admin/page/table');
				break;
			case 'card':
				$sel = empty($_REQUEST['sel']) ? '' : $_REQUEST['sel'];
				$view->assign([
					'sel' => $sel
				]);
				$view = View::instance();
				return $view->fetch('admin/table/card');
				break;

			case 'zhuanti':
				$sel = empty($_REQUEST['sel']) ? '' : $_REQUEST['sel'];
				$view->assign([
					'sel' => $sel
				]);
				$view = View::instance();
				return $view->fetch('/admin/table/zhuanti');
				break;
			case 'product':
				$requ = $_REQUEST;
				$productc = db('productc')->where('parent_id', 0)->select();
				$view->assign([
					'productc' => $productc
				]);
				$view = View::instance();
				return $view->fetch('/admin/table/product');
				break;
			case 'dianquan':

				$view = View::instance();
				return $view->fetch('/admin/table/dianquan');
				break;
			case 'wangzhe':

				$view = View::instance();
				return $view->fetch('/admin/table/wangzhe');
				break;
			case 'lol':

				$view = View::instance();
				return $view->fetch('/admin/table/lol');
				break;

			case 'youlian':
				$sel = empty($_REQUEST['sel']) ? '' : $_REQUEST['sel'];
				$view->assign([
					'sel' => $sel
				]);
				$view = View::instance();
				return $view->fetch('/admin/table/youlian');
				break;	//友情链接	
			case 'helplist':
				$sel = empty($_REQUEST['sel']) ? '' : $_REQUEST['sel'];
				$view->assign([
					'sel' => $sel
				]);
				$view = View::instance();
				return $view->fetch('/admin/table/helplist');
				break;
			case 'zhaoping':
				$sel = empty($_REQUEST['sel']) ? '' : $_REQUEST['sel'];
				$view->assign([
					'sel' => $sel
				]);
				$view = View::instance();
				return $view->fetch('/admin/table/zhaoping');
				break;	//招聘列表
			case 'coupon':
				$view = View::instance();
				return $view->fetch('/admin/table/coupon');
				break;	//优惠券	
			case 'kefu':
				$view = View::instance();
				return $view->fetch('/admin/table/kefu');
				break;	//客服验证		
			case 'order':
				$sel = empty($_REQUEST['sel']) ? '' : $_REQUEST['sel'];
				$view->assign([
					'sel' => $sel
				]);
				$view = View::instance();
				return $view->fetch('/admin/table/order');
				break; //订单列表			
				//表格数据页end				
			case 'message':
				$sel = empty($_REQUEST['sel']) ? '' : $_REQUEST['sel'];
				$view->assign([
					'sel' => $sel
				]);
				$view = View::instance();
				return $view->fetch('/admin/table/message');
				break;

			case 'user':
				$view = View::instance();
				$userrole = db('user')->where('user', Cookie::get('username', 'think_'))->select();
				$this->assign(['urole' => $userrole]);
				return $view->fetch('/admin/table/userrole');
				break;
			case 'wxpay':
				$view = View::instance();
				$wxpay = db('plugad')->where('page', 'wxpay')->select();
				$this->assign(['wxpay' => $wxpay[0]]);
				return $view->fetch('admin/plug/wxpay');
				break;
			case 'wxfx':
				$view = View::instance();
				return $view->fetch('admin/plug/wxfx');
				break;
			case 'alipay':
				$view = View::instance();
				return $view->fetch('admin/plug/alipay');
				break;
			case 'member':
				$sel = empty($_REQUEST['sel']) ? '' : $_REQUEST['sel'];
				$view->assign([
					'sel' => $sel
				]);
				$view = View::instance();
				return $view->fetch('/admin/table/member');
				break;
			case 'newsclass':
				$get = empty($_GET) ? ['formname' => 'articleclass'] : $_GET;

				$view = View::instance();

				$view->assign(['formname' => $get['formname']]);


				return $view->fetch('admin/page/newsclass');
				break;

			case 'basic':

				return $view->fetch('/admin/page/basic-information');
				break;
			case 'modifypw':
				return $view->fetch('/admin/page/modifypw');
				break; //基本信息里面的选项卡 密码部分内容				

			case 'plug':

				return $view->fetch('/admin/page/jsplug');
				break;	//JS插件

			case 'banner':
				$bannerwho = empty($_REQUEST['bannerwho']) ? '' : $_REQUEST['bannerwho'];
				$view->assign([
					'class1' => 'layui-this',
					'class2' => 'layui-this2',
					'show1' => 'layui-show',
					'show2' => 'layui-show1',
					'textone' => "",
					'texttwo' => "",
					'button' => "",
					'url' => "",
					'imgurl' => "",
					'editcon' => '',
					'id' => '',
					'who' => $bannerwho

				]);

				return $view->fetch('/admin/table/banner');
				break;	//轮播图
			case 'danye':

				return $view->fetch('/admin/page/danye');
				break;	//单页内容页1
			case 'danye2':
				$res = $danyecon->find(2);
				$danyeres = $res['content'];
				$view->assign([
					'danyecon' => $danyeres,
					'num' => 2

				]);
				return $view->fetch('/admin/page/danye');
				break;	//单页内容页2
			case 'forminfo':

				return $view->fetch('/admin/table/forminfo');
				break;	//表单数据	


			case 'webdatalogin':

				return $view->fetch('/admin/table/webdatalogin');
				break;	//登陆数据										
			case 'webdatapv':

				return $view->fetch('/admin/table/webpv');
				break;	//访客数据

				//mini后台模板页				
			case 'welcome-1':

				return $view->fetch('/admin/page/welcome-1');
				break;	//访客数据	
			default:

				return $view->fetch('/admin/page/404');
				break;	//登陆数据										

				//后台模板页	
		}
	} //加载框架

	public function basicicoapi()
	{
		$uptype = empty($_REQUEST['type']) ? "img" : $_REQUEST['type'];

		if ($this->request->isPost()) {

			if ($uptype == "img") {
				$res['code'] = 1;
				$res['msg'] = '上传成功！';
				$file = $this->request->file('file');
				$info = $file->move('../public/static/upload_img/admin/ico');
				if ($info) {
					$res['name'] = $info->getFilename();
					$res['filepath'] = '/static/upload_img/admin/ico/' . $info->getSaveName();
					$res['filepath'] = str_replace("\\", "/", $res['filepath']); // \是转义字符，需要转义后再次输\ 
				} else {
					$res['code'] = 0;
					$res['msg'] = '上传失败！' . $file->getError();
				}
				return $res;
			} else if ($uptype == "movie") {
				$res['code'] = 1;
				$res['msg'] = '上传成功！';
				$file = $this->request->file('file');
				$info = $file->move('../public/static/upload_img/web/movie');
				if ($info) {
					$res['name'] = $info->getFilename();
					$res['filepath'] = '/static/upload_img/web/movie/' . $info->getSaveName();
					$res['filepath'] = str_replace("\\", "/", $res['filepath']); // \是转义字符，需要转义后再次输\ 	 
				} else {
					$res['code'] = 0;
					$res['msg'] = '上传失败！' . $file->getError();
				}
				return $res;
			};
		};
	} ////头像、图片、视频上传api 




	public function wechatfx()
	{

		$appid = empty($_REQUEST['appid']) ? "" : $_REQUEST['appid'];
		$miyao = empty($_REQUEST['miyao']) ? "" : $_REQUEST['miyao'];
		$fxtit = empty($_REQUEST['fxtit']) ? "" : $_REQUEST['fxtit'];
		$fxms = empty($_REQUEST['fxms']) ? "" : $_REQUEST['fxms'];
		$wxtit = empty($_REQUEST['wxtit']) ? "" : $_REQUEST['wxtit'];
		$wxms = empty($_REQUEST['wxms']) ? "" : $_REQUEST['wxms'];
		$photowx = empty($_REQUEST['photowx']) ? "" : $_REQUEST['photowx'];
		$photo = empty($_REQUEST['photo']) ? "" : $_REQUEST['photo'];

		$info = db('seo')->where('Id', '1')->update(['appid' => $appid, 'miyao' => $miyao, 'fxtit' => $fxtit, 'fxms' => $fxms, 'wxtit' => $wxtit, 'wxms' => $wxms, 'photowx' => $photowx, 'photo' => $photo]);
		if ($info) {
			$res['code'] = 1;
			return json($res);
		} else {
			$res['code'] = 0;
			return json($res);
		}
	} //微信分享API

	public function payemsoss()
	{

		$appid = empty($_REQUEST['appid']) ? "" : $_REQUEST['appid'];
		$miyao = empty($_REQUEST['miyao']) ? "" : $_REQUEST['miyao'];
		$user = empty($_REQUEST['user']) ? "" : $_REQUEST['user'];
		$userapi = empty($_REQUEST['userapi']) ? "" : $_REQUEST['userapi'];
		$ison = empty($_REQUEST['ison']) ? "" : $_REQUEST['ison'];
		$page = empty($_REQUEST['page']) ? "" : $_REQUEST['page'];
		switch ($page) {
			case 'wxpay':
				$info = db('plugad')->where('page', 'wxpay')->update(['appid' => $appid, 'miyao' => $miyao, 'user' => $user, 'userapi' => $userapi, 'open' => $ison]);
				break;
			case 'alipay':
				$info = db('plugad')->where('page', 'wxpay')->update(['appid' => $appid, 'miyao' => $miyao, 'user' => $user, 'userapi' => $userapi, 'ison' => $ison]);
				break;
			case 'ems':
				$info = db('plugad')->where('page', 'wxpay')->update(['appid' => $appid, 'miyao' => $miyao, 'user' => $user, 'userapi' => $userapi, 'ison' => $ison]);
				break;
			case 'oss':
				$info = db('plugad')->where('page', 'wxpay')->update(['appid' => $appid, 'miyao' => $miyao, 'user' => $user, 'userapi' => $userapi, 'ison' => $ison]);
				break;
		}


		if ($info) {
			$res['code'] = 1;
			return json($res);
		} else {
			$res['code'] = 0;
			return json($res);
		}
	} //支付、对象存储、短信的存储接口

	public function clearcookie()
	{
		$clearcookie = empty($_REQUEST['clear']) ? "" : $_REQUEST['clear'];


		if ($clearcookie == "clearcookie") {
			Cookie::delete('usercookie', 'think_');
			return  true;
		}
	} //clearcookie

	public function seoinfo()
	{

		$webname = empty($_REQUEST['jbxx_span1']) ? "" : $_REQUEST['jbxx_span1'];
		$webdomain = empty($_REQUEST['jbxx_span2']) ? "" : $_REQUEST['jbxx_span2'];
		$seotitle = empty($_REQUEST['seotitle']) ? "" : $_REQUEST['seotitle'];
		$seokey = empty($_REQUEST['seokey']) ? "" : $_REQUEST['seokey'];
		$seodsc = empty($_REQUEST['seodsc']) ? "" : $_REQUEST['seodsc'];
		$seoheader = empty($_REQUEST['seoheader']) ? "" : $_REQUEST['seoheader'];
		$weblogo = empty($_REQUEST['weblogo']) ? "" : $_REQUEST['weblogo'];


		$seo = new Seo();
		$seoinfo = Seo::get(1);
		if ($seoinfo) { //判断是新增还是更新
			$seoinfo->webname = $webname;
			$seoinfo->webdomain = $webdomain;
			$seoinfo->seotitle = $seotitle;
			$seoinfo->seokey = $seokey;
			$seoinfo->seodsc = $seodsc;
			$seoinfo->seoheader = $seoheader;
			$seoinfo->weblogo = $weblogo;
			$info = $seoinfo->save();
			if ($info) {
				return true;
			}
		} else {
			$seo->data([
				'webname' => $webname,
				'webdomain' => $webdomain,
				'seotitle' => $seotitle,
				'seokey' => $seokey,
				'seodsc' => $seodsc,
				'seoheader' => $seoheader,
				'weblogo' => $weblogo
			]);
			$info = $seo->save();
			if ($info) {
				return true;
			}
		};
	} //seoinfo基本资料

	public function jsplug()
	{

		$webpluginfo = webplug::get(1);

		$kefu = empty($_REQUEST['kefu']) ? '' : $_REQUEST['kefu'];
		$total = empty($_REQUEST['total']) ? '' : $_REQUEST['total'];
		$url = empty($_REQUEST['url']) ? '' : $_REQUEST['url'];
		$ifurl = empty($_REQUEST['ifurl']) ? '' : $_REQUEST['ifurl'];

		$webplug = new Webplug();



		if ($webpluginfo) { //判断是新增还是更新
			if ($ifurl == "ifurl") {
				$webpluginfo->jsone = $kefu;
				$webpluginfo->jstwo = $total;
				$webpluginfo->weburl = $url;
				$info = $webpluginfo->save();
				if ($info) {
					$res['msg'] = "上传成功";
					$res['code'] = 1;
				};
			} else {
				$webpluginfo->jsone = $kefu;
				$webpluginfo->jstwo = $total;

				$info = $webpluginfo->save();

				if ($info) {
					$res['msg'] = "上传成功";
					$res['code'] = 1;
				};
			};


			return json($res);
		} else {
			$webplug->data([
				'jsone'  => $kefu,
				'jstwo' => $total,
				'url' => $url
			]);

			$info = $webplug->save();


			if ($info) {
				$res['msg'] = "上传成功";
				$res['code'] = 1;
			};
			return json($res);
		};
	} //plug网站插件

	public function formapi()
	{


		$id = empty($_REQUEST['id']) ? "" : $_REQUEST['id'];
		$form = new Forminfo();
		$forminfo = Forminfo::get($id);
		$xingming = empty($_REQUEST['tdname']) ? $forminfo['name'] : $_REQUEST['tdname'];
		$content = empty($_REQUEST['tdcon']) ? $forminfo['content'] : $_REQUEST['tdcon'];
		$tel = empty($_REQUEST['tdtel']) ? $forminfo['tel'] : $_REQUEST['tdtel'];
		$modif = empty($_REQUEST['modif']) ? "" : $_REQUEST['modif'];
		$del = empty($_REQUEST['del']) ? "" : $_REQUEST['del'];
		$select = empty($_REQUEST['select']) ? "" : $_REQUEST['select'];
		// $formico = empty($_REQUEST['formico'])?"/static/page/img/footerlogo.png":$_REQUEST['formico'];

		$page = empty($_REQUEST['page']) ? "1" : $_REQUEST['page'];
		$limit = empty($_REQUEST['limit']) ? "20" : $_REQUEST['limit'];

		if ($select == "select") {
			// $resform=Db::table('forminfo')->order('ID')->select();
			// return  json($resform);  //查询表单内容

			$formsres = $form->order('id', 'desc')->select();
			$allcount = count($formsres);

			//获取传递的分页参数
			$start = $limit * ($page - 1);

			//分页查询
			$formpage = $form->order('id', 'desc')->limit($start, $limit)->select();
			$res = [
				'code' => 0,
				'msg' => '返回成功',
				'count' => $allcount,
				'data' => $formpage
			];

			echo json_encode($res);
		} else {
			//判断新增、修改、删除
			if ($modif == "modif" && $forminfo) {

				$forminfo->name = $xingming;
				$forminfo->tel = $tel;
				$forminfo->content = $content;

				$info = $forminfo->save();
				if ($info === 1) {
					return true;
				} //当$info执行成功的时候 返回1，执行失败的时候返回0，利用这个做判断
			} elseif ($del == "del") {


				$info = Forminfo::destroy(['Id' => $id]);
				if ($info === 1) {
					return true;
				} //当$info执行成功的时候 返回1，执行失败的时候返回0，利用这个做判断
			} else {
				if (!$xingming || !$tel) {
					// return false;
				} else {
					$form->data([
						'name'  => $xingming,
						'tel' => $tel,
						'content' => $content,
					]);

					$info = $form->save();
					if ($info === 1) {
						return true;
					}
				} //判断是否为空


			} //判断新增、修改、删除

		} //ifend





	} //表单类内容

	public function danyeapi()
	{

		$content = empty($_REQUEST['editor']) ? "" : $_REQUEST['editor'];
		$num = empty($_REQUEST['num']) ? "" : $_REQUEST['num'];
		$class = empty($_REQUEST['class']) ? "" : $_REQUEST['class'];
		$tit = empty($_REQUEST['tit']) ? "" : $_REQUEST['tit'];

		switch ($class) {
			case '备忘录':
				$insel = db('danyecon')->where('class', $class)->select();
				if ($insel) {
					$info = db('danyecon')->where('class', $class)->update(['content' => $content]);
				} else {
					$info = db('danyecon')->insert(['content' => $content, 'class' => $class]);
				}
				break;
			default:
				$info = db('danyecon')->where('class', $class)->update(['content' => $content, 'tit' => $tit]);
				break;
		}


		if ($info) {
			$res['code'] = 1;
			return  json($res);
		} else {
			$res['code'] = 0;
			return  json($res);
		}
	} //page内容


	public function bannerapi()
	{

		$banner = new Banner();
		$id = empty($_REQUEST['id']) ? "" : $_REQUEST['id'];

		$bannerinfo = Banner::get($id);
		$textone = empty($_REQUEST['textone']) ? $bannerinfo['textone'] : $_REQUEST['textone'];
		$texttwo = empty($_REQUEST['texttwo']) ? $bannerinfo['texttwo'] : $_REQUEST['texttwo'];
		$button = empty($_REQUEST['button']) ? $bannerinfo['button'] : $_REQUEST['button'];
		$url = empty($_REQUEST['url']) ? $bannerinfo['url'] : $_REQUEST['url'];
		$imgurl = empty($_REQUEST['imgurl']) ? $bannerinfo['imgurl'] : $_REQUEST['imgurl'];
		$who = empty($_REQUEST['who']) ? $bannerinfo['class'] : $_REQUEST['who']; //8.4新增判断多个轮播图

		$del = empty($_REQUEST['del']) ? "" : $_REQUEST['del'];
		$select = empty($_REQUEST['select']) ? "" : $_REQUEST['select'];
		$edit = empty($_REQUEST['edit']) ? "" : $_REQUEST['edit'];
		$upload = empty($_REQUEST['upload']) ? "" : $_REQUEST['upload'];
		$editcon = empty($_REQUEST['editcon']) ? "" : $_REQUEST['editcon']; //判断是否修改该条内容


		$page = empty($_REQUEST['page']) ? "1" : $_REQUEST['page'];
		$limit = empty($_REQUEST['limit']) ? "20" : $_REQUEST['limit'];

		if ($select == "select") {

			$bannersres = $banner->where('class', $who)->order('id', 'asc')->select();
			$allcount = count($bannersres);

			//获取传递的分页参数
			$start = $limit * ($page - 1);

			//分页查询
			$bannerpage = $banner->where('class', $who)->order('id', 'asc')->limit($start, $limit)->select();
			$res = [
				'code' => 0,
				'msg' => '返回成功',
				'count' => $allcount,
				'data' => $bannerpage
			];

			echo json_encode($res);
		} else {

			//判断新增、修改、删除
			if ($editcon == "editcon" && $bannerinfo) {

				$bannerinfo->textone = $textone;
				$bannerinfo->texttwo = $texttwo;
				$bannerinfo->button = $button;
				$bannerinfo->url = $url;
				$bannerinfo->imgurl = $imgurl;

				$info = $bannerinfo->save();
				if ($info === 1) {
					return true;
				} //当$info执行成功的时候 返回1，执行失败的时候返回0，利用这个做判断
			} elseif ($del == "del") {


				$info = Banner::destroy(['Id' => $id]);

				if ($info) {
					$res['code'] = 1;
					return json($res);
				}
				// if($info===1){return true;} //当$info执行成功的时候 返回1，执行失败的时候返回0，利用这个做判断

			} else if ($edit === "edit") { //edit编辑某个轮播图
				$who = empty($_REQUEST['who']) ? "" : $_REQUEST['who'];
				$view = View::instance();

				$Seores = new Seo();
				$seoinfo = $Seores->findseo();

				$view->assign([
					'class1' => 'layui-this2',
					'class2' => 'layui-this',
					'show1' => 'layui-show1',
					'show2' => 'layui-show',
					'textone' => $bannerinfo['textone'],
					'texttwo' => $bannerinfo['texttwo'],
					'button' => $bannerinfo['button'],
					'url' => $bannerinfo['url'],
					'imgurl' => $bannerinfo['imgurl'],
					'editcon' => 'editcon',
					'id' => $id,
					'who' => $who,
					'webname' => $seoinfo[0]['webname'],





				]);
				return $view->fetch('/admin/table/banner');
			} elseif ($upload == "upload") {
				if (!$imgurl) {
					// return false;
				} else {
					$banner->data([
						'textone'  => $textone,
						'texttwo' => $texttwo,
						'button' => $button,
						'url' => $url,
						'imgurl' => $imgurl,
						'class' => $who

					]);

					$info = $banner->save();
					if ($info) {
						$res['code'] = 1;
						return json($res);
					} else {
						$res['code'] = 0;
						return json($res);
					}
				} //判断是否为空


			} //判断新增、修改、删除

		} //ifend





	} //bannerapi方法

	public function  editban()
	{
		$id = empty($_REQUEST['id']) ? "" : $_REQUEST['id'];
		$banner = new Banner();
		$bannerinfo = Banner::get($id);
		$textone = empty($_REQUEST['textone']) ? $bannerinfo['textone'] : $_REQUEST['textone'];
	} //编辑轮播图

	public function  banner_tapi($id = '', $data = '')
	{
		$info = db('banner')->where('Id', $id)->update(['sort' => $data]);
		if ($info) {
			$res['code'] = 1;
			return json($res);
		} else {
			$res['code'] = 0;
			return json($res);
		}
	} //轮播图新API
	public function  banner_open($trid = '')
	{
		$data = db('banner')->find($trid);
		if ($data['status'] == 'checked') {
			$info = db('banner')->where('Id', $trid)->update(['status' => '']);
		} else {
			$info = db('banner')->where('Id', $trid)->update(['status' => 'checked']);
		}


		if ($info) {
			$res['code'] = 1;
			return json($res);
		} else {
			$res['code'] = 0;
			return json($res);
		}
	} //轮播图新API 开关



	public function  webdataloginlist()
	{
		$page = empty($_REQUEST['page']) ? "1" : $_REQUEST['page'];
		$limit = empty($_REQUEST['limit']) ? "20" : $_REQUEST['limit'];
		$class = empty($_REQUEST['class']) ? "" : $_REQUEST['class'];

		$resdata = Db::table('webdata')->where('name', '>', '')->select();
		$allcount = count($resdata);

		//获取传递的分页参数
		$start = $limit * ($page - 1);

		//分页查询
		$newspage = Db::table('webdata')->where('name', '>', '')->limit($start, $limit)->order("id", 'desc')->select();
		$res = [
			'code' => 0,
			'msg' => '返回成功',
			'count' => $allcount,
			'data' => $newspage
		];

		echo json_encode($res);
	} //登陆数据

	public function  webpvlist()
	{
		$page = empty($_REQUEST['page']) ? "1" : $_REQUEST['page'];
		$limit = empty($_REQUEST['limit']) ? "20" : $_REQUEST['limit'];
		$class = empty($_REQUEST['class']) ? "" : $_REQUEST['class'];

		$resdata = Db::table('webdata')->where('webpv', '>', '')->select();
		$allcount = count($resdata);

		//获取传递的分页参数
		$start = $limit * ($page - 1);

		//分页查询
		$newspage = Db::table('webdata')->where('webpv', '>', '')->limit($start, $limit)->order("id", 'desc')->select();
		$res = [
			'code' => 0,
			'msg' => '返回成功',
			'count' => $allcount,
			'data' => $newspage
		];

		echo json_encode($res);
	} //访客数据

	public function messageapi()
	{
		$request = empty($_REQUEST) ? '' : $_REQUEST;
		switch ($request['resige']) {
			case 'select':
				$info = db('message')->select();
				$allcount = count($info);
				//获取传递的分页参数
				$start = $_REQUEST['limit'] * ($_REQUEST['page'] - 1);

				//分页查询
				$newspage = db('message')->limit($start, $_REQUEST['limit'])->order("id", 'desc')->select();
				$res = [
					'code' => 0,
					'msg' => '返回成功',
					'count' => $allcount,
					'data' => $newspage
				];
				return json($res);
				break;
			case 'reply':
				$newtime = date('Y-m-d H:i:s', time());
				$info = db('message')->where('Id', $request['id'])->update(['reply' => $request['reply'], 'replytime' => $newtime, 'status' => '已回复']);
				if ($info) {
					$res['code'] = 1;
					return json($res);
				}
				break;
			case 'delreply':
				$info = db('message')->delete($request['id']);
				if ($info) {
					$res['code'] = 1;
					return json($res);
				}
				break;
		}
	} //消息模块


	public function memberapi()
	{
		$request = empty($_REQUEST) ? '' : $_REQUEST;
		switch ($request['resign']) {
			case '更改状态':
				if ($request['pw'] == '') {
					$info = db('member')->where('Id', $request['trid'])->update(['status' => $request['status']]);
				} else {
					$info = db('member')->where('Id', $request['trid'])->update(['status' => $request['status'], 'pwd' => $request['pw']]);
				}
				if ($info) {
					$res['code'] = 1;
					return json($res);
				}

				break;
			case 'adduser':
				$user = db('member')->where(['user' => $request['user']])->select();
				if ($user) {
					$res['code'] = 0;
					return json($res);
				} else {
					unset($request['resign']);
					$info = db('member')->insert($request);
				}


				if ($info) {
					$res['code'] = 1;
					return json($res);
				} else {
					$res['code'] = 0;
					return json($res);
				}
				break;
		}
	} //用户模块


	public function aliossupfile()
	{
		$KeyId = ''; //Access Key ID
		$KeySecret = ''; //Access Key Secret
		$Endpoint = ''; //阿里云oss 外网地址endpoint
		$Bucket = '';  //Bucket名称

		require '../vendor/Alioss/autoload.php';  //引入自动加载类

		$file = request()->file('file');  //获取到上传的文件
		$ext = pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);  //后缀

		// 尝试执行
		try {

			//实例化对象 将配置传入
			$ossClient = new OssClient($KeyId, $KeySecret, $Endpoint);

			//这里是有sha1加密 生成文件名 之后连接上后缀
			$fileName = 'weboss/' . sha1(date('YmdHis', time()) . uniqid()) . '.' . $ext;
			//执行阿里云上传
			$result = $ossClient->uploadFile($Bucket, $fileName, $file->getInfo()['tmp_name']);
			/**
			 * 这个只是为了展示
			 * 可以删除或者保留下做后面的操作
			 */
			$arr = [
				//图片地址
				'fileurl' => $result['info']['url'],
				//数据库保存名称
				'fileName' => str_replace('weboss/', '', $fileName)
			];
		} catch (OssException $e) {
			return $e->getMessage();
		}
		//将结果输出
		return $arr;
	} //阿里云OSS


	public function ordersa($status = '', $trid = '', $wuliu = '')
	{

		$info = db('order')->where('Id', $trid)->update(['status' => $status, 'wuliu' => $wuliu]);
		if ($info) {
			$res['code'] = 1;
			return json($res);
		} else {
			$res['code'] = 0;
			return json($res);
		}
	} //订单状态


	public function huishou()
	{
		$page = empty($_REQUEST['page']) ? "1" : $_REQUEST['page'];
		$limit = empty($_REQUEST['limit']) ? "20" : $_REQUEST['limit'];
		$formname = empty($_REQUEST['formname']) ? "news" : $_REQUEST['formname'];
		$sel = empty($_REQUEST['searchParams']) ? "" : $_REQUEST['searchParams'];
		$sel = json_decode($sel, true);
		$sel = $sel['username'];


		$allhs = []; //所有的回收数据
		$order = db('order')->where('hsz', 'Recycling')->order('hstime', 'desc')->select();
		foreach ($order as $a => $b) {
			$b['hsc'] = 'Order';
			$allhs[] = $b;
		}

		$pro = db('product')->where('hsz', 'Recycling')->order('hstime', 'desc')->select();
		foreach ($pro as $a => $b) {
			$b['hsc'] = 'Products';
			$b['name'] = $b['news_tit'];
			$allhs[] = $b;
		}

		$mem = db('member')->where('hsz', 'Recycling')->order('hstime', 'desc')->select();
		foreach ($mem as $a => $b) {
			$b['hsc'] = 'member';
			$b['name'] = $b['user'];
			$allhs[] = $b;
		}

		$allcount = count($allhs);

		//获取传递的分页参数
		$start = $limit * ($page - 1);

		$work = array_slice($allhs, $start, $limit); //通过数组筛选好 分页区域数据


		$res = [
			'code' => 0,
			'msg' => '返回成功',
			'count' => $allcount,
			'data' => $work
		];




		return json($res);
	} //回收站模块


	public function huishoudel()
	{
		$trid = empty($_REQUEST['trid']) ? "" : $_REQUEST['trid'];
		$formname = empty($_REQUEST['formname']) ? "" : $_REQUEST['formname'];

		switch ($formname) {
			case 'Order':
				$info = db('order')->where('Id', $trid)->delete($trid);
				break;
			case 'Products':
				$info = db('product')->where('Id', $trid)->delete($trid);
				break;
			case 'member':
				$info = db('member')->where('Id', $trid)->delete($trid);
				break;
		}
		if ($info) {
			$res['code'] = 1;
			return json($res);
		} else {
			$res['code'] = 0;
			return json($res);
		}
	}

	public function hsstatus()
	{
		$trid = empty($_REQUEST['trid']) ? "" : $_REQUEST['trid'];
		$formname = empty($_REQUEST['formname']) ? "" : $_REQUEST['formname'];

		switch ($formname) {
			case 'Order':
				$info = db('order')->where('Id', $trid)->update(['hsz' => 'Normal']);
				break;
			case 'Products':
				$info = db('product')->where('Id', $trid)->update(['hsz' => 'Normal']);
				break;
			case 'member':
				$info = db('member')->where('Id', $trid)->update(['hsz' => 'Normal']);
				break;
		}
		if ($info) {
			$res['code'] = 1;
			return json($res);
		} else {
			$res['code'] = 0;
			return json($res);
		}
	}

	public function ediselpro($id = '', $data = '')
	{
		$info = db('product')->where('Id', $id)->update(['zhlx' => $data]);
		if ($info) {
			$res['code'] = 1;
			return json($res);
		} else {
			$res['code'] = 0;
			return json($res);
		}
	} //编辑常用搜索词



}
