<?php
namespace app\admin\controller;//一般处理和前端有关的数据
use think\View;
use think\Db;
use app\admin\model\Seo;
use app\admin\model\Webdata;
use app\admin\model\Gameclass;
use app\admin\model\Verifi;
use app\admin\model\Shenbao;
use app\admin\model\Zjiang;
use app\admin\model\Tpiao;
use think\Paginator;
use think\Cookie;

class Newsad extends \think\Controller {


/**
 * 功能：生成二维码
 * @param string $qrData 手机扫描后要跳转的网址
 * @param string $qrLevel 默认纠错比例 分为L、M、Q、H四个等级，H代表最高纠错能力
 * @param string $qrSize 二维码图大小，1－10可选，数字越大图片尺寸越大
 * @param string $savePath 图片存储路径
 * @param string $savePrefix 图片名称前缀
 */
public function createQRcode($savePath='static/qrcode', $qrData = 'PHP QR Code :)1', $qrLevel = 'L', $qrSize = 4, $savePrefix = 'qrcode')
{
    
    Loader::import('phpqrcode.phpqrcode');
	
    if (!isset($savePath)) return '';
    //设置生成png图片的路径
    $PNG_TEMP_DIR = $savePath;
 
    //检测并创建生成文件夹
    if (!file_exists($PNG_TEMP_DIR)) {
       
        mkdir($PNG_TEMP_DIR);
    //   return 'sss'; 
    }
   
    $errorCorrectionLevel = 'L';
    if (isset($qrLevel) && in_array($qrLevel, ['L', 'M', 'Q', 'H'])) {
        $errorCorrectionLevel = $qrLevel;
    }
    $matrixPointSize = 4;
    if (isset($qrSize)) {
        $matrixPointSize = min(max((int)$qrSize, 1), 10);
    }
    $qrCode=new \QrCode();
    if (isset($qrData)) {
        if (trim($qrData) == '') {
            die('data cannot be empty!');
        }
        //生成文件名 文件路径+图片名字前缀+md5(名称)+.png
        $filename = time(date('Y-m-d h:i:s')).rand(1,9999). md5($qrData . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
        //开始生成
        $info=$qrCode::png($qrData, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
		// return $info;
    } else {
        //默认生成
        $qrCode::png('http://baidu.com', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
		
    }
  
	  $daif=rename($filename,'static/qrcode/'.$filename);
	  $qrnewurl='static/qrcode/'.$filename;
	  
    return  '/'.$qrnewurl;
	
} //生成二维码，并且保存到本地目录


		public function daochu(){
		 
  require "../vendor/phpExcel/PHPExcel.php";

// 设置脚本最大执行时间
set_time_limit(0);
// 设置最大可用内存限制
ini_set("memory_limit", "1024M");
$objPHPExcel = new \PHPExcel();
// 设置文件属性，在xls文件-->属性-->详细信息里可以看到这些值，xml表格没有这些值
$objPHPExcel
    ->getProperties()  //获得文件属性对象，给下文提供设置资源
    ->setCreator("Maarten Balliauw")                 //设置文件的创建者
    ->setLastModifiedBy("Maarten Balliauw")          //设置最后修改者
    ->setTitle("Office 2007 XLSX Test Document")    //设置标题
    ->setSubject("Office 2007 XLSX Test Document")  //设置主题
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")    //设置备注
    ->setKeywords("office 2007 openxml php")        //设置标记
    ->setCategory("Test result file");                //设置类别
$objWriter = \PHPExcel_IOFactory:: createWriter($objPHPExcel, 'Excel2007');
$objPHPExcel->setActiveSheetIndex(0)             //设置第一个内置表（一个xls文件里可以有多个表）为活动的
    ->setCellValue( 'A1', '器具名称' )         //给表的单元格设置数据
    ->setCellValue( 'B1', '证书编号' )
    ->setCellValue( 'C1', '证书单位' )
    ->setCellValue( 'D1', '型号规格' )
    ->setCellValue( 'E1', '出厂编号' )
    ->setCellValue( 'F1', '制造厂家' )
    ->setCellValue( 'G1', '校准日期' )
    ->setCellValue( 'H1', '管理编号' )
    ->setCellValue( 'I1', '更新日期' )
    ->setCellValue( 'J1', '二维码' );
$objActSheet = $objPHPExcel->getActiveSheet();  //设置内容

$data_arr=db('product')->select();


$step_num = 2;
foreach ($data_arr as $k=>$v){
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $step_num, $v['news_tit']);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $step_num, $v['bianhao']);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $step_num, $v['danwei']);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('d' . $step_num, $v['guige']);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('e' . $step_num, $v['ccbh']);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('f' . $step_num, $v['zzcj']);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('g' . $step_num, $v['jzrq']);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('h' . $step_num, $v['glbh']);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('i' . $step_num, $v['newstime']);
 
    $objDrawing  = new \PHPExcel_Worksheet_Drawing();
    // 获取图片地址
    $objDrawing->setPath('.'.$v['qrcode']);
    // 设置图片存放在表格的位置
    $objDrawing->setCoordinates('J' . $step_num);
    // 设置表格宽度
    $objActSheet->getColumnDimension('J')->setWidth(20);
    // 设置表格高度
    $objActSheet->getRowDimension($step_num)->setRowHeight(60);
    // 设置图片宽
    //$objDrawing->setWidth(80);
    // 设置图片高
    $objDrawing->setHeight(60);
    // 设置X方向偏移量
    $objDrawing->setOffsetX(10);
    // 设置Y方向偏移量
    $objDrawing->setOffsetY(10);
    $objDrawing->setWorksheet($objActSheet);
    $step_num++;
}
// 设置垂直居中
$objPHPExcel->getActiveSheet()->getStyle('A1:C'.($step_num-1))->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

// 清空输出缓冲区
ob_end_clean();
// 设置表名
$file_name = date('Y-m-d H:i:s').'-证书信息.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$file_name.'"');
header('Cache-Control: max-age=0');
$objWriter->save( 'php://output');
exit;

		} //excel批量导出，可以带图片





