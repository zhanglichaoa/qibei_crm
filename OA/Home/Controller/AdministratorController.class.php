<?php
namespace  Home\Controller;
use Home\Controller\CommonController;
//use Think\Controller;
class AdministratorController extends CommonController
{
	 /*
	  * 角色管理列表页
	  */
	public function role_list(){
		//实例化对象
		$roleObj=D("AuthGroup"); 
		//查询的操作
		$title=I("get.juese");
		$this->assign("title",$title);
		$ini=array();
		$ini['status']=1;
		if($title!="")
		{
			  $ini['title']=array("like","%{$title}%");
		}
		//当前的页数
		$pno=isset($_GET['p'])?$_GET['p']:1;
		$this->assign("pno",$pno);
		//翻页的功能
		$count=$roleObj->where($ini)->count();
		$Page=new \Think\Page($count,5);
		//***** 分页样式定制
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('first', '首页');
        $Page->setConfig('end', '末页');
        //***** 这里定义分页的各个单元的显示位置
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');		
		$show=$Page->show();
		//要查询的内容
		$rolecontent=$roleObj->where($ini)->limit($Page->firstRow.','.$Page->listRows)->select();
		//实例化权限规则表
		$authRule=D("AuthRule");
		foreach ($rolecontent as $k=>$v){//一维数组
			    $where['id']=array("in",$v['rules']);
			    $authruleArr=$authRule->where($where)->select();
			    $i=1;
			    foreach ($authruleArr as $x){
			    	      $nameArr[$k][]=$x['title'];
			    	      //每10个权限显示一行
			    	      $i++;
			    	      if($i>10){
			    	      	    $nameArr[$k][]="<br>";
			    	      	    $i=1;
			    	      }		    	      	
			    }
			    $rolecontent[$k]['rules']=implode("&nbsp", $nameArr[$k]);//添加一个字段,将规则添加进入			    
		}
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
		header("Content-Type:text/html; charset=UTF-8");
		//实例化对象
		$roleObj=D("AuthGroup");
		if(IS_POST)
		{
			$m=$roleObj->create();//数据的收集
			$title['title']=$m['title'];
			$titlearr=$roleObj->where($title)->find();
			if(!empty($titlearr)){
				$this->error("角色组名已存在,请重新输入");
			}
			if($m)
			{
				//数据创建成功，调用添加的方法
				$m['rules']=implode(",", $m['rules']);
				$n=$roleObj->add($m);
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
		//内容的查询
		$authrule=D("AuthRule");
		$ini['status']=1;
		//按照组来查询所有的类型
		$groupArr=$authrule->where($ini)->group("flagname")->select();
		foreach ($groupArr as $v){
			    $jsArr[]=$v['flagname'];   //左侧的组名称
		}
		//右侧的权限       $arr[权限类型][]=每个权限数组
		$ruleArr=$authrule->where($ini)->select();
		foreach ($ruleArr as $k=>$v){
			     $arr[$v['flagname']][]=$v;
		}
		//全选与全不选
		//$valarr[权限类型]=$i
		$i=1;
		foreach ($arr as $k=>$v){
			$valarr[$k]=$i;
			$i++;
		}
		$this->assign("arr",$arr);
		$this->assign("valarr",$valarr);

	   $this->display();
	}
	/*
	 * 角色管理修改页面
	 */
	public function role_edit()
	{
		header("Content-Type:text/html; charset=UTF-8");
		 //实例化对象
		$authrule = D("AuthRule");
		$authgroup=D("AuthGroup");
		if(IS_POST)
		{
			 //接收id和当前的页数
			 $p=I("post.p");
			 $m=$authgroup->create();	
			 if($m)
			 {
			 	   $m['rules']=implode(",", $m['rules']);
			 	   $n=$authgroup->save($m);
			 	   if($n || $n===0)
			 	   {
			 	   	    $this->success("修改成功",U("Home/Administrator/role_list/p/{$p}"));			 	   	
			 	   }else {
			 	   	$this->error("修改失败");
			 	   }
			 }else{
			 	$this->error("数据创建失败-------".$authgroup->getError());
			 }
		    exit();
		}
		//获取传递的id和当前的页数
		$p=I("get.p");
		$id=I("get.id");
		$ini['id']=$id;
		//-------------------------------修改的列表页开始
		//要修改组id的内容
		$contArr=$authgroup->where($ini)->find();
		//要修改的详细的权限
		$ini['id']=array("in",$contArr['rules']);
		$ruleArr=$authrule->where($ini)->select();
		$arr=array();
		foreach ($ruleArr as $k =>$v){
			   $arr[$v['id']]=$v['title'];//遍历成一维数组  修改的id的权限内容
		}
	    //$arr[权限类型][]=每个权限数组
	    //查询所有的权限
	    $where['status']=1;
		$qxArr=$authrule->where($where)->select();
		foreach ($qxArr as $vv){
			    $lxArrs[$vv['flagname']][]=$vv;
		}
		//全选的操作
		//$valarr[权限类型]=$i
		$i=1;
	    foreach ($lxArrs as $kkk=>$x){
	    	    $valarr[$kkk]=$i;
	    	    $i++;
	    }	    
		$this->assign("valarr",$valarr);
		$this->assign("arr",$lxArrs)	;
		$this->assign("group",$contArr);   
		$this->assign("rule",$arr);
		//$this->assign("arr",$content);
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
	  	  $roleObj=D("AuthGroup");
	  	  //接收id
	  	  $ids=I("post.ids");
	  	  //接收动作标识
	  	 $act=I("post.act");
	  	 if($act=="del")
	  	 {
	  	 	     $ini['status']=0;
	  	 	     $ini['id']=$ids;
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
	 public function role_delall()
	 {
	 	 //实例化对象
	 	 $roleObj=D("AuthGroup");
	 	 //接收动作标识
	 	 $act=I("post.act");
	 	 if($act=="delall")
	 	 {
	 	 	    //接收要删除的id
	 	 	    $idstr=I("post.idstr");
	 	 	    $ids= substr($idstr, 0,strlen($idstr)-1);
	 	 	    $ini['id']=array("IN",$ids);
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
		$usr=D("User");
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
			  $ini['user_xingming']=array("like","%{$title}%");			
		}
		$count=$usr->where($ini)->count();
		$Page=new \Think\Page($count,6);
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
		//$usercont=$usr->alias('u')->field("u.*,g.title")->join("crm_auth_group as g on u.roleid=g.id","left")->where($ini)->limit($Page->firstRow.','.$Page->listRows)->select();
		$usercont=$usr->alias("u")->field("u.*,g.title")->join("crm_auth_group_access as a on u.user_id=a.uid","left")->join("crm_auth_group as g on a.group_id=g.id","left")->where($ini)->limit($Page->firstRow.','.$Page->listRows)->select();
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
	 	    $user=D("User");
	 	    $role=D("AuthGroup");
	 	    $ini['status']=1;
	 	    //接受数据
	 	    if(IS_POST)
	 	    {
	 	    	    $m=$user->create(); 	    	    
	 	    	    if($m)
	 	    	    {	 	    	    	
	 	    	    	  $m['last_time']=time();
	 	    	    	  $n=$user->add($m);//返回的是主键id;   先主表后从表
	 	    	    	  if($n)
	 	    	    	  {	 	    	    	  	 
	 	    	    	  	  //权限详细表
	 	    	    	  	  $groupAccess=D("AuthGroupAccess");
	 	    	    	  	  $arr['uid']=$n;
	 	    	    	  	  $arr['group_id']=I("post.roleid");
	 	    	    	  	  $nn=$groupAccess->add($arr);
	 	    	    	  	  if($nn)
	 	    	    	  	  {
	 	    	    	  	  	      $this->success("用户添加成功",U("Home/Administrator/user_list"));
	 	    	    	  	  }else{
	 	    	    	  	  	      $this->error("用户添加失败");   
	 	    	    	  	  }
	 	    	    	  }
	 	    	    }
	 	    	    else {
	 	    	    	$this->error("数据创建失败---".$user->getError());
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
	  	$user=D("User");
	  	$groupObj=D('AuthGroup');
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
	  				//$this->success("修改成功",U("Home/Administrator/user_list/p/{$p}"));
	  				//权限明细表的修改 先删除后添加
	  				$AccessObj=D("AuthGroupAccess");
	  				$id=$m['user_id'];
	  				$del=$AccessObj->where(array("uid"=>$id))->delete();
	  				if($del)
	  				{
	  					  $ini['uid']=$m['user_id'];
	  					  $ini['group_id']=I("post.roleid");
	  					  $add=$AccessObj->add($ini);
	  					  if($add){
	  					  	     $this->success("修改成功",U("Home/Administrator/user_list/p/{$p}"));
	  					  }else{
	  					  	     $this->error("修改失败。。。。");
	  					  }
	  				}
	  		    	
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
		$rolearr=$groupObj->select();
		$this->assign("grouparr",$rolearr);
	  	
	  	
	  	 $this->display();
	  }
	/*
	 * 用户单删的操作
	 */
	public function user_delone()
	{
			//实例化对象
			$userObj=D("User");
			$AccessObj=D("AuthGroupAccess");
			//接收id
			$ids=I("post.ids");
			//接收动作标识
			$act=I("post.act");
			if($act=="del")
			{
					if($userObj->where(array("user_id"=>$ids))->delete()){
						  $AccessObj->where(array("uid"=>$ids))->delete();
						  $msgarr['msg']="删除成功";
					}else{
						  $msgarr["msg"]="删除失败";
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
		$userObj=D("User");
		$AccessObj=D("AuthGroupAccess");
		//接收动作标识
		$act=I("post.act");
		if($act=="delall")
		{
			//接收要删除的id
			$idstr=I("post.idstr");
			$ids= substr($idstr, 0,strlen($idstr)-1);
			$ini['user_id']=array("IN",$ids);
			$m=$userObj->where($ini)->delete();
			if($m)
			{
				    $arr['uid']=array("in",$ids);
				    $mm=$AccessObj->where($arr)->delete();
				    if($mm){
				    	   $msgarr['msg']="删除成功";
				    }else{
				    	   $msgarr['msg']="删除失败";
				    }
			}
			echo json_encode($msgarr);
			exit();
		}
		
	}	
}