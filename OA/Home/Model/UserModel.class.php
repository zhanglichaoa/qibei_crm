<?php
namespace  Home\Model;
use Think\Model;
class UserModel extends Model{
	    //自动验证
	    protected $_validate=array(
	    	   array("user_xingming","require","用户帐号不能为空"),
	    	   array("user_xingming","","该用户已经存在,请换其他的用户",0,"unique",1),
	    	   array("user_name","require","用户的真实姓名不能为空"),
	    	   array("password","require","用户密码不能为空"),
	    	   array("mobile","require","手机号不能为空"),
	    	   array("mobile","number","手机号必须为数字"),
	    	   array("email","require","邮箱不能为空"),
	    	   array("email","email","邮箱格式不正确"),
	    	   array("roleid","number","所属组为数字")
	    );
	
}