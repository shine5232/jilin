<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\phpstudy\WWW\dy\public/../application/index\view\user\welcome.html";i:1567408466;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>欢迎页</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="stylesheet" href="../../static/css/font.css">
        <link rel="stylesheet" href="../../static/css/xadmin.css">
        <script src="../../static/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="../../static/js/xadmin.js"></script>
		<script type="text/javascript" src="../../static/js/echarts.min.js"></script>
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>	
		<div id="main" style="width:600px;height:400px;"></div>
        <script>
			var myChart = echarts.init(document.getElementById("main"));
			option = {
				title:{
					text:'关注速度'
				},
				tooltip : {
					formatter: "{a} <br/>{b} : {c}%"
				},
				series: [
					{
						name: '业务指标',
						type: 'gauge',
						detail: {formatter:'{value}%'},
						data: [{value: 50, name: '完成率'}]
					}
				]
			};
			
			option.series[0].data[0].value = (Math.random() * 100).toFixed(2) - 0;
			myChart.setOption(option, true);
			
			setInterval(function () {
				option.series[0].data[0].value = (Math.random() * 100).toFixed(2) - 0;
				myChart.setOption(option, true);
			},1000);

		</script>
    </body>
</html>