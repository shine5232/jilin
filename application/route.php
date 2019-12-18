<?php

// +----------------------------------------------------------------------

// | ThinkPHP [ WE CAN DO IT JUST THINK ]

// +----------------------------------------------------------------------

// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.

// +----------------------------------------------------------------------

// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

// +----------------------------------------------------------------------

// | Author: liu21st <liu21st@gmail.com>

// +----------------------------------------------------------------------



//return [
//
//    '__pattern__' => [
//
//        'name' => '\w+',
//
//    ],
//
//    '[hello]'     => [
//
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//
//        ':name' => ['index/hello', ['method' => 'post']],
//
//    ],
//
//
//
//];

use think\Route;
//群控接口
Route::rule('dyOper','index/Api/dyOper','GET|POST');

//管理后台登录
Route::rule('','index/User/login','GET|POST');

//控制面板首页
Route::rule('main','index/User/main','GET|POST');

