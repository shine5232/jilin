<?php
namespace app\index\controller;
use think\Db;

class Api extends \think\Controller

{
	//按键精灵使用
	public function dyOper(){
		$action = input('action','');
		$ret = [
			'status'	=>	'error'
		];
		if(empty($action)){
			return json($ret);
		}else{
			switch($action){
				//采集设备信息
				case 'getDeviceInfo':
					$device_no = input('device_no','');
					
					if(empty($device_no)){
						return json($ret);
					}
					
					$r = Db::name('device_list')->where('device_no',$device_no)->find();
					if($r){
						$data = [
							'device_no'	=>	$device_no,
							'updated_at'	=>	time()
						];
						Db::name('device_list')->where('device_id',$r['device_id'])->update($data);
					}else{
						$data = [
							'device_no'	=>	$device_no,
							'created_at'	=>	time()
						];
						Db::name('device_list')->insert($data);
					}
					$ret['status'] = 'success';
					
					return json($ret);
				break;
				
				//获取脚本是否允许启动
				case 'isOn':
					$device_no = input('device_no','');
					
					if(empty($device_no)){
						return json($ret);
					}
					
					$item = Db::name('device_list')->where('device_no',$device_no)->find();
					if($item){
						$ret['status'] = 'success';
						$ret['msg'] = $item;
					}
					return json($ret);
				break;
                    
                //随机获取虚拟位置坐标
                case 'getRandLngLat':
                    $device_no = input('device_no','');
                    
                    if(empty($device_no)){
						return json($ret);
					}
                    
                    
                    $poss = Db::name('pos_list')
                            ->alias('p')
                            ->field('p.lng,p.lat')
                            ->join('__DEVICE_LIST__ d','d.device_id=p.device_id','LEFT')
                            ->where('d.device_no',$device_no)
                            ->select();
                    if($poss){
                        $ind = array_rand($poss);
                        
                        $ret['status'] = 'success';
                        $ret['msg'] = $poss[$ind];
                    }
                    
					return json($ret);
                break;
					
				//采集或更新当前登录抖音号的信息
				case 'updateNoInfo':
                    $device_no = input('device_no','');
					$no = input('no','');
					$a = input('a',0);
					$b = input('b',0);
					$c = input('c',0);
					

					if(empty($device_no) || empty($no)){
						return json($ret);
					}
                    
                    
                    //获取设备ID
                    $device = Db::name('device_list')->field('device_id')->where('device_no',$device_no)->find();
                    if($device){
                        //查找抖音号
                        $noinfo = Db::name('no_list')->where('no',$no)->find();
                        if($noinfo){
                            $data = [
                                'no'	=>	$no,
                                'a'		=>	$a,
                                'b'		=>	$b,
                                'c'		=>	$c,
                                'updated_at'	=>	time()
                            ];
                            $s = Db::name('no_list')->where('no_id',$noinfo['no_id'])->update($data);
                            if($s){
                                $ret['status'] = 'success';
                            }
                        }else{
                            $data = [
                                'no'	=>	$no,
                                'a'		=>	$a,
                                'b'		=>	$b,
                                'c'		=>	$c,
                                'created_at'	=>	time()
                            ];
                            $gid = Db::name('user_list')->insertGetId($data);
                            if($gid > 0){
                                $ret['status'] = 'success';
                            }
                        }
                    }
					
					return json($ret);
				break;
					
				
				//记录私信发送
				case 'updateSendHistory':
					$no = input('no','');
                    $to_no = input('to_no','');
					
					if(empty($no) || empty($to_no)){
						return json($ret);
					}
					
                    $r = Db::query('select history_id from dy_history_list where no = ? and to_no = ?',[$no,$to_no]);
                    
					if(!$r){
						//增加历史记录
						$d = [
                            'no'	=>	$no,
                            'to_no' =>  $to_no,
                            'created_at'	=>	time()
                        ];
                        $gid = Db::name('history_list')->insertGetId($d);
                        if($gid){
                            $ret['status'] = 'success';
                        }
                    }else{
                        $ret['status'] = 'exist';
                    }
					return json($ret);
				break;
					
					
				//获取设备配置信息
				case 'getDeviceConfig':
					$device_no = input('device_no','');
					
					if(empty($device_no)){
						return json($ret);
					}
					
					$re = Db::name('device_list')
                        ->alias('d')
                        ->field('d.device_id,d.device_no,IFNULL(i.industry_name,"as") as industry_name,d.is_on,i.industry_name')
                        ->join('__INDUSTRY_LIST__ i','i.industry_id=d.industry_id','LEFT')
                        ->where(['device_no' => $device_no])
                        ->find();
					if($re){
						$ret['status'] = 'success';
						$ret['msg']	= $re;
					}
					return json($ret);
				break;
                
				
				//获取当前抖音号要采集的大V号
				case 'getCurrentV':
					$no = input('no',0);
					
					$where = [
						'no'	=>	$no
					];
					
					$r = Db::name('no_list')->field('v_no')->where($where)->find();
					if($r){
						$ret['status'] = 'success';
						$ret['msg'] = $r;
					}
					
					return json($ret);
				break;
					
                    
                //*****************************************************************************************
                    
					
				//更新采集状态
				case 'setReaded':
					$v_id = input('v_id',0);
					
					if($v_id == 0){
						return json($ret);
					}
					
					$r = Db::name('v_list')->where('v_id',$v_id)->update(['is_readed'=>1]);
					if($r){
						$ret['status'] = 'success';
					}
					
					return json($ret);
				break;
				
					
				//更新关注、评论和私信次数
				case 'updateTimes':
					$type = input('type',0);
					$v_id = input('v_id',0);
					
					if($v_id == 0){
						return json($ret);
					}
					
					$data = [];
					switch($type){
						case 1:
							$data['follow_times'] = Db::Raw('follow_times+1');
							break;
						case 2:
							$data['pl_times'] = Db::Raw('pl_times+1');
							break;
						case 3:
							$data['priv_times'] = Db::Raw('priv_times+1');
							break;
					}
					
					$r = Db::name('v_list')->where('v_id',$v_id)->update($data);
					if($r){
						$ret['status'] = 'success';
					}
					
					return json($ret);
				break;
					

				//随机取评论文案
				case 'getRandPl':
					$no_id = input('no_id',0);
					
					if($no_id == 0){
						return json($ret);
					}
					
					$r = Db::name('no_list')->field('industry_id')->where('no_id',$no_id)->find();
					if($r){
						$where = [
							'industry_id' 	=> $r['industry_id'],
							'is_can'		=>	1
						];
						$count = Db::name('pl_list')->field('industry_id')->where($where)->count();
						if($count == 0){
							$ret['status'] = 'no';
						}else{
							$arr = Db::name('pl_list')->field('pl_content')->where($where)->limit(rand(0,$count - 1),1)->select();
							if($arr){
								$ret['status'] = 'success';
								$ret['msg']	= $arr[0]['pl_content'];
							}
						}
					}
					return json($ret);
				break;
				
					
				//随机取回复文案
				case 'getRandPriv':
					$no_id = input('no_id',0);
					
					if($no_id == 0){
						return json($ret);
					}
					
					$r = Db::name('no_list')->field('industry_id')->where('no_id',$no_id)->find();
					if($r){
						$where = [
							'industry_id' 	=> $r['industry_id'],
							'is_can'		=>	1
						];
						$count = Db::name('priv_list')->field('industry_id')->where($where)->count();
						if($count == 0){
							$ret['status'] = 'no';
						}else{
							$arr = Db::name('priv_list')->field('priv_content')->where($where)->limit(rand(0,$count - 1),1)->select();
							if($arr){
								$ret['status'] = 'success';
								$ret['msg']	= $arr[0]['priv_content'];
							}
						}
					}
					return json($ret);
				break;
			}
		}
	}

}

