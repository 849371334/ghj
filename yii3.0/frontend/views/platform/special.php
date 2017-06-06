<?php
include_once('./pub/top.php');
include_once('./pub/sys_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
										<ul class="nav nav-tabs">
	<li class="active"><a href="http://wcmall.bj165.com/web/index.php?c=platform&amp;a=special&amp;do=display&amp;">系统回复</a></li>
</ul>
<div class="clearfix">
	<form class="form form-horizontal" action="./index.php?r=platform/special&rid=<?= $id; ?>" method="post">
		<input name="id" value="" type="hidden">
		<div class="panel panel-default">
			<div class="panel-heading">
				系统回复
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">欢迎信息关键字:</label>
					<div class="col-sm-9 col-xs-12" style="position:relative">
						<div class="input-group">
							<input name="welcome" class="form-control" id="welcomeinput"  value="<?php  echo $welcome  ?>" placeholder="可根据关键字直接关联指定的回复规则" autocomplete="off" type="text">
							<div class="input-group-btn">
								<span class="btn btn-primary" id="welcome_search"><i class="fa fa-search"></i> 搜索</span>
							</div>
						</div>
						<div id="welcome_menu" style="width:100%;position:absolute;top:32px;left:16px;display:none;z-index:10000">
							<ul class="dropdown-menu" style="display:block;width:91%;height:400px;overflow-y:scroll;"></ul>
						</div>
						<div class="help-block">设置用户添加公众帐号好友时，发送的欢迎信息。<a href="javascript:;" id="welcome" data-original-title="" title=""><i class="fa fa-github-alt"></i> 表情</a></div>
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
							<input name="default" class="form-control" id="defaultinput" value="<?php  echo $default  ?>" placeholder="可根据关键字直接关联指定的回复规则" type="text">
							<div class="input-group-btn">
								<span class="btn btn-primary search" id="default_search"><i class="fa fa-search"></i> 搜索</span>
							</div>
						</div>		
						<div id="default_menu" style="width:100%;position:absolute;top:32px;left:16px;display:none;z-index:10000">
							<ul class="dropdown-menu" style="display:block;width:91%;height:400px;overflow-y:scroll"></ul>
						</div>
						<div class="help-block">当系统不知道该如何回复粉丝的消息时，默认发送的内容。<a href="javascript:;" id="default" data-original-title="" title=""><i class="fa fa-github-alt"></i> 表情</a></div>
						<div class="help-block">
							指定系统不知道该如何回复粉丝的消息时，发送的默认信息, 你可以在这里输入关键字, 那么系统不知道该如何回复粉丝的消息时就相当于发送这个内容至京华微商系统<br>
							这个过程是程序模拟的, 比如这里添加关键字: ￥@%&amp;%#@*, 系统不知道该如何回复粉丝的消息, 京华微商系统相当于接受了粉丝用户的消息, 内容为"￥@%&amp;%#@*"
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
					<input name="submit" value="提交" class="btn btn-primary col-lg-1" type="submit">
					<input name="wx_id" value="<?= $id; ?>" type="hidden">
					<input type="hidden" name='_csrf' value="<?= Yii::$app->request->csrfToken ?>">
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
				$('body').append('&lt;div class="layer_bg"&gt;&lt;/div&gt;');
				$('.layer_bg').height($(document).height());
				$('.layer_bg').css({width : '100%', position : 'absolute', top : '0', left : '0', 'z-index' : '0'});
				$.post("./index.php?c=platform&amp;a=special&amp;do=search_key&amp;", {'key_word' : search_value}, function(data){
					var data = $.parseJSON(data);
					var total = data.length;
					var html = '';
					if(total &gt; 0) {
						for(var i = 0; i &lt; total; i++) {
							html += '&lt;li&gt;&lt;a href="javascript:;"&gt;' + data[i] + '&lt;/a&gt;&lt;/li&gt;';
						}
					} else {
						html += '&lt;li&gt;&lt;a href="javascript:;" class="no-result"&gt;没有匹配到您输入的关键字&lt;/a&gt;&lt;/li&gt;';
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