<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>系统回复 - 特殊回复 - 高级功能 - 商城系统V1.7</title>
	<meta name="keywords" content="商城系统" />
	<meta name="description" content="商城系统" />
	<link rel="shortcut icon" href="http://wcmall.bj165.com/attachment/images/global/wechat.jpg" />
	<link href="./resource/css/bootstrap.min.css" rel="stylesheet">
	<link href="./resource/css/font-awesome.min.css" rel="stylesheet">
	<link href="./resource/css/common.css" rel="stylesheet">
	<script>var require = { urlArgs: 'v=2017051512' };</script>
	<script src="./resource/js/lib/jquery-1.11.1.min.js"></script>
	<script src="./resource/js/app/util.js"></script>
	<script src="./resource/js/require.js"></script>
	<script src="./resource/js/app/config.js"></script>
	<!--[if lt IE 9]>
		<script src="./resource/js/html5shiv.min.js"></script>
		<script src="./resource/js/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript">
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
	
	window.sysinfo = {
		'uniacid': '24',
		'acid': '24',
		'uid': '8',
		'siteroot': 'http://wcmall.bj165.com/',
		'siteurl': 'http://wcmall.bj165.com/web/index.php?c=platform&a=special&do=display&',
		'attachurl': 'http://wcmall.bj165.com/attachment/',
		'attachurl_local': 'http://wcmall.bj165.com/attachment/',
		'cookie' : {'pre': '8cee_'}
	};
	</script>