	 public function daoru(){
	     
	      $requ=$_REQUEST;
	
		if($this->request->isPost()){
		   
      $file = $this->request->file('file');					
       // 移动到框架应用根目录/public/uploads/ 目录下
      $info = $file->move(ROOT_PATH . 'public' .DS.'upload'. DS . 'excel');
 
            if($info){
                //获取文件所在目录名
                $path=ROOT_PATH . 'public' . DS.'upload'.DS .'excel/'.$info->getSaveName();
                //加载PHPExcel类
                vendor('phpExcel.PHPExcel');
                
                //实例化PHPExcel类（注意：实例化的时候前面需要加'\'）
                $extension = $info->getExtension();
								if( $extension =='xlsx' )
								{
								$objReader = new \PHPExcel_Reader_Excel2007();
								}else
									{
								$objReader = new \PHPExcel_Reader_Excel5();
								}
                $objPHPExcel = $objReader->load($path,$encode='utf-8');//获取excel文件
				
                $sheet = $objPHPExcel->getSheet(0); //激活当前的表
                $highestRow = $sheet->getHighestRow(); // 取得总行数
                $highestColumn = $sheet->getHighestColumn(); // 取得总列数
               
			   $numj=0;
			   
                //将表格里面的数据循环到数组中
				switch($requ['class']){
					default:
					for($i=2;$i<=$highestRow;$i++)
					{
					    //*为什么$i=2? (因为Excel表格第一行应该是姓名，年龄，班级，从第二行开始，才是我们要的数据。)
					    if($objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue()!==null){
						 $formname[$numj]['newstime']= $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();//届数id
						  $formname[$numj]['news_tit']= $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
						$formname[$numj]['bianhao']= $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
							$formname[$numj]['danwei']= $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
							$formname[$numj]['guige']= $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
							 $formname[$numj]['ccbh']= $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
							$formname[$numj]['zzcj']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
								 
								$formname[$numj]['jzrq']= $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
								  
									$formname[$numj]['glbh']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
						
													  
										$numj++;			  
					    }
					   
					     // 这里的数据根据自己表格里面有多少个字段自行决定
					    
					};
					break;
				
				}
               
                //往数据库添加数据
				
                $aa =db($requ['formname'])->insertAll($formname);
				
				
			
								if($aa){
								    unlink($path);
								    $prodata=db($requ['formname'])->select();
								    
								    foreach($prodata as $k=>$v){
								     
								        if($v['qrcode']== null){ 
								            $qrurl=$this->createQRcode($savePath='static/qrcode', $qrData ='http://'.$_SERVER['HTTP_HOST'].'?p=c&d='.$v['Id'], $qrLevel = 'L', $qrSize = 4, $savePrefix = 'qrcode');
								            db($requ['formname'])->where('Id',$v['Id'])->update(['qrcode'=>$qrurl]);
								          
								        }
								    }
									$res['code']=1;
									$res['msg'] = '导入成功！';
								}else{
									$res['code']=0;
									$res['msg'] = '导入失败！';
								}
               return $res;
            }

        }else{ 
            return '请上传Excel数据表！';
        }
	
	 }//excel批量导入

 

public function pledi_class(){
	
$post=empty($_POST)?'':$_POST;
   
   foreach(json_decode($post['data'],true) as $a=>$b){
	   
	   if($b['Id']!==intval($post['topid'])){
		   	$info=db($post['formname'])->where('Id',$b['Id'])->update(['parent_id'=>$post['topid']]);
	   }else{
		   $res['code']=3;
		   return json($res); //不能选择自己为顶级分类
	   }
   }

if($info){
	$res['code']=1;
	return json($res); 
}else{
	$res['code']=0;
	return json($res); 
};

} //批量编辑文章分类控制器

public function addclass(){
	
$POST=empty($_POST)?['formname'=>'articleclass']:$_POST;
$create_time=date('Y-m-d H:i:s',time());
switch($POST['formname']){
	case $POST['formname']:
     $info=db($POST['formname'])->insert([
		'name'=>$POST['name'],
		'laug'=>$POST['laug'],
		'parent_id'=>$POST['topid'],
		'create_time'=>$create_time,
		'sort'=>0
		
	]);
	break;
	
}

if($info){
	$res['code']=1;
	return json($res); 
}else{
	$res['code']=0;
	return json($res); 
};

} //addclass添加文章分类控制器


public function delclass(){
		 
$POST=empty($_POST)?['formname'=>'articleclass']:$_POST;

switch($POST['formname']){
	case $POST['formname']:
	if(!empty($POST['data'])){
		foreach($POST['data'] as $a=>$b){
		    
		       $data=db($POST['formname'])->select();
		    $delarr=self::newsSort($data,$b['Id']);
		    foreach ($delarr as $k=>$v){
		        	$deldata[]=intval($v['Id']);
		    }
	       	$deldata[]=intval($b['Id']);
		}
		
		
	}else{
	 $data=db($POST['formname'])->select();
	 $delarr=self::newsSort($data,$POST['trid']);
		    foreach ($delarr as $k=>$v){
		        	$deldata[]=intval($v['Id']);
		    }
	
	        $deldata[]=intval($POST['trid']);
	}
   $info=db($POST['formname'])->delete($deldata);
	break;
	
}

if($info){
	$res['code']=1;
	return json($res); 
}else{
	$res['code']=0;
	return json($res); 
};

} //delclass删除文章分类控制器


public function ediclass(){
	$POST=empty($_POST)?['formname'=>'articleclass']:$_POST;
	
	switch($POST['formname']){
		case $POST['formname']:
		$pid=empty(db($POST['formname'])->where('Id',$POST['topid'])->select())?[['parent_id'=>0]]:db($POST['formname'])->where('Id',$POST['topid'])->select() ;
	
		if($POST['Id']!==$pid[0]['parent_id']){
			$info=db($POST['formname'])->where('Id',$POST['Id'])->update(['name'=>$POST['name'],'sort'=>$POST['sort'],'parent_id'=>$POST['topid'],'ico'=>$POST['img'],'beizhu'=>$POST['beizhu']]);
		
		}//当所选顶级分类的父Id和自身ID不一致的情况下，说明不是自己的字类
		 
		break;
		
	}
	
	if(!empty($info)){
		$res['code']=1;
		return json($res); 
	}else{
		$res['code']=0;
		return json($res); 
	};
	
	
}//ediclass编辑分类数据

public function copynews($id=''){
	$data=db('product')->find($id);
	
	 unset($data['Id']);
	// return json($data);
	$info=db('product')->insert($data);
	if($info){
		$res['code']=1;
		return json($res); 
	}else{
		$res['code']=0;
		return json($res); 
	};
}

public function upnews(){

$formname = empty($_REQUEST['formname'])?"news":$_REQUEST['formname'];

$new_delid = empty($_REQUEST['new_delid'])?"":$_REQUEST['new_delid'];
$detail=db($formname)->where('id','=',$new_delid)->select() ;

if($detail){
	$news_slt=$detail[0]['news_slt'];
	$newstime=$detail[0]['newstime'];
}else{
	$news_slt='/static/img/admin/news_slt.jpg';
	
	$newstime=date('Y-m-d', time());;
	
};
	//编辑的时候防止缩略图和时间为空

$newssort = empty($_REQUEST['newssort'])?"":$_REQUEST['newssort'];
$newsclass = empty($_REQUEST['newsclass'])?"":$_REQUEST['newsclass'];
$classitem = empty($_REQUEST['ziclass'])?"":$_REQUEST['ziclass'];
$news_tit = empty($_REQUEST['news_tit'])?"":$_REQUEST['news_tit'];
$news_jj = empty($_REQUEST['news_jj'])?"":$_REQUEST['news_jj'];
$news_slt= empty($_REQUEST['news_slt'])?$news_slt:$_REQUEST['news_slt'];
$editor = empty($_REQUEST['editor'])?"":$_REQUEST['editor'];
$newstime = empty($_REQUEST['newstime'])?$newstime:$_REQUEST['newstime'];
$news_view = empty($_REQUEST['news_view'])?"":$_REQUEST['news_view'];
$ifupdate = empty($_REQUEST['ifupdate'])?"":$_REQUEST['ifupdate'];//判断是否编辑更新
$diqu = empty($_REQUEST['daqu'])?"":$_REQUEST['daqu'];
$leixing = empty($_REQUEST['leixing'])?"":$_REQUEST['leixing'];
$bianhao = empty($_REQUEST['bianhao'])?"":$_REQUEST['bianhao'];
$jiage = empty($_REQUEST['jiage'])?"":$_REQUEST['jiage'];
$yijia = empty($_REQUEST['yijia'])?"":$_REQUEST['yijia'];
$menpai = empty($_REQUEST['menpai'])?"":$_REQUEST['menpai'];
$ifpay = empty($_REQUEST['ifpay'])?"":$_REQUEST['ifpay'];
$xingbie = empty($_REQUEST['xingbie'])?"":$_REQUEST['xingbie'];
$srcimg = empty($_REQUEST['srcimg'])?"":$_REQUEST['srcimg'];
$taocan = empty($_REQUEST['taocan'])?"":$_REQUEST['taocan'];
$zhlx = empty($_REQUEST['zhlx'])?"":$_REQUEST['zhlx'];
$dengji = empty($_REQUEST['dengji'])?"":$_REQUEST['dengji'];

$yingxiong = empty($_REQUEST['yingxiong'])?"":$_REQUEST['yingxiong'];
$pifu = empty($_REQUEST['pifu'])?"":$_REQUEST['pifu'];
$jingbi = empty($_REQUEST['jingbi'])?"":$_REQUEST['jingbi'];

$xinghao = empty($_REQUEST['xinghao'])?"":$_REQUEST['xinghao'];
$yanse = empty($_REQUEST['yanse'])?"":$_REQUEST['yanse'];

$ejclass = empty($_REQUEST['ejclass'])?"":$_REQUEST['ejclass'];
$sjclass = empty($_REQUEST['sjclass'])?"":$_REQUEST['sjclass'];
$ejclass=json_encode($ejclass);
// return $ejclass;
$sjclass=json_encode($sjclass);
//return json_encode($taocan);
switch($formname){
	case $formname:
	if($ifupdate=="update"){
		$info=db($formname)->where('id',$new_delid)->update(['news_tit' =>$news_tit,'news_jj'=>$news_jj,'news_slt'=>$news_slt,'news_editor'=>$editor,'newsclass'=>$newsclass,'newstime'=>$newstime,'newssort'=>$newssort,'classitem'=>$classitem,'daqu'=>$diqu,'leixing'=>$leixing,'bianhao'=>$bianhao,'bianhao'=>$bianhao,'jiage'=>$jiage,'yijia'=>$yijia,'menpai'=>$menpai,'ifpay'=>$ifpay,'xingbie'=>$xingbie,'taocan'=>json_encode($taocan),'zhlx'=>$zhlx,'dengji'=>$dengji,'xinghao'=>json_encode($xinghao),'yanse'=>json_encode($yanse),'ejclass'=>$ejclass,'sjclass'=>$sjclass,'srcimg'=>$srcimg]);
		
			
		}else{
			$info=db($formname)->insert([
					'Id'=>$new_delid,
				    'news_tit'  =>  $news_tit,
				    'news_jj' =>  $news_jj,
				    'news_slt' =>  $news_slt,
				     'news_editor' => $editor,
					 'newsclass'=>$newsclass,
					'srcimg'=>$srcimg,
					 'newstime'=>$newstime,
					 'newssort'=>$newssort,
					 'classitem'=>$classitem,
					 'daqu'=>$diqu,
					 'leixing'=>$leixing,
					 'bianhao'=>$bianhao,
					 'jiage'=>$jiage,
					 'yijia'=>$yijia,
					 'menpai'=>$menpai,
					 'ifpay'=>$ifpay,
					 'xingbie'=>$xingbie,
					
					 'taocan'=>json_encode($taocan),
					 'zhlx'=>$zhlx,
					 'dengji'=>$dengji,
					 'xinghao'=>json_encode($xinghao),'yanse'=>json_encode($yanse),
					 'ejclass'=>$ejclass,'sjclass'=>$sjclass
					
					 
				]);
		
		}//判断更新或上传
	break;
	
};
if($info){				
				$res['code']=1;
				return json($res);
			 
			}

} //上传文章控制器

public function  newslist(){
	$page = empty($_REQUEST['page'])?"1":$_REQUEST['page'];
	$limit = empty($_REQUEST['limit'])?"20":$_REQUEST['limit'];
	$formname = empty($_REQUEST['formname'])?"news":$_REQUEST['formname'];
	$sel=empty($_REQUEST['searchParams'])?"":$_REQUEST['searchParams'];
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
					  $newsres =db($formname)->where($where)->where('hsz','Normal')->select();
		 }else{
					  $newsres = db($formname)->order('Id','desc')->where('hsz','Normal')->select();
		 };
		
