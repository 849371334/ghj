<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<!-- 会员list begin -->

<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li id="user_list" ><a href="?r=make/vip_status">字段管理</a></li>
        <li id="user_add" class="active" ><a href="javascript:void(0)">字段编辑</a></li>
    </ul>
    <div id='users' >
        <div class="panel panel-info">
            <div class="panel-heading">字段</div>
            <div class="panel-body">
                <form  action="?r=make/vip_status_change" name="a1" method="post" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <input type="text" name="sort" id="sort" class="form-control"  value="<?=$data['sort']?>">
                            <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                            <input type="hidden" name="id"  value="<?=$data['id']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">字段</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <input type="text" class="form-control" name="field" value="<?= $data['field']?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">标题</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <input type="text" class="form-control" name="title" value="<?= $data['title']?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否启用</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <select name="is_enable" class="form-control">
                                <option value="1" <?if($data['is_enable'] == 1){echo 'selected';}?>>是</option>
                                <option value="0" <?if($data['is_enable'] == 0){echo 'selected';}?>>否</option>
                            </select>
                        </div>
                        <div class="pull-right col-xs-12 col-sm-3 col-md-2 col-lg-2">
                            <button class="btn btn-default" id="button"><i class="fa fa-search"></i> 提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>