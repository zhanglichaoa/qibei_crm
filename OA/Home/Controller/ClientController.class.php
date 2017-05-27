<?php
namespace  Home\Controller;
//use Think\Controller;
use Home\Controller\CommonController;
class ClientController extends CommonController
{
       	/*
       	 * 客户资料列表页
       	 */
	   public function client_list()
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
	   	    	     	     $this->assign("title",$title);
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
	           $clientObj=D("Client");
	           if(IS_POST)
	           {
	           	     $m=$clientObj->create();
	           	     $client['xlr_name']=$m['xlr_name'];
	           	     $arr=$clientObj->where($client)->find();
	           	     if(!empty($arr)){
	           	     	  $this->error("该客户已经存在");
	           	     }
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
	   public function client_delall()
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
	  /*
	   * 售后工单列表页面
	   */
	   public function shouhou_list()
	   {
	   	    //登录的id
	       //  $uid=session("UID");
	        //实例化对象
	        $workObj=D("Shgd");
	        $ini['status']=1;
	        //当前的页数
	        $p=isset($_GET['p'])?$_GET['p']:1;
	        $this->assign("p",$p);
	        //查询的操作
	        if(IS_GET)
	        {
	        	    $title=I("get.shouhou",'');
	        	    if($title !="")
	        	    {
	        	    	   $ini['title']=array("like","%{$title}%");
	        	    }
	        	    $this->assign("title",$title);
	        }
	        
	        //翻页的操作
	        $count=$workObj->where($ini)->count();
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
	        //$cont=$workObj->alias("k")->field("k.*,c.title")->join("crm_workorder as c on k.id=c.kehu_id ","left")->limit($Page->firstRow.",".$Page->listRows)->select();
	        $cont=$workObj->where($ini)->limit($Page->firstRow.",".$Page->listRows)->select();
	        $this->assign("arr",$cont);
	        $this->assign("pagearr",$show);
	        
	   	    $this->display();
	   }
	   /*
	    * 添加录入售后工单
	    */
	   public function shouhou_add(){
	   	   //实例化对象
	   	   $shgdObj=D("Shgd");
	   	   if(IS_POST){
	   	   	         $m=$shgdObj->create();
	   	   	         //判断工单是否存在
	   	   	         $gd['title']=$m['title'];
	   	   	         $gdArr=$shgdObj->where($gd)->find();
	   	   	         if(!empty($gdArr)){
	   	   	         	$this->error("工单已经存在");
	   	   	         }
	   	   	         if($m){
	   	   	         	 $m['content']=html_entity_decode($m['content']);
	   	   	         	 $n=$shgdObj->add($m);
	   	   	         	 if($n){
	   	   	         	 	   $this->success("添加成功",U("Client/shouhou_list"));
	   	   	         	 }else{
	   	   	         	 	   $this->error("添加失败");
	   	   	         	 }   	   	         	
	   	   	         }else{
	   	   	         	   $this->error("数据创建失败------".$shgdObj->getError());
	   	   	         }
	   	   }
	   	
	   	
	   	    $this->display();
	   }
	   
	   
	   
	   /*
	    * 提交售后工单
	    */
	   public function shouhou_edit()
	   {
	   	      //实例化对象
	   	      $workObj=D("Workorder");
	   	      if(IS_POST)
	   	      {
	   	      	   $p=I("post.p");
	   	      	   $n=$workObj->create();
	   	      	   if($n)
	   	      	   {
	   	      	   	        $n['description']=html_entity_decode($n['description']);
	   	      	   	        $m=$workObj->save($n);
	   	      	   	        if($m)
	   	      	   	        {
	   	      	   	        	    $this->success("提交成功",U("Home/Client/shouhou_list/p/{$p}"));
	   	      	   	        }else {
	   	      	   	        	  $this->error("提交失败");
	   	      	   	        }
	   	      	   	        
	   	      	   }else
	   	      	   {
	   	      	   	    $this->error("数据创建失败------".$workObj->getError());	   	      	   	
	   	      	   }
	   	      }
	   	      $id=I("get.id","");
	   	      $p=I("get.p","");
	   	      $ini['id']=$id;
	   	      //工单类型的查询
	   	      $cate=$workObj->where($ini)->find();
	   	      $this->assign("catearr",$cate);
	   	      $this->assign("p",$p);
	   	      $this->display();
	   }
	   /*
	    * 上传的文件
	    */
	   public  function  uploadfiles()
	   {
			  $con=array(
			   			"maxSize"=>1024*1024*2,//文件大小
			   			"exts"=>array('jpg','gif','png','jpeg','html','text','php','css','pdf'),//文件类型
			   			"autoSub"=>false,
			   			"rootPath"=>"./",//根目录   
			   			"savePath"=>"Public/upload/".date("Y-m")."/",//路径，相对于项目名下
			   	);
			   	$upobj = new \Think\Upload($con);
			   	$arr = $upobj->upload();
			   	if ($arr) {//上传成功
			   		$res['upimg']=$arr['file']['savepath'].$arr['file']['savename'];
			   		echo json_encode($res);
			   	}else{//上传失败
			   		echo "上传失败：".$upobj->getError();
			   	}
			   	exit();	   	     
	   }
	   /*
	    * 售后工单单删的操作
	    */
	     public function shouhou_delone()
	     {
		     	$workObj=D("Shgd");
		     	//获取动作标识
		     	$act=isset($_POST['act'])?$_POST['act']:'';
		     	if($act=="del")
		     	{
		     		//id
		     		$id=I("post.ids","");
		     		$ini['id']=$id;
		     		$ini['status']=0;
		     		$m=$workObj->save($ini);
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
	    * 售后工单多删的操作
	    */
	   public function shouhou_delall()
	   {
			   	//实例化对象
			   	$workObj=D("Shgd");
			   	//动作标识
			   	$act=isset($_POST['act'])?$_POST['act']:'';
			   	if($act=="delall")
			   	{
			   		//接收id
			   		$ids=I("post.idstr");
			   		$id=substr($ids, 0,strlen($ids)-1);
			   		$ini['id']=array("in",$id);
			   		$ini['status']=0;
			   		$m=$workObj->save($ini);
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