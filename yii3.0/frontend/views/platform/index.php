<?php

include_once('./pub/top.php');
include_once('./pub/sys_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
										<ul class="nav nav-tabs">
	<li class="active"><a href="./index.php?r=platform/index">管理自定义接口回复</a></li>
	<li><a href="./index.php?r=platform/replyadd&wx_id=<?= $rid ?>  "><i class="fa fa-plus"></i> 添加自定义接口回复</a></li>
	</ul>
<div class="clearfix">
	<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<form action="http://wcmall.bj165.com/web/index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="platform">
			<input type="hidden" name="a" value="reply">
			<input type="hidden" name="m" value="userapi">
			<input type="hidden" name="status" value="-1">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
					<div class="col-sm-8 col-lg-9 col-xs-12">
						<div class="btn-group">
							<a href="./index.php?r=platform/index&amp;m=userapi&amp;status=-1&amp;page=1" class="btn btn-primary">所有</a>
							<a href="./index.php?r=platform/index&amp;m=userapi&amp;status=1&amp;page=1" class="btn btn-default">启用</a>
							<a href="./index.php?r=platform/index&amp;m=userapi&amp;status=0&amp;page=1" class="btn btn-default">禁用</a>
						</div>
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
					<div class="col-sm-8 col-xs-12">
							<input class="form-control" name="keyword" id="" type="text" value="">
					</div>
					<div class="col-xs-12 col-sm-2 col-lg-1 text-right">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>
				</div> -->
                


			</form>
		</div>
	</div>
    
  <?php if ($arrayInfo != null) { 
    foreach ($arrayInfo as $key => $val) { ?>
    <form action="./index.php?r=platform/delete&id=<?php echo $val['id'];  ?> " method="post" class="form-horizontal" role="form" id="form1">
		<input name="m" value="userapi" type="hidden">
			<div>
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<label class="checkbox-inline" style="padding-top:0"><input name="rid[]" value="52" type="checkbox"><?php echo $val['reply_rule']; ?></label>
						<span class="pull-right"></span>
					</div>
					<div class="panel-body">
										<span class="label label-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="等于"><?php echo $val['keywords']; ?></span>&nbsp;
													</div>
					<div class="panel-footer clearfix">
						<div class="btn-group pull-right">
							<a class="btn btn-default btn-sm" href="./index.php?r=platform/comreply&apid=<?php echo $val['id']; ?>"><i class="fa fa-edit"></i> 编辑</a>
							<a class="btn btn-default btn-sm" href="./index.php?r=platform/delete&apid=<?php echo $val['id']; ?>" onclick="return confirm('删除规则将同时删除关键字与回复，确认吗？');return false;"><i class="fa fa-times"></i> 删除</a>
							<a class="btn btn-default btn-sm" href="javascript:void(0)"><i class="fa fa-bar-chart-o"></i> 使用率走势</a>
					    </div>
				    </div>
			    </div>
			</div>
		<!-- <div>
			<label class="checkbox-inline" style="margin-top:-30px;margin-left:17px"><input name="select_all" id="select_all" value="1" type="checkbox"></label>
			<input class="btn btn-danger" value="删除" onclick="if(!confirm('确定删除选中的规则吗？')) return false;" type="submit">
			<input name="token" value="196752ed" type="hidden">
		</div> -->
	</form>
  <?php  } } ?>

<!-- 	<form action="http://wcmall.bj165.com/web/index.php?c=platform&amp;a=reply&amp;do=delete&amp;" method="post" class="form-horizontal" role="form" id="form1">
	<input type="hidden" name="m" value="userapi">
		</form> -->
	</div>
<script>
require(['bootstrap'], function($){
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
		$('#select_all').click(function(){
			$('#form1 :checkbox').prop('checked', $(this).prop('checked'));
		});
		$('#form1 :checkbox').click(function(){
			if(!$(this).prop('checked')) {
				$('#select_all').prop('checked', false);
			} else {
				var flag = 0;
				$('#form1 :checkbox[name="rid[]"]').each(function(){
					if(!$(this).prop('checked') && !flag) {
						flag = 1;
					}
				});
				if(flag) {
					$('#select_all').prop('checked', false);
				} else {
					$('#select_all').prop('checked', true);
				}
			}
		});
	})
});
	$("div a.btn").click(function(){
		$(this).addClass("btn-primary");
		$(this).siblings().addClass("btn-default");
		$(this).removeClass("btn-default");
		$(this).siblings().removeClass("btn-primary");
	})
</script>
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