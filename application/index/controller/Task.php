<?php
namespace app\index\controller;
use think\Db;

class Task extends \think\Controller

{
	//任务管理页
	public function task(){
		return $this->fetch();
	}
	
	//任务管理数据接口
	public function taskList(){
		$page = input('page',1);
		$limit = input('limit',0);
		
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		
		//count
		$count = Db::name('bus_task')->count();
		//list
		$sql = 'select a.*,b.type_name as platform_name,c.type_name as sex,d.customer_code from bus_task a inner join sys_type b on a.platform_id = b.type_id and b.group_id = 10 inner join sys_type c on a.sex_id = c.type_id and c.group_id = 13 inner join bf_customer d on a.customer_id = d.customer_id order by task_id desc limit '.($page-1)*$limit.','.$limit;
		$list = Db::query($sql);
		if($list){
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		
		return json($ret);
	}
	
	//任务管理刷视频开关设置
	public function setBrowse(){
		$id = input('id',0);
		$ret = [
			'status'	=>	'error'
		];
			
		$data = [];
			
		$r = Db::name('bus_task')->where('task_id',$id)->find();
		if($r){
			$data['is_browse'] = $r['is_browse']==0?1:0;
		}
			
		$s = Db::name('bus_task')->where('task_id',$id)->update($data);
		if($s){
			$re = Db::name('bus_task')->where('task_id',$id)->find();
			if($re){
				$ret['status'] = 'success';
				$ret['msg'] = $re['is_use'];
			}
		}
		return json($ret);
	}
	
	//任务管理关注互粉开关设置
	public function setFollow(){
		$id = input('id',0);
		$ret = [
			'status'	=>	'error'
		];
			
		$data = [];
			
		$r = Db::name('bus_task')->where('task_id',$id)->find();
		if($r){
			$data['is_follow'] = $r['is_follow']==0?1:0;
		}
			
		$s = Db::name('bus_task')->where('task_id',$id)->update($data);
		if($s){
			$re = Db::name('bus_task')->where('task_id',$id)->find();
			if($re){
				$ret['status'] = 'success';
				$ret['msg'] = $re['is_use'];
			}
		}
		return json($ret);
	}
	
	//任务管理评论开关设置
	public function setComment(){
		$id = input('id',0);
		$ret = [
			'status'	=>	'error'
		];
			
		$data = [];
			
		$r = Db::name('bus_task')->where('task_id',$id)->find();
		if($r){
			$data['is_comment'] = $r['is_comment']==0?1:0;
		}
			
		$s = Db::name('bus_task')->where('task_id',$id)->update($data);
		if($s){
			$re = Db::name('bus_task')->where('task_id',$id)->find();
			if($re){
				$ret['status'] = 'success';
				$ret['msg'] = $re['is_use'];
			}
		}
		return json($ret);
	}
	
	//任务管理私信开关设置
	public function setSend(){
		$id = input('id',0);
		$ret = [
			'status'	=>	'error'
		];
			
		$data = [];
			
		$r = Db::name('bus_task')->where('task_id',$id)->find();
		if($r){
			$data['is_send'] = $r['is_send']==0?1:0;
		}
			
		$s = Db::name('bus_task')->where('task_id',$id)->update($data);
		if($s){
			$re = Db::name('bus_task')->where('task_id',$id)->find();
			if($re){
				$ret['status'] = 'success';
				$ret['msg'] = $re['is_use'];
			}
		}
		return json($ret);
	}
	
	//任务管理状态设置
	public function setTask(){
		$id = input('id',0);
		$ret = [
			'status'	=>	'error'
		];
			
		$data = [];
			
		$r = Db::name('bus_task')->where('task_id',$id)->find();
		if($r){
			$data['is_use'] = $r['is_use']==0?1:0;
		}
			
		$s = Db::name('bus_task')->where('task_id',$id)->update($data);
		if($s){
			$re = Db::name('bus_task')->where('task_id',$id)->find();
			if($re){
				$ret['status'] = 'success';
				$ret['msg'] = $re['is_use'];
			}
		}
		return json($ret);
	}
	
	//任务添加
	public function taskAdd(){
		$platform = type('platform_id','platform_name');
		$sex = type('sex_id','sex');
		$customer = customer();
		
		return $this->fetch('',['platform' => $platform,'sex' => $sex,'customer' => $customer]);
	}
	
	//任务添加确认
	public function taskAddSubmit(){
		$task_name = input('task_name');
		$customer_id = input('customer_id',0);
		$platform_id = input('platform_id',0);
		$sex_id = input('sex_id',0);
		$is_use = input('is_use');
		$describe = input('describe');
		$remark = input('remark');
		$is_use = $is_use=='on'?1:0;
		$ret = [
			'status'	=>	'error'
		];
		if(empty($task_name) || empty($customer_id) || empty($platform_id) || empty($sex_id) || empty($describe)){
			return json($ret);
		}
		
		$data = [
			'task_name'	=>	$task_name
		];
		
		$re = Db::name('bus_task')->where($data)->find();
		if($re){
			$ret['status'] = 'have';
		}else{
			$data['customer_id'] = $customer_id;
			$data['platform_id'] = $platform_id;
			$data['sex_id'] = $sex_id;
			$data['is_use'] = $is_use;
			$data['describe'] = $describe;
			$data['remark'] = $remark;
			$r = Db::name('bus_task')->insert($data);
			if($r){
				$ret['status'] = 'success';
			}
		}
		
		return json($ret);
	}
	
	//任务编辑
	public function taskEdit(){
		$task_id = input('task_id',0);
		$platform = type('platform_id','platform_name');
		$sex = type('sex_id','sex');
		$customer = customer();
		$where = [
			'task_id'	=>	$task_id
		];
		
		$item = Db::name('bus_task')
		->alias('a')->field('a.*,b.type_name as platform_name,c.type_name as sex,d.customer_code')
		->join('sys_type b','a.platform_id=b.type_id and b.group_id = 10','INNER')
		->join('sys_type c','a.sex_id=c.type_id and  c.group_id = 13','INNER')
		->join('bf_customer d','a.customer_id=d.customer_id','INNER')
		->where($where)->find();
		
		return $this->fetch('',['platform' => $platform,'sex' => $sex,'customer' => $customer,'task'=> $item]);
	}
	
	//任务编辑确认
	public function taskEditSubmit(){
		$task_id = input('task_id',0);
		$task_name = input('task_name');
		$customer_id = input('customer_id',0);
		$platform_id = input('platform_id',0);
		$sex_id = input('sex_id',0);
		$describe = input('describe');
		$remark = input('remark');
		$ret = [
			'status'	=>	'error'
		];
		
		if(empty($task_name) || empty($customer_id) || empty($platform_id) || empty($sex_id) || empty($describe)){
			return json($ret);
		}
		
		$data = [
			'task_name'		=>	$task_name,
			'customer_id'		=>	$customer_id,
			'platform_id'	=>	$platform_id,
			'sex_id'		=>	$sex_id,
			'describe'	=>	$describe,
			'remark'		=>	$remark,
		];
		$r = Db::name('bus_task')->where(['task_id'=>$task_id])->update($data);
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	
	//任务账号绑定页
	public function taskBind(){
		$task_id = input('task_id',0);
		$sql = 'select account_id,account_code from bus_account where is_use = 1 and task_id IS NULL';
		$account = Db::query($sql);
		$this->assign('account',$account);
		$this->assign('task_id',$task_id);
		return $this->fetch('',['account' => $account]);
	}
	
	//设备行业绑定确认
	public function taskBindSubmit(){
		$task_id = input('task_id',null);
		$account_id = implode(',',json_decode(input('account_id',null),true));
		if($account_id && $task_id){
			$account = Db::name('bus_account')->where('account_id','in',$account_id)->update(array('task_id'=>$task_id));
			if($account){
				$ret['status'] = 'success';
			}else{
				$ret['status'] = 'error';
			}
		}else{
			$ret['status'] = 'error';
		}
		return json($ret);
	}
	/**
	 * 设备任务日志
	 */
	public function taskLog(){
		$task_id = input('task_id',null);
		$this->assign('task_id',$task_id);
		return $this->fetch();
	}
	/**
	 * 任务日志数据接口
	 */
	public function taskLogList(){
		$page = input('page',1);
		$limit = input('limit',0);
		$task_id = input('task_id',null);
		//count
		$count = Db::name('bus_task_log')->where('task_id',$task_id)->count();
		//list
		$sql = "SELECT a.*,b.task_name FROM bus_task_log a LEFT JOIN bus_task b ON a.task_id = b.task_id WHERE a.task_id = $task_id ORDER BY a.task_log_id DESC LIMIT ".($page-1)*$limit.",".$limit;	
		if($list){
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		return json($ret);
	}	
	
	//大号管理页
	public function taskKol(){
		return $this->fetch();
	}
	
	//大号管理数据接口
	public function taskKolList(){
		$page = input('page',1);
		$limit = input('limit',0);
		$ret = [
			'code'	=>	0,
			'msg'	=>	"",
			'count'		=>	0,
			'data'		=>	[]
		];
		//count
		$count = Db::name('bus_task_kol')->count();
		//list
		$sql = 'select a.*,b.task_name from bus_task_kol a inner join bus_task b on a.task_id = b.task_id order by task_kol_id desc limit '.($page-1)*$limit.','.$limit;
		$list = Db::query($sql);
		if($list){
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		return json($ret);
	}
	
	//大号添加
	public function taskKolAdd(){
		$task = task();
		
		return $this->fetch('',['task' => $task]);
	}
	
	//任务添加确认
	public function taskKolAddSubmit(){
		$task_id = input('task_id',0);
		$third_party_id = input('third_party_id');
		$nickname = input('nickname');
		$ret = [
			'status'	=>	'error'
		];
		if(empty($task_id) || empty($third_party_id) || empty($nickname)){
			return json($ret);
		}
		
		$data = [
			'nickname'	=>	$nickname
		];
		
		$re = Db::name('bus_task_kol')->where($data)->find();
		if($re){
			$ret['status'] = 'have';
		}else{
			$data['task_id'] = $task_id;
			$data['third_party_id'] = $third_party_id;
			$data['create_time'] = date('Y-m-d H:i:s',time());
			$r = Db::name('bus_task_kol')->insert($data);
			if($r){
				$ret['status'] = 'success';
			}
		}
		
		return json($ret);
	}
	
	//大号编辑
	public function taskKolEdit(){
		$task_kol_id = input('task_kol_id',0);
		$task = task();
		$where = [
			'task_kol_id'	=>	$task_kol_id
		];
		
		$item = Db::name('bus_task_kol')
		->alias('a')->field('a.*,b.task_name')
		->join('bus_task b','a.task_id=b.task_id','INNER')
		->where($where)->find();
		
		return $this->fetch('',['task' => $task,'task_kol' => $item]);
	}
	
	//大号编辑确认
	public function taskKolEditSubmit(){
		$task_kol_id = input('task_kol_id',0);
		$task_id = input('task_id',0);
		$third_party_id = input('third_party_id');
		$nickname = input('nickname');
		$ret = [
			'nickname'	=>	'error'
		];
		
		if(empty($task_id) || empty($third_party_id) || empty($nickname)){
			return json($ret);
		}
		
		$data = [
			'task_id'		=>	$task_id,
			'third_party_id'		=>	$third_party_id,
			'nickname'	=>	$nickname
		];
		$r = Db::name('bus_task_kol')->where(['task_col_id'=>$task_col_id])->update($data);
		if($r){
			$ret['status'] = 'success';
		}
		return json($ret);
	}
}