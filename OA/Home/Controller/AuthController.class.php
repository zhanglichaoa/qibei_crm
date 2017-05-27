<?php
namespace  Home\Controller;
//use Think\Controller;
use Home\Controller\CommonController;
class AuthController extends CommonController{
	  /*
	   * 权限的列表页面
	   */
	  public function auth_list()
	  {
	  	   //实例化权限表
	  	   $authrule=D("AuthRule");
	  	   //$ini['status']=1;
	  	   $ini=array();
	  	   $ini['flags']=1;
	  	   //当前的页数
	  	   $p=isset($_GET["p"])?$_GET['p']:1;
	  	   $this->assign("p",$p);
	  	   //查询的操作
	  	   if(IS_GET)
	  	   {
	  	   	     $title=I("get.quanxian");
	  	   	     if(!empty($title))
	  	   	     {
	  	   	     	      $ini['title']=array("like","%{$title}%");
	  	   	     }
	  	   	     $this->assign("title",$title);
	  	   }
	  	   //查询总数
	  	   $count = $authrule->where($ini)->count();
	  	   $Page=new \Think\Page($count,8);
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
	  	   $content=$authrule->where($ini)->order("id asc")->limit($Page->firstRow.",".$Page->listRows)->select();
	  	   $this->assign("autharr",$content);
	  	   $this->assign("pagearr",$show);
	  	   $this->display();
	  }
	  /**
	   * 添加权限
	   */
	 public function auth_add()
	 {
	 	  header("Content-Type:text/html; charset=UTF-8"); 	  
	 	  if (IS_POST) {
	 	  	$authrule = D("AuthRule");
	 	  	$authruleArr = $authrule->create();
	 	  	if ($authruleArr) {
	 	  		//汉字转拼音
	 	  		$authruleArr['flag'] = Pinyin($authruleArr['flagname']);
	 	  		$rtn = $authrule->add($authruleArr);
	 	  		if ($rtn) {
	 	  			$this->success("添加成功",U("Home/Auth/auth_add"));
	 	  		}else{
	 	  			$this->error("添加失败");
	 	  		}
	 	  	}else{
	 	  		$this->error("数据创建失败---".$authrule->getError());
	 	  	}
	 	  	exit();
	 	  }
	 	  //分组标识
	 	  $groupObj=D("AuthGroup");
	 	  //内容的查询
	 	  $content=$groupObj->select();
	 	  $this->assign("volist",$content);
	 	  $this->display();
	 }
	 /**
	  * 修改权限
	  */
	 public function auth_edit()
	 {
	 	if(IS_POST)
	 	{
	 		$authRule=D("AuthRule");
	 		$m=$authRule->create();
	 		if($m)
	 		{
	 			$m['flag']=Pinyin($m['flagname']);
	 			$n=$authRule->save($m);
	 			if($n)
	 			{
	 				$this->success("修改成功",U("Home/Auth/auth_edit"));
	 			}
	 			else {
	 				$this->error("修改失败");
	 			}
	 		}else {
	 			$this->error("数据创建失败".$authRule->getError());
	 		}
	 		exit();
	 	}
	 	  //接受传递过来的id
	 	  $ini['id']=I("get.id");
	 	  $ruleArr=D("AuthRule");
	 	  $rulearr=$ruleArr->where($ini)->find();
	 	  $this->assign("result",$rulearr);
	 	  //分组标识
	 	  $groupObj=D("AuthGroup");
	 	  //内容的查询
	 	  $content=$groupObj->select();
	 	  $this->assign("volist",$content);	 	 	 
	 	  $this->display();
	 	
	 }
	 /*
	  * 权限单删的操作
	  */
	 public function auth_delone()
	 {
	 	   $act=I("post.act");
	 	   if($act=="del")
	 	   {
	 	   	      $id=I("post.ids");
	 	   	      //实例化对象
	 	   	      $rulearr=D("AuthRule");
	 	   	      $ini['id']=$id;
	 	   	      $ini['flags']=0;
	 	   	      $m=$rulearr->save($ini);
	 	   	      if($m)
	 	   	      {
	 	   	      	   $arr['msg']="删除成功";
	 	   	      }else{
	 	   	      	   $arr['msg']="删除失败";
	 	   	      }
	 	   	      echo json_encode($arr);
	 	   }
	 	   exit();
	 	
	 }
	 /**
	  * 权限多删的操作
	  */
	 public function auth_delall()
	 {
	 	  $authRole=D("AuthRule");
	 	  $act=I("post.act");
	 	  if($act=="delall")
	 	  {
	 	  	     //接收id
	 	  	     $idstr=I("post.idstr");
	 	  	     $ids=substr($idstr, 0,strlen($idstr)-1);
	 	  	     $ini['id']=array("in",$ids);
	 	  	     $ini['flags']=0;
	 	  	     $marr=$authRole->save($ini);
	 	  	     if($marr)
	 	  	     {
	 	  	     	    $arr['msg']="删除成功";
	 	  	     }else {
	 	  	     	    $arr['msg']="删除失败";
	 	  	     }
	 	  	     echo json_encode($arr);
	 	  }
	 	  exit();
	 }
	 
	 
	 
	 
	 
	 
}