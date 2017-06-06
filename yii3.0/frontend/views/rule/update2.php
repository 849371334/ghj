<?php

include_once('./pub/top.php');
include_once('./pub/sys_config.php');

?>

<form action="index.php?r=rule/update_limit" method="post" class="form-horizontal">
    <div class="panel-body">
        <a href="index.php?r=rule/show"  class="btn btn-primary">查看列表</a>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">
            <span style="color:red">*</span> 用户名</label>
        <div class="col-sm-9 col-xs-12">
            <input name="username" class="form-control" autocomplete="off" type="text" value="<?php echo $name?>" disabled>
            <input type="hidden" name="uid" value="<?php echo $id?>">
            <span style="color:red">*</span> <b>分配权限</b>
            <ol>
                <?php  foreach ($arr as $k=>$v){?>
                    <li><input type="radio" value="<?php echo $v['id']?>" name="gid"><?php echo $v['group_name'] ;?></li>
                <?php }?>
            </ol>
            <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
            <input   value="修改" class="btn btn-primary" type="submit">
        </div>
    </div>
</form>





