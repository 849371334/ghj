<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="./index.php?r=make/notice_msg"><i class="icon-group"></i> 发送通知消息</a></li>
    </ul>
    <div class="main">
        <form action="./index.php?c=mc&a=broadcast&" method="post" class="form-horizontal form">
            <div class="panel panel-default">
                <div class="panel-heading">
                    批量发送通知
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">通知方式</label>
                        <div class="col-sm-9 col-xs-12">
                            <label class="radio-inline">
                                <input type="radio" name="type" value="email" checked="checked"/>
                                邮件
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" value="wechat" onclick="location.href='./index.php?c=material&a=mass&'"/>
                                微信
                            </label>
                            <span class="help-block">请指定你要发送通知的方式, 不同的方式能到达的用户也不同</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">用户组</label>
                        <div class="col-sm-9 col-xs-12">
                            <select name="group" class="form-control">
                                <option value="">不限</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">用户</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="username" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="submit" class="btn btn-primary" value="筛选用户" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
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