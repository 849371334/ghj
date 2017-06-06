<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="./index.php?r=make/vip_notice"><i class="icon-group"></i> 设置通知模板</a></li>
    </ul>
    <div class="alert alert-info">
        <i class="fa fa-info-circle"></i> 只有认证的公众号才可以使用微信通知。如果您的公众号是“认证服务号”,您可以选择一下通知方式中的一种。如果您的公众号是“认证订阅号”，只能使用客服消息通知<br>
        <i class="fa fa-info-circle"></i> 使用客服消息发送通知，要求：粉丝过去的“48小时内”必须有过交互，否则将不能发送通知<br>
    </div>
    <div class="clearfix">
        <form action="./index.php?c=mc&a=tplnotice&" method="post" class="form-horizontal form">
            <div class="panel panel-default">
                <div class="panel-heading">
                    设置通知模板
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">通知方式</label>
                        <div class="col-sm-9 col-xs-12">
                            <label class="radio-inline">
                                <input type="radio" name="type" value="tpl"  checked="checked"/>
                                模板消息
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" value="custom" />
                                客服消息
                            </label>
                            <span class="help-block">只有认证的公众号才可以使用微信通知。如果您的公众号是“认证服务号”,您可以使用以上两种方式中的一种。如果您的公众号是“认证订阅号”，只能使用客服消息通知</span>
                            <span class="help-block"><strong class="text-danger">如果选择模板消息通知，需要设置模板编号</strong></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员余额充值模板编号</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="recharge" value=""/>
                            <span class="help-block">会员充值成功后，系统将通过微信发送充值成功消息</span>
                            <span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”会员充值通知“，编号为：“TM00009”的模板。</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员余额变更模板编号</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="credit2" value=""/>
                            <span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”余额变更通知“，编号为：“OPENTM207266084”的模板。</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员积分变更模板编号</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="credit1" value=""/>
                            <span class="help-block">会员充值成功后，系统将通过微信发送充值成功消息</span>
                            <span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”积分提醒“，编号为：“TM00335”的模板。</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员等级变更模板编号</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="group" value=""/>
                            <span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”会员级别变更提醒“，编号为：“TM00891”的模板。</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡计次充值模板编号</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="nums_plus" value=""/>
                            <span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”计次充值通知“，编号为：“OPENTM207207134”的模板。</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡计次消费模板编号</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="nums_times" value=""/>
                            <span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”计次消费通知“，编号为：“OPENTM202322532”的模板。</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡计时续费模板编号</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="times_plus" value=""/>
                            <span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”自动续费成功通知“，编号为：“TM00956”的模板。</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡计时即将到期模板编号</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="times_times" value=""/>
                            <span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”到期提醒通知“，编号为：“TM00003”的模板。</span>
                        </div>
                    </div>


                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-xs-12">
                    <input type="hidden" name="token" value="196752ed"/>
                    <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"/>
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