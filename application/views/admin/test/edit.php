<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php defined('BASEPATH') or exit('No permission resources.'); ?>
<form class="form-horizontal" role="form" id="validateform" name="validateform" action="<?php echo base_url('admin/test/edit')?>" >
	<div class='panel panel-default '>
		<div class='panel-heading'>
			<i class='fa fa-table'></i> test 修改信息
			<div class='panel-tools'>
				<div class='btn-group'>
					<a class="btn " href="<?php echo base_url('admin/test')?>"><span class="glyphicon glyphicon-arrow-left"></span> 返回 </a>
				</div>
			</div>
		</div>
		<div class='panel-body '>
								<fieldset>
						<legend>基本信息</legend>
													
	<div class="form-group">
				<label for="title" class="col-sm-2 control-label form-control-static">标题</label>
				<div class="col-sm-9 ">
					<input type="text" name="title"  id="title"  value='<?php echo isset($data_info['title'])?$data_info['title']:'' ?>'  class="form-control validate[required]"  placeholder="请输入标题" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="url" class="col-sm-2 control-label form-control-static">跳转链接</label>
				<div class="col-sm-9 ">
					<input type="url" name="url"  id="url"   value='<?php echo isset($data_info['url'])?$data_info['url']:'' ?>'   class="form-control  validate[custom[url]]"  placeholder="请输入跳转链接" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="content" class="col-sm-2 control-label form-control-static">内容</label>
				<div class="col-sm-9 ">
					<textarea name="content"  id="content"  cols="45" rows="5" class="form-control " placeholder="请输入内容" ><?php echo isset($data_info['content'])?$data_info['content']:'' ?></textarea>
				</div>
			</div>
													
	<div class="form-group">
				<label for="image" class="col-sm-2 control-label form-control-static">新闻图片</label>
				<div class="col-sm-9 ">
					<a href="javascript:uploadOneFile('image',550,350,1)" ><img  width="100" id="image_SRC" border="1" src="<?php echo base_url("/images/nopic.gif")?>"/></a><input type="hidden" id="image" name="image" value="" /> <a href="javascript:uploadOneFile('image',550,350,1)" class="btn btn-default btn-sm" > 选择图片 ...</a><span class="help-block">只支持图片上传.</span>
<script language="javascript" type="text/javascript">
	function uploadOneFile(inputId,w,h,iscallback){
		if(!w) w=screen.width-4;
		if(!h) h=screen.height-95;
		if(!iscallback)iscallback=0;
		var window_url = SITE_URL+'admin//test/upload/';
		$.extDialogFrame(window_url+'1/image/'+inputId+'/'+iscallback,{model:true,width:w,height:h,title:'请上传...',buttons:null});
	}
</script>

<script language="javascript" type="text/javascript">
	function getImage(v,s,w,h){
		$("#image").val(v);
		$("#image_SRC").attr("src","test_new_/"+v);
		$("#dialog" ).dialog();$("#dialog" ).dialog("close");
	}
		getImage('<?php echo isset($data_info['image'])?$data_info['image']:'' ?>',0,0,0);
</script>

				</div>
			</div>
													
	<div class="form-group">
				<label for="profile" class="col-sm-2 control-label form-control-static">简介</label>
				<div class="col-sm-9 ">
					<textarea name="profile"  id="profile"  cols="45" rows="5" class="form-control " placeholder="请输入简介" > <?php echo isset($data_info['profile'])?$data_info['profile']:'' ?></textarea>
				</div>
			</div>
													
	<div class="form-group">
				<label for="email" class="col-sm-2 control-label form-control-static">邮箱</label>
				<div class="col-sm-9 ">
					<input type="email" name="email"  id="email"   value='<?php echo isset($data_info['email'])?$data_info['email']:'' ?>'  class="form-control  validate[custom[email]]"  placeholder="请输入邮箱" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="mobile" class="col-sm-2 control-label form-control-static">手机号</label>
				<div class="col-sm-9 ">
					<input type="text" name="mobile"  id="mobile"   value='<?php echo isset($data_info['mobile'])?$data_info['mobile']:'' ?>'   class="form-control  validate[custom[phone]]"  placeholder="请输入手机号" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="ymd" class="col-sm-2 control-label form-control-static">年月日</label>
				<div class="col-sm-9 ">
					<input type="text" name="ymd"  id="ymd"   value='<?php echo isset($data_info['ymd'])?$data_info['ymd']:'' ?>'  class="form-control datepicker validate[custom[date]]"  placeholder="请输入年月日" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="ymdhis" class="col-sm-2 control-label form-control-static">年月日时分秒</label>
				<div class="col-sm-9 ">
					<input type="text" name="ymdhis"  id="ymdhis"   value='<?php echo isset($data_info['ymdhis'])?$data_info['ymdhis']:'' ?>'  class="form-control datetimepicker validate[custom[datetime]]"  placeholder="请输入年月日时分秒" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="his" class="col-sm-2 control-label form-control-static">时分秒</label>
				<div class="col-sm-9 ">
					<div class="form-inline"><input type="hidden"  value='<?php echo isset($data_info['his'])?$data_info['his']:'' ?>' name="his"  id="his"   class="timepicker validate[custom[time]]" ><div class="input-group col-sm-2"><div class="input-group-addon">时</div><select class="form-control"  id='his_h' onchange="setTimeValue('his')">
