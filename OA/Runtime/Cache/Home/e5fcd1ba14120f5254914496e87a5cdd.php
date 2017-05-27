<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>错误提醒物|<?php echo ($configcache['Title']); ?></title>
<link rel="stylesheet" type="text/css" href="/Company_crm/Public/css/public.css"  />
<script type="text/javascript" src="/Company_crm/Public/js/jquery.js"></script>
<script>
$(document).ready(function() {
	var nowtime=3;
	function hi() {
		if (nowtime==0) {
			window.history.go(-1);
		}
		$('#error .history').text(nowtime);
		nowtime--;
	}
	hi();
	setInterval(hi,1000);
});
</script>
</head>
<body>
<div id="error">
	<div class="img"><img src="/Company_crm/Public/images/error.jpg" border="0" /></div>
    <div class="font">
    	<?php echo ($content); ?><br />
    	<span class="history"></span>&nbsp;秒后自动返回或点击：<a href="javascript:window.history.go(-1);">上一页</a> 手动返回
    </div>
</div>
</body>
</html>