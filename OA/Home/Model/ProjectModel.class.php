<?php
namespace Home\Model;
use Think\Model;
class ProjectModel extends Model{
	  protected  $_validate=array(
	  	    array("project_name","require","项目名称不能为空"),
	  		array("project_name","","该项目已经存在",0,"unique",1),
	  		array("begin_time","require","项目开始时间不能为空"),
	  		array("end_time","require","项目结束时间不能为空"),
	  );
}