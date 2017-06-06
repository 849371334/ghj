<?php
include_once('./pub/top.php');
include_once('./pub/config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
<ul class="nav nav-tabs">
	<li><a href="?r=customer/customer&tab=1">管理多客服转接</a></li>
	<li class="active"><a href="?r=customer/customer&tab=2"><i class="fa fa-plus"></i> 添加多客服转接</a></li>
	<li><a href="?r=customer/customer&tab=3"> 客服聊天记录</a></li>
</ul>
	<div >
	<form id="reply-form" class="form-horizontal form" action="./index.php?c=platform&a=reply&do=post&m=custom&rid=0" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading">添加回复规则 <span class="text-muted">删除，修改规则、关键字以及回复后，请提交以保存操作。</span></div>
					<ul class="list-group">
						<li class="list-group-item">
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">回复规则名称</label>
								<div class="col-sm-6 col-md-8 col-xs-12">
									<input type="text" class="form-control" placeholder="请输入回复规则的名称" name="name" value="" />
									<span class="help-block">
										您可以给这条规则起一个名字, 方便下次修改和查看. <br/>
										<strong class="text-danger">选择高级设置: 将会提供一系列的高级选项供专业用户使用.</strong>
									</span>
								</div>
								<div class="col-sm-3 col-md-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" ng-model="reply.advSetting" /> 高级设置
										</label>
									</div>
								</div>
							</div>
							<div class="form-group" ng-show="reply.advSetting">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="status" value="1"  checked="checked" /> 启用
									</label>
									<label class="radio-inline">
										<input type="radio" name="status" value="0"  /> 禁用
									</label>
									<span class="help-block">您可以临时禁用这条回复.</span>
								</div>
							</div>
							<div class="form-group" ng-show="reply.advSetting">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">置顶回复</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="istop" ng-model="reply.entry.istop" ng-value="1" value="1"  /> 置顶
									</label>
									<label class="radio-inline">
										<input type="radio" name="istop" ng-model="reply.entry.istop" ng-value="0" value="0"  checked="checked" /> 普通
									</label>
									<span class="help-block">“置顶”时无论在什么情况下均能触发且使终保持最优先级</span>
								</div>
							</div>
							<div class="form-group" ng-show="reply.advSetting && !reply.entry.istop">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">优先级</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" placeholder="输入这条回复规则优先级" name="displayorder_rule" value="">
									<span class="help-block">规则优先级，越大则越靠前，最大不得超过254</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">触发关键字</label>
								<div class="col-sm-6 col-md-8 col-xs-12">
									<input type="hidden" name="rid" value="0" />
									<input type="text" class="form-control keyword" placeholder="请输入触发关键字" ng-model="trigger.items.default" id="keywordinput" onblur="checkKeyWord($(this));" />
									<span class="help-block"></span>
									<input type="hidden" name="keywords"/>
									<span class="help-block">
										当用户的对话内容符合以上的关键字定义时，会触发这个回复定义。多个关键字请使用逗号隔开。<a href="javascript:;" id="keyword"><i class="fa fa-github-alt"></i> 表情</a> <br />
										<strong class="text-danger">选择高级触发: 将会提供一系列的高级触发方式供专业用户使用(注意: 如果你不了解, 请不要使用). </strong>
									</span>
								</div>
								<div class="col-sm-3 col-md-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" ng-model="reply.advTrigger" /> 高级触发
										</label>
									</div>
								</div>
							</div>
							<div class="form-group" ng-show="reply.advTrigger">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">高级触发列表</label>
								<div class="col-sm-9">
									<div class="panel panel-default tab-content">
										<div class="panel-heading">
											<ul class="nav nav-pills">
												<li class="active"><a href="#contains" data-toggle="tab">包含关键字</a></li>
												<li><a href="#regexp" data-toggle="tab">正则表达式模式匹配</a></li>
												<li><a href="#trustee" data-toggle="tab">直接接管</a></li>
											</ul>
										</div>
										<ul class="tab-pane list-group active" id="contains">
											<li class="list-group-item row" ng-repeat="entry in trigger.items.contains">
												<div class="col-xs-12 col-sm-8">
													<input type="text" class="form-control keyword" ng-hide="entry.saved" placeholder="{{entry.label}}" ng-model="entry.content" onblur="checkKeyWord($(this));" />
													<span class="help-block"></span>
													<p class="form-control-static" ng-show="entry.saved" ng-bind="entry.content"></p>
												</div>
												<div class="col-sm-4">
													<div class="btn-group">
														<a href="javascript:;" class="btn btn-default" ng-click="trigger.saveItem(entry);">{{entry.saved ? '编辑' : '保存'}}</a>
														<a href="javascript:;" class="btn btn-default" ng-click="trigger.removeItem(entry);">删除</a>
													</div>
												</div>
											</li>
										</ul>
										<ul class="tab-pane list-group" id="regexp">
											<li class="list-group-item row" ng-repeat="entry in trigger.items.regexp">
												<div class="col-xs-12 col-sm-8">
													<input type="text" class="form-control keyword" ng-hide="entry.saved" placeholder="{{entry.label}}" ng-model="entry.content" onblur="checkKeyWord($(this));" />
													<span class="help-block"></span>
													<p class="form-control-static" ng-show="entry.saved" ng-bind="entry.content"></p>
												</div>
												<div class="col-sm-4">
													<div class="btn-group">
														<a href="javascript:;" class="btn btn-default" ng-click="trigger.saveItem(entry);">{{entry.saved ? '编辑' : '保存'}}</a>
														<a href="javascript:;" class="btn btn-default" ng-click="trigger.removeItem(entry);">删除</a>
													</div>
												</div>
											</li>
										</ul>
										<ul class="tab-pane list-group" id="trustee">
											<li class="list-group-item row" ng-repeat="entry in trigger.items.trustee">
												<div class="col-xs-12 col-sm-8">
													<p class="form-control-static">符合优先级条件时, 这条回复将直接生效</p>
												</div>
												<div class="col-sm-4">
													<a href="javascript:;" class="btn btn-default" ng-click="trigger.removeItem(entry);">取消接管</a>
												</div>
											</li>
										</ul>
										<div class="panel-footer">
											<a href="javascript:;" class="btn btn-default" ng-click="trigger.addItem();" ng-bind="'添加' + trigger.labels[trigger.active]">添加</a>
											<span class="help-block" ng-bind-html="trigger.descriptions[trigger.active]"></span>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div> 
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-12">
				<div class="alert alert-info" style="margin-top:0;">
	如果你要使用腾讯提供的多客服系统, 请添加本条规则. <br>
	这个功能是配合微信公众平台的多客服功能使用的, <a href="http://wkd.qq.com/php/static/mp/html/guide.html" target="_blank">了解详情</a> <br>
	注意: 请添加关键字为 [高级] - [直接接管] <br>
	注意: <span style="color:red;">不要</span>设置为置顶规则. <br> <br>
	<p>
		直接接管说明: 直接接管功能是配合优先级使用的. <br>
		比如一条规则, 优先级是 10, 触发设置为直接接管. 那么当消息到达时, 优先处理优先级大于10的规则. 如果没有优先级大于10的规则, 或者优先级大于10的规则都没有任何有效回复. 那么直接使用这条规则.
	</p>
	<p>
		腾讯多客服功能说明: 如果粉丝发送了一条消息, 如果没有任何有效的规则能够处理. 那么将会把这条消息转发至腾讯多客服系统. 使用多客服客户端的客服人员如果接入了这条消息(接待本次客服对话)后, 以后的消息都将发送至多客服系统(<span style="color:red;">不会继续把消息发送至本系统</span>) <br>
		直到客服人员关闭本地对话, 公众平台官方才会继续把消息发送至本系统进行处理. <br>
		<span style="color:red;">因此, 客服人员接待完成后, 一定要点击关闭按钮来结束客服接待. 否则本平台不会生效.</span><br>
		<span style="color:red;">如果希望全天接入多客服,可将第一个时间段设置为：0~24时</span><br>
		<span style="color:green;">例如:3~5时。这个范围是从：3:00开始开始,4:59结束</span>
	</p>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		回复内容
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">第一个时间段</label>
			<div class="col-sm-4 col-xs-6">
				<select class="form-control" name="start1" id="start1">
					<option value="-1">请选择每天开始接入时间</option>
					<option value="0" >0时</option><option value="1" >1时</option><option value="2" >2时</option><option value="3" >3时</option><option value="4" >4时</option><option value="5" >5时</option><option value="6" >6时</option><option value="7" >7时</option><option value="8" >8时</option><option value="9" >9时</option><option value="10" >10时</option><option value="11" >11时</option><option value="12" >12时</option><option value="13" >13时</option><option value="14" >14时</option><option value="15" >15时</option><option value="16" >16时</option><option value="17" >17时</option><option value="18" >18时</option><option value="19" >19时</option><option value="20" >20时</option><option value="21" >21时</option><option value="22" >22时</option><option value="23" >23时</option><option value="24" >24时</option>				</select>
			</div>
			<div class="col-sm-4 col-xs-6">
				<select class="form-control" name="end1" id="end1">
					<option value="-1">请选择每天开始接入时间</option>
					<option value="0" >0时</option><option value="1" >1时</option><option value="2" >2时</option><option value="3" >3时</option><option value="4" >4时</option><option value="5" >5时</option><option value="6" >6时</option><option value="7" >7时</option><option value="8" >8时</option><option value="9" >9时</option><option value="10" >10时</option><option value="11" >11时</option><option value="12" >12时</option><option value="13" >13时</option><option value="14" >14时</option><option value="15" >15时</option><option value="16" >16时</option><option value="17" >17时</option><option value="18" >18时</option><option value="19" >19时</option><option value="20" >20时</option><option value="21" >21时</option><option value="22" >22时</option><option value="23" >23时</option><option value="24" >24时</option>				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">第二个时间段</label>
			<div class="col-sm-4 col-xs-6">
				<select class="form-control" name="start2" id="start2">
					<option value="-1">请选择每天开始接入时间</option>
					<option value="0" >0时</option><option value="1" >1时</option><option value="2" >2时</option><option value="3" >3时</option><option value="4" >4时</option><option value="5" >5时</option><option value="6" >6时</option><option value="7" >7时</option><option value="8" >8时</option><option value="9" >9时</option><option value="10" >10时</option><option value="11" >11时</option><option value="12" >12时</option><option value="13" >13时</option><option value="14" >14时</option><option value="15" >15时</option><option value="16" >16时</option><option value="17" >17时</option><option value="18" >18时</option><option value="19" >19时</option><option value="20" >20时</option><option value="21" >21时</option><option value="22" >22时</option><option value="23" >23时</option><option value="24" >24时</option>				</select>
			</div>
			<div class="col-sm-4 col-xs-6">
				<select class="form-control" name="end2" id="end2">
					<option value="-1">请选择每天开始接入时间</option>
					<option value="0" >0时</option><option value="1" >1时</option><option value="2" >2时</option><option value="3" >3时</option><option value="4" >4时</option><option value="5" >5时</option><option value="6" >6时</option><option value="7" >7时</option><option value="8" >8时</option><option value="9" >9时</option><option value="10" >10时</option><option value="11" >11时</option><option value="12" >12时</option><option value="13" >13时</option><option value="14" >14时</option><option value="15" >15时</option><option value="16" >16时</option><option value="17" >17时</option><option value="18" >18时</option><option value="19" >19时</option><option value="20" >20时</option><option value="21" >21时</option><option value="22" >22时</option><option value="23" >23时</option><option value="24" >24时</option>				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-8 col-xs-12">
				<div class="help-block">请选择每天接入时间段。您最多可以设置两个时间段,只有在这两个时间段的用户消息会转到多客服里。</div>
				<strong class="text-danger">如果您只有一个时间段,请将第二个时间段留空。</strong>
			</div>
		</div>
	</div>
	<script>
		window.validateReplyForm = function(form, $, _, util) {
			var start1 = parseInt($('#start1').val());
			var end1 = parseInt($('#end1').val());
			var start2 = parseInt($('#start2').val());
			var end2 = parseInt($('#end2').val());
			if(start1 == '-1' && end1 == '-1' && start2 == '-1' && end2 == '-1') {
				util.message('请选择有效的时间段');
				return false;
			}
			if(start1 > end1) {
				util.message('第一个时间段的开始接入时间大于结束时间');
				return false;
			}
			if(start2 != '-1' && (end1 > start2)) {
				util.message('第一个时间段的结束日期大于第二个时间段的开始时间');
				return false;
			}
			if(start2 != '-1' &&  (start2 > end2)) {
				util.message('第二个时间段的开始接入时间大于结束时间');
				return false;
			}
		};
	</script>			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1" />
				<input type="hidden" name="token" value="196752ed" />
			</div>
		</div>
	</form>
</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function()
	{
		$('')
		$.ajax(
		{
			type 	: 'POST',
			dataType:'jsonp',
			url : 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=Szt6Zx-Xt8J_piiRDj9djSl5sIDV4obG5rRNUVI6ByUpSfrwXWzdtWaBn5ULxunZ2D_SLusjBxvMcsAMWPK3vFFparhSRnG_SLFZneTDER4sB1SOhIK0OenHLo9zNkdQTDVgADAGQI',
			data 	:
			{
				 "expire_seconds": 1800,
				 "action_name": "QR_SCENE",
				 "action_info": {
				 	"scene": {
				 		"scene_id": 100000
				 	}
				}
			},
			success:function(data){
				console.log("返回的数据: " + data );
			},
			error  :function(data){
				console.log("返回的数据: " + data)
			}
		})
	})
</script>