<?php
namespace  Home\Controller;
//use Home\Controller\CommonController;
use Think\Controller;
class AdministratorController extends Controller
{
	 /*
	  * 角色管理列表页
	  */
	public function role_list(){
	
		//实例化对象
		$roleObj=M("Role"); 
		//查询的操作
		$title=I("get.juese");
		$this->assign("title",$title);
		$ini=array();
		$ini['status']=1;
		if($title!="")
		{
			  $ini['role_name']=array("like","%{$title}%");
		}
		//当前的页数
		$pno=isset($_GET['p'])?$_GET['p']:1;
		$this->assign("pno",$pno);
		//翻页的功能
		$count=$roleObj->where($ini)->count();
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
		//条件
		
		//要查询的内容
		$rolecontent=$roleObj->where($ini)->limit($Page->firstRow.','.$Page->listRows)->select();
		//向模板中传递变量
		$this->assign("rolearr",$rolecontent);
		$this->assign("pagearr",$show);
	    
		 $this->display();
	}
	/*
	 * 角色管理添加页面
	 */
	public function role_add()
	{
		//实例化对象
		$roleObj=M("Role");
		if(IS_POST)
		{
			$m=$roleObj->create();//数据的收集
			if($m)
			{
				//数据创建成功，调用添加的方法
				$n=$roleObj->add();
				if($n)
				{
					$this->success("添加成功",U("Home/Administrator/role_list"));
				}
				else {
					$this->error("添加失败".$roleObj->getError());
				}
				
			}else {
				$this->error("数据创建失败".$roleObj->getError());
			}
			
		}
		
		
		 $this->display();
	}
	/*
	 * 角色管理修改页面
	 */
	public function role_edit()
	{
		 //实例化对象
		$roleObj=M("Role");
		if(IS_POST)
		{
			 //接收id和当前的页数
			 $p=I("post.pno");
			 $m=$roleObj->create();			
			 if($m)
			 {
			 	   $n=$roleObj->save();
			 	   if($n || $n===0)
			 	   {
			 	   	    $this->success("修改成功",U("Home/Administrator/role_list/p/{$p}"));			 	   	
			 	   }else {
			 	   	$this->error("修改失败");
			 	   }
			 }else{
			 	$this->error("数据创建失败".$roleObj->getError());
			 }
		
		}
		//获取传递的id和当前的页数
		$p=I("get.p");
		$id=I("get.id");
		$ini['role_id']=$id;
		//要查询的内容
		$content=$roleObj->where($ini)->find();
		$this->assign("arr",$content);
		$this->assign("p",$p);
		
		 $this->display();
	}
	/*
	 * 角色管理单删的功能
	 * 
	 */
	  public function role_delone()
	  {
	  	  //实例化对象
	  	  $roleObj=M("Role");
	  	  //接收id
	  	  $ids=I("post.ids");
	  	  //接收动作标识
	  	 $act=I("post.act");
	  	 if($act=="del")
	  	 {
	  	 	     $ini['status']=0;
	  	 	     $ini['role_id']=$ids;
	  	 	     $m=$roleObj->save($ini);
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
	 * 角色全删的操作
	 */
	 public function delall()
	 {
	 	 //实例化对象
	 	 $roleObj=M("Role");
	 	 //接收动作标识
	 	 $act=I("post.act");
	 	 if($act=="delall")
	 	 {
	 	 	    //接收要删除的id
	 	 	    $idstr=I("post.idstr");
	 	 	    $ids= substr($idstr, 0,strlen($idstr)-1);
	 	 	    $ini['role_id']=array("IN",$ids);
	 	 	    $ini['status']=0;
	 	 	    $m=$roleObj->save($ini);
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
	 * 人员管理列表页
	 */
	public function user_list()
	{
		//实例化对象
		$usr=M("User");
		//翻页的操作
		$ini['flag']=1;
		//当前的页数：
		$pno=isset($_GET['p'])?$_GET['p']:1;
		$this->assign("p",$pno);
		//查询的操作：
		$title=I("get.zhanghao");
		$this->assign("title",$title);
		if($title!="")
		{
			  $ini['user_name']=array("like","%{$title}%");			
		}
		$count=$usr->where($ini)->count();
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
		//内容的查询
		$usercont=$usr->alias('u')->field("u.*,r.role_name")->join("crm_role as r on u.roleid=r.role_id","left")->where($ini)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign("pagearr",$show);
		$this->assign("userarr",$usercont);
		$this->display();
	}
	/*
	 * 人员管理的添加页面
	 */
	 public function user_add()
	 {
	 	    //实例化对象
	 	    $user=M("User");
	 	    $role=M("Role");
	 	    $ini['status']=1;
	 	    //接受数据
	 	    if(IS_POST)
	 	    {
	 	    	    $m=$user->create();
	 	    	    if($m)
	 	    	    {	 	    	    	
	 	    	    	  $m['last_time']=time();
	 	    	    	  $n=$user->add($m);
	 	    	    	  if($n)
	 	    	    	  {
	 	    	    	  	  $this->success("用户添加成功",U("Home/Administrator/user_list"));
	 	    	    	  }else {
	 	    	    	  	  $this->error("用户添加失败".$user->getError());
	 	    	    	  }
	 	    	    }
	 	    	    else {
	 	    	    	$this->error("数据创建失败");
	 	    	    }
	 	    }
	 	    
	 	    
	 	    
	 	    
	 	    
	 	    //所属组
	 	    $rolearr=$role->where($ini)->select();
	 	    $this->assign("rolearr",$rolearr);
	 	    $this->display();
	 }
	/*
	 * 用户管理修改页面
	 */
	  public function user_edit()
	  {  	
	  	$user=M("User");
	  	$role=M('Role');
	  	if(IS_POST)
	  	{
	  		//接收id和当前的页数
	  		$p=I("post.pno");
	  		$m=$user->create();
	  		if($m)
	  		{
	  			$n=$user->save();
	  			if($n || $n===0)
	  			{
	  				$this->success("修改成功",U("Home/Administrator/user_list/p/{$p}"));
	  			}else {
	  				$this->error("修改失败");
	  			}
	  		}else{
	  			$this->error("数据创建失败".$user->getError());
	  		}
	  		
	  	}
	  	
	  	
	  	//获取传递的id和当前的页数
		$p=I("get.p");
		$id=I("get.id");
		$ini['user_id']=$id;
		//要查询的内容
		$content=$user->where($ini)->find();
		$this->assign("arr",$content);
		$this->assign("p",$p);
		//所属组
		$rolearr=$role->select();
		$this->assign("rolearr",$rolearr);
	  	
	  	
	  	 $this->display();
	  }
	/*
	 * 用户单删的操作
	 */
	public function user_delone()
	{
		//实例化对象
		$userObj=M("User");
		//接收id
		$ids=I("post.ids");
		//接收动作标识
		$act=I("post.act");
		if($act=="del")
		{
			$ini['flag']=0;
			$ini['user_id']=$ids;
			$m=$userObj->save($ini);
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
	 * 用户全删的操作
	 */
	public function user_delall()
	{
		//实例化对象
		$userObj=M("User");
		//接收动作标识
		$act=I("post.act");
		if($act=="delall")
		{
			//接收要删除的id
			$idstr=I("post.idstr");
			$ids= substr($idstr, 0,strlen($idstr)-1);
			$ini['user_id']=array("IN",$ids);
			$ini['flag']=0;
			$m=$userObj->save($ini);
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}