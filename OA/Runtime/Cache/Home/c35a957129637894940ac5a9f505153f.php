<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>进程管理</title>
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
               <span class="one">当前位置是：项目主管-》进度管理</span>
               <span class="two"><a href="<?php echo U('Home/Develop/task_list');?>">【返回】</a></span>
           </div>
           <div class="bottom">
           <form action="/Company_crm/index.php/Home/Develop/task_process" method="post" enctype="multipart/form-data">
               <table class="table_2" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr>
                    <td>任务名称</td>
                    <td><?php echo ($arr['task_name']); ?></td>
                </tr>  
                  <tr>
                    <td>任务进度</td>
                    <td>
                            <?php if($arr["status"] == 0): ?>未开启
                                       <?php elseif($arr["status"] == 1 ): ?>
                                       进行中
                                       <?php elseif($arr["status"] == 2 ): ?>
                                       超期
                                       <?php else: ?>
                                       已完成<?php endif; ?>
                    </td>
                </tr>       
                <tr>
                    <td>任务开始时间</td>
                    <td><?php echo ($arr['task_ctime']); ?></td>
                </tr>
                 <tr>
                    <td>任务结束时间</td>
                    <td><?php echo ($arr['task_ltime']); ?></td>
                </tr>    
                <tr>
                    <td colspan="2" align="center">
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
</script>
<script type="text/javascript">
    CKEDITOR.replace('content',{
        toolbar : 'Full',
        uiColor : '#9AB8F3',
        height:'200'
    });
</script>


</html>