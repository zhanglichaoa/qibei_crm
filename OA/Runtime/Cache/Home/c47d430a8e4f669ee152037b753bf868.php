<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <link href="/Company_crm/Public/css/admin.css" type="text/css" rel="stylesheet" />
        <script language=javascript>
            function expand(el)
            {
                childobj = document.getElementById("child" + el);

                if (childobj.style.display == 'none')
                {
                    childobj.style.display = 'block';
                }
                else
                {
                    childobj.style.display = 'none';
                }
                return;
            }
        </script>
    </head>
    <body>
    
           <table height="100%" cellspacing=0 cellpadding=0 width=170 
               background=/Company_crm/Public/img/menu_bg.jpg border=0>
               <tr>
                <td valign=top align=middle>
                    <table cellspacing=0 cellpadding=0 width="100%" border=0>

                        <tr>
                            <td height=10></td></tr></table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>

                        <tr height=22>
                            <td style="padding-left: 30px" background=/Company_crm/Public/img/menu_bt.jpg><a 
                                    class=menuparent onclick=expand(1) 
                                    href="javascript:void(0);">系统管理员</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child1 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Administrator/role_list');?>" 
                                   target='right'>角色管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Administrator/user_list');?>" 
                                   target='right'>人员管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Auth/auth_list');?>" 
                                   target='right'>权限列表</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr>                         
                    </table>
            
        <table cellspacing=0 cellpadding=0 width=150 border=0>
                        <tr height=22>
                            <td style="padding-left: 30px" background=/Company_crm/Public/img/menu_bt.jpg><a 
                                    class=menuparent onclick=expand(3) 
                                    href="javascript:void(0);">售前</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child3 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Shouqian/products_list');?>" 
                                   target='right'>项目管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Shouqian/kehu_list');?>" 
                                   target='right'>维护客户</a></td></tr>
                      
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                   <table cellspacing=0 cellpadding=0 width=150 border=0>
                        <tr height=22>
                            <td style="padding-left: 30px" background=/Company_crm/Public/img/menu_bt.jpg><a 
                                    class=menuparent onclick=expand(4) 
                                    href="javascript:void(0);">项目主管</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child4 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Project/item_list');?>" 
                                   target='right'>小组安排</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Project/wo_list');?>" 
                                   target='right'>工单分配</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Project/task_list');?>" 
                                   target='right'>任务管理</a></td></tr>
                                     <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Project/process_list');?>" 
                                   target='right'>进度管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Major/major_add');?>" 
                                   target='right'>工单提醒</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Major/major_pvs');?>" 
                                   target='right'>任务提醒</a></td></tr>
                               
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>
                        <tr height=22>
                            <td style="padding-left: 30px" background=/Company_crm/Public/img/menu_bt.jpg><a 
                                    class=menuparent onclick=expand(5) 
                                    href="javascript:void(0);">开发</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child5 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>

                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Develop/task_list');?>" 
                                   target='right'>任务管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Develop/process_list');?>" 
                                   target='right'>进度管理</a></td></tr>
                             <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Banji/banji_add');?>" 
                                   target='right'>任务提醒</a></td></tr>      
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>

                        <tr height=22>
                            <td style="padding-left: 30px" background='/Company_crm/Public/img/menu_bt.jpg'><a 
                                    class=menuparent onclick=expand(6) 
                                    href="javascript:void(0);">客户</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child6 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>

                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Client/client_list');?>" 
                                   target='right'>信息维护</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Client/shouhou_list');?>" 
                                   target='right'>录入售后工单</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Result/result_add');?>" 
                                   target='right'>工单提醒</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="/Company_crm/Public/img/menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo U('Home/Result/result_show');?>" 
                                   target='right'>进度查看</a></td></tr>
                        
                      </table>    
                    
                    
    </body>
</html>