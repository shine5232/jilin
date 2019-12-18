<?php
namespace app\index\controller;
use think\Db;

class Base extends \think\Controller

{
	public function _initialize(){
		if(!session('admin')){
			echo 'no right error';exit;
		}
	}
	
	//运营号曲线统计
	public function chart(){
		if(!session('admin')){
			$this->redirect('/');
		}
		
		$endDay = (int)date('d',time());
		$xdata = [];
		for($i=1;$i<=$endDay;$i++){
			array_push($xdata,$i);
		}
		
		//
		$data = [];
		$list = Db::name('no_history_list')->alias('h')->field('h.no_id,n.no')->join('__NO_LIST__ n','n.no_id=h.no_id','LEFT')->group('h.no_id')->select();
		if($list){
			foreach($list as $k=>$l){
				$temp = [];
				$sql = 'SELECT *,day(FROM_UNIXTIME(created_at)) as d,FROM_UNIXTIME(created_at) as dates FROM dy_no_history_list
						where
						no_id = '.$l['no_id'].'
						AND
						YEAR(FROM_UNIXTIME(created_at)) = YEAR(NOW())
						and
						MONTH(FROM_UNIXTIME(created_at)) = MONTH(NOW())
						GROUP BY FROM_UNIXTIME(created_at)';
				$arr = Db::query($sql);
				$temp['no'] = $l['no'];
				foreach($xdata as $n=>$x){
					$temp['days'][$n] = $x.'号';
					$temp['a'][$n] = 0;
					$temp['b'][$n] = 0;
					$temp['c'][$n] = 0;
					
					if($arr){
						foreach($arr as $ar){
							if($ar['d'] == $x){
								$temp['a'][$n] = $ar['a'];
								$temp['b'][$n] = $ar['b'];
								$temp['c'][$n] = $ar['c'];
							}
						}
					}
				}
				
				array_push($data,$temp);
			}
		}
		
		$this->assign('list',$data);
		
		
		return $this->fetch('chart');
	}
	
	
	/*
	* 采集用户统计
	*/
	
	
	//采集用户统计管理页
	public function user(){
		if(!session('admin')){
			$this->redirect('/');
		}
		return $this->fetch('user');
	}
	
