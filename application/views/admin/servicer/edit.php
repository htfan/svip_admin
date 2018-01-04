<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?>
<form class="form-horizontal" role="form" id="validateform" name="validateform" action="<?= current_url() ?>" >
    <div class='panel panel-default'>
        <div class='panel-heading'>
            <i class='icon-edit icon-large'></i>
            <?= $is_edit ? "修改" : "新增" ?>用户资料
            <div class='panel-tools'>

                <div class='btn-group'>
                    <?= aci_ui_a('', 'servicer', 'index', '', ' class="btn  btn-sm "', '<span class="glyphicon glyphicon-arrow-left"></span> 返回') ?>
                </div>
            </div>
        </div>
        <div class='panel-body'>
            <?php foreach ($field as $name=>$value):?>
            <fieldset>
                <legend><?=$name?></legend>
                <?php foreach ($value as $key=>$val):?>
                <?php if(!$val[1] || $val[1]=='text'):?>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?=$val[0]?></label>
                    <div class="col-sm-4">
                        <input type="text" name="<?=$key?>"  id="<?=$key?>"  class="form-control validate[required]"  value="<?= $data_info[$key] ?>"  <?= $val[1]?:'disabled';?>>
                    </div>
                </div>
                <?php elseif($val[1]=='password'):?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-4">
                        <input name="password" type="password" class="form-control" id="password" placeholder="保留为空，密码不修改" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">重复密码</label>
                    <div class="col-sm-4">
                        <input name="repassword" type="password" class="form-control validate[equals[password]]" id="repassword" placeholder="保留为空，密码不修改" value=""/>
                    </div>
                </div>
                
                <?php elseif($val[1]=='select'):?>
                <div class="form-group">
                    <label  class="col-sm-2 control-label"><?=$val[0]?></label>
                    <div class="col-sm-4">
                        <select class="form-control validate[required]" name="<?=$key?>">
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
                            <input type="radio" name="<?=$key?>" id="<?=$key?><?=$k?>" value="<?=$k?>" <?= $data_info[$key]==$k ? 'checked="checked"' : '' ?>> <?=$v?>
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
                        <?= aci_ui_a('', '', '', '', ' class="btn btn-default btn-sm uploadThumb_a"', '选择图片 ...') ?>
                        <span class="help-block">只支持图片上传...</span>
                    </div>
                </div>
                <?php endif;?>
                <?php endforeach;?>
            </fieldset>
            <?php endforeach;?>
