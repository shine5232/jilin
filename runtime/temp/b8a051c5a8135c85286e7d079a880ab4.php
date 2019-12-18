<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"D:\phpstudy\WWW\dy\public/../application/index\view\user\main.html";i:1574590857;}*/ ?>
<!doctype html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>主页</title>
		<meta name="renderer" content="webkit|ie-comp|ie-stand">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
		<meta http-equiv="Cache-Control" content="no-siteapp" />
		<link rel="stylesheet" href="../../static/css/font.css">
		<link rel="stylesheet" href="../../static/css/xadmin.css">
		<!-- <link rel="stylesheet" href="./css/theme5.css"> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
		<script src="../../static/lib/layui/layui.js" charset="utf-8"></script>
		<script type="text/javascript" src="../../static/js/xadmin.js"></script>
		<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
		<!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
		<script>
			// 是否开启刷新记忆tab功能
			// var is_remember = false;

			var hostname = 'j6d.cn',
				port = 61623,
				clientId = 'admin',
				timeout = 10,
				keepAlive = 20,
				cleanSession = true,
				ssl = false,
				userName = 'admin',
				password = 'password',
				topic = 'scriptController';

			var client = new Paho.MQTT.Client(hostname, port, clientId);
			//建立客户端实例  
			var options = {
				invocationContext: {
					host: hostname,
					port: port,
					path: client.path,
					clientId: clientId
				},
				timeout: timeout,
				keepAliveInterval: keepAlive,
				cleanSession: cleanSession,
				useSSL: ssl,
				userName: userName,
				password: password,
				onSuccess: onConnect,
				onFailure: function(e) {
					console.log(e);
					s = "{time:" + new Date().Format("yyyy-MM-dd hh:mm:ss") + ", onFailure()}";
					console.log(s);
				}
			};
			client.connect(options);
			//连接服务器并注册连接成功处理事件  
			function onConnect() {
				console.log("onConnected");
				client.subscribe(topic);
			}

			client.onConnectionLost = onConnectionLost;

			//注册连接断开处理事件  
			client.onMessageArrived = onMessageArrived;

			//注册消息接收处理事件  
			function onConnectionLost(responseObject) {
				if (responseObject.errorCode !== 0) {
					console.log("连接已断开");
					setTimeout(function() {
						client.connect(options);
					}, 1000);
				}
			}

			function onMessageArrived(message) {
				// console.log("收到消息:" + message.payloadString);
			}
			//发送指令
			function sendMessage(msg) {
				if (client.isConnected) {
					message = new Paho.MQTT.Message(msg);
					message.destinationName = "remoteController";
					client.send(message);
				}
			}

			var on = JSON.stringify({
				"oper": "on"
			});
			var off = JSON.stringify({
				"oper": "off"
			});
		</script>
	</head>
	<body class="index">
		<!-- 顶部开始 -->
		<div class="container">
			<div class="logo">
				<a href="/main"><img src="../../static/images/logo.png" width="40" height="40">创梦抖音群控系统</a></div>
			<div class="left_open">
				<a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
			</div>
			<ul class="layui-nav left fast-add" lay-filter="">
				<li class="layui-nav-item">
					<a href="javascript:;">远程控制</a>
					<dl class="layui-nav-child">
						<!-- 二级菜单 -->
						<dd>
							<a href="javascript:;" onclick="sendMessage(on);">
								全部启动 <i class="iconfont">&#xe719;</i></a></dd>
						<dd>
							<a href="javascript:;" onclick="sendMessage(off);">
								全部关闭 <i class="iconfont">&#xe71a;</i></a></dd>
					</dl>
				</li>
			</ul>
			<ul class="layui-nav right" lay-filter="">
				<li class="layui-nav-item">
					<a href="javascript:;"><?php echo \think\Session::get('admin'); ?></a>
					<dl class="layui-nav-child">
						<!-- 二级菜单 -->
						<dd>
							<a onclick="xadmin.open('修改密码','/index/User/modpass',500,300)">修改密码</a></dd>
						<dd>
							<a href="/index/User/esc">退出</a></dd>
					</dl>
				</li>
				<li class="layui-nav-item to-index">
					<a href="/">前台首页</a></li>
			</ul>
		</div>
		<!-- 顶部结束 -->
		<!-- 中部开始 -->
		<!-- 左侧菜单开始 -->
		<div class="left-nav">
			<div id="side-nav">
				<ul id="nav">
					<li>
						<a href="javascript:;">
							<i class="iconfont left-nav-li" lay-tips="基础管理">&#xe6b8;</i>
							<cite>基础管理</cite>
							<i class="iconfont nav_right">&#xe697;</i></a>
						<ul class="sub-menu">
							<li>
								<a onclick="xadmin.add_tab('管理员','/index/User/user')">
									<i class="iconfont">&#xe6b8;</i>
									<cite>管理员</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('选项分组','/index/Basics/group')">
									<i class="iconfont">&#xe6b8;</i>
									<cite>选项分组</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('选项编辑','/index/Basics/type')">
									<i class="iconfont">&#xe6b8;</i>
									<cite>选项编辑</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('任务管理','/index/Task/task')">
									<i class="iconfont">&#xe6b8;</i>
									<cite>任务管理</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('账号管理','/index/Basics/account')">
									<i class="iconfont">&#xe6b8;</i>
									<cite>账号管理</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('设备','/index/Basics/device')">
									<i class="iconfont">&#xe70e;</i>
									<cite>设备</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('控件','/index/Basics/widget')">
									<i class="iconfont">&#xe70e;</i>
									<cite>控件</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('客户','/index/Basics/customer')">
									<i class="iconfont">&#xe70e;</i>
									<cite>客户</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('大号','/index/Task/taskCol')">
									<i class="iconfont">&#xe6b8;</i>
									<cite>大号</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('行业','/index/Base/industry')">
									<i class="iconfont">&#xe6db;</i>
									<cite>行业</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('位置','/index/Base/position')">
									<i class="iconfont">&#xe70e;</i>
									<cite>位置</cite></a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:;">
							<i class="iconfont left-nav-li" lay-tips="消息内容管理">&#xe6ba;</i>
							<cite>消息内容管理</cite>
							<i class="iconfont nav_right">&#xe697;</i></a>
						<ul class="sub-menu">
							<li>
								<a onclick="xadmin.add_tab('评论','/index/Msg/pl')">
									<i class="iconfont">&#xe6fc;</i>
									<cite>评论</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('私信','/index/Msg/priv')">
									<i class="iconfont">&#xe713;</i>
									<cite>私信</cite></a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:;">
							<i class="iconfont left-nav-li" lay-tips="统计管理">&#xe6b8;</i>
							<cite>统计管理</cite>
							<i class="iconfont nav_right">&#xe697;</i></a>
						<ul class="sub-menu">
							<li>
								<a onclick="xadmin.add_tab('运营号曲线统计','/index/Base/chart')">
									<i class="iconfont">&#xe757;</i>
									<cite>运营号曲线统计</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('采集用户统计','/index/Base/user')">
									<i class="iconfont">&#xe70b;</i>
									<cite>采集用户统计</cite></a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:;">
							<i class="iconfont left-nav-li" lay-tips="图标字体">&#xe6b4;</i>
							<cite>图标字体</cite>
							<i class="iconfont nav_right">&#xe697;</i></a>
						<ul class="sub-menu">
							<li>
								<a onclick="xadmin.add_tab('图标对应字体','/index/User/unicode')">
									<i class="iconfont">&#xe6a7;</i>
									<cite>图标对应字体</cite></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<!-- <div class="x-slide_left"></div> -->
		<!-- 左侧菜单结束 -->
		<!-- 右侧主体开始 -->
		<div class="page-content">
			<div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
				<ul class="layui-tab-title">
					<li class="home">
						<i class="layui-icon">&#xe68e;</i>我的桌面</li>
				</ul>
				<div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
					<dl>
						<dd data-type="this">关闭当前</dd>
						<dd data-type="other">关闭其它</dd>
						<dd data-type="all">关闭全部</dd>
					</dl>
				</div>
				<div class="layui-tab-content">
					<div class="layui-tab-item layui-show">
						<iframe src="/index/User/welcome" frameborder="0" scrolling="yes" class="x-iframe"></iframe>
					</div>
				</div>
				<div id="tab_show"></div>
			</div>
		</div>
		<div class="page-content-bg"></div>
		<style id="theme_style"></style>
		<!-- 右侧主体结束 -->
	</body>
	<script>
		function ctrlScript(sign) {
			$.post('/dyOper?action=setScriptStatus', {
				'sign': sign
			}, function(j) {
				if (j.status == 'success') {
					layer.msg(j.msg == 0 ? '已关闭' : '已启动');
				}
				if (j.status == 'error') {
					layer.msg('设置失败，状态未更改');
				}
			}, 'json');
		}
	</script>
</html>
