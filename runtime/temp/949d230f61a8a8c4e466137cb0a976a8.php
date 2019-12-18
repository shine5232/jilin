<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"D:\phpStudy\WWW\dy\public/../application/index\view\user\user_edit.html";i:1576681114;s:60:"D:\phpStudy\WWW\dy\application\index\view\common\header.html";i:1576680733;s:60:"D:\phpStudy\WWW\dy\application\index\view\common\footer.html";i:1576680905;}*/ ?>
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
						<input type="hidden" value="<?php echo \think\Request::instance()->param('user_id'); ?>" name="user_id">
						<div class="layui-form-item">
							<label class="layui-form-label">姓名 <span class="xing">&#10022</span></label>
							<div class="layui-input-block">
								<input type="text" id="user_name" name="user_name" required lay-verify="required" value="<?php echo $user['user_name']; ?>"
								 autocomplete="off" class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">账号 <span class="xing">&#10022</span></label>
							<div class="layui-input-block">
								<input type="text" id="user_name" name="user_code" required lay-verify="required" value="<?php echo $user['user_code']; ?>"
								 autocomplete="off" class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">密码  <span class="xing">&#10022</span></label>
							<div class="layui-input-inline">
								<input type="password" id="password" name="password" required lay-verify="required" value="<?php echo $user['password']; ?>"
								 autocomplete="off" class="layui-input" readonly="readonly">
							</div>
						</div>
						<div class="layui-form-item layui-form-text">
							<label class="layui-form-label">备注</label>
							<div class="layui-input-block">
								<textarea name="remark" placeholder="请输入备注" class="layui-textarea"><?php echo $user['remark']; ?></textarea>
							</div>
						</div>
						<div class="layui-form-item">
							<div class="layui-input-block">
								<button type="submit" class="layui-btn" lay-filter="edit" lay-submit>立即提交</button>
								<button type="submit" class="layui-btn layui-btn-primary" lay-filter="password" lay-submit>重置密码</button>
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
		//$('#user_name').select();

		//监听提交
		form.on('submit(edit)', function(data) {
			//layer.load(0);
			$.post('./userEditSubmit', data.field, function(j) {
				//layer.closeAll();
				if (j.status == 'success') {
					xadmin.close();
					window.parent.addUser();
				}
				if (j.status == 'error') {
					layer.msg('修改失败', {
						icon: 2,
						time: 2000
					}, function() {});
				}
			}, 'json');
			return false;
		});
		
		//监听重置密码
		form.on('submit(password)', function(data) {
			//layer.load(0);
			$.post('./userEditReset', data.field, function(j) {
				//layer.closeAll();
				if (j.status == 'success') {
					xadmin.close();
					window.parent.addUser();
				}
				if (j.status == 'error') {
					layer.msg('修改失败', {
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