<option value='00'>00</option>
<option value='01'>01</option>
<option value='02'>02</option>
<option value='03'>03</option>
<option value='04'>04</option>
<option value='05'>05</option>
<option value='06'>06</option>
<option value='07'>07</option>
<option value='08'>08</option>
<option value='09'>09</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
</select>
 </div><div class="input-group col-sm-2"><div class="input-group-addon">分</div><select class="form-control" id='his_i' onchange="setTimeValue('his')">
<option value='00'>00</option>
<option value='01'>01</option>
<option value='02'>02</option>
<option value='03'>03</option>
<option value='04'>04</option>
<option value='05'>05</option>
<option value='06'>06</option>
<option value='07'>07</option>
<option value='08'>08</option>
<option value='09'>09</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
<option value='13'>13</option>
<option value='14'>14</option>
<option value='15'>15</option>
<option value='16'>16</option>
<option value='17'>17</option>
<option value='18'>18</option>
<option value='19'>19</option>
<option value='20'>20</option>
<option value='21'>21</option>
<option value='22'>22</option>
<option value='23'>23</option>
<option value='24'>24</option>
<option value='25'>25</option>
<option value='26'>26</option>
<option value='27'>27</option>
<option value='28'>28</option>
<option value='29'>29</option>
<option value='30'>30</option>
<option value='31'>31</option>
<option value='32'>32</option>
<option value='33'>33</option>
<option value='34'>34</option>
<option value='35'>35</option>
<option value='36'>36</option>
<option value='37'>37</option>
<option value='38'>38</option>
<option value='39'>39</option>
<option value='40'>40</option>
<option value='41'>41</option>
<option value='42'>42</option>
<option value='43'>43</option>
<option value='44'>44</option>
<option value='45'>45</option>
<option value='46'>46</option>
<option value='47'>47</option>
<option value='48'>48</option>
<option value='49'>49</option>
<option value='50'>50</option>
<option value='51'>51</option>
<option value='52'>52</option>
<option value='53'>53</option>
<option value='54'>54</option>
<option value='55'>55</option>
<option value='56'>56</option>
<option value='57'>57</option>
<option value='58'>58</option>
<option value='59'>59</option>
</select>
 </div><div class="input-group col-sm-2"><div class="input-group-addon">秒</div><select class="form-control" id='his_s' onchange="setTimeValue('his')">
<option value='00'>00</option>
<option value='01'>01</option>
<option value='02'>02</option>
<option value='03'>03</option>
<option value='04'>04</option>
<option value='05'>05</option>
<option value='06'>06</option>
<option value='07'>07</option>
<option value='08'>08</option>
<option value='09'>09</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
<option value='13'>13</option>
<option value='14'>14</option>
<option value='15'>15</option>
<option value='16'>16</option>
<option value='17'>17</option>
<option value='18'>18</option>
<option value='19'>19</option>
<option value='20'>20</option>
<option value='21'>21</option>
<option value='22'>22</option>
<option value='23'>23</option>
<option value='24'>24</option>
<option value='25'>25</option>
<option value='26'>26</option>
<option value='27'>27</option>
<option value='28'>28</option>
<option value='29'>29</option>
<option value='30'>30</option>
<option value='31'>31</option>
<option value='32'>32</option>
<option value='33'>33</option>
<option value='34'>34</option>
<option value='35'>35</option>
<option value='36'>36</option>
<option value='37'>37</option>
<option value='38'>38</option>
<option value='39'>39</option>
<option value='40'>40</option>
<option value='41'>41</option>
<option value='42'>42</option>
<option value='43'>43</option>
<option value='44'>44</option>
<option value='45'>45</option>
<option value='46'>46</option>
<option value='47'>47</option>
<option value='48'>48</option>
<option value='49'>49</option>
<option value='50'>50</option>
<option value='51'>51</option>
<option value='52'>52</option>
<option value='53'>53</option>
<option value='54'>54</option>
<option value='55'>55</option>
<option value='56'>56</option>
<option value='57'>57</option>
<option value='58'>58</option>
<option value='59'>59</option>
</select>
 </div> </div>
