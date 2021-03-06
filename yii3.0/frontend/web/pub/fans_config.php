<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-lg-2 big-menu">
            <div id="search-menu">
                <input class="form-control input-lg" style="border-radius:0; font-size:14px; height:43px;" placeholder="输入菜单名称可快速查找" type="text">
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">粉丝管理</h4>
                    <a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-0">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group collapse in" id="frame-0">
                    <li class="list-group-item active" onclick="window.location.href = './index.php?r=make/fans_group';" style="cursor:pointer; overflow:hidden;" kw="站点设置">
                        <a class="pull-right" href="index.php?r=make/fans_group"><i class="fa fa-plus"></i></a>
                        粉丝分组
                    </li>
                    <li class="list-group-item active" onclick="window.location.href = './index.php?r=make/fans_list';" style="cursor:pointer; overflow:hidden;" kw="站点设置">
                        <a class="pull-right" href="index.php?r=make/fans_list"><i class="fa fa-plus"></i></a>
                        粉丝
                    </li>
                </ul>
                <div class="panel-heading">
                    <h4 class="panel-title">会员中心</h4>
                    <a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-1">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group collapse in" id="frame-1">
                    <li class="list-group-item" onclick="window.location.href = './index.php?r=make/vip_user';" style="cursor:pointer; overflow:hidden;" kw="我的账户">
                        <a class="pull-right" href="index.php?r=make/vip_user"><i class="fa fa-plus"></i></a>
                        会员
                    </li>
                    <li class="list-group-item" onclick="window.location.href = './index.php?r=make/vip_group_list';" style="cursor:pointer; overflow:hidden;" kw="用户设置">
                        <a class="pull-right" href="index.php?r=make/vip_group_add"><i class="fa fa-plus"></i></a>
                        会员组
                    </li>
                    <li class="list-group-item" onclick="window.location.href = './index.php?r=make/vip_points';" style="cursor:pointer; overflow:hidden;" kw="用户设置">
                        <a class="pull-right" href="index.php?r=make/vip_points"><i class="fa fa-plus"></i></a>
                        会员积分管理
                    </li>
                    <li class="list-group-item" onclick="window.location.href = './index.php?r=make/vip_status';" style="cursor:pointer; overflow:hidden;" kw="用户设置">
                        <a class="pull-right" href="index.php?r=make/vip_status"><i class="fa fa-plus"></i></a>
                        会员字段管理
                    </li>
                    <li class="list-group-item" onclick="window.location.href = './index.php?r=make/vip_deal';" style="cursor:pointer; overflow:hidden;" kw="用户设置">
                        <a class="pull-right" href="index.php?r=make/vip_deal"><i class="fa fa-plus"></i></a>
                        会员交易
                    </li>
                </ul>
                <div class="panel-heading">
                    <h4 class="panel-title">通知中心</h4>
                    <a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-2">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group collapse in" id="frame-2">
                    <li class="list-group-item" onclick="window.location.href = './index.php?r=make/wechat_matter';" style="cursor:pointer; overflow:hidden;" kw="文章管理">
                        <a class="pull-right" href="index.php?r=make/wechat_matter"><i class="fa fa-plus"></i></a>
                        微信素材&群发
                    </li>
                    <li class="list-group-item" onclick="window.location.href = './index.php?r=make/notice_msg';" style="cursor:pointer; overflow:hidden;" kw="分类管理">
                        <a class="pull-right" href="index.php?r=make/notice_msg"><i class="fa fa-plus"></i></a>
                        群发消息&通知
                    </li>
                    <li class="list-group-item" onclick="window.location.href = './index.php?r=make/news';" style="cursor:pointer; overflow:hidden;" kw="用户设置">
                        <a class="pull-right" href="index.php?r=make/news"><i class="fa fa-plus"></i></a>
                        通知参数
                    </li>
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