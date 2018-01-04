<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?>
<?php defined('BASEPATH') or exit('No permission resources.'); ?>
<div class='panel panel-default grid'>
    <div class='panel-heading'>
        <i class='fa fa-table'></i> 服务商列表
        <div class='panel-tools'>
            <div class='btn-group'>
                <a class="btn " href="<?= base_url('admin/test/add') ?>"><span class="glyphicon glyphicon-plus"></span> 添加 </a>             </div>
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
                    <div class="form-group" >
                        <div class="col-sm-12 ">
                            <label class="radio-inline">  
                                <input type="checkbox" class="" name="cate_id[]"  id="favoritebasketball" value="3"   <?=isset($data_info['cate_id']) && in_array(3, $data_info['cate_id']) ? "checked='checked'":'' ?>> 
                                <span class="label label-success">服务商</span>
                            </label>
                            <label class="radio-inline">  
                                <input type="checkbox" class="" name="cate_id[]"  id="favoritebasketball" value="2"   <?=isset($data_info['cate_id']) && in_array(2, $data_info['cate_id']) ? "checked='checked'":'' ?>> 
                                <span class="label label-primary">交易商</span>
                            </label>
                            <label class="radio-inline">  
                                <input type="checkbox" class="" name="cate_id[]"  id="favoritebasketball" value="1"   <?=isset($data_info['cate_id']) && in_array(1, $data_info['cate_id']) ? "checked='checked'":'' ?>> 
                                <span class="label label-info">待支付</span>
                            </label>
                            <label class="radio-inline">  
                                <input type="checkbox" class="" name="cate_id[]"  id="favoritebasketball" value="0"   <?=isset($data_info['cate_id']) && in_array(0, $data_info['cate_id']) ? "checked='checked'":'' ?>> 
                                <span class="label label-warning">待审核</span>
                            </label>
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
                            <?php foreach ($tab_title as $key=>$val):?>
                                <?php if($val[1]){
                                        $css = "";
                                        $next_url = base_url("admin/servicer?{$query}&order=$key&dir=desc");
                                    if (($order == $key && $dir == 'desc')) {
                                        $css = "sorting_desc";
                                        $next_url = base_url("admin/servicer?{$query}&order=$key&dir=asc");
                                    } elseif (($order == $key && $dir == 'asc')) {
                                        $css = "sorting_asc";
                                } ?>
                                <th class="sorting <?= $css ?>" onclick="window.location.href = '<?= $next_url ?>'"   nowrap="nowrap"><?=$val[0]?></th>
                                <?php }else{?>
                                <th   nowrap="nowrap"><?=$val[0]?></th>
                                <?php }?>
                            <?php endforeach;?>
                         
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_list as $k => $v): ?>
                            <tr>
                                 <?php foreach ($tab_title as $key=>$val):?>
                                <?php if($key=='id'):?>
                                <td><input type="checkbox" name="pid[]" value="<?= $v['id'] ?>" /> <?= $v['id'] ?></td>
                                <?php elseif($key=="name"):?>
                                <td> <span class="glyphicon <?=$v['is_lock']?'glyphicon-lock':'glyphicon-user';?>"></span>  <?= $v[$key] ?></td>
                                <?php elseif($key=="level_name"):?>
                                <td><span class="label  <?=$v['class']?>"> <?= $v['level_name'] ?> </span> </td>
                                <?php else:?>
                                <td><?= $v[$key] ?></td>
                                <?php endif;?>
                                <?php endforeach;?>
                                <td>
                                     <?php aci_ui_a($folder_name, 'servicer', 'readonly', $v['id'], ' class="btn btn-default btn-xs"', '<span class="glyphicon glyphicon-share-alt"></span> 查看') ?>
                                     <?php aci_ui_a($folder_name, 'servicer', 'edit', $v['id'], ' class="btn btn-default btn-xs"', '<span class="glyphicon glyphicon-edit"></span> 修改') ?>
                                    <!--<button type="button" class="btn btn-default btn-xs delete-btn" value="<?= $v['id']; ?>"><span class="glyphicon glyphicon-remove"></span> 删除</button>-->
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
                        <?php aci_ui_button($folder_name, 'servicer', 'lock', ' class="btn btn-default" id="lockBtn" ', '<span class="glyphicon glyphicon-lock"></span> 反设置禁止登录') ?>
                        <?php aci_ui_button($folder_name, 'servicer', 'delete_all', ' class="btn btn-default" id="deleteBtn" ', '<span class="glyphicon glyphicon-remove"></span> 删除勾选') ?>
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
    var folder_name = "<?php echo $folder_name?>"; //当文件所处的文件夹，与js的文件夹相对应
    require(['<?=SITE_URL?>scripts/common.js'], function (common) {
        require(['<?=SITE_URL?>scripts/<?=$folder_name?>/<?=$controller_name?>/index.js']);
    });
</script>

<!--在线消息推送测试-->
<div class="notification sticky hide">
    <p id="content"> </p>
    <a class="close" href="javascript:"> <img src="<?=base_url('/css/images/icon-close.png')?>" /></a>
</div>

<div id="footer">
<center id="online_box"></center>
<center><p style="font-size:11px;color:#555;"> Powered by <a href="http://www.workerman.net/web-sender" target="_blank"><strong>web-msg-sender!</strong></a></p></center>
</div>
