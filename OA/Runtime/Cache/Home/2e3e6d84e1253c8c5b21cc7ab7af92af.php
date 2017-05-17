<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>维护客户列表</title>

        <link href="/Company_crm/Public/css/mine.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="/Company_crm/Public/js/jquery-1.8.3.js"></script>
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
    </head>
    <body>
       <div class="list_box">
           <div class="header">
               <span class="one">当前位置是:售前>>维护客户列表</span>
             
           </div>
           <div class="main">
            <form action="/Company_crm/index.php/Home/Shouqian/kehu_list" method="get" class="form">
                   客户名称： <input type="text" name="kehu" value="<?php echo ($title); ?>"  />&nbsp;        
                <input type="submit" value="查询" />
               </form>
               
           </div>
           <div class="bottom">
               <table class="table_1" border="1" cellspacing="0" bordercolor="#CCCCCC">
                    <tbody><tr style="font-weight: bold;" class="character">
                        <td>序号</td>
                        <td>客户名称</td>                       
                        <td>客户公司</td>                                            
                        <td>客户电话</td>     
                        <td>客户负责人</td>
                        <td>创建时间</td>    
                                                                            
                    </tr>
                    <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><tr id="product1">
                        <td><?php echo ($vv['id']); ?><input type="checkbox" class="curid" name="ids[]" value="<?php echo ($vv['id']); ?>"></td>
                        <td><?php echo ($vv['kehu_name']); ?></td>                     
                        <td><?php echo ($vv['companyname']); ?></td>                                   
                        <td><?php echo ($vv["kehu_phone"]); ?></td>
                        <td><?php echo ($vv["kehu_fzr"]); ?></td>
                        <td><?php echo ($vv["ctime"]); ?></td>  
                                        
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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
    //单删的操作：
    function delone(ids,curp){
   	   if(confirm('确定删除吗？'))
   	   {
   		      $.post("<?php echo U('Home/Shouqian/products_del');?>",{"act":"del","ids":ids},function(d){
   		    	  alert(d.msg);
   		    	  location.href="<?php echo U('Home/Shouqian/products_list/p/"+curp+"');?>";
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
   	 $.post("<?php echo U('Shouqian/products_delall');?>",{"act":"delall","idstr":idstr},function(d){
   		 alert(d.msg);
   		 location.href="<?php echo U('Shouqian/products_list');?>";
   	 },"json");
    }
    
</script>
</html>