<?php
include_once('./pub/top.php');
include_once('./pub/config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
	<ul class="nav nav-tabs">
		<li class="active"><a href="?r=qrcode/qrcode&tab=1">管理二维码</a></li>
		<li><a href="?r=qrcode/qrcode&tab=2">生成二维码</a></li>
		<li><a href="?r=qrcode/qrcode&tab=3">扫描统计</a></li>
	</ul>
	<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<!-- <form action="./index.php" method="get" class="form-horizontal" role="form"> -->
			<input type="hidden" name="c" value="platform">
			<input type="hidden" name="a" value="qr">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">场景名称</label>
					<div class="col-sm-6 col-lg-8 col-xs-12">
						<input type="text" name="keyword" id="keyword" class="form-control" value="" placeholder="请输入场景名称">
					</div>
					<div class="pull-right col-xs-12 col-sm-3 col-lg-2">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>
				</div>
			<!-- </form> -->
		</div>
	</div>
	<div class="alert alert-info">您可以通过二维码链接,自己生成二维码。也可以直接点击查看系统生成的二维码</div>
	<div class="panel panel-default">
		<div class="table-responsive panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:100px;">场景名称</th>
					<th style="width:100px;">关联关键字</th>
					<th style="width:70px;">二维码类型</th>
					<th style="width:100px;">场景ID/场景字符串</th>
					<th style="width:160px;">二维码</th>
					<th style="width:190px;">url</th>
					<th style="width:100px;">生成时间</th>
					<th style="width:100px">到期时间</th>
				</tr>
			</thead>
			<tbody>
			
			</tbody>
		</table>
		</div>
	</div>
	<a href="javascript:void(0)" class="btn btn-primary" style="margin-bottom:15px">删除全部已过期二维码</a>
	注意：永久二维码无法在微信平台删除，但是您可以点击<a href="javascript:void(0);">【强制删除】</a>来删除本地数据。
				</div>
		</div>
</div>
<script>
	$(function(){
		$('.btn-default').click(function(){
			var keywords = $('#keyword').val();
			if(!keywords){
				alert('please insert ur keyword');
				return;
			}
			$.ajax({
				type: 'get',
				url : '?r=qrcode/find_qrcode',
				data: {keywords:keywords},
				success:function(data){
					var data = $.parseJSON(data);
					if(data.code == 0){
			   			alert(data.msg);
			   			return;
			   		}else{
			   			str = '';
			   			$.each(data.data,function(i,v){
			   				str += '<tr><td>'+v.scene_name+'</td><td>'+v.key_name+'</td><td>'+v.type+'</td><td>'+v.scene_name+'</td><td><img src="'+v.qrcode_url+v.ticket+'" width=150 height=150/></td><td>'+v.qrcode_url+v.ticket+'</td><td>'+v.add_time+'</td><td>'+v.end_time+'</td>';
			   			})
			   			$('tbody').html(str);
			   		}
				},
				error:function(data){
					alert('unknown error occurred , please check ! ');
				}
			})
		})
		$('.btn-primary').click(function(){
			if(!confirm('Are you sure to delete all ?')){
				return;
			}
			$.ajax({
				'type': 'GET',
				'url' : '?r=qrcode/delcode',
				success : function(e){
					var data = $.parseJSON(data);
					alert(data.msg)
				},
				error : function(e){
					alert('unknown error occurred , please check ! ');
				}
			})
		})
	})
</script>