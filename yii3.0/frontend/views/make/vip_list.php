<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="./index.php?r=make/vip_list">会员列表</a></li>
        <li ><a href="./index.php?r=make/vip_add">添加会员</a></li>
    </ul>
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="mc">
                <input type="hidden" name="a" value="member">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">注册时间</label>
                    <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">

                        <script type="text/javascript">
                            require(["daterangepicker"], function($){
                                $(function(){
                                    $(".daterange.daterange-date").each(function(){
                                        var elm = this;
                                        $(this).daterangepicker({
                                            startDate: $(elm).prev().prev().val(),
                                            endDate: $(elm).prev().val(),
                                            format: "YYYY-MM-DD"
                                        }, function(start, end){
                                            $(elm).find(".date-title").html(start.toDateStr() + " 至 " + end.toDateStr());
                                            $(elm).prev().prev().val(start.toDateStr());
                                            $(elm).prev().val(end.toDateStr());
                                        });
                                    });
                                });
                            });
                        </script>

                        <input name="createtime[start]" type="hidden" value="2017-02-15" />
                        <input name="createtime[end]" type="hidden" value="2017-05-17" />
                        <button class="btn btn-default daterange daterange-date" type="button"><span class="date-title">2017-02-15 至 2017-05-17</span> <i class="fa fa-calendar"></i></button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">昵称/姓名/手机号码</label>
                    <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                        <input type="text" class="form-control" name="username" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">所属用户组</label>
                    <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                        <select name="groupid" class="form-control">
                            <option value="" selected="selected">不限</option>
                            <option value="26">默认会员组</option>
                        </select>
                    </div>
                    <div class="pull-right col-xs-12 col-sm-3 col-md-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                        <input type="hidden" name="token" value="196752ed"/>
                        <input class="btn btn-primary" type="submit" name="export_submit" id="export_submit" value="导出">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="alert alert-info">
        <i class="fa fa-info-circle"></i> 当前会员总数:<strong class="text-danger">1</strong>。今日新增会员:<strong class="text-danger">0</strong>。<br>
        <strong class="text-danger">
            <i class="fa fa-info-circle"></i> 会员的总积分 = 账户积分 + 账户贡献. 会员所在的会员组是根据 "总积分的多少" 和 "会员组的变更规则" (<根据总积分多少自动升价> 或 <根据总积分多少只升不降>) 自动匹配.<br>
        </strong>
    </div>
    <form method="post" class="form-horizontal" id="form1">
        <div class="panel panel-default ">
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <input type="hidden" name="do" value="del" />
                    <thead class="navbar-inner">
                    <tr>
                        <th style="width:44px;">删?</th>
                        <th style="width:80px;">会员编号</th>
                        <th style="width:150px;">昵称/真实姓名</th>
                        <th style="min-width:100px;">手机</th>
                        <th style="min-width:100px;">邮箱</th>
                        <th>余额/积分</th>
                        <th style="min-width:90px;">注册时间</th>
                        <th style="width:410px;text-align:right">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="checkbox" name="uid[]" value="87" class=""></td>
                        <td>87</td>
                        <td>
                            未完善					<br>
                            未完善				</td>
                        <td>未完善</td>
                        <td>25e5f0929d1dfc73a45973f2480a6828@bj165.com</td>
                        <td>
                            <span class="label label-primary">余额：0.00</span>
                            <br>
                            <span class="label label-warning">积分：0.00</span>
                        </td>
                        <td>2017-05-15 09:51</td>
                        <td class="text-right" style="overflow:visible;">
                            <div class="btn-group">
                                
                                <a href="javascript:;" title="积分" class="btn btn-default modal-trade" data-type="credit1" data-uid="87">积分</a>
                                <a href="javascript:;" title="余额" class="btn btn-default modal-trade" data-type="credit2" data-uid="87">余额</a>
                                <a href="javascript:;" title="消费" class="btn btn-default modal-trade" data-type="consume" data-uid="87">消费</a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        默认会员组						<span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                    </ul>
                                </div>
                                <a href="./index.php?c=mc&a=member&do=post&uid=87" title="编辑" class="btn btn-default">编辑</a>
                                <a href="./index.php?c=mc&a=creditmanage&keyword=87&type=1" title="积分" target="_blank" class="btn btn-success">积分</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});"></td>
                        <input name="token" type="hidden" value="196752ed" />
                        <td colspan="7"><input type="submit" name="submit" class="btn btn-primary" value="删除"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
    <script>
        require(['trade', 'bootstrap'], function(trade){
            trade.init();

            $('#form1').submit(function(){
                if($(":checkbox[name='uid[]']:checked").size() > 0){
                    return confirm('删除后不可恢复，您确定删除吗？');
                }
                util.message('没有选择会员', '', 'error');
                return false;
            });

            $('.user-group').click(function(){
                if(!confirm('确定更改会员组吗')) return false;
                var id = $(this).data('id');
                var uid = $(this).data('uid');
                $.post("./index.php?c=mc&a=member&do=group&", {uid: uid, id: id}, function(data){
                    if(data != 'success') {
                        util.message(data, '', 'error');
                    } else {
                        location.reload();
                    }
                });
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

