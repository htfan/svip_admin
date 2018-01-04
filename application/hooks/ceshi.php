<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ceshi
 *
 * @author Administrator
 */
class Ceshi {
    //put your code here
    private $CI ;
    
    function __construct() {
        $this->CI = &get_instance();
    }

    public function ceshi()
    {
        
        log_message("error", "钩子测试");
    }
    public function ceshis()
    {
        
        log_message("error", "再次调取钩子测试");
    }
    public function index()
    {
        
        log_message("error", "进入首页调取的钩子");
    }
}
