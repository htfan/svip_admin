<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * AutoCodeIgniter.com
 *
 * 基于CodeIgniter核心模块自动生成程序
 *
 * 源项目		AutoCodeIgniter
 * 作者：		AutoCodeIgniter.com Dev Team EMAIL:hubinjie@outlook.com QQ:5516448
 * 版权：		Copyright (c) 2015 , AutoCodeIgniter com.
 * 项目名称：test 
 * 版本号：1 
 * 最后生成时间：2017-12-04 14:11:33 
 */
class Test extends Admin_Controller {

    var $method_config;

    function __construct() {
        parent::__construct();
        $this->load->model(array('Role_model', 'User_model', 'Role_model', 'test_model'));
        $this->load->helper(array('auto_codeIgniter_helper', 'array'));

        $this->method_config['upload'] = array(
            'image' => array('upload_size' => 9024, 'upload_file_type' => 'jpg|png|gif', 'upload_path' => 'uploadfile/test/new', 'upload_url' => 'test_new_'),
            'file' => array('upload_size' => 8024, 'upload_file_type' => 'jpg|png|gif', 'upload_path' => 'uploadfile/test/file', 'upload_url' => 'test_file_'),
        );


        //保证排序安全性
        $this->method_config['sort_field'] = array(
            'unique_num' => 'unique_num',
            'price' => 'price',
            'current_time' => 'current_time',
        );
    }

    /**
     * 默认首页列表
     * @param int $pageno 当前页码
     * @return void
     */
    function index($page_no = 0, $sort_id = 0) {
        $page_no = max(intval($page_no), 1);

        $orderby = "test_id desc";
        $dir = $order = NULL;
        $order = isset($_GET['order']) ? safe_replace(trim($_GET['order'])) : '';
        $dir = isset($_GET['dir']) ? safe_replace(trim($_GET['dir'])) : 'asc';

        if (trim($order) != "") {
            //如果找到得
            if (isset($this->method_config['sort_field'][strtolower($order)])) {
                if (strtolower($dir) == "asc")
                    $orderby = $this->method_config['sort_field'][strtolower($order)] . " asc," . $orderby;
                else
                    $orderby = $this->method_config['sort_field'][strtolower($order)] . " desc," . $orderby;
            }
        }

        $where = "";
        $_arr = NULL; //从URL GET
        if (isset($_GET['dosubmit'])) {
            $where_arr = NULL;
            $_arr['keyword'] = isset($_GET['keyword']) ? safe_replace(trim($_GET['keyword'])) : '';
            if ($_arr['keyword'] != "")
                $where_arr[] = "concat(title,email,mobile) like '%{$_arr['keyword']}%'";

            $_arr['area'] = isset($_GET["area"]) ? trim(safe_replace($_GET["area"])) : '';
            if ($_arr['area'] != "")
                $where_arr[] = "area = '" . $_arr['area'] . "'";

            $_arr['city'] = isset($_GET["city"]) ? trim(safe_replace($_GET["city"])) : '';
            if ($_arr['city'] != "")
                $where_arr[] = "city = '" . $_arr['city'] . "'";


            $_arr['favorite'] = isset($_GET["favorite"]) ? trim(safe_replace($_GET["favorite"])) : '';
            if (is_array($_arr['favorite']))
                $_arr['favorite'] = implode(",", $_arr['favorite']);
            if ($_arr['favorite'] != "") {
                //很抱歉转两次，程序自动生成BUG，下版本更新
                $_arr['favorite'] = explode(",", $_arr['favorite']);
                $sql_arr = NULL;
                foreach ($_arr['favorite'] as $vv) {
                    $sql_arr[] = "FIND_IN_SET( '" . $vv . "',favorite ) ";
                }
                if ($sql_arr)
                    $where_arr[] = implode(" and ", $sql_arr);
                //很抱歉转两次，程序自动生成BUG，下版本更新
                $_arr['favorite'] = implode(",", $_arr['favorite']);
            }

            $_arr['course'] = isset($_GET["course"]) ? trim(safe_replace($_GET["course"])) : '';
            if (is_array($_arr['course']))
                $_arr['course'] = implode(",", $_arr['course']);
            if ($_arr['course'] != "") {
                //很抱歉转两次，程序自动生成BUG，下版本更新
                $_arr['course'] = explode(",", $_arr['course']);
                $sql_arr = NULL;
                foreach ($_arr['course'] as $vv) {
                    $sql_arr[] = "FIND_IN_SET( '" . $vv . "',course ) ";
                }
                if ($sql_arr)
                    $where_arr[] = implode(" and ", $sql_arr);
                //很抱歉转两次，程序自动生成BUG，下版本更新
                $_arr['course'] = implode(",", $_arr['course']);
            }



            if ($where_arr)
                $where = implode(" and ", $where_arr);
        }

        $data_list = $this->test_model->listinfo($where, '*', $orderby, $page_no, $this->test_model->page_size, '', $this->test_model->page_size, page_list_url('admin/test/index', true));
        if ($data_list) {
            foreach ($data_list as $k => $v) {
                $data_list[$k] = $this->_process_datacorce_value($v);
            }
        }
        $this->view('lists', array('require_js' => true, 'data_info' => $_arr, 'order' => $order, 'dir' => $dir, 'data_list' => $data_list, 'pages' => $this->test_model->pages));
    }

