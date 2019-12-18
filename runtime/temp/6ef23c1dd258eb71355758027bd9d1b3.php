<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\phpstudy\WWW\dy\public/../application/index\view\basics\widget_edit.html";i:1574154734;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">

	<head>
		<meta charset="UTF-8">
		<title>编辑控件</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
		<link rel="stylesheet" href="../../static/css/font.css">
		<link rel="stylesheet" href="../../static/css/xadmin.css">
		<script type="text/javascript" src="../../static/lib/layui/layui.js" charset="utf-8"></script>
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
								<input type="hidden" value="<?php echo \think\Request::instance()->param('id'); ?>" name="id">
								<div class="layui-form-item layui-form-text">
									<label class="layui-form-label">控件ID <span class="xing">&#10022</span></label>
									<div class="layui-input-block">
										<textarea name="widget_id" class="layui-textarea" required lay-verify="required"><?php echo $widget['widget_id']; ?></textarea>
										<div class="layui-form-mid layui-word-aux">
											不超过60字符
										</div>
									</div>
								</div>
								<div class="layui-form-item layui-form-text">
									<label class="layui-form-label">控件描述 <span class="xing">&#10022</span></label>
									<div class="layui-input-block">
										<textarea name="widget_description" class="layui-textarea" required lay-verify="required"><?php echo $widget['widget_description']; ?></textarea>
										<div class="layui-form-mid layui-word-aux">
											不超过100字符
										</div>
									</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">APP <span class="xing">&#10022</span></label>
									<div class="layui-input-block">
										<select name="app_id" id="app_id" class="layui-select">
											<option value="">请选择</option>
											<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?>
											<option value="<?php echo $l['app_id']; ?>" <?php if($l['app_id'] == $widget['app_id']): ?>selected<?php endif; ?>><?php echo $l['app_name']; ?> </option>
											 <?php endforeach; endif; else: echo "" ;endif; ?> </select> </div> </div> <div class="layui-form-item layui-form-text">
												<label class="layui-form-label">备注</label>
												<div class="layui-input-block">
													<textarea name="remark" class="layui-textarea"><?php echo $widget['remark']; ?></textarea>
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
						widget_id: [/^[\S\s]{1,60}$/, '不超过60字符'],
						widget_description: [/^[\S\s]{1,100}$/, '不超过100字符'],
						remark: [/^[\S\s]{1,500}$/, '不超过500字符']
					});

					$('#widget_id').select();

					//监听提交
					form.on('submit(edit)', function(data) {
						layer.load(0);
						$.post('./widgetEditSubmit', data.field, function(j) {
							//layer.closeAll();
							if (j.status == 'success') {
								xadmin.close();
								window.parent.updateWidget();
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
