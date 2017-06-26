<?php
define('APP_DEBUG',true);//开启调试功能，网站上线后就要关掉

// 定义应用目录
define("HOME_PUBLIC","/travelWeb/Home/Public"); //前台
define("ADMIN_PUBLIC","/travelWeb/Admin/Public"); // 后台

// 引入ThinkPHP入口文件
include 'ThinkPHP/ThinkPHP.php';