<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="./index.php?r=make/wechat_matter">定时群发</a></li>
        <li ><a href="./index.php?r=make/send&">发送记录</a></li>
        <li ><a href="./index.php?r=make/image">图片</a></li>
        <li ><a href="./index.php?r=make/voice">语音</a></li>
        <li ><a href="./index.php?r=make/video">视频</a></li>
        <li ><a href="./index.php?make/news">图文</a></li>
    </ul>
    <div class="alert alert-info">
        <strong class="text-danger"><i class="fa fa-info-circle"></i> 该功能是定时群发,如果你需要立即群发,请在素材列表里找到对用的素材直接群发</strong><br>
        <i class="fa fa-info-circle"></i> 使用定时群发功能可设置未来7天的群发,使用该功能前请先确保您的云服务可用<br>
        <i class="fa fa-info-circle"></i> <strong>如果在提交定时群发提示:某天的群发同步到云服务失败,请手动同步到云服务</strong><br>
        <i class="fa fa-info-circle"></i> <strong>使用该功能前,请将微信公众平台的素材同步到本系统</strong><br>
    </div>
    <form action="" class="form form-horizontal" id="mass-container" ng-controller="mass">
        <div class="panel panel-default">
            <div class="panel-heading">设置未来7天的群发</div>
            <div class="panel-body">
                <div class="row clearfix reply">
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <div ng-repeat="item in mass.groups">
                            <!-- 图文 -->
                            <div class="panel-group init-hide" ng-if="item.msgtype == 'news'" id="group-{{ $index }}">
                                <div class="panel panel-default" ng-repeat="media in item.media.items">
                                    <div class="panel-body" ng-if="$index == 0">
                                        <div class="img">
                                            <i class="default">封面图片</i>
                                            <a ng-href="{{media.url}}" target="_blank"><img src="" ng-src="{{media.thumb}}"></a>
                                            <span class="text-left" ng-bind="media.title"></span>
                                        </div>
                                    </div>
                                    <div class="panel-body" ng-if="$index != 0">
                                        <a ng-href="{{media.url}}" target="_blank">
                                            <div class="text">
                                                <h4 ng-bind="media.title"></h4>
                                            </div>
                                            <div class="img">
                                                <img src="" ng-src="{{media.thumb}}">
                                                <i class="default">缩略图</i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-body" style="height:20px; padding-bottom:40px; padding-top:7px; padding-right:15px;">
                                        <div class="btn-group">
                                            <a href="javascript:;" ng-click="mass.purview(item)" class="btn btn-default btn-sm">预览</a>
                                            <a href="javascript:;" ng-click="mass.emptyGroup(item)" ng-disabled="item.status == 0" class="btn btn-default btn-sm">清空</a>
                                            <a href="javascript:;" ng-click="mass.editGroup(item)" ng-disabled="item.status == 0" class="btn btn-default btn-sm">编辑</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="no" ng-bind="item.time"></div>
                                <div class="type news">图文</div>
                                <div class="info init_hide" ng-show="!item.media_id">未设置</div>
                                <div class="success init_hide" ng-show="item.status == 0">已发送</div>
                            </div>
                            
                            <!-- 图片 -->
                            <div class="panel-group init-hide" ng-if="item.msgtype == 'image'" id="group-{{ $index }}">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="img">
                                            <i class="default">封面图片</i>
                                            <img src="" ng-src="{{item.media.attach}}">
                                        </div>
                                    </div>
                                    <div class="no" ng-bind="item.time"></div>
                                    <div class="type image">图片</div>
                                    <div class="info init_hide" ng-show="!item.media_id">未设置</div>
                                    <div class="success init_hide" ng-show="item.status == 0">已发送</div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-body" style="height:20px; padding-bottom:40px; padding-top:7px">
                                        <div class="btn-group">
                                            <a href="javascript:;" ng-click="mass.purview(item)" class="btn btn-default btn-sm">预览</a>
                                            <a href="javascript:;" ng-click="mass.emptyGroup(item)" ng-disabled="item.status == 0" class="btn btn-default btn-sm">清空</a>
                                            <a href="javascript:;" ng-click="mass.editGroup(item)" ng-disabled="item.status == 0" class="btn btn-default btn-sm">编辑</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 微信卡券 -->
                            <div class="panel-group init-hide" ng-if="item.msgtype == 'wxcard'" id="group-{{ $index }}">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="panel-wxcard">
                                            <div class="wxcard-content" ng-style="{'background-color' : item.media.color}">
                                                <img src="" ng-src="{{item.media.logo_url}}" class="img-circle">
                                                <div class="title">{{item.media.title}}</div>
                                            </div>
                                            <div class="wxcard-footer clearfix">
                                                <div class="pull-right text-muted hide">2015-12-5</div>
                                                <div>{{item.media.brand_name}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="no" ng-bind="item.time"></div>
                                    <div class="type wxcard">微信卡券</div>
                                    <div class="info init_hide" ng-show="!item.media_id">未设置</div>
                                    <div class="success init_hide" ng-show="item.status == 0">已发送</div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-body" style="height:20px; padding-bottom:40px; padding-top:7px">
                                        <div class="btn-group">
                                            <a href="javascript:;" ng-click="mass.purview(item)" class="btn btn-default btn-sm">预览</a>
                                            <a href="javascript:;" ng-click="mass.emptyGroup(item)" ng-disabled="item.status == 0" class="btn btn-default btn-sm">清空</a>
                                            <a href="javascript:;" ng-click="mass.editGroup(item)" ng-disabled="item.status == 0" class="btn btn-default btn-sm">编辑</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 语音 -->
                            <div class="init-hide" ng-if="item.msgtype == 'voice'" id="group-{{ $index }}">
                                <div class="panel panel-default panel-voice">
                                    <div class="panel-body">
                                        <div class="audio-msg">
                                            <div class="icon audio-player-play" data-attach="{{item.media.attach}}"><span><i class="fa fa-play"></i></span></div>
                                            <div class="audio-content">
                                                <div class="audio-title" ng-bind="item.media.filename"></div>
                                                <div class="audio-date text-muted" ng-bind="'创建于：' + item.media.createtime_cn"></div>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <a href="javascript:;" ng-click="mass.purview(item)" class="btn btn-default btn-sm">预览</a>
                                            <a href="javascript:;" ng-click="mass.emptyGroup(item)" ng-disabled="item.status == 0" class="btn btn-default btn-sm">清空</a>
                                            <a href="javascript:;" ng-click="mass.editGroup(item)" ng-disabled="item.status == 0" class="btn btn-default btn-sm">编辑</a>
                                        </div>
                                    </div>
                                    <div class="no" ng-bind="item.time"></div>
                                    <div class="type voice">语音</div>
                                    <div class="info init_hide" ng-show="!item.media_id">未设置</div>
                                    <div class="success init_hide" ng-show="item.status == 0">已发送</div>
                                </div>
                            </div>
                            
                            <!-- 视频 -->
                            <div class="init-hide" ng-if="item.msgtype == 'video'" id="group-{{ $index }}">
                                <div class="panel panel-default panel-video">
                                    <div class="panel-body">
                                        <div class="video-content">
                                            <h4 class="title text-muted" ng-bind="item.media.tag.title">{{}}</h4>
                                            <div class="date text-muted" ng-bind="'创建于:' + item.media.createtime_cn"></div>
                                            <div class="video">
                                                <img src="../web/resource/images/banner-bg.png" alt="" />
                                            </div>
                                            <div class="abstract text-muted" ng-bind="item.media.tag.description"></div>
                                        </div>
                                        <div class="btn-group">
                                            <a href="javascript:;" ng-click="mass.purview(item)" class="btn btn-default btn-sm">预览</a>
                                            <a href="javascript:;" ng-click="mass.emptyGroup(item)" ng-disabled="item.status == 0" class="btn btn-default btn-sm">清空</a>
                                            <a href="javascript:;" ng-click="mass.editGroup(item)" ng-disabled="item.status == 0" class="btn btn-default btn-sm">编辑</a>
                                        </div>
                                    </div>
                                    <div class="no" ng-bind="item.time"></div>
                                    <div class="type video">视频</div>
                                    <div class="info init_hide" ng-show="!item.media_id">未设置</div>
                                    <div class="success init_hide" ng-show="item.status == 0">已发送</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-6 col-sm-9 col-md-9 aside" id="edit-container">
                        <div style="margin-bottom: 20px"></div>
                        <div class="card">
                            <div class="arrow-left"></div>
                            <div class="inner">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">接收粉丝</label>
                                            <div class="col-sm-9 col-xs-12">
                                                <label class="radio-inline"><input type="radio" name="group" value="-1" ng-model="mass.activeGroup.group"/> 全部粉丝</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">消息内容</label>
                                            <div class="col-sm-9 col-xs-12">
                                                <div class="col-xs-3 img init-hide" ng-if="!mass.activeGroup.media_id">
                                                    <span ng-click="mass.changeMedia()"><i class="fa fa-plus-circle green"></i>&nbsp;选择素材</span>
                                                </div>
                                                <div class="col-xs-3 img init-hide" ng-if="mass.activeGroup.media_id">
                                                    <div class="init-hide" ng-if="mass.activeGroup.msgtype == 'image'">
                                                        <h3 ng-click="mass.changeMedia()">重新选择</h3>
                                                        <span><i class="fa fa-image-o"></i>图片素材</span>
                                                    </div>
                                                    <div class="init-hide" ng-if="mass.activeGroup.msgtype == 'voice'">
                                                        <h3 ng-click="mass.changeMedia()">重新选择</h3>
                                                        <span><i class="fa file-audio-o"></i>语音素材</span>
                                                    </div>
                                                    <div class="init-hide" ng-if="mass.activeGroup.msgtype == 'video'">
                                                        <h3 ng-click="mass.changeMedia()">重新选择</h3>
                                                        <span><i class="fa fa-movie-o"></i>视频素材</span>
                                                    </div>
                                                    <div class="init-hide" ng-if="mass.activeGroup.msgtype == 'news'">
                                                        <h3 ng-click="mass.changeMedia()">重新选择</h3>
                                                        <span><i class="fa fa-word-o"></i>图文素材</span>
                                                    </div>
                                                    <div class="init-hide" ng-if="mass.activeGroup.msgtype == 'wxcard'">
                                                        <h3 ng-click="mass.changeMedia()">重新选择</h3>
                                                        <span><i class="fa fa-word-o"></i>微信卡券</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">发送时间</label>
                                            <div class="col-sm-3">
                                                <div class="input-group clockpicker">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <input type="text" readonly name="clock" ng-model="mass.activeGroup.clock" class="form-control">
                                                </div>
                                                <span class="help-block text-danger">特别注意:发送时间不能小于当前时间.不要超过晚上11点</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn btn-primary" ng-click="mass.submit()" id="submit">提交</div>
    </form>
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
    
    <script>
        require(['angular.sanitize', 'bootstrap', 'underscore', 'jquery.wookmark', 'jquery.jplayer', 'clockpicker'], function(angular, $, _){
            $('.init-hide').show();
            $('.clockpicker').clockpicker({autoclose: true});

            angular.module('app', ['ngSanitize']).controller('mass', function($scope, $http){
                $scope.mass = {};
                $scope.mass.groups = [{"msgtype":"news","group":-1,"time":"2017-05-16","status":1,"clock":"20:00","media":{"items":[{"title":"\u8bf7\u9009\u62e9\u7d20\u6750"}]}},{"msgtype":"news","group":-1,"time":"2017-05-17","status":1,"clock":"20:00","media":{"items":[{"title":"\u8bf7\u9009\u62e9\u7d20\u6750"}]}},{"msgtype":"news","group":-1,"time":"2017-05-18","status":1,"clock":"20:00","media":{"items":[{"title":"\u8bf7\u9009\u62e9\u7d20\u6750"}]}},{"msgtype":"news","group":-1,"time":"2017-05-19","status":1,"clock":"20:00","media":{"items":[{"title":"\u8bf7\u9009\u62e9\u7d20\u6750"}]}},{"msgtype":"news","group":-1,"time":"2017-05-20","status":1,"clock":"20:00","media":{"items":[{"title":"\u8bf7\u9009\u62e9\u7d20\u6750"}]}},{"msgtype":"news","group":-1,"time":"2017-05-21","status":1,"clock":"20:00","media":{"items":[{"title":"\u8bf7\u9009\u62e9\u7d20\u6750"}]}},{"msgtype":"news","group":-1,"time":"2017-05-22","status":1,"clock":"20:00","media":{"items":[{"title":"\u8bf7\u9009\u62e9\u7d20\u6750"}]}}];
                $scope.mass.activeType = 'news';
                $scope.mass.activeIndex = 0;
                $scope.mass.activeGroup = $scope.mass.groups[$scope.mass.activeIndex];
                $scope.mass.submit = function(){
                    var error = {errno: 1, message: ''};
                    $('#submit').addClass('disabled');
                    $http.post("./index.php?c=material&a=mass&do=post&", {data: $scope.mass.groups}).success(function(dat, status){
                        if(!dat.message.errno) {
                            util.message('设置群发成功', "./index.php?c=material&a=mass&do=send&", 'success');
                        } else if(dat.message.errno == -1000) {
                            util.message('存在没有同步到云服务的群发,现在跳转到手动同步页面:<br>' + dat.message.message, "./index.php?c=material&a=mass&do=send&", 'error');
                        } else {
                            $('#submit').removeClass('disabled');
                            util.message('设置群发失败:<br>' + dat.message.message, "", 'error');
                        }
                        return false;
                    });
                };

                $scope.mass.emptyGroup = function(item){
                    $scope.mass.editGroup(item);
                    if($scope.mass.activeGroup.id > 0) {
                        if(!confirm('确认清空这条群发吗?')) {
                            return false;
                        }
                        $http.post("./index.php?c=material&a=mass&do=del&", {id: $scope.mass.activeGroup.id}).success(function(dat, status){
                            if(!dat.message.errno) {
                                $scope.mass.activeGroup.msgtype = 'news';
                                $scope.mass.activeGroup.group = '-1';
                                $scope.mass.activeGroup.media_id = '';
                                $scope.mass.activeGroup.media.items = [{title: '请选择素材'}];
                            } else {
                                util.message('清空群发失败:<br>' + dat.message.message, "", 'error');
                            }
                        });
                    } else {
                        $scope.mass.activeGroup.msgtype = 'news';
                        $scope.mass.activeGroup.group = '-1';
                        $scope.mass.activeGroup.media_id = '';
                        $scope.mass.activeGroup.media.items = [{title: '请选择素材'}];
                    }
                    return false;
                }

                $scope.mass.purview = function(item){
                    $scope.mass.editGroup(item);
                    if(!$scope.mass.activeGroup.media_id) {
                        util.message('请先设置素材', '', 'error');
                        return false;
                    }

                    var media_id = $scope.mass.activeGroup.media_id;
                    var type = $scope.mass.activeGroup.msgtype;
                    $('#modal-view').modal('show');

                    $('#modal-view .btn-view').unbind().click(function(){
                        var wxname = $.trim($('#modal-view #wxname').val());
                        if(!wxname) {
                            util.message('微信号不能为空', '', 'error');
                            return false;
                        }
                        $('#modal-view').modal('hide');
                        $.post("./index.php?c=material&a=display&do=purview&", {media_id: media_id, wxname: wxname, type: type}, function(data){
                            if(data != 'success') {
                                util.message(data, '', 'error');
                            } else {
                                util.message('发送成功', '', 'success');
                            }
                        });
                        return false;
                    });
                }

                $scope.mass.editGroup = function(item){
                    var index = $.inArray(item, $scope.mass.groups);
                    if(index == -1) return false;
                    var top = $('#group-' + index).offset().top;
                    $('#edit-container').css('marginTop', top - 220);
                    $("html,body").animate({scrollTop: top-80}, 500);
                    $scope.mass.activeIndex = index;
                    $scope.mass.activeGroup = $scope.mass.groups[$scope.mass.activeIndex];
                }

                $scope.mass.changeMedia = function(){
                    if($scope.mass.activeGroup.status == 0) {
                        util.message($scope.mass.activeGroup.time + '群发已经发送,不能编辑');
                        return false;
                    }
                    util.material(function(material){
                        if(!material.media_id) {
                            util.message('素材media_id为空,请选择其他素材');
                            return false;
                        }
                        $scope.mass.activeGroup.msgtype = material.type;
                        $scope.mass.activeGroup.media_id = material.media_id;
                        $scope.mass.activeGroup.media = material;
                        $scope.mass.activeGroup.attach_id = material.id;
                        $scope.$apply();
                    });
                }

                $scope.mass.playaudio = function(){
                    $("#voice, .panel").on('click', '.audio-player-play', function(){
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
                }

                $scope.mass.playaudio();
            });
            angular.bootstrap($('#mass-container')[0], ['app']);
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