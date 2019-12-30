<?php
namespace app\admin\controller;
use think\Db;

class User extends \think\Controller

{
	//管理后台登录
	public function login(){
		if(session('admin')){
			$this->redirect('/main');
		}
		return $this->fetch('login');
	}
	
	//登录操作
	public function toLogin(){
		$account = input('account','');
		$password = input('password','');
		$ret = [
			'status'	=>	'error'
		];
		
		$where = [
			'user_code'	=>	$account,
			'password'	=>	md5($password),
			'is_use'    =>  1
		];
		
		$ar = Db::name('user')->where($where)->find();
		if($ar){
			session('admin',$ar['user_code']);
			
			$ret['status']	=	'success';
			$ret['msg']	=	$ar;
		}
		$data = [
			'login_date' 	=>	date('Y-m-d H:i:s',time())
		];
		$r = Db::name('user')->where($where)->update($data);
		return json($ret);
	}
	
	//欢迎页
	public function welcome(){
		if(!session('admin')){
			$this->redirect('/main');
		}
		return $this->fetch('welcome');
	}
	
	//后台首页
	public function main(){
		if(!session('admin')){
			$this->redirect('/main');
		}
		return $this->fetch('main');
	}
	
	//修改密码
	public function modpass(){
		return $this->fetch('modpass');
	}
	
	public function modpassword(){
		$oldpass = input('oldpass','');
		$newpass = input('newpass','');
		$repass = input('repass','');
		
		$ret = [
			'status'	=>	'error'
		];
		
		if(!session('admin')){
			return json($ret);
		}
		
		$where = [
			'admin_password'	=>	md5($oldpass)
		];
		
		$ar = Db::name('admin_list')->where($where)->find();
		if($ar){
			//修改密码
			if($newpass == $repass && mb_strlen($newpass) >= 5 && mb_strlen($newpass) <= 12){
				$data = [
					'admin_password'	=>	md5($newpass)
				];
				$r = Db::name('admin_list')->where(['admin_id'=>$ar['admin_id']])->update($data);
				if($r){
					$ret['status']	=	'success';
				}
			}
		}else{
			$ret['status'] = 'olderror';
		}
		
		return json($ret);
	}
	
	//退出登录
	public function esc(){
		session('admin',null);
		$this->redirect('/admin');
	}
	
	//字体图标
	public function unicode(){
		return $this->fetch('unicode');
	}
	
	public function user(){
		return $this->fetch();
	}
	
	//管理员管理数据接口
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
		$count = Db::name('user')->where($where)->count();
		//list
		$sql = 'select * from user limit '.($page-1)*$limit.','.$limit;
		$list = Db::query($sql);
		if($list){
			$ret['count'] = $count;
			$ret['data'] = $list;
		}
		
		return json($ret);
	}
	public function setUser(){
		$id = input('id',0);
			
			$ret = [
				'status'	=>	'error'
			];
		
			$data = [];
		
			$r = Db::name('user')->where('user_id',$id)->find();
			if($r){
				$data['is_use'] = $r['is_use']==0?1:0;
			}
		
			$s = Db::name('user')->where('user_id',$id)->update($data);
			if($s){
				$re = Db::name('user')->where('user_id',$id)->find();
				if($re){
					$ret['status'] = 'success';
					$ret['msg'] = $re['is_use'];
				}
			}
			return json($ret);
	}
	public function userAdd(){
		return $this->fetch();
	}
	
	public function userAddSubmit(){
		$user_name = input('user_name',0);
		$user_code = input('user_code',0);
		$password = input('password',0);
		$is_use = input('is_use',0);
		$remark = input('remark',0);
		$is_use = $is_use=='on'?1:0;
		$ret = [
			'status'	=>	'error'
		];
		if(empty($user_name) || empty($user_code) || empty($password)){
			return json($ret);
		}
		
		$data = [
			'user_name'	=>	$user_name,
			'user_code'	=> $user_code
		];
		
		$re = Db::name('user')->where($data)->find();
		if($re){
			$ret['status'] = 'have';
		}else{
			$data['create_time'] = date('Y-m-d H:i:s',time());
			$data['password'] = md5($password);
			$data['token'] = $this->uuid();
			$data['is_use'] = $is_use;
			$data['remark'] = $remark;
			$r = Db::name('user')->insert($data);
			if($r){
				$ret['status'] = 'success';
			}
		}
		
		return json($ret);
	}
	
	//用户删除操作
	public function userDel(){
		$user_id = input('user_id',0);
		
		$ret = [
			'status'	=>	'error'
		];
		
		$r = Db::name('user')->where(['user_id'=>$user_id])->delete();
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	
	//用户编辑
	public function userEdit(){
		$user_id = input('user_id',0);
		$list = Db::name('user')->select(); 	
		$this->assign('list',$list);
		
		$where = [
			'user_id'	=>	$user_id
		];
		
		$item = Db::name('user')->where($where)->find();
		$this->assign('user',$item);
		
		return $this->fetch();
	}
	
	public function userEditSubmit(){
		$user_id = input('user_id',0);
		$user_name = input('user_name');
		$user_code = input('user_code');
		$remark = input('remark');
		
		$ret = [
			'status'	=>	'error'
		];
		
		if(empty($user_name) || empty($user_code)){
			return json($ret);
		}
		
		$data = [
			'user_name'	=>	$user_name,
			'user_code'	=>	$user_code,
			'remark'	=>	$remark
		];
		$r = Db::name('user')->where(['user_id'=>$user_id])->update($data);
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	
	public function userEditReset(){
		$user_id = input('user_id',0);
		$password = md5('123456');
		
		$data = [
			'password'	=>	$password
		];
		$r = Db::name('user')->where(['user_id'=>$user_id])->update($data);
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
}

