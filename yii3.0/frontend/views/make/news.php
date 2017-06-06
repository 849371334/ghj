<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="./index.php?r=make/wechat_matter">定时群发</a></li>
        <li ><a href="./index.php?r=make/send">发送记录</a></li>
        <li ><a href="./index.php?r=make/image">图片</a></li>
        <li ><a href="./index.php?r=make/voice">语音</a></li>
        <li ><a href="./index.php?r=make/video">视频</a></li>
        <li ><a href="./index.php?r=make/news">图文</a></li>
    </ul>
<div ng-controller="download" style="margin-bottom: 15px">
    <div class="panel panel-default download" style="display: none;" ng-show="flag == 1">
        <div class="panel-heading">同步微信素材</div>
        <div class="panel-body">
            <div class="progress">
                <div class="progress-bar progress-bar-danger" ng-style="style">
                    {{pragress}}
                </div>
            </div>
            <span class="help-block">正在同步中，请勿关闭浏览器</span>
            <div class="alert alert-danger" ng-show="fails.length > 0">
                <i class="fa fa-info-circle"></i> 有{{fails.length}}个文件同步失败,您可以选择重新同步
            </div>
            <table class="table table-hover table-bordered" ng-show="fails.length > 0">
                <thead>
                <tr>
                    <th>media_id</th>
                    <th>原因</th>
                </tr>
                </thead>
                <tr ng-repeat="file in fails">
                    <td>{{file.media_id}}</td>
                    <td>{{file.message}}</td>
                </tr>
            </table>
        </div>
    </div>
    <a href="javascript:;" class="btn btn-primary" ng-click="sync()" ng-bind="disable == 1 ? '同步中' : '同步微信素材'" ng-disabled="disable == 1"></a>
    <a href="javascript:;" class="btn btn-danger init-hide" style="display: none" ng-click="flag = 0" ng-show="fails.length > 0 && flag == 1">收起</a>
</div>
<div class="alert alert-info">
    <i class="fa fa-info-circle"></i> 因图文素材的封面使用的是图片素材,因此查看图文素材时请确保已经成功同步过图片素材<br>
    <i class="fa fa-info-circle"></i> 系统不支持直接添加微信图文素材,您可以在微信公众平台添加后同步到本系统<br>
</div>

<div class="panel panel-default panel-news">
    <div class="panel-heading">图文素材</div>
    <div class="panel-body">
        <div class="reply" id="mpnews" style="position: relative">
        </div>
    </div>
</div>