	//采集用户统计管理数据接口
	public function userList(){
		$page = input('page',1);
		$limit = input('limit',0);
		
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		
		$where = '';
		
		//count
		$count = Db::name('user_list')->where($where)->count();
		//list
		$list = Db::name('user_list')
				->where($where)
				->limit(($page-1)*$limit.','.$limit)
				->select();
		
		if($list){
			foreach($list as $k=>$item){
				$list[$k]['created_at'] = !empty($item['created_at'])?date('Y-m-d H:i:s',$item['created_at']):'';
			}
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		
		return json($ret);
	}
	
	
	//采集用户统计删除操作
	public function userDel(){
		$user_id = input('user_id',0);
		
		$ret = [
			'status'	=>	'error'
		];
		
		$r = Db::name('user_list')->where(['user_id'=>$user_id])->delete();
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	
	/*
	* 行业
	*/
	
	
	//行业管理页
	public function industry(){
		if(!session('admin')){
			$this->redirect('/');
		}
		return $this->fetch('industry');
	}
	
	//行业管理数据接口
	public function industryList(){
		$page = input('page',1);
		$limit = input('limit',0);
		
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		
		$where = '';
		
		//count
		$count = Db::name('industry_list')->where($where)->count();
		//list
		$sql = 'select * from dy_industry_list limit '.($page-1)*$limit.','.$limit;
		$list = Db::query($sql);
		if($list){
			foreach($list as $k=>$item){
				$list[$k]['created_at'] = !empty($item['created_at'])?date('Y-m-d H:i:s',$item['created_at']):'';
				$list[$k]['updated_at'] = !empty($item['updated_at'])?date('Y-m-d H:i:s',$item['updated_at']):'';
			}
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		
		return json($ret);
	}
	
	//行业添加确认
	public function industryAddSubmit(){
		$industry_name = input('industry_name');
		
		$ret = [
			'status'	=>	'error'
		];
		
		if(empty($industry_name)){
			return json($ret);
		}
		
		$data = [
			'industry_name'	=>	$industry_name
		];
		
		$re = Db::name('industry_list')->where($data)->find();
		if($re){
			$ret['status'] = 'have';
		}else{
			$data['created_at'] = time();
			$r = Db::name('industry_list')->insert($data);
			if($r){
				$ret['status'] = 'success';
			}
		}
		
		return json($ret);
	}
	
	//行业编辑
	public function industryEdit(){
		$industry_id = input('industry_id',0);
		
		$where = [
			'industry_id'	=>	$industry_id
		];
		
		$item = Db::name('industry_list')->where($where)->find();
		$this->assign('industry',$item);
		
		return $this->fetch('industry_edit');
	}
	
	//行业编辑确认
	public function industryEditSubmit(){
		$industry_id = input('industry_id',0);
		$industry_name = input('industry_name');
		
		$ret = [
			'status'	=>	'error'
		];
		
		if(empty($industry_name)){
			return json($ret);
		}
		
		$data = [
			'industry_name'	=>	$industry_name,
			'updated_at' 	=>	time()
		];
		$r = Db::name('industry_list')->where(['industry_id'=>$industry_id])->update($data);
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	
	//行业删除操作
	public function industryDel(){
		$industry_id = input('industry_id',0);
		
		$ret = [
			'status'	=>	'error'
		];
		
		$r = Db::name('industry_list')->where(['industry_id'=>$industry_id])->delete();
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	
	
	/*
	* 抖音号
	*/
	
	
	//抖音号管理页
	public function no(){
		if(!session('admin')){
			$this->redirect('/');
		}
		
		$list = Db::name('industry_list')->select();
		$this->assign('list',$list);
		
		return $this->fetch('no');
	}
	
	//抖音号管理数据接口
	public function noList(){
		$page = input('page',1);
		$limit = input('limit',0);
		
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		
		$where = '';
		
		//count
		$count = Db::name('no_list')->where($where)->count();
		//list
		$list = Db::name('no_list')
				->alias('n')
				->field('n.*,d.device_no')
				->join('__DEVICE_LIST__ d','d.device_id=n.device_id','LEFT')
				->order('no_id desc')
				->limit(($page-1)*$limit.','.$limit)
				->select();
		
		if($list){
			foreach($list as $k=>$item){
				$list[$k]['created_at'] = !empty($item['created_at'])?date('Y-m-d H:i:s',$item['created_at']):'';
				$list[$k]['updated_at'] = !empty($item['updated_at'])?date('Y-m-d H:i:s',$item['updated_at']):'';
			}
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		
		return json($ret);
	}
	
	//抖音号添加确认
	//public function noAddSubmit(){
	//	$no = input('no');
	//	$industry_id = input('industry_id');
		
	//	$ret = [
	//		'status'	=>	'error'
	//	];
		
	//	if(empty($no) || empty($industry_id)){
	//		return json($ret);
	//	}
		
	//	$data = [
	//		'no'	=>	$no,
	//		'industry_id'	=> $industry_id
	//	];
		
	//	$re = Db::name('no_list')->where($data)->find();
	//	if($re){
	//		$ret['status'] = 'have';
	//	}else{
	//		$data['created_at'] = time();
	//		$r = Db::name('no_list')->insert($data);
	//		if($r){
	//			$ret['status'] = 'success';
	//		}
	//	}
		
	//	return json($ret);
	//}
	
	//抖音号编辑
	//public function noEdit(){
	//	$no_id = input('no_id',0);
		
	//	$list = Db::name('industry_list')->select();
	//	$this->assign('list',$list);
		
	//	$where = [
	//		'no_id'	=>	$no_id
	//	];
		
	//	$item = Db::name('no_list')->where($where)->find();
	//	$this->assign('no',$item);
		
	//	return $this->fetch('no_edit');
	//}
	
	//抖音号编辑确认
	// public function noEditSubmit(){
	// 	$no_id = input('no_id',0);
	// 	$industry_id = input('industry_id');
	// 	$no = input('no');
		
	// 	$ret = [
	// 		'status'	=>	'error'
	// 	];
		
	// 	if(empty($no) || empty($industry_id)){
	// 		return json($ret);
	// 	}
		
	// 	$data = [
	// 		'industry_id'	=>	$industry_id,
	// 		'no'	=>	$no,
	// 		'updated_at' 	=>	time()
	// 	];
	// 	$r = Db::name('no_list')->where(['no_id'=>$no_id])->update($data);
	// 	if($r){
	// 		$ret['status'] = 'success';
	// 	}
		
	// 	return json($ret);
	// }
	
	// //抖音号删除操作
	// public function noDel(){
	// 	$no_id = input('no_id',0);
		
	// 	$ret = [
	// 		'status'	=>	'error'
	// 	];
		
	// 	$r = Db::name('no_list')->where(['no_id'=>$no_id])->delete();
	// 	if($r){
	// 		//重置设备绑定
	// 		$data = [
	// 			'device_volume'	=>	0,
	// 			'is_on'	=>	0,
	// 			'no_id'	=>	0,
	// 			'is_follow'	=>	0,
	// 			'follow_probability'	=>	0,
	// 			'is_pl'	=>	0,
	// 			'pl_probability'	=>	0,
	// 			'is_private'	=>	0,
	// 			'private_probability'	=>	0,
	// 			'is_get_number'	=>	0,
	// 			'updated_at'	=>	time()
	// 		];
	// 		Db::name('device_list')->where(['no_id'=>$no_id])->update($data);
			
	// 		Db::name('no_history_list')->where(['no_id'=>$no_id])->delete();
	// 		Db::name('v_list')->where(['no_id'=>$no_id])->delete();
	// 		$ret['status'] = 'success';
	// 	}
		
	// 	return json($ret);
	// }
	
	
	/*
	* 设备
	*/
	
	
	
	
	//设备删除操作
	// public function deviceDel(){
	// 	$device_id = input('device_id',0);
		
	// 	$ret = [
	// 		'status'	=>	'error'
	// 	];
		
	// 	$r = Db::name('device_list')->where(['device_id'=>$device_id])->delete();
	// 	if($r){
	// 		$ret['status'] = 'success';
	// 	}
		
	// 	return json($ret);
	// }
	
	//设备开关设置
	public function setSwitch(){
		$device_id = input('device_id',0);
		$v = input('v',0);

		$data = [];

		$r = Db::name('device_list')->where('device_id',$device_id)->find();
		if($r){
			switch($v){
				case 1:
					$data['is_follow'] = $r['is_follow']==0?1:0;
					break;
				case 2:
					$data['is_pl'] = $r['is_pl']==0?1:0;
					break;
				case 3:
					$data['is_private'] = $r['is_private']==0?1:0;
					break;
				case 4:
					$data['is_get_number'] = $r['is_get_number']==0?1:0;
					break;
				case 5:
					$data['is_on'] = $r['is_on']==0?1:0;
					break;
			}
		}


		$ret = Db::name('device_list')->where('device_id',$device_id)->update($data);
		if($ret){
			$re = Db::name('device_list')->where('device_id',$device_id)->find();
			if($re){
				$ret['status'] = 'success';
				switch($v){
					case 1:
						$ret['msg'] = $r['is_follow'];
						break;
					case 2:
						$ret['msg'] = $r['is_pl'];
						break;
					case 3:
						$ret['msg'] = $r['is_private'];
						break;
					case 4:
						$ret['msg'] = $r['is_get_number'];
						break;
					case 5:
						$ret['msg'] = $r['is_on'];
						break;
				}
			}
		}
		return json($ret);
	}
	
	//设备概率设置
	// public function setProb(){
	// 	$device_id = input('device_id',0);
	// 	$sta = input('sta');
	// 	$v = (int)input('v',0);

	// 	if(empty($sta)){
	// 		return json($ret);
	// 	}

	// 	$d = Db::name('device_list')->where(['device_id'=>$device_id])->find();
	// 	if($d){
	// 		$data = [
	// 			'updated_at'=>time()
	// 		];
	// 		switch($sta){
	// 			case 1:
	// 				$data['follow_probability'] = $v;
	// 				break;
	// 			case 2:
	// 				$data['pl_probability'] = $v;
	// 				break;
	// 			case 3:
	// 				$data['private_probability'] = $v;
	// 				break;
	// 		}

	// 		$r = Db::name('device_list')->where(['device_id'=>$device_id])->update($data);
	// 		if($r){
	// 			$ret['status'] = 'success';
	// 		}
	// 	}

	// 	return json($ret);
	// }
	
	//设备行业绑定与解绑页
	public function industryBind(){
		$device_id = input('device_id',0);
		
		if(!session('admin')){
			$this->redirect('/');
		}
		
		$list = Db::name('industry_list')->select();
		$this->assign('list',$list);
		
		$r = Db::name('device_list')->where('device_id',$device_id)->find();
		$this->assign('r',$r);
		
		return $this->fetch('industry_bind');
	}
	
	//设备行业绑定与解绑确认
	public function industryBindSubmit(){
		$device_id = input('device_id',0);
		$industry_id = input('industry_id',0);
		$ret = [
			'status'	=>	'error'
		];
		
		$where = [
			'device_id'	=>	$device_id
		];
		
		if($industry_id != 0){
			//已经绑定的不能再绑定
			$h = Db::name('device_list')->where('industry_id',$industry_id)->find();
			if($h){
				$ret['status'] = 'have';
			}else{
				$data = [
					'industry_id'			=>	$industry_id,
					'updated_at'	=>	time()
				];
				$r = Db::name('device_list')->where($where)->update($data);
				if($r){
					$ret['status'] = 'success';
				}
			}
		}else{
			$data = [
				'industry_id'		    =>	'',
				'is_on'					=>	0,
				'updated_at'			=>	time()
			];
			$r = Db::name('device_list')->where($where)->update($data);
			if($r){
				$ret['status'] = 'success';
			}
		}
		
		return json($ret);
	}
	
	/*
	* 大V
	*/
	
	
	//大V管理页
	// public function v(){
	// 	if(!session('admin')){
	// 		$this->redirect('/');
	// 	}
		
	// 	return $this->fetch('v');
	// }
	
	// //大V管理数据接口
	// public function vList(){
	// 	$page = input('page',1);
	// 	$limit = input('limit',0);
	// 	$no_id = input('no_id',0);
	// 	$keyword = input('keyword','');
		
	// 	$ret = [
	// 		'code'	=>	0,
	// 		'msg'	=>	"",
	// 		'count'		=>	0,
	// 		'data'		=>	[]
	// 	];
		
	// 	$where = [
	// 		'no_id'		=>	$no_id,
	// 		'v_name'	=>	['like', '%'.$keyword.'%']
	// 	];
		
	// 	//count
	// 	$count = Db::name('v_list')->where($where)->count();
	// 	//list
	// 	$list = Db::name('v_list')->where($where)->order('is_can desc,v_id asc')->limit(($page-1)*$limit.','.$limit)->select();
		
	// 	if($list){
	// 		foreach($list as $k=>$item){
	// 			$list[$k]['created_at'] = !empty($item['created_at'])?date('m-d H:i',$item['created_at']):'';
	// 			$list[$k]['updated_at'] = !empty($item['updated_at'])?date('m-d H:i',$item['updated_at']):'';
	// 		}
	// 		$ret['count'] = $count;
	// 		$ret['data'] = $list;
	// 	}
		
	// 	return json($ret);
	// }
	
	// //大V添加确认
	// public function vAddSubmit(){
	// 	$no_id = input('no_id');
	// 	$v_name = input('v_name');
		
	// 	$ret = [
	// 		'status'	=>	'error'
	// 	];
		
	// 	if(empty($v_name) || empty($no_id)){
	// 		return json($ret);
	// 	}
		
	// 	$data = [
	// 		'no_id'	=> $no_id,
	// 		'v_name'	=>	$v_name
	// 	];
		
	// 	$re = Db::name('v_list')->where($data)->find();
	// 	if($re){
	// 		$ret['status'] = 'have';
	// 	}else{
	// 		$data['created_at'] = time();
	// 		$r = Db::name('v_list')->insert($data);
	// 		if($r){
	// 			$ret['status'] = 'success';
	// 		}
	// 	}
		
	// 	return json($ret);
	// }
	
	// //大V号编辑
	// public function vEdit(){
	// 	$v_id = input('v_id',0);
		
	// 	$list = Db::name('industry_list')->select();
	// 	$this->assign('list',$list);
		
	// 	$where = [
	// 		'v_id'	=>	$v_id
	// 	];
		
	// 	$item = Db::name('v_list')->where($where)->find();
	// 	$this->assign('v',$item);
		
	// 	return $this->fetch('v_edit');
	// }
	
	// //大V号编辑确认
	// public function vEditSubmit(){
	// 	$v_id = input('v_id',0);
	// 	$industry_id = input('industry_id');
	// 	$v_name = input('v_name');
		
	// 	$ret = [
	// 		'status'	=>	'error'
	// 	];
		
	// 	if(empty($v_name) || empty($industry_id)){
	// 		return json($ret);
	// 	}
		
	// 	$data = [
	// 		'industry_id'	=>	$industry_id,
	// 		'v_name'	=>	$v_name,
	// 		'updated_at' 	=>	time()
	// 	];
	// 	$r = Db::name('v_list')->where(['v_id'=>$v_id])->update($data);
	// 	if($r){
	// 		$ret['status'] = 'success';
	// 	}
		
	// 	return json($ret);
	// }
	
	// //大V号删除操作
	// public function vDel(){
	// 	$v_id = input('v_id',0);
		
	// 	$ret = [
	// 		'status'	=>	'error'
	// 	];
		
	// 	$r = Db::name('v_list')->where(['v_id'=>$v_id])->delete();
	// 	if($r){
	// 		$ret['status'] = 'success';
	// 	}
		
	// 	return json($ret);
	// }
	
	//设置评论哪些可用
	// public function setPlCan(){
	// 	$id = input('id',0);
		
	// 	$ret = [
	// 		'status'	=>	'error'
	// 	];

	// 	$data = [];

	// 	$r = Db::name('pl_list')->where('pl_id',$id)->find();
	// 	if($r){
	// 		$data['is_can'] = $r['is_can']==0?1:0;
	// 	}

	// 	$s = Db::name('pl_list')->where('pl_id',$id)->update($data);
	// 	if($s){
	// 		$re = Db::name('pl_list')->where('pl_id',$id)->find();
	// 		if($re){
	// 			$ret['status'] = 'success';
	// 			$ret['msg'] = $re['is_can'];
	// 		}
	// 	}
	// 	return json($ret);
	// }
	
	// //设置私信哪些可用
	// public function setPrivCan(){
	// 	$id = input('id',0);
		
	// 	$ret = [
	// 		'status'	=>	'error'
	// 	];

	// 	$data = [];

	// 	$r = Db::name('priv_list')->where('priv_id',$id)->find();
	// 	if($r){
	// 		$data['is_can'] = $r['is_can']==0?1:0;
	// 	}

	// 	$s = Db::name('priv_list')->where('priv_id',$id)->update($data);
	// 	if($s){
	// 		$re = Db::name('priv_list')->where('priv_id',$id)->find();
	// 		if($re){
	// 			$ret['status'] = 'success';
	// 			$ret['msg'] = $re['is_can'];
	// 		}
	// 	}
	// 	return json($ret);
	// }
	
	
	//设置大V粉丝表直接关注
	// public function setVF(){
	// 	$id = input('id',0);
		
	// 	$ret = [
	// 		'status'	=>	'error'
	// 	];

	// 	$data = [];

	// 	$r = Db::name('v_list')->where('v_id',$id)->find();
	// 	if($r){
	// 		$data['is_ff'] = $r['is_ff']==0?1:0;
	// 	}

	// 	$s = Db::name('v_list')->where('v_id',$id)->update($data);
	// 	if($s){
	// 		$re = Db::name('v_list')->where('v_id',$id)->find();
	// 		if($re){
	// 			$ret['status'] = 'success';
	// 			$ret['msg'] = $re['is_ff'];
	// 		}
	// 	}
	// 	return json($ret);
	// }
	
	// //设置启用大V
	// public function setVCan(){
	// 	$id = input('id',0);
		
	// 	$ret = [
	// 		'status'	=>	'error'
	// 	];

	// 	$data = [];

	// 	$r = Db::name('v_list')->where('v_id',$id)->find();
	// 	if($r){
	// 		//设置所有不指定
	// 		$where = [
	// 			'is_can'	=>	1,
	// 			'v_id'		=>	['<>',$id],
	// 			'no_id'		=>	$r['no_id']
	// 		];
	// 		$s = Db::name('v_list')->where($where)->update(['is_can'=>0]);
			
	// 		$data['is_can'] = $r['is_can']==0?1:0;
	// 	}

	// 	$s = Db::name('v_list')->where('v_id',$id)->update($data);
	// 	if($s){
	// 		$re = Db::name('v_list')->where('v_id',$id)->find();
	// 		if($re){
	// 			$ret['status'] = 'success';
	// 			$ret['msg'] = $re['is_can'];
	// 		}
	// 	}
	// 	return json($ret);
	// }
	
	// //大V采集状态重置
	// public function initStatus(){
	// 	$no_id = input('no_id',0);
		
	// 	$ret = [
	// 		'status'	=>	'error'
	// 	];

	// 	$where = [
	// 		'no_id'	=>	$no_id,
	// 		'is_readed'	=>	1
	// 	];

	// 	$r = Db::name('v_list')->where($where)->update(['is_readed'=>0]);
	// 	if($r){
	// 		$ret['status'] = 'success';
	// 	}
	// 	return json($ret);
	// }
	
	//历史记录管理页
	public function history(){
		$v_no = input('v_no',0);
		if(!session('admin')){
			$this->redirect('/');
		}
		$list = Db::name('history_list_'.$v_no)->select();
		$this->assign('list',$list);
		$this->assign('v_no',$v_no);
		
		return $this->fetch('history');
	}
	
	//历史记录管理接口
	public function historyList(){
		$page = input('page',1);
		$limit = input('limit',0);
		$v_no = input('v_no',0);
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		
		//count
		$count = Db::name('history_list_'.$v_no)->count();
		//list
		$list = Db::name('history_list_'.$v_no)
		    ->limit(($page-1)*$limit.','.$limit)
		    ->select();
		
		if($list){
			foreach($list as $k=>$item){
				$list[$k]['created_at'] = !empty($item['created_at'])?date('Y-m-d H:i:s',$item['created_at']):'';
				$list[$k]['updated_at'] = !empty($item['updated_at'])?date('Y-m-d H:i:s',$item['updated_at']):'';
			}
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		
		return json($ret);
	}
	
	//位置管理页
	public function position(){
		if(!session('admin')){
			$this->redirect('/');
		}
		$list = Db::name('device_list')->select();
		$this->assign('list',$list);
		return $this->fetch();
	}
	
	//位置添加确认
	public function poAddSubmit(){
		$lng = input('lng',0);
		$lat = input('lat',0);
		$device_id = input('device_id',0);
		$ret = [
			'status'	=>	'error'
		];
		
		if(empty($lng) || empty($lat) || empty($device_id)){
			return json($ret);
		}
		$data = [
			'lng'	=>	$lng,
			'lat'	=> $lat,
			'device_id' => $device_id
		];
		$re = Db::name('pos_list')->where($data)->find();
		if($re){
			$ret['status'] = 'have';
		}else{
			$data['created_at'] = time();
			$r = Db::name('pos_list')->insert($data);
			if($r){
				$ret['status'] = 'success';
			}
		}
		return json($ret);
		
	}
	
	//位置列表
	public function posList(){
		$page = input('page',1);
		$limit = input('limit',0);
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		
		$count = Db::name('pos_list')->count();
		//list
		$list = Db::name('pos_list')
			->alias('d')
			->field('d.*,device_no')
			->join('dy_device_list i','i.device_id = d.device_id','INNER')
			->limit(($page-1)*$limit.','.$limit)
			->select();
		
		if($list){
			foreach($list as $k=>$item){
				$list[$k]['created_at'] = !empty($item['created_at'])?date('Y-m-d H:i:s',$item['created_at']):'';
				$list[$k]['updated_at'] = !empty($item['updated_at'])?date('Y-m-d H:i:s',$item['updated_at']):'';
			}
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		
		return json($ret);
	}
	//删除位置
	public function posDel(){
		$pos_id = input('pos_id',0);
		
		$ret = [
			'status'	=>	'error'
		];
		
		$r = Db::name('pos_list')->where(['pos_id'=>$pos_id])->delete();
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	

}

