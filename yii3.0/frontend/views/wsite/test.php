<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/wx_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="./index.php?c=home&a=welcome&do=site&">账号概况 - 微站功能概况</a></li>
    </ul>
    <div class="clearfix welcome-container">
        <div class="page-header">
            <h4><i class="fa fa-plane"></i> 快捷操作</h4>
        </div>
        <div class="shortcut clearfix">
            <a href="./index.php?c=platform&a=reply&m=userapi">
                <img src="./public/images/ww.png" alt="">
                <span>自定义接口</span>
            </a>
        </div>
    </div>
    <style>
        .template .item{position:relative;display:block;float:left;border:1px #ddd solid;border-radius:5px;background-color:#fff;padding:5px;width:190px;margin:0 10px 10px 0;}
        .template .title{margin:5px auto;line-height:2em;}
        .template .item img{width:178px;height:270px;}
        .clear{clear:both;}
        .home-container{width:100%; overflow:hidden; margin:.6em .3em;}
        .home-container .tile{float:left; display:block; text-decoration:none; outline:none; width:6em; height:6em; margin:.4em;}
        .home-container i{display:block; color:#333; height:1em; overflow: hidden; font-size:2em; margin:.25em .2em;}
        .home-container span{display:block; width:100%; overflow:hidden;}
    </style>
    <div class="page-header">
        <h4><img src="./public/images/w.bmp" alt=""> 当前站点</h4>
    </div>
    <div class="panel panel-default row">
        <div class="table-responsive panel-body">
            <table class="table">
                <tr>
                    <td style="width:200px; border-top:none;">
                        <div class="">
                            <div class="item">
                                <div class="title">
                                    <img src="../app/themes/default/preview.jpg" class="img-rounded" />
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="border-top:none;">
                        <p>
                            <strong>微站入口触发关键字 : </strong>
                        </p>
                        <p><a href="javascript:;" onclick="preview_home('40', '29');return false;" class="btn btn-default">预览</a></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="page-header">
        <h4><i class="fa fa-android"></i> 站点导航图标</h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th style="width:200px">导航及菜单</th>
                    <th>概况</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>微站首页导航图标</td>
                    <td>
                        <div class="home-container">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>个人中心导航条目</td>
                    <td>
                        <div class="home-container">
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="page-header">
        <h4><i class="fa fa-cogs"></i> 幻灯片设置</h4>
    </div>
    <div class="panel panel-default row">
        <div class="panel-body table-responsive">
            <table class="table">
                <tr>
                    <td style="border-top:0;">
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        function preview_home(styleid, multiid) {
            var content = '<iframe width="320" scrolling="yes" height="480" frameborder="0" src="about:blank"></iframe>';
            var footer =
                '<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>';
            var dialog = util.dialog('预览模板', content, footer);
            dialog.find('iframe').on('load', function(){
                $('a', this.contentWindow.document.body).each(function(){
                    if ($(this).attr('href').substr(0, 4) != 'http') {
                        if ($(this).attr('href').substr(0, 2) == './') {
                            $(this).attr('href', $(this).attr('href') + 's=' + styleid);
                        } else {
                            $(this).attr('href', 'http://' + $(this).attr('href'));
                        }
                    }
                });
            });
            var url = '../app/./index.php?i=24&c=home&&s=' + styleid + 't=' + multiid;
            dialog.find('iframe').attr('src', url);
            dialog.find('.modal-dialog').css({'width': '322px'});
            dialog.find('.modal-body').css({'padding': '0', 'height': '480px'});
            dialog.modal('show');
        }
    </script>

</div>
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

</div>