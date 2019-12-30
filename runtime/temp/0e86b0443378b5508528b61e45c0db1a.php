<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"D:\phpStudy\WWW\jilin\public/../application/admin\view\brand\index.html";i:1577720020;s:63:"D:\phpStudy\WWW\jilin\application\admin\view\common\header.html";i:1577720181;s:63:"D:\phpStudy\WWW\jilin\application\admin\view\common\footer.html";i:1577718707;}*/ ?>
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
        <style type="text/css">
            .xing{
                color: red;
            }
            .upload{
                display: flex;
            }
            .upload .layui-upload-list{
                margin: 0 10px;
            }
            .upload .layui-upload-list img{
                width: 80px;
                height: 80px;
                margin-bottom: 10px;
            }
            .brand_img{
                width: 26px;
                height: 26px;
            }
        </style>
    </head>
    <body>
<div class="x-nav">
	<span class="layui-breadcrumb">
		<a href="">首页</a> <a href="">品牌管理</a>
		<a> <cite>品牌</cite></a> 
	</span>
	<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin:3px 3px 0 0;float:right" onclick="location.reload()"
	 title="刷新">
		<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
	</a>
	<a  href="javascaript:;" onclick="xadmin.open('添加品牌','/admin/brand/brand_add',800,500);" style="line-height:1.6em;margin:3px 3px 0 0;float:right"  title="添加">
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
					<form class="layui-form layui-col-space5">
						<div class="layui-form-item">
							<div class="layui-inline">
								<input type="text" class="layui-input" name="brand_name"  value="<?php echo $brand_name; ?>" placeholder="品牌名称" autocomplete="off" style="width:200px">
							</div>
							<div class="layui-inline">
							    <button type="button" class="layui-btn layui-btn-normal" lay-submit lay-filter="submit">
								 	<i class="layui-icon layui-icon-search"></i>
								</button>
							</div>
						</div>
					</form>
					<table id="brand"></table>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="../../static/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="../../static/js/xadmin.js"></script>
<script type="text/javascript" src="../../static/js/echarts.min.js"></script>
<script>
	var table,tableIns,layer;
	layui.use(['laydate','form','table','layer'], function(){
    	var form = layui.form;
		table = layui.table;
	  	layer = layui.layer; 
		tableIns =  table.render({
			elem: '#brand'
			,height: 'full-250'
			,limit:10
			,url: '/admin/brand/index_ajax' //数据接口
			,page: true //开启分页
			,cols: [ //表头
				[
					{field: 'id', title: 'ID', width:'10%', sort: true, fixed: 'left',align:'center'}
					,{field: 'brand_name', title: '品牌名称', width:'30%',align:'center'}
					,{field: 'brand_img', title: '品牌图标', width:'20%',align:'center',
						templet:function(d){
							return '<img src="../../uploads/'+d.brand_img+'" class="brand_img" />';
						}
					}
					,{field: 'status', title: '状态', width: '20%',align:'center',
						templet:function(d){
							return '<div class="layui-input-inline"><input type="checkbox" name="status" value="" lay-skin="switch" lay-text="ON|OFF" lay-filter="cc" data-user-id="'+d.id+'" '+(d.status==0?'':'checked')+'>';
						}
					}
					,{field:'tool',title:'操作',width:'20%',align:'center',
						templet: function(d){
							return '<a href="javascaript:;" onclick="xadmin.open(\'编辑\',\'/admin/brand/brand_edit?id='+d.id+'\',500,450);"><i class="iconfont">&#xe69e;</i></a> | <a href="javascaript:;" onclick="delIndustry('+d.id+');"><i class="iconfont">&#xe69d;</i></a>';
						}
					}
				]
			]
	    });
		form.on('switch(cc)',function(data){
			var t = data.elem;
			var id = $(t).attr('data-user-id');
			$.post('/admin/brand/change_status',{id:id},function(j){
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
		form.on('submit(submit)',function(data){
			var index = layer.msg('查询中，请稍后...',{
				icon:16,
				time:false,
				shade:0
			});
			setTimeout(function(){
				tableIns.reload({
					where: { //设定异步数据接口的额外参数，任意设
						brand_name: data.field.brand_name
					}
					,page: {
						curr: 1 //重新从第 1 页开始
					}
				});
				layer.close(index);
			},1000);
			return false;
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
