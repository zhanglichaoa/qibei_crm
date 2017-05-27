<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加工单</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Company_crm/Public/css/mine.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/Company_crm/Public/ckeditor/ckeditor.js"></script>    
   
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
               <span class="one">当前位置是：项目主管-》添加工单信息</span>
               <span class="two"><a href="<?php echo U('Home/Project/wo_list');?>">【返回】</a></span>
           </div>
           <div class="bottom">
           <form action="/Company_crm/index.php/Home/Project/wo_add" method="post" enctype="multipart/form-data"  onsubmit="return checkgd();">
               <table class="table_2" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr>
                    <td>工单名称</td>
                    <td><input type="text"  name="title"  id="title"  style="width:200px;"/></td>
                </tr>
                <tr>
                    <td>工单内容</td>
                    <td>
                          <textarea cols="40" rows="10"  name="content"  id="content"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>工单的状态</td>
                    <td>
                               <select name="status"  id="status">
                                           <option value="0">--请选择--</option>                                  
                                            <option value="1">开启</option>
                                            <option value="2">解决中</option>
                                            <option value="3">已解决</option>
                                            <option value="4">已关闭</option>
                               </select>
                    </td>
                </tr>
                <tr>
                    <td>工单的优先级</td>
                    <td>
                             <select name="priority"  id="priority">
                                           <option value="0">--请选择--</option>                                  
                                            <option value="1">紧急</option>
                                            <option value="2">高</option>
                                            <option value="3">标准</option>
                                            <option value="4">低</option>
                               </select>
                    </td>
                </tr>   
                <tr>
                    <td>工单的开始时间</td>
                    <td><input type="text" name="ctime"  id="begin_time"  style="width:200px;"/></td>
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
    function checkgd(){
    	  var title=$("#title").val();
    	  var content=$("#content").val();
    	  var status=$("#status").val();
    	  var priority=$("#priority").val();
    	  var begin_time=$("#begin_time").val();
    	  if(title==""){
    		    alert("工单名称不能为空");
    		    return false;
    	  }
    	  if(status=="0"){
    		    alert("请选择工单的状态");
    		    return false;
    	  }
    	  if(priority=="0"){
  		    alert("请选择工单的优先级");
  		    return false;
  	     }
    	  if(begin_time==""){
  		    alert("工单时间不能为空");
  		    return false;
  	     }
    
    
    }
    
    
    
</script>
<script type="text/javascript">
    CKEDITOR.replace('content',{
        toolbar : 'Full',
        uiColor : '#9AB8F3',
        height:'200'
    });
</script>


</html>