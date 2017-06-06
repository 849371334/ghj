<?php
include_once('./pub/top.php');
include_once('./pub/sys_config.php');
?>

<!-- <link href="./public/css/common.css" rel="stylesheet">
<script>var require = { urlArgs: 'v=2017051117' };</script>
<script src="./public/js/jquery-1.11.1.min.js"></script>
<script src="./public/js/util.js"></script>
<script src="./public/js/require.js"></script>
<script src="./public/js/config.js"></script> -->
<style>
 div .form-group{
     display:block;
 }	
 div .ng-hide {
     display:none;
 }	
</style>


<script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="bootstrap" src="./public/js/bootstrap.min.js"></script></head>
<script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery" src="./public/js/jquery-1.11.1.min(1).js"></script>
<div class="col-xs-12 col-sm-9 col-lg-10">
										<ul class="nav nav-tabs">
	<li><a href="./index.php?r=platform/index">管理自定义接口回复</a></li>
	<li class="active"><a href="./index.php?r=platform/replyadd&wx_id=<?= $rid ?> "><i class="fa fa-plus"></i> 添加自定义接口回复</a></li>
		</ul>
<style type="text/css">
	.help-block em{display:inline-block;width:10em;font-weight:bold;font-style:normal;}
</style>
<script>
require(['angular.sanitize', 'bootstrap', 'underscore', 'util'], function(angular, $, _, util){
	angular.module('app', ['ngSanitize']).controller('replyForm', function($scope, $http){
		$scope.reply = {
			advSetting: false,
			advTrigger: false,
			entry: null 
		};
		$scope.trigger = {};
		$scope.trigger.descriptions = {};
		$scope.trigger.descriptions.contains = '用户进行交谈时，对话中包含上述关键字就执行这条规则。';
		$scope.trigger.descriptions.regexp = '用户进行交谈时，对话内容符合述关键字中定义的模式才会执行这条规则。<br/><strong>注意：如果你不明白正则表达式的工作方式，请不要使用正则匹配</strong> <br/><strong>注意：正则匹配使用MySQL的匹配引擎，请使用MySQL的正则语法</strong> <br /><strong>示例: </strong><br/><em>^微信</em>匹配以“微信”开头的语句<br /><em>微信$</em>匹配以“微信”结尾的语句<br /><em>^微信$</em>匹配等同“微信”的语句<br /><em>微信</em>匹配包含“微信”的语句<br /><em>[0-9\.\-]</em>匹配所有的数字，句号和减号<br /><em>^[a-zA-Z_]$</em>所有的字母和下划线<br /><em>^[[:alpha:]]{3}$</em>所有的3个字母的单词<br /><em>^a{4}$</em>aaaa<br /><em>^a{2,4}$</em>aa，aaa或aaaa<br /><em>^a{2,}$</em>匹配多于两个a的字符串';
		$scope.trigger.descriptions.trustee = '如果没有比这条回复优先级更高的回复被触发，那么直接使用这条回复。<br/><strong>注意：如果你不明白这个机制的工作方式，请不要使用直接接管</strong>';
		$scope.trigger.labels = {};
		$scope.trigger.labels.contains = '包含关键字';
		$scope.trigger.labels.regexp = '正则表达式模式';
		$scope.trigger.labels.trustee = '直接接管操作';
		$scope.trigger.active = 'contains';
		$scope.trigger.items = {};
		$scope.trigger.items.default = '';
		$scope.trigger.items.contains = [];
		$scope.trigger.items.regexp = [];
		$scope.trigger.items.trustee = [];
		if($scope.reply.entry) {
			$scope.reply.entry.istop = $scope.reply.entry.displayorder >= 255 ? 1 : 0;
			//$scope.reply.advSetting = $scope.reply.entry.displayorder!=0 || !$scope.reply.entry.status;
			if($scope.reply.entry.keywords) {
				angular.forEach($scope.reply.entry.keywords, function(v, k){
					if(v.type == '1') {
						this.default += (v.content + ',');
					}
					if(v.type == '2') {
						this.contains.push({content: v.content, label: '请输入' + $scope.trigger.labels.contains, saved: true});
					}
					if(v.type == '3') {
						this.regexp.push({content: v.content, label: '请输入' + $scope.trigger.labels.regexp, saved: true});
					}
					if(v.type == '4') {
						this.trustee.push({});
					}
				}, $scope.trigger.items);
				if($scope.trigger.items.default.length > 1) {
					$scope.trigger.items.default = $scope.trigger.items.default.slice(0, $scope.trigger.items.default.length - 1);
				}
				if($scope.trigger.items.contains.length > 0 || $scope.trigger.items.regexp.length > 0 || $scope.trigger.items.trustee.length > 0) {
					$scope.reply.advTrigger = true;
				}
				if($scope.trigger.items.contains.length > 0) {
					$('a[data-toggle="tab"]').eq(0).tab('show');
					$scope.trigger.active = 'contains';
				} else if($scope.trigger.items.regexp.length > 0) {
					$('a[data-toggle="tab"]').eq(1).tab('show');
					$scope.trigger.active = 'regexp';
				} else if($scope.trigger.items.trustee.length > 0) {
					$('a[data-toggle="tab"]').eq(2).tab('show');
					$scope.trigger.active = 'trustee';
				}
			}
		}
		$scope.trigger.addItem = function(){
			var type = $scope.trigger.active;
			if(type != 'trustee') {
				$scope.trigger.items[type].push({content: '', label: '请输入' + $scope.trigger.labels[type], saved: false});
			} else {
				if($scope.trigger.items.trustee.length == 0) {
					$scope.trigger.items.trustee.push({type:4, content:''});
				}
			}
		};
		
		$scope.trigger.saveItem = function(item){
			item.saved = !item.saved;
		};
		$scope.trigger.removeItem = function(item) {
			var type = $scope.trigger.active;
			$scope.trigger.items[type] = _.without($scope.trigger.items[type], item);
			$scope.$digest();
		};
		$scope.trigger.test = function(item) {
		}
		if($.isFunction(window.initReplyController)) {
			window.initReplyController($scope, $http);
		}
		$('#reply-form').submit(function(){
			if($.trim($(':text[name="name"]').val()) == '') {
				util.message('必须输入回复规则名称');
				return false;
			}
			var val = [];
			$scope.$digest();
			if($scope.trigger.items.default != '') {
				var kws = $scope.trigger.items.default.replace('，', ',').split(',');
				kws = _.union(kws);
				angular.forEach(kws, function(v){
					if(v != '') {
						val.push({type: 1, content: v});
					}
				}, val);
			}
			angular.forEach($scope.trigger.items, function(v, name){
				var flag = true;
				if(name != 'default' && v.length > 0) {
					if(name == 'contains' || name == 'regexp'){
						angular.forEach(v, function(value){
							if(value.content.trim() != '') {
								this.push({
									content: value.content,
									type: name == 'contains' ? 2 : 3
								});
							}
						}, val);
					}
					if(name == 'trustee'){
						angular.forEach(v, function(value){
							this.push({type:4, content:''});
						}, val);
					}
				}
			}, val);
			if(val.length == 0 && $scope.trigger.active != 'trustee') {
				util.message('请输入有效的触发关键字.');
				return false;
			}
			$scope.$digest();
			val = angular.toJson(val);
			$(':hidden[name=keywords]').val(val);
			if($.isFunction(window.validateReplyForm)) {
				return window.validateReplyForm(this, $, _, util, $scope, $http);
			}
			return true;
		});
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			$scope.trigger.active = e.target.hash.replace(/#/, '');
			$scope.$digest();
		})
		util.emotion($("#keyword"), $("#keywordinput")[0], function(txt, elm, target){
			$scope.trigger.items.default = $(target).val();
			$scope.$digest();
		});
	}).filter('nl2br', function($sce){
		return function(text) {
			return text ? $sce.trustAsHtml(text.replace(/\n/g, '<br/>')) : '';
		};
	}).directive('ngInvoker', function($parse){
		return function (scope, element, attr) {
			scope.$eval(attr.ngInvoker);
		};
	}).directive('ngMyEditor', function(){
		var editor = {
			'scope' : {
				'value' : '=ngMyValue'
			},
			'template' : '<textarea id="editor" style="height:600px;width:100%;"></textarea>',
			'link' : function ($scope, element, attr) {
				if(!element.data('editor')) {
					editor = UE.getEditor('editor', ueditoroption);
					element.data('editor', editor);
					editor.addListener('contentChange', function() {
						$scope.value = editor.getContent();
						$scope.$root.$$phase || $scope.$apply('value');
					});
					editor.addListener('ready', function(){
						if (editor && editor.getContent() != $scope.value) {
							editor.setContent($scope.value);
						}
						$scope.$watch('value', function (value) {
							if (editor && editor.getContent() != value) {
								editor.setContent(value ? value : '');
							}
						});
					});
				}
			}
		};
		return editor;
	});
	angular.bootstrap($('#js-reply-form')[0], ['app']);


	// 检测规则是否已经存在
	window.checkKeyWord = function(key) {
		var keyword = key.val().trim();
		if (keyword == '') {
			return false;
		}
		var type = key.attr('data-type');
		var wordIndex = key.index('.keyword');
		var isLeagl = true;
		$('.keyword').each(function(index) {
			var currentWord = $(this).val().trim();
			if (keyword == currentWord && wordIndex != index) {
				isLeagl = false;
				return false;
			}
		});
		if (isLeagl === false) {
			key.next().text('');
			util.message('该关键字已重复存在于当前规则中.');
			return false;
		}

		$.post(location.href, {keyword:keyword}, function(resp){
			if(resp != 'success') {
				var rid = $('input[name="rid"]').val();
				var rules = JSON.parse(resp);
				var url = "./index.php?c=platform&a=reply&do=post&m=userapi";
				var ruleurl = '';
				for (rule in rules) {
					if (rid != rules[rule].id) {
						ruleurl += "<a href='" + url + "&rid=" + rules[rule].id + "' target='_blank'><strong class='text-danger'>" + rules[rule].name + "</strong></a>&nbsp;";
					}
				}
				if (ruleurl != '') {
					key.next().html('该关键字已存在于 ' + ruleurl + ' 规则中.');
				}
			} else {
				key.next().text('');
			}
		});
	}

	$('.keyword').each(function() {
		$(this).attr('data-type', 'keyword');
	});
});
	
