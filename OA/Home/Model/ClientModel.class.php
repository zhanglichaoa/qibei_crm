<?php
namespace Home\Model;
use Think\Model;
class  ClientModel extends Model{
	//自动验证
	protected  $_validate=array(
		    array("xlr_name","require","客户名称不能为空"),
			array("xlr_name","","该用户已经存在,请重新输入",0,"unique",1),
			array("companyname","require","客户公司不能为空"),
			array("tel","require","客户手机不能为空"),
			array("tel","number","手机必须是数字"),
			array("email","require","邮箱不能为空"),
			array("email","email","客户邮箱格式不正确"),
			array("fzr","require","负责人不能为空"),
			array("dtime","require","录入时间不能为空"),
	);
}