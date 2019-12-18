<?php
use think\Db;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

define('REALMNAME','http://192.168.7.139');
//HTTP请求（支持HTTP/HTTPS，支持GET/POST）
function http_request($url, $data = null){
	$data  = json_encode($data);    
	$headerArray =array("Content-type:application/json;charset='utf-8'","Accept:application/json");
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($curl);
	curl_close($curl);
	return $output;
}

function uuid() {
	
		$charid = md5(uniqid(mt_rand(), true));

		$hyphen = chr(45);// "-"

		$uuid = substr($charid, 0, 8).$hyphen

			   .substr($charid, 8, 4).$hyphen

			   .substr($charid,12, 4).$hyphen

			   .substr($charid,16, 4).$hyphen

			   .substr($charid,20,12);

		return $uuid;
	
	}

function type($type_id,$type_name){
	$sql = "select type_id as '$type_id',type_name as '$type_name' from sys_type a inner join sys_group b on a.group_id = b.group_id where a.is_use = 1 and b.column_name = '$type_id'";
	$list = Db::query($sql);
	return $list;
}

function task(){
	$sql = 'select task_id,task_name from bus_task where is_use = 1';
	$list = Db::query($sql);
	return $list;
}

function task_kol(){
	$sql = 'select task_kol_id,nickname from bus_task_kol';
	$list = Db::query($sql);
	return $list;
}


function customer(){
	$sql = 'select customer_id ,customer_code  from bf_customer where is_use = 1';
	$list = Db::query($sql);
	return $list;
}