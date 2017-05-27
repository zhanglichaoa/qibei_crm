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

	$('#dtime').datepicker({showOn: "both", buttonImage: "/Company_crm/Public/images/datepicker.gif", buttonImageOnly: true});
	$('#end_time').datepicker({showOn: "both", buttonImage: "/Company_crm/Public/images/datepicker.gif", buttonImageOnly: true});
})
</script>
    </head>

     <body>
       <div class="list_box">
           <div class="header">
               <span class="one">当前位置是：售前管理-》添加客户信息</span>
               <span class="two"><a href="<?php echo U('Home/Shouqian/kehu_list');?>">【返回】</a></span>
           </div>
           <div class="bottom">
           <form action="/Company_crm/index.php/Home/Shouqian/kehu_add" method="post" enctype="multipart/form-data" onsubmit="return checkuser();">
               <table class="table_2" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr>
                    <td>客户名称</td>
                    <td><input type="text" name="xlr_name"   id="xlr_name" style="width:200px;" /></td>
                </tr>
                <tr>
                    <td>客户公司</td>
                    <td><input type="text" name="companyname"   id="companyname"  style="width:200px;" /></td>
                </tr>
                <tr>
                    <td>客户手机</td>
                    <td><input type="text" name="tel"   id="tel"  style="width:200px;" /></td>
                </tr>
                <tr>
                    <td>客户邮箱</td>
                    <td><input type="text" name="email"  id="email"  style="width:200px;" /></td>
                </tr>
                <tr>
                    <td>客户负责人</td>
                    <td>
                            <input type="text" name="fzr"  id="fzr"  style="width:200px;" />
                    </td>
                </tr>
                <tr>
                    <td>客户性别</td>
                    <td>
                            <input type="radio"  name="sex"  value="0"  checked>男
                            <input type="radio" name="sex" value="1">女
                    </td>
                </tr> 
                <tr>
                    <td>录入时间</td>
                    <td>
                           <input type="text" name="dtime"   id="dtime" style="width:200px;" />
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
    function checkuser(){
    	     var name=$("#xlr_name").val();
		   	 var gs=$("#companyname").val();
		   	 var tel=$("#tel").val();
		   	 var email=$("#email").val();
		   	 var fzr=$("#fzr").val();
		   	 var time=$("#dtime").val();
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