<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<!-- 会员list begin -->

    <div class="col-xs-12 col-sm-9 col-lg-10">
        <ul class="nav nav-tabs">
            <li class="active" id="user_list" ><a href="javascript:void(0)">会员列表</a></li>
            <li id="user_add"><a href="javascript:void(0)">添加会员</a></li>
        </ul>
        <div id='users' >
        <div class="panel panel-info">
            <div class="panel-heading">筛选</div>
            <div class="panel-body">
                <form id="a0" action="?r=make/vip_user" name="a1" method="post" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">注册时间</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <input name="time1" id="time1" type="text" value="2017-01-01">
                            <input name="time2" id="time2" type="text" value="<?= date('Y-m-d',strtotime("-1 day"))?>">
                            <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">邮箱/姓名/手机号码</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <input type="text" class="form-control" name="user" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">所属组</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <select name="groupid" class="form-control">
                                <option value="" selected="selected">不限</option>
                                <? foreach ($groups as $k => $v){?>
                                <option value="<?= $v['id']?>"><?= $v['title']?></option>
                                <? } ?>
                            </select>
                        </div>
                        <div class="pull-right col-xs-12 col-sm-3 col-md-2 col-lg-2">
                            <button class="btn btn-default" id="button"><i class="fa fa-search"></i> 搜索</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <form method="post" name="a1" class="form-horizontal" id="form1">
            <div class="panel panel-default ">
                <div class="table-responsive panel-body">
                    <table class="table table-hover">
                        <thead class="navbar-inner">
                        <tr>
                            <th style="width:44px;">删?</th>
                            <th style="width:80px;">会员编号</th>
                            <th style="width:150px;">昵称/真实姓名</th>
                            <th style="width:120px;">手机</th>
                            <th style="width:120px;">邮箱</th>
                            <th style="width:120px;">余额/积分</th>
                            <th style="width:120px;">注册时间</th>
                            <th style="text-align:right">操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        <? foreach ($groupUser as $k => $v){ ?>
                        <tr>
                            <td><input type="checkbox" name="uid" value="<?= $v['id'] ?>" class="del_a"></td>
                            <td><?= $v['id'] ?></td>
                            <td>
                                <?= $v['nickname'] ?>					<br>
                                <?= $v['realname'] ?>				</td>
                            <td><?= $v['mobile'] ?></td>
                            <td><?= $v['email'] ?></td>
                            <td>
                                <span class="label label-primary">余额：<?= $v['credit2'] ?></span>
                                <br>
                                <span class="label label-warning">积分：<?= $v['credit1'] ?></span>
                            </td>
                            <td>
                                <?= $v['re_time'] ?>
                            </td>
                            <td class="text-right" style="overflow:visible;">
                                <div class="btn-group">
                                    <div class="btn-group">
                                        <select name="groupid" uid="<?=$v['id']?>" class="btn btn-default dropdown-toggle group" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <? foreach ($groups as $key => $val){ ?>
                                            <option value="<?=$val['id']?>" <?if($v['groupid'] == $val['id']){echo 'selected';}?> ><?= $val['title']?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <a href="?r=make/vip_value&hid=<?= $v['id']?>" title="编辑" class="btn btn-default">编辑</a>
                                    <a href="javascript:void(0)" title="积分" tid="<?= $v['id'] ?>" cre="<?= $v['credit1'] ?>" class="btn btn-success credit1">积分</a>
                                    <a href="javascript:void(0)" title="余额" tid="<?= $v['id'] ?>" cre="<?= $v['credit2'] ?>" class="btn btn-success credit2">余额</a>
                                </div>
                            </td>
                        </tr>
                        <? } ?>

                        <tr>
                            <td><input type="checkbox" name="" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});"></td>
                            <td colspan="7"><input type="button" name="button" class="btn btn-primary so_del" value="删除"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

