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
<script>
  $(function()
		  {
	         $("#imgs").diyUpload({
	        	 
	               url:"/Company_crm/index.php/Home/Client/uploadfile",//处理文件上传的路径
	               success:function(d){
	            	    $("#proing").val(d.uploadfile)
	            	   //alert(d.uploadfile);
	               },
	               error:function(err){
	            	   console.info(err);
	               }
	        	 
	         })
	  
		  });

</script>
    </head>
     <body>
       <div class="list_box">
           <div class="header">
               <span class="one">当前位置是：客户-》录入售后工单</span>
           </div>
           <div class="bottom">
           <form action="/Company_crm/index.php/Home/Client/shouhou_edit" method="post" enctype="multipart/form-data"  onsubmit="return check();">
               <table class="table_2" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr>
                     <input type="hidden" name="uploadfile"   id="proing" />
                     <input type="hidden" name="p"  value="<?php echo ($p); ?>"  />
                     <input type="hidden" name="id"  value="<?php echo ($catearr["id"]); ?>" />
                    <td>售后工单名称</td>
                    <td>
                              <input type="text"   name=" title"  id="title"   value="<?php echo ($catearr["title"]); ?>" style="width:200px;" />
                    </td>
                </tr>
                <tr>
                    <td>工单问题</td>
                    <td>
                          <textarea cols="40" rows="10"  name=" description" id="content"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>上传附件</td>
                    <td>
                            <div id="imgs"></div>
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
    function check(){
    	var title=$("#title").val();
    	var content=$("#content").val();
    	if(title==""){
    		  alert("售后工单名称不能为空");
    		  return false;
    	｝
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