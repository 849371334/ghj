<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-lg-2 big-menu">
            <div id="search-menu">
                <input class="form-control input-lg" style="border-radius:0; font-size:14px; height:43px;" placeholder="输入菜单名称可快速查找" type="text">
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">回复管理</h4>
                    <a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-0">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group collapse in" id="frame-0">
                    <li class="list-group-item" onclick="window.location.href = './index.php?r=user/news';" style="cursor:pointer; overflow:hidden;" kw="回复">
                        <a class="pull-right" href="/index.php?r=user/news"><i class="fa fa-plus"></i></a>
                        回复
                    </li>
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
                    <a class="list-group-item" href="?r=qrcode/qrcode" kw="二维码处理">二维码处理</a>
                    <a class="list-group-item" href="?r=customer/customer" kw="多客服管理">多客服管理</a>
                    <a class="list-group-item" href="?r=qrcode/longurl" kw="长链接二维码">长链接二维码</a>
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
                    <a class="list-group-item" href="index.php?r=statistics/chatlog" kw="聊天记录">聊天记录</a>
                    <a class="list-group-item" href="index.php?r=statistics/parameter" kw="参数设置">参数设置</a>
                    <a class="list-group-item" href="index.php?r=statistics/keywords" kw="关键字命中情况">关键字命中情况</a>
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