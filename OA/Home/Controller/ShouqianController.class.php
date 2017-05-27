<?php
namespace Home\Controller;
//use Think\Controller;
use Home\Controller\CommonController;
class  ShouqianController extends  CommonController
{
	   //售前的页面
	   public function products_list()
	   {
	   	    //实例化对象
	   	    $project=D("Project");
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
	    	$projectObj=D("Project");
	    	if(IS_POST)
	    	{
	    		   $m=$projectObj->create();
	    		   //判断项目是否存在
	    		   $name['project_name']=$m['project_name'];
	    		   $namearr=$projectObj->where($name)->find();
	    		   if(!empty($namearr)){
	    		   	  $this->error("该项目已经存在");
	    		   }
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
	    		   	$this->error("数据创建失败-----".$projectObj->getError());
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
	    $projectObj=D("Project");
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
	   			$this->error("数据创建失败-------".$projectObj->getError());
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
	   public function products_delone()
	   {
	   	     //实例化对象
	   	     $Project=D("Project");
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
	   	     	   	   $msgarr['info']="删除成功";
	   	     	   }
	   	     	   else {
	   	     	   	   $msgarr['info']="删除失败";
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
	 	$projectObj=D("Project");
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
	 			$msgarr['info']="全删完成";
	 		}
	 		else {
	 			$msgarr['info']="全删失败";
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
	   	    $clientObj=D("Client");
	   	    $ini['flag']=1;
	   	    //当前的页面
	   	    $p=isset($_GET['p'])?$_GET['p']:1;
	   	    $this->assign("p",$p);
	   	    //查询的操作
	   	    if(IS_GET)
	   	    {
	   	    	     $title=I("get.kehu",'');
	   	    	     if($title !="")
	   	    	     {
	   	    	     	     $ini['xlr_name']=array("like","%{$title}%");
	   	    	     }
	   	    }
	   	    
	   	    //翻页的操作
	   	    $count=$clientObj->where($ini)->count();
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
	   	    $content=$clientObj->where($ini)->limit($Page->firstRow.",".$Page->listRows)->order("id asc")->select();
	   	    $this->assign("conten",$content);
	   	    $this->assign("pagearr",$show);
	   	    
	   	    $this->display();
	  }
	  /**
	   * 添加客户
	   */
	  public function kehu_add(){
		  	//实例化对象
		  	$clientObj=D("Client");
		  	if(IS_POST)
		  	{
			  		$m=$clientObj->create();
			  		//判断客户是否存在
			  		$kehu['xlr_name']=$m['xlr_name'];
			  		$kehuArr=$clientObj->where($kehu)->find();
			  		if(!empty($kehuArr)){
			  			  $this->error("客户已存在");
			  		}
			  		if($m)
			  		{
			  			$n=$clientObj->add();
			  			if($n)
			  			{
			  				$this->success("添加成功",U("Shouqian/kehu_list"));
			  			}else {
			  				$this->error("添加失败".$clientObj->getError());
			  	
			  			}
			  		}else {
			  			$this->error("数据创建失败------".$clientObj->getError());
			  		}	  		 
		  	}
	  	  $this->display();
	  }
	  /**
	   * 修改客户
	   */
	  public  function  kehu_edit()
	  {
		  	//实例化对象
		  	$clientObj=D("Client");
		  	if(IS_POST)
		  	{
		  		$m=$clientObj->create();
		  		if($m)
		  		{
		  			$p=I("post.p",'');
		  			$n=$clientObj->save();
		  			if($n)
		  			{
		  				$this->success("修改成功",U("Home/Client/client_list/p/{$p}"));
		  			}else {
		  				$this->error("修改失败");
		  			}		  	
		  		}else {
		  			$this->error("数据创建失败------".$clientObj->getError());
		  		}		  	
		  	}		  	 
		  	//接收id和页数
		  	$id=I("get.id","");
		  	$p=I("get.p");
		  	$ini['id']=$id;
		  	$content=$clientObj->where($ini)->find();
		  	$this->assign("arr",$content);
		  	$this->assign("p",$p); 	    
	  	    $this->display();
	  }
	  /*
	   * 客户管理单删的操作
	  */
	  public function kehu_delone()
	  {
	  	     $clientObj=D("Client");
	   	      //获取动作标识
	   	      $act=isset($_POST['act'])?$_POST['act']:'';
	   	      if($act=="del")
	   	      {
	   	      	      //id
	   	      	      $id=I("post.ids","");
	   	      	      $ini['id']=$id;
	   	      	      $ini['flag']=0;
	   	      	      $m=$clientObj->save($ini);
	   	      	      if($m)
	   	      	      {
	   	      	      	      $arr=array("info"=>"删除成功");
	   	      	      }else {
	   	      	      	      $arr=array("info"=>"删除失败");
	   	      	      }
	   	      	     echo json_encode($arr);
	   	      }
	   	      exit(); 
	  }
	  /*
	   *  客户管理多删的操作
	  */
	  public function kehu_delall()
	  {
		  	//实例化对象
		  	$clientObj=D("Client");
		  	//动作标识
		  	$act=isset($_POST['act'])?$_POST['act']:'';
		  	if($act=="delall")
		  	{
		  		//接收id
		  		$ids=I("post.idstr");
		  		$id=substr($ids, 0,strlen($ids)-1);
		  		$ini['id']=array("in",$id);
		  		$ini['flag']=0;
		  		$m=$clientObj->save($ini);
		  		if($m)
		  		{
		  			$arr=array("info"=>"删除成功");
		  		}
		  		else {
		  			$arr=array("info"=>"删除失败");
		  		}
		  		echo json_encode($arr);
		  		exit();
	  	}	  	 
	  }	  
}