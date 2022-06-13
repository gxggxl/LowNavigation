<?php
include('function.php');//载入函数
if(!haslogin()){//限制api在登录后使用
$result[0]['status']=-1;$result[0]['info']= "登录校验失败，请登录后使用该api！";
echo json_encode($result);exit;
}
//设置时区，否则文章的发布时间会查8H
date_default_timezone_set('PRC');
$catepath='../config/cate.php';
$linkpath='../config/link.php';
$configpath='../config/config.php';
require_once($catepath);//载入分类数组
require_once($linkpath);//载入链接数组
require_once($configpath);//载入设置数组
$post=$_REQUEST;//接受请求不管get还是post

//添加链接
if(isset($post['addlink'])&&!empty($post['site'])&&!empty($post['name'])&&!empty($post['mid'])){
if (filter_var($post['site'], FILTER_VALIDATE_URL ) === false ){
notice('网址格式不正确！');exit;}
$links[]=array('name'=>$post['name'],'dis'=>$post['dis'],'site'=>$post['site'],'mid'=>$post['mid'],'time'=>time()); 
if (file_put_contents($linkpath, "<?php\n \$links= ".var_export($links, true).";\n?>")) {
echo json_encode(newlinks($links));
    } else{notice('链接添加失败！');}  
exit;
}

//删除链接
if(!empty($post['delete'])&&$post['delete']=='link'&&!empty($post['name'])){
foreach ($links as $key => $value) {
if($value['name'] == $post['name']){
unset($links[$key]);
}}
$links=array_values($links);
if (file_put_contents($linkpath, "<?php\n \$links= ".var_export($links, true).";\n?>")) {
echo json_encode($links);
    }else{notice('删除失败！');} 
}

//修改链接排序
if(!empty($post['link'])){//修改排序
$shuju=json_decode($post['link'], true);
if (file_put_contents($linkpath, "<?php\n \$links= ".var_export($shuju, true).";\n?>")) {
    } else{notice("拖拽排序保存失败！");}
exit;
}

//修改链接
if(isset($post['edit'])&&!empty($post['site'])&&!empty($post['name'])&&!empty($post['mid'])){
if (filter_var($post['site'], FILTER_VALIDATE_URL ) === false ){
notice('网址格式不正确！');exit;}
foreach ($links as &$fl) {
if($fl['name'] == $post['edit']){
$fl['name']=$post['name'];
$fl['dis']=$post['dis'];
$fl['site']=$post['site'];
$fl['mid']=$post['mid'];
$fl['time']=time();;
}
}unset($fl); 
if (file_put_contents($linkpath, "<?php\n \$links= ".var_export($links, true).";\n?>")) {
$links=newlinks($links);
echo json_encode($links);
    } else{notice("链接修改失败！");}
exit;
}

//添加分类
if(isset($post['addcate'])&&isset($post['name'])&&isset($post['slug'])){//增加分类
$mid=addmid();
$fenlei[]=array('mid'=>$mid,'name'=>$post['name'],'slug'=>$post['slug']);
if (file_put_contents($catepath, "<?php\n \$fenlei= ".var_export($fenlei, true).";\n?>")) {
echo json_encode($fenlei);
    } else{notice("分类添加失败！");}
exit;
}

//删除分类
if(!empty($post['delete'])&&$post['delete']=='cate'&&!empty($post['mid'])){
foreach ($fenlei as $key => $value) {
if($value['mid'] == $post['mid']){
unset($fenlei[$key]);}}
$fenlei=array_values($fenlei);
if (file_put_contents($catepath, "<?php\n \$fenlei= ".var_export($fenlei, true).";\n?>")) {
foreach ($links as &$fl) {
if($fl['mid'] == $post['mid']){
$fl['mid']='0';
}
}unset($fl); 
file_put_contents($linkpath, "<?php\n \$links= ".var_export($links, true).";\n?>");
echo json_encode($fenlei);
    } else{notice("删除失败！");}
exit;
}

//分类排序
if(!empty($post['cate'])){//修改分类排序
$shuju=json_decode($post['cate'], true);
if (file_put_contents($catepath, "<?php\n \$fenlei= ".var_export($shuju, true).";\n?>")) {
    } else{notice("拖拽排序写入失败！");}
exit;
}

//修改分类
if(isset($post['name'])&&isset($post['slug'])&&isset($post['edit'])){//修改分类
foreach ($fenlei as &$fl) {
if($fl['mid'] == $post['edit']){
$fl['name']=$post['name'];
$fl['slug']=$post['slug'];
}
}unset($fl); 
if (file_put_contents($catepath, "<?php\n \$fenlei= ".var_export($fenlei, true).";\n?>")) {
echo json_encode($fenlei);
    } else{notice("分类修改失败！");
    }
exit;
}

//修改网站设置
if(!empty($post['siteurl'])&&!empty($post['sitename'])&&!empty($post['sitedis'])){
$setting=array('siteurl'=>$post['siteurl'],'sitedis'=>$post['sitedis'],'sitename'=>$post['sitename']); 
if (file_put_contents($configpath, "<?php\n \$setting= ".var_export($setting, true).";\n \$profile= ".var_export($profile, true).";\n \$config= ".var_export($config, true).";\n?>")) {
echo json_encode($setting);
    } else{notice("设置保存错误！");}  
exit;   
}

//修改个人设置
if(!empty($post['screenName'])&&!empty($post['mail'])){
$profile=array('screenName'=>$post['screenName'],'mail'=>$post['mail'],); 
if (file_put_contents($configpath, "<?php\n \$setting= ".var_export($setting, true).";\n \$profile= ".var_export($profile, true).";\n \$config= ".var_export($config, true).";\n?>")) {
echo json_encode($profile);
    } else{notice("设置保存错误！");}   
exit;   
}

//修改用户名以及密码
if(!empty($post['username'])&&!empty($post['password'])&&!empty($post['confirm'])){
if($post['password']==$post['confirm']){
$config=array('username'=>$post['username'],'password'=>$post['password'],); 
if (file_put_contents($configpath, "<?php\n \$setting= ".var_export($setting, true).";\n \$profile= ".var_export($profile, true).";\n \$config= ".var_export($config, true).";\n?>")) {
echo json_encode($profile);
    } else{notice("设置保存错误！");}  
}else{notice("两次密码输入不一致请重新输入！");}  
exit;   
}




function notice($info,$type='-1'){
$result['status']=$type;
$result['info']= $info;
echo json_encode($result);    
}



?>