<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
<ul class="nav nav-tabs">
    <li ><a href="./index.php?r=make/vip_group_list">会员组列表</a></li>
    <li class="active"><a href="./index.php?r=make/vip_group_add">添加会员组</a></li>
</ul>
<div class="alert alert-info">
    <strong class="text-danger"><i class="fa fa-info-circle"></i> 会员组的总积分是根据(积分+贡献)的值算出来的,管理员不能直接修改会员所在的会员组. 如果需要修改会员组,请通过设置积分或者贡献的值来影响总积分,系统会根据影响后的总积分自动算出对应的会员组</strong><br>
    <i class="fa fa-info-circle"></i> 默认会员组的积分需设置为 0 <br>
    <i class="fa fa-info-circle"></i> 系统会根据会员的总积分(积分+贡献)多少自动对会员的分组进行调整 <br>
</div>
<script>
    $("#form2").submit(function(){
        if($.trim($(':text[name="title"]').val()) == '') {
            util.message('没有输入用户组名称.', '', 'error');
            return false;
        }
        return true;
    });
</script>
<div class="main">
    <form class="form-horizontal form" id="form2" action="index.php?r=make/vip_group_add" method="post">
        <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
        <div class="panel panel-default">
            <div class="panel-heading">
                会员组参数
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">组名称</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" name="title" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">所需积分</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" name="credit" value="" />
                        <div class="help-block">此项设置升级到该会员组所需积分.如果会员的积分达到该会员组所设置的积分,会员等级会自动提升</div>
                        <div class="help-block"><strong class="text-danger">默认会员组的积分需设置为 0</strong></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" class="btn btn-primary col-lg-1" name="submit" value="提交" />
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