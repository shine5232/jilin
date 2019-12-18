<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\phpstudy\WWW\dy\public/../application/index\view\task\task_col_edit.html";i:1574593397;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">

	<head>
		<meta charset="UTF-8">
		<title>大号修改</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
		<link rel="stylesheet" href="../../static/css/font.css">
		<link rel="stylesheet" href="../../static/css/xadmin.css">
		<script src="../../static/lib/layui/layui.js" charset="utf-8"></script>
		<script type="text/javascript" src="../../static/js/xadmin.js"></script>
		<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
		<!--[if lt IE 9]>
            <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
            <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
		<style type="text/css">
			.xing {
				color: #ee4d4d;
				font-size: 12px;
			}
		</style>
	</head>
	<body>
		<div class="layui-fluid">
			<div class="layui-row layui-col-space15">
				<div class="layui-col-md12">
					<div class="layui-card">
						<div class="layui-card-body ">
							<form class="layui-form layui-col-space5">
								<input type="hidden" value="<?php echo \think\Request::instance()->param('task_kol_id'); ?>" name="task_kol_id">
								<div class="layui-form-item">
									<label class="layui-form-label">任务 <span class="x-red">*</span></label>
									<div class="layui-input-block">
										<select name="task_id" id="task_id" class="layui-select">
											<option value="">请选择</option>
											<?php if(is_array($task) || $task instanceof \think\Collection || $task instanceof \think\Paginator): $i = 0; $__LIST__ = $task;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?>
											<option value="<?php echo $l['task_id']; ?>" <?php if($l['task_id'] == $task_col['task_id']): ?>selected<?php endif; ?>><?php echo $l['task_name']; ?></option>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
									</div>
								</div>
								<div class="layui-form-item layui-form-text">
									<label class="layui-form-label">第三方平台用户ID <span class="xing">&#10022</span></label>
									<div class="layui-input-block">
										<textarea name="third_party_id" class="layui-textarea" required lay-verify="required"><?php echo $task_col['third_party_id']; ?></textarea>
										<div class="layui-form-mid layui-word-aux">
											不超过500字符
										</div>
									</div>
								</div>
								<div class="layui-form-item layui-form-text">
									<label class="layui-form-label">昵称</label>
									<div class="layui-input-block">
										<textarea name="nickname" class="layui-textarea"><?php echo $task_col['nickname']; ?></textarea>
										<div class="layui-form-mid layui-word-aux">
											不超过500字符
										</div>
									</div>
								</div>
								<div class="layui-form-item">
									<div class="layui-input-block">
										<button type="submit" class="layui-btn" lay-filter="edit" lay-submit>立即提交</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			layui.use(['form', 'layer'],
				function() {
					$ = layui.jquery;
					var form = layui.form,
						layer = layui.layer;

					//自定义验证规则
					form.verify({
						no: [/^[\S\s]{1,20}$/, '不超过20字符'],
					});

					$('#no').select();

					//监听提交
					form.on('submit(edit)', function(data) {
						layer.load(0);
						$.post('/index/Base/noEditSubmit', data.field, function(j) {
							layer.closeAll();
							if (j.status == 'success') {
								xadmin.close();
								window.parent.updateNo();
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
	</body>

</html>
