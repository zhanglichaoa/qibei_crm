<?php
namespace  Home\Controller;
use Think\Controller;
//use Home\Controller\CommonController;
class AuthController extends Controller{
	  /*
	   * 权限的列表页面
	   */
	 public function  auth_list()
	 {
	 	  //实例化对象
	 	  $compentence=M("competence");
	 	  //获取当前的页面:
	 	  $p=isset($_GET['p'])?$_GET['p']:1;
	 	  $this->assign("p",$p);
	 	  $ini=array();
	 	   //多条件查询的操作
	 	  $keyword = I('get.keyword');
	 	  if($keyword!="")
	 	  {
	 	  	 //$ini['sid&cname']=array('0',array('LIKE',"%$keyword%"),'_multi'=>true);		//多条件查询
	 	  	  $ini['cname']=array("like","%$keyword%");
	 	  }
	 	  $this->assign("keyword",$keyword);
	 	  //翻页的操作
	 	  $count=$compentence->where($ini)->count();
	 	  $Page=new \Think\Page($count,1000000);
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
	 	  $ini['sid']=0;
	 	  $arrObj=$compentence->where($ini)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
	 	 
	 	  $sidlist=$compentence->where('sid<>0')->order('dtime')->select();
	 
	 	  $this->assign("sidlist",$sidlist);
	 	  $this->assign("volist",$arrObj);
	 	  $this->assign("pagearr",$show);

	 	  $this->display();
	 	
	 }
	 /*
	  * 添加权限的操作1
	  */
	  public function cadd()
	  {
	  	  //先不考虑用户权限的验证
	  	  
	  	  //实例化对象
	  	  $co=M('competence');
	  	  $volist=$co->where('sid=0 AND status=0')->order('dtime')->getField('id,cname,status');
	  	  $this->volist=$volist;
	  	  $this->display('add');
	  	   
	  }
	  //新增权限2
	  public function cadd_do() {
	     	//验证用户权限
	  
	  	    //实例化对象
	  	    $comObj=M("Competence");
	        $act=isset($_POST['act'])?$_POST['act']:'';
	        if($act=="adds")
	        {
	        	$datas['sid'] = I('post.sid','');
	        	$datas['cname'] = I('post.cname');
	        	$datas['description'] = I('post.description');
	        	$datas['status'] = I('post.status');
	            $datas['dtime']=date("Y-m-d H:i:s",time());
	        	$n=$comObj->add($datas);
	        	if($n)
	        	{
	        		 $msgarr=array("msg"=>"添加成功");
	        	}
	        	else {
	        		 $msgarr=array("msg"=>"添加失败");
	        	}
	            echo json_encode($msgarr);
	            exit();
	        } 	        
	   }
	/*
	 * 修改权限1
	 */ 
	      public function cedit()
	      {
	      	  //接收传过来的id
		      	$id = I('get.id','');
		      	if ($id=='' || !is_numeric($id)) {
		      		$this->content='参数ID类型错误，请关闭本窗口';
		      		exit($this->display('Public:err'));
		      	}
		      	$id=intval($id);
		      	//实例化对象
		      	$co=M('competence');
		      	$volist=$co->where('sid=0 AND status=0')->order('dtime')->getField('id,cname,status');
		      	$data=array('id' => $id);
		      	$result=$co->where($data)->find();
		      	$this->assign("volist",$volist);
		      	$this->assign("result",$result);
		      	
		      	$this->display("edit");
	      }
	 /*
	  * 修改权限2
	  */
	  public function cedit_do()
	  {
		  	//验证用户权限
		  	 
		  	//实例化对象
		  	$comObj=M("Competence");
		  	$act=isset($_POST['act'])?$_POST['act']:'';
		  	if($act=="saves")
		  	{
		  		$datas['id']=I("post.id");
		  		$datas['sid'] = I('post.sid','');
		  		$datas['cname'] = I('post.cname');
		  		$datas['description'] = I('post.description');
		  		$datas['status'] = I('post.status');
		  		$datas['dtime']=date("Y-m-d H:i:s",time());
		  		$n=$comObj->save($datas);
		  		if($n)
		  		{
		  			$msgarr=array("msg"=>"修改成功");
		  		}
		  		else {
		  			$msgarr=array("msg"=>"修改失败");
		  		}
		  		echo json_encode($msgarr);
		  		exit();
	  	}
	  }
	 /*
	  * 删除权限
	  */
	 public function cdel(){
	 	      //实例化对象
	 	      $comObj=M("competence");
	 	      //接收动作标识
	 	      $act=isset($_POST['act'])?$_POST['act']:'';
	 	      if($act=="del")
	 	      {
	 	      	    //接收id
	 	      	    $id=I("post.id");
	 	      	    $ini['id']=$id;
	 	      	    $n=$comObj->where($ini)->delete();
	 	      	    if($n)
	 	      	    {
	 	      	          $msgarr['msg']="删除成功";	
	 	      	    }else {
	 	      	    	  $msgarr['msg']="删除失败";
	 	      	    }
	 	      	    echo json_encode($msgarr);
	 	      }
	 	      exit();
	 }
}