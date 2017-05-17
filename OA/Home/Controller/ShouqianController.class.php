<?php
namespace Home\Controller;
use Think\Controller;
//use Home\Controller\CommonController;
class  ShouqianController extends  Controller
{
	   //售前的页面
	   public function products_list()
	   {
	   	    //实例化对象
	   	    $project=M("Project");
	   	   //查询的操作
	   	    $title=I("get.xiangmu");
	   	    $this->assign("title",$title);
	   	    $ini['status']=1;
	   	    if($title!="")
	   	    {
	   	    	   $ini['project_name']=array("like","%{$title}%");   	    	
	   	    }
	   	    //当前的页数
	   	    $p=isset($_GET['p'])?$_GET['p']:1;
	   	    $this->assign("p",$p);
	   	    //翻页的操作：
	   	    $count=$project->where($ini)->count();
	   	    $Page=new \Think\Page($count,3);
	   	    //***** 分页样式定制
	   	    $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
	   	    $Page->setConfig('prev', '上一页');
	   	    $Page->setConfig('next', '下一页');
	   	    $Page->setConfig('first', '首页');
	   	    $Page->setConfig('end', '末页');
	   	    //***** 这里定义分页的各个单元的显示位置
	   	    $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
	   	    
	   	    $show=$Page->show();
	   	    $content=$project->limit($Page->listRows.','.$Page->firstRow)->where($ini)->select();
	   	    $this->assign("projectarr",$content);
	   	    $this->assign("pagearr",$show);
	   	    $this->display();
	   	
	   }
	 /*
	  * 项目管理
	  */
	    public function products_add()
	    {
	    	//实例化对象
	    	$projectObj=M("Project");
	    	if(IS_POST)
	    	{
	    		   $m=$projectObj->create();
	    		   if($m)
	    		   {
	    		   	    $m['begin_time']=strtotime($m['begin_time']);
	    		   	    $m['end_time']=strtotime($m['end_time']);
	    		   	    $n=$projectObj->add($m);
	    		   	    if($n || $n===0)
	    		   	    {
	    		   	    	$this->success("项目添加成功",U("Home/Shouqian/products_list"));    		   	    	
	    		   	    }
	    		        else {
	    		        	$this->error("项目添加失败");
	    		        }
	    		   	   
	    		   }else {
	    		   	$this->error("数据创建失败");
	    		   }
	    		
	    	}
	    	$this->display();
	    }
	  /*
	   * 项目修改
	   */
	   public function products_edit()
	   {
	   	//实例化对象
	    $projectObj=M("Project");
	   	if(IS_POST)
	   	{
	   		//接收id和当前的页数
	   		$p=I("post.pno");
	   		$m=$projectObj->create();
	   		if($m)
	   		{
	   			   $m['begin_time']=strtotime($m['begin_time']);
	   			   $m['end_time']=strtotime($m['end_time']);
	   			   $n=$projectObj->save($m);
	   			   if($n || $n===0)
	   			   {
	   			   	   $this->success("数据修改成功",U('Home/Shouqian/products_list'));
	   			   }
	   			   else {
	   			   	   $this->error("数据修改失败");
	   			   }
	   			
	   		}else {
	   			$this->error("数据创建失败");
	   		}
	   	
	   	}
	   	//获取传递的id和当前的页数
	   	$p=I("get.p");
	   	$id=I("get.id");
	   	$ini['project_id']=$id;
	   	//要查询的内容
	   	$content=$projectObj->where($ini)->find();
	   	$this->assign("arr",$content);
	   	$this->assign("p",$p);
 	
	    	$this->display();
	   }
	 /*
	  * 项目单删的操作
	  */  
	   public function products_del()
	   {
	   	     //实例化对象
	   	     $Project=M("Project");
	   	     //接受动作表示
	   	     $act=I("post.act");
	   	     if($act=="del")
	   	     {
	   	     	  //接收要删除的id
	   	     	   $ids=I("post.ids");
	   	     	   $ini['status']=0;
	   	     	   $ini['project_id']=$ids;
	   	     	   $m=$Project->save($ini);
	   	     	   if($m)
	   	     	   {
	   	     	   	   $msgarr['msg']="删除成功";
	   	     	   }
	   	     	   else {
	   	     	   	   $msgarr['msg']="删除失败";
	   	     	   }
	   	     	   echo json_encode($msgarr);
	   	     	   exit();
	   	     }
	   	
	   }
	 /*
	  * 项目全删的操作
	  */   	
	 public function products_delall()
	 {
	 	//实例化对象
	 	$projectObj=M("Project");
	 	//接收动作标识
	 	$act=I("post.act");
	 	if($act=="delall")
	 	{
	 		//接收要删除的id delete
	 		$idstr=I("post.idstr");
	 		$ids= substr($idstr, 0,strlen($idstr)-1);
	 		$ini['project_id']=array("IN",$ids);
	 		$ini['status']=0;
	 		$m=$projectObj->save($ini);
	 		if($m)
	 		{
	 			$msgarr['msg']="全删完成";
	 		}
	 		else {
	 			$msgarr['msg']="全删失败";
	 		}
	 		echo json_encode($msgarr);
	 		exit();
	 	}
	 	
	 }
	   
	  /*
	   * 维护客户
	   */ 
	  public function kehu_list()
	  {
	  	   //实例化对象
	  	    $kehuObj=M("Kehu");
	  	    //获取当前的页数
	  	    $p=isset($_GET['p'])?$_GET['p']:1;
	  	    $this->assign("p",$p);
	  	    //查询的操作：
	  	    $title=I("get.kehu");
	  	    $ini=array();
	  	    if($title!="")
	  	    {
	  	    	  $ini['kehu_name']=array("like","%{$title}%");
	  	    }
	  	    $this->assign("title",$title);
	  	    //翻页的操作
	  	    $count=$kehuObj->where($ini)->count();
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
	  	    $content=$kehuObj->where($ini)->limit($Page->firstRow.','.$Page->listRows)->select();
	  	    $this->assign("arr",$content); 
	  	    $this->assign("pagearr",$show);  	 
	  	    $this->display();
	  }
}