<script language="javascript" type="text/javascript">
	var his_val = '<?php echo isset($data_info['his'])?$data_info['his']:'' ?>';
	var his_arr = his_val.split(':')
	if(his_arr.length==3){
		$('#his_h').val(his_arr[0])
		$('#his_i').val(his_arr[1])
		$('#his_s').val(his_arr[2])
	}
	function setTimeValue(inputId){
		var h= $('#'+inputId+'_h').val();
		var i= $('#'+inputId+'_i').val();
		var s= $('#'+inputId+'_s').val();
		$('#'+inputId).val(h+':'+i+':'+s);
	}
</script>

				</div>
			</div>
													<input type="hidden" name="o_unique_num"  id="o_unique_num" value="<?php echo isset($data_info['unique_num'])?$data_info['unique_num']:'' ?>"  >
	<div class="form-group">
				<label for="unique_num" class="col-sm-2 control-label form-control-static">唯一编号</label>
				<div class="col-sm-9 ">
					<input type="text" name="unique_num"  id="unique_num"   value="<?php echo isset($data_info['unique_num'])?$data_info['unique_num']:'' ?>"  autocomplete="off" class="form-control username "  placeholder="请输入唯一编号" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="password" class="col-sm-2 control-label form-control-static">密码</label>
				<div class="col-sm-9 ">
					<input type="password" name="o_password"  id="o_password"    autocomplete="off"  class="form-control password "  placeholder="请输入密码" >
				</div>
			</div>

	<div class="form-group">
				<label for="password" class="col-sm-2 control-label form-control-static">确认密码</label>
				<div class="col-sm-9 ">
					<input type="password" name="password"  id="password"    autocomplete="off" class="form-control  "  placeholder="请再次输入密码" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="number" class="col-sm-2 control-label form-control-static">数字</label>
				<div class="col-sm-9 ">
					<input type="number" name="number"  id="number"  value='<?php echo isset($data_info['number'])?$data_info['number']:'' ?>'   class="form-control validate[custom[integer]]" placeholder="请输入数字" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="price" class="col-sm-2 control-label form-control-static">价格</label>
				<div class="col-sm-9 ">
					<input type="number" name="price"  id="price"   value='<?php echo isset($data_info['price'])?$data_info['price']:'' ?>'   class="form-control validate[custom[price]]" placeholder="请输入价格" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="is_display" class="col-sm-2 control-label form-control-static">是否显示</label>
				<div class="col-sm-9 ">
					<select class="form-control "  name="is_display"  id="is_display"><option value="是" <?php if(isset($data_info['is_display'])&&($data_info['is_display']=='是')) { ?> 'selected="selected"' <?php } ?>            >是</option><option value="否" <?php if(isset($data_info['is_display'])&&($data_info['is_display']=='否')) { ?> 'selected="selected"' <?php } ?>            >否</option></select>
				</div>
			</div>
													
	<div class="form-group">
				<label for="is_work" class="col-sm-2 control-label form-control-static">是否工作</label>
				<div class="col-sm-9 ">
					<label class="radio-inline">  <input type="radio" class="" name="is_work"  id="is_work1" value="是" <?php if(isset($data_info['is_work'])&&(trim($data_info['is_work'])=='是')) { ?> checked="checked" <?php } ?>            > 是</label><label class="radio-inline">  <input type="radio"  class="" name="is_work"  id="is_work2" value="否"<?php if(isset($data_info['is_work'])&&(trim($data_info['is_work'])=='否')) { ?> checked="checked" <?php } ?>            > 否</label>
				</div>
			</div>
													
	<div class="form-group">
				<label for="area" class="col-sm-2 control-label form-control-static">地区</label>
				<div class="col-sm-9 ">
					<select class="form-control "  name="area"  id="area">
				<option value="">==请选择==</option>
								<option value='重庆' <?php if(isset($data_info['area'])&&($data_info['area']=='重庆')) { ?> selected="selected" <?php } ?>            >chongqing</option>
				<option value='成都' <?php if(isset($data_info['area'])&&($data_info['area']=='成都')) { ?> selected="selected" <?php } ?>            >chengdu</option>
				<option value='上海' <?php if(isset($data_info['area'])&&($data_info['area']=='上海')) { ?> selected="selected" <?php } ?>            >shanghai</option>
</select>
				</div>
			</div>
													
	<div class="form-group">
				<label for="city" class="col-sm-2 control-label form-control-static">城市</label>
				<div class="col-sm-9 ">
					
				</div>
			</div>
													
	<div class="form-group">
				<label for="author_id" class="col-sm-2 control-label form-control-static">发布员id</label>
				<div class="col-md-5 ">
					<input class="form-control"  readonly="readonly" placeholder="请点击选择" type="text" id="author_id_text" onclick="javascript:ChooseWindowAuthor_id('author_id',800,550,1,2)"  /><input type="hidden" id="author_id" name="author_id"  />
