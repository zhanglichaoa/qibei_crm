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
               <span class="one">当前位置是：售前管理-》修改客户信息</span>
               <span class="two"><a href="<?php echo U('Home/Shouqian/kehu_list');?>">【返回】</a></span>
           </div>
           <div class="bottom">
           <form action="/Company_crm/index.php/Home/Shouqian/kehu_edit" method="post" enctype="multipart/form-data" onsubmit="return checkusr();">
               <table class="table_2" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr>
                     <input type="hidden" name="id"  value="<?php echo ($arr["id"]); ?>">
                     <input type="hidden" name="p" value="<?php echo ($p); ?>">
                    <td>客户名称</td>
                    <td><input type="text" name="xlr_name"  id="xlr_name"  value="<?php echo ($arr["xlr_name"]); ?>"   style="width:200px;" /></td>
                </tr>
                <tr>
                    <td>客户公司</td>
                    <td><input type="text" name="companyname" id="companyname"  value="<?php echo ($arr["companyname"]); ?>"  style="width:200px;" /></td>
                </tr>
                <tr>
                    <td>手机</td>
                    <td><input type="text" name="tel"  id="tel"  value="<?php echo ($arr["tel"]); ?>" style="width:200px;" /></td>
                </tr>
                <tr>
                    <td>邮箱</td>
                    <td><input type="text" name="email"  id="email"   value="<?php echo ($arr["email"]); ?>" style="width:200px;" /></td>
                </tr>
                <tr>
                    <td>性别</td>
                    <td>
                             <?php if($arr["sex"] == 0): ?><input type="radio"  name="sex"  value="0"  checked >男
                                      <input type="radio"  name="sex"  value="1" >女
                                      <?php else: ?>
                                      <input type="radio"  name="sex"  value="0" >男
                                      <input type="radio"  name="sex"  value="1"  checked >女<?php endif; ?>                            
                    </td>
                </tr> 
                <tr>
                    <td>录入时间</td>
                    <td>
                           <input type="text" name="dtime"  id="begin_time"  value="<?php echo ($arr["dtime"]); ?>" style="width:200px;" />
                    </td>
                </tr> 
                           
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="修改">
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
    function checkusr(){
    	 var name=$("#xlr_name").val();
	   	 var gs=$("#companyname").val();
	   	 var tel=$("#tel").val();
	   	 var email=$("#email").val();
	   	 var fzr=$("#fzr").val();
	   	 var time=$("#begin_time").val();
	   	 if(name==""){
	   		   alert("客户姓名不能为空");
	   		   return false;
	   	 }
	   	 if(gs==""){
		  		   alert("公司名称不能为空");
		  		   return false;
	 	 }
	   	 if(tel==""){
		  		   alert("手机不能为空");
		  		   return false;
	 	 }
	   	 if(email==""){
		  		   alert("客户邮箱不能为空");
		  		   return false;
	 	 }
	   	 if(fzr==""){
		  		   alert("客户负责人不能为空");
		  		   return false;
	 	 }
	   	 if(time==""){
		  		   alert("客户录入时间不能为空");
		  		   return false;
	 	 }  	 
    }
</script>
</html>