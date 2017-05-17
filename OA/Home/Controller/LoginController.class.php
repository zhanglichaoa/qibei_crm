<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller
{
	//登录类
	public function login_list()
	{
		//退出系统的操作
		$act=$_GET['act'];
		if($act=="exit")
		{
			    session("UNAME",null);
			    session("UID",null);
			    session("ROLE",null);
			    $this->success("退出成功",U("Home/Login/login_list"));
			    exit();
		}
		
		//实例化对象
		$user=M("User");
		if(IS_POST)
		{
			    //接收验证码
			    $code=I("post.code");
			   //调用生成验证码的类
			   $verfy=new \Think\Verify();
			   if(!$verfy->check($code,1))
			   {
			   	   $this->error("验证码不正确");			   	
			   }
			   else{
			   	     //验证帐号和密码
			   	     $usr=I("post.user_name");
			   	     $pwd=I("post.password");
			   	     $ini['user_name']=$usr;
			   	     $arrObj=$user->where($ini)->find();
			   	     if($arrObj=="")
			   	     {			   	     	  
			   	     	   $this->error("帐号不正确");   
			   	     }else {
			   	     	//判断密码
			   	     	    if($pwd==$arrObj['password'])
			   	     	    {
			   	     	    	session("UNAME",$arrObj['user_name']);
			   	     	    	session("UID",$arrObj['user_id']);
			   	     	    	session("ROLE",$arrObj['roleid']);
			   	     	    	$this->success("登录成功",U("Home/Index/index"));		   	     	    	
			   	     	    }else {
			   	     	    	 $this->error("密码不正确");
			   	     	    }
			   	     	
			   	     }
			   }
			   
		}
		
		
		
		
		 $this->display();
	}
	/*
	 * 生成验证码的类
	 */
	public function yzm()
	{
		$arr=array(
			"fontSize"=>30,
		    "length"=>4			
		);
		//调用验证码的类
		$verify=new \Think\Verify($arr);
		$verify->entry(1);
		
	}
	
}