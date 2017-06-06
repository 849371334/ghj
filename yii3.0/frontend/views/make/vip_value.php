<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <div class="col-xs-12 col-sm-9 col-lg-10">
        <style>
            .label{line-height: 1.8}
        </style>
        <ul class="nav nav-tabs">
            <li ><a href="?r=make/vip_user">会员列表</a></li>
            <li class="active"><a href="javascript:void(0)">编辑会员资料</a></li>
        </ul>
    </div>
    <div class="main">
        <form action="" class="form-horizontal form" method="post" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-heading">个人信息</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">昵称</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="nickname" value="<?= $user['nickname']?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">真实姓名</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="realname" value="<?= $user['realname']?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">email</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="email" value="<?= $user['email']?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">mobile</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="mobile" value="<?= $user['mobile']?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">新密码</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="password" class="form-control" name="password" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">重复新密码</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="password" class="form-control" name="pwd" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="hidden" name="id" value="<?=$user['id']?>">
                            <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                            <input type="submit" value="提交" class="btn btn-primary" >
                            <span class="label"></span>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="" class="form-horizontal form" method="post" enctype="multipart/form-data">
        <div class="panel panel-default">
                <div class="panel-heading">个人配置</div>
                <div class="panel-body">
                    <? foreach ($config as $k => $v){ ?>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"><?= $v['title']?></label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="<?= $v['id']?>" value="<?= $v['word']?>" />
                        </div>
                    </div>

                    <? } ?>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="hidden" name="hid" value="<?= $hid?>">
                        <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                        <input type="submit" class="btn btn-primary" value="提交" onclick="javascript:this.form.action='?r=make/vip_value_add';">
                        <span class="label"></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>