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
class Servicer extends Admin_Controller {

    var $method_config;

    function __construct() {
        parent::__construct();
        $this->load->model(array('Servicer_model'));
        $this->load->helper(array('auto_codeIgniter_helper', 'array'));
        //如果有上传文件，则需要上传文件配置
        $this->method_config['upload'] = array(
            'headimgurl' => array('upload_size' => 9024, 'upload_file_type' => 'jpg|png|gif', 'upload_path' => 'uploadfile/test/new', 'upload_url' => SITE_URL . 'uploadfile/test/new/'),
            'file' => array('upload_size' => 8024, 'upload_file_type' => 'jpg|png|gif', 'upload_path' => 'uploadfile/test/file', 'upload_url' => SITE_URL . 'uploadfile/test/file/'),
        );

        //表格的列表 key 名称 是否排序
        $this->method_config["tab_title"] = array(
            'id' => ['#', true],
            'name' => ['姓名', false],
            'mobile' => ['电话', false],
            'balance' => ['余额', true],
            'y_income' => ['昨日收益', true],
            'cumulative' => ['累计收益', true],
            'buy_point' => ['累计购买', true],
            'level_name' => ['等级', false],
            'point' => ['锁定分红点', true],
            'use_point' => ['流通分红点', true],
            'valid_time' => ['有效期至', true],
        );
        //接收修改和查看的字段
        $this->method_config["tab_filed"] = array(
            '基本信息' => array(
                'id' => ['ID', false],
                'name' => ['姓名', 'text'],
                'cate_id' => ['角色状态', 'select', ['待审核', '待支付', '交易商', '服务商']],
                'account' => ['登陆账号', 'text'],
                'mobile' => ['电话', 'text'],
                'card' => ['身份证', 'text'],
                'password' => ['登陆密码', 'password'],
            ),
            '购买信息' => array(
                'price' => ['购买价格', 'text'],
                'is_pay' => ['支付状态', 'select', ['未支付', '已支付']],
                'remark' => ['购买备注', 'text'],
                'pay_time' => ['支付时间', false],
                'valid_time' => ['有效期', false],
            ),
            '账户信息' => array(
                'use_point' => ['流通分红点', false],
                'point' => ['锁定分红点', false],
                'close_point' => ['保底分红点', false],
                'balance' => ['可用惠呗', false],
                'freeze' => ['冻结惠呗', false],
                'freeze_money' => ['冻结设置', 'text'],
            ),
            '分红收益信息' => array(
                'is_fenhong' => ['是否参与分红', 'select', ['不参与分红', '参与分红']],
                'y_income' => ['昨日收益', false],
                'point_time' => ['收益时间', false],
                'income' => ['未领取收益', false],
                'fenhong_time' => ['领取时间', false],
                'cumulative' => ['累计收益', false],
            ),
            '可选信息' => array(
                'email' => ['Email', 'text'],
                'headimgurl' => ['头像', 'image'],
                'is_lock' => ['锁定登陆', 'radio', ['否', '是']],
            ),
        );
    }

    /**
     * 默认首页列表
     * @param int $pageno 当前页码
     * @return void
     */
    function index($page_no = 0) {
        $page_no = max(intval($page_no), 1);

        $orderby = "";
        $dir = $order = NULL;
        $order = isset($_GET['order']) ? safe_replace(trim($_GET['order'])) : '';
        $dir = isset($_GET['dir']) ? safe_replace(trim($_GET['dir'])) : 'asc';

        if (trim($order) != "") {
            //如果允许排序
            if (isset($this->method_config['tab_title'][strtolower($order)][1])) {
                $field = strtolower($order);
                $sort = strtolower($dir) == "asc" ? " asc" : " desc";
                $orderby = $field . $sort;
            }
        }

        //检索处理
        list($where, $_arr) = $this->search();
        //重新拼接一个查询的字符串
        $query = http_build_query($_GET);
        $url = $this->config->item('base_url') . $_SERVER['REDIRECT_URL'] . "?" . $query;
        $this->session->set_userdata("return_url", $url);

        //获取数据源
        $data_list = $this->Servicer_model->listinfo($where, '*', $orderby, $page_no, $this->Servicer_model->page_size, '', $this->Servicer_model->page_size, page_list_url('admin/servicer/index', true));
        if ($data_list) {
            foreach ($data_list as $k => $v) {
                $data_list[$k] = $this->_process_datacorce_value($v);
            }
        }
        $this->view('lists', array('require_js' => true, 'data_info' => $_arr, 'order' => $order, 'dir' => $dir, 'data_list' => $data_list, 'pages' => $this->Servicer_model->pages, 'tab_title' => $this->method_config["tab_title"], 'query' => $query));
    }

    /**
     * 列表检索处理
     * @param array v 
     * @return array
     */
    private function search() {
        $where = "";
        $_arr = NULL; //从URL GET
        if (isset($_GET['dosubmit'])) {
            $where_arr = NULL;
            //关键字查询
            $_arr['keyword'] = isset($_GET['keyword']) ? safe_replace(trim($_GET['keyword'])) : '';
            if ($_arr['keyword'] != "") {
                $where_arr[] = "concat(id,mobile,name,uid) like '%{$_arr['keyword']}%'";
            }
            //分类赛选
            $_arr['cate_id'] = isset($_GET["cate_id"]) ? safe_replace($_GET["cate_id"]) : '';
            if ($_arr['cate_id'] != "" && is_array($_arr['cate_id'])) {
                $cate_arr = implode(",", $_arr['cate_id']);
                $where_arr[] = "cate_id IN (" . $cate_arr . ") ";
            } else {
                unset($_arr['cate_id']);
            }

            $where_arr && $where = implode(" and ", $where_arr);
        }
        return array($where, $_arr);
    }

