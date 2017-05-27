<?php
namespace  Home\Controller;
//use Think\Controller;
use Home\Controller\CommonController;
class DevelopController extends CommonController
{
	     /*
	      * 任务管理列表页
	      */
	      public function task_list()
	      {
			      	//实例化对象
			      	$taskObj=D('task');
			      	//当前的页数
			      	$p=isset($_GET['p'])?$_GET['p']:1;
			      	$this->assign("p",$p);
			      	//查询的操作
			      	$title=I("get.rw");
			      	$ini=array();
			      	$ini['flag']=1;
			      	if($title !="")
			      	{
			      		$ini['task_name']=array("like","%{$title}%");
			      	
			      	}
			      	$this->assign("title",$title);
			      	
			      	//翻页的操作
			      	$count=$taskObj->where($ini)->count();
			      	$Page=new \Think\Page($count,2);
			      	//***** 分页样式定制
			      	$Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
			      	$Page->setConfig('prev', '上一页');
			      	$Page->setConfig('next', '下一页');
			      	$Page->setConfig('first', '首页');
			      	$Page->setConfig('end', '末页');
			      	//***** 这里定义分页的各个单元的显示位置
			      	$Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
			      	$show=$Page->show();
			      	//内容的查询
			      	// $content=$taskObj->where($ini)->limit($Page->firstRow.",".$Page->listRows)->alias("t")->field("t.*,u.item_fzr,w.title")->join("crm_itemgroup as u on t.task_id=u.item_id","left")->join("crm_workorder as w on t.task_id=taskid","left")->select();
			      	
			      	$content=$taskObj->order("task_id asc")->where($ini)->limit($Page->firstRow.",".$Page->listRows)->alias("t")->field("t.*,i.item_fzr")->join("crm_itemgroup as i on t.fzr_id=i.item_id","left")->select();
			      	$this->assign("arr",$content);
			      	
			      	$this->assign("pagearr",$show);
			      	
			      	
	      	        $this->display();
	      }
	      /*
	       * 任务管理添加页面
	       * 
	       */
	      public  function   task_add()
	      {
				      	//实例化对象
				      	$taskObj=D("task");
				      	$name=D("itemgroup");
				      	if(IS_POST)
				      	{
				      		$m=$taskObj->create();
				      		$task['task_name']=$m['task_name'];
				      		$taskArr=$taskObj->where($task)->find();
				      		if(!empty($taskArr)){
				      			  $this->error("该任务已经存在");
				      		}
				      		if($m)
				      		{
				      			$n=$taskObj->add();
				      			if($n)
				      			{
				      				$this->success("数据添加成功",U("Home/Develop/task_list"));
				      			}else {
				      				$this->error("数据添加失败");
				      			}
				      		}else {
				      			$this->error("数据创建失败");
				      		}
				      		 
				      		 
				      	}
				      	//内容的查询
				      	$arr=$name->select();
				      	$this->assign("arr",$arr);
     	
	      	         $this->display();
	      }
	      /*
	       * 任务管理修改页面
	       */
	       public function  task_edit()
	       {
			       	//实例化对象
			       	$taskObj=D("task");
			       	//接受id和当前的页数
			       	$id=I("get.id");
			       	$p=I("get.p");
			       	if(IS_POST)
			       	{
			       		$m=$taskObj->create();
			       		if($m)
			       		{
			       			$p=I("post.p");
			       			$n=$taskObj->save();
			       			if($n || $n===0)
			       			{
			       				$this->success("数据修改成功",U("Home/Develop/task_list/p/{$p}"));
			       			}else {
			       				$this->error("数据修改失败");
			       			}
			       			 
			       		}else {
			       			 
			       			$this->error("数据创建失败");
			       		}
			       	
			       	}
			       	 
			       	 
			       	//内容的查询
			       	$ini['task_id']=$id;
			       	$arr=$taskObj->where($ini)->join("crm_itemgroup as i on t.fzr_id=i.item_id","left")->field("t.*,i.item_fzr")->alias("t")->find();
			       	//跟配给
			       	$itarr=D("itemgroup");
			       	$arr2=$itarr->select();
			       	$this->assign("arrit",$arr2);
			       	 
			       	$this->assign("arr",$arr);
			       	$this->assign("p",$p);
	       	
	       	       $this->display();
	       }
	   /*
	    * 任务管理单删的页面
	    */   
	      public function task_delone()
	      {
			      	$taskObj=D("task");
			      	//接受动作标识
			      	$act=isset($_POST['act'])?$_POST['act']:'';
			      	if($act=="del")
			      	{			      		
			      		$ini['task_id']=I("post.ids");
			      		$ini['flag']=0;			      		
			      		$n=$taskObj->save($ini);
			      		if($n)
			      		{
			      			$arr['info']="删除成功";
			      		}else{
			      			$arr['info']="删除失败";
			      		}
			      		echo json_encode($arr);
			      	}
			      	exit();
	      	    
	      	    
	      }
	      /*
	       * 任务管理全删的操作
	       */
	      public function task_delall()
	      {
		      	//实例化对象
		      	$taskObj=D("task");
		      	//接收动作标识
		      	$act=isset($_POST['act'])?$_POST['act']:'';
		      	if($act=="delall")
		      	{
		      		$ids=I("post.idstr");
		      		$id=substr($ids, 0,strlen($ids)-1);
		      		$ini['task_id']=array("in",$id);
		      		$ini['flag']=0;
		      		$n=$taskObj->save($ini);
		      		if($n)
		      		{
		      			$arr['info']="删除成功";
		      		}else {
		      			$arr['info']="删除失败";
		      		}
		      		echo json_encode($arr);
		      	}
		      	
		      	exit();
	      	
	      	
	      }
	      /*
	       * 任务管理查看进度
	       */
	      public function task_process()
	      {
			      	//实例化对象
			      	$task=D("task");
			      	$id=I("get.id");
			      	$ini['task_id']=$id;
			      	$arr=$task->where($ini)->find();
			      	
			      	$this->assign("arr",$arr);
			      	
	
	      	 
	      	       $this->display();
	      }
	      /*
	       * 进度管理列表页面
	       */
	      public function process_list()
	      {
		      	$task=D("task");
		      	//当前的页数
		      	$p=isset($_GET['p'])?$_GET['p']:1;
		      	$this->assign("p",$p);
		      	//查询的操作
		      	$title=I("get.jd",'');
		      	$ini=array();
		      	$ini['flag']=1;
		      	if($title !="")
		      	{
		      		$ini['task_name']=array("like","%{$title}%");
		      		 
		      	}
		      	$this->assign("title",$title);
		      	 
		      	//翻页的操作
		      	$count=$task->where($ini)->count();
		      	$Page=new \Think\Page($count,2);
		      	//***** 分页样式定制
		      	$Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
		      	$Page->setConfig('prev', '上一页');
		      	$Page->setConfig('next', '下一页');
		      	$Page->setConfig('first', '首页');
		      	$Page->setConfig('end', '末页');
		      	//***** 这里定义分页的各个单元的显示位置
		      	$Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
		      	$show=$Page->show();
		      	//内容的操作:
		      	$cont=$task->where($ini)->limit($Page->firstRow.",".$Page->listRows)->select();
		      	$this->assign("pagearr",$show);
		      	$this->assign("cont",$cont);
		      	
	      	   $this->display();
	      }
	      /*
	       * 进度管理修改页面
	       */
	      public function process_edit()
	      {
			      	//实例化对象
			      	$taskObj=D("task");
			      	if(IS_POST)
			      	{
			      		$m=$taskObj->create();
			      	
			      		if($m)
			      		{
			      			$p=I("post.p",'');
			      			$n=$taskObj->save();
			      			if($n || $n===0)
			      			{
			      				$this->success("数据修改成功",U("Home/Project/process_list/p/{$p}"));
			      			}else {
			      				$this->error("数据修改失败");
			      			}
			      	
			      		}else {
			      	
			      			$this->error("数据创建失败");
			      		}
			      		 
			      	}
			      	//接受id和当前的页数
			      	$id=I("get.id");
			      	$p=I("get.p");
			      	//内容的查询:
			      	$ini['task_id']=$id;
			      	$content=$taskObj->where($ini)->find();
			      	$this->assign("arr",$content);
			      	$this->assign("p",$p);
			      	$this->display();
	      	
	      }
	      /*
	       * 任务管理单删的操作
	       */
	        public function process_delone()
	        {
	        	$taskObj=D("task");
	        	//接受动作标识
	        	$act=isset($_POST['act'])?$_POST['act']:'';
	        	if($act=="del")
	        	{        		 
	        		$ini['task_id']=I("post.ids");
	        		$ini['flag']=0;
	        		$n=$taskObj->save($ini);
	        		if($n)
	        		{
	        			$arr['info']="删除成功";
	        		}else{
	        			$arr['info']="删除失败";
	        		}
	        		echo json_encode($arr);
	        	}
	        	exit();
	        	
	        }
	      /*
	       * 进度管理全删的操作
	       */
	      public function process_delall()
	      {
		      	//实例化对象
		      	$taskObj=D("task");
		      	//接收动作标识
		      	$act=isset($_POST['act'])?$_POST['act']:'';
		      	if($act=="delall")
		      	{
		      		$ids=I("post.idstr");
		      		$id=substr($ids, 0,strlen($ids)-1);
		      		$ini['task_id']=array("in",$id);
		      		$ini['flag']=0;
		      		$n=$taskObj->save($ini);
		      		if($n)
		      		{
		      			$arr['info']="删除成功";
		      		}else {
		      			$arr['info']="删除失败";
		      		}
		      		echo json_encode($arr);
		      	}
		      	
		      	exit();
	      	
	      }
	      
	      
	      
	      
	      
	      
	      
	      
	      
	      
	      
}