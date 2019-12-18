<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"D:\phpstudy\PHPTutorial\WWW\dy\public/../application/index\view\basics\customer_add.html";i:1574328562;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>评论管理</title>
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
								<div class="layui-form-item">
									<label class="layui-form-label">账号 <span class="xing">&#10022</span></label>
									<div class="layui-input-block">
										<input type="text" name="customer_code" required lay-verify="required" placeholder="请输入账号" autocomplete="off"
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
									<label class="layui-form-label">客户名称 <span class="xing">&#10022</span></label>
									<div class="layui-input-block">
										<input type="text" name="company" required lay-verify="required" placeholder="请输入账号" autocomplete="off"
										 class="layui-input">
									</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">联系人</label>
									<div class="layui-input-block">
										<input type="text" name="linkman" placeholder="请输入账号" autocomplete="off"
										 class="layui-input">
									</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">手机</label>
									<div class="layui-input-block">
										<input type="text" name="phone" placeholder="请输入账号" autocomplete="off"
										 class="layui-input">
									</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">地址</label>
									<div class="layui-input-block">
										<input type="text" name="address" placeholder="请输入账号" autocomplete="off"
										 class="layui-input">
									</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">行业 <span class="xing">&#10022</span></label>
 									<div class="layui-input-block">
										<select name="trade_id" id="trade_id" class="layui-select">
											<option value="">请选择</option>
											<?php if(is_array($trade) || $trade instanceof \think\Collection || $trade instanceof \think\Paginator): $i = 0; $__LIST__ = $trade;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?>
											<option value="<?php echo $l['trade_id']; ?>"><?php echo $l['trade_name']; ?></option>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
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
				$('#customer_code').val('').focus();
				layer.load(0);
				$.post('./customerAddSubmit', data.field, function(j) {
					layer.closeAll();
					console.log(j.status);return false;
					if (j.status == 'success') {
						layer.msg('添加成功', {
							icon: 1,
							time: 2000
						}, function() {});
						xadmin.close();
                        window.parent.addCustomer();
					}
					if (j.status == 'have') {
						layer.msg('已存在相同的记录', {
							icon: 21,
							time: 2000
						}, function() {});
					}
					if (j.status == 'phone') {
						layer.msg('手机号格式不正确', {
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
