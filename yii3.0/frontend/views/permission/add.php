<?php

include_once('./pub/top.php');
include_once('./pub/sys_config.php');

?>

<form action="index.php?r=permission/add_do" method="post" class="form-horizontal">
    <div class="panel-body">
        <a href="index.php?r=permission/show"  class="btn btn-primary">查看列表</a>
        <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">
            <span style="color:red">*</span> 权限名称</label>
        <div class="col-sm-9 col-xs-12">
            <input name="action" class="form-control" autocomplete="off" type="text" placeholder="权限名称">
            <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
            <input   value="添加" class="btn btn-primary" type="submit">
        </div>
    </div>
</form>





