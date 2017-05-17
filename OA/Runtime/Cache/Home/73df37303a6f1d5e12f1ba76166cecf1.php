<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加客户</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Company_crm/Public/css/mine.css" type="text/css" rel="stylesheet">
<link  rel="stylesheet" type="text/css" href="/Company_crm/Public/css/ui.datepicker.css"/>
<script type="text/javascript" src="/Company_crm/Public/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="/Company_crm/Public/js/ui.datepicker.js"></script>
<script type="text/javascript" src="/Company_crm/Public/js/ui.datepicker-zh-cn.js"></script>
<script>
$(function() {

	$('#begin_time').datepicker({showOn: "both", buttonImage: "/Company_crm/Public/images/datepicker.gif", buttonImageOnly: true});
	$('#end_time').datepicker({showOn: "both", buttonImage: "/Company_crm/Public/images/datepicker.gif", buttonImageOnly: true});
})
</script>
    </head>

     <body>
       <div class="list_box">
           <div class="header">
               <span class="one">当前位置是：客户管理-》添加客户信息</span>
               <span class="two"><a href="<?php echo U('Home/Client/client_list');?>">【返回】</a></span>
           </div>
           <div class="bottom">
           <form action="/Company_crm/index.php/Home/Client/client_add" method="post" enctype="multipart/form-data">
               <table class="table_2" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr>
                    <td>客户名称</td>
                    <td><input type="text" name="xlr_name" /></td>
                </tr>
                <tr>
                    <td>客户公司</td>
                    <td><input type="text" name="companyname" /></td>
                </tr>
                <tr>
                    <td>手机</td>
                    <td><input type="text" name="tel" /></td>
                </tr>
                <tr>
                    <td>邮箱</td>
                    <td><input type="text" name="email" /></td>
                </tr>
                <tr>
                    <td>性别</td>
                    <td>
                            <input type="radio"  name="sex"  value="0"  checked>男
                            <input type="radio"  name="sex"  value="1"  >女
                    </td>
                </tr> 
                <tr>
                    <td>录入时间</td>
                    <td>
                           <input type="text" name="dtime"  id="begin_time"/>
                    </td>
                </tr> 
                           
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="添加">
                        <input type="button" onclick="re();" value="返回">
                    </td>
                </tr>    
               </table>
               </form>
           </div>
       </div>
    </body>
<script>
    function re(){
    	location.href="javascript:history.go(-1)";//返回上一页
    }
</script>
</html>