</script>

<div class="clearfix ng-scope" id="js-reply-form" ng-controller="replyForm">
	<form id="reply-form" class="form-horizontal form ng-pristine ng-valid" action="./index.php?r=platform/replyadd&rid=<?php  echo $_SESSION['account']['id']; ?> >" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading">添加回复规则 <span class="text-muted">删除，修改规则、关键字以及回复后，请提交以保存操作。</span></div>
					<ul class="list-group">
						<li class="list-group-item">
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">回复规则名称</label>
								<div class="col-sm-6 col-md-8 col-xs-12">
									<input type="text" class="form-control" placeholder="请输入回复规则的名称" name="reply_rule" value="">
									<span class="help-block">
										您可以给这条规则起一个名字, 方便下次修改和查看. <br>
										<strong class="text-danger">选择高级设置: 将会提供一系列的高级选项供专业用户使用.</strong>
									</span>
								</div>
								<div class="col-sm-3 col-md-2">
									<div class="checkbox">
										<label>
											<input type="checkbox"  ng-model="reply.advSetting" id='name1'  class="ng-pristine ng-untouched ng-valid ih"> 高级设置
										</label>
									</div>
								</div>
							</div>
							<div class="form-group ng-hide" ng-show="reply.advSetting">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="status" value="1" checked="checked"> 启用
									</label>
									<label class="radio-inline">
										<input type="radio" name="status" value="0"> 禁用
									</label>
									<span class="help-block">您可以临时禁用这条回复.</span>
								</div>
							</div>
							<div class="form-group ng-hide" ng-show="reply.advSetting">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">置顶回复</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="istop" ng-model="reply.entry.istop" ng-value="1" value="1" class="ng-pristine ng-untouched ng-valid"> 置顶
									</label>
									<label class="radio-inline">
										<input type="radio" name="istop" ng-model="reply.entry.istop" ng-value="0" value="0" checked="checked" class="ng-pristine ng-untouched ng-valid"> 普通
									</label>
									<span class="help-block">“置顶”时无论在什么情况下均能触发且使终保持最优先级</span>
								</div>
							</div>
							<div class="form-group ng-hide" ng-show="reply.advSetting &amp;&amp; !reply.entry.istop">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">优先级</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" placeholder="输入这条回复规则优先级" name="priority" value="">
									<span class="help-block">规则优先级，越大则越靠前，最大不得超过254</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">触发关键字</label>
								<div class="col-sm-6 col-md-8 col-xs-12">
									<input type="hidden" name="wx_id" value="<?php  echo $_GET['wx_id']; ?>">
									<!-- <input type="text" class="form-control keyword ng-pristine ng-untouched ng-valid" placeholder="请输入触发关键字" ng-model="trigger.items.default" id="keywordinput" onblur="checkKeyWord($(this));" data-type="keyword"> -->
									<input type="text" class="form-control keyword ng-pristine ng-untouched ng-valid" placeholder="请输入触发关键字" ng-model="trigger.items.default" id="keywordinput" name="keywords" data-type="keyword">
									<span class="help-block"></span>
									<!-- <input type="hidden" name="keywords"> -->
									<span class="help-block">
										当用户的对话内容符合以上的关键字定义时，会触发这个回复定义。多个关键字请使用逗号隔开。<a href="javascript:;" id="keyword" data-original-title="" title=""><i class="fa fa-github-alt"></i> 表情</a> <br>
										<strong class="text-danger">选择高级触发: 将会提供一系列的高级触发方式供专业用户使用(注意: 如果你不了解, 请不要使用). </strong>
									</span>
								</div>
								<div class="col-sm-3 col-md-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" id='keyword1'  ng-model="reply.advTrigger" class="ng-pristine ng-untouched ng-valid"> 高级触发
										</label>
									</div>
								</div>
							</div>
							<div class="form-group ng-hide" ng-show="reply.advTrigger">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">高级触发列表</label>
								<div class="col-sm-9">
									<div class="panel panel-default tab-content">
										<div class="panel-heading">
											<ul class="nav nav-pills">
												<li class="active"><a href="http://wcmall.bj165.com/web/index.php?c=platform&amp;a=reply&amp;do=post&amp;m=userapi#contains" data-toggle="tab">包含关键字</a></li>
												<li><a href="http://wcmall.bj165.com/web/index.php?c=platform&amp;a=reply&amp;do=post&amp;m=userapi#regexp" data-toggle="tab">正则表达式模式匹配</a></li>
												<li><a href="http://wcmall.bj165.com/web/index.php?c=platform&amp;a=reply&amp;do=post&amp;m=userapi#trustee" data-toggle="tab">直接接管</a></li>
											</ul>
										</div>
										<ul class="tab-pane list-group active" id="contains">
											<!-- ngRepeat: entry in trigger.items.contains -->
										</ul>
										<ul class="tab-pane list-group" id="regexp">
											<!-- ngRepeat: entry in trigger.items.regexp -->
										</ul>
										<ul class="tab-pane list-group" id="trustee">
											<!-- ngRepeat: entry in trigger.items.trustee -->
										</ul>
										<div class="panel-footer">
											<a href="javascript:;" class="btn btn-default ng-binding" ng-click="trigger.addItem();" ng-bind="&#39;添加&#39; + trigger.labels[trigger.active]">添加包含关键字</a>
											<span class="help-block ng-binding" ng-bind-html="trigger.descriptions[trigger.active]">用户进行交谈时，对话中包含上述关键字就执行这条规则。</span>
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
				<div class="panel panel-default">
	<div class="panel-heading">
		添加处理接口
	</div>
	<ul class="list-group reply-container">
		<li class="list-group-item">
			<div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">接口类型</label>
					<div class="col-sm-9 col-xs-12">
						<label for="radio_1" class="radio-inline"><input type="radio" name="apitype" id="radio_1" ng-model="item.type" value="1" class="ng-pristine ng-untouched ng-valid" > 远程地址</label>
						<label for="radio_0" class="radio-inline"><input type="radio" name="apitype" id="radio_0" ng-model="item.type" value="2" class="ng-pristine ng-untouched ng-valid" checked='checked'> 本地文件</label>
					</div>
				</div>
				<div class="form-group ng-hide" id='type1' ng-show="item.type == 1 ">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">远程地址</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" id="" class="form-control ng-pristine ng-untouched ng-valid" placeholder="" name="apiurl" ng-model="item.apiurl">
							<div class="help-block" style="margin-top:10px;">
								<ol style="margin-top:10px;">
									<li>使用远程地址接口，你可以兼容其他的微信公众平台管理工具。</li>
									<li>你应该填写其他平台提供给你保存至公众平台的URL和Token</li>
									<li>添加此模块的规则后，只针对于单个规则定义有效，如果需要全部路由给接口处理，则修改该模块的优先级顺序。</li>
									<li>具体请<a href="http://www.bj165.com/docs/#api" target="_blank">查看“自定义接口回复”文档</a></li>								</ol>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="color:red">Token</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" name="wetoken" class="form-control" ng-model="item.token">
							<div class="help-block">与目标平台接入设置值一致，必须为英文或者数字，长度为3到32个字符.</div>
						</div>
					</div>
				</div>
				<div class="form-group" id='type0'  ng-show="item.type == 0 ">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">文件列表</label>
					<div class="col-sm-9 col-xs-12">
						<select name="apilocal" class="form-control" ng-model="item.apilocal">
							<option value="0">请选择本地文件</option>
							<?php
							foreach ($dir as $key => $val) { ?>
							<option value="<?php echo $val; ?>"><?php echo $val; ?></option>
							<?php } ?>
						</select>
						<div class="help-block" style="margin-top:10px;">
							<ol style="margin-top:10px;">
								<li>使用本地文件扩展你可以快速的扩展系统功能。</li>
								<li>添加此模块的规则后，只针对于单个规则定义有效，如果需要全部路由给接口处理，则修改该模块的优先级顺序。</li>
								<li>本地文件存放在模块文件夹内（/framework/builtin/userapi/api）下。</li>
								<li>具体请<a href="http://www.bj165.com/docs/#api" target="_blank">查看“自定义接口回复”文档</a></li>							</ol>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">默认回复文字</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" id="" class="form-control" placeholder="" name="default" ng-model="item.default_text">
						<div class="help-block">当接口无回复时，则返回用户此处设置的文字信息，优先级高于“默认回复URL”</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">缓存时间</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" id="" class="form-control" placeholder="" name="cachetime" ng-model="item.cachetime">
						<div class="help-block">接口返回数据将缓存在系统中的时限，默认为0不缓存。</div>		
					</div>
				</div>
			</div>
		</li>
	</ul>