		   $allcount = count($newsres);
		   
		   //获取传递的分页参数
		   $start=$limit*($page-1);
			
		   //分页查询
		  if($sel){
			  if($formname=='order'){
				   $newspage = db($formname)->whereor($where)->whereor($phone)->order('Id','desc')->limit($start,$limit)->where('hsz','Normal')->select();
			  }else{
				 $newspage = db($formname)->where($where)->order('Id','desc')->limit($start,$limit)->where('hsz','Normal')->select();  
			  }
			
					}else{
						  $newspage = db($formname)->order('Id','desc')->limit($start,$limit)->where('hsz','Normal')->select();
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
}//文章列表控制器

public function  prolist($trid=''){
	$page = empty($_REQUEST['page'])?"1":$_REQUEST['page'];
	$limit = empty($_REQUEST['limit'])?"20":$_REQUEST['limit'];
	$sign = empty($_REQUEST['sign'])?"":$_REQUEST['sign'];
	
	switch($sign){		
		case '批量上架':
		$data=empty($_REQUEST['data'])?"":$_REQUEST['data'];
		foreach(json_decode($data,true) as $a=>$b ){
			$pres=db('product')->find($b['Id']);
			if($pres['status']!=='checked'){
				$info=db('product')->where('Id',$b['Id'])->update(['status'=>'checked']);
			}
		}
		$res['code']=1;
		return json($res);
		break;
		case '批量下架':
		$data=empty($_REQUEST['data'])?"":$_REQUEST['data'];
		foreach(json_decode($data,true) as $a=>$b ){
			$pres=db('product')->find($b['Id']);
			if($pres['status']!=='no'){
				$info=db('product')->where('Id',$b['Id'])->update(['status'=>'no']);
			}
		}
		$res['code']=1;
		return json($res);
		break;
		case '状态开关':
		$data=db('product')->find($trid);
		if($data['status']=='checked'){
			$info=db('product')->where('Id',$trid)->update(['status'=>'no']);
		}else{
			$info=db('product')->where('Id',$trid)->update(['status'=>'checked']);
		}
		
		
		if($info){
			$res['code']=1;
			return json($res);
		}else{
			$res['code']=0;
			return json($res);
		};
		
		break;
		default:
		$searchParams=empty($_REQUEST['searchParams'])?"":$_REQUEST['searchParams'];
		$searchParams=json_decode($searchParams,true);
		$sel=$searchParams['username'];
		$selclass=$searchParams['top-class'];
		$where['news_tit'] = array('like','%'.$sel.'%'); //模糊查询
		if($sign=='全部'){
			$sign='';
			$zsstatus['status']=['like','%'.$sign.'%'];
		
		}else{
			$zsstatus['status']=['like','%'.$sign.'%'];
		}
		
		 if($sel){
			 
			 if($selclass){
				 
				 $newsres =db('product')->where($where)->where($zsstatus)->where('newsclass',$selclass)->where('hsz','Normal')->select(); 
				 
			 }else{
				 
				  $newsres =db('product')->where($where)->where($zsstatus)->where('hsz','Normal')->select();
				  
			 }
			
		 }else{
			 if($selclass){
				 $newsres = db('product')->order('Id','desc')->where('newsclass',$selclass)->where($zsstatus)->where('hsz','Normal')->select(); 
			 }else{
				 $newsres = db('product')->order('Id','desc')->where($zsstatus)->where('hsz','Normal')->select(); 
			 }
			
		 };
		
		   $allcount = count($newsres);
		   
		   //获取传递的分页参数
		   $start=$limit*($page-1);
			
		   //分页查询
		  if($sel){
			  
			  if($selclass){
				  
			$newspage = db('product')->where($where)->where($zsstatus)->where('newsclass',$selclass)->order('Id','desc')->limit($start,$limit)->where('hsz','Normal')->select();
				  
			  }else{
				  $newspage = db('product')->where($where)->where($zsstatus)->order('Id','desc')->limit($start,$limit)->where('hsz','Normal')->select();
			  }
			 	   
			
					}else{
						
						 if($selclass){
						  $newspage = db('product')->where('newsclass',$selclass)->order('Id','desc')->limit($start,$limit)->where($zsstatus)->where('hsz','Normal')->select();	 
						 }else{
							 $newspage = db('product')->order('Id','desc')->limit($start,$limit)->where($zsstatus)->where('hsz','Normal')->select();	 
						 }
						
					}
				
		   $res = [
		               'code'=>0,
		               'msg'=>'返回成功',
		               'count'=>$allcount,
		               'data'=>$newspage
		           ];
				   
				   return json($res);	
		break;
		
	}//switch
	
	
}//产品列表控制器

public function newslist_del(){
    $post=$_POST;
	$post['data']=isset($post['data'])?$post['data']:'';
	$post['formname']=isset($post['formname'])?$post['formname']:'news';
	$post['delpwd']=isset($post['delpwd'])?$post['delpwd']:'';
	
	if($post['formname']=='product'||$post['formname']=='member'||$post['formname']='order'){
		
		$info=db('user')->where('user',Cookie::get('username','think_'))->where('password',$post['delpwd'])->select();
		if(!$info){
			$res['code']=5;
			return  json($res);
		}
		if(json_decode($post['data'],true)){
			foreach(json_decode($post['data'],true) as $a=>$b){
				
					$info=db($post['formname'])->where(['Id'=>intval($b['Id'])])->update(['hsz'=>'Recycling','hsip'=>$_SERVER['REMOTE_ADDR'],'hstime'=>date('Y-m-d H:i:s')]);
			} //批量删除data数据
		}else{
		
			$num=intval($post['trid']);
		$info=db($post['formname'])->where(['Id'=>$num])->update(['hsz'=>'Recycling','hsip'=>$_SERVER['REMOTE_ADDR'],'hstime'=>date('Y-m-d H:i:s')]);
		}
		
	
		
	}//如果是 订单，用户信息,产品信息，就放入回收站
	else{
		
		if(json_decode($post['data'],true)){
			foreach(json_decode($post['data'],true) as $a=>$b){
				$num[]=intval($b['Id']);
				
			} //批量删除data数据
		}else{
		
			$num=intval($post['trid']);
		}
		
		
		switch($post['formname']){
			case $post['formname']:
			$info=db($post['formname'])->delete($num);
			break;
		}
		
	}//ifend
	
	
	
	if($info){
		$res['code']=1;
		return  json($res);
	}else{
		$res['code']=0;
		return  json($res);
	}
}//文章列表删除控制器	





public function newslist_detail(){






	$new_delid = empty($_GET['trid'])?"1":$_GET['trid'];
	$ifeditor = empty($_GET['ifeditor'])?"ifeditor":$_GET['ifeditor'];
	$formname= empty($_GET['formname'])?"product":$_GET['formname'];
	
		if($ifeditor!=="editor"){
		    
		    //登录处理：输出页面前检查 cookie和IP是否有记录。没记录就登陆
	// $khdcookie=Cookie::get('memcookie','think_');
	//  $IP = request()->ip();
	
	//  $iflogin=Db::table('webdata')->where('webip',$IP)->where('ucookie',$khdcookie)->select();	
	
	// if(!$iflogin){
	// 	$this->redirect('/index/requ/wxlogin');//没有登陆就 跳转到微信授权登陆
	// }
	$iflogin=Db::table('webdata')->select();//演示用	
//登录处理	
	//会员信息
	 //$member=db('member')->where('openid',$iflogin[0]['name'])->select();
	$member=db('member')->select();//演示用	
	//会员信息
	
//查询订单是否付款
	$order_pay=db('order')->where('openid',$iflogin[0]['name'])->where('buyid',$new_delid)->where('status','已付款')->select();
	if($order_pay){
	   
	    $this->assign(['ispay'=>'ispay']);
	}else{
	    $this->assign(['ispay'=>'nopay']);
	}
	
//查询订单是否付款

//查询是否有卡密兑换过
   $card_use=db('card')->where('openid',$iflogin[0]['name'])->where('nameid',$new_delid)->where('status','已使用')->select();
   if($card_use){
       if($card_use[0]['usedtime']>date('Y-m-d',time())&&$card_use[0]['usedview']<$card_use[0]['viewnum']){
               $this->assign(['iscard'=>'iscard']);//此处判断是无到期，使用次数无超过
            
             //卡密的观看次数
		    $priviewtime=date('Y-m-d', time());
		   
		   if($card_use[0]['priviewtime']<$priviewtime&&$card_use[0]['priviewtime']==''){
		         db('card')->where('openid',$iflogin[0]['name'])->where('nameid',$new_delid)->update(['priviewtime'=>$priviewtime]);
		        db('card')->where('openid',$iflogin[0]['name'])->where('nameid',$new_delid)->setInc('usedview');  //第一天访问
		    }else{
		           
		      if($card_use[0]['priviewtime']<$priviewtime){
		         
		             db('card')->where('openid',$iflogin[0]['name'])->where('nameid',$new_delid)->update(['priviewtime'=>$priviewtime]);
		        db('card')->where('openid',$iflogin[0]['name'])->where('nameid',$new_delid)->setInc('usedview'); //第二天访问
		      }
		        
		    }//给观看次数加1
		   
		     //卡密的观看次数
		     
       }else{
            $this->assign(['iscard'=>'nocard']);
       }
   }else{
         $this->assign(['iscard'=>'nocard']);
   }
//查询是否有卡密兑换过
		    
		    $this->assign([	'member'=>$member]);
		}//不等于后台编辑时

	
	$detail=db($formname)->where('Id','=',$new_delid)->where('hsz','Normal')->select() ;	
	$id=$detail[0]['Id'];		
	$newstime=date('Y-m-d H:i:s',time());
	$news_tit=$detail[0]['news_tit'];
    $news_editor=$detail[0]['news_editor'];//获得文章属性值
	$news_jj=$detail[0]['news_jj'];
	$news_view=$detail[0]['views'];
	$newstime=$detail[0]['newstime'];
	$newsclass=$detail[0]['newsclass'];
	$news_slt=$detail[0]['news_slt'];
	$newssort=$detail[0]['newssort'];
	
	$user=db('user')->find(1);
  
	// 渲染模板输出
		 $this->view->engine->layout(true);  //打开layout模板
		 $view=View::instance();


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

	 
		 
		 $Seores = new Seo();
		 $seoinfo=$Seores->findseo();
		$seo=db('seo')->find(1);
		//猜你喜欢
			$love=db($formname)->where('newsclass',$newsclass)->limit(6)->select() ;	
		//猜你喜欢
		//print_r(json_decode($detail[0]['taocan'])[0])  ;
			//上一篇 下一篇
			
				$prxt=db($formname)->where('Id','<',$new_delid)->where('newsclass',$newsclass)->order('Id','desc')->select() ;
				$next=db($formname)->where('Id','>',$new_delid)->where('newsclass',$newsclass)->order('Id','asc')->select() ;
				
				if(!$prxt||!$next){
					$prxt[]=['Id'=>$new_delid,'news_tit'=>'没有了'];
					$next[]=['Id'=>$new_delid,'news_tit'=>'没有了'];
				}
				$this->assign(['prxt'=>$prxt,'next'=>$next]);
				//上一篇 下一篇
	    //批量赋值
		
			if(isset($detail[0]['taocan'])&&$detail[0]['taocan']!=='""'){
					$taocan=json_decode($detail[0]['taocan'],true);
					foreach($taocan as $a=>$b){
										$taocan[$a]=json_decode($b,true);
										};
				}else{
					$taocan='';
				};//规格
				
				if(isset($detail[0]['yanse'])&&$detail[0]['yanse']!=='""'){
						$yanse=json_decode($detail[0]['yanse'],true);
						$yanse=json_decode($yanse,true);
						// foreach($yanse as $a=>$b){
						// 					$yanse[$a]=json_decode($b,true);
						// 					};
					}else{
						$yanse='';
					};//颜色
					
					
					// return  json($yanse);
					
					
					if(isset($detail[0]['xinghao'])&&$detail[0]['xinghao']!=='""'){
							$xinghao=json_decode($detail[0]['xinghao'],true);
							foreach($xinghao as $a=>$b){
												$xinghao[$a]=json_decode($b,true);
												};
						}else{
							$xinghao='';
						};//型号
		 
		
			//return json_decode($detail[0]['srcimg']);	
						//多选分类
						
						$dxclass=json_decode($detail[0]['ejclass'],true);
						// return json($dxclass);
						
							//多选分类
						
						
							
		$this->assign([
		    'dxclass'=>$dxclass,
			'detail'=>$detail,
			'love'=>$love,
		    'news_editor'  => $news_editor,
		    'news_jj' => $news_jj ,
			'news_tit'=>$news_tit,
			'new_delid'=>$new_delid,
		    'views'=>$news_view,
			'newstime'=>$newstime,
			'newsclass'=>$newsclass,
			'news_slt'=>$news_slt,
			'new_delid'=>$new_delid,
			'newssort'=>$newssort,
			'bianhao'=>$detail[0]['bianhao'],
			'jiage'=>$detail[0]['jiage'],
			'yijia'=>$detail[0]['yijia'],
			'daqu'=>$detail[0]['daqu'],
			'leixing'=>$detail[0]['leixing'],
			'menpai'=>$detail[0]['menpai'],
			'srcimg'=>json_decode($detail[0]['srcimg']),//轮播图
			'taocan'=>$taocan,//规格
			'yanse'=>$yanse,
			'xinghao'=>$xinghao,
			'webname'=>$seoinfo[0]['seotitle'],
			'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader'],
			'seo'=>$seo,
			//新增
			'Id'=>$id,
			'header'=>'    <!-- 头部(共用) -->
			<header class="header">
			    <!-- logo -->
			    <div class="logo">
			        <a href="/?p=index">
			            <img src="'.$seoinfo[0]['weblogo'].'" alt="">
			        </a>
			        <div class="logo-line"></div>
			        <div>
			            <div class="copyname">广州能动机电设备有限公司</div>
			            <div class="copyname-e">Guangzhou PPS Electrical and Mechanical Equipment co.,ltd</div>
			        </div>
			    </div>
			    <!-- pc-导航栏 -->
			    <div class="pc-nav">
			        <a href="/?p=index" class="pc-nav-item index">首页</a>
			        <a href="/?p=about" class="pc-nav-item about">走进能动</a>
			        <a href="/?p=product" class="pc-nav-item product">产品中心</a>
			        <a href="/?p=technology" class="pc-nav-item technology">技术实力</a>
			        <a href="/?p=case" class="pc-nav-item case">经典案例</a>
			        <a href="/?p=news" class="pc-nav-item news">资讯中心</a>
			        <a href="/?p=contact" class="pc-nav-item contact">联系我们</a>
			    </div>
			    <!-- 搜索及语言切换 -->
			    <div class="header-right">
			        <!-- 搜索 -->
			        <div class="search-icon">
			            <img src="/static/page/img/search.png" alt="">
			            <div class="search-div display">
			                <input type="text" id="search-input" placeholder="搜索产品名称">
			                <div class="go-search">搜索</div>
			            </div>
			        </div>
			        <!-- 语言 -->
			        <div class="lan-switch">
			            <a href="javascript:void(0);" class="lan-active">中文</a>
			            /
			            <a href="javascript:void(0);">EN</a>
			            /
			            <a href="javascript:void(0);">RU</a>
			        </div>
			        <!-- mobile-icon -->
			        <i class="fa fa-list"></i>
			    </div>
			</header>
			<!-- mobile-导航栏 -->
			<div class="mobile-mask">
			    <div class="mobile-nav">
			        <a href="/?p=index" class="mobile-active">首页</a>
			        <a href="/?p=about">走进能动</a>
			        <a href="/?p=product">产品中心</a>
			        <a href="/?p=technology">技术实力</a>
			        <a href="/?p=case">经典案例</a>
			        <a href="/?p=news">资讯中心</a>
			        <a href="/?p=contact">联系我们</a>
			        <div class="moblie-lan">
			            <a href="javascript:void(0);" class="lan-active">中文</a>
			            <a href="javascript:void(0);">EN</a>
			            <a href="javascript:void(0);">RU</a>
			        </div>
			    </div>
			</div>'
			
		
		
			
			
		]);
		if($ifeditor=="editor"){  //判断是否编辑
		switch($formname){
			case 'product':
			$this->view->engine->layout(true);
			
			return $view->fetch('admin/table_edi/editpro');
			break;
			case 'zhaoping':
			$this->view->engine->layout(true);
			return $view->fetch('admin/editzhiwei');
			break;
			default:
			$this->view->engine->layout(true);
			return $view->fetch('admin/table_edi/editornews');
			break;
		}
			
		}else{
		    
		 
			//每个文章的访问数量增加
			
			db($formname)->where('Id',$new_delid)->setInc('views');
			
			//每个文章的访问数量增加
			//文章访问次数
	         $mtime=date('m', time());
			 $time=date('Y-m-d H:i:s', time());
	         $Webdata = new Webdata();
	         
	         $IP = request()->ip();
	          $res=Db::table('webdata')->where('viewtime',$mtime)->where('acview','>','')->order('Id desc')->limit(1)->select();
			  $webpv=Db::table('webdata')->where('viewtime',$mtime)->where('webpv','>','')->order('Id desc')->limit(1)->select();
	         
			
			 $ipres=$Webdata->where('viewip',$IP)->select();
			 $ipnum=count($ipres)+1;
			 if($webpv){
				  $webpv =$webpv[0]['webpv'];
			 }else{
				  $webpv=0;
			 }
	          if($res){
	         	 $acview =$res[0]['acview'];
				
	          }else{
	         	 $acview =0;
				
	          }
			  if($ipnum>20&&$ipnum<100){
			  	$ipvip='潜在用户';
			  }elseif($ipnum>100){
			  	$ipvip='忠实网友';
			  }else{
			  		$ipvip='普通网友';
			  	
			  }
	          $acview=$acview+1;
			  $webpv=$webpv+1;
	         	 $Webdata->data([
	         	     'viewip'  => $IP,
	         	     'acview' => $acview,
	         		 'viewtime'=>$mtime,
					 'webpv'=>$webpv,
					 'operation'=>'浏览产品/文章',
					 'opertime'=> $time,
					 'ipnum'=>$ipnum,
					  'ipvip'=>$ipvip
	         
	         	 ]);
	         	 $Webdata->save();
				 
			 //文章访问次数
			 $this->view->engine->layout(false);  //打开 新的 文章layout模板 	
	     
			switch($formname){
				case 'news':
				$xgdata=db('news')->where('newsclass',$newsclass)->order('Id','desc')->paginate(6);
				   $this->assign(['xgdata'=>$xgdata]);
				 return $view->fetch('index@index/news-details');  //跨模块调用视图
				break;
				case 'product':
				$data=db('product')->where('Id',$new_delid)->order('Id','desc')->select();
			   $this->assign(['data'=>$data[0]]);
				return $view->fetch('index@index/product_list'); 
				break;
			
				case 'dianquan':
				$like=db('dianquan')->whereor('newsclass','点券分类')->order('Id','desc')->select();
				  $this->assign(['like'=>$like]);
				 return $view->fetch('index@index/buy_account');  //跨模块调用视图
				break;
				
			
				case 'danye':
				$helpc=self::newspage('helpc');
				  
				$this->assign(['help'=>$helpc]);
				return $view->fetch('index@index/gonggao');  //跨模块调用视图
				break;
				
				
			}
			
			
			
			
		}
	    
	
	
}//文章列表查看+编辑控制器	

