<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加权限组</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Company_crm/Public/css/mine.css" type="text/css" rel="stylesheet">
        <script src="/Company_crm/Public/js/jquery-1.12.4.js"></script>
    </head>

     <body>
       <div class="list_box">
           <div class="header">
               <span class="one">当前位置是:权限管理>>修改权限组</span>
               <span class="two"><a href='<?php echo U("Home/Auth/role_list/p/{$p}");?>'>【返回】</a></span>
           </div>
          
           <div class="bottom">
           <form method="post"   action="/Company_crm/index.php/Home/Administrator/role_edit"   onsubmit="return checksgroup();">
           		<input type="hidden" value="<?php echo ($group['id']); ?>" name="id">
           		<input type="hidden" value="<?php echo ($p); ?>" name="p">
               <table class="table_2" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr>
                    <td class="left_td">权限组名</td>
                    <td>
                        <input type="text" value="<?php echo ($group['title']); ?>" name="title"  id="title">
                    </td>
                </tr>
                <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; $pkey = $key; ?>
	                <tr>  <!--  左侧的内容 -->
		                    <td class="left_td"  style="width:100px;"><input value="<?php echo ($valarr[$key]); ?>" type="checkbox" onclick="sel(this);"><?php echo ($key); ?></td>
		                    <td><!-- 右侧的内容 -->
		                    <?php if(is_array($v)): $i = 0; $__LIST__ = $v;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?><input type="checkbox"  class="val<?php echo ($valarr[$pkey]); ?>" value="<?php echo ($x['id']); ?>" name="rules[]" <?php if(($x['title']) == $rule[$x['id']]): ?>checked<?php endif; ?>><?php echo ($x['title']); ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
		                    </td>
	                </tr><?php endforeach; endif; else: echo "" ;endif; ?> 
                <tr>
                    <td colspan="2" align="center" height="50">
                        <input type="submit" value="修改">
                    </td>
                </tr>  
               </table>
               </form>
           </div>
       </div>
    </body>
    <script>
    	function sel(obj){
    		var val=obj.value;
    		$(".val"+val).each(function(i,o){
    			o.checked=obj.checked;
    		})
    	}
    	function checksgroup(){
    		  var title=$("#title").val();
    		  if(title==""){
    			    alert("权限组名不能为空");
    			    return false;
    		  }
    		  return true;
    	}
    </script>
</html>