</div>
<script>
	window.initReplyController = function($scope) {
		$scope.item = [];
		$scope.item = {"cachetime":0,"type":1};
	};

	window.validateReplyForm = function(form, $, _, util, $scope) {
		$scope.$digest();
		var error = false;
		if($scope.item.type == '1') {
			if(!$.trim($scope.item.apiurl)) {
				util.message('接口类型选择远程地址后,必须填写远程地址.');
				return false;
			}
			if(!$.trim($scope.item.token)) {
				util.message('接口类型选择远程地址后,必须填写Token.');
				return false;
			}
		}
		if($scope.item.type == '0') {
			if(!$scope.item.apilocal) {
				util.message('接口类型选择本地文件后,必须选择本地文件.');
				return false;
			}
		}
 		return true;
	};
	$(function(){
		$("input[name='apitype']").each(function(){
			// $(this).checked();
			if ($(this).is(':checked')) {
                val = $(this).val();
                // alert(val);
		        if(val == 1){
		            $("#type1").removeClass("ng-hide");
		         	$("#type0").addClass("ng-hide");
		        }else{
		         	$("#type1").addClass("ng-hide");
		         	$("#type0").removeClass("ng-hide");
		        }
			}
	         // alert(val);
		})
		$("input[name='apitype']").change(function(){
			// $(this).checked();
			if ($(this).is(':checked')) {
                val = $(this).val();
		        if(val == 1){
		            $("#type1").removeClass("ng-hide");
		         	$("#type0").addClass("ng-hide");
		        }else{
		         	$("#type1").addClass("ng-hide");
		         	$("#type0").removeClass("ng-hide");
		        }
			}
	         // alert(val);
		})

	})
	

