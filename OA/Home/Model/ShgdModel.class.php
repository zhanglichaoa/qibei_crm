<?php
namespace Home\Model;
use Think\Model;
class ShgdModel extends  Model{
	   //自动验证
	   protected  $_validate=array(
	   	      array("title","require","售后工单名称不能为空"),
	   		  array("title","","该售后工单已经存在,请重新输入",0,"unique",1),
	   		  array("content","require","售后工单内容不能为空"),
	   		  array("img","require","您还没有选择附件"),
	   		  array("dtime","require","您还没有确定上传时间")
	   );
}