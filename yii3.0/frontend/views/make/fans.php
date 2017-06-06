<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="./index.php?r=make/fans">账号概况 - 会员功能概况</a></li>
    </ul>
    <div class="clearfix welcome-container">
        <div class="page-header">
            <h4><i class="fa fa-plane"></i> 快捷操作</h4>
        </div>
        <div class="shortcut clearfix">
            <a href="./index.php?c=platform&a=reply&m=userapi">
                <i class="fa fa-sitemap"></i>
                <span>自定义接口</span>
            </a>
        </div>
        <div class="page-header">
            <h4><i class="fa fa-android"></i> 会员统计情况</h4>
        </div>
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width:400px;">公众号</th>
                        <th style="width:400px;">会员数量</th>
                        <th ></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>aushing</td>
                        <td>
                            <p>1</p>
                        </td>
                        <td>
                            <a href="./index.php?c=mc&a=member&do=display&">查看</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="page-header">
            <h4><i class="fa fa-android"></i> 主公号粉丝统计情况</h4>
        </div>
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width:400px;">主公众号</th>
                        <th style="width:400px;">粉丝数量</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>aushing</td>
                        <td>
                            <p>1</p>
                        </td>
                        <td>
                            <a href="./index.php?c=mc&a=fans&do=display&">查看</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page-header">
            <h4><i class="fa fa-android"></i> 子公号粉丝统计情况</h4>
        </div>
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width:400px;">子公众号</th>
                        <th style="width:400px;">粉丝数量</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>aushing</td>
                        <td>
                            <p>1</p>
                        </td>
                        <td>
                            <a href="./index.php?c=mc&a=fans&do=display&acid=24">查看</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="page-header">
            <h4><i class="fa fa-android"></i> 营销统计情况</h4>
        </div>
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width:400px;">营销方式</th>
                        <th style="width:400px;"></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>打折券</td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <td>代金券</td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
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

