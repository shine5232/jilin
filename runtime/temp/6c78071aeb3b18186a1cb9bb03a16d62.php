<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:66:"D:\phpStudy\WWW\dy\public/../application/index\view\user\user.html";i:1576681201;s:60:"D:\phpStudy\WWW\dy\application\index\view\common\header.html";i:1576680733;s:60:"D:\phpStudy\WWW\dy\application\index\view\common\footer.html";i:1576680905;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <link rel="stylesheet" href="../../static/css/font.css">
        <link rel="stylesheet" href="../../static/css/xadmin.css">
        <link rel="stylesheet" href="../../static/css/formcss.css">
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
<div class="x-nav">
	<span class="layui-breadcrumb">
		<a href="">首页</a> <a href="">基础管理</a>
		<a> <cite>用户</cite></a> 
	</span>
	<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin:3px 3px 0 0;float:right" onclick="location.reload()"
	 title="刷新">
		<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
	</a>
	<a  href="javascaript:;" onclick="xadmin.open('添加管理员','/index/User/userAdd',500,500);" style="line-height:1.6em;margin:3px 3px 0 0;float:right"  title="添加">
		<button type="button" class="layui-btn layui-btn-normal">
		  <i class="layui-icon">&#xe608;</i> 添加
		</button>
	</a>
</div>
<div class="layui-fluid">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-body">
					<table id="user">
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script src="../../static/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="../../static/js/xadmin.js"></script>
<script type="text/javascript" src="../../static/js/echarts.min.js"></script>
<script>
	var table,tableIns,layer;
  		layui.use(['laydate','form','table','layer'], function(){
    var form = layui.form;
		table = layui.table;
	  	layer = layui.layer; 
		tableIns =  table.render({
				elem: '#user'
				,limit:10
				,url: './userList' //数据接口
				,page: true //开启分页
				,cols: [[ //表头
				  {field: 'user_name', title: '姓名', width:'20%', sort: true, fixed: 'left',align:'center'}
				  ,{field: 'user_code', title: '账号', width:'20%',align:'center'}
				  ,{field: 'login_date', title: '上次登录', width:'20%', sort: true,align:'center'}
				  ,{field: 'tool0', title: '状态', width: '20%',align:'center',templet:function(d){
					  return '<div class="layui-input-inline"><input type="checkbox" name="switch" value="" lay-skin="switch" lay-text="ON|OFF" lay-filter="cc" data-user-id="'+d.user_id+'" '+(d.is_use==0?'':'checked')+'>';
				  }}
				  ,{field:'tool',title:'操作',width:'20%',align:'center',templet: function(d){
						return '<a href="javascaript:;" onclick="xadmin.open(\'编辑用户\',\'/index/User/userEdit?user_id='+d.user_id+'\',500,450);"><i class="iconfont">&#xe69e;</i></a> | <a href="javascaript:;" onclick="delIndustry('+d.user_id+');"><i class="iconfont">&#xe69d;</i></a>';
				  }}
				]]
		  });
		
		form.on('switch(cc)',function(data){
					  var t = data.elem;
					  var id = $(t).attr('data-user-id');
					  
					  $.post('./setUser',{id:id},function(j){
							if(j.status == 'success'){
								if(j.msg == 0){
									$(t).removeAttr('checked');
								}
								if(j.msg == 1){
									$(t).attr('checked');
								}
							}
						    if(j.status == 'error'){
								layer.msg('设置失败');
							}
					  });
		});
  });
//删除用户
function delIndustry(id){
	layer.confirm('确定要删除该用户？',function(){
		layer.load(0);
		$.post('./userDel',{user_id:id},function(j){
			layer.closeAll();
			if(j.status == 'success'){
				layer.msg('已删除',{icon:1,time:2000},function(){});
				tableIns.reload();
			}
			if(j.status == 'error'){
				layer.msg('删除失败',{icon:2,time:2000},function(){});
			}
		});
	});
}

function addUser() {
    layer.msg('执行成功', { icon: 1, time: 2000 }, function () { });
    tableIns.reload();
}
</script>
</html>
