<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/wx_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="./index.php?r=wsite/cate_list">分类列表</a></li>
        <li ><a href="./index.php?r=wsite/cate_add">分类添加</a></li>
    </ul>
    <div class="main">
        <div class="category">
            <form action="" method="post" onsubmit="return formcheck(this)">
                <div class="panel panel-default">
                    <div class="panel-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width:5%; text-align:center;">显示顺序</th>
                                <th style="width:25%;">分类名称</th>
                                <th style="width:5%; text-align:center;">设为栏目</th>
                                <th style="width:15%; text-align:center">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="4">
                                    <a href="./index.php?r=wsite/cate_add"><i class="fa fa-plus-circle" title="添加新分类"></i> 添加新分类</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <input name="submit" type="submit" class="btn btn-primary col-lg-1" value="提交">
                    <input type="hidden" name="token" value="196752ed" />
                </div>
            </form>
        </div>
    </div>
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