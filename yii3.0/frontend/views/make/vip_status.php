<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active" id="status_list" ><a href="javascript:void(0)">字段管理</a></li>
        <li id="status_add"><a href="javascript:void(0)">添加字段</a></li>
    </ul>

    <div id="users">
    <form action="" method="post">
        <div class="panel panel-default">
            <div class="panel-heading">
                字段管理
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <th>排序</th>
                        <th>字段</th>
                        <th>标题</th>
                        <th>是否启用</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($config as $k => $v){ ?>
                    <tr>
                        <td>
                            <?= $v['sort']?>
                        </td>
                        <td><?= $v['field']?></td>
                        <td><?= $v['title']?></td>
                        <td>
                            <? if($v['is_enable'] == 1){ echo '是';} else { echo '否'; }?>
                        </td>
                        <td>
                            <a href="?r=make/vip_status_change&id=<?=$v['id']?>" title="编辑" class="btn btn-primary btn-sm">编辑</a>
                            <a href="?r=make/vip_status_del&id=<?=$v['id']?>" title="删除" class="btn btn-primary btn-sm" >删除</a>
                        </td>
                    </tr>
                    <? } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="adds" style="display:none;">
        <form action="" name="a2" method="post" class="form-horizontal" role="form" id="form1">
            <div class="panel panel-info">
                <div class="panel-heading">添加字段</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="sort" value="" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">字段</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="field" value="" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">标题</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="title" value="" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否启用</label>
                        <div class="col-sm-9 col-xs-12">
                            <select name="is_enable" class="form-control">
                                <option value="1">是</option>
                                <option value="1" selected>否</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-xs-12">
                    <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                    <input type="submit" onclick="javascript:this.form.action='?r=make/vip_status_add';" value="提交" class="btn btn-primary"/>
                </div>
            </div>
        </form>
    </div>

</div>
<script>
$(function(){
    $('#status_list').click(function(){
        $('#users').show();
        $('#adds').hide();
        $(this).addClass('active');
        $('#status_add').removeClass('active');
    });

    $('#status_add').click(function(){
        $('#adds').show();
        $('#users').hide();
        $(this).addClass('active');
        $('#status_list').removeClass('active');
    });
})
</script>
