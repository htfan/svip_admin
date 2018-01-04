<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php defined('BASEPATH') or exit('No permission resources.'); ?>
<div class='panel panel-default '>
    <div class='panel-heading'>
        <i class='fa fa-table'></i> 服务商 查看信息 
        <div class='panel-tools'>
            <div class='btn-group'>
            	<a class="btn " href="<?=$this->session->userdata['return_url']?>"><span class="glyphicon glyphicon-arrow-left"></span> 返回 </a>
            </div>
        </div>
    </div>
    <div class='panel-body '>
<div class="form-horizontal"  >
    <?php foreach ($field as $name=>$value):?>
            <fieldset>
                <legend><?=$name?></legend>
                <?php foreach ($value as $key=>$val):?>
                <?php if(!$val[1] || $val[1]=='text'):?>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?=$val[0]?></label>
                    <div class="col-sm-4">
                        <input type="text" name="<?=$key?>"  id="<?=$key?>"  class="form-control validate[required]"  value="<?= $data_info[$key] ?>"  disabled>
                    </div>
                </div>
                <?php elseif($val[1]=='select'):?>
                <div class="form-group">
                    <label  class="col-sm-2 control-label"><?=$val[0]?></label>
                    <div class="col-sm-4">
                        <select class="form-control validate[required]" name="<?=$key?>" disabled>
                            <option >==请选择==</option>
                             <?php foreach ($val[2] as $k=>$v):?>
                            <option value="<?=$k?>" <?= $data_info[$key] == $k ? "selected" : ''; ?>><?=$v?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <?php elseif($val[1]=='radio'):?>
                <div class="form-group">
                    <label  class="col-sm-2 control-label"><?=$val[0]?></label>
                    <div class="col-sm-4">
                        <?php foreach ($val[2] as $k=>$v):?>
                        <label class="radio-inline">
                            <input type="radio" name="<?=$key?>" id="<?=$key?><?=$k?>" value="<?=$k?>" <?= $data_info[$key]==$k ? 'checked="checked"' : '' ?> disabled> <?=$v?>
                        </label>
                        <?php endforeach;?>
                    </div>
                </div>
                <?php elseif($val[1]=='image'):?>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?=$val[0]?></label>
                    <div class="col-sm-9">
                        <img  class="img-circle" width="100" id="thumb_SRC" border="1" src="<?= $this->method_config['upload']['headimgurl']['upload_url'] ?>/<?= $data_info[$key] ?>"/>
                        <input type="hidden" id="<?=$key?>" name="<?=$key?>" value="<?= $data_info[$key] ?>" /> 
                    </div>
                </div>
                <?php endif;?>
                <?php endforeach;?>
            </fieldset>
            <?php endforeach;?>
    
	</div>
</div>
</div>
