<?php
include_once('./pub/top.php');
include_once('./pub/config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
<ul class="nav nav-tabs">
		<li><a href="?r=qrcode/qrcode&tab=1">管理二维码</a></li>
		<li><a href="?r=qrcode/qrcode&tab=2">生成二维码</a></li>
		<li class="active"><a href="?r=qrcode/qrcode&tab=3">扫描统计</a></li>
	</ul>
	<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="platform">
			<input type="hidden" name="a" value="qr">
			<input type="hidden" name="do" value="display">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">场景名称</label>
					<div class="col-sm-6 col-lg-8 col-xs-12">
						<input type="text" name="keyword" value="" class="form-control" placeholder="请输入场景名称">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">时间范围</label>
					<div class="col-sm-6 col-lg-8 col-xs-12">
						
<script type="text/javascript">
	require(["daterangepicker"], function($){
		$(function(){
			$(".daterange.daterange-date").each(function(){
				var elm = this;
				$(this).daterangepicker({
					startDate: $(elm).prev().prev().val(),
					endDate: $(elm).prev().val(),
					format: "YYYY-MM-DD"
				}, function(start, end){
					$(elm).find(".date-title").html(start.toDateStr() + " 至 " + end.toDateStr());
					$(elm).prev().prev().val(start.toDateStr());
					$(elm).prev().val(end.toDateStr());
				});
			});
		});
	});
</script>

	<input name="time[start]" type="hidden" value="2017-04-15" />
	<input name="time[end]" type="hidden" value="2017-05-21" />
	<button class="btn btn-default daterange daterange-date" type="button"><span class="date-title">2017-04-15 至 2017-05-21</span> <i class="fa fa-calendar"></i></button>
						</div>
					<div class="pull-right col-xs-12 col-sm-3 col-lg-2">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">详细数据&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-muted" style="color:red;">扫描次数：0</span></div>
		<div class="table-responsive panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th style="width:80px;">粉丝<i></i></th>
						<th style="width:80px;">场景名称<i></i></th>
						<th style="width:100px;">场景ID/场景值<i></i></th>
						<th style="width:110px;">关注扫描<i></i></th>
						<th style="width:150px;">扫描时间<i></i></th>
						<th style="width:110px;">操作</th>
					</tr>
				</thead>
				<tbody>
									</tbody>
			</table>
					</div>
	</div>
			</div>
		</div>
	</div>
	<script>
		function subscribe(){
			$.post("./index.php?c=utility&a=subscribe&", function(){
				setTimeout(subscribe, 5000);
			});
		}
		function sync() {
			$.post("./index.php?c=utility&a=sync&", function(){
				setTimeout(sync, 60000);
			});
		}
		$(function(){
			subscribe();
			sync();
		});
					function checknotice() {
				$.post("./index.php?c=utility&a=notice&", {}, function(data){
					var data = $.parseJSON(data);
					$('#notice-container').html(data.notices);
					$('#notice-total').html(data.total);
					if(data.total > 0) {
						$('#notice-total').css('background', '#ff9900');
					} else {
						$('#notice-total').css('background', '');
					}
					setTimeout(checknotice, 60000);
				});
			}
			checknotice();
			</script>
	<script type="text/javascript">
		require(['bootstrap']);
		$('.js-clip').each(function(){
			util.clip(this, $(this).attr('data-url'));
		});
	</script>
</div>