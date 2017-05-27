<?php
namespace Home\Model;
use Think\Model;
class ItemgroupModel extends Model{
	//字段验证
	protected $_validate=array(
		    array("item_name","require","小组名称不能为空"),
		    array("item_name","","该小组已经存在,请重新输入",0,"unique",1),
		    array("item_chengyuan","require","小组成员不能为空"),
			array("item_fzr","require","小组负责人不能为空"),
		    array('item_content','require','负责的内容不能为空'),
	);
}