<?php

/**
 * 毫秒时间戳
 */
if ( ! function_exists('root'))
{
    function root() 
    {
        list($s1, $s2) = explode(' ', microtime());
        return (float) sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
    }
}

/**
 * 毫秒时间戳
 */
if ( ! function_exists('getMillisecond'))
{
    function getMillisecond() 
    {
        list($s1, $s2) = explode(' ', microtime());
        return (float) sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
    }
}

// 查找目录下的所有文件
if ( ! function_exists('get_tree'))
{
    function get_tree($directory) 
    {
        $mydir = @dir($directory);
        $tree = array();
        if ($mydir) {

            $tree['path'] = realpath($directory);
            while ($file = $mydir->read()) {
                if ((is_dir("$directory/$file")) AND ( $file != ".") AND ( $file != "..")) {
                    $tree['dirs'][] = realpath("$directory/$file");
                } elseif (($file != ".") AND ( $file != "..")) {
                    $tree['files'][] = realpath("$directory/$file");
                }
            }
            $mydir->close();
        }

        return $tree;
    }
}


/**
 * 浏览器友好的变量输出
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
if ( ! function_exists('dump'))
{
    function dump($var, $echo = true, $label = null, $strict = true) 
    {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo($output);
            return null;
        } else
            return $output;
    }
}


/**
 * 密码加密
 * @param string $pwd
 * @param array $options
 * @return string
 */
if ( ! function_exists("hash_pwd"))
{
    function hash_pwd($pwd, $options = ['cost' => 13])
    {
        return password_hash($pwd, PASSWORD_BCRYPT, $options);
    }
}

/**
 * 比对密码与加密串
 * @param string $pwd
 * @param string $hash
 * @return boolean
 */
if ( ! function_exists('verify_hash'))
{
    function verify_hash($pwd, $hash)
    {
        return password_verify($pwd, $hash);
    }
}

/**
 * 得到客户端的IP地址
 * @return string|unknown
 */
if ( ! function_exists('get_client_ip'))
{
    function get_client_ip() 
    {
        $IPaddress = '';

        if (isset($_SERVER)) {

            if (isset($_SERVER ["HTTP_X_FORWARDED_FOR"])) {

                $IPaddress = $_SERVER ["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER ["HTTP_CLIENT_IP"])) {

                $IPaddress = $_SERVER ["HTTP_CLIENT_IP"];
            } else {

                $IPaddress = $_SERVER ["REMOTE_ADDR"];
            }
        } else {

            if (getenv("HTTP_X_FORWARDED_FOR")) {

                $IPaddress = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {

                $IPaddress = getenv("HTTP_CLIENT_IP");
            } else {

                $IPaddress = getenv("REMOTE_ADDR");
            }
        }

        return $IPaddress;
    }
}

// 得到随机数
function get_rand_str($type = 0, $len = 4) {
    $str = '';
    switch (intval($type)) {
        case 0:
            $key = '012346789';
            break;
        case 1:
            $key = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 2:
            $key = '23456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        default:
            $key = '012346789';
            break;
    }

    for ($i = 0; $i < $len; $i++) {
        $str .= $key[mt_rand(0, mb_strlen($key, 'utf-8') - 1)];
    }

    return $str;
}

//日志记录
function logger($log_content) {
    if (isset($_SERVER['HTTP_APPNAME'])) {   //SAE
        sae_set_display_errors(false);
        sae_debug($log_content);
        sae_set_display_errors(true);
    } else if ($_SERVER['REMOTE_ADDR'] != "127.0.0.1") { //LOCAL
        $max_size = 10000;
        $log_filename = __DIR__ . "./../logs/log.xml";
        if (file_exists($log_filename) and ( abs(filesize($log_filename)) > $max_size)) {
            unlink($log_filename);
        }
        file_put_contents($log_filename, date('H:i:s') . " " . $log_content . "\r\n", FILE_APPEND);
    }
}

//判断是否是微信打开
function IsWeixinOrAlipay() {
    //判断是不是微信
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return "weixin";
    }
    //判断是不是支付宝
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient') !== false) {
        return "alipay";
    }
    return false;
}
