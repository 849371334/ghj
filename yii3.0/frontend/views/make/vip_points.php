<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:void(0)">会员积分</a></li>
    </ul>
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="" method="post" class="form-horizontal" role="form" id="form">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 control-label">关键字类型</label>
                    <div class="col-sm-8 col-lg-9 col-xs-12">
                        <div class="btn-group">
                            <a href="javascript:void(0)" class="btn btn-primary" id="n1">真实姓名</a>
                            <a href="javascript:void(0)" class="btn btn-default" id="n2">昵称</a>
                            <a href="javascript:void(0)" class="btn btn-default" id="n3">手机号</a>
                            <a href="javascript:void(0)" class="btn btn-default" id="n4">用户UID</a>
                            <input type="hidden" name="user" value="realname" id="user">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 control-label">关键字</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" name="keyword" id="keyword" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 control-label">积分范围</label>
                    <div class="col-sm-4 col-xs-12">
                        <input type="text" class="form-control" name="minimal" value="" placeholder="请输入最小值"  />
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <input type="text" class="form-control" name="maximal" value="" placeholder="请输入最大值" />
                    </div>
                    <div class="pull-right col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="alert alert-info" role="alert"><i class="fa fa-exclamation-circle"></i> 如果扫描来自会员中心的付款码信息，请选择关键字类型为用户UID，然后根据扫码结果搜索满足条件的用户。</div>
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table class="table table-hover">
                <input type="hidden" name="do" value="del" />
                <thead class="navbar-inner">
                <tr>
                    <th style="min-width:44px;">会员编号</th>
                    <th style="min-width:44px;">昵称</th>
                    <th style="min-width:60px;">真实姓名</th>
                    <th style="min-width:100px;">手机</th>
                    <th>邮箱</th>
                    <th style="min-width:45px;">积分</th>
                    <th style="min-width:45px;">余额</th>
                    <th>操作</th>
                </tr>
                </thead>
                <thead>
                <? if (!isset($data)){} else {?>
                    <? foreach ($data as $k => $v){ ?>
                    <tr>
                        <td style="vertical-align:middle"><?= $v['id']?></td>
                        <td style="vertical-align:middle"><?= $v['nickname']?></td>
                        <td style="vertical-align:middle"><?= $v['realname']?></td>
                        <td style="vertical-align:middle"><?= $v['mobile']?></td>
                        <td style="vertical-align:middle"><?= $v['email']?></td>
                        <td style="vertical-align:middle"><?= $v['credit1']?></td>
                        <td style="vertical-align:middle"><?= $v['credit2']?></td>
                        <td>
                            <a href="javascript:void(0)" tid="<?= $v['id']?>" cre="<?= $v['credit1']?>" class="recharge" title="修改">积分变动</a>&nbsp;
                        </td>

                    </tr>
                <? } ?>
                <? } ?>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
$(function(){
    $('#n1').click(function(){
        $(this).attr('class','btn btn-primary');
        $('#n2').attr('class','btn btn-default');
        $('#n3').attr('class','btn btn-default');
        $('#n4').attr('class','btn btn-default');
        $('#user').val('realname');
    });
    $('#n2').click(function(){
        $(this).attr('class','btn btn-primary');
        $('#n1').attr('class','btn btn-default');
        $('#n3').attr('class','btn btn-default');
        $('#n4').attr('class','btn btn-default');
        $('#user').val('nickname');
    });
    $('#n3').click(function(){
        $(this).attr('class','btn btn-primary');
        $('#n2').attr('class','btn btn-default');
        $('#n1').attr('class','btn btn-default');
        $('#n4').attr('class','btn btn-default');
        $('#user').val('mobile');
    });
    $('#n4').click(function(){
        $(this).attr('class','btn btn-primary');
        $('#n2').attr('class','btn btn-default');
        $('#n3').attr('class','btn btn-default');
        $('#n1').attr('class','btn btn-default');
        $('#user').val('id');
    });

    $('.recharge').click(function(){
        var credit = prompt("请输入您要增加的积分，如若在积分之前加 - 号，会扣掉相应的积分", "");
        if (credit)//如果返回的有内容
        {
            if (!isNaN(credit)){
                var uid = $(this).attr('tid');
                var _csrf = $('#_csrf').val();
                var cre = $(this).attr('cre');
                $.ajax({
                    type: "POST",
                    url: "?r=make/vip_points_change",
                    data: {id:uid,credit:credit,cre:cre,_csrf:_csrf},
                    dataType:'json',
                    success: function(msg){
                        switch (true){
                            case msg == 109:
                                alert('未通过安全验证');
                                break;
                            case msg == 100:
                                alert('修改成功');
                                break;
                            case msg == 101:
                                alert('修改失败');
                                break;
                            default:
                                alert('未知错误')
                        }
                    }
                });
            } else {
                alert("请输入正确的信息")
            }
        }
    })
})
</script>