//供页面输出分类用

  public static function newspage($class)
    {
	
    $post=$_GET;
	
		$data=db($post['form'])->select();
		 $pid=db($post['form'])->where('name',$post['class'])->select();
		 
		
		  $info=self::Sortpage($data,$pid[0]['Id']);
		 
    return $info;
    }
  /**
 对数据进行无极限分类
**/
    public static function Sortpage($data = [], $parent_id = 0, $level = 0)
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
               //self::Sortpage($data, $v['Id'], $level+1);  
			
            }
        }
         return $arr;
    }

//供页面输出分类用


public function newsmore(){
	
$new_class = empty($_GET['class'])?"":$_GET['class'];
// 查询状态为1的用户数据 并且每页显示10条数据
$list = Db::name('news')->where('newsclass',$new_class)->paginate(7);
// 把分页数据赋值给模板变量list
$this->assign('list', $list);
//dump($list->items());
// dump($list)
$str=json($list->items());

 
	$Seores = new Seo();
	$seoinfo=$Seores->findseo(); 
	$this->assign([
		
			 'newsclass'=>$new_class,
			'seotitle'=>$seoinfo[0]['seotitle'],
			'seoseokey'=>$seoinfo[0]['seokey'],
			'seoseodsc'=>$seoinfo[0]['seodsc'],
			'seoseoheader'=>$seoinfo[0]['seoheader']
			
			
		]);
		// 渲染模板输出
		 $view=View::instance();
		 $this->view->engine->layout('articlelayout');  
		return $view->fetch('index@article/newsmore');
		
}//更多文章


