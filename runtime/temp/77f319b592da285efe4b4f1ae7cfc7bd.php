<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpstudy\WWW\dy\public/../application/index\view\basics\customer.html";i:1574327413;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>客户</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
		<link rel="stylesheet" href="../../static/css/font.css">
		<link rel="stylesheet" href="../../static/css/xadmin.css">
		<script src="../../static/lib/layui/layui.js" charset="utf-8"></script>
		<script type="text/javascript" src="../../static/js/xadmin.js"></script>
		<!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
	</head>
	<body>
		<div class="x-nav">
			<span class="layui-breadcrumb">
				<a href="">首页</a> <a href="">基础管理</a>
				<a> <cite>客户维护</cite></a>
			</span>
			<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin:3px 3px 0 0;float:right" onclick="location.reload()"
			 title="刷新">
				<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
			</a>
			<a href="javascaript:;" onclick="xadmin.open('添加客户','/index/Basics/customerAdd',640,750);" style="line-height:1.6em;margin:3px 3px 0 0;float:right"
			 title="添加">
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
							<table id="customer">
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script>
		var table, tableIns, layer;
		layui.use(['laydate', 'form', 'table', 'layer'], function() {
			var form = layui.form;
			table = layui.table;
			layer = layui.layer;

			tableIns = table.render({
				elem: '#customer',
				limit: 10,
				url: './customertList' //数据接口
					,
				page: true //开启分页
					,
				cols: [
					[ //表头
						{
							field: 'customer_code',
							title: '账号',
							width: '8%',
							align: 'center'
						}, {
							field: 'company',
							title: '客户名称',
							width: '16%',
							align: 'center'
						}, {
							field: 'linkman',
							title: '联系人',
							width: '8%',
							align: 'center'
						}, {
							field: 'phone',
							title: '手机',
							width: '10%',
							align: 'center'
						}, {
							field: 'address',
							title: '地址',
							width: '14%',
							align: 'center'
						}, {
							field: 'trade_name',
							title: '行业',
							width: '10%',
							align: 'center'
						}, {
							field: 'login_date',
							title: '最近登录时间',
							width: '10%',
							align: 'center',
							sort: true
						}, {
							field: 'remark',
							title: '备注',
							width: '10%',
							align: 'center'
						}, {
							field: 'tool0',
							title: '状态',
							width: '8%',
							align: 'center',
							templet: function(d) {
								return '<div class="layui-input-inline"><input type="checkbox" name="switch" value="" lay-skin="switch" lay-text="ON|OFF" lay-filter="cc" data-customer-id="' +
									d.customer_id + '" ' + (d.is_use == 0 ? '' : 'checked') + '>';
							}
						}, {
							field: 'tool1',
							title: '操作',
							width: '6%',
							align: 'center',
							templet: function(d) {
								return '<a href="javascaript:;" onclick="xadmin.open(\'编辑客户\',\'/index/Basics/widgetEdit?id=' + d.id +
									'\',500,640);"><i class="iconfont">&#xe69e;</i></a>';
							}
						}
					]
				]
			});


			form.on('switch(cc)', function(data) {
				var t = data.elem;
				var id = $(t).attr('data-customer-id');

				$.post('./setCustomer', {
					id: id
				}, function(j) {
					if (j.status == 'success') {
						if (j.msg == 0) {
							$(t).removeAttr('checked');
						}
						if (j.msg == 1) {
							$(t).attr('checked');
						}
					}
					if (j.status == 'error') {
						layer.msg('设置失败');
					}
				});
			});
		});


		//编辑后更新单元格数据
		function addCustomer() {
			layer.msg('操作成功', {
				icon: 1,
				time: 2000
			}, function() {});
			tableIns.reload();
		}
	</script>
</html>
