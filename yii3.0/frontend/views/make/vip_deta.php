<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <style>
        .account-stat-num > div{width:25%; float:left; font-size:16px; text-align:center;}
        .account-stat-num > div span{display:block; font-size:30px; font-weight:bold;}
    </style>
    <ul class="nav nav-tabs">
        <li id="balance_a" class="active"><a href="javascript:void(0)">余额统计</a></li>
        <li id="integral_a" ><a href="javascript:void(0)">积分统计</a></li>
        <li id="cash_a"><a href="javascript:void(0)">现金统计</a></li>
        <li id="balance_sa"><a href="javascript:void(0)">余额明细</a></li>
        <li id="integral_sa"><a href="javascript:void(0)">积分明细</a></li>
        <li id="cash_sa"><a href="javascript:void(0)">现金明细</a></li>
    </ul>

    <div id="balance" style="display: none">

    <div class="panel panel-default">
        <div class="panel-heading">
            余额统计
        </div>
        <div class="panel-body">
            <div class="account-stat-num row">
                <div>今日充值总额<span>0</span></div>
                <div>今日消费总额<span>0</span></div>
                <div>2017-05-01~2017-05-26<br>充值总额<span>0</span></div>
                <div>2017-05-01~2017-05-26<br>消费总额<span>0</span></div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            统计
        </div>
        <div class="panel-body" id="scroll">
            <div class="pull-left">
<!--                <form action="" id="form1">-->
<!--                    <input name="time[start]" type="hidden" value="2017-05-01" />-->
<!--                    <input name="time[end]" type="hidden" value="2017-05-26" />-->
<!--                    <button class="btn btn-default daterange daterange-date" type="button"><span class="date-title">2017-05-01 至 2017-05-26</span> <i class="fa fa-calendar"></i></button>-->
<!--                    <input type="hidden" value="" name="scroll">-->
<!--                </form>-->
            </div>
            <div class="pull-right">
                <div class="checkbox">
                    <label style="color:rgba(149,192,0,1);;"><input checked type="checkbox"> 充值统计</label>&nbsp;
                    <label style="color:rgba(203,48,48,1)"><input checked type="checkbox"> 消费统计</label>&nbsp;
                </div>
            </div>
            <div style="margin-top:20px">
                <canvas id="myChart" width="1200" height="300"></canvas>
            </div>
        </div>
    </div>
    </div>

    <div id="integral"  style="display: none">
        <div class="panel panel-default">
            <div class="panel-heading">
                积分统计
            </div>
            <div class="panel-body">
                <div class="account-stat-num row">
                    <div>今日充值总额<span>0</span></div>
                    <div>今日消费总额<span>0</span></div>
                    <div>2017-05-01~2017-05-26<br>充值总额<span>0</span></div>
                    <div>2017-05-01~2017-05-26<br>消费总额<span>0</span></div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                统计
            </div>
            <div class="panel-body" id="scroll">
                <div class="pull-left">
<!--                    <form action="" id="form1">-->
<!--                        <input name="time[start]" type="hidden" value="2017-05-01" />-->
<!--                        <input name="time[end]" type="hidden" value="2017-05-26" />-->
<!--                        <button class="btn btn-default daterange daterange-date" type="button"><span class="date-title">2017-05-01 至 2017-05-26</span> <i class="fa fa-calendar"></i></button>-->
<!--                        <input type="hidden" value="" name="scroll">-->
<!--                    </form>-->
                </div>
                <div class="pull-right">
                    <div class="checkbox">
                        <label style="color:rgba(149,192,0,1);;"><input checked type="checkbox"> 充值统计</label>&nbsp;
                        <label style="color:rgba(203,48,48,1)"><input checked type="checkbox"> 消费统计</label>&nbsp;
                    </div>
                </div>
                <div style="margin-top:20px">
                    <canvas id="myChart" width="1200" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div id="cash" style="display: none">
        <div class="panel panel-default">
            <div class="panel-heading">
                现金统计
            </div>
            <div class="panel-body">
                <div class="account-stat-num row">
                    <div style="width:50%">今日消费总额<span>0</span></div>
                    <div style="width:50%">2017-05-01~2017-05-26<br>消费总额<span>0</span></div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                统计
            </div>
            <div class="panel-body" id="scroll">
                <div class="pull-left">
