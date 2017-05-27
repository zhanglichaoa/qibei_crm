<?php
return array(
	//'配置项'=>'配置值'
	
    // 设置模板变量左右定界符
    'TMPL_L_DELIM' =>'<{',
    'TMPL_R_DELIM' =>'}>',

    // 设置数据库信息[全局]
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'crm',
    'DB_USER' => 'root',
    'DB_PWD' => 'root',
    'DB_PORT' => '3306',
    'DB_PREFIX' => 'crm_',    
	//权限验证设置
	'AUTH_CONFIG'=>array(
		 'AUTH_ON' => true, //认证开关
		 'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
		 'AUTH_GROUP' => 'crm_auth_group', //用户组数据表名
		 'AUTH_GROUP_ACCESS' => 'crm_auth_group_access', //用户组明细表
		 'AUTH_RULE' => 'crm_auth_rule', //权限规则表
		 'AUTH_USER' => 'crm_user'//用户信息表
	),
   //超级管理员id,拥有全部权限,只要用户uid在这个角色组里的,就跳出认证.可以设置多个值,如array('1','2','3')
  'ADMINISTRATOR'=>array('1'),
    
    // 开启页面调试信息
    'SHOW_PAGE_TRACE' => true,    
    
);