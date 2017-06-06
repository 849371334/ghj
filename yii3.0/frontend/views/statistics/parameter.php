<?php
include_once('./pub/top.php');
include_once('./pub/config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
<div class="clearfix">
    <form action="" method="post" class="form-horizontal form">
        <div class="panel panel-default">
            <div class="panel-heading">
                统计分析 <span>设定公众号码统计分析的相关功能，这个设置是针对当前公众号的</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">开启历史消息记录</label>
                    <div class="col-sm-9 col-xs-12">
                        <label for="msg_history_1" class="radio-inline"><input type="radio" name="msg_history" id="msg_history_1" value="1" <? if($data['is_record']==1){echo 'checked';} ?> > 是</label>
                        <label for="msg_history_0" class="radio-inline"><input type="radio" name="msg_history" id="msg_history_0" value="0" <? if($data['is_record']==0){echo 'checked';} ?>> 否</label>
                        <div class="help-block">开启此项后，系统将记录用户与系统的往来消息记录。</div>
                    </div>
                </div>
                <div class="form-group msgd">
                    <label class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">历史消息记录天数</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="msg_maxday" class="form-control" value="<?= $data['rec_time'] ?>">
                        <div class="help-block">设置保留历史消息记录的天数，为0则为保留全部。</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">开启利用率统计</label>
                    <div class="col-sm-9 col-xs-12" >
                        <label for="rule_use_1" class="radio-inline"><input type="radio" id="rule_use_1" name="use_ratio" value="1" class="rule" disabled> 是</label>
                        <label for="rule_use_0" class="radio-inline"><input type="radio" id="rule_use_0" name="use_ratio" value="0" class="rule" checked="checked"> 否</label>
                        <div class="help-block">开启此项后，系统将记录系统中的规则的使用情况，并生成走势图。</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
                <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>">
            </div>
        </div>
    </form>
</div>
</div>
<script>
$(function(){
    $('.rule').click(function(){
        alert('此功能暂不可用，对您造成的不便烦请谅解，我们在后续开发中会尽快加入此功能。');
    })
})
</script>