<script language="javascript" type="text/javascript">
	function ChooseWindowAuthor_id(inputId,w,h,iscallback){
		if(!w) w=screen.width-4;
		if(!h) h=screen.height-95;
		if(!iscallback)iscallback=0;
		var window_url = '<?php echo base_url('admin/role/group')?>_window/';
		$.extDialogFrame(window_url+inputId,{model:true,width:w,height:h,title:'请选择...',buttons:null});
	}
</script>

<script language="javascript" type="text/javascript">
	function getAuthor_id(v,t){
		$("#author_id").val(v);
		$("#author_id_text").val(t);
		$("#dialog" ).dialog();$("#dialog" ).dialog("close");
	}
<?php $_tmp1= isset($data_info['author_id_text'])?$data_info['author_id_text']:'';?>
<?php $_tmp2= isset($data_info['author_id'])?$data_info['author_id']:'';?> 
		getAuthor_id('<?php echo $_tmp2;?>', '<?php echo $_tmp1;?>');
</script>

				</div>
			</div>
													
	<div class="form-group">
				<label for="favorite" class="col-sm-2 control-label form-control-static">爱好</label>
				<div class="col-sm-9 ">
					<select class="form-control " multiple name="favorite[]"  id="favorite"><option value="">==请选择==</option><option value='足球'  <?php if(isset($data_info['favorite'])&&(str_exists($data_info['favorite'],'football'))) { ?> selected="selected" <?php } ?>            >football</option>
<option value='篮球'  <?php if(isset($data_info['favorite'])&&(str_exists($data_info['favorite'],'basketball'))) { ?> selected="selected" <?php } ?>            >basketball</option>
<option value='乒乓球'  <?php if(isset($data_info['favorite'])&&(str_exists($data_info['favorite'],'pingpang'))) { ?> selected="selected" <?php } ?>            >pingpang</option>
</select>
				</div>
			</div>
													
	<div class="form-group">
				<label for="course" class="col-sm-2 control-label form-control-static">课程</label>
				<div class="col-sm-9 ">
					
				</div>
			</div>
													
	<div class="form-group">
				<label for="author_ids" class="col-sm-2 control-label form-control-static">允许修改的人员</label>
				<div class="col-sm-9 ">
					<input type="text" name="author_ids"  id="author_ids"  value='<?php echo isset($data_info['author_ids'])?$data_info['author_ids']:'' ?>'  class="form-control validate[required]"  placeholder="请输入允许修改的人员" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="file" class="col-sm-2 control-label form-control-static">下载文件</label>
				<div class="col-sm-9 ">
					<a  id="file_a" target="_blank"></a><input type="hidden" id="file" name="file"/> <a href="javascript:uploadOneFile('file',550,350,1,2)" class="btn btn-default btn-sm" > 选择文件 ...</a><span class="help-block">只支持文件上传.</span>
<script language="javascript" type="text/javascript">
	function getFile(v,s,w,h){
		$("#dialog" ).dialog();$("#dialog" ).dialog("close");
	}
		getFile('<?php echo isset($data_info['file'])?$data_info['file']:'' ?>',0,0,0);
</script>

				</div>
			</div>
																																																		</fieldset>
							<div class='form-actions'>
				<button class='btn btn-primary ' type='submit' id="dosubmit">保存</button>
			</div>
</form>
	<script language="javascript" type="text/javascript">
		<!--
		$(document).ready(function(e) {
						$(".datepicker").datepicker();
									$(".datetimepicker").datetimepicker({lang:'ch'});
									$(".datetimepicker").datepicker();
						$("#myform").validationEngine();

			$( "form" ).submit(function( event ) {
				event.preventDefault();
				$("#dosubmit").attr("disabled","disabled");
				if($("form").validationEngine('validate'))
				{
					$.ajax({
						type: "POST",
						url: "<?php echo current_url()?>",
						data:  $("#myform").serialize(),
						success:function(response){
							var dataObj=eval("("+response+")");
							if(dataObj.status)
							{
								setTimeout(function(){
									window.location.href='<?php echo base_url('admin/test')?>';
								},1000);

							}else
							{
								alert(dataObj.tips);
								$("#dosubmit").removeAttr("disabled");
							}
						},
						error: function (request, status, error) {
							$("#dosubmit").removeAttr("disabled");
							alert(request.responseText);

						}
					});
				}else
					$("#dosubmit").removeAttr("disabled");

			});

		});
		-->
	</script>
