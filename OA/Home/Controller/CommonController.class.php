<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{
	    //公共权限认证控制器
	    public function  _initialize(){
	    	$this->checkLogin();
	    	//$this->checkAuths();
	    }
	    /*
	     * 判断是否登录
	     */
	   public function checkLogin(){
	   	     $id=I("session.UID");
	   	     $name=I("session.UNAME");
	   	     if($id=="" || $name=="")
	   	     {
	   	     	   $this->error("您还没有登录,请先登录",U("Home/Login/login_list"));
	   	     }
	   	     exit();
	   }
	   
	   
	   
	   
	   
	   
	   
	   
	   
}