public function newsclass(){
	
	$res=db('productc')->where('parent_id',0)->select();
	return json($res);
	
}

/**
     * 无限极分类
     * @param $data  数据
     * @return array|bool
     */
    public static function newsTree()
    {
		$request=empty($_REQUEST)?['formname'=>'articleclass']:$_REQUEST;//分类先判断表名 再查询相关分类
		$name=empty($_REQUEST['name'])?'':$_REQUEST['name'];//获取上传信息时的查询二级分类
		$data=Db::table($request['formname'])->select();
		if($name!==''){
		
			$nid=Db::table($request['formname'])->where('name',$name)->select();
		    $info=self::newsSort($data,$nid[0]['Id']);
		}else{
			 $info=self::newsSort($data);
		};
		
		
		  $res['code']=0;
		   $res['count']=100;
		    $res['msg']=0;
			  $res['data']=$info;
			
		  
    return   json($res);
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

public function selclass($selname=''){
	$data=db('productc')->where('name','like','%'.$selname.'%')->select();
	return json($data);
	
	
}//查询分类

public function selclasssj(){
    
    $classdata=[];
    
    $data=db('productc')->select();
    
    $yjclass=db('productc')->where('parent_id',0)->select();//一级分类
     $classdata['one']=$yjclass;
 
     
        foreach($yjclass as $a=>$b){
         
        $twoclass[]=db('productc')->where('parent_id',$b['Id'])->select();//二级分类;
        
    };
    
    foreach ($twoclass as $t=>$y){
        foreach ($y as $t2=>$y2){
            
              $classdata['two'][]=$y2;
        }
      
    }
    
    // return json($classdata['two']);
    
       foreach($classdata['two'] as $c=>$v){
       
        $threeclass[]=db('productc')->where('parent_id',$v['Id'])->select();//三级分类;
        
    };
    
    // print_r($threeclass);
     
        
    // foreach ($threeclass as $t3=>$y3){
    //     foreach ($y3 as $t4=>$y4){
            
    //           $classdata['three'][]=$y4;
    //     }
      
    // }
    
       
     
        
    foreach ($threeclass as $t3=>$y3){
        if($y3){
            $classdata['three'][]=$y3; 
        }
      
      
    }
    
//print_r($classdata['three']);
      
      return json($classdata);
    
    
}//依次查询三级分类




public function coupon(){
	$request=empty($_REQUEST)?['sign'=>'sel']:$_REQUEST;
	switch($request['sign']){
		case 'add':
		$nowtime=date('Y-m-d H:i:s',time());
		$card='card'.rand(55555555,999999999999);
		$info=db('coupon')->insert(['name'=>$request['name'],'price'=>$request['price'],'time'=>$nowtime,'card'=>$card]);
		if($info){
			$res['code']=1;
			return  json($res);
		}else{
			$res['code']=0;
			return  json($res);
		}
		break;
		
		
	}
			
}//优惠券模块	

public function vipcard(){
	$request=empty($_REQUEST)?['sign'=>'sel']:$_REQUEST;
	switch($request['sign']){
		case 'add':
		    
		    for($i=1;$i<=$request['cardnum'];$i++){
		$nowtime=date('Y-m-d H:i:s',time());
		$card='card'.rand(55555555,999999999999);
		$info=db('card')->insert(['name'=>$request['name'],'viewnum'=>$request['viewnum'],'time'=>$nowtime,'card'=>$card,'usedtime'=>$request['usedtime'],'nameid'=>$request['nameid']]);
	 
		    };
		    
	
		if($info){
			$res['code']=1;
			return  json($res);
		}else{
			$res['code']=0;
			return  json($res);
		}
		break;
		
		
	}
			
}//VIP课程卡密模块	

public function kefu(){
	$request=empty($_REQUEST)?['sign'=>'sel']:$_REQUEST;
	switch($request['sign']){
		case 'add':
		$nowtime=date('Y-m-d H:i:s',time());
		
		$info=db('kefu')->insert(['name'=>$request['name'],'time'=>$nowtime,'card'=>$request['code']]);
		if($info){
			$res['code']=1;
			return  json($res);
		}else{
			$res['code']=0;
			return  json($res);
		}
		break;
		
		
	}
			
}//客服验证模块

public function userrole(){
	$requ=empty($_REQUEST)?'':$_REQUEST;
	switch($requ['sign']){
		case '添加管理员':
		$user=db('user')->where('user',$requ['user'])->select();//user不存在重复的就执行新增
		if(!$user){
			$main=db('user')->find(1);
			$info=db('user')->insert(['name'=>$requ['username'],'user'=>$requ['user'],'password'=>$requ['userpwd'],'ico'=>$main['ico']]);	
		}else{
			$info='';
		}
		
		if($info){
			$res['code']=1;
			return  json($res);
		}else{
			$res['code']=0;
			return  json($res);
		}
		break;
		case'编辑管理员':
		  if($requ['edipw']==''){
			  $info=db('user')->where('Id',$requ['Id'])->update(['name'=>$requ['ediname'],'user'=>$requ['ediuser'],'ico'=>$requ['img'],'status'=>$requ['status']]);	  
		  }else{
			  $info=db('user')->where('Id',$requ['Id'])->update(['name'=>$requ['ediname'],'user'=>$requ['ediuser'],'password'=>$requ['edipw'],'ico'=>$requ['img'],'status'=>$requ['status']]);
			  
		  };
		  
		  if($info){
		  	$res['code']=1;
		  	return  json($res);
		  }else{
		  	$res['code']=0;
		  	return  json($res);
		  };
			break;
			case '基本资料':
			$info=db('user')->where('Id',$requ['Id'])->update(['ico'=>$requ['photo'],'username'=>$requ['username'],'companyname'=>$requ['companyname'],'webname'=>$requ['webname'],'domain'=>$requ['domain'],'Address'=>$requ['Address'],'person'=>$requ['person'],'mobile'=>$requ['mobile'],'qq'=>$requ['qq'],'Introduction'=>$requ['Introduction']]);
			if($info){
				$res['code']=1;
				return  json($res);
			}else{
				$res['code']=0;
				return  json($res);
			};
			break;
			case '修改密码':
			 $check=db('user')->where('Id',$requ['Id'])->where('password',$requ['password'])->select();
			 if($check){
				 $info=db('user')->where('Id',$requ['Id'])->update(['password'=>$requ['newspw'],'user'=>$requ['user'],'tippw'=>$requ['tippw']]);
				 if($info){
				 	$res['code']=1;				 	
				 }else{
				 	$res['code']=0;				 
				 };
			 }else{
				 
				 $res['code']=3;		
			 }
			
			return  json($res);
			break;
			case '账号权限':
			$info=db('user')->where('Id',$requ['Id'])->update(['role'=>$requ['data']]);
			if($info){
				$res['code']=1;				 	
			}else{
				$res['code']=0;				 
			};
			return  json($res);
			break;
			case '获取权限':
			$user=db('user')->where('Id',$requ['Id'])->select();
			if($user){
				$res['code']=1;	
				$res['role']=$user[0]['role'];				
			}else{
				$res['code']=0;				 
			};
			return  json($res);
			break;
		
		
	}
	
}//管理员模块

public function tuij($id=''){
         $data=db('productc')->find($id);
		 if($data['zhu']=='推荐'){
			$info=db('productc')->where('Id',$id)->update(['zhu'=>'否']); 
		 }else{
			$info=db('productc')->where('Id',$id)->update(['zhu'=>'推荐']); 
		 }
	
	if($info){
		$res['code']=1;	
	}else{
		$res['code']=0;				 
	};
	return  json($res);
	
	
}//将分类信息推荐到 首页

}

?>