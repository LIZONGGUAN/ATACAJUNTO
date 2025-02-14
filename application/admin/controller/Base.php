<?php

namespace app\admin\controller;

use think\Db;
use think\View;
use app\admin\model\User;
use app\admin\model\Webdata;
use app\admin\model\News;
use think\Cookie;
use \think\Request;

class Base extends \think\Controller
{
	function _initialize()
	{

		$khdcookie = Cookie::get('usercookie', 'think_');

		$IP = request()->ip();

		//$res=Db::table('webdata')->where('webip',$IP)->where('ucookie',$khdcookie)->select();//通过IP和cookie校验登陆
		$res = Db::table('webdata')->where('ucookie', $khdcookie)->select();
		// 获取当前URL 不含domain
		$request = Request::instance();
		$requesturl = $request->url();


		if (!$res || !$khdcookie) {
			switch ($requesturl) {
				case '/login':
					//登录页面不做反应
					break;
				case '/login.php':
					//登录页面不做反应
					break;
				case '/login.php/index/logincheck':
					//$request->url()  会直接返回ajax的接口url 
					break;
				case '/login.php/index/captcha':
					//$request->url()  会直接返回ajax的接口url 
					break;
				default:
					$this->success('请重新登录！', '/login');
					break;
			}
		} else {
			switch ($requesturl) {
				case '/login':
					$this->redirect('/login.php/admin', 302);
					break;
				case '/login/':
					$this->redirect('/login.php/admin', 302);
					break;
				case '/login.php/':
					$this->redirect('/login.php/admin', 302);
					break;
				case '/login.php':
					$this->redirect('/login.php/admin', 302);
					break;
			}
		};
	}