    /**
     * 处理数据源结
     * @param array v 
     * @return array
     */
    function _process_datacorce_value($v, $is_edit_model = false) {
        //标签颜色分类
        if (isset($v['cate_id'])) {
            $v['cate_id'] == 0 && $v['class'] = 'label-warning';
            $v['cate_id'] == 1 && $v['class'] = 'label-info';
            $v['cate_id'] == 2 && $v['class'] = 'label-primary';
            $v['cate_id'] == 3 && $v['class'] = 'label-success';
        }
        if (isset($v['type'])) {
            $v['type'] == 1 && $v['type'] = "<span style='color:red;font-size:16px;'> +</span>";
            $v['type'] == 2 && $v['type'] = "<span style='color:green;font-size:16px;'> -</span>";
        }
        //不需要显示的字段
        $no_display = ["author_id", 'profiles', 'is_delete'];
        foreach ($no_display as $val) {
            unset($v[$val]);
        }
        //时间转换
        foreach ($v as $key => $val) {
            if (strstr($key, "_time")) {
                $v[$key] = date("Y-m-d H:i:s", $val);
            }
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

            $new_id = $this->Servicer_model->insert($_arr);
            if ($new_id) {
                exit(json_encode(array('status' => true, 'tips' => '信息新增成功', 'new_id' => $new_id)));
            } else {
                exit(json_encode(array('status' => false, 'tips' => '信息新增失败', 'new_id' => 0)));
            }
        } else {
            $this->view('edit', array('require_js' => true, 'is_edit' => false, 'id' => 0, 'data_info' => $this->Servicer_model->default_info()));
        }
    }

