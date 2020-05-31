var type = false;
/*arr=['好好学习','努力活下去','不要被消灭！','努力赚钱','加油'];
layer.alert('扶贫金额请根据个人情况决定，0.01不嫌少，100万不嫌多。', {
	title: '扶贫计划声明',
	skin: 'layui-layer-lan'
});*/
$.ajax({
	type: "get",
	url: "getdata.php",
	timeout: 60000,
	dataType: "json",
	beforeSend: function (moleft) {
		//var loading = layer.msg('玩命创建订单ing...', {icon: 16,shade: 0.10});
	},
	success: function(json) {
		if(json.data){
			$("#products").html(json.data);
		}else{
			layer.alert('获取梦想列表失败！', {
				icon: '2',
				title: '温馨提示',
				skin: 'layui-layer-lan'
			});
		}
	},
	error: function (textStatus) {
		    layer.alert('内部服务器错误！', {
				icon: '2',
				title: '温馨提示',
				skin: 'layui-layer-lan'
			});
		}
	});
$("#changetype").click(function(){
	if(type == false){
		$("#amountinput").show();
		$("#amountchose").hide();
		$("#changetype").val("爷不想写");
		type = true;
	}else{
		$("#amountinput").hide();
		$("#amountchose").show();
		$("#changetype").val("爷自己写");
		$("#inputamount").val("10");
		type = false;
	}
});
$("#change").click(function(){
	var num = Math.floor(Math.random()*arr.length);
	$("#info").val(arr[num]);
});
$("#submit").click(function(){
	/*if(type == true){
		var money = $("#inputamount").val();
	}else{
		var money = $("#choseamount").val();
	}*/
	var money = $("#inputamount").val();

	if(!money){
		layer.alert('不填金额的话用爱发电吗！', {
			icon: '2',
			title: '温馨提示',
			skin: 'layui-layer-lan'
		});
		return false;
	}

	var info = $("#info").val();
	if(!info){
		layer.alert('扶贫起码得选择一个理由吧！', {
			icon: '2',
			title: '温馨提示',
			skin: 'layui-layer-lan'
		});
		return false;
	}

	
	layer.confirm('圆梦金额：'+money+'<br>买单方式：支付宝<br>您的梦想：'+info, {
		  title: '请确认您的梦想',
		  btn: ['确认','取消'],
		  skin: 'layui-layer-lan'
		}, function(){
			$.ajax({
		        type: "post",
		        url: "pay.php",
		        data: {money:money,info:info},
		        timeout: 60000,
		        dataType: "json",
		        beforeSend: function (moleft) {
		           var loading = layer.msg('玩命实现梦想ing...', {icon: 16,shade: 0.10});
		        },
		        success: function(json) {
		        	if(json.code > 0){
		               layer.msg("梦想已经创建成功，请尽快买单~");
		               checkPayResult(json.order);
		               $("#qrcode").attr("src", 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data='+json.qrcode);
		               $("#alipay").attr("href", 'alipayqr://platformapi/startapp?saId=10000007&clientVersion=3.7.0.0718&qrcode='+json.qrcode);
		               $("#main1").hide();
					   $("#products").hide();
					   $("#main2").show();
		        	}else{
		        		layer.alert(json.msg, {
						icon: '2',
						title: '温馨提示',
						skin: 'layui-layer-lan'
					});
		        	}
		        },
		        error: function (textStatus) {
		        	layer.close(loading);
		        	layer.alert('内部服务器错误！', {
						icon: '2',
						title: '温馨提示',
						skin: 'layui-layer-lan'
					});
		        }
		    });
		}, function(){
			layer.msg('请不要放弃您的梦想，加油哦~');
	});
});

function checkPayResult(alipay_order){
	setOrder = setInterval(function() {
	    $.ajax({
	        type: 'post',
	        url: './query.php',
	        data: {
	            no: alipay_order,
	            t: Math.random()
	        },
	        dataType: 'json',
	        success: function(data) {
	            if (data.status.toLowerCase() == "success") {
	               layer.alert('感谢您对3毛钱助梦计划的支持！', {
						icon: '1',
						title: '支付成功',
						skin: 'layui-layer-lan'
					});
	                $("#success").show();
	                $("#fanhui").show();
	                $("#alipay").hide();
	                $("#fangqi").hide();
	                clearInterval(setOrder);
	            }

	        },
	        error: function(XMLHttpRequest, textStatus, errorThrown) {
	            alert(errorThrown);
	        }
	    });

	}, 1000);
}
