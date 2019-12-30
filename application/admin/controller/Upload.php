<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use think\Db;
use think\validate;

class Upload extends AdminBase
{
	protected function _initialize(){
		parent::_initialize();
	}
	public function image(){
        $ret = [
            'code'  =>  1,
            'msg'   =>  'error',
            'data'  =>  ''
        ];
        $file = request()->file('file');
        if($file){
            $info = $file->validate(['size'=>15678,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $ret = [
                    'code'  =>  0,
                    'msg'   =>  'success',
                    'data'   =>  $info->getSaveName(),
                ];
            }else{
                $ret = [
                    'code'  =>  1,
                    'msg'   =>  $file->getError(),
                    'data'  =>  '',
                ];
            }
        }
        return json($ret);
	}
}