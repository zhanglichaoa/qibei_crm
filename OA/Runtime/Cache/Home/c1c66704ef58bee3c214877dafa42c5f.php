<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>修改小组</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Company_crm/Public/css/mine.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="/Company_crm/Public/js/jquery-1.8.3.js"></script>
    </head>

     <body>
       <div class="list_box">
           <div class="header">
               <span class="one">当前位置是：小组安排-》修改小组信息</span>
               <span class="two"><a href="<?php echo U('Home/Project/item_list');?>">【返回】</a></span>
           </div>
           <div class="bottom">
           <form action="/Company_crm/index.php/Home/Project/item_edit" method="post" enctype="multipart/form-data"  onsubmit="return check();">
               <table class="table_2" border="1" cellspacing="0" bordercolor="#CCCCCC">
                     <tr>
                     <input type="hidden"  value="<?php echo ($arr['item_id']); ?>"  name="item_id">
                     <input type="hidden" value="<?php echo ($p); ?>" name="pno">
                    <td>小组名称</td>
                    <td><input type="text"  name="item_name"  id="item_name"  value="<?php echo ($arr['item_name']); ?>"  style="width:230px; " /></td>
                </tr>
                <tr>
                    <td>小组成员</td>
                    <td>
                         <textarea name="item_chengyuan" cols="25"  rows="2"  id="item_chengyuan">
                                  <?php echo ($arr['item_chengyuan']); ?>
                         </textarea>                   
                     /* 小组成员之间用逗号来分割开,例如: aa,bb,cc */</td>
                </tr>
                <tr>
                    <td>小组负责人</td>
                    <td><input type="text"  name="item_fzr"  id="item_fzr" value="<?php echo ($arr['item_fzr']); ?>"  style="width:230px; " /></td>
                </tr>
                <tr>
                    <td>主要负责的内容</td>
                    <td>
                           <textarea name="item_content" cols="25"  rows="2"  id="item_content">
                                  <?php echo ($arr['item_content']); ?>
                           </textarea>
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
    	var item_name=$("#item_name").val();
  	    var item_chengyuan=$("#item_chengyuan").val();
  	    var item_fzr=$("#item_fzr").val();
  	    var item_content=$("#item_content").val();
  	  if(item_name==""){
  		     alert("小组名称不能为空");
  		     return false;
  	  }
  	  if(item_chengyuan==""){
		     alert("小组成员不能为空");
		     return false;
	      }
  	  if(item_fzr==""){
		     alert("小组负责人不能为空");
		     return false;
	      }
  	  if(item_content==""){
		     alert("主要负责的内容不能为空");
		     return false;
	      } 	  
    }
</script>
</html>