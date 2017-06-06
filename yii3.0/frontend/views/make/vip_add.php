<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="./index.php?r=make/vip_list">会员列表</a></li>
        <li ><a href="./index.php?r=make/vip_add">添加会员</a></li>
    </ul>
    <form action="index.php?r=make/vip_add" method="post" class="form-horizontal" role="form" id="form1">
        <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
        <div class="panel panel-info">
            <div class="panel-heading">添加会员</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员姓名</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="realname" value="" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">手机号</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="mobile" id="mobile" value="" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">登陆密码</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="password" name="password" value="" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">邮箱</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="email" value="" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="credit1" value="0" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">余额</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="credit2" value="0" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员组</label>
                    <div class="col-sm-9 col-xs-12">
                        <select name="groupid" class="form-control">
                            <?php foreach ($group_query as $k=>$v){?>
                            <option value="<?php echo $v['id']?>"><?php echo $v['title']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-9 col-xs-12">
                <input type="submit" value="提交" class="btn btn-primary"/>
            </div>
        </div>
    </form>
    <script>
        $(function () {
            $("input[name='mobile']").blur(function () {
                var mobile = $(this).val();
                var mobile_reg= /^1[34578]\d{9}$/;
                if(!mobile_reg.test(mobile))
                {
                    $("input[name='mobile']").after("<span><font style='color: red'>手机号不正确</font></span>");
                    $(".form-control").mobile=false;
                    return false;
                }
            })
        })
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
</div>
