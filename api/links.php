<?php
header("Access-Control-Allow-Origin: *");
include('../config/link.php');
function newlinks($links){//新建分类时获取最新mid
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
$newlinks=$links;

if(!empty($_GET['num'])){
$newlinks=newlinks($links);
$newlinks=array_slice($newlinks,0,$_GET['num']);   
}
if(!empty($_GET['new'])){
$newlinks=newlinks($links);
}
if(!empty($_GET['mid'])){
    
foreach ($links as $key => $value) {
if($value['mid'] != $_GET['mid']){
unset($links[$key]);
}
}
$newlinks=$links;   
    
}

echo json_encode($newlinks);
?>