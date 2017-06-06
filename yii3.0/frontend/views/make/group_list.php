<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="./index.php?r=make/fans_group">分组添加</a></li>
        <li class="active"><a href="./index.php?r=make/group_list">分组列表</a></li>
    </ul>
    <div class="clearfix">
                 <div class="panel panel-default">
             <div class="panel-body table-responsive">
            <table class="table table-hover" ng-controller="advAPI" style="width:100%;" cellspacing="0" cellpadding="0">
                                        <thead class="navbar-inner">
                                        <tr>
                                            <th width="20%">分组名称</th>
                                            <th width="20%"></th>
                                            <th width="20%">分组id</th>
                                            <th width="20%">分组内用户数量</th>
                                            <th width="20%">操作</th>
                                        </tr>
                                        </thead>
                                        <?php foreach ($group_query as $k=>$v){?>
                                    　　<tbody>
                                            <tr>
                                            <td><input type="text" class="form-control" style="width:250px;" name="groupname[]" value="<?php echo $v['group_name']?>" readonly></td>
                                            <td class="text-left"><span class="label label-danger">系统分组,不能修改</span></td>
                                            <td><?php echo $v['group_id']?></td>
                                            <td><?php echo $v['group_num']?></td>
                                            <td>
                                                <a href="javascript:;" class="del" group_id="<?php echo $v['group_id']?>">DEL</a></td>
                                            </tr>
                                            <?php } ?>
                                    　　</tbody>
            </table>
                            </div>
                        </div>
    </div>
    <script>
        $(".del").click(function () {
            var group_id = $(this).attr('group_id');
            $.get("index.php?r=make/group_del",
                {group_id:group_id},
                function(data){
                    if(data==1)
                    {
                        location.reload();
                    }else
                        {
                            alert("删除失败");
                            location.reload();
                        }
                });
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