	// 获取管理员权限初始化数据
	public function getSystemInit()
	{
		$main = db('user')->where('Id', 1)->select();
		if (Cookie::get('username', 'think_') === $main[0]['user']) {
			//判断登录账号是否是主账号

			$roleStr = $main[0]['role'];

			$languageList = Db::name('language')
				->where('category', '=', '公共使用')
				->order('create_at desc')
				->select();

			$language = Cookie::get('language');
			if ($language != 'pt') {
				$language = 'zh';
			}

			foreach ($languageList as $lObj) {
				$roleStr = str_replace($lObj['label'], $lObj['name_' . $language], $roleStr);
			}

			print_r($roleStr);
		} else {

			$user = db('user')->where('user', Cookie('think_username'))->select();
			$menu = [
				'title' => '常规管理', 'icon' => 'fa fa-address-book', 'target' => '_self', 'child' => [
					[
						'title' => '网站管理', 'icon' => 'fa fa-home', 'target' => '_self', 'child' => [
							['title' => '运营推广', 'href' => 'admin/loadright?page=seo', 'icon' => 'fa fa-google-plus', 'target' => '_self'], ['title' => '网站插件', 'href' => 'admin/loadright?page=plug', 'icon' => 'fa fa-plus-circle', 'target' => '_self']
						]
					]
				]

			]; //menuInfo;

			foreach (json_decode($user[0]['role'], true) as $k => $v) {

				switch ($v) {
					case '轮播管理':

						$menu['child'][] = [
							'title' => '轮播管理', 'icon' => 'fa fa-picture-o', 'target' => '_self', 'child' => [
								['title' => '选课中心', 'href' => 'admin/loadright?page=banner&bannerwho=xk', 'icon' => 'fa fa-file-image-o', 'target' => '_self'], ['title' => '关于精通', 'href' => 'admin/loadright?page=banner&bannerwho=guany', 'icon' => 'fa fa-file-image-o', 'target' => '_self'], ['title' => '新闻中心', 'href' => 'admin/loadright?page=banner&bannerwho=news', 'icon' => 'fa fa-file-image-o', 'target' => '_self'], ['title' => '加入我们', 'href' => 'admin/loadright?page=banner&bannerwho=jiaru', 'icon' => 'fa fa-file-image-o', 'target' => '_self'], ['title' => '首页培训', 'href' => 'admin/loadright?page=banner&bannerwho=peixun', 'icon' => 'fa fa-file-image-o', 'target' => '_self'], ['title' => '合作单位', 'href' => 'admin/loadright?page=banner&bannerwho=hezuo', 'icon' => 'fa fa-file-image-o', 'target' => '_self'], ['title' => '荣誉证书', 'href' => 'admin/loadright?page=banner&bannerwho=zhengshu', 'icon' => 'fa fa-file-image-o', 'target' => '_self']
							]
						];
						break;
					case '新闻管理':
						$menu['child'][] = [
							'title' => '新闻管理', 'icon' => 'fa fa-file-text', 'target' => '_self', 'child' => [
								['title' => '新闻分类', 'href' => 'admin/loadright?page=newsclass&formname=articleclass', 'icon' => 'fa fa-superpowers', 'target' => '_self'], ['title' => '新闻列表', 'href' => 'admin/loadright?page=newslist', 'icon' => 'fa fa-th-list', 'target' => '_self']
							]
						];
						break;
					case '升本管理':

						$menu['child'][] = [
							'title' => '升本管理', 'icon' => 'fa  fa-graduation-cap', 'target' => '_self', 'child' => [
								['title' => '地区分类', 'href' => 'admin/loadright?page=banner&bannerwho=shenben', 'icon' => 'fa fa-handshake-o', 'target' => '_self'], ['title' => '信息管理', 'href' => 'admin/loadright?page=sblist', 'icon' => 'fa fa-handshake-o', 'target' => '_self']
							]
						];
						break;
					case '课程中心':

						$menu['child'][] = [
							'title' => '课程中心', 'icon' => 'fa fa-book', 'target' => '_self', 'child' => [
								['title' => '课程分类', 'href' => 'admin/loadright?page=newsclass&formname=kecheng', 'icon' => 'fa fa-bookmark', 'target' => '_self'], ['title' => '课程管理', 'href' => 'admin/loadright?page=kclist', 'icon' => 'fa fa-bookmark', 'target' => '_self']
							]
						];
						break;
					case '订单系统':

						$menu['child'][] = [
							'title' => '订单系统', 'icon' => 'fa fa-shopping-cart', 'target' => '_self', 'child' => [
								['title' => '用户管理', 'href' => 'admin/loadright?page=member', 'icon' => 'fa fa-user-o', 'target' => '_self'], ['title' => '订单管理', 'href' => 'admin/loadright?page=order', 'icon' => 'fa fa-shopping-bag', 'target' => '_self'], ['title' => '优惠券', 'href' => 'admin/loadright?page=coupon', 'icon' => 'fa fa-ticket', 'target' => '_self'], ['title' => '用户反馈', 'href' => 'admin/loadright?page=message', 'icon' => 'fa fa-question-circle', 'target' => '_self']
							]
						];
						break;
					case '招聘管理':

						$menu['child'][] = [
							'title' => '招聘管理', 'icon' => 'fa fa-renren', 'target' => '_self', 'child' => [
								['title' => '职位信息', 'href' => 'admin/loadright?page=zhaoping', 'icon' => 'fa fa-user-o', 'target' => '_self']
							]
						];
						break;
					case '网站数据':

						$menu['child'][] = [
							'title' => '网站数据', 'icon' => 'fa fa-area-chart', 'target' => '_self', 'child' => [
								['title' => '登陆数据', 'href' => 'admin/loadright?page=webdatalogin', 'icon' => 'fa fa-bar-chart', 'target' => '_self'], ['title' => '访客数据', 'href' => 'admin/loadright?page=webdatapv', 'icon' => 'fa fa-bar-chart', 'target' => '_self']
							]
						];
						break;
					case '系统设置':

						$menu['child'][] = [
							'title' => '系统设置', 'icon' => 'fa fa-gears', 'target' => '_self', 'child' => [
								['title' => '基本信息', 'href' => 'admin/loadright?page=basic', 'icon' => 'fa fa-user-o', 'target' => '_self'], ['title' => '密码修改', 'href' => 'admin/loadright?page=modifypw', 'icon' => 'fa fa-key', 'target' => '_self'], ['title' => '管理员权限', 'href' => 'admin/loadright?page=user', 'icon' => 'fa fa-user-plus', 'target' => '_self']
							]
						];
						break;
					case '高级管理':

						$menu[] = [
							'title' => '高级管理', 'icon' => 'fa fa-slideshare', 'target' => '_self', 'child' => [
								[
									'title' => '微信站点', 'icon' => 'fa fa-weixin', 'target' => '_self', 'child' => [
										['title' => '微信支付', 'href' => 'admin/loadright?page=wxpay', 'icon' => 'fa fa-credit-card', 'target' => '_self'], ['title' => '微信分享', 'href' => 'admin/loadright?page=wxfx', 'icon' => 'fa fa-weixin', 'target' => '_self']
									]
								],
								[
									'title' => '支付宝支付', 'icon' => 'fa fa-money', 'target' => '_self', 'child' => [
										['title' => '支付宝配置', 'href' => 'admin/loadright?page=alipay', 'icon' => 'fa fa-money', 'target' => '_self']
									]
								],
							]

						];
						break;
				}
			};

			$systemInit = [
				'homeInfo' => ['title' => '首页', 'href' => 'admin/loadright?page=welcome-1'],
				'logoInfo' => ['image' => '/static/img/admin/logo-login.png', 'href' => '/', 'target' => '_self'],
				'menuInfo' => [$menu]
			]; //systemInit

			return $systemInit;
		} //if


	}
}//class