<!--                    <form action="" id="form1">-->
<!--                        <input name="time[start]" type="hidden" value="2017-05-01" />-->
<!--                        <input name="time[end]" type="hidden" value="2017-05-26" />-->
<!--                        <button class="btn btn-default daterange daterange-date" type="button"><span class="date-title">2017-05-01 至 2017-05-26</span> <i class="fa fa-calendar"></i></button>-->
<!--                        <input type="hidden" value="" name="scroll">-->
<!--                    </form>-->
                </div>
                <div class="pull-right">
                    <div class="checkbox">
                        <label style="color:rgba(203,48,48,1)"><input checked type="checkbox"> 消费统计</label>&nbsp;
                    </div>
                </div>
                <div style="margin-top:20px">
                    <canvas id="myChart" width="1200" height="300"></canvas>
                </div>
            </div>
        </div>


    </div>

    <div id="balance_s" style="display: none" >
        <div class="panel panel-info">
            <div class="panel-heading">筛选</div>
            <div class="panel-body">
                <form action="" method="get" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">类型</label>
                        <div class="col-sm-8 col-lg-9 col-xs-12">
                            <div class="btn-group">
                                <a href="javascript:void(0)" class="btn btn-primary">不限</a>
                                <a href="javascript:void(0)" class="btn btn-default">充值</a>
                                <a href="javascript:void(0)" class="btn btn-default">消费</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">消费时间</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <input name="time[start]" type="hidden" value="2017-05-01" />
                            <input name="time[end]" type="hidden" value="2017-05-26" />
                            <button class="btn btn-default daterange daterange-date" type="button"><span class="date-title">2017-05-01 至 2017-05-26</span> <i class="fa fa-calendar"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名/手机号码/UID</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <input type="text" class="form-control" name="user" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分/金额/实收</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <div class="input-group">
                                <input type="text" class="form-control" name="min" value="" />
                                <span class="input-group-addon">至</span>
                                <input type="text" class="form-control" name="max" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                        <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                            <button class="btn btn-default" disabled><i class="fa fa-search"></i> 搜索</button>
                            <input type="hidden" name="token" value="196752ed"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" class="form-horizontal" id="form1">
            <div class="panel panel-default ">
                <div class="table-responsive panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width:80px;">会员编号</th>
                            <th>姓名</th>
                            <th>手机</th>
                            <th>类型</th>
                            <th>金额</th>
                            <th width="200">消费门店</th>
                            <th>操作人</th>
                            <th>操作时间</th>
                            <th width="400">备注</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <div id="integral_s" style="display:none;">
        <div class="panel panel-info">
            <div class="panel-heading">筛选</div>
            <div class="panel-body">
                <form action="" method="post" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">类型</label>
                        <div class="col-sm-8 col-lg-9 col-xs-12">
                            <div class="btn-group">
                                <a href="javascript:void(0)" class="btn btn-primary">不限</a>
                                <a href="javascript:void(0)" class="btn btn-default">充值</a>
                                <a href="javascript:void(0)" class="btn btn-default">消费</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名/手机号码/UID</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <input type="text" class="form-control" name="user" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分/金额/实收</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <div class="input-group">
                                <input type="text" class="form-control" name="min" value="" />
                                <span class="input-group-addon">至</span>
                                <input type="text" class="form-control" name="max" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">消费时间</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <input name="time[start]" type="hidden" value="2017-05-01" />
                            <input name="time[end]" type="hidden" value="2017-05-26" />
                            <button class="btn btn-default daterange daterange-date" type="button"><span class="date-title">2017-05-01 至 2017-05-26</span> <i class="fa fa-calendar"></i></button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                        <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                            <button class="btn btn-default" disabled >搜索</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" class="form-horizontal" id="form1">
            <div class="panel panel-default ">
                <div class="table-responsive panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width:80px;">会员编号</th>
                            <th>姓名</th>
                            <th>手机</th>
                            <th>类型</th>
                            <th>金额</th>
                            <th width="200">消费门店</th>
                            <th>操作人</th>
                            <th>操作时间</th>
                            <th width="400">备注</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
    <div id="cash_s">
        <div class="panel panel-info">
            <div class="panel-heading">筛选</div>
            <div class="panel-body">
                <form action="" method="get" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">消费时间</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <input name="time[start]" type="hidden" value="2017-05-01" />
                            <input name="time[end]" type="hidden" value="2017-05-26" />
                            <button class="btn btn-default daterange daterange-date" type="button"><span class="date-title">2017-05-01 至 2017-05-26</span> <i class="fa fa-calendar"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名/手机号码/UID</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <input type="text" class="form-control" name="user" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分/金额/实收</label>
                        <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                            <div class="input-group">
                                <input type="text" class="form-control" name="min" value="" />
                                <span class="input-group-addon">至</span>
                                <input type="text" class="form-control" name="max" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                        <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                            <button class="btn btn-default" disabled><i class="fa fa-search"></i> 搜索</button>
                            <input type="hidden" name="token" value="196752ed"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" class="form-horizontal" id="form1">
            <div class="panel panel-default ">
                <div class="table-responsive panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width:80px;">会员编号</th>
                            <th>姓名</th>
                            <th>手机</th>
                            <th>消费金额</th>
                            <th>实收金额</th>
                            <th>余额支付</th>
                            <th>积分抵消</th>
                            <th>实收现金</th>
                            <th>消费门店</th>
                            <th>操作人</th>
                            <th width="150">操作时间</th>
                            <th width="400">备注</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
