<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>进度管理</title>

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
               <span class="one">当前位置是:项目主管>>任务管理</span>
           </div>
           <div class="main">
            <form action="/Company_crm/index.php/Home/Project/process_list" method="get" class="form">
                   任务名称： <input type="text" name="jd" value="<?php echo ($title); ?>"  />&nbsp;        
                <input type="submit" value="查询" />
               </form>
               
           </div>
           <div class="bottom">
               <table class="table_1" border="1" cellspacing="0" bordercolor="#CCCCCC">
                    <tbody><tr style="font-weight: bold;" class="character">
                        <td>序号</td>
                        <td>任务名称</td>                                                                                    
                        <td>任务进度</td>                     
                        <td>开始时间</td>
                        <td>结束时间</td>                                                                 
                        <td align="center">操作管理</td>
                    </tr>
                    <?php if(is_array($cont)): $i = 0; $__LIST__ = $cont;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><tr id="product1">
                        <td><?php echo ($vv['task_id']); ?><input type="checkbox"  class="curid" name="ids[]" value="<?php echo ($vv['task_id']); ?>"></td>
                        <td><?php echo ($vv['task_name']); ?></td>                     
                        <td>
                               <?php if($vv["status"] == 0): ?>未开启
                                       <?php elseif($vv["status"] == 1 ): ?>
                                       进行中
                                       <?php elseif($vv["status"] == 2 ): ?>
                                       超期
                                       <?php else: ?>
                                       已完成<?php endif; ?>
                        </td>           
                        <!--<td><?php echo ($vv['kehu_name']); ?></td> -->                          
                        <td><?php echo ($vv['task_ctime']); ?></td>                      
                        <td> 
                                 <?php echo ($vv['task_ltime']); ?>
                        </td>
                        <td>
	                        <a href="/Company_crm/index.php/Home/Project/process_edit/p/<?php echo ($p); ?>/id/<?php echo ($vv['task_id']); ?>">修改 </a>
	                        <a href="javascript:delone(<?php echo ($vv['task_id']); ?>,<?php echo ($p); ?>);">删除</a><br>
                       </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <tr>
                        <td  style="height:50px;" >
                         <input type="checkbox" onClick="selAll(this);">
		                   <a href="javascript:delAll();">全删</a>
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
   		      $.post("<?php echo U('Project/process_delone');?>",{"act":"del","ids":ids},function(d){
   		    	  alert(d.info);
   		    	  location.href="<?php echo U('Home/Project/process_list/p/"+curp+"');?>";
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
   	 $.post("<?php echo U('Project/process_delall');?>",{"act":"delall","idstr":idstr},function(d){
   		 alert(d.info);
   		 location.href="<?php echo U('Project/process_list');?>";
   	 },"json");
    }
    
</script>
</html>