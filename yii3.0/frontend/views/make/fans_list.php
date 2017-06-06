<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="./index.php?r=make/fans_list">粉丝列表</a></li>
    </ul>
    <script type="text/javascript">
        var running = false;
        window.onbeforeunload = function(e) {
            if(running) {
                return (e || window.event).returnValue = '正在进行粉丝数据同步中, 离开此页面将会中断操作.';
            }
        }

        require(['angular'], function(angular){
            $('#form1').submit(function(){
                if($(":checkbox[name='delete[]']:checked").size() > 0){
                    return confirm('删除后不可恢复，您确定删除吗？');
                }
                alert('没有选择粉丝');
                return false;
            });
            angular.module('app', []).controller('advAPI', function($scope, $http) {
                $scope.adv = {
                    running : false,
                    syncState : '',
                    downloadState : '',
                    enabled : false			};
                $scope.sync = function(){
                    if($(":checkbox:checked").size() <= 0){
                        alert('没有选择粉丝');
                        return;
                    }
                    util.message('正在同步粉丝信息<br>请不要离开页面或进行其他操作,同步成功后系统会自动刷新本页面');
                    $scope.adv.running = running = true;
                    var fanids = [];
                    $(':checkbox:checked').each(function(){
                        var fanid = parseInt($(this).val());
                        if(!isNaN(fanid)) {
                            fanids.push(fanid);
                        }
                    });
                    var params = {};
                    params.method = 'sync';
                    params.fanids = fanids;
                    $http.post(location.href, params).success(function(dat){
                        $scope.adv.running = running = false;
                        if(dat == 'success') {
                            location.reload();
                        } else {
                            message('未知错误, 请稍后重试.', location.href, 'error')
                        }
                    });
                };
                $scope.download = function(next, count){
                    $scope.adv.running = running = true;
                    var params = {};
                    params.method = 'download';
                    if(next) {
                        params.next = next;
                    }
                    if(!count) {
                        count = 0;
                    }
                    $http.post(location.href, params).success(function(dat){
                        if(dat.errno || dat.type == 'error' || dat.type == 'info') {
                            $scope.adv.downloadState = '';
                            $scope.adv.running = running = false;
                            util.message(dat.message, location.href, 'error');
                            return;
                        }

                        count += dat.count;
                        if((dat.total <= count) || (!dat.count && !dat.next)) {
                            $scope.adv.downloadState = '';
                            $scope.adv.running = running = false;
                            util.message('粉丝下载完成,系统将开始更新粉丝数据,请不要离开页面', "./index.php?c=mc&a=fans&do=initsync&acid=24", 'success');
                            return;
                        } else {
                            $scope.download(dat.next, count);
                            $scope.adv.downloadState = '(' + count + '/' + dat.total + ')';
                        }
                    });
                }
            });
            angular.bootstrap(document, ['app']);
        });
    </script>
    <div class="clearfix">
        <div class="alert alert-info">
            如果您的公众号类型为："认证订阅号" 或 "认证服务号",您可以使用粉丝分组功能。点击这里 <a href="./index.php?c=mc&a=fangroup&">"同步粉丝分组"</a>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">筛选</div>
            <div class="panel-body">
                <form action="./index.php" method="get" class="form-horizontal" role="form">
                    <input type="hidden" name="c" value="mc" />
                    <input type="hidden" name="a" value="fans" />
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">昵称</label>
                        <div class="col-sm-9 col-md-8 col-lg-8 col-xs-12">
                            <input type="text" class="form-control" name="nickname" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">用户组</label>
                        <div class="col-sm-9 col-md-8 col-lg-8 col-xs-12">
                            <label class="radio-inline">
                                <input type="radio" name="type" value="" checked="checked"/> 不指定
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" value="bind" /> 已经注册为会员
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" value="unbind" /> 未注册为会员
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否关注</label>
                        <div class="col-sm-9 col-md-8 col-lg-8 col-xs-12">
                            <label class="radio-inline">
                                <input type="radio" name="follow" value="" checked="checked"/> 不限
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="follow" value="1" /> 已关注
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="follow" value="2" /> 取消关注
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">关注/取消关注时间</label>
                        <div class="col-sm-9 col-md-8 col-lg-8 col-xs-12">
                            
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
                            
                            <input name="time[start]" type="hidden" value="2017-03-17" />
                            <input name="time[end]" type="hidden" value="2017-05-17" />
                            <button class="btn btn-default daterange daterange-date" type="button"><span class="date-title">2017-03-17 至 2017-05-17</span> <i class="fa fa-calendar"></i></button>
                        </div>
                        <div class="pull-right col-xs-12 col-sm-3 col-md-2 col-lg-2">
                            <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form action="?c=mc&a=fans&" method="post" id="form1">
            <div class="panel panel-default">
                <div class="panel-body table-responsive" ng-controller="advAPI">
                    <table class="table table-hover"  style="width:100%;z-index:-10;" cellspacing="0" cellpadding="0">
                        <thead class="navbar-inner">
                        <tr>
                            <th style="width:30px;">删？</th>
                            <th style="width:90px;">头像</th>
                            <th style="width:150px;">昵称</th>
                            <th style="width:180px;">对应用户</th>
                            <th style="width:80px;">是否关注</th>
                            <th style="width:180px;">关注/取消时间</th>
                            <th style="min-width:70px;" class="text-right">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="checkbox" name="delete[]" value="77" /></td>
                            <td><img src="resource/images/noavatar_middle.gif" width="48"></td>
                            <td></td>
                            <td>
                                <a href="./index.php?c=mc&a=member&do=post&uid=87"><span>25e5f0929d1dfc73a45973f2480a6828@bj165.com</span></a>
                            </td>
                            <td>
                                <span class="label label-success">已关注 </span>
                            </td>
                            <td>
                                2017-05-15 12:37:17					</td>
                            <td class="text-right" style="overflow:visible;">
                                <div class="btn-group">
                                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                        <span id="77-name">未分组</span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="javascript:;" class="groupedit" title="未分组" data-groupid="0" data-openid="oLFSVwcZkyf380B2S8C_WDUzkVFU" data-fanid="77">未分组</a></li>
                                        <li><a href="javascript:;" class="groupedit" title="黑名单" data-groupid="1" data-openid="oLFSVwcZkyf380B2S8C_WDUzkVFU" data-fanid="77">黑名单</a></li>
                                        <li><a href="javascript:;" class="groupedit" title="星标组" data-groupid="2" data-openid="oLFSVwcZkyf380B2S8C_WDUzkVFU" data-fanid="77">星标组</a></li>
                                    </ul>
                                </div>
                                <a href="./index.php?c=mc&a=notice&do=tpl&id=77" class="btn btn-success btn-sm sms">发送消息</a>
                                <a href="./index.php?c=mc&a=fans&do=view&id=77" class="btn btn-default btn-sm">查看详情</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-hover">
                        <tr>
                            <td width="30">
                                <input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
                            </td>
                            <td class="text-left">
                                <input name="token" type="hidden" value="196752ed" />
                                <input type="submit" class="btn btn-primary span2" name="submit" value="删除" /> &nbsp;
                                <input type="button" class="btn btn-default" name="submit" value="同步粉丝信息{{adv.enabled ? (adv.running ? adv.syncState : '') : '(请指定公众号)'}}" ng-click="sync();" ng-disabled="!adv.enabled || adv.running" /> &nbsp;
                                <input type="button" class="btn btn-default" name="submit" value="下载所有粉丝{{adv.enabled ? (adv.running ? adv.downloadState : '') : '(请指定公众号)'}}" ng-click="download();" ng-disabled="!adv.enabled || adv.running" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span class="help-block">同步粉丝信息: 选定粉丝后, 访问公众平台获取特定粉丝的相关资料, 如果已对应用户, 那么将会把未登记的资料填充至关联用户. 需要为认证微信服务号, 或者高级易信号</span>
                                <span class="help-block">下载所有粉丝: 访问公众平台下载所有粉丝列表(这个操作不能获取粉丝资料, 只能获取粉丝标志). 需要为认证微信服务号, 或者高级易信号</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    </div>
    <script>
        $('.groupedit').click(function(){
            var groupid = $(this).attr('data-groupid');
            var openid = $(this).attr('data-openid');
            if(!openid) {
                util.message('粉丝openid错误', '', 'error');
            }
            $.post('./index.php?c=mc&a=fans&do=updategroup&', {'openid' : openid, 'groupid': groupid}, function(data){
                var data = $.parseJSON(data);
                if(data.status == 'error') {
                    util.message(data.mess, '', 'error');
                } else if(data.status == 'success'){
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