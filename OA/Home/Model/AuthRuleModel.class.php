<?php
namespace Home\Model;
use Think\Model;
class AuthRuleModel extends Model{
	  //自动验证
	  protected  $_validate=array(
	  	   array("name","require","规则标识不能为空"),
    	   array("name","","该规则标识已经存在",0,"unique",1),
	  	   array("title","require","规则名称不能为空")
	  );
}