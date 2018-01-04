<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*/
class Servicer_model extends Base_Model {
    var $page_size = 10;
    
    public function __construct() {
        $this->db_tablepre = 'mdh_';
    	$this->table_name = 'servicer';
        parent::__construct();
    }

    

    /**
     * 用户弹窗
     * @return array
     */
    function user_window_datasource($where='',$limit = '', $order = '', $group = '', $key=''){
    	
    	$datalist = $this->select($where,'user_id,username',$limit,$order,$group,$key);
        return $datalist;
    }

     /**
     * 用户下拉框
     * @return array
     */
    function user_dropdown_datasource($where='',$limit = '', $order = '', $group = '', $key=''){
        
        $datalist = $this->select($where,'user_id,username',$limit,$order,$group,$key);
        return $datalist;
    }

    /**
     * 用户下拉值
     * @return array
     */
    function user_dropdown_value($id){
        
        $datainfo = $this->get_one(array('user_id'=>$id));
        return isset($datainfo['username'])?$datainfo['username']:'-';
    }
    
 

    

}