</head>
<body>
	<div class="navbar navbar-inverse navbar-static-top" role="navigation" style="position:static;">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li><a href="./?refresh"><i class="fa fa-reply-all"></i>返回系统</a></li>
													<li class="active"><a href="./index.php?c=home&a=welcome&do=platform&"><i class="fa fa-cog"></i>基础设置</a></li>									<li><a href="./index.php?c=home&a=welcome&do=site&"><i class="fa fa-life-bouy"></i>微站功能</a></li>									<li><a href="./index.php?c=home&a=welcome&do=mc&"><i class="fa fa-gift"></i>粉丝营销</a></li>									<li><a href="./index.php?c=home&a=welcome&do=setting&"><i class="fa fa-umbrella"></i>功能选项</a></li>									<li><a href="./index.php?c=home&a=welcome&do=ext&"><i class="fa fa-cubes"></i>扩展功能</a></li>								
								
							</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown topbar-notice">
					<a type="button" data-toggle="dropdown">
						<i class="fa fa-bell"></i>
						<span class="badge" id="notice-total">0</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="dLabel">
						<div class="topbar-notice-panel">
							<div class="topbar-notice-arrow"></div>
							<div class="topbar-notice-head">系统公告</div>
							<div class="topbar-notice-body">
								<ul id="notice-container"></ul>
							</div>
						</div>
					</div>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i class="fa fa-group"></i>aushing <b class="caret"></b></a>
					<ul class="dropdown-menu">
												<li><a href="./index.php?c=account&a=post&uniacid=24" target="_blank"><i class="fa fa-weixin fa-fw"></i> 编辑当前账号资料</a></li>
												<li><a href="./index.php?c=account&a=display&" target="_blank"><i class="fa fa-cogs fa-fw"></i> 管理其它公众号</a></li>
						<li><a href="./index.php?c=utility&a=emulator&" target="_blank"><i class="fa fa-mobile fa-fw"></i> 模拟测试</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:185px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i class="fa fa-user"></i>test (公众号管理员) <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="./index.php?c=user&a=profile&do=profile&" target="_blank"><i class="fa fa-weixin fa-fw"></i> 我的账号</a></li>
												<li><a href="./index.php?c=user&a=logout&"><i class="fa fa-sign-out fa-fw"></i> 退出系统</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
		<div class="container-fluid">
				<div class="row">
										<div class="col-xs-12 col-sm-3 col-lg-2 big-menu">
					<div id="search-menu">
						<input class="form-control input-lg" style="border-radius:0; font-size:14px; height:43px;" type="text" placeholder="输入菜单名称可快速查找">
					</div>
															<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">基本功能</h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-0">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-0">
																					<li class="list-group-item" onclick="window.location.href = './index.php?c=platform&a=reply&m=basic';" style="cursor:pointer; overflow:hidden;" kw="文字回复">
								<a class="pull-right" href="./index.php?c=platform&a=reply&do=post&m=basic"><i class="fa fa-plus"></i></a>
								文字回复							</li>
																												<li class="list-group-item" onclick="window.location.href = './index.php?c=platform&a=reply&m=news';" style="cursor:pointer; overflow:hidden;" kw="图文回复">
								<a class="pull-right" href="./index.php?c=platform&a=reply&do=post&m=news"><i class="fa fa-plus"></i></a>
								图文回复							</li>
																												<li class="list-group-item" onclick="window.location.href = './index.php?c=platform&a=reply&m=music';" style="cursor:pointer; overflow:hidden;" kw="音乐回复">
								<a class="pull-right" href="./index.php?c=platform&a=reply&do=post&m=music"><i class="fa fa-plus"></i></a>
								音乐回复							</li>
																												<li class="list-group-item" onclick="window.location.href = './index.php?c=platform&a=reply&m=images';" style="cursor:pointer; overflow:hidden;" kw="图片回复">
								<a class="pull-right" href="./index.php?c=platform&a=reply&do=post&m=images"><i class="fa fa-plus"></i></a>
								图片回复							</li>
																												<li class="list-group-item" onclick="window.location.href = './index.php?c=platform&a=reply&m=voice';" style="cursor:pointer; overflow:hidden;" kw="语音回复">
								<a class="pull-right" href="./index.php?c=platform&a=reply&do=post&m=voice"><i class="fa fa-plus"></i></a>
								语音回复							</li>
																												<li class="list-group-item" onclick="window.location.href = './index.php?c=platform&a=reply&m=video';" style="cursor:pointer; overflow:hidden;" kw="视频回复">
								<a class="pull-right" href="./index.php?c=platform&a=reply&do=post&m=video"><i class="fa fa-plus"></i></a>
								视频回复							</li>
																												<li class="list-group-item" onclick="window.location.href = './index.php?c=platform&a=reply&m=userapi';" style="cursor:pointer; overflow:hidden;" kw="自定义接口回复">
								<a class="pull-right" href="./index.php?c=platform&a=reply&do=post&m=userapi"><i class="fa fa-plus"></i></a>
								自定义接口回复							</li>
																												<a class="list-group-item active" href="./index.php?c=platform&a=special&do=display&" kw="系统回复">系统回复</a>
																												<li class="list-group-item" onclick="window.location.href = './index.php?c=platform&a=reply&m=wxcard';" style="cursor:pointer; overflow:hidden;" kw="微信卡券回复">
								<a class="pull-right" href="./index.php?c=platform&a=reply&do=post&m=wxcard"><i class="fa fa-plus"></i></a>
								微信卡券回复							</li>
																				</ul>
					</div>
										<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">高级功能</h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-1">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-1">
																					<a class="list-group-item" href="./index.php?c=platform&a=service&do=switch&" kw="常用服务接入">常用服务接入</a>
																												<a class="list-group-item" href="./index.php?c=platform&a=special&do=message&" kw="特殊消息回复">特殊消息回复</a>
																												<a class="list-group-item" href="./index.php?c=platform&a=qr&" kw="二维码管理">二维码管理</a>
																												<a class="list-group-item" href="./index.php?c=platform&a=reply&m=custom" kw="多客服接入">多客服接入</a>
																												<a class="list-group-item" href="./index.php?c=platform&a=url2qr&" kw="长链接二维码">长链接二维码</a>
																				</ul>
					</div>
										<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">数据统计</h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-2">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-2">
																					<a class="list-group-item" href="./index.php?c=platform&a=stat&do=history&" kw="聊天记录">聊天记录</a>
																												<a class="list-group-item" href="./index.php?c=platform&a=stat&do=rule&" kw="回复规则使用情况">回复规则使用情况</a>
																												<a class="list-group-item" href="./index.php?c=platform&a=stat&do=keyword&" kw="关键字命中情况">关键字命中情况</a>
																												<a class="list-group-item" href="./index.php?c=platform&a=stat&do=setting&" kw="参数">参数</a>
																				</ul>
					</div>
										<script type="text/javascript">
						require(['bootstrap'], function(){
							$('.ext-type').click(function(){
								var id = $(this).data('id');
								util.cookie.del('ext_type');
								util.cookie.set('ext_type', id, 7*86400);
								location.reload();
								return false;
							});

							$('#search-menu input').keyup(function() {
								var a = $(this).val();
								$('.big-menu .list-group-item, .big-menu .panel-heading').hide();
								$('.big-menu .list-group-item').each(function() {
									$(this).css('border-left', '0');
									if(a.length > 0 && $(this).attr('kw').indexOf(a) >= 0) {
										$(this).parents(".panel").find('.panel-heading').show();
										$(this).show().css('border-left', '3px #428bca double');
									}
								});
								if(a.length == 0) {
									$('.big-menu .list-group-item, .big-menu .panel-heading').show();
								}
							});
						});
					</script>
				</div>
				<div class="col-xs-12 col-sm-9 col-lg-10">
										<ul class="nav nav-tabs">
	<li class="active"><a href="./index.php?c=platform&a=special&do=display&">系统回复</a></li>
