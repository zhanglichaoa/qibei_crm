<?php
namespace Home\Controller;
//use Think\Controller;
use Home\Controller\CommonController;
class ProjectController extends CommonController
{
	    /*
	     * 小组安排的列表页
	     */
	    public function item_list()
	    {
	    	//实例化对象
	    	$itemObj=D("Itemgroup");
	    	//当前的页数
	    	$p=isset($_GET['p'])?$_GET['p']:1;
	    	$this->assign("p",$p);
	    	//查询的操作
	    	$ini=array();
	    	$ini['status']=1;
	    	$title=I("get.xiaozu");
	    	if($title!=""){
	    		    $ini['item_name']=array("like","%{$title}%");
	    	}
	    	$this->assign("title",$title);
	    	//翻页的操作
	    	$count=$itemObj->where($ini)->count();
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
	    	//内容的操作：
	    	$cont=$itemObj->where($ini)->limit($Page->firstRow.','.$Page->listRows)->select();
	    	$this->assign("arr",$cont);
	    	$this->assign("pagearr",$show);	    	
	    	$this->display();
	    }
	    /*
	     * 小组安排的添加页面
	     */
	    public function item_add()
	    {
	    	   //实例化对象
	    	   $itmeObj=D("Itemgroup");
	    	   if(IS_POST)
	    	   {
	    	   	        $m=$itmeObj->create();
	    	   	        //判断小组是否存在
	    	   	        $item['item_name']=$m['item_name'];
	    	   	        $itemarr=$itmeObj->where($item)->find();
	    	   	        if(!empty($itemarr)){
	    	   	        	  $this->error("该小组已经存在");
	    	   	        }	    	   	        
	    	   	        if($m)
	    	   	        {   
	    	   	        	   $n=$itmeObj->add();
	    	   	        	   if($n)
	    	   	        	   {
	    	   	        	   	    $this->success("数据添加成功",U("Home/Project/item_list"));
	    	   	        	   }else {
	    	   	        	   	$this->error("添加失败".$itmeObj->getError());
	    	   	        	   }
	    	   	        	
	    	   	        }else {
	    	   	        	$this->error("数据创建失败------".$itmeObj->getError());
	    	   	        }	    	   	
	    	   }	    	
	    	   $this->display();
	    }
	    /*
	     * 小组安排修改的操作
	     */
	      public function item_edit()
	      {
	      	    $itemObj=D("Itemgroup");
	      	    if(IS_POST)
	      	    {
	      	    	     //当前的页数
	      	    	     $pno=I("post.pno");
	      	    	     $n=$itemObj->create();
	      	    	     if($n)
	      	    	     {
	      	    	     	 $m=$itemObj->save();
	      	    	     	 if($m)
	      	    	     	 { 
	      	    	     	 	  $this->success("修改成功",U("Home/Project/item_list/p/{$pno}"));
	      	    	     	 }else {
	      	    	     	 	$this->error("修改失败".$itemObj->getError());
	      	    	     	 }
	      	    	     	
	      	    	     }else {
	      	    	        $this->error("数据创建失败-------".$itemObj->getError());
	      	    	     }
	      	    }	      	      	    
	      	   //接收id和当前的页数
	      	   $id=I("get.id");
	      	   $p=I("get.p");
               //内容的修改
               $ini['item_id']=$id;
               $contarr=$itemObj->where($ini)->find();
               $this->assign("arr",$contarr);
               $this->assign("p",$p);	      		      	   
	      	   $this->display();
	      }
	    /*
	     * 小组删除的操作
	     */
	      public function item_delone()
	      {
	      	   $itemObj=D("Itemgroup");
	      	   //接受动作标识
	      	  $act=isset($_POST['act'])?$_POST['act']:'';
	      	  if($act=="del")
	      	  {
	      	  	     $id=I("post.ids");
	      	  	     $ini['item_id']=$id;
	      	  	     $ini['status']=0;
	      	  	     $n=$itemObj->save($ini);
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
	       * 多删的操作
	       */
	      public function item_delall()
	      {
	      	    //实例化对象
	      	   $itemObj=D("Itemgroup");
	      	   //接收动作标识
	      	   $act=isset($_POST['act'])?$_POST['act']:'';
	      	   if($act=="delall")
	      	   {
	      	   	        $ids=I("post.idstr");
	      	   	        $id=substr($ids, 0,strlen($ids)-1);
	      	   	        $ini['item_id']=array("in",$id);
	      	   	        $ini['status']=0;
	      	   	        $n=$itemObj->save($ini);
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
	       * 工单分配列表页
	       */
	      public function wo_list()
	      {
	      	     //实例化对象
	      	     $wo=D("workorder");
	      	     //工单的查询
	      	     $title=I("get.gongdan");
	      	     $ini=array();
	      	     $ini['w.flag']=1;
	      	     if($title!="")
	      	     {
	      	     	 $ini['title']=array("like","%{$title}%");	      	     	
	      	     }
	      	     $this->assign("title",$title);
	      	     //当前的页数
	      	     $p=isset($_GET['p'])?$_GET['p']:1;
	      	     $this->assign("p",$p);     	         
	      	     //翻页的操作
	      	     $count=$wo->alias("w")->where($ini)->count();
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
	      	     $cont=$wo->where($ini)->limit($Page->firstRow.','.$Page->listRows)->alias("w")->field("w.*,k.xlr_name,k.tel")->join("crm_client as k on w.kehu_id=k.id ","left")->select();
	      	     $this->assign("arr",$cont);
	      	     $this->assign("pagearr",$show);
	      	     $this->display();
	      }
	     /*
	      * 添加工单
	      */
	      public function wo_add()
	      {
	      	    //实例化对象
	      	    $wo=D("workorder");
	      	    if(IS_POST)
	      	    {
	      	    	    $m=$wo->create();
	      	    	    //判断工单是否存在
	      	    	    $gd['title']=$m['title'];
	      	    	    $gdArr=$wo->where($gd)->find();
	      	    	    if(!empty($gdArr)){
	      	    	    	  $this->error("工单已经存在");
	      	    	    }
	      	    	    if($m)
	      	    	    {
	      	    	    	$m['content']=html_entity_decode($m['content']);
	      	    	    	$n=$wo->add($m);
	      	    	    	if($n)
	      	    	    	{
	      	    	    		  $this->success("添加成功",U("Home/Project/wo_list"));
	      	    	    	}else {
	      	    	    		  $this->error("添加失败".$wo->getError());
	      	    	    	}
	      	    	    }else {
	      	    	    	$this->error("数据创建失败------".$wo->getError());
	      	    	    }
	      	    	
	      	    }
	      	    $this->display();
	      }
	     /*
	      * 修改工单
	      */
	      public function wo_edit()
	      {
	      	  //实例化对象  
	      	  $woObj=D("workorder"); 
	      	  if(IS_POST){
	      	  	    $pno=I("post.pno");
	      	  	    $m=$woObj->create();
	      	  	    if($m)
	      	  	    {
	      	  	    	  $m['content']=html_entity_decode($m['content']);
	      	  	    	  $n=$woObj->save($m);
	      	  	    	  if($n)
	      	  	    	  {
	      	  	    	  	   $this->success("数据修改成功",U("Home/Project/wo_list/p/{$pno}"));
	      	  	    	  }else {
	      	  	    	  	$this->error("修改失败");
	      	  	    	  }
	      	  	    }else {
	      	  	    	$this->error("数据创建失败",$woObj->getError());
	      	  	    }
	      	  	
	      	  }    	  
	      	  //接受id和当前的页数
	      	  $id=I("get.id");
	      	  $p=I("get.p");
	      	  $ini['id']=$id;
	      	  $cont=$woObj->where($ini)->find();
	      	  $this->assign("arr",$cont);
	      	  $this->assign("p",$p);
	      	  $this->display();
	      }
	      /*
	       * 工单单删的操作
	       */
	      public function wo_delone()
	      {
		      	$itemObj=D("workorder");
		      	//接受动作标识
		      	$act=isset($_POST['act'])?$_POST['act']:'';
		      	if($act=="del")
		      	{
			      		$id=I("post.ids");
			      		$ini['id']=$id;
			      		$ini['flag']=0;
			      		$n=$itemObj->save($ini);
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
	       * 工单的多删
	       */
	      public function wo_delall()
	      {
		      	//实例化对象
		      	$itemObj=D("workorder");
		      	//接收动作标识
		      	$act=isset($_POST['act'])?$_POST['act']:'';
		      	if($act=="delall")
		      	{
			      		$ids=I("post.idstr");
			      		$id=substr($ids, 0,strlen($ids)-1);
			      		$ini['id']=array("in",$id);
			      		$ini['flag']=0;
			      		$n=$itemObj->save($ini);
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
	     * 任务管理的列表页
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
	       * 任务的添加页面
	       */
	      public function task_add()
	      {
	      	  //实例化对象
	      	  $taskObj=D("task");
	      	  $name=D("itemgroup");
	      	  if(IS_POST)
	      	  {
	      	  	      $m=$taskObj->create();
	      	  	      //判断任务是否已经存在了
	      	  	      $task['task_name']=$m['task_name'];
	      	  	      $taskarr=$taskObj->where($task)->find();
	      	  	      if(!empty($taskarr)){
	      	  	      	   $this->error("该任务已经存在了");
	      	  	      }
	      	  	      if($m)
	      	  	      {
	      	  	      	    $n=$taskObj->add();
	      	  	      	    if($n)
	      	  	      	    {
	      	  	      	    	 $this->success("数据添加成功",U("Home/Project/task_list"));
	      	  	      	    }else {
	      	  	      	    	  $this->error("数据添加失败");
	      	  	      	    }
	      	  	      }else {
	      	  	      	 $this->error("数据创建失败------".$taskObj->getError());
	      	  	      }
	      	  	
	      	  	
	      	  }
	       	   //内容的查询
	      	    $arr=$name->select();
	      	    $this->assign("arr",$arr);
	      	    $this->display();
	      }
	     /*
	      * 任务的修改页面
	      */ 
	       public function task_edit()
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
	       	      	    	   	      $this->success("数据修改成功",U("Home/Project/task_list/p/{$p}"));
	       	      	    	   }else {
	       	      	    	   	   $this->error("数据修改失败");
	       	      	    	   }
	       	      	    	  
	       	      	    }else {
	       	      	    	
	       	      	    	$this->error("数据创建失败----".$taskObj->getError());
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
	        * 任务单删的操作
	       */
	       public function task_delone()
	       {
	       	$itemObj=D("task");
	       	//接受动作标识
	       	$act=isset($_POST['act'])?$_POST['act']:'';
	       	if($act=="del")
	       	{
	       		$id=I("post.ids");
	       		$ini['task_id']=$id;
	       		$ini['flag']=0;
	       		$n=$itemObj->save($ini);
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
	        * 任务的多删
	       */
	       public function task_delall()
	       {
	       	//实例化对象
	       	$itemObj=D("task");
	       	//接收动作标识
	       	$act=isset($_POST['act'])?$_POST['act']:'';
	       	if($act=="delall")
	       	{
	       		$ids=I("post.idstr");
	       		$id=substr($ids, 0,strlen($ids)-1);
	       		$ini['task_id']=array("in",$id);
	       		$ini['flag']=0;
	       		$n=$itemObj->save($ini);
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
	       * 任务的进度管理
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
	       * 进度管理的列表页
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
	       * 删除的操作
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
	       * 进度管理的全删
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