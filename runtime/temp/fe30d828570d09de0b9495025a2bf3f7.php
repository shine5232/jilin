<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"D:\phpStudy\WWW\dy\public/../application/index\view\user\login.html";i:1570777188;}*/ ?>
<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>抖音群控管理后台</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="../../static/css/font.css">
    <link rel="stylesheet" href="../../static/css/login.css?12">
	  <link rel="stylesheet" href="../../static/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="../../static/lib/layui/layui.js" charset="utf-8"></script> 
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message" style="font-size: 24px;background: #666;"><img src="../../static/images/logo.png" width="40" height="40">创梦抖音群控系统</div>
        <div id="darkbannerwrap"></div>
        
        <form method="post" class="layui-form" >
            <input name="account" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录系统" lay-submit lay-filter="login" style="width:100%;font-size:20px;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        $(function  () {
            layui.use(['form','layer'], function(){
              var form = layui.form;
			  var layer = layui.layer;
              //监听提交
              form.on('submit(login)', function(data){
				layer.load();
                $.post('/index/User/toLogin',data.field,function(j){
					layer.closeAll();
					if(j.status == 'success'){
						layer.msg('登陆成功',{
							icon:1,
							time:1000
						},function(){
							window.location.href = '/main';
						});
					}else{
						layer.msg('登陆失败',{
							icon:2,
							time:1000
						},function(){
							//
						});
					}
				},'json');
                return false;
              });
            });
        })
    </script>
</body>
</html>