</ul>
<div class="clearfix">
	<form class="form form-horizontal" action="" method="post">
		<input type="hidden" name="id" value="">
		<div class="panel panel-default">
			<div class="panel-heading">
				系统回复
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">欢迎信息关键字:</label>
					<div class="col-sm-9 col-xs-12" style="position:relative">
						<div class="input-group">
							<input type="text" name="welcome" class="form-control" id="welcomeinput" value="" placeholder="可根据关键字直接关联指定的回复规则" autocomplete="off" />
							<div class="input-group-btn">
								<span class="btn btn-primary" id="welcome_search"><i class="fa fa-search"></i> 搜索</span>
							</div>
						</div>
						<div id="welcome_menu" style="width:100%;position:absolute;top:32px;left:16px;display:none;z-index:10000">
							<ul class="dropdown-menu" style="display:block;width:91%;height:400px;overflow-y:scroll;"></ul>
						</div>
						<div class="help-block">设置用户添加公众帐号好友时，发送的欢迎信息。<a href="javascript:;" id="welcome"><i class="fa fa-github-alt"></i> 表情</a></div>
						<div class="help-block">
							指定用户添加公众帐号好友时，发送的欢迎信息, 你可以在这里输入关键字, 那么用户添加公众号好友时就相当于发送这个内容至京华微商系统<br>
							这个过程是程序模拟的, 比如这里添加关键字: 欢迎关注, 那么用户添加公众号好友时, 京华微商系统相当于接受了粉丝用户的消息, 内容为"欢迎关注"
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">默认回复关键字:</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<input type="text" name="default" class="form-control" id="defaultinput" value="" placeholder="可根据关键字直接关联指定的回复规则" />
							<div class="input-group-btn">
								<span class="btn btn-primary search" id="default_search"><i class="fa fa-search"></i> 搜索</span>
							</div>
						</div>		
						<div id="default_menu" style="width:100%;position:absolute;top:32px;left:16px;display:none;z-index:10000">
							<ul class="dropdown-menu" style="display:block;width:91%;height:400px;overflow-y:scroll"></ul>
						</div>
						<div class="help-block">当系统不知道该如何回复粉丝的消息时，默认发送的内容。<a href="javascript:;" id="default"><i class="fa fa-github-alt"></i> 表情</a></div>
						<div class="help-block">
							指定系统不知道该如何回复粉丝的消息时，发送的默认信息, 你可以在这里输入关键字, 那么系统不知道该如何回复粉丝的消息时就相当于发送这个内容至京华微商系统<br>
							这个过程是程序模拟的, 比如这里添加关键字: ￥@%&%#@*, 系统不知道该如何回复粉丝的消息, 京华微商系统相当于接受了粉丝用户的消息, 内容为"￥@%&%#@*"
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
					<input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1" />
					<input type="hidden" name="token" value="196752ed" />
			</div>
		</div>
	</form>
</div>
<script>
		util.emotion($("#default"), $("#defaultinput")[0]);
		util.emotion($("#welcome"), $("#welcomeinput")[0]);
		function select_keyword(clickid, menuid, inputid){
			$(clickid).click(function(){
				var search_value = $(inputid).val(); 
				$('body').append('<div class="layer_bg"></div>');
				$('.layer_bg').height($(document).height());
				$('.layer_bg').css({width : '100%', position : 'absolute', top : '0', left : '0', 'z-index' : '0'});
				$.post("./index.php?c=platform&a=special&do=search_key&", {'key_word' : search_value}, function(data){
					var data = $.parseJSON(data);
					var total = data.length;
					var html = '';
					if(total > 0) {
						for(var i = 0; i < total; i++) {
							html += '<li><a href="javascript:;">' + data[i] + '</a></li>';
						}
					} else {
						html += '<li><a href="javascript:;" class="no-result">没有匹配到您输入的关键字</a></li>';
					}
					$(menuid + ' ul').html(html);
					$(menuid + ' ul li a[class!="no-result"]').click(function(){
						$('.layer_bg').remove();
						$(inputid).val($(this).html());
						$(menuid).hide();
					});
					$(menuid).show();
				}); 
				$('.layer_bg').click(function(){
					$(menuid).hide();
					$(this).remove();
				});

			});
			$(inputid).keydown(function(event){
				if(event.keyCode == 13){
					$(clickid).click();
					return false;
				}
			});
		}
		select_keyword('#welcome_search', '#welcome_menu', '#welcomeinput');	
		select_keyword('#default_search', '#default_menu', '#defaultinput');	
</script>
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
	
</body>
</html>
