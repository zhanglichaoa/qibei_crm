<?php
namespace  Home\Model;
use Think\Model;
class TaskModel extends Model{
	//自动验证
	protected  $_validate=array(
		  array('task_name','require','任务名单名称不能为空'),
		  array('task_name','','该任务工单已经存在',0,"unique",1),
		  array("fzr_id","0","您还有把任务分配到具体的人",0,"equal",3),
		  array('task_ctime','require','任务开始时间不能为空'),
		  array('task_ltime','require','任务的结束时间不能为空'),
	);
	
	
}