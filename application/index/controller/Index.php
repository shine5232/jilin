<?php
namespace app\index\controller;
use think\Db;

class Index extends \think\Controller

{
	//发布者
	public function publish(){
		return $this->fetch('publish');
	}
}