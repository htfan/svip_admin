<?php

/* 
 * 表单验证配置
 */
$config['error_prefix'] = '<div style="color:white;">';
$config['error_suffix'] = '</div>';
$config = array(
    'error_prefix'=> '<div style="color:white;">',
    'error_suffix'=>  '</div>',
    'login' => array(
        array(
            'field' => 'username',
            'label' => '用户名',
            'rules' => 'required|alpha_numeric|min_length[5]|max_length[12]',
        ),
        array(
            'field' => 'password',
            'label' => '密码',
            'rules' => 'required|alpha_dash|min_length[6]|max_length[20]|callback_login_check'
        )
      
    ),
    'servicer_add' => array(
        array(
            'field' => 'mobile',
            'label' => '电话',
            'rules' => 'required|numeric|is_unique[mdh_servicer.mobile]',
        ),
        array(
            'field' => 'price',
            'label' => '价格',
            'rules' => 'required|numeric',
        ),
        array(
            'field' => 'cate_id',
            'label' => '角色状态',
            'rules' => 'required|in_list[0,1,2,3]'
        )
      
    ),
    'servicer_edit' => array(
        array(
            'field' => 'mobile',
            'label' => '电话',
            'rules' => 'required|numeric',
        ),
        array(
            'field' => 'price',
            'label' => '价格',
            'rules' => 'required|numeric',
        ),
        array(
            'field' => 'cate_id',
            'label' => '角色状态',
            'rules' => 'required|in_list[0,1,2,3]'
        )
      
    ),
    'change' => array(
        array(
            'field' => 'password',
            'label' => '密码',
            'rules' => 'required|alpha_dash|min_length[6]|max_length[20]'
        ),
        array(
            'field' => 'type',
            'label' => '类型',
            'rules' => 'required|in_list[dl,jy,sj]'
        )
      
    ),
  
);
