<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active" id="user_list"><a href="javascript:void(0)">会员组列表</a> </li>
        <li id="user_add"><a href="javascript:void(0)">添加会员组</a></li>
    </ul>
<!--    list begin-->
    <div id="users">
        <div class="alert alert-info">
            <strong class="text-danger"><i class="fa fa-info-circle"></i> 会员组的总积分是根据(积分+贡献)的值算出来的,管理员不能直接修改会员所在的会员组. 如果需要修改会员组,请通过设置积分或者贡献的值来影响总积分,系统会根据影响后的总积分自动算出对应的会员组</strong><br>
            <i class="fa fa-info-circle"></i> 默认会员组的积分需设置为 0 <br>
            <i class="fa fa-info-circle"></i> 系统会根据会员的总积分(积分+贡献)多少自动对会员的分组进行调整 <br>
        </div>
        <form action="?r=make/vip_group_list" method="post" id="form1"  class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">会员组变更设置</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员组变更设置</label>
                        <div class="col-sm-9 col-xs-12">
                            <label class="radio-inline">
                                <input type="radio" name="grouplevel" value="1" <?if ($check == 1){ echo 'checked';}?>/>根据总积分多少自动升降
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="grouplevel" value="2" <?if ($check == 2){ echo 'checked';}?>/>根据总积分多少只升不降
                            </label>
                            <span class="help-block">根据积分多少自动升降：<strong class="text-danger">系统根据当前会员的总积分，按照每个会员组所需总积分的设置进行变更。可自动升降会员组</strong></span>
                            <span class="help-block">根据积分多少只升不降：<strong class="text-danger">系统根据当前会员的总积分，如果会员的总积分达到更高一级的会员组，则变更会员组，如果积分少于当前所在会员组所需总积分，保持当前会员组不变，不会降级。</strong></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <thead class="navbar-inner">
                        <tr>
                            <th style="width:250px">会员组名称</th>
                            <th style="width:200px"></th>
                            <th style="width:200px">所需总积分(积分+贡献)</th>
                            <th style="width:200px;text-align: right">会员数</th>
                            <th style="text-align:right">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($group_data as $k=>$v){?>
                            <tr>
                                <td>
                                    <input type="hidden" name="id[<?= $v['id']?>]" value="<?= $v['id']?>">
                                    <input type="text" name="title[<?= $v['id']?>]" class="form-control" value="<?php echo $v['title']?>" />
                                <td>
                                    <span class="label label-info"></span>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="credit[<?= $v['id']?>]"  value="<?php echo $v['credit']?>"  />
                                </td>
                                <td align="right">
                                    <?php echo $v['num']?> 人
                                </td>
                                <td style="text-align:right">
                                    <a href="?r=make/vip_group_del&id=<?= $v['id']?>" onclick="return confirm('确认删除吗？');return false;" title="删除">删除</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                    <input type="submit" class="btn btn-primary col-lg-1" value="提交" />
                </div>
            </div>
        </form>
    </div>
<!--    list end-->
<!--    add begin-->
    <div id="adds"  style="display: none">
        <div class="col-xs-12 col-sm-9 col-lg-10">
            <div class="alert alert-info">
                <strong class="text-danger"><i class="fa fa-info-circle"></i> 会员组的总积分是根据(积分+贡献)的值算出来的,管理员不能直接修改会员所在的会员组. 如果需要修改会员组,请通过设置积分或者贡献的值来影响总积分,系统会根据影响后的总积分自动算出对应的会员组</strong><br>
                <i class="fa fa-info-circle"></i> 默认会员组的积分需设置为 0 <br>
                <i class="fa fa-info-circle"></i> 系统会根据会员的总积分(积分+贡献)多少自动对会员的分组进行调整 <br>
            </div>
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
                        <input type="submit" class="btn btn-primary col-lg-1" onclick="javascript:this.form.action='?r=make/vip_group_add';" value="提交" />
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--    add end-->

</div>
<script>
$(function(){
    $('.up').click(function(){
        var uid = $(this).attr('uid');
        alert(uid)
    })
})
</script>
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
        })
    })
</script>