$(function(){
    $('#balance_a').click(function(){
        $('#balance').show();
        $('#balance_s').hide();
        $('#integral').hide();
        $('#integral_s').hide();
        $('#cash').hide();
        $('#cash_s').hide();
        $(this).addClass('active');
        $('#balance_sa').removeClass('active');
        $('#integral_a').removeClass('active');
        $('#integral_sa').removeClass('active');
        $('#cash_a').removeClass('active');
        $('#cash_sa').removeClass('active');
    });
    $('#balance_sa').click(function(){
        $('#balance_s').show();
        $('#balance').hide();
        $('#integral').hide();
        $('#integral_s').hide();
        $('#cash').hide();
        $('#cash_s').hide();
        $(this).addClass('active');
        $('#balance_a').removeClass('active');
        $('#integral_a').removeClass('active');
        $('#integral_sa').removeClass('active');
        $('#cash_a').removeClass('active');
        $('#cash_sa').removeClass('active');
    });
    $('#integral_a').click(function(){
        $('#integral').show();
        $('#balance_s').hide();
        $('#balance').hide();
        $('#integral_s').hide();
        $('#cash').hide();
        $('#cash_s').hide();
        $(this).addClass('active');
        $('#balance_sa').removeClass('active');
        $('#balance_a').removeClass('active');
        $('#integral_sa').removeClass('active');
        $('#cash_a').removeClass('active');
        $('#cash_sa').removeClass('active');
    });
    $('#integral_sa').click(function(){
        $('#integral_s').show();
        $('#balance_s').hide();
        $('#integral').hide();
        $('#balance').hide();
        $('#cash').hide();
        $('#cash_s').hide();
        $(this).addClass('active');
        $('#balance_sa').removeClass('active');
        $('#integral_a').removeClass('active');
        $('#balance_a').removeClass('active');
        $('#cash_a').removeClass('active');
        $('#cash_sa').removeClass('active');
    });
    $('#cash_a').click(function(){
        $('#cash').show();
        $('#balance_s').hide();
        $('#integral').hide();
        $('#integral_s').hide();
        $('#balance').hide();
        $('#cash_s').hide();
        $(this).addClass('active');
        $('#balance_sa').removeClass('active');
        $('#integral_a').removeClass('active');
        $('#integral_sa').removeClass('active');
        $('#balance_a').removeClass('active');
        $('#cash_sa').removeClass('active');
    });
    $('#cash_sa').click(function(){
        $('#balance').hide();
        $('#balance_s').hide();
        $('#integral').hide();
        $('#integral_s').hide();
        $('#cash').hide();
        $('#cash_s').show();
        $(this).addClass('active');
        $('#balance_sa').removeClass('active');
        $('#integral_a').removeClass('active');
        $('#integral_sa').removeClass('active');
        $('#cash_a').removeClass('active');
        $('#balance_a').removeClass('active');
    })
});
</script>