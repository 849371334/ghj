<?php
include_once('./pub/top.php');
include_once('./pub/sys_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
<!--    begin-->
<!--<script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery" src="./public/service/jquery-1.11.1.min(1).js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="bootstrap" src="./public/service/bootstrap.min.js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="css" src="./public/service/css.min.js"></script><link type="text/css" rel="stylesheet" href="./public/service/bootstrap-switch.min.css"><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="bootstrap.switch" src="./public/service/bootstrap-switch.min.js"></script>-->

    </div>
    <div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="http://wcmall.bj165.com/web/index.php?c=platform&amp;a=service&amp;do=switch&amp;">常用服务接入</a></li>
    </ul>
    <div class="table-responsive panel-body">
        <table class="table table-hover">
            <thead class="navbar-inner">
            <tr>
                <th style="width:100px;">服务名称</th>
                <th style="width:200px;">功能说明</th>
                <th style="width:120px;">状态</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>城市天气</td>
                <td>"城市名+天气", 如: "北京天气"</td>
                <td>
                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-animate"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-primary"></span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default"></span><input type="checkbox" class="ckeck" value="1" <?php if($data['1']==1){ echo 'checked'; }  ?> ></div></div>
                </td>
            </tr>
            <tr>
                <td>百度百科</td>
                <td>"百科+查询内容" 或 "定义+查询内容", 如: "百科姚明", "定义自行车"</td>
                <td>
                    <div id="dis" class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-animate"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-primary"></span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default"></span><input type="checkbox" class="ckeck"  value="2" <?php if($data['2']==1){ echo 'checked'; }  ?> disabled ></div></div>
                </td>
            </tr>
            <tr>
                <td>即时翻译</td>
                <td>"@查询内容(中文或英文)"</td>
                <td>
                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-animate"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-primary"></span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default"></span><input type="checkbox" class="ckeck"  value="3" <?php if($data['3']==1){ echo 'checked'; }  ?> ></div></div>
                </td>
            </tr>
            <tr>
                <td>今日老黄历</td>
                <td>"日历", "万年历", "黄历"或"几号"</td>
                <td>
                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-animate"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-primary"></span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default"></span><input type="checkbox" class="ckeck"  value="4" <?php if($data['4']==1){ echo 'checked'; }  ?> ></div></div>
                </td>
            </tr>
            <tr>
                <td>看新闻</td>
                <td>"新闻"</td>
                <td>
                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-animate"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-primary"></span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default"></span><input type="checkbox" class="ckeck"  value="5" <?php if($data['5']==1){ echo 'checked'; }  ?> ></div></div>
                </td>
            </tr>
            <tr>
                <td>快递查询</td>
                <td>"快递+单号", 如: "申通1200041125"</td>
                <td>
                    <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-animate"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-primary"></span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default"></span><input type="checkbox" class="check"  value="6"  <?php if($data['6']==1){ echo 'checked'; }  ?> ></div></div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

<!--end-->
<script>
$(function(){
    $(":checkbox").change(function () {
        var val = $(this).val();
        var _csrf = $('#_csrf').val();
        if($(this).is(':checked')){
            $.ajax({
                type: "POST",
                url: "?r=setting/service",
                data: {val:val,status:1,_csrf:_csrf},
                success: function(msg){
                    log(msg);
                }
            });
        }else{
            $.ajax({
                type: "POST",
                url: "?r=setting/service",
                data: {val:val,status:0,_csrf:_csrf},
                success: function(msg){
                    log(msg);
                }
            });
        }
    });

    $('#dis').click(function(){
        alert('此服务暂不可用，给你带来的不便请您谅解');
    });

    function log(msg){
        if(msg == 5){
            alert('您还未登陆，请先登录');
            location.href='?r=user/login';
        }
    }
})
</script>
</div>
