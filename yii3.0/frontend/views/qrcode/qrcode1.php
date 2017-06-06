<?php
include_once('./pub/top.php');
include_once('./pub/config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
<ul class="nav nav-tabs">
		<li><a href="?r=qrcode/qrcode&tab=1">管理二维码</a></li>
		<li class="active"><a href="?r=qrcode/qrcode&tab=2">生成二维码</a></li>
		<li><a href="?r=qrcode/qrcode&tab=3">扫描统计</a></li>
	</ul>
	<div class="clearfix">
		<form class="form-horizontal form"  method="post" id="form1" action="index.php?r=qrcode/mkcode">
		<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
			<div class="panel panel-default">
				<div class="panel-heading">
					生成二维码
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">场景名称</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" id="scene-name" class="form-control" placeholder="" name="scene-name" value="" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">关联关键字</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" id="keyword" class="form-control" name="keyword" value="" /><span class="help-block">二维码对应关键字, 用户扫描后系统将通过场景ID返回关键字到平台处理.</span>
						</div>
					</div>
										<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">二维码类型</label>
						<div class="col-sm-9 col-xs-12">
							<label for="radio_1" class="radio-inline">
							<input type="radio" name="qrc-model" id="radio_1" value="1" checked="checked" /> 临时</label>
							<label for="radio_0" class="radio-inline">
							<input type="radio" name="qrc-model" id="radio_0" value="2"  disabled/> 
							永久</label>
								<span class="help-block">目前有2种类型的二维码, 分别是临时二维码和永久二维码, 前者有过期时间, 最大为7天（2592000秒）, 但能够生成较多数量, 后者无过期时间, 数量较少,目前本站不支持(目前参数只支持1--100000).</span>
						</div>
					</div>
						<div class="form-group" id="model1">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">过期时间</label>
							<div class="col-sm-9 col-xs-12">
								<input type="text" id="expire-seconds" class="form-control" placeholder="" name="expire-seconds" value="2592000" />
								<span class="help-block">临时二维码过期时间, 最大为7天（2592000秒）.</span>
							</div>
						</div>
						<div class="form-group" id="model2" style="display:none;">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">场景值</label>
							<div class="col-sm-9 col-xs-12">
								<input type="text" class="form-control" placeholder="场景值" id="scene_str" name="scene_str" value="" />
								<span class="help-block">场景值不能为空,并且只能为字符串</span>
							</div>
						</div>
									</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
						<input type="submit" class="btn btn-primary col-lg-1" name="submit"> 
				</div>
			</div>
		</form>
</div>
<!-- <script type="text/javascript">
	$(function()
	{
		$('#submit').click(function(){
			var token     = 'fml1Nu31b0gzp_rHAwQCE9E0U28uqt8dQ_A6xBMhdDkZioBHxGKy1l-lDsKRQRPuE4MAbJTzh7IRjsHeXAygpSgIeX0d6PRha9cEaBpiPN8kjuZkgNIG1p-ipSXK8j1VKJWaACAYXK'
			var scenename = $('#scene-name').val();
			var keyword   = $('#keyword').val();
			var radio_1   = $('#radio_1').val();
			var radio_0   = $('#radio_0').val();
  			var expireseconds = $('#expire-seconds').val();
  			var scene_str = $('#scene_str').val();
  			
			$.ajax(
			{
				type 	: 'POST',
				dataType:'jsonp',
				url     : 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='+token,
				data 	:{'expire-seconds':expireseconds,"action_name": "QR_LIMIT_SCENE","action_info": {"scene": {"scene_id": 1000}}},
				success:function(data){
					console.log("返回的数据: " + data );
				},
				error  :function(data){
					console.log("返回的数据: " + data)
				}
			})
		})
		
	})
</script> -->