<!-- 会员list end -->
<!-- 添加会员 begin -->
        <div id="adds" style="display: none">
        <form action="" name="a2" method="post" class="form-horizontal" role="form" id="form1">
            <div class="panel panel-info">
                <div class="panel-heading">添加会员</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员姓名</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="realname" value="" class="form-control" placeholder="请输入真实姓名，不得大于4位"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">手机号</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="mobile" value="" class="form-control" placeholder="输入正确的手机格式"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">登陆密码</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="password" name="password" value="" class="form-control" placeholder="密码不得少于6位"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">确认密码</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="password" name="pwd" value="" class="form-control" placeholder="两次密码请保持一致"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">邮箱</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="email" value="" class="form-control" placeholder="输入正确的邮箱格式"/>
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
                                <? foreach ($groups as $k => $v){?>
                                    <option value="<?= $v['id']?>"><?= $v['title']?></option>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-xs-12">
                    <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                    <input type="submit" onclick="javascript:this.form.action='?r=make/vip_user_add';" value="提交" class="btn btn-primary"/>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- 添加会员 end -->
<script>
$(function(){
    $('#user_list').click(function(){
        $('#users').show();
        $('#adds').hide();
        $(this).addClass('active');
        $('#user_add').removeClass('active');
    });

    $('#user_add').click(function(){
        $('#adds').show();
        $('#users').hide();
        $(this).addClass('active');
        $('#user_list').removeClass('active');
    });

    $('.credit1').click(function(){
        var credit = prompt("请输入您要增加的积分，如若在积分之前加 - 号，会扣掉相应的积分", "");
        if (credit)//如果返回的有内容
        {
            if (!isNaN(credit)){
                var uid = $(this).attr('tid');
                var _csrf = $('#_csrf').val();
                var cre = $(this).attr('cre');
                $.ajax({
                    type: "POST",
                    url: "?r=make/vip_user_change",
                    data: {id:uid,credit:credit,cre:cre,_csrf:_csrf,type:0},
                    dataType:'json',
                    success: function(msg){
                        switch (true){
                            case msg == 100:
                                alert('修改成功');
                                window.location.reload();
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
    });

    $('.credit2').click(function(){
        var credit = prompt("请输入您要增加的金额，如若在金额之前加 - 号，会扣掉相应的金额", "");
        if (credit)//如果返回的有内容
        {
            if (!isNaN(credit)){
                var uid = $(this).attr('tid');
                var _csrf = $('#_csrf').val();
                var cre = $(this).attr('cre');
                $.ajax({
                    type: "POST",
                    url: "?r=make/vip_user_change",
                    data: {id:uid,credit:credit,cre:cre,_csrf:_csrf,type:1},
                    dataType:'json',
                    success: function(msg){
                        switch (true){
                            case msg == 100:
                                alert('修改成功');
                                window.location.reload();
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
    });

    $('.group').change(function(){
        if (confirm("你确定修改吗？")) {
            var id = $(this).attr('uid');
            var groupid = $(this).children('option:selected').val();
            var _csrf = $('#_csrf').val();
            $.ajax({
                type: "POST",
                url: "?r=make/vip_user_up",
                data: {id:id,_csrf:_csrf,groupid:groupid},
                dataType:'json',
                success: function(msg){
                    switch (true){
                        case msg == 100:
                            alert('修改成功');
                            window.location.reload();
                            break;
                        case msg == 101:
                            alert('修改失败');
                            break;
                        default:
                            alert('未知错误')
                    }
                }
            });
        }
    });
    $('.so_del').click(function(){
        if (confirm("你确定修改吗？")) {
            var obj = document.getElementsByName("uid");
            var check_val = [];
            var k;
            for(k in obj){
                if(obj[k].checked)
                    check_val.push(obj[k].value);
            }
            if (check_val != ''){
                var _csrf = $('#_csrf').val();
                $.ajax({
                    type: "POST",
                    url: "?r=make/vip_user_del",
                    data: {u:check_val,_csrf:_csrf},
                    success: function(msg){
                        if (msg = 100){
                            alert('成功');
                            window.location.reload();
                        } else {
                            alert('失败');
                        }
                    }
                });
            }
        }
    });
})
</script>
