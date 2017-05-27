<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>项目主管</title>

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
               <span class="one">当前位置是:项目主管>>工单分配列表</span>
               <span class="two"><a href="/Company_crm/index.php/Home/Project/wo_add">【添加工单】</a></span>
           </div>
           <div class="main">
            <form action="/Company_crm/index.php/Home/Project/wo_list" method="get" class="form">
                   工单名称： <input type="text" name="gongdan" value="<?php echo ($title); ?>"  />&nbsp;        
                <input type="submit" value="查询" />
               </form>
               
           </div>
           <div class="bottom">
               <table class="table_1" border="1" cellspacing="0" bordercolor="#CCCCCC">
                    <tbody><tr style="font-weight: bold;" class="character">
                        <td>序号</td>
                        <td>工单名称</td>                                                                                    
                        <td>工单内容</td>
                        <td>工单开始时间</td>
                        <td>工单的状态</td> 
                        <td>工单的优先级</td>                                                                   
                        <td align="center">操作管理</td>
                    </tr>
                    <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><tr id="product1">
                        <td><?php echo ($vv['id']); ?><input type="checkbox"  class="curid" name="ids[]" value="<?php echo ($vv['id']); ?>"></td>
                        <td><?php echo ($vv['title']); ?></td>                     
                        <td><?php echo ($vv['content']); ?></td>                      
                        <td><?php echo ($vv['ctime']); ?></td>
                        <td>
                                 <?php if($vv['status'] == 1): ?>开启
                                       <?php elseif($vv['status'] == 2): ?>
                                    解决中
                                        <?php elseif($vv['status'] == 3 ): ?>
                                     已解决   
                                      <?php else: ?>
                                        已关闭<?php endif; ?>
                        </td>
                        <td> 
                                <?php if($vv['priority'] == 1): ?>紧急
                                       <?php elseif($vv['priority'] == 2): ?>
                                   高
                                        <?php elseif($vv['priority'] == 3 ): ?>
                                    标准 
                                      <?php else: ?>
                                        低<?php endif; ?>  
                        </td>
                        <td>
	                        <a href="/Company_crm/index.php/Home/Project/wo_edit/p/<?php echo ($p); ?>/id/<?php echo ($vv['id']); ?>">修改 </a>
	                        <a href="javascript:delone(<?php echo ($vv['id']); ?>,<?php echo ($p); ?>);">删除</a><br>
	                        <a href="/Company_crm/index.php/Home/Project/task_list">进入</a>
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
   		      $.post("<?php echo U('Project/wo_delone');?>",{"act":"del","ids":ids},function(d){
   		    	  alert(d.info);
   		    	  location.href="<?php echo U('Home/Project/wo_list/p/"+curp+"');?>";
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
   	 $.post("<?php echo U('Project/wo_delall');?>",{"act":"delall","idstr":idstr},function(d){
   		 alert(d.info);
   		 location.href="<?php echo U('Project/wo_list');?>";
   	 },"json");
    }
    
</script>
</html>