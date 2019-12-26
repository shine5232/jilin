<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use think\Db;

class Index extends AdminBase
{
	protected function _initialize(){
		parent::_initialize();
	}
	public function index(){
		return $this->fetch('/user/main');
	}
}