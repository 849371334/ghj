<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
<ul class="nav nav-tabs">
    <li class="active"><a href="./index.php?r=make/wechat_matter">定时群发</a></li>
    <li ><a href="./index.php?r=make/send">发送记录</a></li>
    <li ><a href="./index.php?r=make/image">图片</a></li>
    <li ><a href="./index.php?r=make/voice">语音</a></li>
    <li ><a href="./index.php?r=make/video">视频</a></li>
    <li ><a href="./index.php?r=make/news">图文</a></li>
</ul>

<v class="clearfix">
    <form action="?c=material&a=mass&do=send&" method="post" id="form1">
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
                <table class="table table-hover" cellspacing="0" cellpadding="0">
                    <thead class="navbar-inner">
                    <tr>
                        <th>消息详情</th>
                        <th>发送用户组</th>
                        <th>发送人数</th>
                        <th>状态</th>
                        <th width="250">发送时间</th>
                        <th>添加时间</th>
                        <th width="170"></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
    </div>
    
    <script>
        require(['bootstrap'], function(){
            $('.tip').hover(function(){
                $(this).tooltip();
            });
            $('.mass-log').hover(function(){
                obj = $(this);
                $.post("./index.php?c=utility&a=cron&do=log&", {tid: $(this).data('tid'), type: $(this).data('type'), module: $(this).data('module')}, function(data) {
                    data = $.parseJSON(data);
                    var html = '';
                    if(data.message.items.length == 0) {
                        html = '<tr><td class="text-center"><i class="fa fa-info-circle"></i> 暂无数据</td></tr>';
                    } else{
                        $.each(data.message.items, function(k, v){
                            html += '<tr><td>' + v.createtime + ' ' + v.note + '</td></tr>';
                        });
                    }
                    obj.popover({
                        'html':true,
                        'placement':'left',
                        'trigger':'manual',
                        'title':'触发日志',
                        'content':'<table class="table-cron table">' + html + '</table>'
                    });
                    obj.popover('toggle');
                });
            }, function(){
                $(this).popover('toggle');
            });
        });
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