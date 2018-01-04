<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?>
<?php defined('BASEPATH') or exit('No permission resources.'); ?>
<div class='panel panel-default grid'>
    <div class='panel-heading'>
        <i class='fa fa-table'></i> test列表
        <div class='panel-tools'>
            <div class='btn-group'>
                <a class="btn " href="<?php echo base_url('admin/test/add') ?>"><span class="glyphicon glyphicon-plus"></span> 添加 </a>             </div>
            <div class='badge'><?php echo count($data_list) ?></div>
        </div>
    </div>
    <div class='panel-filter '>
        <div class='row'>
            <div class='col-md-12'>
                <form class="form-inline" role="form" method="get">

                    <div class="form-group">
                        <label for="keyword" class="control-label form-control-static">关键词</label>
                        <input class="form-control" type="text" name="keyword"  value="<?php echo isset($data_info['keyword']) ? $data_info['keyword'] : ""; ?>" id="keyword" placeholder="请输入关键词"/></div>

                    <div class="form-group">
                        <label for="area" class="col-sm-5 control-label form-control-static">地区</label>
                        <div class="col-sm-7 ">
                            <select class="form-control "  name="area"  id="area">
                                <option value="">==不限==</option>
                                <option value='重庆' <?php if (isset($data_info['area']) && ($data_info['area'] == '重庆')) { ?> selected="selected" <?php } ?>            >chongqing</option>
                                <option value='成都' <?php if (isset($data_info['area']) && ($data_info['area'] == '成都')) { ?> selected="selected" <?php } ?>            >chengdu</option>
                                <option value='上海' <?php if (isset($data_info['area']) && ($data_info['area'] == '上海')) { ?> selected="selected" <?php } ?>            >shanghai</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="city" class="col-sm-5 control-label form-control-static">城市</label>
                        <div class="col-sm-7 ">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="favorite" class="col-sm-3 control-label form-control-static">爱好</label>
                        <div class="col-sm-9 ">
                            <label class="radio-inline">  <input type="checkbox" class="" name="favorite[]"  id="favoritefootball" value="足球
                                                                 "   <?php if (isset($data_info['favorite']) && (str_exists($data_info['favorite'], 'football'))) { ?> checked="checked" <?php } ?>            > football</label><label class="radio-inline">  <input type="checkbox" class="" name="favorite[]"  id="favoritebasketball" value="篮球
                                                                                                                                                                                                        "   <?php if (isset($data_info['favorite']) && (str_exists($data_info['favorite'], 'basketball'))) { ?> checked="checked" <?php } ?>            > basketball</label><label class="radio-inline">  <input type="checkbox" class="" name="favorite[]"  id="favoritepingpang" value="乒乓球"   <?php if (isset($data_info['favorite']) && (str_exists($data_info['favorite'], 'pingpang'))) { ?> checked="checked" <?php } ?>            > pingpang</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="course" class="col-sm-3 control-label form-control-static">课程</label>
                        <div class="col-sm-9 ">

                        </div>
                    </div>
                    <button type="submit" name="dosubmit" value="搜索" class="btn btn-success"><i class='glyphicon glyphicon-search'></i></button>        </form>
            </div>
        </div> 
    </div>
    <form method="post" id="form_list"  action="<?php echo base_url('admin/test/delete_all') ?>"  > 
        <div class='panel-body '>
            <?php if ($data_list): ?>
                <table class="table table-hover dataTable" id="checkAll">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th   nowrap="nowrap">标题</th>
                            <th   nowrap="nowrap">邮箱</th>
                            <th   nowrap="nowrap">手机号</th>
                            <th   nowrap="nowrap">年月日时分秒</th>
                            <?php $css = "";
                            $next_url = base_url('admin/test?order=unique_num&dir=desc');
                            ?>
                            <?php if (($order == 'unique_num' && $dir == 'desc')) { ?>
                                <?php $css = "sorting_desc";
                                $next_url = base_url('admin/test?order=unique_num&dir=asc');
                                ?>
                                <?php } elseif (($order == 'unique_num' && $dir == 'asc')) { ?>
                                    <?php $css = "sorting_asc"; ?>
                                <?php } ?><th class="sorting <?php echo $css; ?>"   onclick="window.location.href = '<?php echo $next_url; ?>'"   nowrap="nowrap">唯一编号</th>
                                <?php $css = "";
                                $next_url = base_url('admin/test?order=price&dir=desc');
                                ?>
                                <?php if (($order == 'price' && $dir == 'desc')) { ?>
                                    <?php $css = "sorting_desc";
                                    $next_url = base_url('admin/test?order=price&dir=asc');
                                    ?>
    <?php } elseif (($order == 'price' && $dir == 'asc')) { ?>
        <?php $css = "sorting_asc"; ?>
    <?php } ?><th class="sorting <?php echo $css; ?>"   onclick="window.location.href = '<?php echo $next_url; ?>'"   nowrap="nowrap">价格</th>
                            <th   nowrap="nowrap">是否显示</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($data_list as $k => $v): ?>
                            <tr>
                                <td><input type="checkbox" name="pid[]" value="<?php echo $v['test_id'] ?>" /></td>
                                <td><?php echo $v['title'] ?></td>
                                <td><?php echo $v['email'] ?></td>
                                <td><?php echo $v['mobile'] ?></td>
                                <td><?php echo $v['ymdhis'] ?></td>
                                <td><?php echo $v['unique_num'] ?></td>
                                <td><?php echo $v['price'] ?></td>
                                <td><?php echo $v['is_display'] ?></td>
                                <td>
                                    <a href="<?php echo base_url('admin/test/readonly/' . $v['test_id']) ?>"  class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt"></span> 查看</a>
                                    <a href="<?php echo base_url('admin/test/edit/' . $v['test_id']) ?>"  class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> 修改</a>
                                    <button type="button" class="btn btn-default btn-xs delete-btn" value="<?php echo $v['test_id']; ?>"><span class="glyphicon glyphicon-remove"></span> 删除</button>

                                </td>
                            </tr>
    <?php endforeach; ?>

                    </tbody>
                </table> 
            </div>
            <div class="panel-footer">
                <div class="pull-left">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" id="reverseBtn"><span class="glyphicon glyphicon-ok"></span> 反选</button>
                        <button type="button" id="deleteBtn"  class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除勾选</button>
                    </div>
                </div>
                <div class="pull-right">
    <?php echo $pages; ?>
                </div>
            </div> 
        </form>  
    </div>
<?php else: ?>
    <div class="no-result">-- 暂无数据 -- </div>
<?php endif; ?>

<script language="javascript" type="text/javascript">
<!--
    $(".datepicker").datepicker();
    $(".datetimepicker").datetimepicker({lang: 'ch'});
    $(".datetimepicker").datepicker();
    $(document).ready(function (e) {
        $("#reverseBtn").click(function () {
            TS.Page.UI.ReverseChecked('pid[]')
        });

        $(".delete-btn").click(function () {
            var v = $(this).val();
            if (confirm('确定要删除吗?'))
            {
                window.location.href = '<?php echo base_url('admin/test/') ?>/delete_one/' + v;
            }
        });

        $("#deleteBtn").click(function () {
            var _arr = TS.Common.Array.GetCheckedValue("pid[]");
            if (_arr.length == 0)
            {
                alert("请先勾选明细");
                return false;
            }
            if (confirm('确定要删除吗?'))
            {
                $("#form_list").submit();
            }
        });
    });
-->
</script>
