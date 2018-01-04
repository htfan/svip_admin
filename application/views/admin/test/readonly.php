<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php defined('BASEPATH') or exit('No permission resources.'); ?>
<div class='panel panel-default '>
    <div class='panel-heading'>
        <i class='fa fa-table'></i> test 查看信息 
        <div class='panel-tools'>
            <div class='btn-group'>
            	<a class="btn " href="<?php echo base_url('admin/test')?>"><span class="glyphicon glyphicon-arrow-left"></span> 返回 </a>
            </div>
        </div>
    </div>
    <div class='panel-body '>
<div class="form-horizontal"  >
	<fieldset>
        <legend>基本信息</legend>
     
  	  <?php foreach ($data_info as $k=>$val):?>	
	<div class="form-group">
				<label for="<?=$k ?>" class="col-sm-2 control-label form-control-static"><?=$field[$k]?></label>
				<div class="col-sm-9 form-control-static ">
					<?=$val ?>
				</div>
			</div>
	  <?php endforeach;?>	
	
	    </fieldset>
	</div>
</div>
</div>
