<?php
include_once('./pub/top.php');
include_once('./pub/config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
<div class="clearfix">
    <div class="stat">
        <div class="stat-div">
            <div class="panel panel-info">
                <div class="panel-heading">筛选</div>
                <div class="panel-body">
                    <form action="http://wcmall.bj165.com/web/index.php" method="get" class="form-horizontal" role="form">
                        <input type="hidden" name="c" value="platform">
                        <input type="hidden" name="a" value="stat">
                        <input type="hidden" name="do" value="keyword">
                        <input type="hidden" name="foo" value="hit">
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">关键字类型</label>
                            <div class="col-sm-8 col-lg-9 col-xs-12">
                                <div class="btn-group">
                                    <a href="javascript:void" class="btn btn-primary" id="btn1" style="background: #0cbadf">已触发关键字</a>
                                    <a href="javascript:void" class="btn btn-default" id="btn2">未触发关键字</a>
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">日期范围</label>
<!--                            <div class="col-sm-6 col-lg-8 col-xs-12">-->
                                <input name="time1" id="time1" type="text" value="2017-01-01">
                                <input name="time2" id="time2" type="text" value="<?= date('Y-m-d',strtotime("-1 day"))?>">
                                <input type="button" id="search" value="搜索">
                                <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
<!--                                <button class="btn btn-default daterange daterange-date" type="button"><span class="date-title">2017-03-12 至 2017-05-11</span> <i class="fa fa-calendar"></i></button>-->
<!--                            </div>-->
                            <div class="pull-right col-xs-12 col-sm-3 col-lg-2">
<!--                                <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>				<div class="sub-item panel panel-default" id="table-list">
                <div class="panel-heading">
                    详细数据
                </div>
                <div class="sub-content panel-body table-responsive">
                    <table class="table table-hover">
                        <thead class="navbar-inner">
                        <tr>
                            <th style="width:100px;" class="row-hover" >用户</th>
                            <th>关键字</th>
                            <th style="width:150px;">命中次数<i></i></th>
                            <th style="width:150px;">最后触发<i></i></th>
                            <th style="width:100px;">操作</th>
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
</div>
</div>



<script type="text/javascript">
$(function(){
    var _csrf = $('#_csrf').val();
    $('#btn1').click(function(){
        $(this).css({"backgroundColor":"  #0cbadf"});
        $('#btn2').css({"color":" black" ,"backgroundColor":" white"});
        $.ajax({
            type: "POST",
            url: "?r=statistics/keywords",
            data: {status:0,_csrf:_csrf},
            dataType: 'json',
            success: function(msg){
                var html = '<table class="table table-hover"><thead class="navbar-inner"> <tr><th style="width:100px;" class="row-hover" >用户</th> <th>关键字</th> <th style="width:150px;">命中次数<i></i></th> <th style="width:150px;">最后触发<i></i></th> <th style="width:100px;">操作</th> </tr> <div id="html">';
                $.each(msg,function(i,v){
                   html += '<tr>';
                   html += '<td style="width:100px;" class="row-hover">'+v.user_id+'</td><td>'+v.key_name+'</td><td  style="width:150px;">'+v.num+'</td><td  style="width:150px;">'+v.time+'</td><td  style="width:100px;">'+'<a href="javascript:void(0)" class="del" tid="'+v.id+'" status="0">删除记录</a>'+'</td>';
                   html += '</tr>';
                });
                html += '</div> </thead> <tbody> </tbody> </table>';
                $('#html').parent().html(html);
            }
        });
    });

    $('#btn2').click(function(){
        $(this).css({"backgroundColor":"  #0cbadf"});
        $('#btn1').css({"color":" black" ,"backgroundColor":" white"});
        $.ajax({
            type: "POST",
            url: "?r=statistics/keywords",
            data: {status:1,_csrf:_csrf},
            dataType: 'json',
            success: function(msg){
                var html = '<table class="table table-hover"><thead class="navbar-inner"> <tr><th style="width:100px;" class="row-hover" >用户</th> <th>关键字</th> <th style="width:150px;">命中次数<i></i></th> <th style="width:150px;">最后触发<i></i></th> <th style="width:100px;">操作</th> </tr> <div id="html">';
                $.each(msg,function(i,v){
                    html += '<tr>';
                    html += '<td style="width:100px;" class="row-hover">'+v.user_id+'</td><td>'+v.key_name+'</td><td  style="width:150px;">'+v.num+'</td><td  style="width:150px;">'+v.time+'</td><td  style="width:100px;">'+'<a href="javascript:void(0)" class="del" tid="'+v.id+'" status="0">删除记录</a>'+'</td>';
                    html += '</tr>';
                });
                html += '</div> </thead> <tbody> </tbody> </table>';
                $('#html').parent().html(html);
            }
        });
    });

    $('#search').click(function(){
        var timeStart = $('#time1').val();
        var timeEnd = $('#time2').val();
        if(timeStart == '' || timeEnd == ''){
            alert('不允许空值');
            return;
        }
        $.ajax({
            type: "POST",
            url: "?r=statistics/keywords",
            data: {timeStart:timeStart,timeEnd:timeEnd,_csrf:_csrf},
            dataType: 'json',
            success: function(msg){
                if (msg == 5){
                    alert("时间顺序有误");
                } else {
                    var html = '<table class="table table-hover"><thead class="navbar-inner"> <tr><th style="width:100px;" class="row-hover" >用户</th> <th>关键字</th> <th style="width:150px;">命中次数<i></i></th> <th style="width:150px;">最后触发<i></i></th> <th style="width:100px;">操作</th> </tr> <div id="html">';
                    $.each(msg,function(i,v){
                        html += '<tr>';
                        html += '<td style="width:100px;" class="row-hover">'+v.user_id+'</td><td>'+v.key_name+'</td><td  style="width:150px;">'+v.num+'</td><td  style="width:150px;">'+v.time+'</td><td  style="width:100px;">'+'<a href="#" class="del" tid="'+v.id+'"  status="1">删除记录</a>'+'</td>';
                        html += '</tr>';
                    });
                    html += '</div> </thead> <tbody> </tbody> </table>';
                    $('#html').parent().html(html);
                }
            }
        });
    })

    $(document).on('click','.del',function(){
        var id = $(this).attr('tid');
        var status = $(this).attr('status');
        var _csrf = $('#_csrf').val();
        $.ajax({
            type: "POST",
            url: "?r=statistics/keywords-del",
            data: {id:id,_csrf:_csrf,status:status},
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