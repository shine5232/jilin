<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use think\Db;

class Brand extends AdminBase
{
	protected function _initialize(){
		parent::_initialize();
	}
	public function index(){
		$this->assign('brand_name','');
		return $this->fetch();
	}
	public function index_ajax(){
		$ret = [
            'code'  =>  0,
            'msg'   =>  "",
            'count'     =>  0,
            'data'      =>  []
        ];
        $page = input('page',1,'intval');
        $limit = input('limit',10,'intval');
        $brand_name = input('brand_name','');
        if($brand_name){
            $where = "brand_name like '%$brand_name%'";
        }else{
            $where = 'brand_name is not null';
        }
        $page_start = ($page - 1) * $limit;
        $list =  Db::name('brand')
                        ->where($where)
                        ->order("id ASC")
                        ->limit($page_start,$limit)->select();
        $count = Db::name('brand')->where($where)->count();
        if($list){
            $ret['count'] = $count;
            $ret['data'] = $list;
        }
        return json($ret);
	}
	public function brand_add(){
		return $this->fetch();
	}
	public function brand_post(){
		$id  = input('brand_id', 0, 'intval');
		$data = array();
		$data['brand_name'] = input('brand_name','');
		$data['brand_img'] = input('brand_img','');
		$ret = [
            'status'    =>  'error'
        ];
		if(input('status')){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
		if(empty($id)){
			$result = $this->validate($data, 'Brand');
            if ($result) {
                $data['creat_time'] = date('Y-m-d H:i:s');
                $result = Db::name('brand')->insert($data);
                if ($result !== false) {
                    $ret['status'] = 'success';
                }
            }
		}else{
			$result = $this->validate($data, 'Brand.edit');
            if ($result) {
                $result = Db::name('brand')->where('id',$id)->update($data);
                if ($result !== false) {
                    $ret['status'] = 'success';
                }
            }
		}
		return json($ret);
	}
}