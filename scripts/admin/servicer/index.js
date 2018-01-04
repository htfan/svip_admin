define(function (require) {
	var $ = require('jquery');
	var aci = require('aci');
	require('bootstrap');
	require('datetimepicker');
	require('notify');
        require('message');
        

        //选择按钮
	$("#reverseBtn").click(function(){
		aci.ReverseChecked('pid[]');
	});
        //锁定按钮
	$("#lockBtn").click(function(){
		var _arr = aci.GetCheckboxValue('pid[]');
		if(_arr.length==0)
		{
			alert("请先勾选明细");
			return false;
		}

		if(confirm("确定要反设置禁止登录？"))
		{
			$("#form_list").attr("action",SITE_URL+folder_name+"/servicer/lock/");
			$("#form_list").submit();
		}
	});
        //删除按钮
	$("#deleteBtn").click(function(){
		var _arr = aci.GetCheckboxValue('pid[]');
             
		if(_arr.length==0)
		{
			alert("请先勾选明细");
			return false;
		}

		if(confirm("确定要删除用户吗？"))
		{
			$("#form_list").attr("action",SITE_URL+folder_name+"/servicer/delete_all/");
			$("#form_list").submit();
		}
	});
        
        //日期选择插件
        $('.datetimepicker').datetimepicker({lang:'ch'});
        
         // 连接服务端
        var socket = io('http://127.0.0.1:2120');
        // 连接后登录
        var uid = "1";
        socket.on('connect', function(){
            socket.emit('login', uid);
        });
        // 后端推送来消息时
        socket.on('new_msg', function(msg){
             $.scojs_message('你收到了来自服务器的最新消息...'+msg, $.scojs_message.TYPE_OK);
             $('#content').html('收到消息：'+msg);
             $('.notification.sticky').notify();
        });
        // 后端推送来在线数据时
        socket.on('update_online_count', function(online_stat){
            $('#online_box').html(online_stat);
        });
});