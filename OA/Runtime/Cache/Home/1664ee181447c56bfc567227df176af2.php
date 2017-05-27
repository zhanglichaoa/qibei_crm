<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>修改用户</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Company_crm/Public/css/mine.css" type="text/css" rel="stylesheet">
        <script type="text/JavaScript"  src="/Company_crm/Public/js/jquery-1.8.3.js"></script>
    </head>

     <body>
       <div class="list_box">
           <div class="header">
               <span class="one">当前位置是：用户管理-》修改用户信息</span>
               <span class="two"><a href="<?php echo U('Home/Administrator/user_list');?>">【返回】</a></span>
           </div>
           <div class="bottom">
           <form action="" method="post" enctype="multipart/form-data"  onsubmit="return checkuser();">
               <table class="table_2" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <input type="hidden"  name="pno" value="<?php echo ($p); ?>">
                <input type="hidden"  name="user_id" value="<?php echo ($arr['user_id']); ?>">
                <tr>
                    <td>用户帐号</td>
                    <td><input type="text" name="user_xingming"  id="user_xingming"  value="<?php echo ($arr['user_xingming']); ?>"  /></td>
                </tr>
                <tr>
                    <td>用户名称</td>
                    <td><input type="text" name="user_name"  id="user_name"   value="<?php echo ($arr['user_name']); ?>"  /></td>
                </tr>
                <tr>
                    <td>用户密码</td>
                    <td><input type="text" name="password"  id="password"  value="<?php echo ($arr['password']); ?>"  /></td>
                </tr>
                <tr>
                    <td>手机</td>
                    <td><input type="text" name="mobile"   id="mobile"  value="<?php echo ($arr['mobile']); ?>" /></td>
                </tr>
                <tr>
                    <td>邮箱</td>
                    <td><input type="text" name="email"  id=" email"  value="<?php echo ($arr['email']); ?>" /></td>
                </tr>
                <tr>
                    <td>所属组</td>
                    <td>
                                <select name="roleid"  class="roleid" id="roleid">
                                             <option  value="0">---请选择---</option>
                                             <?php if(is_array($grouparr)): $i = 0; $__LIST__ = $grouparr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i; if($vv['id'] == $arr['roleid']): ?><option  selected  value="<?php echo ($vv["id"]); ?>"><?php echo ($vv['title']); ?></option>   
                                                            <?php else: ?>
                                                                   <option  value="<?php echo ($vv["id"]); ?>"  ><?php echo ($vv['title']); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                    </td>
                </tr>                          
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="修改"  id="btn">
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
    function checkuser(){
	    var accout=$("#user_xingming").val();
	    var name=$("#user_name").val();
	    var pwd=$("#password").val();
	    var mobile=$("#mobile").val();
	    var email=$("#email").val();
	    if(accout==""){
	    	  alert("用户帐号不能为空");
	    	  return false;
	    }
	    if(name==""){
	    	 alert("用户姓名不能为空");
	    	 return false;
	    }
	    if(pwd==""){
	    	 alert("密码不能为空");
	    	 return false;
	    }
	    if(mobile==""){
	    	 alert("手机号不能为空");
	    	 return false;
	    }
	    if(email==""){
	    	 alert("邮箱不能为空");
	    	 return false;
	    }
  }
</script>
</html>