<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <link href="css/admin.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <table cellspacing=0 cellpadding=0 width="100%" align=center border=0>
            <tr height=28>
                <td background=/Company_crm/Public/img/title_bg1.jpg>当前位置: </td></tr>
            <tr>
                <td bgcolor=#b1ceef height=1></td></tr>
            <tr height=20>
                <td background=/Company_crm/Public/img/shadow_bg.jpg></td></tr></table>
        <table cellspacing=0 cellpadding=0 width="90%" align=center border=0>
            <tr height=100>
                <td align=middle width=100><img height=100 src="/Company_crm/Public/img/admin_p.gif" 
                                                width=90></td>
                <td width=60>&nbsp;</td>
                <td>
                    <table height=100 cellspacing=0 cellpadding=0 width="100%" border=0>

                        <tr>
                            <td>当前时间：<?php echo ($time); ?></td></tr>
                        <tr>
                            <td style="font-weight: bold; font-size: 16px"><?php echo ($uname); ?></td></tr>
                        <tr>
                            <td>欢迎进入网站管理中心！</td></tr></table></td></tr>
            <tr>
                <td colspan=3 height=10></td></tr></table>
        <table cellspacing=0 cellpadding=0 width="95%" align=center border=0>
            <tr height=20>
                <td></td></tr>
            <tr height=22>
                <td style="padding-left: 20px; font-weight: bold; color: #ffffff" 
                    align=middle background=/Company_crm/Public/img/title_bg2.jpg>您的相关信息</td></tr>
            <tr bgcolor=#ecf4fc height=12>
                <td></td></tr>
            <tr height=20>
                <td></td></tr></table>
        <table cellspacing=0 cellpadding=2 width="95%" align=center border=0>
            <tr>
                <td align=right width=100>登陆帐号：</td>
                <td style="color: #880000"><?php echo ($arr['user_name']); ?></td></tr>
            <tr>
                <td align=right>真实姓名：</td>
                <td style="color: #880000"><?php echo ($arr["user_xingming"]); ?></td></tr>
            <tr>
                <td align=right>注册时间：</td>
                <td style="color: #880000"><?php echo ($arr["ctime"]); ?></td></tr>
            <tr>
                <td align=right>密码：</td>
                <td style="color: #880000"><?php echo ($arr["password"]); ?></td></tr>
            <tr>
                <td align=right>手机号：</td>
                <td style="color: #880000"><?php echo ($arr["mobile"]); ?></td></tr>
            <tr>
                <td align=right>上线时间：</td>
                <td style="color: #880000"><?php echo ($time); ?></td></tr>
            <tr>
                <td align=right>身份过期：</td>
                <td style="color: #880000">30 分钟</td>
			</tr>
        </table>		
<div style="text-align:center;">
<p>来源：<a href="http://www.qibeiwang.com/" target="_blank">七贝移动数字产品研发中心</a></p>
</div>
    </body>
</html>