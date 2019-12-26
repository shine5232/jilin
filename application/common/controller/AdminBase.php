<?php
namespace app\common\controller;

use think\Controller;
use think\Db;

/**
 * 后台公用基础控制器
 * Class AdminBase
 * @package app\common\controller
 */
class AdminBase extends Controller
{
    protected function _initialize()
    {
        parent::_initialize();
        $this->checkAuth();
    }

    /**
     * 权限检查
     * @return bool
     */
    protected function checkAuth()
    {
        if(!session('admin')){
            $this->redirect('/admin/user/login');
        }
    }
}