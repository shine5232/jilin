<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"D:\phpStudy\WWW\dy\public/../application/index\view\user\user_add.html";i:1576681036;s:60:"D:\phpStudy\WWW\dy\application\index\view\common\header.html";i:1576680733;s:60:"D:\phpStudy\WWW\dy\application\index\view\common\footer.html";i:1576680905;}*/ ?>
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
		<div class="layui-fluid">
			<div class="layui-row layui-col-space15">
				<div class="layui-col-md12">
					<div class="layui-card">
						<div class="layui-card-body ">
							<form class="layui-form layui-col-space5">
								<div class="layui-form-item">
									<label class="layui-form-label">姓名 <span class="xing">&#10022</span></label>
									<div class="layui-input-block">
										<input type="text" name="user_name" required lay-verify="required" placeholder="请输入姓名" autocomplete="off"
										 class="layui-input">
									</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">账号 <span class="xing">&#10022</span></label>
									<div class="layui-input-block">
										<input type="text" name="user_code" required lay-verify="required" placeholder="请输入账号" autocomplete="off"
										 class="layui-input">
									</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">密码 <span class="xing">&#10022</span></label>
									<div class="layui-input-block">
										<input type="text" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off"
										 class="layui-input">
									</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">状态</label>
									<div class="layui-input-block">
										<input type="checkbox" name="is_use" lay-skin="switch" lay-text="有效|NO" checked>
									</div>
								</div>
								<div class="layui-form-item layui-form-text">
									<label class="layui-form-label">备注</label>
									<div class="layui-input-block">
										<textarea name="remark" placeholder="请输入备注" class="layui-textarea"></textarea>
									</div>
								</div>
								<div class="layui-form-item">
									<div class="layui-input-block">
										<button type="submit" class="layui-btn" lay-filter="add" lay-submit >立即提交</button>
										<button type="reset" class="layui-btn layui-btn-primary">重置</button>
									</div>
								</div>
							</form>
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
		var table, tableIns, layer;
		layui.use(['laydate', 'form', 'table', 'layer'], function() {
			var form = layui.form;
			table = layui.table;
			layer = layui.layer;

			//自定义验证规则
			form.verify({
				remark: [/^[\S\s]{1,160}$/, '不超过160字符'],
			});

			//添加用户
			form.on('submit(add)', function(data) {
				$('#user_name').val('').focus();
				layer.load(0);
				$.post('./userAddSubmit', data.field, function(j) {
					layer.closeAll();
					if (j.status == 'success') {
						layer.msg('添加成功', {
							icon: 1,
							time: 2000
						}, function() {});
						xadmin.close();
                        window.parent.addUser();
					}
					if (j.status == 'have') {
						layer.msg('已存在相同的记录', {
							icon: 21,
							time: 2000
						}, function() {});
					}
					if (j.status == 'error') {
						layer.msg('添加失败', {
							icon: 2,
							time: 2000
						}, function() {});
					}
				}, 'json');
				return false;
			});
		});
	</script>
</html>
