<?php
namespace Home\Controller;
//use Think\Controller;
use Home\Controller\CommonController;
class PublicController extends CommonController{
	public function header() {
		//获取session值
		$name=session("UNAME");
		$this->assign("name",$name);
		$this->display();
	}
	public function left() {
		$this->display();
	}
	public function right() {
		//登录时间
		$time = date("Y-m-d H:i:s");
		$this->assign("time",$time);
		
		//登录用户
		$uname = I("session.UNAME");
		$this->assign("uname",$uname);
		$id=session("UID");
		$uerObj=M("User");
		$arr=$uerObj->where("user_id={$id}")->find();
		$this->assign("arr",$arr);
		$this->display();
	}
	public function kuozhan()
	{
		  $this->display();
	}
	
}