    /**
     * 处理数据源结
     * @param array v 
     * @return array
     */
    function _process_datacorce_value($v, $is_edit_model = false) {
        if (isset($v['city'])) {
            //如果编辑模式
            if ($is_edit_model)
                $v['city_text'] = $this->Role_model->group_dropdown_value($v["city"]);
            else
                $v['city'] = $this->Role_model->group_dropdown_value($v["city"]);
        }

        if (isset($v['author_id'])) {
            //如果编辑模式
            if ($is_edit_model)
                $v['author_id_text'] = $this->Role_model->group_value($v["author_id"]);
            else
                $v['author_id'] = $this->Role_model->group_value($v["author_id"]);
        }

        if (isset($v['course'])) {
            //如果编辑模式
            if ($is_edit_model)
                $v['course_text'] = $this->User_model->user_dropdown_value($v["course"]);
            else
                $v['course'] = $this->User_model->user_dropdown_value($v["course"]);
        }

        if (isset($v['author_ids'])) {
            //如果编辑模式
            if ($is_edit_model)
                $v['author_ids_text'] = $this->User_model->user_value($v["author_ids"]);
            else
                $v['author_ids'] = $this->User_model->user_value($v["author_ids"]);
        }

        return $v;
    }

    /**
     * 新增数据
     * @param AJAX POST 
     * @return void
     */
    function add() {
        //如果是AJAX请求
        if ($this->input->is_ajax_request()) {
            //接收POST参数
            $_arr['title'] = isset($_POST["title"]) ? trim(safe_replace($_POST["title"])) : exit(json_encode(array('status' => false, 'tips' => '内容不能为空')));
            if ($_arr['title'] == '')
                exit(json_encode(array('status' => false, 'tips' => '内容不能为空')));
            $_arr['url'] = isset($_POST["url"]) ? trim(safe_replace($_POST["url"])) : '';
            if ($_arr['url'] != '') {
                if (!is_url($_arr['url']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['content'] = isset($_POST["content"]) ? trim(safe_replace($_POST["content"])) : '';
            $_arr['image'] = isset($_POST["image"]) ? trim(safe_replace($_POST["image"])) : '';
            $_arr['profile'] = isset($_POST["profile"]) ? trim(safe_replace($_POST["profile"])) : '';
            $_arr['email'] = isset($_POST["email"]) ? trim(safe_replace($_POST["email"])) : '';
            if ($_arr['email'] != '') {
                if (!is_email($_arr['email']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['mobile'] = isset($_POST["mobile"]) ? trim(safe_replace($_POST["mobile"])) : '';
            if ($_arr['mobile'] != '') {
                if (!is_mobile($_arr['mobile']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['ymd'] = isset($_POST["ymd"]) ? trim(safe_replace($_POST["ymd"])) : '';
            if ($_arr['ymd'] != '') {
                if (!is_date($_arr['ymd']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['ymdhis'] = isset($_POST["ymdhis"]) ? trim(safe_replace($_POST["ymdhis"])) : '';
            if ($_arr['ymdhis'] != '') {
                if (!is_datetime($_arr['ymdhis']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['his'] = isset($_POST["his"]) ? trim(safe_replace($_POST["his"])) : '';
            if ($_arr['his'] != '') {
                if (!is_time($_arr['his']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['unique_num'] = isset($_POST["unique_num"]) ? trim(safe_replace($_POST["unique_num"])) : exit(json_encode(array('status' => false, 'tips' => '内容不能为空')));
            ;
            $_arr['o_unique_num'] = isset($_POST["o_unique_num"]) ? trim(safe_replace($_POST["o_unique_num"])) : exit(json_encode(array('status' => false, 'tips' => '内容不能为空')));
            ;
            if (trim($_arr['o_unique_num']) != trim($_arr['unique_num'])) {
                $_count = $this->Test_model->check_unique_unique_num(trim($_arr['unique_num']));
                if ($_count)
                    exit(json_encode(array('status' => false, 'tips' => '唯一编号已经存在，请重新更换')));;
            }
            unset($_arr['o_unique_num']);

            $_arr['password'] = isset($_POST["password"]) ? trim(safe_replace($_POST["password"])) : exit(json_encode(array('status' => false, 'tips' => '内容不能为空')));
            ;
            $_arr['o_password'] = isset($_POST["o_password"]) ? trim(safe_replace($_POST["o_password"])) : exit(json_encode(array('status' => false, 'tips' => '内容不能为空')));
            ;
            if (trim($_arr['o_password']) != trim($_arr['password'])) {
                exit(json_encode(array('status' => false, 'tips' => '密码两次输入不就致')));
                ;
            }
            unset($_arr['o_password']);

            $_arr['password'] = md5(md5($_arr['password']));
            $_arr['number'] = isset($_POST["number"]) ? trim(safe_replace($_POST["number"])) : '';
            if ($_arr['number'] != '') {
                if (!is_number($_arr['number']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['price'] = isset($_POST["price"]) ? trim(safe_replace($_POST["price"])) : '';
            if ($_arr['price'] != '') {
                if (!is_price($_arr['price']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['is_display'] = isset($_POST["is_display"]) ? trim(safe_replace($_POST["is_display"])) : '';
            $_arr['is_work'] = isset($_POST["is_work"]) ? trim(safe_replace($_POST["is_work"])) : '';
            $_arr['area'] = isset($_POST["area"]) ? trim(safe_replace($_POST["area"])) : '';
            $_arr['city'] = isset($_POST["city"]) ? trim(safe_replace($_POST["city"])) : '';
            $_arr['author_id'] = isset($_POST["author_id"]) ? trim(safe_replace($_POST["author_id"])) : '';
            $_arr['favorite'] = isset($_POST["favorite"]) ? trim(safe_replace($_POST["favorite"])) : '';
            if (is_array($_arr['favorite']))
                $_arr['favorite'] = implode(",", $_arr['favorite']);
            $_arr['course'] = isset($_POST["course"]) ? trim(safe_replace($_POST["course"])) : '';
            if (is_array($_arr['course']))
                $_arr['course'] = implode(",", $_arr['course']);
            $_arr['author_ids'] = isset($_POST["author_ids"]) ? trim(safe_replace($_POST["author_ids"])) : '';
            $_arr['file'] = isset($_POST["file"]) ? trim(safe_replace($_POST["file"])) : '';
            $_arr['current_uid'] = isset($this->user_id) ? $this->user_id : 0;
            $_arr['current_user'] = isset($this->user_name) ? $this->user_name : 'N/A';
            $_arr['current_time'] = date('Y-m-d H:i:s');

            $new_id = $this->test_model->insert($_arr);
            if ($new_id) {
                exit(json_encode(array('status' => true, 'tips' => '信息新增成功', 'new_id' => $new_id)));
            } else {
                exit(json_encode(array('status' => false, 'tips' => '信息新增失败', 'new_id' => 0)));
            }
        } else {
            $this->view('edit', array('require_js' => true, 'is_edit' => false, 'id' => 0, 'data_info' => $this->test_model->default_info()));
        }
    }

    /**
     * 删除单个数据
     * @param int id 
     * @return void
     */
    function delete_one($id = 0) {
        $id = intval($id);
        $data_info = $this->test_model->get_one(array('test_id' => $id));
        if (!$data_info)
            $this->showmessage('信息不存在');
        $status = $this->test_model->delete(array('test_id' => $id));
        if ($status) {
            $this->showmessage('删除成功');
        } else
            $this->showmessage('删除失败');
    }

    /**
     * 删除选中数据
     * @param post pid 
     * @return void
     */
    function delete_all() {
        if (isset($_POST)) {
            $pidarr = isset($_POST['pid']) ? $_POST['pid'] : $this->showmessage('无效参数', HTTP_REFERER);
            $where = $this->test_model->to_sqls($pidarr, '', 'test_id');
            $status = $this->test_model->delete($where);
            if ($status) {
                $this->showmessage('操作成功', HTTP_REFERER);
            } else {
                $this->showmessage('操作失败');
            }
        }
    }

    /**
     * 修改数据
     * @param int id 
     * @return void
     */
    function edit($id = 0) {
        $id = intval($id);

        $data_info = $this->test_model->get_one(array('test_id' => $id));
        //如果是AJAX请求
        if ($this->input->is_ajax_request()) {
            if (!$data_info)
                exit(json_encode(array('status' => false, 'tips' => '信息不存在')));
            //接收POST参数
            $_arr['title'] = isset($_POST["title"]) ? trim(safe_replace($_POST["title"])) : exit(json_encode(array('status' => false, 'tips' => '内容不能为空')));
            if ($_arr['title'] == '')
                exit(json_encode(array('status' => false, 'tips' => '内容不能为空')));
            $_arr['url'] = isset($_POST["url"]) ? trim(safe_replace($_POST["url"])) : '';
            if ($_arr['url'] != '') {
                if (!is_url($_arr['url']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['content'] = isset($_POST["content"]) ? trim(safe_replace($_POST["content"])) : '';
            $_arr['image'] = isset($_POST["image"]) ? trim(safe_replace($_POST["image"])) : '';
            $_arr['profile'] = isset($_POST["profile"]) ? trim(safe_replace($_POST["profile"])) : '';
            $_arr['email'] = isset($_POST["email"]) ? trim(safe_replace($_POST["email"])) : '';
            if ($_arr['email'] != '') {
                if (!is_email($_arr['email']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['mobile'] = isset($_POST["mobile"]) ? trim(safe_replace($_POST["mobile"])) : '';
            if ($_arr['mobile'] != '') {
                if (!is_mobile($_arr['mobile']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['ymd'] = isset($_POST["ymd"]) ? trim(safe_replace($_POST["ymd"])) : '';
            if ($_arr['ymd'] != '') {
                if (!is_date($_arr['ymd']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['ymdhis'] = isset($_POST["ymdhis"]) ? trim(safe_replace($_POST["ymdhis"])) : '';
            if ($_arr['ymdhis'] != '') {
                if (!is_datetime($_arr['ymdhis']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['his'] = isset($_POST["his"]) ? trim(safe_replace($_POST["his"])) : '';
            if ($_arr['his'] != '') {
                if (!is_time($_arr['his']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['unique_num'] = isset($_POST["unique_num"]) ? trim(safe_replace($_POST["unique_num"])) : exit(json_encode(array('status' => false, 'tips' => '内容不能为空')));
            ;
            $_arr['o_unique_num'] = isset($_POST["o_unique_num"]) ? trim(safe_replace($_POST["o_unique_num"])) : exit(json_encode(array('status' => false, 'tips' => '内容不能为空')));
            ;
            if (trim($_arr['o_unique_num']) != trim($_arr['unique_num'])) {
                $_count = $this->Test_model->check_unique_unique_num(trim($_arr['unique_num']));
                if ($_count)
                    exit(json_encode(array('status' => false, 'tips' => '唯一编号已经存在，请重新更换')));;
            }
            unset($_arr['o_unique_num']);

            $_arr['password'] = isset($_POST["password"]) ? trim(safe_replace($_POST["password"])) : exit(json_encode(array('status' => false, 'tips' => '内容不能为空')));
            ;
            $_arr['o_password'] = isset($_POST["o_password"]) ? trim(safe_replace($_POST["o_password"])) : exit(json_encode(array('status' => false, 'tips' => '内容不能为空')));
            ;
            if (trim($_arr['o_password']) != trim($_arr['password'])) {
                exit(json_encode(array('status' => false, 'tips' => '密码两次输入不就致')));
                ;
            }
            unset($_arr['o_password']);

            if (trim($_arr['password']) == "")
                unset($_arr['password']);
            else
                $_arr['password'] = md5(md5($_arr['password']));
            $_arr['number'] = isset($_POST["number"]) ? trim(safe_replace($_POST["number"])) : '';
            if ($_arr['number'] != '') {
                if (!is_number($_arr['number']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['price'] = isset($_POST["price"]) ? trim(safe_replace($_POST["price"])) : '';
            if ($_arr['price'] != '') {
                if (!is_price($_arr['price']))
                    exit(json_encode(array('status' => false, 'tips' => '你的输入不符合要求')));
            }
            $_arr['is_display'] = isset($_POST["is_display"]) ? trim(safe_replace($_POST["is_display"])) : '';
            $_arr['is_work'] = isset($_POST["is_work"]) ? trim(safe_replace($_POST["is_work"])) : '';
            $_arr['area'] = isset($_POST["area"]) ? trim(safe_replace($_POST["area"])) : '';
            $_arr['city'] = isset($_POST["city"]) ? trim(safe_replace($_POST["city"])) : '';
            $_arr['author_id'] = isset($_POST["author_id"]) ? trim(safe_replace($_POST["author_id"])) : '';
            $_arr['favorite'] = isset($_POST["favorite"]) ? trim(safe_replace($_POST["favorite"])) : '';
            if (is_array($_arr['favorite']))
                $_arr['favorite'] = implode(",", $_arr['favorite']);
            $_arr['course'] = isset($_POST["course"]) ? trim(safe_replace($_POST["course"])) : '';
            if (is_array($_arr['course']))
                $_arr['course'] = implode(",", $_arr['course']);
            $_arr['author_ids'] = isset($_POST["author_ids"]) ? trim(safe_replace($_POST["author_ids"])) : '';
            $_arr['file'] = isset($_POST["file"]) ? trim(safe_replace($_POST["file"])) : '';
            $_arr['current_uid'] = isset($this->user_id) ? $this->user_id : 0;
            $_arr['current_user'] = isset($this->user_name) ? $this->user_name : 'N/A';
            $_arr['current_time'] = date('Y-m-d H:i:s');

            $status = $this->test_model->update($_arr, array('test_id' => $id));
            if ($status) {
                exit(json_encode(array('status' => true, 'tips' => '信息修改成功')));
            } else {
                exit(json_encode(array('status' => false, 'tips' => '信息修改失败')));
            }
        } else {
            if (!$data_info)
                $this->showmessage('信息不存在');
            $data_info = $this->_process_datacorce_value($data_info, true);
            $this->view('edit', array('require_js' => true, 'data_info' => $data_info, 'is_edit' => true, 'id' => $id));
        }
    }

    /**
     * 只读查看数据
     * @param int id 
     * @return void
     */
    function readonly($id = 0) {
        $id = intval($id);
        $data_info = $this->test_model->get_one(array('test_id' => $id));
        if (!$data_info)
            $this->showmessage('信息不存在');
        $data_info = $this->_process_datacorce_value($data_info);

        $this->view('readonly', array('require_js' => true, 'data_info' => $data_info));
    }

    /**
     * 上传附件
     * @param string $fieldName 字段名
     * @param string $controlId HTML控件ID
     * @param string $callbackJSfunction 是否返回函数
     * @return void
     */
    function upload($isImage = true, $fieldName = '', $controlId = '', $callbackJSfunction = false) {
        if (isset($this->method_config['upload'][$fieldName])) {
            if (isset($_POST['dosubmit'])) {
                $upload_path = $this->method_config['upload'][$fieldName]['upload_path'];


                if ($upload_path == '')
                    die('缺少上传参数');

                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = $this->method_config['upload'][$fieldName]['upload_file_type'];
                $config['max_size'] = $this->method_config['upload'][$fieldName]['upload_size'];
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = false;
                $config['file_name'] = date('Ymdhis') . random_string('nozero', 4);

                dir_create($upload_path); //创建正式文件夹
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('upload'))
                    $this->showmessage("上传失败:" . $this->upload->display_errors());
                $filedata = $this->upload->data();

                $file_name = $filedata['file_name'];
                $file_size = $filedata['file_size'];
                $image_width = $isImage ? $filedata['image_width'] : 0;
                $image_height = $isImage ? $filedata['image_height'] : 0;
                $uc_first_id = ucfirst($controlId);
                $this->showmessage("上传成功！", '', '', '', $callbackJSfunction ? "window.parent.get{$uc_first_id}(\"$file_name\",\"$file_size\",\"$image_width\",\"$image_height\");" : "$(window.parent.document).find(\"#$controlId\").val(\"$file_name\");$(\"#dialog\" ).dialog(\"close\")");
            }else {
                $this->view('upload', array('require_js' => true, 'hidden_menu' => true, 'field_name' => $fieldName, 'control_id' => $controlId, 'upload_url' => $this->method_config['upload'][$fieldName]['upload_url'], 'is_image' => $isImage));
            }
        } else {
            die('缺少上传参数');
        }
    }

}

// END test class

/* End of file test.php */
/* Location: ./test.php */
?>