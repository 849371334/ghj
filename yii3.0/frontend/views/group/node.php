<?php

include_once('./pub/top.php');
include_once('./pub/sys_config.php');

?>

<form action="index.php?r=group/node2" method="post" class="form-horizontal">
    <div class="panel-body">
        <a href="index.php?r=group/show"  class="btn btn-primary">查看列表</a>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">
            <span style="color:red">*</span> 用户组</label>
        <div class="col-sm-9 col-xs-12">
            <input name="group_name" class="form-control" autocomplete="off" type="text" value="<?php echo $arr['group_name']?>" disabled>
            <input type="hidden" name="group_id" value="<?php echo $arr['id']?>">
            <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>

            <span style="color:red">*</span> <b>分配权限</b>
            <ol>
                <?php  foreach ($node as $k=>$v){?>
                    <li><input type="checkbox" value="<?php echo $v['id']?>" name="pid[]"><?php echo $v['action'] ;?></li>
                <?php }?>
            </ol>
            <input   value="修改" class="btn btn-primary" type="submit">
        </div>
    </div>
</form>





