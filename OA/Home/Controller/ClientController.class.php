<?php
namespace  Home\Controller;
use Think\Controller;
class ClientController extends Controller
{
       	/*
       	 * 客户资料列表页
       	 */
	   public function client_list()
	   {
	   	    //实例化对象
	   	    $clientObj=M("Client");
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
	 /*
	  * 客户资料添加页面
	  */
	  public function client_add()
	  {
	           //实例化对象
	           $clientObj=M("Client");
	           if(IS_POST)
	           {
	           	     $m=$clientObj->create();
	           	     if($m)
	           	     {
	           	     	  $n=$clientObj->add();
	           	     	  if($n)
	           	     	  {
	           	     	  	     $this->success("添加成功",U("Client/client_list"));
	           	     	  }else {
	           	     	  	     $this->error("添加失败".$clientObj->getError());
	           	     	  	
	           	     	  }
	           	     }else {
	           	     	 $this->error("数据创建失败".$clientObj->getError());
	           	     }
	           	
	           } 	
	  	
	  	
	  	        $this->display();
	  }
	   /*
	    * 客户管理修改页面
	    */
	   public function client_edit()
	   {
	   	      //实例化对象
	   	      $clientObj=M("Client");
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
	   	      	       	  $this->error("数据创建失败".$clientObj->getError());
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
	   public function client_delone()
	   {
	   	       $clientObj=M("Client");
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
	   	      	      	      $arr=array("msg"=>"删除成功");
	   	      	      }else {
	   	      	      	      $arr=array("msg"=>"删除失败");
	   	      	      }
	   	      	     echo json_encode($arr);
	   	      }
	   	      exit();
	   	
	   }
	  /*
	   *  客户管理多删的操作
	   */
	   public function client_delall()
	   {
	   	        //实例化对象
	   	        $clientObj=M("Client");
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
	   	        	      	   $arr=array("msg"=>"删除成功");
	   	        	      }
	   	        	      else {
	   	        	      	   $arr=array("msg"=>"删除失败");
	   	        	      }
	   	        	      echo json_encode($arr);
	   	        	      exit();
	   	        }
	   	       
	   	
	   }
	
	
}