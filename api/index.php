<?php 
header("Access-Control-Allow-Origin: *");
$json='参数不正确！';
include('../config/config.php');
include('../config/cate.php');
include('../config/link.php');
if(empty($_GET['all'])){
$all['setting']=$setting;
$all['cate']=$fenlei;
$json=$all;
}




echo json_encode($json);
?>