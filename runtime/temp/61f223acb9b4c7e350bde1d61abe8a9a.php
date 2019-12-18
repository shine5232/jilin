<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"D:\phpstudy\WWW\dy\public/../application/index\view\task\task_col.html";i:1574589984;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>抖音号管理</title>
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
		<div class="x-nav"> <span class="layui-breadcrumb"> <a href="">首页</a> <a href="">基础管理</a> <a> <cite>大号</cite></a>
			</span> <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload();"
			 title="刷新"> <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a> </div>
		<div class="layui-fluid">
			<div class="layui-row layui-col-space15">
				<div class="layui-col-md12">
					<div class="layui-card">
						<div class="layui-card-body">
							<table id="col" lay-filter="test">
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
				elem: '#col',
				limit: 10,
				url: './taskColList' //数据接口
					,
				page: true //开启分页
					,
				cols: [
					[ //表头
						{
							field: 'third_party_id',
							title: '第三方用户ID',
							width: '30%',
							sort: true,
							align: 'center'
						}, {
							field: 'nickname',
							title: '昵称',
							width: '20%',
							align: 'center'
						}, {
							field: 'task_name',
							title: '任务',
							width: '20%',
							align: 'center'
						}, {
							field: 'create_time',
							title: '创建时间',
							width: '20%',
							sort: true,
							align: 'center'
						}, {
							field: 'tool',
							title: '操作',
							width: '10%',
							align: 'center',
							templet: function(d) {
								return '<a href="javascaript:;" onclick="xadmin.open(\'编辑大号\',\'/index/Task/taskColEdit?task_kol_id=' +d.task_kol_id + '\',500,270);"><i class="iconfont">&#xe69e;</i></a>';
							}
						}
					]
				]
			});
		});
	</script>
</html>
