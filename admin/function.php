<?php
$config='../config/config.php';
include($config); 
define('__GRAVATAR__', 'https://cravatar.cn/avatar/');
define('screenName', $profile['screenName']);
define('mail', $profile['mail']);
define('tx', 'https://cravatar.cn/avatar/'.md5(mail).'?s=200');

define('sitename', $setting['sitename']);
define('sitedis', $setting['sitedis']);
define('siteurl', $setting['siteurl']);

if(isset($_GET['logout'])){
setcookie("zt", "","-1","/");
reurl(siteurl.'/admin/index.php');
}


function reurl($url){
header("Location: ".$url); 
//确保重定向后，后续代码不会被执行 
exit;
}

function haslogin(){
$config='../config/config.php';
include($config); 
$username=$config['username'];
$password = $config['password'];
$cookielock=md5($username.$password);
if(!isset($_COOKIE["zt"])||$_COOKIE["zt"]!==$cookielock){
    return false;
}else{
    return true;
}
    
}



function addmid(){//新建分类时获取最新mid
$path='../config/cate.php';
include($path);  
$Arrzong=$fenlei;
if(count($Arrzong)>0){
// 重新拍排序
if(count($Arrzong)){//获取当前数组长度
	$arrPX1 = array();
	//$arrPX2 = array();
	foreach ($Arrzong as $k => $v){
		//需要排序的列表,这里只拿id作为示例
		$arrPX1[$k] =  $v['mid'];
		//$arrPX2[$k]  = $v['px'];
	}
	//执行排序
	array_multisort($arrPX1, SORT_DESC/* ,$arrPX2, SORT_ASC*/, $Arrzong);
}

//print_r($Arrzong);
//SORT_ASC - 默认。按升序排序 (A-Z)。
//SORT_DESC - 按降序排序 (Z-A)。
    
return intval($Arrzong[0]['mid'])+1;
}else{
return 1;
}

}


function newlinks($links){//根据time排序最新链接
$Arrzong=$links;
// 重新拍排序
if(count($Arrzong)){//获取当前数组长度
	$arrPX1 = array();
	//$arrPX2 = array();
	foreach ($Arrzong as $k => $v){
		//需要排序的列表,这里只拿id作为示例
		$arrPX1[$k] =  $v['time'];
		//$arrPX2[$k]  = $v['px'];
	}
	//执行排序
	array_multisort($arrPX1, SORT_DESC/* ,$arrPX2, SORT_ASC*/, $Arrzong);
}

//print_r($Arrzong);
//SORT_ASC - 默认。按升序排序 (A-Z)。
//SORT_DESC - 按降序排序 (Z-A)。
    
return $Arrzong;
}

function countif($shuzu,$a,$b){//判断分类或链接是否存在重复
foreach ($shuzu as $key => $value) {
if($value[$b] == $a){return true;break;}}
return false;
}



?>
