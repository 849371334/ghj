<?php
include_once('./pub/top.php');
include_once('./pub/config.php');
?>
<!-- <meta http-equiv="Access-Control-Allow-Origin" content="*"> -->
<div class="col-xs-12 col-sm-9 col-lg-10">
	<ul class="nav nav-tabs">
	<li class="active"><a href="?r=customer/customer&tab=1">管理多客服转接</a></li>
	<li><a href="?r=customer/customer&tab=2"><i class="fa fa-plus"></i> 添加多客服转接</a></li>
	<li><a href="?r=customer/customer&tab=3"> 客服聊天记录</a></li>
</ul>
<div class="clearfix">
	<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<div class="form-horizontal" role="form">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
					<div class="col-sm-8 col-lg-9 col-xs-12">
						<div class="btn-group">
							<a href="javascript:void(0)"  class="btn btn-primary">所有</a>
							<a href="javascript:void(0)"  class="btn fix" statu = '1'>启用</a>
							<a href="javascript:void(0)"  class="btn fix" statu = '2'>禁用</a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
					<div class="col-sm-8 col-xs-12">
							<input class="form-control" name="keyword" type="text" id='keyword'>
							<span></span>
					</div>
					<div class="col-xs-12 col-sm-2 col-lg-1 text-right">
						<button class="btn btn-default"><i class="fa fa-search btn-default"></i> 搜索</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id='infos'>
	https://api.weixin.qq.com/customservice/kfaccount/del?access_token=ACCESS_TOKEN&kf_account=KFACCOUNT
		
	<div>
</div>
<script>
	$(function(){
		token = '1';
		function gettokens(){
			$.ajax({
				'type' : 'GET',
				'url'  : '?r=qrcode/gettoken',
				success: function(e){
					token = e
				},
				error  : function(e){
					alert('no token got');
				}
			})
		}
		gettokens()
		$('.btn-default').click(function(){
			var keyword = $('#keyword').val();
			if(keyword == ''){
				$('span').html('请输入关键字，以便查询!')
				return;
			}
			$.ajax({
				type: 'GET',
				url : '?r=customer/find_customer',
				data: {keyword:keyword},
				success: function(data){
					var data = $.parseJSON(data);
			   		if(data.code == 0){
			   			alert(data.msg);
			   			return;
			   		}
			   		else
			   		{
			   			var str = '<h3>'+data.msg+'</h3><table border=1><tr><th>选择</th><th>客服账号</th><th>客服昵称</th><th>头像</th><th>客服微信</th></tr>'
			   			$.each(data.data,function(i,v){
			   				str += '<tr><td><input type=checkbox nickname='+v.kf_nick+' account='+v.kf_account+' id='+v.id+'></td><td>'+v.kf_account+'</td><td>'+v.kf_nick+'</td><td>'+ 	v.kf_headimgurl+'</td><td>'+v.kf_wx+'</td></tr>';
			   			})
			   			str += '</table>';
			   			$('#infos').html(str);
			   		}

			    },
			    error: function(){
			    	alert('unknown error occurred , please check ! ')
			    }
			})
		})
		$('.fix').click(function(){
			// alert(token)
			var statu = $(this).attr('statu');
			var kf_account = $("input:checkbox:checked").attr('account');
			
			if(kf_account == null)
			{
				alert('please choose at least one account !');
				return;
			}
			
			if(statu == '1'){
				var nickname = $("input:checkbox:checked").attr('nickname');
				$.ajax({
					type : 'GET',
					dataType:'jsonp',
					url : 'https://api.weixin.qq.com/customservice/kfaccount/add?access_token='+token,
					data:{
						 "kf_account" : kf_account,
						 "nickname"   : nickname
					},
					success: function(data){
						console.log("返回的数据: " + data );
						//库操作需要正确的返回码以及相关测试数据，亟待完善
					},
					error:function(data){
						console.log("返回的数据: " + data );
					}
				})
			}
			if(statu == '2'){
				$.ajax({
					type: 'GET',
					dataType:'jsonp',
					url : 'https://api.weixin.qq.com/customservice/kfaccount/del?access_token='+token+'&kf_account='+kf_account,
					success: function(data){
						console.log("返回的数据: " + data );
						//库操作需要正确的返回码以及相关测试数据，亟待完善
					},
					error:function(data){
						console.log("返回的数据: " + data );
					}
				})
			}
		})
		
	})
</script>