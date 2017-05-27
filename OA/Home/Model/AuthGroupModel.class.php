<?php
namespace Home\Model;
use Think\Model;
class AuthGroupModel extends Model{
	   protected $_validate=array(
	   	    array("title","require","----角色组名不能为空"),
	   		array("title","","----该角色组名已经存在，请重新输入",0,"unique",1)
	   );
}