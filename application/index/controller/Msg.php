<?php
namespace app\index\controller;
use think\Db;

class Msg extends \think\Controller

{
	public function _initialize(){
		if(!session('admin')){
			echo 'no right error';exit;
		}
	}
	
	/*
	* 私信
	*/
	
	
	//私信管理页
	public function priv(){
		if(!session('admin')){
			$this->redirect('/');
		}
		
		$list = Db::name('industry_list')->select();
		$this->assign('list',$list);
		
		return $this->fetch('priv');
	}
	
	//私信管理数据接口
	public function privList(){
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
		$count = Db::name('priv_list')->where($where)->count();
		//list
		$sql = 'select l.*,IFNULL(t.industry_name,"--") as industry_name from dy_priv_list l left join dy_industry_list t on t.industry_id = l.industry_id limit '.($page-1)*$limit.','.$limit;
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
	
	//私信添加确认
	public function privAddSubmit(){
		$priv_content = input('priv_content');
		$industry_id = input('industry_id');
		
		$ret = [
			'status'	=>	'error'
		];
		
		if(empty($priv_content) || empty($industry_id)){
			return json($ret);
		}
		
		$data = [
			'priv_content'	=>	$priv_content,
			'industry_id'	=> $industry_id
		];
		
		$re = Db::name('priv_list')->where($data)->find();
		if($re){
			$ret['status'] = 'have';
		}else{
			$data['created_at'] = time();
			$r = Db::name('priv_list')->insert($data);
			if($r){
				$ret['status'] = 'success';
			}
		}
		
		return json($ret);
	}
	
	//私信编辑
	public function privEdit(){
		$priv_id = input('priv_id',0);
		
		$list = Db::name('industry_list')->select();
		$this->assign('list',$list);
		
		$where = [
			'priv_id'	=>	$priv_id
		];
		
		$item = Db::name('priv_list')->where($where)->find();
		$this->assign('priv',$item);
		
		return $this->fetch('priv_edit');
	}
	
	//私信编辑确认
	public function privEditSubmit(){
		$priv_id = input('priv_id',0);
		$industry_id = input('industry_id');
		$priv_content = input('priv_content');
		
		$ret = [
			'status'	=>	'error'
		];
		
		if(empty($priv_content) || empty($industry_id)){
			return json($ret);
		}
		
		$data = [
			'industry_id'	=>	$industry_id,
			'priv_content'			=>	$priv_content,
			'updated_at' 	=>	time()
		];
		$r = Db::name('priv_list')->where(['priv_id'=>$priv_id])->update($data);
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	
	//私信删除操作
	public function privDel(){
		$priv_id = input('priv_id',0);
		
		$ret = [
			'status'	=>	'error'
		];
		
		$r = Db::name('priv_list')->where(['priv_id'=>$priv_id])->delete();
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	
	/*
	* 评论
	*/
	
	
	//评论管理页
	public function pl(){
		if(!session('admin')){
			$this->redirect('/');
		}
		
		$list = Db::name('industry_list')->select();
		$this->assign('list',$list);
		
		return $this->fetch('pl');
	}
	
	//评论管理数据接口
	public function plList(){
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
		$count = Db::name('comment_list')->where($where)->count();
		//list
		$sql = 'select l.*,IFNULL(t.industry_name,"--") as industry_name from dy_comment_list l left join dy_industry_list t on t.industry_id = l.industry_id limit '.($page-1)*$limit.','.$limit;
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
	
	//评论添加确认
	public function plAddSubmit(){

		$comment_content = input('comment_content');
		$industry_id = input('industry_id');
		$ret = [
			'status'	=>	'error'
		];
		if(empty($comment_content) || empty($industry_id)){
			return json($ret);
		}
		
		$data = [
			'comment_content'	=>	$comment_content,
			'industry_id'	=> $industry_id
		];
		
		$re = Db::name('comment_list')->where($data)->find();
		if($re){
			$ret['status'] = 'have';
		}else{
			$data['created_at'] = time();
			$r = Db::name('comment_list')->insert($data);
			if($r){
				$ret['status'] = 'success';
			}
		}
		return json($ret);
	}
	
	//评论编辑
	public function plEdit(){
		$comment_id = input('comment_id',0);
		
		$list = Db::name('industry_list')->select();
		$this->assign('list',$list);
		
		$where = [
			'comment_id'	=>	$comment_id
		];
		
		$item = Db::name('comment_list')->where($where)->find();
		$this->assign('pl',$item);
		
		return $this->fetch('pl_edit');
	}
	
	//评论编辑确认
	public function plEditSubmit(){
		$comment_id = input('comment_id',0);
		$industry_id = input('industry_id');
		$comment_content = input('comment_content');
		
		$ret = [
			'status'	=>	'error'
		];
		
		if(empty($comment_content) || empty($industry_id)){
			return json($ret);
		}
		
		$data = [
			'industry_id'	=>	$industry_id,
			'comment_content'	=>	$comment_content,
			'updated_at' 	=>	time()
		];
		$r = Db::name('comment_list')->where(['comment_id'=>$comment_id])->update($data);
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
	
	//评论删除操作
	public function plDel(){
		$comment_id = input('comment_id',0);
		
		$ret = [
			'status'	=>	'error'
		];
		
		$r = Db::name('comment_list')->where(['comment_id'=>$comment_id])->delete();
		if($r){
			$ret['status'] = 'success';
		}
		
		return json($ret);
	}
}

