<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <div class="clearfix ng-cloak" ng-controller="replyForm">
        <form id="reply-form" class="form-horizontal form" action="?c=platform&a=cover&do=mc&" method="post" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-heading">
                    直接连接 <span class="text-muted">直接进入的URL</span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">直接URL</label>
                        <div class="col-sm-9 col-xs-12 ">
                            <input type="text" class="form-control" readonly="readonly" value="http://wcmall.bj165.com/app/index.php?i=24&c=mc&a=home&" />
                            <span class="help-block">
							<strong>直接指向到入口的URL。您可以在自定义菜单（有oAuth权限）或是其它位置直接使用。</strong>
						</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    功能封面 <span class="text-muted">个人中心入口设置</span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">封面名称</label>
                        <div class="col-sm-6 col-xs-12">
                            <input type="text" class="form-control" readonly="readonly" value="个人中心入口设置" />
                            <span class="help-block">
					<strong>选择高级设置: 将会提供一系列的高级选项供专业用户使用.</strong>
				</span>
                        </div>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" ng-model="reply.advSetting" /> 高级设置
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" ng-show="reply.advSetting">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
                        <div class="col-sm-9 col-xs-12">
                            <label class="radio-inline">
                                <input type="radio" name="status" value="1"  checked="checked" /> 启用
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="0"  /> 禁用
                            </label>
                            <span class="help-block">您可以临时禁用这条回复.</span>
                        </div>
                    </div>
                    <div class="form-group" ng-show="reply.advSetting">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">置顶回复</label>
                        <div class="col-sm-9 col-xs-12">
                            <label class="radio-inline">
                                <input type="radio" name="istop" ng-model="reply.entry.istop" ng-value="1" value="1"  /> 置顶
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="istop" ng-model="reply.entry.istop" ng-value="0" value="0"  checked="checked" /> 普通
                            </label>
                            <span class="help-block">“置顶”时无论在什么情况下均能触发且使终保持最优先级</span>
                        </div>
                    </div>
                    <div class="form-group" ng-show="reply.advSetting && !reply.entry.istop">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">优先级</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" placeholder="输入这条回复规则优先级" name="displayorder" value="">
                            <span class="help-block">规则优先级，越大则越靠前，最大不得超过254</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">触发关键字</label>
                        <div class="col-sm-6 col-xs-12">
                            <input type="text" class="form-control" placeholder="请输入触发关键字" ng-model="trigger.items.default" />
                            <input type="hidden" name="keywords"/>
                            <span class="help-block">
					当用户的对话内容符合以上的关键字定义时，会触发这个回复定义。多个关键字请使用逗号隔开. <br />
					<strong>选择高级触发: 将会提供一系列的高级触发方式供专业用户使用(注意: 如果你不了解, 请不要使用). </strong>
				</span>
                        </div>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" ng-model="reply.advTrigger" /> 高级触发
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" ng-show="reply.advTrigger">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">高级触发列表</label>
                        <div class="col-sm-9 col-xs-12">
                            <div class="panel panel-default tab-content">
                                <div class="panel-heading">
                                    <ul class="nav nav-pills">
                                        <li class="active"><a href="#contains" data-toggle="tab">包含关键字</a></li>
                                        <li><a href="#regexp" data-toggle="tab">正则表达式模式匹配</a></li>
                                        <li><a href="#trustee" data-toggle="tab">直接接管</a></li>
                                    </ul>
                                </div>
                                <ul class="tab-pane list-group active" id="contains">
                                    <li class="list-group-item row" ng-repeat="entry in trigger.items.contains">
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="text" class="form-control" ng-hide="entry.saved" placeholder="{{entry.label}}" ng-model="entry.content" />
                                            <p class="form-control-static" ng-show="entry.saved" ng-bind="entry.content"></p>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="btn-group">
                                                <a href="javascript:;" class="btn btn-default" ng-click="trigger.saveItem(entry);">{{entry.saved ? '编辑' : '保存'}}</a>
                                                <a href="javascript:;" class="btn btn-default" ng-click="trigger.removeItem(entry);">删除</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="tab-pane list-group" id="regexp">
                                    <li class="list-group-item row" ng-repeat="entry in trigger.items.regexp">
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="text" class="form-control" ng-hide="entry.saved" placeholder="{{entry.label}}" ng-model="entry.content" />
                                            <p class="form-control-static" ng-show="entry.saved" ng-bind="entry.content"></p>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="btn-group">
                                                <a href="javascript:;" class="btn btn-default" ng-click="trigger.saveItem(entry);">{{entry.saved ? '编辑' : '保存'}}</a>
                                                <a href="javascript:;" class="btn btn-default" ng-click="trigger.removeItem(entry);">删除</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="tab-pane list-group" id="trustee">
                                    <li class="list-group-item row" ng-repeat="entry in trigger.items.trustee">
                                        <div class="col-xs-12 col-sm-8">
                                            <p class="form-control-static">符合优先级条件时, 这条回复将直接生效</p>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="javascript:;" class="btn btn-default" ng-click="trigger.removeItem(entry);">取消接管</a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="panel-footer">
                                    <a href="javascript:;" class="btn btn-default" ng-click="trigger.addItem();" ng-bind="'添加' + trigger.labels[trigger.active]">添加</a>
                                    <span class="help-block" ng-bind-html="trigger.descriptions[trigger.active]"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">封面参数</label>
                        <div class="col-sm-9">
                            <div class="panel panel-default reply-container" style="padding-top:2em;">
                                <div ng-hide="entry.saved">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">标题</label>
                                        <div class="col-sm-9 col-xs-12">
                                            <input type="text" class="form-control" placeholder="标题" name="title" ng-model="entry.title" />
                                        </div>
                                    </div>
</div>
