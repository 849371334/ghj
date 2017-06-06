<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-3 col-lg-2 big-menu">
			<div id="search-menu">
				<input class="form-control input-lg" style="border-radius:0; font-size:14px; height:43px;" placeholder="输入菜单名称可快速查找" type="text">
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">系统管理</h4>
					<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-0">
						<i class="fa fa-chevron-circle-down"></i>
					</a>
				</div>
				<ul class="list-group collapse in" id="frame-0">
                    <?php
                    $session = \Yii::$app->session;
                    $res = $session->get('user');
                    if ($res['username']=='admin' || $res['username']=='admin1'){?>
                        <li class="list-group-item" onclick="window.location.href = 'index.php?r=permission/add';" style="cursor:pointer; overflow:hidden;" kw="权限组">
                            <a class="pull-right" href="index.php?r=permission/add"><i class="fa fa-plus"></i></a>
                            <a href="index.php?r=permission/add">权限组</a>
                        </li>
                        <li class="list-group-item" onclick="window.location.href = 'index.php?r=group/add';" style="cursor:pointer; overflow:hidden;" kw="用户组">
                            <a class="pull-right" href=""><i class="fa fa-plus"></i></a>
                            <a href="index.php?r=group/add">用户组</a>
                        </li>
                        <li class="list-group-item" onclick="window.location.href = 'index.php?r=rule/add';" style="cursor:pointer; overflow:hidden;" kw="管理员设置">
                            <a class="pull-right" href="index.php?r=rule/add"><i class="fa fa-plus"></i></a>
                            管理员设置
                        </li>
                    <?php }?>
                    <li class="list-group-item" onclick="window.location.href = 'index.php?r=setting/service';" style="cursor:pointer; overflow:hidden;" kw="常用服务接入">
                        <a class="pull-right" href=""><i class="fa fa-plus"></i></a>
                        <a href="./index.php?r=setting/service">常用服务接入</a>
                    </li>

                    <li class="list-group-item active" onclick="window.location.href = './index.php?r=platform/index';" style="cursor:pointer; overflow:hidden;" kw="自定义接口回复">
                        <a class="pull-right" href="./index.php?r=platform/index"><i class="fa fa-plus"></i></a>
                        自定义接口回复</li>
                    <a class="list-group-item " href="./index.php?r=platform/special&do=display&" kw="系统回复">系统回复</a>

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