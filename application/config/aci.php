<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['aci_status'] = NULL;
$config['aci_module'] = array (
  'welcome' => 
  array (
    'version' => '1',
    'charset' => 'utf-8',
    'lastUpdate' => '2015-10-09 20:10:10',
    'moduleName' => 'welcome',
    'modulePath' => '',
    'moduleCaption' => '首页',
    'description' => '由autoCodeigniter 系统的模块',
    'fileList' => NULL,
    'works' => true,
    'moduleUrl' => '',
    'system' => true,
    'coder' => '胡子锅',
    'website' => 'http://',
    'moduleDetails' => 
    array (
      0 => 
      array (
        'folder' => '',
        'controller' => 'welcome',
        'method' => '',
        'caption' => '欢迎界面',
      ),
    ),
  ),
  'admin' => 
  array (
    'version' => '1',
    'charset' => 'utf-8',
    'lastUpdate' => '2015-10-09 20:10:10',
    'moduleName' => 'user',
    'modulePath' => 'admin',
    'moduleCaption' => '后台管理中心',
    'description' => '由autoCodeigniter 系统的模块',
    'fileList' => NULL,
    'works' => true,
    'moduleUrl' => 'admin/user',
    'system' => true,
    'coder' => '胡子锅',
    'website' => 'http://',
    'moduleDetails' => 
    array (
      0 => 
      array (
        'folder' => 'admin',
        'controller' => 'manage',
        'method' => 'index',
        'caption' => '管理中心-首页',
      ),
      1 => 
      array (
        'folder' => 'admin',
        'controller' => 'manage',
        'method' => 'login',
        'caption' => '管理中心-登录',
      ),
      2 => 
      array (
        'folder' => 'admin',
        'controller' => 'manage',
        'method' => 'logout',
        'caption' => '管理中心-注销',
      ),
      3 => 
      array (
        'folder' => 'admin',
        'controller' => 'profile',
        'method' => 'change_pwd',
        'caption' => '管理中心-修改密码',
      ),
      4 => 
      array (
        'folder' => 'admin',
        'controller' => 'manage',
        'method' => 'login',
        'caption' => '管理中心-登录',
      ),
      5 => 
      array (
        'folder' => 'admin',
        'controller' => 'manage',
        'method' => 'go',
        'caption' => '管理中心-URL转向',
      ),
      6 => 
      array (
        'folder' => 'admin',
        'controller' => 'manage',
        'method' => 'cache',
        'caption' => '管理中心-全局缓存',
      ),
    ),
  ),
  'user' => 
  array (
    'version' => '1',
    'charset' => 'utf-8',
    'lastUpdate' => '2015-10-09 20:10:10',
    'moduleName' => 'user',
    'modulePath' => 'admin',
    'moduleCaption' => '用户 / 用户组管理',
    'description' => '由autoCodeigniter 系统的模块',
    'fileList' => NULL,
    'works' => true,
    'moduleUrl' => 'admin/user',
    'system' => true,
    'coder' => '胡子锅',
    'website' => 'http://',
    'moduleDetails' => 
    array (
      0 => 
      array (
        'folder' => 'admin',
        'controller' => 'user',
        'method' => 'index',
        'caption' => '用户管理-列表',
      ),
      1 => 
      array (
        'folder' => 'admin',
        'controller' => 'user',
        'method' => 'check_username',
        'caption' => '用户管理-检测用户名',
      ),
      2 => 
      array (
        'folder' => 'admin',
        'controller' => 'user',
        'method' => 'delete',
        'caption' => '用户管理-删除',
      ),
      3 => 
      array (
        'folder' => 'admin',
        'controller' => 'user',
        'method' => 'lock',
        'caption' => '用户管理-锁定',
      ),
      4 => 
      array (
        'folder' => 'admin',
        'controller' => 'user',
        'method' => 'edit',
        'caption' => '用户管理-编辑',
      ),
      5 => 
      array (
        'folder' => 'admin',
        'controller' => 'user',
        'method' => 'add',
        'caption' => '用户管理-新增',
      ),
      6 => 
      array (
        'folder' => 'admin',
        'controller' => 'user',
        'method' => 'upload',
        'caption' => '用户管理-上传图像',
      ),
      7 => 
      array (
        'folder' => 'admin',
        'controller' => 'role',
        'method' => 'index',
        'caption' => '用户组管理-列表',
      ),
      8 => 
      array (
        'folder' => 'admin',
        'controller' => 'role',
        'method' => 'setting',
        'caption' => '用户组管理-权限设置',
      ),
      9 => 
      array (
        'folder' => 'admin',
        'controller' => 'role',
        'method' => 'add',
        'caption' => '用户组管理-新增',
      ),
      10 => 
      array (
        'folder' => 'admin',
        'controller' => 'role',
        'method' => 'edit',
        'caption' => '用户组管理-编辑',
      ),
      11 => 
      array (
        'folder' => 'admin',
        'controller' => 'role',
        'method' => 'delete_one',
        'caption' => '用户组管理-删除',
      ),
      12 => 
      array (
        'folder' => 'admin',
        'controller' => 'user',
        'method' => 'user_window',
        'caption' => '用户-弹窗',
      ),
      13 => 
      array (
        'folder' => 'admin',
        'controller' => 'role',
        'method' => 'group_window',
        'caption' => '用户组-弹窗',
      ),
    ),
  ),
  'moduleMenu' => 
  array (
    'version' => '1',
    'charset' => 'utf-8',
    'lastUpdate' => '2015-10-09 20:10:10',
    'moduleName' => 'moduleMenu',
    'modulePath' => 'admin',
    'moduleCaption' => '菜单管理',
    'description' => '由autoCodeigniter 系统的模块',
    'fileList' => NULL,
    'works' => true,
    'moduleUrl' => 'admin/moduleMenu',
    'system' => true,
    'coder' => '胡子锅',
    'website' => 'http://',
    'moduleDetails' => 
    array (
      0 => 
      array (
        'folder' => 'admin',
        'controller' => 'moduleMenu',
        'method' => 'index',
        'caption' => '菜单管理-列表',
      ),
      1 => 
      array (
        'folder' => 'admin',
        'controller' => 'moduleMenu',
        'method' => 'add',
        'caption' => '菜单管理-新增',
      ),
      2 => 
      array (
        'folder' => 'admin',
        'controller' => 'moduleMenu',
        'method' => 'edit',
        'caption' => '菜单管理-编辑',
      ),
      3 => 
      array (
        'folder' => 'admin',
        'controller' => 'moduleMenu',
        'method' => 'delete',
        'caption' => '菜单管理-删除',
      ),
      4 => 
      array (
        'folder' => 'admin',
        'controller' => 'moduleMenu',
        'method' => 'set_menu',
        'caption' => '菜单管理-设置菜单',
      ),
    ),
  ),
  'moduleManage' => 
  array (
    'version' => '1',
    'charset' => 'utf-8',
    'lastUpdate' => '2015-10-09 20:10:10',
    'moduleName' => 'module',
    'modulePath' => 'admin',
    'moduleCaption' => '模块安装管理',
    'description' => '由autoCodeigniter 系统的模块',
    'fileList' => NULL,
    'works' => true,
    'moduleUrl' => 'admin/moduleManage',
    'system' => true,
    'coder' => '胡子锅',
    'website' => 'http://',
    'moduleDetails' => 
    array (
      0 => 
      array (
        'folder' => 'admin',
        'controller' => 'moduleManage',
        'method' => 'index',
        'caption' => '模块管理',
      ),
      1 => 
      array (
        'folder' => 'admin',
        'controller' => 'moduleInstall',
        'method' => 'index',
        'caption' => '模块管理-开始',
      ),
      2 => 
      array (
        'folder' => 'admin',
        'controller' => 'moduleInstall',
        'method' => 'check',
        'caption' => '模块管理-检查',
      ),
      3 => 
      array (
        'folder' => 'admin',
        'controller' => 'moduleInstall',
        'method' => 'setup',
        'caption' => '模块管理-安装',
      ),
      4 => 
      array (
        'folder' => 'admin',
        'controller' => 'moduleInstall',
        'method' => 'uninstall',
        'caption' => '模块管理-卸载',
      ),
      5 => 
      array (
        'folder' => 'admin',
        'controller' => 'moduleInstall',
        'method' => 'reinstall',
        'caption' => '模块管理-重新安装',
      ),
      6 => 
      array (
        'folder' => 'admin',
        'controller' => 'moduleInstall',
        'method' => 'delete',
        'caption' => '模块管理-删除',
      ),
    ),
  ),
  'test' => 
  array (
    'version' => '1',
    'charset' => 'utf-8',
    'lastUpdate' => '2017-12-04 14:11:33',
    'moduleName' => 'test',
    'modulePath' => 'admin',
    'moduleCaption' => 'test',
    'description' => '由autoCodeigniter 自动生成的模块',
    'fileList' => NULL,
    'works' => true,
    'moduleUrl' => 'admin/test',
    'system' => false,
    'coder' => '胡子锅',
    'website' => 'http://',
    'moduleDetails' => 
    array (
      0 => 
      array (
        'folder' => 'admin',
        'controller' => 'test',
        'method' => 'index',
        'menu_name' => '管理test',
        'caption' => '管理test',
      ),
      1 => 
      array (
        'folder' => 'admin',
        'controller' => 'test',
        'method' => 'index',
        'menu_name' => 'test列表',
        'caption' => 'test列表',
      ),
      2 => 
      array (
        'folder' => 'admin',
        'controller' => 'test',
        'method' => 'add',
        'menu_name' => '新增',
        'caption' => '新增',
      ),
      3 => 
      array (
        'folder' => 'admin',
        'controller' => 'test',
        'method' => 'edit',
        'menu_name' => '修改',
        'caption' => '修改',
      ),
      4 => 
      array (
        'folder' => 'admin',
        'controller' => 'test',
        'method' => 'choose',
        'menu_name' => '选择弹窗',
        'caption' => '选择弹窗',
      ),
      5 => 
      array (
        'folder' => 'admin',
        'controller' => 'test',
        'method' => 'delete_one',
        'menu_name' => '删除单个',
        'caption' => '删除单个',
      ),
      6 => 
      array (
        'folder' => 'admin',
        'controller' => 'test',
        'method' => 'delete_all',
        'menu_name' => '删除多个',
        'caption' => '删除多个',
      ),
      7 => 
      array (
        'folder' => 'admin',
        'controller' => 'test',
        'method' => 'readonly',
        'menu_name' => '查看',
        'caption' => '查看',
      ),
      8 => 
      array (
        'folder' => 'admin',
        'controller' => 'test',
        'method' => 'upload',
        'menu_name' => '上传',
        'caption' => '上传',
      ),
    ),
  ),
  'servicer' => 
  array (
    'version' => '1',
    'charset' => 'utf-8',
    'lastUpdate' => '2017-12-06 11:11:11',
    'moduleName' => 'servicer',
    'modulePath' => 'admin',
    'moduleCaption' => '服务商列表',
    'description' => '由fanzp 手动生成的模块',
    'fileList' => NULL,
    'works' => true,
    'moduleUrl' => 'admin/servicer',
    'system' => false,
    'coder' => 'fan',
    'website' => 'http://',
    'moduleDetails' => 
    array (
      0 => 
      array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'index',
        'menu_name' => '服务商列表',
        'caption' => '服务商列表',
      ),
      2 => 
      array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'add',
        'menu_name' => '新增',
        'caption' => '新增',
      ),
      3 => 
      array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'edit',
        'menu_name' => '修改',
        'caption' => '修改',
      ),
      4 => 
      array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'choose',
        'menu_name' => '选择弹窗',
        'caption' => '选择弹窗',
      ),
      5 => 
      array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'delete_one',
        'menu_name' => '删除单个',
        'caption' => '删除单个',
      ),
      6 => 
      array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'delete_all',
        'menu_name' => '删除多个',
        'caption' => '删除多个',
      ),
      7 => 
      array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'readonly',
        'menu_name' => '查看',
        'caption' => '查看',
      ),
      8 => array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'upload',
        'menu_name' => '上传',
        'caption' => '上传',
      ),
      9 => array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'lock',
        'menu_name' => '锁定用户',
        'caption' => '锁定用户',
      ),
      10 => array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'log_list',
        'menu_name' => '查看日志',
        'caption' => '查看日志',
      ),
      11 => array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'buy_list',
        'menu_name' => '委托购买',
        'caption' => '委托购买',
      ),
      12 => array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'sell_list',
        'menu_name' => '委托出售',
        'caption' => '委托出售',
      ),
      13 => array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'platform_list',
        'menu_name' => '交易记录',
        'caption' => '交易记录',
      ),
      14 => array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'fenhong_list',
        'menu_name' => '分红点记录',
        'caption' => '分红点记录',
      ),
      15 => array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'k_list',
        'menu_name' => '每日数据统计',
        'caption' => '每日数据统计',
      ),
      16 => array (
        'folder' => 'admin',
        'controller' => 'servicer',
        'method' => 'workman',
        'menu_name' => '消息推送测试',
        'caption' => '消息推送测试',
      ),
    ),
  ),
);

/* End of file aci.php */
/* Location: ./application/config/aci.php */
