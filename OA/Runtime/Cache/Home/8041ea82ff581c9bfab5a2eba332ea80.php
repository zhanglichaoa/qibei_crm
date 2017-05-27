<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>修改项目</title>
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
               <span class="one">当前位置是：售前管理-》修改项目信息</span>
               <span class="two"><a href="<?php echo U('Home/Shouqian/products_list');?>">【返回】</a></span>
           </div>
           <div class="bottom">
           <form action="/Company_crm/index.php/Home/Shouqian/products_edit" method="post" enctype="multipart/form-data"  onsubmit="return check();">
               <table class="table_2" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr>
                     <input type="hidden" name="pno" value="<?php echo ($p); ?>">
                     <input type="hidden" name="project_id" value="<?php echo ($arr['project_id']); ?>">
                    <td>项目名称</td>
                    <td><input type="text" name="project_name"  id="project_name" value="<?php echo ($arr['project_name']); ?>"/></td>
                </tr>
                 <tr>
                    <td>项目开始时间</td>
                    <td><input type="text" name="begin_time"  id="begin_time"  value="<?php echo date('Y-m-d H:i:s',$arr['begin_time']);?>"/></td>
                </tr>
                <tr>
                    <td>项目结束时间</td>
                    <td><input type="text" name="end_time"  id="end_time"  value=" <?php echo date('Y-m-d H:i:s',$arr['end_time']);?>"/></td>
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
    function check(){
  	  var name=$("#project_name").val();
  	  var begintime=$("#begin_time").val();
  	  var endtime=$("#end_time").val();
  	  if(name==""){
  		    alert("项目名称不能为空");
  		    return false;
  	  }
  	  if(begintime==""){
  		    alert("开始时间不能为空");
  		    return false;
  	  }
  	  if(endtime==""){
  		   alert("结束时间不能为空");
  		   return false;
  	  }
  }
</script>
</html>