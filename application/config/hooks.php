<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['pre_controller'][] = array(  
    'class'    => 'Ceshi',        //钩子调用的类名，可以为空  
    'function' => 'ceshi',    //钩子调用的函数名  
    'filename' => 'ceshi.php',   //该钩子的文件名  
    'filepath' => 'hooks',         //钩子的目录  
    'params'   => array('beer', 'wine', 'snacks'),  //传递给钩子的参数  
);  
$hook['pre_controller'][] = array(  
    'class'    => 'Ceshi',        //钩子调用的类名，可以为空  
    'function' => 'ceshis',    //钩子调用的函数名  
    'filename' => 'ceshi.php',   //该钩子的文件名  
    'filepath' => 'hooks',         //钩子的目录  
    'params'   => array('beer', 'wine', 'snacks'),  //传递给钩子的参数  
);  
$hook['index'][] = array(  
    'class'    => 'Ceshi',        //钩子调用的类名，可以为空  
    'function' => 'index',    //钩子调用的函数名  
    'filename' => 'ceshi.php',   //该钩子的文件名  
    'filepath' => 'hooks',         //钩子的目录  
    'params'   => array(''),  //传递给钩子的参数  
);  