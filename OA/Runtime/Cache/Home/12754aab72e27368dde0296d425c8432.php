<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加新权限|<?php echo ($configcache['Title']); ?></title>
        <link rel="stylesheet" type="text/css" href="/Company_crm/Public/css/content.css"  />
        <link rel="stylesheet" type="text/css" href="/Company_crm/Public/css/public.css"  />
        <script type="text/javascript" src="/Company_crm/Public/js/jquery.js"></script>
        <script type="text/javascript" src="/Company_crm/Public/js/Public.js"></script>
        <script type="text/javascript" src="/Company_crm/Public/js/winpop.js"></script>
        <script type="text/javascript" src="/Company_crm/Public/js/check.js"></script>
<script>
$(document).ready(function() {
	$('.button').click(function() {
		var sid=$('#dl dd .select').val();
		var cname=$('#dl dd .qtext').val();
		var description=$('#dl dd .textarea').val();
		var status=$('#dl dd input:checked').val();

	    if (!tcheck(sid,'','请选择所属目录')) { return false; }		
		if (!tcheck(cname,'','请填写规则标识')) { return false; }
		if (!tcheck(description,'','请填写规则名称')) { return false; }
	});
});
</script>
</head>
<body>
<form action="/Company_crm/index.php/Home/Auth/auth_add"  method="post">
<div id="content">
	<dl id="dl">
    	<dt>添加权限/功能</dt>
        <dd>
        	<span class="dd_left">权限分类：</span>
            <span class="dd_right">
            	<select name="flagname" class="select">
                	<option value="">顶级目录</option>
                    <?php if(is_array($volist)): foreach($volist as $key=>$vo): ?><option value="<?php echo ($vo["title"]); ?>"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; ?>
                </select><font>* 选择所属目录</font>
            </span>
        </dd>
        <dd>
        	<span class="dd_left">规则标识：</span>
        	<span class="dd_right"><input type="text" name="name"  style="width:200px;" class="qtext" /><font>* 输入如：Admin/Index/index</font></span>
        </dd>
        <dd>
        	<span class="dd_left">规则名称：</span>
            <span class="dd_right"><textarea name="title" class="textarea"></textarea></span>
        </dd>
        <dd>
        	<span class="dd_left">状态：</span>
            <span class="dd_right"><label><input type="radio" name="status" value="1" checked /> 有效</label><label><input type="radio" name="status" value="0" /> 无效</label></span>
        </dd>
        <dd><input type="submit" class="button"  id="button" value="提 交" /></dd>
    </dl>
</div>
</form>
</body>
</html>