<!-- 群发预览 -->
<div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form action="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">请输入接受人的微信号</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="wxname">微信号</label>
                        <input type="text" class="form-control" id="wxname" name="wxname">
                        <span class="help-block">微信号不能为空</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary btn-view">发送</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="modal-send" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form action="" class="form form-horizontal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">设置群发</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">选择粉丝分组</label>
                        <div class="col-sm-9 col-xs-12">
                            <select name="group" id="group" class="form-control">
                                <option value="-1" selected>所有粉丝</option>
                            </select>
                            <span class="help-block">如果您需要定时群发,请<a href="./index.php?c=material&a=mass&"> 点击链接</a></span>
                        </div>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary btn-send">发送</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    require(['angular', 'wechatFileUploader', 'jquery.jplayer', 'jquery.wookmark'], function(angular, uploader){
        $('.init_hide').show();

        $('.btn-upload').click(function(){
            var type = $(this).data('type');
            var options = {type: type, direct: true, multiple: false};
            uploader.init(function(){location.reload();}, options);
        });

        $('.btn-send').click(function(){
            var id = $(this).data('id');
            var type = $(this).data('type');
            $('#modal-send').modal('show');

            $('#modal-send .btn-send').unbind().click(function(){
                var group = $.trim($('#modal-send #group').val());
                $('#modal-send').modal('hide');
                $.post("./index.php?c=material&a=display&do=send&", {id:id, group:group, type:type}, function(data){
                    if(data != 'success') {
                        util.message(data, '', 'error');
                    } else {
                        util.message('发送成功', '', 'success');
                    }
                });
                return false;
            });
        });

        $('#mpnews .water').wookmark({
            align: 'center',
            autoResize: false,
            container: $('#mpnews'),
            autoResize :true
        });
        //语音播放
        $(".audio-player-play").click(function(){
            var src = $(this).data("attach");
            if(!src) {
                return;
            }
            if ($("#player")[0]) {
                var player = $("#player");
            } else {
                var player = $('<div id="player"></div>');
                $(document.body).append(player);
            }
            player.data('control', $(this));
            player.jPlayer({
                playing: function() {
                    $(this).data('control').find("i").removeClass("fa-play").addClass("fa-stop");
                },
                pause: function (event) {
                    $(this).data('control').find("i").removeClass("fa-stop").addClass("fa-play");
                },
                swfPath: "resource/components/jplayer",
                supplied: "mp3,wma,wav,amr",
                solution: "html, flash"
            });
            player.jPlayer("setMedia", {mp3: $(this).data("attach")}).jPlayer("play");
            if($(this).find("i").hasClass("fa-stop")) {
                player.jPlayer("stop");
            } else {
                $('.audio-msg').find('.fa-stop').removeClass("fa-stop").addClass("fa-play");
                player.jPlayer("setMedia", {mp3: $(this).data("attach")}).jPlayer("play");
            }
        });

        //群发预览
        $('.btn-view').click(function(){
            var id = $(this).data('id');
            var type = $(this).data('type');
            $('#modal-view').modal('show');

            $('#modal-view .btn-view').unbind().click(function(){
                var wxname = $.trim($('#modal-view #wxname').val());
                if(!wxname) {
                    util.message('微信号不能为空', '', 'error');
                    return false;
                }
                $('#modal-view').modal('hide');
                $.post("./index.php?c=material&a=display&do=purview&", {id:id, wxname:wxname, type:type}, function(data){
                    if(data != 'success') {
                        util.message(data, '', 'error');
                    } else {
                        util.message('发送成功', '', 'success');
                    }
                });
                return false;
            });
        });

        //删除微信素材
        $('.btn-del').click(function(){
            if(!confirm('删除将不可恢复，确定删除吗？')) {
                return false;
            }
            var id = $(this).data('id');
            $.post("./index.php?c=material&a=display&do=del&", {id:id}, function(data){
                if(data != 'success') {
                    util.message(data, '', 'error');
                } else {
                    location.reload();
                }
            });
            return false;
        });

        //同步微信素材
        var running = false;
        window.onbeforeunload = function(e) {
            if(running) {
                return (e || window.event).returnValue = '正在进行微信素材数据同步，确定离开页面吗.';
            }
        }

        angular.module('app', []).controller('download', function($scope, $http){
            $('.download').show();
            $scope.sync = function(){
                running = true;
                $scope.flag = 1;
                $scope.disable = 1;

                $scope.fails = [];
                var i = 0;
                var total = 1;
                var num = 0;
                var type = "news";
                var proc = function(page) {
                    if(page == 1) {
                        $scope.pragress = "3%";
                        $scope.style = {'width': '3%'};
                    } else {
                        $scope.pragress = (i/total).toFixed(2)*100 + "%";
                        $scope.style = {'width':(i/total).toFixed(2)*100+"%"};
                    }
                    $http.post("./index.php?c=material&a=display&do=down&", {page:page, type:type}).success(function(dat){
                        if(dat.message.errno > 0) {
                            page++;
                            i += dat.message.message.item_count;
                            total = dat.message.errno;
                            if(dat.message.message.fail) {
                                angular.forEach(dat.message.message.fail, function(v){
                                    $scope.fails.push(v);
                                });
                            }
                        } else if(dat.message.errno == -2) {
                            running = false;
                            if($scope.fails.length > 0) {
                                $scope.flag = 1;
                            } else {
                                $scope.flag = 0;
                            }
                            $scope.disable = 0;
                            $scope.pragress = "100%";
                            $scope.style = {'width':'100%'};
                            util.message('同步素材完成', location.href, 'success');
                            return false;
                        } else if(dat.message.errno == -1) {
                            if(num < 3) {
                                page = page;
                            } else {
                                util.message(dat.message.message, '', 'error');
                                return false;
                            }
                            num++;
                        }
                        proc(page);
                    }).error(function(){
                        util.message('访问出错', '', 'error');
                        return false;
                    });
                }
                proc(1);
            };
        });
        angular.bootstrap(document, ['app']);
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