</script>			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
				<!-- <input type="hidden" name="token" value="196752ed"> -->
				<input type="hidden" name='_csrf' value='<?= Yii::$app->request->csrfToken ?>'>
			</div>
		</div>
	</form>
</div>
			</div>
		</div>
	</div>
	<script>
	$("#name1").each(function(){
		// alert();
		 if ($(this).is(':checked')) {
              $(this).parent().parent().parent().parent().next().removeClass('ng-hide');
              $(this).parent().parent().parent().parent().next().next().removeClass('ng-hide');
              $(this).parent().parent().parent().parent().next().next().next().removeClass('ng-hide');
		 }else{
		 	  $(this).parent().parent().parent().parent().next().addClass('ng-hide');
		 	  $(this).parent().parent().parent().parent().next().next().addClass('ng-hide');
		 	  $(this).parent().parent().parent().parent().next().next().next().addClass('ng-hide');
		 }
	})
	$("#name1").change(function(){
		// alert();
		 if ($(this).is(':checked')) {
              $(this).parent().parent().parent().parent().next().removeClass('ng-hide');
              $(this).parent().parent().parent().parent().next().next().removeClass('ng-hide');
              $(this).parent().parent().parent().parent().next().next().next().removeClass('ng-hide');
		 }else{
		 	  $(this).parent().parent().parent().parent().next().addClass('ng-hide');
		 	  $(this).parent().parent().parent().parent().next().next().addClass('ng-hide');
		 	  $(this).parent().parent().parent().parent().next().next().next().addClass('ng-hide');
		 }
	})

	$("#keyword1").each(function(){
		// alert();
		 if ($(this).is(':checked')) {
              $(this).parent().parent().parent().parent().next().removeClass('ng-hide');
		 }else{
		 	  $(this).parent().parent().parent().parent().next().addClass('ng-hide');
		 }
	})
	$("#keyword1").change(function(){
		// alert();
		 if ($(this).is(':checked')) {
              $(this).parent().parent().parent().parent().next().removeClass('ng-hide');
		 }else{
		 	  $(this).parent().parent().parent().parent().next().addClass('ng-hide');
		 }
	})
		// function subscribe(){
		// 	$.post("./index.php?c=utility&a=subscribe&", function(){
		// 		setTimeout(subscribe, 5000);
		// 	});
		// }
		// function sync() {
		// 	$.post("./index.php?c=utility&a=sync&", function(){
		// 		setTimeout(sync, 60000);
		// 	});
		// }
		// $(function(){
		// 	subscribe();
		// 	sync();
		// });
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