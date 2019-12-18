<?php
namespace app\index\controller;
use think\Db;

class Basics extends \think\Controller

{
	//选项分组管理页
	public function group(){
		return $this->fetch();
	}
	
	//选项分组管理数据接口
	public function groupList(){
		$page = input('page',1);
		$limit = input('limit',0);
		
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		
		//count
		$count = Db::name('sys_group')->count();
		//list
		$sql = 'select * from sys_group limit '.($page-1)*$limit.','.$limit;
		$list = Db::query($sql);
		if($list){
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		
		return json($ret);
	}
	
	//选项分组状态设置
	public function setGroup(){
		$id = input('id',0);
		$ret = [
			'status'	=>	'error'
		];
	
		$data = [];
	
		$r = Db::name('sys_group')->where('group_id',$id)->find();
		if($r){
			$data['is_use'] = $r['is_use']==0?1:0;
		}
	
		$s = Db::name('sys_group')->where('group_id',$id)->update($data);
		if($s){
			$re = Db::name('sys_group')->where('group_id',$id)->find();
			if($re){
				$ret['status'] = 'success';
				$ret['msg'] = $re['is_use'];
			}
		}
		return json($ret);
	}
	
	//选项分组可编辑设置
	public function setOption(){
		$id = input('id',0);
			
		$ret = [
			'status'	=>	'error'
		];
	
		$data = [];
	
		$r = Db::name('sys_group')->where('group_id',$id)->find();
		if($r){
			$data['option_edit'] = $r['option_edit']==0?1:0;
		}
	
		$s = Db::name('sys_group')->where('group_id',$id)->update($data);
		if($s){
			$re = Db::name('sys_group')->where('group_id',$id)->find();
			if($re){
				$ret['status'] = 'success';
				$ret['msg'] = $re['is_use'];
			}
		}
		return json($ret);
	}
	
	//选项分组添加
	public function groupAdd(){
		return $this->fetch();
	}
	
	//选项分组添加确认
	public function groupAddSubmit(){
		$group_name = input('group_name',0);
		$column_name = input('column_name',0);
		$option_edit = input('option_edit',0);
		$is_use = input('is_use',0);
		$remark = input('remark',0);
		$is_use = $is_use=='on'?1:0;
		$option_edit = $option_edit=='on'?1:0;
		$ret = [
			'status'	=>	'error'
		];
		if(empty($group_name) || empty($column_name)){
			return json($ret);
		}
		
		$data = [
			'group_name'	=>	$group_name,
			'column_name'	=> $column_name
		];
		
		$re = Db::name('sys_group')->where($data)->find();
		if($re){
			$ret['status'] = 'have';
		}else{
			$data['option_edit'] = $option_edit;
			$data['is_use'] = $is_use;
			$data['remark'] = $remark;
			$r = Db::name('sys_group')->insert($data);
			if($r){
				$ret['status'] = 'success';
			}
		}
		
		return json($ret);
	}
	
	//选项分组编辑
	public function groupEdit(){
		$group_id = input('group_id',0);
		$list = Db::name('sys_user')->select(); 	
		
		$where = [
			'group_id'	=>	$group_id
		];
		
		$group = Db::name('sys_group')->where($where)->find();
		
		return $this->fetch('',['list' => $list,'group' => $group]);
	}
	
	//选项分组编辑确认
	public function groupEditSubmit(){
		$group_id = input('group_id',0);
		$group_name = input('group_name');
		$column_name = input('column_name');
		$remark = input('remark');
		
		$ret = [
			'status'	=>	'error'
		];
		
		if(empty($group_name) || empty($column_name)){
			return json($ret);
		}
		
		$data = [
			'group_name'	=>	$group_name,
			'column_name'	=>	$column_name,
			'remark'	=>	$remark
		];
		$r = Db::name('sys_group')->where(['group_id'=>$group_id])->update($data);
		// if($r){
			$ret['status'] = 'success';
		// }
		
		return json($ret);
	}
	
	//选项编辑管理页
	public function Type(){
		return $this->fetch();
	}
	
	//选项编辑管理数据接口
	public function typeList(){
		$page = input('page',1);
		$limit = input('limit',0);
		
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		
		//count
		$count = Db::name('sys_type')->count();
		//list
		$sql = 'select a.*,b.group_id,b.group_name from sys_type a inner join sys_group b on a.group_id = b.group_id limit '.($page-1)*$limit.','.$limit;
		$list = Db::query($sql);
		if($list){
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		
		return json($ret);
	}
	
	//选项编辑状态设置
	public function setTypeUse(){
		$id = input('id',0);
		$ret = [
			'status'	=>	'error'
		];
	
		$data = [];
	
		$r = Db::name('sys_type')->where('type_id',$id)->find();
		if($r){
			$data['is_use'] = $r['is_use']==0?1:0;
		}
	
		$s = Db::name('sys_type')->where('type_id',$id)->update($data);
		if($s){
			$re = Db::name('sys_type')->where('type_id',$id)->find();
			if($re){
				$ret['status'] = 'success';
				$ret['msg'] = $re['is_use'];
			}
		}
		return json($ret);
	}
	
	//选项编辑默认设置
	public function setDefault(){
		$id = input('id',0);
			
		$ret = [
			'status'	=>	'error'
		];
	
		$data = [];
	
		$r = Db::name('sys_type')->where('type_id',$id)->find();
		if($r){
			$data['is_default'] = $r['is_default']==0?1:0;
		}
	
		$s = Db::name('sys_type')->where('type_id',$id)->update($data);
		if($s){
			$re = Db::name('sys_type')->where('type_id',$id)->find();
			if($re){
				$ret['status'] = 'success';
				$ret['msg'] = $re['is_use'];
			}
		}
		return json($ret);
	}
	
	//选项编辑添加
	public function typeAdd(){
		$sql = 'select group_id ,group_name  from sys_group';
		$list = Db::query($sql);
		
		return $this->fetch('',['list' => $list]);
	}
	
	//选项编辑添加确认
	public function typeAddSubmit(){
		$group_id = input('group_id',0);
		$type_name = input('type_name',0);
		$sort_index = input('sort_index',0);
		$help_text = input('help_text',0);
		$is_default = input('is_default',0);
		$is_use = input('is_use',0);
		$remark = input('remark',0);
		$is_use = $is_use=='on'?1:0;
		$is_default = $is_default=='on'?1:0;
		$ret = [
			'status'	=>	'error'
		];
		if(empty($group_id) || empty($type_name) || empty($sort_index)){
			return json($ret);
		}
		
		$data = [
			'group_id'	=>	$group_id,
			'type_name'	=> $type_name
		];
		
		$re = Db::name('sys_type')->where($data)->find();
		if($re){
			$ret['status'] = 'have';
		}else{
			$data['sort_index'] = $sort_index;
			$data['help_text'] = $help_text;
			$data['is_use'] = $is_use;
			$data['is_default'] = $is_default;
			$data['remark'] = $remark;
			$r = Db::name('sys_type')->insert($data);
			if($r){
				$ret['status'] = 'success';
			}
		}
		
		return json($ret);
	}
	
	//选项编辑修改页
	public function typeEdit(){
		$type_id = input('type_id',0);
		$sql = 'select group_id ,group_name  from sys_group';
		$list = Db::query($sql); 
		
		$where = [
			'type_id'	=>	$type_id
		];
		
		$type = Db::name('sys_type')
		->alias('a')->field('a.*,b.group_name')->join('sys_group b','a.group_id=b.group_id','INNER')
		->where($where)->find();
		$this->assign('type',$type);
		
		return $this->fetch('',['list' => $list,'type' => $type]);
	}
	
	//选项编辑修改确认
	public function typeEditSubmit(){
		$type_id = input('type_id',0);
		$group_id = input('group_id',0);
		$type_name = input('type_name');
		$sort_index = input('sort_index');
		$help_text = input('help_text');
		$remark = input('remark');
		
		$ret = [
			'status'	=>	'error'
		];
		
		$data = [
			'group_id'		=>	$group_id,
			'type_name'		=>	$type_name,
			'sort_index'	=>	$sort_index,
			'help_text'		=>	$help_text,
			'remark'		=>	$remark
		];
		$r = Db::name('sys_type')->where(['type_id'=>$type_id])->update($data);
		// if($r){
			$ret['status'] = 'success';
		// }
		
		return json($ret);
	}
	// public function getWorkBydeviceName(){
	//         if($this->request->isPost()){
	// 			$device_name = input('device_name',0);
	//             if(empty($device_name)){
	//                 $res = [
	//                     'code'  =>  0,
	//                     'msg'   =>  '缺少必要参数'
	//                 ];
	//             }else{
	// 				//进行数据查询
	// 				$sql =  "SELECT c.type_name AS sex_name,b.is_browse,b.is_follow,b.is_send,b.is_comment,d.third_party_id,d.nickname,e.plot_text,f.type_name AS plot_type_name,g.wechat_code,g.nickname AS wechat_name FROM bf_device a INNER JOIN bus_task b ON a.task_id = b.task_id INNER JOIN sys_type c ON b.sex_id = c.type_id AND c.group_id = 13 INNER JOIN bus_task_kol d ON a.task_id = d.task_id INNER JOIN bus_task_plot e ON a.task_id = e.task_id INNER JOIN sys_type f ON e.plot_type_id = f.type_id AND f.group_id = 12 INNER JOIN bus_task_wechat g ON a.task_id = g.task_id WHERE a.device_name ='$device_name'";
	// 				$data = Db::query($sql);
	// 				if($data){
	// 					$res = [
	// 						'code'  =>  200,
	// 						'data'  =>  $data,
	// 						'msg'   =>  '获取成功'
	// 					];
	// 				}else{
	// 					$res = [
	// 						'code'  =>  0,
	// 						'msg'   =>  '暂无数据'
	// 					];
	// 				}
	//             }           
	//         }else{
	//             $res = [
	//                 'code'  =>  0,
	//                 'msg'   =>  '请求方式错误'
	//             ];
	//         }
	//         return json($res);
	//     }
	
	//平台账号管理页
	public function account(){
		return $this->fetch();
	}
	
	//平台账号管理数据接口
	public function accountList(){
		$page = input('page',1);
		$limit = input('limit',0);
		
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		
		//count
		$count = Db::name('bus_account')->count();
		//list
		$sql = 'select a.account_id,a.account_code,a.password,a.remark,a.is_use,b.task_name,c.type_name as app_name from bus_account a left join bus_task b on a.task_id = b.task_id inner join sys_type c on a.app_id = c.type_id and c.group_id = 15 order by account_id desc limit '.($page-1)*$limit.','.$limit;
		$list = Db::query($sql);
		if($list){
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		
		return json($ret);
	}
	
	//平台账号添加
	public function accountAdd(){
		// if(!session('admin')){
		// 	$this->redirect('/');
		// }
		$list = type('app_id','app_name');
		
		return $this->fetch('',['list' => $list]);
	}
	
	//平台账号添加确认
	public function accountAddSubmit(){
		$app_id = input('app_id',0);
		$account_code = input('account_code');
		$password = input('password');
		$remark = input('remark');
		$ret = [
			'status'	=>	'error'
		];
		if($account_code && $app_id && $password){
			$url = REALMNAME . "/kol/new/api/addAccount";
			$data = [
				'account_code'	=>	$account_code,
				'password'	=>	$password,
				'app_id'	=>	$app_id,
			];
			$res = http_request($url,$data);
			$result = json_decode($res,true);
			if($result['code']==200 && !isset($result['msg']['error'])){
				$ret['status'] = 'success';
			}
		}
		return json($ret);
	}
	
	//重置手机参数
	public function sidReset(){
		$account_id = input('account_id');
		$ret = [
			'status' =>	'error'
		];
		if($account_id){
			$url = REALMNAME . "/kol/new/api/updateAccount";
			$data = [
				'account_id'	=>	$account_id,
			];
			$res = http_request($url,$data);
			$result = json_decode($res,true);
			if($result['code']==200 && !isset($result['msg']['error'])){
				$ret['status'] = 'success';
			}
		}
		return json($ret);
	}
	
	//平台账号编辑
	public function accountEdit(){
		$account_id = input('account_id',0);
		$list = Db::name('bus_account')->select(); 	
		$this->assign('list',$list);
		$where = [
			'account_id'	=>	$account_id
		];
		
		$item = Db::name('bus_account')->where($where)->find();
		$this->assign('account',$item);
		
		return $this->fetch();
	}
	
	//平台账号编辑确认
	public function accountEditSubmit(){
		$account_id = input('account_id',0);
		$remark = input('remark');
		$ret = [
			'status'	=>	'error'
		];
		
		$data = [
			'remark'	=>	$remark
		];
		$r = Db::name('bus_account')->where(['account_id'=>$account_id])->update($data);
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	
	//平台账号状态设置
	public function setAccount(){
		$id = input('id',0);
		$ret = [
			'status'	=>	'error'
		];
	
		$data = [];
	
		$r = Db::name('bus_account')->where('account_id',$id)->find();
		if($r){
			$data['is_use'] = $r['is_use']==0?1:0;
		}
	
		$s = Db::name('bus_account')->where('account_id',$id)->update($data);
		if($s){
			$re = Db::name('bus_account')->where('account_id',$id)->find();
			if($re){
				$ret['status'] = 'success';
				$ret['msg'] = $re['is_use'];
			}
		}
		return json($ret);
	}
	
	
	
	//设备管理页
	public function device(){
		if(!session('admin')){
			$this->redirect('/');
		}
		
		return $this->fetch();
	}
	
	//设备管理数据接口
	public function deviceList(){
		$page = input('page',1);
		$limit = input('limit',0);
		
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		
		//count
		$count = Db::name('bf_device')->count();
		//list
		$list = Db::name('bf_device')
	        ->alias('a')
	        ->field('A.*,if(b.task_name is NULL,"",b.task_name) as task_name,if(c.nickname is NULL,"",c.nickname) as nickname')
	        ->join('bus_task b','a.task_id = b.task_id','LEFT')
			->join('bus_task_kol c','a.task_kol_id = c.task_kol_id','LEFT')
			->order('device_id desc')
	        ->limit(($page-1)*$limit.','.$limit)
	        ->select();
		
		if($list){
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		
		return json($ret);
	}
	
	//设备管理状态设置
	public function setDevice(){
		$id = input('id',0);
		$ret = [
			'status'	=>	'error'
		];
			
		$data = [];
			
		$r = Db::name('bf_device')->where('device_id',$id)->find();
		if($r){
			$data['is_use'] = $r['is_use']==0?1:0;
		}
			
		$s = Db::name('bf_device')->where('device_id',$id)->update($data);
		if($s){
			$re = Db::name('bf_device')->where('device_id',$id)->find();
			if($re){
				$ret['status'] = 'success';
				$ret['msg'] = $re['is_use'];
			}
		}
		return json($ret);
	}
	
	//设备添加
	public function deviceAdd(){
		$task = task();
		$task_kol = task_kol();
		
		return $this->fetch('',['task' => $task,'task_kol' => $task_kol]);
	}
	
	//设备添加确认
	public function deviceAddSubmit(){
		$device_name = input('device_name');
		$task_id = input('task_id',0);
		$task_kol_id = input('task_kol_id',0);
		$is_use = input('is_use');
		$remark = input('remark');
		$is_use = $is_use=='on'?1:0;
		$ret = [
			'status'	=>	'error'
		];
		if(empty($device_name)){
			return json($ret);
		}
		
		$data = [
			'device_name'	=>	$device_name
		];
		
		$re = Db::name('bf_device')->where($data)->find();
		if($re){
			$ret['status'] = 'have';
		}else{
			$data['task_id'] = !empty($task_id)?$task_id:null;
			$data['task_kol_id'] = !empty($task_kol_id)?$task_kol_id:null;
			$data['create_time'] = date('Y-m-d H:i:s',time());
			$data['is_use'] = $is_use;
			$data['remark'] = $remark;
			$r = Db::name('bf_device')->insert($data);
			if($r){
				$ret['status'] = 'success';
			}
		}
		
		return json($ret);
	}
	
	//设备编辑
	public  function deviceEdit(){
		$device_id = input('device_id',0);
		
		$task = task();
		$task_kol = task_kol();
		
		$where = [
			'device_id'	=>	$device_id
		];
		
		$device = Db::name('bf_device')
		->alias('a')->field('a.*,b.task_id,b.task_name,c.task_kol_id,c.nickname')
		->join('bus_task b','a.task_id=b.task_id and b.is_use = 1','LEFT')
		->join('bus_task_kol c','a.task_kol_id=c.task_kol_id' ,'LEFT')
		->where($where)->find();
		
		return $this->fetch('',['task' => $task,'task_kol' => $task_kol,'device' => $device]);
	}
	
	//设备编辑确认
	public function deviceEditSubmit(){
		$device_id = input('device_id',0);
		$device_name = input('device_name');
		$task_id = input('task_id',0);
		$task_kol_id = input('task_kol_id',0);
		$remark = input('remark');
		$ret = [
			'status'	=>	'error'
		];
		
		if(empty($device_name)){
			return json($ret);
		}
		
		$data = [
			'device_name'		=>	$device_name,
			'task_id'		=>	!empty($task_id)?$task_id:null,
			'task_kol_id'	=>	!empty($task_kol_id)?$task_kol_id:null,
			'remark'		=>	$remark,
		];
		$r = Db::name('bf_device')->where(['device_id'=>$device_id])->update($data);
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	
	//控件管理页
	public function widget(){
		return $this->fetch();
	}
	
	//控件管理数据接口页
	public function widgetList(){
		$page = input('page',1);
		$limit = input('limit',0);
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		
		$count = Db::name('bf_widget')->count();
		//list
		$list = Db::name('bf_widget')
		->alias('a')->field('a.*, b.type_name as app_name')
		->join('sys_type b','a.app_id=b.type_id and b.group_id = 15','INNER')
		->limit(($page-1)*$limit.','.$limit)
		->select();
		
		if($list){
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		
		return json($ret);
		
	}
	
	//控件管理状态设置
	public function setWidget(){
		$id = input('id',0);
		$ret = [
			'status'	=>	'error'
		];
			
		$data = [];
			
		$r = Db::name('bf_widget')->where('id',$id)->find();
		if($r){
			$data['is_use'] = $r['is_use']==0?1:0;
		}
			
		$s = Db::name('bf_widget')->where('id',$id)->update($data);
		if($s){
			$re = Db::name('bf_widget')->where('id',$id)->find();
			if($re){
				$ret['status'] = 'success';
				$ret['msg'] = $re['is_use'];
			}
		}
		return json($ret);
	}
	
	//控件管理添加
	public function widgetAdd(){
		$list = type('app_id','app_name');
		$this->assign('list',$list);
		
		return $this->fetch();
	}
	
	//控件管理添加确认
	public function widgetAddSubmit(){
		$widget_id = input('widget_id');
		$widget_description = input('widget_description');
		$app_id = input('app_id',0);
		$is_use = input('is_use');
		$remark = input('remark');
		$is_use = $is_use=='on'?1:0;
		$ret = [
			'status'	=>	'error'
		];
		if(empty($widget_id) || empty($widget_description) || empty($app_id)){
			return json($ret);
		}
		
		$data = [
			'widget_id'	=>	$widget_id,
			'widget_description'	=>	$widget_description,
			'app_id'	=>	$app_id,
			'is_use'	=>	$is_use,
			'remark'	=>	$remark
			
		];
		
		$r = Db::name('bf_widget')->insert($data);
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	
	//控件编辑页
	public function widgetEdit(){
		$id = input('id',0);
		
		$list = type('app_id','app_name');
		$where = [
			'id'	=>	$id
		];
		
		$widget = Db::name('bf_widget')->where($where)->find();
		
		return $this->fetch('',['list' => $list,'widget' => $widget]);
	}
	
	//控件编辑确认
	public function widgetEditSubmit(){
		$id = input('id',0);
		$widget_id = input('widget_id');
		$widget_description = input('widget_description');
		$app_id = input('app_id',0);
		$remark = input('remark');
		$ret = [
			'status'	=>	'error'
		];
		if(empty($widget_id) || empty($widget_description) || empty($app_id)){
			return json($ret);
		}
		$data = [
			'widget_id'	=>	$widget_id,
			'widget_description' => $widget_description,
			'app_id' => $app_id,
			'remark' => $remark
		];
		$r = Db::name('bf_widget')->where(['id'=>$id])->update($data);
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	
	//客户维护
	public function customer(){
		return $this->fetch();
	}
	
	//客户维护数据接口页
	public function customertList(){
		$page = input('page',1);
		$limit = input('limit',0);
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		
		$count = Db::name('bf_customer')->count();
		//list
		$list = Db::name('bf_customer')
		->alias('a')->field('a.*, b.type_name as trade_name')
		->join('sys_type b','a.trade_id=b.type_id and b.group_id = 11','INNER')
		->limit(($page-1)*$limit.','.$limit)
		->select();
		
		if($list){
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		
		return json($ret);
	}
	
	//控件管理状态设置
	public function setCustomer(){
		$customer_id = input('id',0);
		$ret = [
			'status'	=>	'error'
		];
			
		$data = [];
			
		$r = Db::name('bf_customer')->where('customer_id',$customer_id)->find();
		if($r){
			$data['is_use'] = $r['is_use']==0?1:0;
		}
			
		$s = Db::name('bf_customer')->where('customer_id',$customer_id)->update($data);
		if($s){
			$re = Db::name('bf_customer')->where('customer_id',$customer_id)->find();
			if($re){
				$ret['status'] = 'success';
				$ret['msg'] = $re['is_use'];
			}
		}
		return json($ret);
	}
	
	//添加客户
	public function customerAdd(){
		$trade = type('trade_id','trade_name');
		return $this->fetch('',['trade' => $trade]);
	}
	
	//添加客户确认
	public function customerAddSubmit(){
		$customer_code = input('customer_code');
		$password = input('password');
		$company = input('company');
		$linkman = input('linkman');
		$phone = input('phone');
		$address = input('address');
		$trade_id = input('trade_id',0);
		$is_use = input('is_use',0);
		$remark = input('remark',0);
		$is_use = $is_use=='on'?1:0;
		$ret = [
			'status'	=>	'error'
		];
		if(empty($customer_code) || empty($password) || empty($company)  || empty($trade_id)){
			return json($ret);
		}
		
		// if(!empty($phone)){
		// 	$a = preg_match("/^((13\d|14[5-9]|15[0-3]|15[5-9]|17[0-8]|18\d|19[8-9])\d{8})$/",$phone);
		// 	if(!$a){
		// 		$ret['status'] = 'phone';
		// 	}elae{}
		// }
		
		$data = [
			'customer_code'	=>	$customer_code,
		];
		
		$re = Db::name('bf_customer')->where($data)->find();
		if($re){
			$ret['status'] = 'have';
		}else{
			$data['create_time'] = date('Y-m-d H:i:s',time());
			$data['password'] = md5($password);
			$data['token'] = uuid();
			$data['company'] = $company;
			$data['linkman'] = !empty($linkman)?$linkman:null;
			$data['phone'] = !empty($phone)?$phone:null;
			$data['address'] = !empty($address)?$address:null;
			$data['trade_id'] = $trade_id;
			$data['is_use'] = $is_use;
			$data['remark'] = $remark;
			$r = Db::name('bf_customer')->insert($data);
			if($r){
				$ret['status'] = 'success';
			}
		}
		
		return json($ret);
	}
	/**
	 * 设备任务日志
	 */
	public function accountLog(){
		$account_id = input('account_id',null);
		$this->assign('account_id',$account_id);
		return $this->fetch();
	}
	/**
	 * 任务日志数据接口
	 */
	public function accountLogList(){
		$page = input('page',1);
		$limit = input('limit',0);
		$account_id = input('account_id',null);
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		//count
		$count = Db::name('bus_account_log')->where('account_id',$account_id)->count();
		//list
		$sql = "SELECT a.*,b.account_code,c.task_name FROM bus_account_log a LEFT JOIN bus_account b ON a.account_id = b.account_id LEFT JOIN bus_task c ON c.task_id = a.task_id WHERE a.account_id = $account_id ORDER BY a.account_log_id DESC LIMIT ".($page-1)*$limit.",".$limit;
		$list = Db::query($sql);
		if($list){
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		return json($ret);
	}
}