<?php
namespace Home\Model;
use Think\Model;
class WorkorderModel extends Model{
	  //字段验证
	  protected $_validate=array(
	  	    array('title','require','工单名称不能为空'),
	  		array('title','','该工单已经存在，请重新输入工单',0,"unique",1),
	  		array('content','require','工单的内容不能为空'),
	  		array('ctime','require','工单开始的时间还没有选择'),  		
	  );
}