<!--            
            <fieldset>
                <legend>基本信息</legend>
                <div class="form-group">
                    <label class="col-sm-2 control-label">姓名</label>
                    <div class="col-sm-4">
                        <input type="text" name="name"  id="username"  class="form-control validate[required]"  size="45"  value="<?= $data_info['name'] ?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">角色状态</label>
                    <div class="col-sm-4">
                        <select class="form-control validate[required]" name="cate_id">
                            <option >==请选择==</option>
                            <option value="0" <?= $data_info['cate_id'] == 0 ? "selected" : ''; ?>>待审核</option>
                            <option value="1" <?= $data_info['cate_id'] == 1 ? "selected" : ''; ?>>待支付</option>
                            <option value="2" <?= $data_info['cate_id'] == 2 ? "selected" : ''; ?>>交易商</option>
                            <option value="3" <?= $data_info['cate_id'] == 3 ? "selected" : ''; ?>>服务商</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">登陆账号</label>
                    <div class="col-sm-4">
                        <input name="account" type="text" class="form-control" id="fullname" placeholder="请输入详细内容" value="<?= $data_info['account'] ?>" size="45" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">手机号</label>
                    <div class="col-sm-4">
                        <input name="mobile" type="text" class="form-control  validate[required,custom[mobile]]" value="<?= $data_info['mobile'] ?>" id="mobile" placeholder="请输入手机号" size="45" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">身份证号</label>
                    <div class="col-sm-4">
                        <input name="card" type="text" class="form-control  validate[required]" value="<?= $data_info['card'] ?>" id="card" placeholder="请输入身份证号" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-4">
                        <input name="password" type="password" class="form-control" id="password" placeholder="保留为空，密码不修改" value="" size="45" />
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">重复密码</label>
                    <div class="col-sm-4">
                        <input name="repassword" type="password" class="form-control validate[equals[password]]" id="repassword" placeholder="保留为空，密码不修改" value="" size="45" />
                    </div>
                </div>

            </fieldset>

            
            <fieldset>
                <legend>购买信息</legend>
                <div class="form-group">
                    <label class="col-sm-2 control-label">购买价格</label>
                    <div class="col-sm-4">
                        <input name="price" type="text" class="form-control  validate[required]" value="<?= $data_info['price'] ?>" id="mobile" placeholder="请输入购买价格"  />
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">是否支付</label>
                    <div class="col-sm-4">
                        <select class="form-control validate[required]" name="is_pay">
                            <option >==请选择==</option>
                            <option value="1" <?= $data_info['is_pay'] == 1 ? "selected" : ''; ?>>已支付</option>
                            <option value="0" <?= $data_info['is_pay'] == 0 ? "selected" : ''; ?>>未支付</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">支付备注</label>
                    <div class="col-sm-4">
                        <input name="remark" type="text" class="form-control  validate[required]" value="<?= $data_info['remark'] ?>" id="remark" placeholder="请输入支付备注信息" size="45" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">支付时间</label>
                    <div class="col-sm-4">
                        <input type="text" name="pay_time"  id="pay_time"  class="form-control"  value="<?= $data_info['pay_time'] ?>" disabled >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">有效期至</label>
                    <div class="col-sm-4">
                        <input name="valid_time" type="text" class="form-control" value="<?= $data_info['valid_time'] ?>" disabled />
                    </div>
                </div>

            </fieldset>

            <fieldset>
                <legend>账户信息</legend>
                <div class="form-group">
                    <label class="col-sm-2 control-label">流通分红点</label>
                    <div class="col-sm-4">
                        <input name="use_point" type="text" class="form-control" value="<?= $data_info['use_point'] ?>" disabled   />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">锁定分红点</label>
                    <div class="col-sm-4">
                        <input name="point" type="text" class="form-control" value="<?= $data_info['point'] ?>"  disabled  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">保底分红点</label>
                    <div class="col-sm-4">
                        <input name="close_point" type="text" class="form-control" value="<?= $data_info['close_point']?>" disabled   />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">可用余额</label>
                    <div class="col-sm-4">
                        <input name="balance" type="text" class="form-control  " value="<?= $data_info['balance']?>" disabled />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">冻结余额</label>
                    <div class="col-sm-4">
                        <input name="freeze" type="text" class="form-control  " value="<?= $data_info['freeze'] ?>" disabled />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">冻结设置</label>
                    <div class="col-sm-4">
                        <input name="freeze_money" type="text" class="form-control  " value="<?= $data_info['freeze_money'] ?>" />
                    </div>
                </div>
        

            </fieldset>
            
            <fieldset>
                <legend>分红收益信息</legend>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">是否分红</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="is_fenhong">
                            <option >==请选择==</option>
                            <option value="0" <?= $data_info['is_fenhong'] == 0 ? "selected" : ''; ?>>不参与分红</option>
                            <option value="1" <?= $data_info['is_fenhong'] == 1 ? "selected" : ''; ?>>参与分红</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">昨日收益</label>
                    <div class="col-sm-4">
                        <input name="y_income" type="text" class="form-control" value="<?= $data_info['y_income'] ?>"  disabled  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">收益计算时间</label>
                    <div class="col-sm-4">
                        <input name="point_time" type="text" class="form-control" value="<?= $data_info['point_time'] ?>"  disabled  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">未领取收益</label>
                    <div class="col-sm-4">
                        <input name="income" type="text" class="form-control" value="<?= $data_info['income']?>" disabled   />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">收益领取时间</label>
                    <div class="col-sm-4">
                        <input name="fenhong_time" type="text" class="form-control" value="<?= $data_info['fenhong_time']?>" disabled />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">累计收益</label>
                    <div class="col-sm-4">
                        <input name="cumulative" type="text" class="form-control  " value="<?= $data_info['cumulative'] ?>" disabled />
                    </div>
                </div>
            
            </fieldset>
            
            <fieldset>
                <legend>可选信息</legend>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-4">
                        <input name="email" type="text" class="form-control  validate[required,custom[email]]" value="<?= $data_info['email'] ?>" id="email" placeholder="请输入Email" size="45" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">头像</label>
                    <div class="col-sm-9">
                        <img  class="img-circle" width="100" id="thumb_SRC" border="1" src="<?= $this->method_config['upload']['headimgurl']['upload_url'] ?>/<?= $data_info['headimgurl'] ?>"/>
                        <input type="hidden" id="headimgurl" name="headimgurl" value="<?= $data_info['headimgurl'] ?>" /> 
                        <?= aci_ui_a('', '', '', '', ' class="btn btn-default btn-sm uploadThumb_a"', '选择图片 ...') ?>
                        <span class="help-block">只支持图片上传...</span>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">是否锁定登录</label>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" name="is_lock" id="is_lock1" value="1" <?= $data_info['is_lock'] ? 'checked="checked"' : '' ?>> 是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="is_lock" id="is_lock2" value="0" <?= !$data_info['is_lock'] ? 'checked="checked"' : '' ?>> 否
                        </label>
                    </div>
                </div>
       
            </fieldset>
-->

            <div class='form-actions'>
                <?php aci_ui_button($folder_name, 'user', 'edit', ' type="submit" id="dosubmit" class="btn btn-primary " ', '保存') ?>
            </div>
        </div>

</form>
<script language="javascript" type="text/javascript">

    var id = <?= $data_info['id'] ?>;
    var edit = <?= $is_edit ? "true" : "false" ?>;
    var folder_name = "<?= $folder_name ?>";
    function getHeadimgurl(v, s, w, h) {
        $("#headimgurl").val(v);
        $("#thumb_SRC").attr("src", "<?= $this->method_config['upload']['headimgurl']['upload_url'] ?>" + v);
        $("#dialog").dialog("close");
    }

    require(['<?= SITE_URL ?>scripts/common.js'], function (common) {
        require(['<?= SITE_URL ?>scripts/<?= $folder_name ?>/<?= $controller_name ?>/edit.js']);
    });
</script>