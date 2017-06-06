<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/sys_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/config.php');
?>
<link href="replay/css/bootstrap.min.css">
<link rel="stylesheet" href="replay/css/reset.css">
<style>
    .comment{width:680px; margin:20px auto; position:relative; background:#fff; padding:20px 50px 50px; border:1px solid #DDD; border-radius:5px;}
    .comment h3{height:28px; line-height:28px}
    .com_form{width:100%; position:relative}
    .input{width:99%; height:60px; border:1px solid #ccc}
    .com_form p{height:28px; line-height:28px; position:relative; margin-top:10px;}
    span.emotion{width:42px; height:20px; background:url(http://www.16code.com/cache/demos/user-say/img/icon.gif) no-repeat 2px 2px; padding-left:20px; cursor:pointer}
    span.emotion:hover{background-position:2px -28px}
    .qqFace{margin-top:4px;background:#fff;padding:2px;border:1px #dfe6f6 solid;}
    .qqFace table td{padding:0px;}
    .qqFace table td img{cursor:pointer;border:1px #fff solid;}
    .qqFace table td img:hover{border:1px #0066cc solid;}
    #show{width:770px; margin:20px auto; background:#fff; padding:5px; border:1px solid #DDD; vertical-align:top;}

    .sub_btn {
        position:absolute; right:0px; top:0;
        display: inline-block;
        zoom: 1; /* zoom and *display = ie7 hack for display:inline-block */
        *display: inline;
        vertical-align: baseline;
        margin: 0 2px;
        outline: none;
        cursor: pointer;
        text-align: center;
        font: 14px/100% Arial, Helvetica, sans-serif;
        padding: .5em 2em .55em;
        text-shadow: 0 1px 1px rgba(0,0,0,.6);
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
        box-shadow: 0 1px 2px rgba(0,0,0,.2);
        color: #e8f0de;
        border: solid 1px #538312;
        background: #64991e;
        background: -webkit-gradient(linear, left top, left bottom, from(#7db72f), to(#4e7d0e));
        background: -moz-linear-gradient(top,  #7db72f,  #4e7d0e);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#7db72f', endColorstr='#4e7d0e');
    }
    .sub_btn:hover {
        background: #538018;
        background: -webkit-gradient(linear, left top, left bottom, from(#6b9d28), to(#436b0c));
        background: -moz-linear-gradient(top,  #6b9d28,  #436b0c);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#6b9d28', endColorstr='#436b0c');
    }
</style>
<script src="jquery.js"></script>
    <div class="col-xs-12 col-sm-9 col-lg-10">
        <ul class="nav nav-tabs">
            <li class="active"><a href="index.php?r=user/news">添加基本图文回复</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="active"><a href="index.php?r=user/img">添加基本音乐回复</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="active"><a href="index.php?r=user/voice">添加基本语音回复</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="active"><a href="index.php?r=user/video">添加基本视频回复</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        </ul>
        <style type="text/css">
            .help-block em{display:inline-block;width:10em;font-weight:bold;font-style:normal;}
        </style>

        <div class="clearfix ng-scope" id="js-reply-form" ng-controller="replyForm">
            <form id="reply-form" class="form-horizontal form ng-pristine ng-valid" action="?r=reply/upload" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">添加回复规则 <span class="text-muted">删除，修改规则、关键字以及回复后，请提交以保存操作。</span></div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">回复规则名称</label>
                                        <div class="col-sm-6 col-md-8 col-xs-12">
                                            <input type="text" class="form-control" placeholder="请输入回复规则的名称" name="name" value="">
									<span class="help-block">
										您可以给这条规则起一个名字, 方便下次修改和查看. <br>
										<strong class="text-danger">选择高级设置: 将会提供一系列的高级选项供专业用户使用.</strong>
									</span>
                                        </div>
                                        <div class="col-sm-3 col-md-2">
                                            <div class="checkbox">
                                                <label>
                                                    <a href="javascript:void(0);" id="lolo">高级设置</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="timom">
                                        <div class="form-group ng-hide" ng-show="reply.advSetting">
                                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
                                        <div class="col-sm-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="1" checked="checked"> 启用
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="0"> 禁用
                                            </label>
                                            <span class="help-block">您可以临时禁用这条回复.</span>
                                        </div>
                                    </div>
                                    <div class="form-group ng-hide" ng-show="reply.advSetting">
                                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">置顶回复</label>
                                        <div class="col-sm-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="istop" ng-model="reply.entry.istop" ng-value="1" value="1"> 置顶
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="istop" ng-model="reply.entry.istop" ng-value="0" value="0" checked="checked"> 普通
                                            </label>
                                            <span class="help-block">“置顶”时无论在什么情况下均能触发且使终保持最优先级</span>
                                        </div>
                                    </div>



                                    <div class="form-group" ng-show="reply.advSetting &amp;&amp; !reply.entry.istop">
                                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">优先级</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="输入这条回复规则优先级" name="displayorder_rule" value="">
                                            <span class="help-block">规则优先级，越大则越靠前，最大不得超过254</span>
                                        </div>
                                    </div>
                                    </div>

                                    <di v class="form-group">
                                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">触发关键字</label>
                                        <div class="col-sm-6 col-md-8 col-xs-12">
<!--                                            <input type="hidden" name="rid" value="0">-->
                                            <input type="text" name="keyword" class="form-control keyword" placeholder="请输入触发关键字" ng-model="trigger.items.default" id="keywordinput" onblur="checkKeyWord($(this));">
                                            <span class="help-block"></span>
<!--                                            <input type="hidden" name="keywords">-->
									<span class="help-block">
										当用户的对话内容符合以上的关键字定义时，会触发这个回复定义。多个关键字请使用逗号隔开。 <br>
										<strong class="text-danger">选择高级触发: 将会提供一系列的高级触发方式供专业用户使用(注意: 如果你不了解, 请不要使用). </strong>
									</span>
                                        </div>

                                        <div class="col-sm-3 col-md-2">
                                            <div class="checkbox">
                                                <label>
                                                    <a href="javascript:void(0);" id="lol">高级触发</a>
                                                    <!--                                                    <input type="checkbox" ng-model="reply.advTrigger"> 高级触发-->
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="timo">
                                    <div class="form-group" ng-show="reply.advTrigger">
                                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">高级触发列表</label>
                                        <div class="col-sm-9">
                                            <div class="panel panel-default tab-content">
                                                <div class="panel-heading">
                                                    <ul class="nav nav-pills">
                                                        <li class="active"><a href="http://wcmall.bj165.com/web/index.php?c=platform&amp;a=reply&amp;do=post&amp;m=basic#contains" data-toggle="tab">包含关键字</a></li>
                                                        <li><a href="http://wcmall.bj165.com/web/index.php?c=platform&amp;a=reply&amp;do=post&amp;m=basic#regexp" data-toggle="tab">正则表达式模式匹配</a></li>
                                                        <li><a href="http://wcmall.bj165.com/web/index.php?c=platform&amp;a=reply&amp;do=post&amp;m=basic#trustee" data-toggle="tab">直接接管</a></li>
                                                    </ul>
                                                </div>
                                                <ul class="tab-pane list-group active" id="contains">
                                                    <li class="list-group-item row" ng-repeat="entry in trigger.items.contains">
                                                        <div class="col-xs-12 col-sm-8">
                                                            <input type="text" class="form-control keyword" ng-hide="entry.saved" placeholder="{{entry.label}}" ng-model="entry.content" onblur="checkKeyWord($(this));">
                                                            <span class="help-block"></span>
                                                            <p class="form-control-static" ng-show="entry.saved" ng-bind="entry.content"></p>
                                                        </div>
                                                        <div class="col-sm-4">
                                                        </div>
                                                    </li>
                                                </ul>
                                                <ul class="tab-pane list-group" id="regexp">
                                                    <li class="list-group-item row" ng-repeat="entry in trigger.items.regexp">
                                                        <div class="col-xs-12 col-sm-8">
                                                            <input type="text" class="form-control keyword" ng-hide="entry.saved" placeholder="{{entry.label}}" ng-model="entry.content" onblur="checkKeyWord($(this));">
                                                            <span class="help-block"></span>
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
                                                    <a href="javascript:;" class="btn btn-default" ng-click="trigger.addItem();" ng-bind="&#39;添加&#39; + trigger.labels[trigger.active]">添加</a>
                                                    <span class="help-block" ng-bind-html="trigger.descriptions[trigger.active]"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                回复内容
                            </div>
                            <ul class="list-group">
                                <li class="row list-group-item" ng-repeat="item in context.items">
                                    <div id="show"></div>
<!--                                    <div class="comment">-->
                                        <div class="com_form">
                                            <textarea class="input" id="saytext" name="digest"></textarea>
                                            <p><input type="button" class="sub_btn" value="提交"><span class="emotion">表情</span></p>
                                        </div>
                                </li>
                            </ul>
                            <div class="panel-footer">
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                图片内容
                            </div>
                            <ul class="list-group">
                                <li class="row list-group-item" ng-repeat="item in context.items">
                                    <input type="file" name="file">
                                </li>
                            </ul>

                        </div>


                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                                <input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
<!--                                <input type="hidden" name="token" value="196752ed">-->
                            </div>
                        </div>
            </form>
</div>
        <script  src="replay/jquery.js"></script>
        <script type="text/javascript" src="replay/js/jquery.qqFace.js"></script>
        <script type="text/javascript">
            $(function(){

                $('.emotion').qqFace({
                    id : 'facebox',
                    assign:'saytext',
                    path:'replay/arclist/'	//表情存放的路径
                });
                $(".sub_btn").click(function(){
                    var str = $("#saytext").val();
                    $("#show").html(replace_em(str));
                });
            });
            //查看结果
            function replace_em(str){
                str = str.replace(/\</g,'&lt;');
                str = str.replace(/\>/g,'&gt;');
                str = str.replace(/\n/g,'<br/>');
                str = str.replace(/\[em_([0-9]*)\]/g,'<img src="replay/arclist/$1.gif" border="0" />');
                return str;
            }
        </script>
<!--        点击高级隐藏、显示div-->
        <script>
            $(function(){
                $('#lol').click(function(){//点击a标签
                    if($('#timo').is(':hidden')){//如果当前隐藏
                        $('#timo').show();//那么就显示div
                    }else{//否则
                        $('#timo').hide();//就隐藏div
                    }
                })
            })
            $(function(){
                $('#lolo').click(function(){//点击a标签
                    if($('#timom').is(':hidden')){//如果当前隐藏
                        $('#timom').show();//那么就显示div
                    }else{//否则
                        $('#timom').hide();//就隐藏div
                    }
                })
            })
        </script>



        <script  src="replay/js/jquery.min.js"></script>
        <script type="text/javascript" src="replay/js/jquery.qqFace.js"></script>
        <script type="text/javascript">
            $(function(){
                $('.emotion').qqFace({
                    id : 'facebox',
                    assign:'saytext',
                    path:'arclist/'	//表情存放的路径
                });
                $(".sub_btn").click(function(){
                    var str = $("#saytext").val();
                    $("#show").html(replace_em(str));
                });
            });
            //查看结果
            function replace_em(str){
                str = str.replace(/\</g,'&lt;');
                str = str.replace(/\>/g,'&gt;');
                str = str.replace(/\n/g,'<br/>');
                str = str.replace(/\[em_([0-9]*)\]/g,'<img src="replay/arclist/$1.gif" border="0" />');
                return str;
            }
        </script>

