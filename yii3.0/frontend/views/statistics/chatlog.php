<?php
include_once('./pub/top.php');
include_once('./pub/config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
<div class="col-xs-12 col-sm-9 col-lg-10">
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="#" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="platform">
                <input type="hidden" name="a" value="stat">
                <input type="hidden" name="do" value="history">
                <input type="hidden" name="searchtype" value="">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">规则类型</label>
                    <div class="col-sm-8 col-lg-9 col-xs-12">
                        <div class="btn-group">
                            <a href="#" class="btn btn-primary" disabled="">不限</a>
                            <a href="#" class="btn btn-default" disabled="">已有规则回复</a>
                            <a href="#" class="btn btn-default" disabled="">默认规则回复</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">内容关键字</label>
                    <div class="col-sm-6 col-lg-8 col-xs-12">
                        <input type="text" name="keyword" class="form-control" id="keyword" value="" placeholder="请输入内容关键字">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">日期范围</label>
                    <div class="col-sm-6 col-xs-12 col-lg-8 col-xs-12">
                        <input name="time1" type="text" id="time1" value="2017-01-01">
                        <input name="time2" type="text" id="time2" value="<?= date('Y-m-d',strtotime("-1 day"))?>">
                        <input type="button" id="search" value="搜索">
                        <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            详细数据
        </div>
        <div class="table-responsive panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th style="width:10%;">用户</th>
                    <th style="width:20%;">所属公众号</th>
                    <th style="width:40%;">内容</th>
                    <th style="width:10%;">时间</th>
                    <th style="width:20%;">操作</th>
                </tr>
                <div id="html">

                </div>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!--<form action="https://api.weixin.qq.com/datacube/getupstreammsgdistmonth" method="post">-->
<!--    <input type="tex//t" name="begin_date" value="20170401000000">-->
<!--    <input type="text" name="end_date" value="20170430000000">-->
<!--    <input type="text" name="access_token" value="ypTj0H8uysvrNmLDDh9fDb5_Z9bnxCcqWPuQ0lS5c5vqzO9vi1aVmQYel7_M503_3Q4dUM8kaEWZvpvHgyqItxq4W0_mjPxI2ekN83vPQm38TaHx_AfkXjXsKYNwIk1CWRUaAAAIDG">-->
<!--    <input type="submit" value="提交">-->
<!--</form>-->
<script>
$(function(){
    $('#search').click(function(){
        var timeStart = $('#time1').val();
        var timeEnd = $('#time2').val();
        var keyword = $('#keyword').val();
        var _csrf = $('#_csrf').val();
        if(timeStart == '' || timeEnd == ''){
            alert('时间不允许空值');
            return;
        }
        $.ajax({
            type: "POST",
            url: "?r=statistics/chatlog",
            data: {timeStart:timeStart,timeEnd:timeEnd,_csrf:_csrf,keyword:keyword},
            dataType: 'json',
            success: function(msg){
                switch (true){
                    case msg == 3:
                        alert('非法操作');
                        return;
                    case msg == 5:
                        alert('时间顺序有误');
                        return;
                    case $.isEmptyObject(msg) == true:
                        alert('没有此条件数据,是不是没登录？');
                        return;
                    default:
                        var html = '<table class="table table-hover"> <thead> <tr>  <th style="width:10%;">用户</th> <th style="width:20%;">所属公众号</th> <th style="width:40%;">内容</th> <th style="width:20%;">时间</th> <th style="width:10%;">操作</th> </tr> <div id="html">';
                        $.each(msg,function(i,v){
                            html += '<tr>';
                            html += '<th style="width:10%;">'+v.user_id+'</th> <th style="width:20%;">'+v.public_id+'</th> <th style="width:40%;">'+v.record+'</th> <th style="width:10%;">'+v.r_time+'</th> <th style="width:20%;"><a href="javascript:void(0)" class="del" tid="'+v.id+'">删除</a></th>';
                            html += '</tr>';
                        });
                        html += '</div> </thead> <tbody> </tbody> </table>';
                        $('#html').parent().html(html);
                }
            }
        });
    });

    $(document).on('click','.del',function(){
        var id = $(this).attr('tid');
        var _csrf = $('#_csrf').val();
        $.ajax({
            type: "POST",
            url: "?r=statistics/chatlog-del",
            data: {id:id,_csrf:_csrf},
            success: function(msg){
                if (msg == 0){
                    alert("删除失败，请重试");
                } else {
                     location.reload();
                }
            }
        });
    })
})
</script>



