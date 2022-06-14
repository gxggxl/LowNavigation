<?php include('function.php') ?>
<?php if(!haslogin()){reurl(siteurl.'/admin/login.php');} ?>
<?php 
//设置时区，否则文章的发布时间会查8H
date_default_timezone_set('PRC');
$path='../config/config.php';
require_once($path);

$tishi='';
$post=$_REQUEST;
//导入处理
if(isset($post['up'])){
    
//创建上传目录
$path = './import/';
if (!is_dir($path)) {
    mkdir($path, 0777, true);
}
$file = $_FILES['up'];
$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
if(in_array($file["type"],$mimes)){
  $name = 'import.cvs';  
if(move_uploaded_file($file["tmp_name"], $path.'/'.$name)){

$shuzu=ReadCsv($path.'/'.$name);
//print_r($shuzu);
$t='';
foreach ($shuzu as $key => $value) {
if(!addlink($value)){
    $t=$t.$value['name'].'->参数不正确故跳过<br>';
}else{
    $t=$t.$value['name'].'->导入完成！<br>';
}
}
$tishi=$t;
unlink($path.'/'.$name);

}else{$tishi = '上传失败！';}

}else{$tishi = '文件格式不正确！';}



    
}

function addlink($val){
date_default_timezone_set('PRC');
$linkpath='../config/link.php';
include($linkpath);//载入链接数组  
if(!empty($val['site'])&&!empty($val['name'])&&isset($val['mid'])){
if (filter_var($val['site'], FILTER_VALIDATE_URL ) === false ){
return false;}
$links[]=array('name'=>$val['name'],'dis'=>$val['dis'],'site'=>$val['site'],'mid'=>$val['mid'],'time'=>time()); 
if (file_put_contents($linkpath, "<?php\n \$links= ".var_export($links, true).";\n?>")) {
return true;
    } else{return false;}  
}

}


function ReadCsv($uploadfile='')
    {
        setlocale(LC_ALL,'zh_CN');
 
        $file = fopen($uploadfile, "r");
        while (!feof($file)) {
            $data[] = fgetcsv($file);
        }
        
        foreach ($data as $key => $value) {

            if (!$value) {
                unset($data[$key]);
            }
        }
        fclose($file);
 
        $head = $data[0];
        unset($data[0]);
 
        foreach ($data as $key => $value){
            foreach ($head as $k => $v){
                $res[$key][$v] = $value[$k];
            }
        }
 
        return $res;
    }
?>



<?php include('header.php') ?>
<?php include('menu.php') ?>

<div class="container mx-auto px-2 sm:px-6">



<!--导入-->
<div class="bg-white dark:bg-black p-2 sm:p-6 mt-9" x-data="{mail:'<?php echo $profile['mail']; ?>',screenName:'<?php echo $profile['screenName']; ?>',}"> 
<h2 class="flex items-center text-xl font-medium text-gray-800 capitalize dark:text-white md:text-2xl"><svg class="w-6 h-6 inline text-blue-700 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>批量导入</h2>
<p class="mt-2">请使用wps将excel的前4列，列名分别设置为name，dis，site，mid，对应的列内容未网站名字，网站描述，网站地址，分类mid，其中网站描述列内容可以为空，然后导出cvs，最后将cvs在这里上传即可</p>

<div class="mt-4">
<form action="<?php echo siteurl; ?>/admin/import.php?up" method="post" enctype="multipart/form-data">
<input type="file" name="up"  accept="text/csv" class="w-full text-gray-700 px-3 py-2 border rounded">
<button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">保存</button>
</form>

<p><?php echo $tishi; ?></p>
            </div>
</div>







</div>

<?php include('footer.php') ?>