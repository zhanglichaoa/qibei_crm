<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{
	    //公共权限认证控制器
	    public function  _initialize(){
	    	$this->checkLogin();	    	
	    	$this->checkauths();
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
	   	     	   exit();
	   	     }	   	    
	   }
	  /*
	   * 判断是否有权限
	   */
	   public function checkauths()
	   {
	   	       $Auth = new \Think\Auth();
	   	       $module_name=MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;      //Admin/Index/index  url路径
	   	       //判断某个功能是否具有权限	   	    
	   	        if($_SESSION['ZhangHao']==C('ADMIN_AUTH_KEY')){    //以用户名来判断是否是超级管理员，绕过验证，不用用户组来判断的原因是用户组有时候是中文    ，而且常删除或更改。
	   	        return true;
	   	        }
	   	        if(!$Auth->check($module_name,$_SESSION["UID"])){
	   	           $this->error('对不起,您没有这项权限');
	   	        }
	   }
	   
	   
	   
	   
	   
	   
}