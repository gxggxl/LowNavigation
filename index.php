<?php include('config/config.php');?>
<!doctype html>
<html lang="zh-CN" x-data="{api:'<?php echo $setting['siteurl'] ?>/api/',all:'',setting:''}" 
x-init="fetch(api+'?all').then(data => data.json()).then(data=>{
all=data;setting=all.setting;
});"
>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,user-scalable=no,viewport-fit=cover,initial-scale=1">
  <title x-text="setting.sitename+' - '+setting.sitedis">低端导航</title>
 <link rel="apple-touch-icon" href="./favicon.webp">
 <link rel="icon" href="./favicon.webp">
 <link href="./output.css" rel="stylesheet">
<style>[x-cloak] { display: none !important; }
.line-1 {
    word-break: break-all;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}
.line-2 {
    word-break: break-all;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
</style>
</head>
<body class="bg-white dark:bg-gray-900">
<nav class="bg-white shadow dark:bg-gray-800 fixed inset-x-0 z-30" x-data="{menu:false}">
        <div class="container px-6 py-4 mx-auto md:flex md:justify-between md:items-center">
            <div class="flex items-center justify-between">
                <div class="flex items-center flex-shrink-0 text-base font-bold text-sky-500 transition-colors duration-200 transform dark:text-white lg:text-xl hover:text-gray-700 dark:hover:text-gray-300"><svg class="fill-current h-6 w-6 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"></path></svg><span  x-text="setting.sitename"></span>
                </div>

            </div>

        </div>
    </nav>
    
<div class="pt-20"></div>
   

<template x-for="(fenlei,index) in all.cate">  



<section class="py-3 sm:py-6" :class="{'bg-white dark:bg-gray-900':index%2==0,'bg-gray-50 dark:bg-gray-700':index%2!=0}" x-cloak>
        <div class="container flex flex-col items-center px-4 py-6 sm:py-12 mx-auto">
            <h2 class="text-3xl font-semibold tracking-tight text-gray-700 sm:text-4xl dark:text-white" x-text="fenlei.name">
            </h2>
<p class="mx-auto leading-relaxed text-base text-center pt-2 text-gray-600 dark:text-gray-400" x-text="fenlei.slug"></p>
            <div class="mt-6 w-full">
<div class="flex flex-wrap -m-2" x-data="{link:''}" 
x-init="fetch(api+'links.php?mid='+fenlei.mid).then(data => data.json()).then(data=>{link=data;});">
<template x-for="(item,index) in link">
<div class="p-2 lg:w-1/3 md:w-1/2 w-full">
    <a :href="item.site" class="h-full bg-white dark:bg-gray-900 flex items-center border-gray-100 dark:border-gray-600 border p-4 rounded-lg hover:shadow-md duration-300" target="_blank">
        <img :alt="item.name" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" :src="'https://zezeshe.com/api/ico/?url='+item.site">
        <div class="flex-grow">
            <h2 class="text-gray-700 dark:text-gray-200 title-font font-medium" x-text="item.name"></h2>
            <p class="text-gray-500 line-1" x-text="item.dis"></p>
            </div>
            </a>
    </div>
</template>
</div>
            </div>
        </div>
    </section>





</template>  

  







<section id="about" class="bg-white dark:bg-gray-800 pt-10">
        <div class="container px-6 py-8 mx-auto">
            <div class="items-center lg:flex">
                <div class="lg:w-1/2">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">低端导航</h2>

                    <p class="mt-4 text-gray-500 dark:text-gray-400 lg:max-w-md">
                    低端导航是一款基于世界上最好的编程语言PHP开发，致力于做做简洁的导航程序！
                    </p>

                    <div class="flex items-center mt-6 -mx-2">
                        <a class="mx-2" href="#" aria-label="Twitter">
                            <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M492 109.5c-17.4 7.7-36 12.9-55.6 15.3 20-12 35.4-31 42.6-53.6-18.7 11.1-39.4 19.2-61.5 23.5C399.8 75.8 374.6 64 346.8 64c-53.5 0-96.8 43.4-96.8 96.9 0 7.6.8 15 2.5 22.1-80.5-4-151.9-42.6-199.6-101.3-8.3 14.3-13.1 31-13.1 48.7 0 33.6 17.2 63.3 43.2 80.7-16-.4-31-4.8-44-12.1v1.2c0 47 33.4 86.1 77.7 95-8.1 2.2-16.7 3.4-25.5 3.4-6.2 0-12.3-.6-18.2-1.8 12.3 38.5 48.1 66.5 90.5 67.3-33.1 26-74.9 41.5-120.3 41.5-7.8 0-15.5-.5-23.1-1.4C62.8 432 113.7 448 168.3 448 346.6 448 444 300.3 444 172.2c0-4.2-.1-8.4-.3-12.5C462.6 146 479 129 492 109.5z"></path>
                            </svg>
                        </a>
                    
                        <a class="mx-2" href="#" aria-label="Facebook">
                            <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M426.8 64H85.2C73.5 64 64 73.5 64 85.2v341.6c0 11.7 9.5 21.2 21.2 21.2H256V296h-45.9v-56H256v-41.4c0-49.6 34.4-76.6 78.7-76.6 21.2 0 44 1.6 49.3 2.3v51.8h-35.3c-24.1 0-28.7 11.4-28.7 28.2V240h57.4l-7.5 56H320v152h106.8c11.7 0 21.2-9.5 21.2-21.2V85.2c0-11.7-9.5-21.2-21.2-21.2z"></path>
                            </svg>
                        </a>
                    
                        <a class="mx-2" href="#" aria-label="Linkden">
                            <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M417.2 64H96.8C79.3 64 64 76.6 64 93.9V415c0 17.4 15.3 32.9 32.8 32.9h320.3c17.6 0 30.8-15.6 30.8-32.9V93.9C448 76.6 434.7 64 417.2 64zM183 384h-55V213h55v171zm-25.6-197h-.4c-17.6 0-29-13.1-29-29.5 0-16.7 11.7-29.5 29.7-29.5s29 12.7 29.4 29.5c0 16.4-11.4 29.5-29.7 29.5zM384 384h-55v-93.5c0-22.4-8-37.7-27.9-37.7-15.2 0-24.2 10.3-28.2 20.3-1.5 3.6-1.9 8.5-1.9 13.5V384h-55V213h55v23.8c8-11.4 20.5-27.8 49.6-27.8 36.1 0 63.4 23.8 63.4 75.1V384z"></path>
                            </svg>
                        </a>
                    
                        <a class="mx-2" href="#" aria-label="Github">
                            <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M256 32C132.3 32 32 134.9 32 261.7c0 101.5 64.2 187.5 153.2 217.9 1.4.3 2.6.4 3.8.4 8.3 0 11.5-6.1 11.5-11.4 0-5.5-.2-19.9-.3-39.1-8.4 1.9-15.9 2.7-22.6 2.7-43.1 0-52.9-33.5-52.9-33.5-10.2-26.5-24.9-33.6-24.9-33.6-19.5-13.7-.1-14.1 1.4-14.1h.1c22.5 2 34.3 23.8 34.3 23.8 11.2 19.6 26.2 25.1 39.6 25.1 10.5 0 20-3.4 25.6-6 2-14.8 7.8-24.9 14.2-30.7-49.7-5.8-102-25.5-102-113.5 0-25.1 8.7-45.6 23-61.6-2.3-5.8-10-29.2 2.2-60.8 0 0 1.6-.5 5-.5 8.1 0 26.4 3.1 56.6 24.1 17.9-5.1 37-7.6 56.1-7.7 19 .1 38.2 2.6 56.1 7.7 30.2-21 48.5-24.1 56.6-24.1 3.4 0 5 .5 5 .5 12.2 31.6 4.5 55 2.2 60.8 14.3 16.1 23 36.6 23 61.6 0 88.2-52.4 107.6-102.3 113.3 8 7.1 15.2 21.1 15.2 42.5 0 30.7-.3 55.5-.3 63 0 5.4 3.1 11.5 11.4 11.5 1.2 0 2.6-.1 4-.4C415.9 449.2 480 363.1 480 261.7 480 134.9 379.7 32 256 32z"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="mt-8 hidden lg:block lg:mt-0 lg:w-1/2">
                    <div class="flex items-center justify-center lg:justify-end">
                        <div class="max-w-lg">
                            <img class="object-cover object-center w-full h-64" src="./images/website.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<footer class="bg-gray-800">
        <div class="container px-6 pb-8 mx-auto">
<hr class="mb-8 border-gray-700">
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
            <p class="text-sm text-gray-400">© Copyright 2022. All Rights Reserved.</p>

            <div class="flex mt-3 -mx-2 sm:mt-0">
                <a href="https://blog.zezeshe.com/about.html" class="mx-2 text-sm text-gray-400 hover:text-gray-300" aria-label="about"> About </a>

                <a href="https://blog.zezeshe.com/" class="mx-2 text-sm text-gray-400 hover:text-gray-300" aria-label="blog"> Blog </a>

            </div>
            </div>
        </div>
</footer>

<script src="https://cdn.staticfile.org/alpinejs/3.9.6/cdn.min.js" defer></script>
</body>
</html>