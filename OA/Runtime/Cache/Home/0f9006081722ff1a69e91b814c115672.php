<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>学生列表</title>

        <link href="/Company_crm/Public/css/mine.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="/Company_crm/Public/js/jquery-1.8.3.js"></script>
        <link rel="stylesheet" type="text/css" href="/Company_crm/Public/css/content.css"  />
        <link rel="stylesheet" type="text/css" href="/Company_crm/Public/css/public.css"  />
        <script type="text/javascript" src="/Company_crm/Public/js/jquery.js"></script>
        <script type="text/javascript" src="/Company_crm/Public/js/Public.js"></script>
        <script type="text/javascript" src="/Company_crm/Public/js/winpop.js"></script>
        <script type="text/javascript" src="/Company_crm/Public/js/check.js"></script>
 <style type="text/css">
.pages a,.pages span {
    display:inline-block;
    padding:2px 5px;
    margin:0 1px;
    border:1px solid #f0f0f0;
    -webkit-border-radius:3px;
    -moz-border-radius:3px;
    border-radius:3px;
}
.pages a,.pages li {
    display:inline-block;
    list-style: none;
    text-decoration:none; color:#58A0D3;
}
.pages a.first,.pages a.prev,.pages a.next,.pages a.end{
    margin:0;
}
.pages a:hover{
    border-color:#50A8E6;
}
.pages span.current{
    background:#50A8E6;
    color:#FFF;
    font-weight:700;
    border-color:#50A8E6;
}
       </style>
       <script >
          //添加权限
           $(document).ready(function(){
        	      $(".list_box .header .add ").click(function(){
        	    	   popload('添加权限',600,300,'/Company_crm/index.php/Home/Auth/cadd'); //调用的是winpop.js中的方法
        	    	   addDiv($('#iframe_pop'));
        	   		   popclose();
        	      });
        //修改权限的操作  
        	      $('.list_box .bottom .tr .edit').click(function(event) {
        	  		event.preventDefault();
        	  		var id=$(this).attr('href');		
        	  		if (id=='' || isNaN(id)) {
        	  			wintq('ID参数不正确',3,1000,1,'');
        	  			return false;
        	  		}else {
        	  			popload('修改权限信息',600,300,'/Company_crm/index.php/Home/Auth/cedit/id/'+id);
        	  			addDiv($('#iframe_pop'));
        	  			popclose();
        	  		}
        	  	});
        
        
               
           });
       
       </script>
    </head>
    <body>
       <div class="list_box">
           <div class="header">
               <span class="one">当前位置是:权限管理>>权限列表</span>
               <span class="two"><a href="javascript:;" class="add">【新增权限】</a></span>
           </div>
           <div class="main">
            <form action="/Company_crm/index.php/Home/Auth/auth_list" method="get" class="form">
                   权限查询： <input type="text" name="keyword" value="<?php echo ($keyword); ?>"  />&nbsp;        
                <input type="submit" value="查询" />
               </form>
               
           </div>
           <div class="bottom">
               <table class="table_1" border="1" cellspacing="0" bordercolor="#CCCCCC">
                    <tbody>
                    <tr style="font-weight: bold;" class="character">
                        <td>序号</td>
                        <td>权限分类</td>                       
                        <td>权限名称</td>                                            
                        <td>日期</td>                                                             
                        <td align="center">操作管理</td>
                    </tr>
        <!--顶级数据-->
        <?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr tr2">
            <td class="tc"><?php echo ($vo["id"]); ?></td>
            <td class="tc"><?php echo ($vo["cname"]); ?></td>
            <td><?php echo ($vo["cname"]); ?></td>                   
            <td class="tc"><?php echo ($vo["dtime"]); ?></td>
            <td class="tc fixed_w">
              <a href=" <?php echo ($vo["id"]); ?>" class="edit"><img src="/Company_crm/Public/image/edit.png" border="0" title="修改" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
              <a href=" javascript:del(<?php echo ($vo['id']); ?>,<?php echo ($p); ?>);" class="del"><img src="/Company_crm/Public/image/delete.png" border="0" title="删除" /></a>
            </td>
        </tr>
        <!--二级数据-->
        <?php if(is_array($sidlist)): $i = 0; $__LIST__ = $sidlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if($s["sid"] == $vo['id']): ?><tr class="tr">
            <td class="tc"><?php echo ($s["id"]); ?></td>
            <td></td>
            <td><?php echo ($s["cname"]); ?></td>         
            <td class="tc"><?php echo ($s["dtime"]); ?></td>
            <td class="tc fixed_w">
            <a href="<?php echo ($s["id"]); ?>" class="edit"><img src="/Company_crm/Public/image/edit.png" border="0" title="修改" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="javascript:del(<?php echo ($s["id"]); ?>,<?php echo ($p); ?>);" class="del"><img src="/Company_crm/Public/image/delete.png" border="0" title="删除" /></a></td>
        </tr><?php endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                    <tr>
                        <td  style="height:50px;" >
                        
		                </td>
		                <td colspan="9" style="text-align:center;">
                          <div class="pages"><?php echo ($pagearr); ?></div>
                        </td>
                    </tr>
                    </tbody>
               </table>
           </div>
       </div>
    </body>
    <script>
    //单删的操作
    function del(id,curp)
    {
    	   if(confirm("确定删除吗?")){
	    		   $.post("<?php echo U('Home/Auth/cdel');?>",{"act":"del","id":id},function(d){
	     	    	  alert(d.msg);
	     	    	  location.href="<?php echo U('Home/Auth/auth_list/p/"+curp+"');?>";
	     	      },"json");
    	   }
    	
    }
    //全选的操作
    function selAll(obj)
    {
   	 $(".curid").each(function(a,b){
   		   b.checked=obj.checked;   		 
   	 });  	 
    }
   //全删的操作
    function delAll()
    {
   	 var idstr="";
   	 $(".curid").each(function(i,o){
   		  if(o.checked)
   		  {
   			  idstr=idstr+o.value+",";
   		  }
   	 });   
   	 $.post("<?php echo U('Administrator/user_delall');?>",{"act":"delall","idstr":idstr},function(d){
   		 alert(d.msg);
   		 location.href="<?php echo U('Administrator/user_list');?>";
   	 },"json");
    }
    
</script>
</html>