    /**
     * 删除单个数据
     * @param int id 
     * @return void
     */
    function delete_one($id = 0) {
        $id = intval($id);
        $data_info = $this->Servicer_model->get_one(array('test_id' => $id));
        if (!$data_info)
            $this->showmessage('信息不存在');
        $status = $this->Servicer_model->delete(array('test_id' => $id));
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
            $where = $this->Servicer_model->to_sqls($pidarr, '', 'id');
            $status = $this->Servicer_model->delete($where);
            if ($status) {
                $this->showmessage('操作成功', HTTP_REFERER);
            } else {
                $this->showmessage('操作失败');
            }
        }
    }

    function lock() {
        if (isset($_POST)) {
            $pidarr = isset($_POST['pid']) ? $_POST['pid'] : $this->showmessage('无效参数', HTTP_REFERER);
            $where = $this->Servicer_model->to_sqls($pidarr, '', 'id');
            $status = $this->Servicer_model->update(array('is_lock' => '^1'), $where);
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

        $data_info = $this->Servicer_model->get_one(array('id' => $id));
        //如果是AJAX请求
        if ($this->input->is_ajax_request()) {
            $data_info || exit(json_encode(array('status' => false, 'tips' => '信息不存在')));
            //加载表单验证类
            $this->load->library('form_validation');
            if ($this->form_validation->run('servicer_edit') == FALSE) {
                //接收POST参数
                exit(json_encode(array('status' => false, 'tips' => validation_errors())));
            }
            $input = $this->input->post();
            //过滤调为空的字段，同时赛选出可以更改的字段 可编辑的字段
            $edit_field = [];
            foreach ($this->method_config["tab_filed"] as $value) {
                foreach ($value as $key => $val) {
                    if ($val[1]) {
                        $edit_field[$key] = $key;
                    }
                }
            }
            //先验证密码
            if (trim($input['password']) != trim($input['repassword'])) {
                exit(json_encode(array('status' => false, 'tips' => '密码两次输入不就致')));
            }
            $input['password'] = empty($input['password']) ?: hash_pwd($input['password']);
            unset($input['repassword']);
            //删除不可编辑的字段
            foreach ($input as $key => $val) {
                if (!isset($edit_field[$key]) || $val == '') {
                    unset($input[$key]);
                }
            }
            $status = $this->Servicer_model->update($input, array('id' => $id));
            if ($status) {
                exit(json_encode(array('status' => true, 'tips' => '信息修改成功', 'url' => $this->session->userdata('return_url'))));
            } else {
                exit(json_encode(array('status' => false, 'tips' => '信息修改失败')));
            }
        } else {
            $data_info || $this->showmessage('信息不存在');
            $data_info = $this->_process_datacorce_value($data_info, true);
            $this->view('edit', array('require_js' => true, 'data_info' => $data_info, 'is_edit' => true, 'id' => $id, 'field' => $this->method_config["tab_filed"]));
        }
    }

    /**
     * 只读查看数据
     * @param int id 
     * @return void
     */
    function readonly($id = 0) {
        $id = intval($id);
        $data_info = $this->Servicer_model->get_one(array('id' => $id));
        //获得字段的备注
        $sql = "show full fields from mdh_servicer";
        $row = $this->db->query($sql)->result_array();
        $field = [];
        foreach ($row as $val) {
            $field[$val['Field']] = $val['Comment'];
        }

        $data_info || $this->showmessage('信息不存在');
        $data_info = $this->_process_datacorce_value($data_info);

        //接收修改和查看的字段
        $tab_filed = array(
            '基本信息' => array(
                'id' => ['ID', false],
                'name' => ['姓名', 'text'],
                'cate_id' => ['角色状态', 'select', ['待审核', '待支付', '交易商', '服务商']],
                'account' => ['登陆账号', 'text'],
                'mobile' => ['电话', 'text'],
                'card' => ['身份证', 'text'],
                'create_time' => ['创建时间', 'text'],
                'last_login_time' => ['最近登陆时间', 'text'],
                'last_login_ip' => ['最近登陆IP', 'text'],
                'login_count' => ['登陆次数', 'text'],
                'buy_point' => ['累计购买分红点', 'text'],
                'level' => ['当前等级', 'text'],
                'level_name' => ['等级昵称', 'text'],
            ),
            '购买信息' => array(
                'price' => ['购买价格', 'text'],
                'is_pay' => ['支付状态', 'select', ['未支付', '已支付']],
                'remark' => ['购买备注', 'text'],
                'pay_time' => ['支付时间', false],
                'valid_time' => ['有效期', false],
            ),
            '账户信息' => array(
                'close_point' => ['保底分红点', false],
                'point' => ['锁定分红点', false],
                'use_point' => ['流通分红点', false],
                'chiyou_fee' => ['持有分红点成本', false],
                'balance' => ['可用惠呗', false],
                'freeze' => ['冻结惠呗', false],
                'freeze_money' => ['冻结设置', 'text'],
            ),
            '分红收益信息' => array(
                'is_fenhong' => ['是否参与分红', 'select', ['不参与分红', '参与分红']],
                'y_income' => ['昨日收益', false],
                'point_time' => ['收益时间', false],
                'income' => ['未领取收益', false],
                'fenhong_time' => ['领取时间', false],
                'cumulative' => ['累计收益', false],
            ),
            '其他信息' => array(
                'email' => ['Email', 'text'],
                'headimgurl' => ['头像', 'image'],
                'is_lock' => ['锁定登陆', 'radio', ['否', '是']],
            ),
        );

        $this->view('readonly', array('require_js' => true, 'data_info' => $data_info, 'field' => $tab_filed));
    }

    /**
     * 上传附件
     * @param string $fieldName 字段名
     * @param string $controlId HTML控件ID
     * @param string $callbackJSfunction 是否返回函数
     * @return void
     */
    function upload($fieldName = '', $controlId = '', $callbackJSfunction = false) {
        $isImage = true;
        if (isset($this->method_config['upload'][$fieldName])) {
            if (isset($_POST['dosubmit'])) {
                $upload_path = $this->method_config['upload'][$fieldName]['upload_path'];

                $upload_path == '' && die('缺少上传参数');

                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = $this->method_config['upload'][$fieldName]['upload_file_type'];
                $config['max_size'] = $this->method_config['upload'][$fieldName]['upload_size'];
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = false;
                $config['file_name'] = date('Ymdhis') . random_string('nozero', 4);

                dir_create($upload_path); //创建正式文件夹
                $this->load->library('upload', $config);

                !$this->upload->do_upload('upload') && $this->showmessage("上传失败:" . $this->upload->display_errors());
                $filedata = $this->upload->data();

                $file_name = $filedata['file_name'];
                $file_size = $filedata['file_size'];
                $image_width = $isImage ? $filedata['image_width'] : 0;
                $image_height = $isImage ? $filedata['image_height'] : 0;
                $uc_first_id = ucfirst($controlId);

                $this->showmessage("上传成功！", '', '', '', $callbackJSfunction ? "window.parent.get{$uc_first_id}(\"$file_name\",\"$file_size\",\"$image_width\",\"$image_height\");" : "$(window.parent.document).find(\"#$controlId\").val(\"$file_name\");$(\"#dialog\" ).dialog(\"close\")");
            } else {
                $this->view('upload', array('require_js' => true, 'hidden_menu' => true, 'field_name' => $fieldName, 'control_id' => $controlId, 'upload_url' => $this->method_config['upload'][$fieldName]['upload_url'], 'is_image' => $isImage));
            }
        } else {
            die('缺少上传参数');
        }
    }

//----------------------------------交易余额日志处理-----------------------------------------------------

    /**
     * 余额日志记录列表 
     * @param int $pageno 当前页码
     * @return void
     */
    function log_list($page_no = 0) {
        $page_no = max(intval($page_no), 1);

        //日志列表项
        $tab_title = array(
            'id' => ['#', false],
            'sid' => ['服务商ID', false],
            'uid' => ['用户ID', false],
            'remark' => ['类别', false],
            'type' => ['增/减', false],
            'money' => ['变动金额', true],
            'balance_before' => ['变动前余额', false],
            'balance_after' => ['变动后余额', false],
            'freeze' => ['冻结金额', false],
            'create_time' => ['日志时间', true],
        );

        $orderby = "create_time desc";
        $dir = $order = NULL;
        $order = isset($_GET['order']) ? safe_replace(trim($_GET['order'])) : '';
        $dir = isset($_GET['dir']) ? safe_replace(trim($_GET['dir'])) : 'asc';
        if (trim($order) != "") {
            //如果允许排序
            if (isset($tab_title[strtolower($order)][1])) {
                $field = strtolower($order);
                $sort = strtolower($dir) == "asc" ? " asc" : " desc";
                $orderby = $field . $sort;
            }
        }

        //检索处理
        list($where, $_arr) = $this->search_log("id,uid,remark");
        //重新拼接一个查询的字符串
        $query = http_build_query($_GET);
        //重新定义要查询的数据库
        $this->Servicer_model->set_table_name('servicer_log', 'mdh_');
        //获取数据源
        $data_list = $this->Servicer_model->listinfo($where, '*', $orderby, $page_no, 10, '', $this->Servicer_model->page_size, page_list_url('admin/servicer/log_list', true));
        $servicer_name = [];
        if ($data_list) {
            $sid = [];
            foreach ($data_list as $k => $v) {
                $data_list[$k] = $this->_process_datacorce_value($v);
                $sid[$v['sid']] = $v['sid'];
            }
            $str = implode(",", $sid);
            $sql = "select id,name from mdh_servicer where id in ({$str})";
            $ser_name = $this->db->query($sql)->result_array();
            foreach ($ser_name as $val) {
                $servicer_name[$val['id']] = $val['name'];
            }
        }
        $data = array(
            'require_js' => true,
            'data_info' => $_arr,
            'order' => $order,
            'dir' => $dir,
            'data_list' => $data_list,
            'pages' => $this->Servicer_model->pages,
            'tab_title' => $tab_title,
            'ser_name' => $servicer_name,
            'query' => $query,
            'cate' => $this->log_cate()
        );
        $this->view('log_list', $data);
    }

    public function log_cate() {
        //先读取缓存数据，如果缓存数据不存在再去查找数据库
        $cates = getcache("cache_log_cate");
        if (!$cates) {
            $cate = $this->db->get("mdh_servicer_log_cate")->result_array();
            $cates = [];
            foreach ($cate as $val) {
                $cates[$val['cate_id']] = $val['cate'];
            }
            setcache("cache_log_cate", $cates);
        }
        return $cates;
    }

    private function search_log($title = '') {
        $where = "";
        $_arr = NULL; //从URL GET
        if (isset($_GET['dosubmit'])) {
            $where_arr = NULL;
            //关键字查询
            $_arr['keyword'] = isset($_GET['keyword']) ? safe_replace(trim($_GET['keyword'])) : '';
            if ($_arr['keyword'] != "") {
                $where_arr[] = "concat({$title}) like '%{$_arr['keyword']}%'";
            }
            $_arr['sid'] = isset($_GET['sid']) ? safe_replace(trim($_GET['sid'])) : '';
            if ($_arr['sid'] != "") {
                $where_arr[] = "sid={$_arr['sid']} ";
            }
            //分类赛选
            $_arr['cate_id'] = isset($_GET["cate_id"]) ? safe_replace($_GET["cate_id"]) : '';

            if ($_arr['cate_id'] != "" && is_array($_arr['cate_id'])) {
                $cate_arr = implode(",", $_arr['cate_id']);
                $where_arr[] = "cate_id IN (" . $cate_arr . ") ";
            } elseif ($_arr['cate_id'] != "") {
                $where_arr[] = "cate_id = " . $_arr['cate_id'];
            } else {
                unset($_arr['cate_id']);
            }

            $where_arr && $where = implode(" and ", $where_arr);
        }
        return array($where, $_arr);
    }

    //--------------------------------------------购买分红点-----------------------------------------------

    public function buy_list($page_no = 0) {
        $page_no = max(intval($page_no), 1);

        //日志列表项
        $tab_title = array(
            'id' => ['#', false],
            'sid' => ['服务商ID', false],
            'uid' => ['用户ID', false],
            'number' => ['购买数量', true],
            'price' => ['价格', true],
            'create_time' => ['挂载时间', true],
            'rest_number' => ['剩余数量', true],
            'is_cancel' => ['当前状态', false],
            'cancel_time' => ['操作时间', true],
        );

        $orderby = "create_time desc";
        $dir = $order = NULL;
        $order = isset($_GET['order']) ? safe_replace(trim($_GET['order'])) : '';
        $dir = isset($_GET['dir']) ? safe_replace(trim($_GET['dir'])) : 'asc';
        if (trim($order) != "") {
            //如果允许排序
            if (isset($tab_title[strtolower($order)][1])) {
                $field = strtolower($order);
                $sort = strtolower($dir) == "asc" ? " asc" : " desc";
                $orderby = $field . $sort;
            }
        }

        //检索处理
        list($where, $_arr) = $this->search_buy();
        //重新拼接一个查询的字符串
        $query = http_build_query($_GET);
        $url = $this->config->item('base_url') . $_SERVER['REDIRECT_URL'] . "?" . $query;
        $this->session->set_userdata("return_url", $url);
        //重新定义要查询的数据库
        $this->Servicer_model->set_table_name('servicer_buy', 'mdh_');
        //获取数据源
        $data_list = $this->Servicer_model->listinfo($where, '*', $orderby, $page_no, 12, '', $this->Servicer_model->page_size, page_list_url('admin/servicer/buy_list', true));

        $sid = [];
        if ($data_list) {
            foreach ($data_list as $k => &$v) {
                if ($v['is_cancel'] == 0) {
                    $v['is_cancel'] = $v['rest_number'] == 0 ? "已交易" : '购买中';
                    $v['class'] = $v['rest_number'] == 0 ? "label-danger" : 'label-success';
                } else {
                    $v['is_cancel'] = "已撤销";
                    $v['class'] = "label-warning";
                }
                //时间转换
                $v["create_time"] = date("Y-m-d H:i:s", $v["create_time"]);
                $v["cancel_time"] = empty($v["cancel_time"]) ? date("Y-m-d H:i:s", $v["update_time"]) : date("Y-m-d H:i:s", $v["cancel_time"]);
                //名字转换  
                $sid[$v['sid']] = $v['sid'];
            }
        }

        $data = array(
            'title' => "委托购买",
            'data_id' => "buy_id",
            'require_js' => true,
            'data_info' => $_arr,
            'order' => $order,
            'dir' => $dir,
            'data_list' => $data_list,
            'pages' => $this->Servicer_model->pages,
            'tab_title' => $tab_title,
            'ser_name' => $this->servicer_name($sid),
            'query' => $query,
            'cate' => array("1" => "购买中", "2" => "已撤销", "3" => "已交易"),
        );
        $this->view('buy_list', $data);
    }

    private function search_buy() {
        $where = "";
        $_arr = NULL; //从URL GET
        if (isset($_GET['dosubmit'])) {
            $where_arr = NULL;
            //关键字查询
            $_arr['keyword'] = isset($_GET['keyword']) ? safe_replace(trim($_GET['keyword'])) : '';
            if ($_arr['keyword'] != "") {
                $where_arr[] = "concat(id,sid,uid,number) like '%{$_arr['keyword']}%'";
            }
            //分类赛选
            $_arr['cate_id'] = isset($_GET["cate_id"]) ? safe_replace($_GET["cate_id"]) : '';

            if ($_arr['cate_id'] == 1) {
                $where_arr[] = "is_cancel=0 and rest_number>0 ";
            } elseif ($_arr['cate_id'] == 2) {
                $where_arr[] = "is_cancel=1 ";
            } elseif ($_arr['cate_id'] == 3) {
                $where_arr[] = "rest_number=0 ";
            }

            $where_arr && $where = implode(" and ", $where_arr);
        }
        return array($where, $_arr);
    }

    //--------------------------------------------出售分红点-----------------------------------------------

    public function sell_list($page_no = 0) {
        $page_no = max(intval($page_no), 1);
        //列表项
        $tab_title = array(
            'id' => ['#', false],
            'sid' => ['服务商ID', false],
            'uid' => ['用户ID', false],
            'number' => ['出售数量', true],
            'price' => ['价格', true],
            'create_time' => ['挂载时间', true],
            'rest_number' => ['剩余数量', true],
            'is_cancel' => ['当前状态', false],
            'cancel_time' => ['操作时间', true],
        );

        $orderby = "create_time desc";
        $dir = $order = NULL;
        $order = isset($_GET['order']) ? safe_replace(trim($_GET['order'])) : '';
        $dir = isset($_GET['dir']) ? safe_replace(trim($_GET['dir'])) : 'asc';
        if (trim($order) != "") {
            //如果允许排序
            if (isset($tab_title[strtolower($order)][1])) {
                $field = strtolower($order);
                $sort = strtolower($dir) == "asc" ? " asc" : " desc";
                $orderby = $field . $sort;
            }
        }

        //检索处理
        list($where, $_arr) = $this->search_buy();
        //重新拼接一个查询的字符串
        $query = http_build_query($_GET);
        $url = $this->config->item('base_url') . $_SERVER['REDIRECT_URL'] . "?" . $query;
        $this->session->set_userdata("return_url", $url);
        //重新定义要查询的数据库
        $this->Servicer_model->set_table_name('servicer_sell', 'mdh_');
        //获取数据源
        $data_list = $this->Servicer_model->listinfo($where, '*', $orderby, $page_no, 12, '', $this->Servicer_model->page_size, page_list_url('admin/servicer/sell_list', true));
        //当前数据所有的服务商id
        $sid = [];
        if ($data_list) {
            foreach ($data_list as &$v) {
                if ($v['is_cancel'] == 0) {
                    $v['is_cancel'] = $v['rest_number'] == 0 ? "已交易" : '出售中';
                    $v['class'] = $v['rest_number'] == 0 ? "label-danger" : 'label-success';
                } else {
                    $v['is_cancel'] = "已撤销";
                    $v['class'] = "label-warning";
                }
                //时间转换
                $v["create_time"] = date("Y-m-d H:i:s", $v["create_time"]);
                $v["cancel_time"] = empty($v["cancel_time"]) ? date("Y-m-d H:i:s", $v["update_time"]) : date("Y-m-d H:i:s", $v["cancel_time"]);
                //名字转换  
                $sid[$v['sid']] = $v['sid'];
            }
        }
        $data = array(
            'title' => "委托出售",
            'data_id' => "sell_id",
            'require_js' => true,
            'data_info' => $_arr,
            'order' => $order,
            'dir' => $dir,
            'data_list' => $data_list,
            'pages' => $this->Servicer_model->pages,
            'tab_title' => $tab_title,
            'ser_name' => $this->servicer_name($sid),
            'query' => $query,
            'cate' => array("1" => "出售中", "2" => "已撤销", "3" => "已交易"),
        );
        $this->view('buy_list', $data);
    }

    //返回一个 id 名称的 服务商数组
    private function servicer_name($sid = []) {
        if (empty($sid))
            return [];
        $servicer_name = [];
        $str = implode(",", $sid);
        $sql = "select id,name from mdh_servicer where id in ({$str})";
        $ser_name = $this->db->query($sql)->result_array();
        foreach ($ser_name as $val) {
            $servicer_name[$val['id']] = $val['name'];
        }
        return $servicer_name;
    }

    //--------------------------------------------交易记录-----------------------------------------------

    public function platform_list($page_no = 0) {
        $page_no = max(intval($page_no), 1);
        //列表项
        $tab_title = array(
            'id' => ['#', false],
            'sid1' => ['服务商(ID | 数据ID)', false],
            'cate_id' => ['买/卖', true],
            'sid2' => ['服务商(ID | 数据ID)', false],
            'number' => ['交易数量', true],
            'price' => ['价格', true],
            'sum' => ['合计金额', true],
            'fee' => ['手续费', true],
            'create_time' => ['交易时间', true],
        );

        $orderby = "create_time desc";
        $dir = $order = NULL;
        $order = isset($_GET['order']) ? safe_replace(trim($_GET['order'])) : '';
        $dir = isset($_GET['dir']) ? safe_replace(trim($_GET['dir'])) : 'asc';
        if (trim($order) != "") {
            //如果允许排序
            if (isset($tab_title[strtolower($order)][1])) {
                $field = strtolower($order);
                $sort = strtolower($dir) == "asc" ? " asc" : " desc";
                $orderby = $field . $sort;
            }
        }

        //检索处理
        list($where, $_arr) = $this->search_platform();
        //重新拼接一个查询的字符串
        $query = http_build_query($_GET);
        //重新定义要查询的数据库
        $this->Servicer_model->set_table_name('servicer_platform', 'mdh_');
        //获取数据源
        $data_list = $this->Servicer_model->listinfo($where, '*', $orderby, $page_no, 10, '', $this->Servicer_model->page_size, page_list_url('admin/servicer/platform_list', true));
        //当前数据所有的服务商id
        $sid = [];
        if ($data_list) {
            foreach ($data_list as &$v) {
                $v['sid1'] = "buy";
                $v['sid2'] = "sell";
                if ($v['cate_id'] == 1) {
                    $v['cate_id'] = '购买';
                    $v['class'] = 'label-success';
                } elseif ($v['cate_id'] == 2) {
                    $v['cate_id'] = '出售';
                    $v['class'] = 'label-info';
                    $v['sid1'] = "sell";
                    $v['sid2'] = "buy";
                } else {
                    $v['cate_id'] = '未知';
                    $v['class'] = 'label-warning';
                }
                //时间转换
                $v["create_time"] = date("Y-m-d H:i:s", $v["create_time"]);
                //名字转换  
                $sid[$v['buy_sid']] = $v['buy_sid'];
                $sid[$v['sell_sid']] = $v['sell_sid'];
            }
        }
        $data = array(
            'title' => "交易记录",
            'require_js' => true,
            'data_info' => $_arr,
            'order' => $order,
            'dir' => $dir,
            'data_list' => $data_list,
            'pages' => $this->Servicer_model->pages,
            'tab_title' => $tab_title,
            'ser_name' => $this->servicer_name($sid),
            'query' => $query,
            'cate' => array("1" => "购买", "2" => "出售", '3' => "未知"),
        );
        $this->view('platform_list', $data);
    }

    private function search_platform() {
        $where = "";
        $_arr = NULL; //从URL GET
        if (isset($_GET['dosubmit'])) {
            $where_arr = NULL;
            //时间赛选
            $_arr['s_time'] = isset($_GET['s_time']) ? safe_replace(trim($_GET['s_time'])) : '';
            if ($_arr['s_time'] != "") {
                $s_time = strtotime($_arr['s_time']);
                $where_arr[] = "create_time>{$s_time} ";
            }
            $_arr['e_time'] = isset($_GET['e_time']) ? safe_replace(trim($_GET['e_time'])) : '';
            if ($_arr['e_time'] != "") {
                $e_time = strtotime($_arr['e_time']);
                $where_arr[] = "create_time<{$e_time} ";
            }

            //关键字查询
            $_arr['buy_sid'] = isset($_GET['buy_sid']) ? safe_replace(trim($_GET['buy_sid'])) : '';
            if ($_arr['buy_sid'] != "") {
                $where_arr[] = "buy_sid={$_arr['buy_sid']} ";
            }
            $_arr['buy_id'] = isset($_GET['buy_id']) ? safe_replace(trim($_GET['buy_id'])) : '';
            if ($_arr['buy_id'] != "") {
                $where_arr[] = "buy_id={$_arr['buy_id']} ";
            }
            $_arr['sell_sid'] = isset($_GET['sell_sid']) ? safe_replace(trim($_GET['sell_sid'])) : '';
            if ($_arr['sell_sid'] != "") {
                $where_arr[] = "sell_sid={$_arr['sell_sid']} ";
            }
            $_arr['sell_id'] = isset($_GET['sell_id']) ? safe_replace(trim($_GET['sell_id'])) : '';
            if ($_arr['sell_id'] != "") {
                $where_arr[] = "sell_id={$_arr['sell_id']} ";
            }
            //分类赛选
            $_arr['cate_id'] = isset($_GET["cate_id"]) ? safe_replace($_GET["cate_id"]) : '';

            if ($_arr['cate_id'] == 1) {
                $where_arr[] = "cate_id=1";
            } elseif ($_arr['cate_id'] == 2) {
                $where_arr[] = "cate_id=2 ";
            } elseif ($_arr['cate_id'] == 3) {
                $where_arr[] = "cate_id=0 ";
            }

            $where_arr && $where = implode(" and ", $where_arr);
        }
        return array($where, $_arr);
    }

//----------------------------------分红点记录-----------------------------------------------------

    /**
     * 余额日志记录列表 
     * @param int $pageno 当前页码
     * @return void
     */
    function fenhong_list($page_no = 0) {
        $page_no = max(intval($page_no), 1);
        //列表项
        $tab_title = array(
            'id' => ['#', false],
            'sid' => ['服务商ID', false],
            'uid' => ['用户ID', false],
            'title' => ['类别', false],
            'type' => ['增/减', false],
            'valid_point' => ['分红点', true],
            'now_number' => ['当前分红点', false],
            'create_time' => ['日志时间', true],
        );

        $orderby = "create_time desc";
        $dir = $order = NULL;
        $order = isset($_GET['order']) ? safe_replace(trim($_GET['order'])) : '';
        $dir = isset($_GET['dir']) ? safe_replace(trim($_GET['dir'])) : 'asc';
        if (trim($order) != "") {
            //如果允许排序
            if (isset($tab_title[strtolower($order)][1])) {
                $field = strtolower($order);
                $sort = strtolower($dir) == "asc" ? " asc" : " desc";
                $orderby = $field . $sort;
            }
        }

        //检索处理
        list($where, $_arr) = $this->search_log("id,uid,title");
        //重新拼接一个查询的字符串
        $query = http_build_query($_GET);
        //重新定义要查询的数据库
        $this->Servicer_model->set_table_name('servicer_fenhong', 'mdh_');
        //获取数据源
        $data_list = $this->Servicer_model->listinfo($where, '*', $orderby, $page_no, 10, '', $this->Servicer_model->page_size, page_list_url('admin/servicer/fenhong_list', true));
        $sid = [];
        if ($data_list) {
            foreach ($data_list as $k => $v) {
                $v['type'] = in_array($v['cate_id'], [6, 8]) ? 2 : 1;
                $data_list[$k] = $this->_process_datacorce_value($v);
                $sid[$v['sid']] = $v['sid'];
            }
        }
        $data = array(
            'require_js' => true,
            'data_info' => $_arr,
            'order' => $order,
            'dir' => $dir,
            'data_list' => $data_list,
            'pages' => $this->Servicer_model->pages,
            'tab_title' => $tab_title,
            'ser_name' => $this->servicer_name($sid),
            'query' => $query,
            'cate' => $this->fenhong_cate()
        );
        $this->view('log_list', $data);
    }

    public function fenhong_cate() {
        $cates = getcache("cache_fenhong_cate");
        if (!$cates) {
            $cate = $this->db->get("mdh_servicer_fenhong_cate")->result_array();
            $cates = [];
            foreach ($cate as $val) {
                $cates[$val['id']] = $val['cate'];
            }
            setcache("cache_fenhong_cate", $cates);
        }
        return $cates;
    }

//----------------------------------每日收盘数据统计-----------------------------------------------------

    /**
     * 余额日志记录列表 
     * @param int $pageno 当前页码
     * @return void
     */
    function k_list($page_no = 0) {


        //连接本地的 Redis 服务
//     $redis = new Redis();
//     $redis->connect('127.0.0.1', 6379);
//     echo "Connection to server sucessfully";
//     //设置 redis 字符串数据
//     $redis->set("tutorial-name", "Redis tutorial");
//     // 获取存储的数据并输出
//     echo "Stored string in redis:: " . $redis->get("tutorial-name");
//     die;
        $this->load->driver('cache');


        $page_no = max(intval($page_no), 1);
        //列表项
        $tab_title = array(
            'date' => ['统计日期', false],
            'open' => ['开盘价', true],
            'close' => ['收盘价', true],
            'max' => ['最高', true],
            'min' => ['最低', true],
            'new_buy' => ['新增购买', true],
            'new_sell' => ['新增出售', true],
            'buy' => ['购买分红点', true],
            'sell' => ['出售分红点', true],
            'num' => ['成交笔数', true],
            'point' => ['成交分红点', true],
            'sum' => ['成交金额', true],
            'people' => ['参与人数', true],
            'person' => ['成交人数', true],
            'create_time' => ['更新时间', true],
        );

        $orderby = "create_time desc";
        $dir = $order = NULL;
        $order = isset($_GET['order']) ? safe_replace(trim($_GET['order'])) : '';
        $dir = isset($_GET['dir']) ? safe_replace(trim($_GET['dir'])) : 'asc';
        if (trim($order) != "") {
            //如果允许排序
            if (isset($tab_title[strtolower($order)][1])) {
                $field = strtolower($order);
                $sort = strtolower($dir) == "asc" ? " asc" : " desc";
                $orderby = $field . $sort;
            }
        }

        //检索处理
        list($where, $_arr) = $this->search_log("date");
        //重新拼接一个查询的字符串
        $query = http_build_query($_GET);
        //重新定义要查询的数据库
        $this->Servicer_model->set_table_name('servicer_k', 'mdh_');
        //获取数据源
        if (!$this->cache->redis->get("data_list")) {
            $data_list = $this->Servicer_model->listinfo($where, '*', $orderby, $page_no, 8, '', $this->Servicer_model->page_size, page_list_url('admin/servicer/k_list', true));
            $sid = [];
            if ($data_list) {
                foreach ($data_list as &$v) {
                    $v['create_time'] = date("Y-m-d H:i:s", $v['create_time']);
                }
            }

            $this->cache->redis->save('data_list', $data_list, 60);
            echo "更新了redis缓存";
        } else {
            $data_list = $this->cache->redis->get("data_list");
        }
        dump($this->cache->redis->cache_info());

        dump($data_list);


        die;
        $data = array(
            'title' => "每日统计数据",
            'require_js' => true,
            'data_info' => $_arr,
            'order' => $order,
            'dir' => $dir,
            'data_list' => $data_list,
            'pages' => $this->Servicer_model->pages,
            'tab_title' => $tab_title,
            'query' => $query,
        );
        //开启文件缓存5分钟   静态的页面内容建议开启页面缓存 
//        $this->output->cache(5);
        $this->view('k_list', $data);
    }

    function info() {
        echo phpinfo();
    }

    //像指定浏览器推送消息
    public function workman() {
        // 指明给谁推送，为空表示向所有在线用户推送
        $to_uid = "1";
        // 推送的url地址，使用自己的服务器地址
        $push_api_url = "http://127.0.0.1:2121/";
        $post_data = array(
            "type" => "publish",
            "content" => "你好呀，欢迎来到workman",
            "to" => $to_uid,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $push_api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Expect:"));
        $return = curl_exec($ch);
        curl_close($ch);
        var_export($return);
        $arr = array(55,1, 43, 54, 62, 21, 66, 32, 78, 36, 76, 39);
        $a = $this->quick_sort($arr);
        dump($a);
    }

    //冒泡排序
    function bubbleSort($arr) {
        $len = count($arr);
        for ($i = 1; $i < $len; $i++) {
            for ($k = 0; $k < $len - $i; $k++) {
                if ($arr[$k] > $arr[$k + 1]) {
                    $temp = $arr[$k + 1];
                    $arr[$k + 1] = $arr[$k];
                    $arr[$k] = $temp;
                }
            }
        }

        return $arr;
    }

    //实现思路 双重循环完成，外层控制轮数，当前的最小值。内层 控制的比较次数
    function select_sort($arr) {
        //$i 当前最小值的位置， 需要参与比较的元素
        for ($i = 0, $len = count($arr); $i < $len - 1; $i++) {
            //先假设最小的值的位置
            $p = $i;
            //$j 当前都需要和哪些元素比较，$i 后边的。
            for ($j = $i + 1; $j < $len; $j++) {
                //$arr[$p] 是 当前已知的最小值
                if ($arr[$p] > $arr[$j]) {
                    //比较，发现更小的,记录下最小值的位置；并且在下次比较时，应该采用已知的最小值进行比较。
                    $p = $j;
                }
            }
            //已经确定了当前的最小值的位置，保存到$p中。
            //如果发现 最小值的位置与当前假设的位置$i不同，则位置互换即可
            if ($p != $i) {
                $tmp = $arr[$p];
                $arr[$p] = $arr[$i];
                $arr[$i] = $tmp;
            }
        }
        //返回最终结果
        return $arr;
    }

    function insert_sort($arr) {
        $len = count($arr);
        for ($i = 1; $i < $len; $i++) {
            //获得当前需要比较的元素值。
            $tmp = $arr[$i];
            //内层循环控制 比较 并 插入
            for ($j = $i - 1; $j >= 0; $j--) {
                //$arr[$i];//需要插入的元素; $arr[$j];//需要比较的元素
                if ($tmp < $arr[$j]) {
                    //发现插入的元素要小，交换位置
                    //将后边的元素与前面的元素互换
                    $arr[$j + 1] = $arr[$j];
                    //将前面的数设置为 当前需要交换的数
                    $arr[$j] = $tmp;
                } else {
                    //如果碰到不需要移动的元素
//由于是已经排序好是数组，则前面的就不需要再次比较了。
                    break;
                }
            }
        }
        //将这个元素 插入到已经排序好的序列内。
        //返回
        return $arr;
    }

    function quick_sort($arr) {
        //判断参数是否是一个数组
        if (!is_array($arr))
            return false;
        //递归出口:数组长度为1，直接返回数组
        $length = count($arr);
        if ($length <= 1)
            return $arr;
        //数组元素有多个,则定义两个空数组
        $left = $right = array();
        //使用for循环进行遍历，把第一个元素当做比较的对象
        for ($i = 1; $i < $length; $i++) {
            //判断当前元素的大小
            if ($arr[$i] < $arr[0]) {
                $left[] = $arr[$i];
            } else {
                $right[] = $arr[$i];
            }
        }
        dump($left);
        dump($right);
        //递归调用
        $left = $this->quick_sort($left);
        $right = $this->quick_sort($right);
        dump($left);
        dump($right);
        //将所有的结果合并
        return array_merge($left, array($arr[0]), $right);
    }

}

// END test class

/* End of file test.php */
/* Location: ./test.php */
