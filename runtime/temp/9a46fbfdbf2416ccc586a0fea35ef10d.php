<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"D:\phpStudy\WWW\jilin\public/../application/admin\view\brand\brand_add.html";i:1577719356;s:63:"D:\phpStudy\WWW\jilin\application\admin\view\common\header.html";i:1577720181;s:63:"D:\phpStudy\WWW\jilin\application\admin\view\common\footer.html";i:1577718707;}*/ ?>
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
<div class="layui-fluid">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-body ">
					<form class="layui-form layui-col-space5">
						<div class="layui-form-item">
							<label class="layui-form-label">品牌名称 <span class="xing">*</span></label>
							<div class="layui-input-block">
								<input type="text" name="brand_name" required lay-verify="required" placeholder="请输入品牌名称" autocomplete="off"
								 class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">品牌图标 <span class="xing">*</span></label>
							<div class="layui-input-block upload">
								<button type="button" class="layui-btn" id="upload">上传图标</button>
								<div class="layui-upload-list">
							    	<img class="layui-upload-img" id="demo1">
							    	<p id="demoText"></p>
							  	</div>
							  	<input type="hidden" name="brand_img" id="brand_img" value="" />
							</div>
						  	
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">启用|禁用</label>
							<div class="layui-input-block">
								<input type="checkbox" name="status" lay-skin="switch" lay-text="on|off" checked>
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
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="../../static/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="../../static/js/xadmin.js"></script>
<script type="text/javascript" src="../../static/js/echarts.min.js"></script>
<script>
	var table, tableIns, layer,upload,uploadInst;
	layui.use(['upload', 'form', 'table', 'layer'], function() {
		var form = layui.form;
		table = layui.table;
		layer = layui.layer;
		upload = layui.upload;
		var uploadInst = upload.render({
			elem: '#upload'
			,url: '/admin/upload/image'
			,before: function(obj){
			  //预读本地文件示例，不支持ie8
			  obj.preview(function(index, file, result){
			    $('#demo1').attr('src', result); //图片链接（base64）
			  });
			}
			,done: function(res){
			  if(res.code > 0){
			    return layer.msg(res.msg);
			  }else{
			  	$('#brand_img').val(res.data);
			  }
			}
			,error: function(){
			  //演示失败状态，并实现重传
			  var demoText = $('#demoText');
			  demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
			  demoText.find('.demo-reload').on('click', function(){
			    uploadInst.upload();
			  });
			}
		});
		//添加品牌
		form.on('submit(add)', function(data) {
			if(data.field.brand_img == ''){
				layer.msg('未选择图标', {
						icon: 2,
						time: 2000
				}, function() {});
				return false;
			}else{
				layer.load(0);
			}
			$.post('/admin/brand/brand_post', data.field, function(j) {
				layer.closeAll();
				if (j.status == 'success') {
					layer.msg('添加成功', {
						icon: 1,
						time: 2000
					}, function() {});
					xadmin.close();
                    window.parent.addUser();
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
