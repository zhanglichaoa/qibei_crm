<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>录入的售后工单</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Company_crm/Public/css/mine.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/Company_crm/Public/ckeditor/ckeditor.js"></script>    

<script type="text/javascript" src="/Company_crm/Public/js/jquery-1.8.3.js"></script>
<link rel="stylesheet" type="text/css" href="/Company_crm/Public/css/webuploader.css">
<link rel="stylesheet" type="text/css" href="/Company_crm/Public/css/diyUpload.css">
<script type="text/javascript" src="/Company_crm/Public/js/webuploader.html5only.min.js"></script>
<script type="text/javascript" src="/Company_crm/Public/js/diyUpload.js"></script>
<script type="text/javascript" src="/Company_crm/Public/js/ui.datepicker.js"></script>
<script type="text/javascript" src="/Company_crm/Public/js/ui.datepicker-zh-cn.js"></script>
<link  rel="stylesheet" type="text/css" href="/Company_crm/Public/css/ui.datepicker.css"/>
<script>
  $(function()
		  {
	         $("#imgs").diyUpload({	        	 
	               url:"/Company_crm/index.php/Home/Client/uploadfiles",//处理文件上传的路径
	               success:function(d){
	            	   $("#proing").val(d.upimg);
	            	     // alert(d.upimg);
	               },
	               error:function(err){
	            	   console.info(err);
	               }	        	 
	         })	  
		  });

</script>
<script>
$(function() {

	$('#dtime').datepicker({showOn: "both", buttonImage: "/Company_crm/Public/images/datepicker.gif", buttonImageOnly: true});
	//$('#end_time').datepicker({showOn: "both", buttonImage: "/Company_crm/Public/images/datepicker.gif", buttonImageOnly: true});
})
</script>
    </head>
     <body>
       <div class="list_box">
           <div class="header">
               <span class="one">当前位置是：客户-》录入售后工单</span>
           </div>
           <div class="bottom">
           <form action="/Company_crm/index.php/Home/Client/shouhou_add" method="post" enctype="multipart/form-data"  onsubmit="return checkshgd();">
               <table class="table_2" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr>
                    <input type="hidden" name="img"   id="proing" />
                    <td>售后工单名称</td>
                    <td>
                              <input type="text"   name=" title"  id="title" style="width:200px;" />
                    </td>
                </tr>
                <tr>
                    <td>工单问题</td>
                    <td>
                          <textarea cols="40" rows="10"  name="content" id="content"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>上传附件</td>
                    <td>
                            <div id="imgs"  name="imgs"></div>
                    </td>
                </tr>  
                <tr>
                    <td>上传时间</td>
                    <td>
                            <input type="text" name="dtime"  id="dtime"  style="width:200px;" />
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
    function checkshgds(){
    	   var title=$("#title").val();
    	   var content=$("#content").val();
    	   var dtime=$("#dtime").val();
    	   if(title==""){
    		    alert("售后工单名称不能为空");
    		    return false;
    	   }
    	   if(dtime==""){
    		   alert("售后工单时间没有选择");
    		   return false;
    	   }	   
    	   return true;
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