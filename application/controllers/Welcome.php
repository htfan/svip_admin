<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends Front_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{

		$cache_chomd = octal_permissions(fileperms(APPPATH.'cache'));
         
		$this->reload_all_cache();//更新全局菜单缓存，可以去掉这行
		$this->view('index',array('date'=>date('Y-m-d H:i:s'),'cache_chomd'=>$cache_chomd));
	}
        
        function demo(){
            // 一个基本的购物车，包括一些已经添加的商品和每种商品的数量。
            // 其中有一个方法用来计算购物车中所有商品的总价格，该方法使
            // 用了一个 closure 作为回调函数。
            $this->load->library("Carts","carts");
            // 往购物车里添加条目
            $this->carts->add('butter', 1);
            $this->carts->add('milk', 3);
            $this->carts->add('eggs', 6);

            // 打出出总价格，其中有 5% 的销售税.
            print $this->carts->getTotal(0.05) . "\n";
            // 最后结果是 54.29
            $func = function( $param ) {
                echo $param;
            };
            $func( 'some string' );
            //输出：
            //some string
        }
	
	
}

            