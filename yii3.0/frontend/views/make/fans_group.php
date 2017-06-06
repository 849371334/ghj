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
       
        <form action="index.php?r=make/group_add" method="post" id="form2">
            <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
<!--            <div class="panel panel-default">-->
<!--                <div class="panel-body table-responsive">-->
                    <table class="table table-hover" ng-controller="advAPI" style="width:100%;" cellspacing="0" cellpadding="0">
<!--                        <thead class="navbar-inner">-->
<!--                        <tr>-->
<!--                            <th width="20%">分组名称</th>-->
<!--                            <th width="20%"></th>-->
<!--                            <th width="20%">分组id</th>-->
<!--                            <th width="20%">分组内用户数量</th>-->
<!--                            <th width="20%">操作</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
                        <tbody>
<!--                        <tr>-->
<!--                            <input type="hidden" name="groupid[]" value="2">-->
<!--                            <input type="hidden" name="count[]" value="0">-->
<!--                            <td><input type="text" class="form-control" style="width:250px;" name="groupname[]" value="星标组" readonly></td>-->
<!--                            <td class="text-left"><span class="label label-danger">系统分组,不能修改</span></td>-->
<!--                            <td>2</td>-->
<!--                            <td>0</td>-->
<!--                            <td>-->
<!--                            </td>-->
<!--                        </tr>-->
                        <tr id="position">
                            <td colspan="5"><a href="javascript:;" id="addgroup"><i class="fa fa-plus-circle" ></i> 添加新分组</a></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <input type="submit" class="btn btn-primary span2" name="submit" value="保存" /> &nbsp;
                            </td>
                        </tr>
                        </tbody>
                    </table>
<!--                </div>-->
<!--            </div>-->
        </form>
    </div>
    <script>
        $('#addgroup').click(function(){
            var html = '<tr>' +
                '<td colspan="5">' +
                '<input type="text" class="form-control" style="width:250px;display:inline-block" name="group_name[]" value="" placeholder="请填写分组名称">' +
                ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="$(this).parent().parent().remove()"><i class="fa fa-times-circle"></i></a>' +
                '</td>' +
                '</tr>';

            $('#position').before(html);
        });
//        $(document).on("blur","#group_add",function () {
//          var group_name = $(this).val();
//          var _csrf = $("#_csrf").val();
//            $.post("index.php?r=make/group_add",
//                {group_name:group_name,_csrf:_csrf},
//                function(data){
//                    alert("Data Loaded: " + data);
//                });
//        })
        $('.del-group').click(function(){
            if(!confirm('删除分组后，所有该分组内的用户自动进入默认分组，确定删除该分组吗')) {
                return false;
            }
            var id = parseInt($(this).attr('data-id'));
            $.post("./index.php?c=mc&a=fangroup&do=del&", {'id':id}, function(data){
                var data = $.parseJSON(data);
                if(data.errno < 0) {
                    util.message(data.message, '', 'error');
                    return false;
                } else {
                    location.reload();
                }
            });
        });
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

