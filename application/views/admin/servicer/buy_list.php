<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?>
<?php defined('BASEPATH') or exit('No permission resources.'); ?>
<div class='panel panel-default grid'>
    <div class='panel-heading'>
        <i class='fa fa-table'></i> <?= $title ?>列表
        <div class='panel-tools'>
            <div class='btn-group'>
                <a class='btn' href='<?php echo current_url() ?>'><i class='glyphicon glyphicon-refresh'></i>刷新</a>
            </div>
            <div class='badge'><?= count($data_list) ?></div>
        </div>
    </div>
    <div class='panel-filter '>
        <div class='row'>
            <div class='col-md-12'>
                <form class="form-inline" role="form" method="get">
                    <div class="form-group">
                        <label for="keyword" class="control-label form-control-static">关键词</label>
                        <input class="form-control" type="text" name="keyword"  value="<?= isset($data_info['keyword']) ? $data_info['keyword'] : ""; ?>" id="keyword" placeholder="请输入关键词"/>
                    </div>
                    <div class="form-group">
                        <label for="cate_id" class="col-sm-5 control-label form-control-static">交易状态</label>
                        <div class="col-sm-7 ">
                            <select class="form-control "  name="cate_id"  id="cate_id">
                                <option value="">==不限==</option>
                                <?php foreach ($cate as $k => $val): ?>
                                    <option value="<?= $k ?>" <?= isset($data_info['cate_id']) && $data_info['cate_id'] == $k ? "selected='selected'" : "" ?>  ><?= $val ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    <button type="submit" name="dosubmit" value="搜索" class="btn btn-success"><i class='glyphicon glyphicon-search'></i></button>       
                </form>
            </div>
        </div> 
    </div>
    <form method="post" id="form_list"  action="<?= base_url('admin/test/delete_all') ?>"  > 
        <div class='panel-body '>
            <?php if ($data_list): ?>
                <table class="table table-hover dataTable" id="checkAll">
                    <thead>
                        <tr>
                            <?php foreach ($tab_title as $key => $val): ?>
                                <?php
                                if ($val[1]) {
                                    $css = "";
                                    $next_url = base_url("admin/servicer/{$method_name}?{$query}&order=$key&dir=desc");
                                    if (($order == $key && $dir == 'desc')) {
                                        $css = "sorting_desc";
                                        $next_url = base_url("admin/servicer/{$method_name}?{$query}&order=$key&dir=asc");
                                    } elseif (($order == $key && $dir == 'asc')) {
                                        $css = "sorting_asc";
                                    }
                                    ?>
                                    <th class="sorting <?= $css ?>" onclick="window.location.href = '<?= $next_url ?>'"   nowrap="nowrap"><?= $val[0] ?></th>
                                <?php } else { ?>
                                    <th   nowrap="nowrap"><?= $val[0] ?></th>
                                <?php } ?>
                            <?php endforeach; ?>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_list as $v): ?>
                            <tr>
                                <?php foreach ($tab_title as $key => $val): ?>
                                    <?php if ($key == 'id'): ?>
                                        <td><input type="checkbox" name="pid[]" value="<?= $v['id'] ?>" /> <?= $v['id'] ?></td>
                                    <?php elseif ($key == "cate_id"): ?>
                                        <td><span class="label  <?= $v['class'] ?>"> <?= $v['cate_id'] ?> </span> </td>
                                    <?php elseif ($key == "is_cancel"): ?>
                                        <td><span class="label  <?= $v['class'] ?>"> <?= $v['is_cancel'] ?> </span> </td>
                                    <?php elseif ($key == "sid"): ?>
                                        <td><?= $ser_name[$v['sid']] . " (" . $v['sid'] . ")" ?></td>
                                    <?php else: ?>
                                        <td><?= $v[$key] ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td>
                                    <a href="<?=base_url('admin/servicer/platform_list')."?{$data_id}={$v['id']}&dosubmit=搜索" ?>"  class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt"></span> 查看</a>
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
                    </div>
                </div>
                <div class="pull-right">
                    <?= $pages; ?>
                </div>
            </div> 
        </form>  
    </div>
<?php else: ?>
    <div class="no-result">-- 暂无数据 -- </div>
<?php endif; ?>

<script language="javascript" type="text/javascript">
    var folder_name = "<?php echo $folder_name ?>"; //当文件所处的文件夹，与js的文件夹相对应
    require(['<?= SITE_URL ?>scripts/common.js'], function (common) {
        require(['<?= SITE_URL ?>scripts/<?= $folder_name ?>/<?= $controller_name ?>/index.js']);
    });
</script>
