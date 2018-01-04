<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * AutoCodeIgniter.com
 *
 * 基于CodeIgniter核心模块自动生成程序
 *
 * 源项目		AutoCodeIgniter
 * 作者：		AutoCodeIgniter.com Dev Team
 * 版权：		Copyright (c) 2015 , AutoCodeIgniter com.
 * 项目名称：test MODEL
 * 版本号：1 
 * 最后生成时间：2017-12-04 14:11:33 
 */
class Test_model extends Base_Model {
	
    var $page_size = 10;
    function __construct()
	{
    	$this->db_tablepre = 't_aci_';
    	$this->table_name = 'test';
		parent::__construct();
	}
    
    /**
     * 初始化默认值
     * @return array
     */
    function default_info()
    {
    	return array(
		'test_id'=>0,
		'title'=>'',
		'url'=>'',
		'content'=>'',
		'image'=>'',
		'profile'=>'',
		'email'=>'',
		'mobile'=>'',
		'ymd'=>'',
		'ymdhis'=>'',
		'his'=>'',
		'unique_num'=>'',
		'password'=>'',
		'number'=>'',
		'price'=>'',
		'is_display'=>'',
		'is_work'=>'',
		'area'=>'',
		'city'=>'',
		'author_id'=>'',
		'favorite'=>'',
		'course'=>'',
		'author_ids'=>'',
		'file'=>'',
		'current_uid'=>'',
		'current_user'=>'',
		'current_time'=>'',
		);
    }
    
    /**
     * 安装SQL表
     * @return void
     */
    function init()
    {
    	$this->query("CREATE TABLE  IF NOT EXISTS `t_aci_test`
(
`title` varchar(250) DEFAULT NULL COMMENT '标题',
`url` varchar(50) DEFAULT NULL COMMENT '跳转链接',
`content` text COMMENT '内容',
`image` varchar(250) DEFAULT NULL COMMENT '新闻图片',
`profile` text COMMENT '简介',
`email` varchar(50) DEFAULT NULL COMMENT '邮箱',
`mobile` varchar(50) DEFAULT NULL COMMENT '手机号',
`ymd` date DEFAULT NULL COMMENT '年月日',
`ymdhis` datetime DEFAULT NULL COMMENT '年月日时分秒',
`his` time DEFAULT NULL COMMENT '时分秒',
`unique_num` varchar(50) DEFAULT NULL COMMENT '唯一编号',
`password` varchar(50) DEFAULT NULL COMMENT '密码',
`number` int(11) DEFAULT '0' COMMENT '数字',
`price` decimal(10,2) DEFAULT '0.00' COMMENT '价格',
`is_display` char(2) DEFAULT NULL COMMENT '是否显示',
`is_work` char(2) DEFAULT NULL COMMENT '是否工作',
`area` varchar(250) DEFAULT NULL COMMENT '地区',
`city` varchar(250) DEFAULT NULL COMMENT '城市',
`author_id` varchar(50) DEFAULT NULL COMMENT '发布员id',
`favorite` varchar(250) DEFAULT NULL COMMENT '爱好',
`course` varchar(250) DEFAULT NULL COMMENT '课程',
`author_ids` varchar(50) DEFAULT NULL COMMENT '允许修改的人员',
`file` varchar(250) DEFAULT NULL COMMENT '下载文件',
`current_uid` varchar(50) DEFAULT NULL COMMENT '当前用户id',
`current_user` varchar(50) DEFAULT NULL COMMENT '当前用户名',
`current_time` varchar(50) DEFAULT NULL COMMENT '当前系统时间',
`test_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
PRIMARY KEY (`test_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
");
    }
    
        }

// END test_model class

/* End of file test_model.php */
/* Location: ./test_model.php */
?>