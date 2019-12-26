<?php
namespace app\index\controller;
use think\Db;

class Index extends \think\Controller

{
	public function index(){
		$title = '首页';
		$this->assign('title',$title);
		return $this->fetch('index');
	}
}