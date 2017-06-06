<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/sys_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/config.php');
?>
<script src="jquery.js"></script>

<link href="SWF/css/default.css" />
<script type="text/javascript" src="SWF/swfupload/swfupload.js"></script>
<script type="text/javascript" src="SWF/js/swfupload.queue.js"></script>
<script type="text/javascript" src="SWF/js/fileprogress.js"></script>
<script type="text/javascript" src="SWF/js/handlers.js"></script>

<script type="text/javascript">
    var swfu;

    window.onload = function() {
        var settings = {
            flash_url : "SWF/swfupload/swfupload.swf",
            upload_url: "http://localhost/dashixun/yii2/frontend/web/SWF/upload.php",	// Relative to the SWF file
            post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
            file_size_limit : "100 MB",
            file_types : "*.*",
            file_types_description : "All Files",
            file_upload_limit : 100,
            file_queue_limit : 0,
            custom_settings : {
                progressTarget : "fsUploadProgress",
                cancelButtonId : "btnCancel"
            },
            debug: false,

            // Button settings
            button_image_url: "SWF/images/TestImageNoText_65x29.png",	// Relative to the Flash file
            button_width: "65",
            button_height: "29",
            button_placeholder_id: "spanButtonPlaceHolder",
            button_text: '<span class="theFont">上传</span>',
            button_text_style: ".theFont { font-size: 16; }",
            button_text_left_padding: 12,
            button_text_top_padding: 3,

            // The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete	// Queue plugin event
        };

        swfu = new SWFUpload(settings);
        // alert(111);
        // echo swfu;
    };
</script>

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
        <form id="reply-form" class="form-horizontal form ng-pristine ng-valid" action="?r=reply/voice" method="post" enctype="multipart/form-data">
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
<!--                                                <input type="checkbox" ng-model="reply.advSetting" class="ng-pristine ng-untouched ng-valid"> 高级设置-->
                                                <a href="javascript:void(0);" id="lol">高级设置</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="timo">
                                <div class="form-group ng-hide" ng-show="reply.advSetting">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="" value="1" checked="checked"> 启用
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="" value="0"> 禁用
                                        </label>
                                        <span class="help-block">您可以临时禁用这条回复.</span>
                                    </div>
                                </div>
                                <div class="form-group ng-hide" ng-show="reply.advSetting">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">置顶回复</label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="" ng-model="reply.entry.istop" ng-value="1" value="1" class="ng-pristine ng-untouched ng-valid"> 置顶
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="" ng-model="reply.entry.istop" ng-value="0" value="0" checked="checked" class="ng-pristine ng-untouched ng-valid"> 普通
                                        </label>
                                        <span class="help-block">“置顶”时无论在什么情况下均能触发且使终保持最优先级</span>
                                    </div>
                                </div>
                                <div class="form-group ng-hide" ng-show="reply.advSetting &amp;&amp; !reply.entry.istop">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">优先级</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="输入这条回复规则优先级" name="" value="">
                                        <span class="help-block">规则优先级，越大则越靠前，最大不得超过254</span>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">触发关键字</label>
                                    <div class="col-sm-6 col-md-8 col-xs-12">
<!--                                        <input type="hidden" name="rid" value="0">-->
                                        <input type="text" name="keyword" class="form-control keyword ng-pristine ng-untouched ng-valid" placeholder="请输入触发关键字" ng-model="trigger.items.default" id="keywordinput" onblur="checkKeyWord($(this));" data-type="keyword">
                                        <span class="help-block"></span>
<!--                                        <input type="hidden" name="keywords">-->
									<span class="help-block">
										当用户的对话内容符合以上的关键字定义时，会触发这个回复定义。多个关键字请使用逗号隔开。<a href="javascript:;" id="keyword" data-original-title="" title=""><i class="fa fa-github-alt"></i> 表情</a> <br>
										<strong class="text-danger">选择高级触发: 将会提供一系列的高级触发方式供专业用户使用(注意: 如果你不了解, 请不要使用). </strong>
									</span>
                                    </div>
                                    <div class="col-sm-3 col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <a href="javascript:void(0);" id="lolo">高级触发</a>
                                                <!--                                                <input type="checkbox" ng-model="reply.advTrigger" class="ng-pristine ng-untouched ng-valid"> 高级触发-->
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="timom">
                                <div class="form-group ng-hide" ng-show="reply.advTrigger">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">高级触发列表</label>
                                    <div class="col-sm-9">
                                        <div class="panel panel-default tab-content">
                                            <div class="panel-heading">
                                                <ul class="nav nav-pills">
                                                    <li class="active"><a href="http://wcmall.bj165.com/web/index.php?c=platform&amp;a=reply&amp;do=post&amp;m=voice#contains" data-toggle="tab">包含关键字</a></li>
                                                    <li><a href="http://wcmall.bj165.com/web/index.php?c=platform&amp;a=reply&amp;do=post&amp;m=voice#regexp" data-toggle="tab">正则表达式模式匹配</a></li>
                                                    <li><a href="http://wcmall.bj165.com/web/index.php?c=platform&amp;a=reply&amp;do=post&amp;m=voice#trustee" data-toggle="tab">直接接管</a></li>
                                                </ul>
                                            </div>
                                            <ul class="tab-pane list-group active" id="contains">
                                                <!-- ngRepeat: entry in trigger.items.contains -->
                                            </ul>
                                            <ul class="tab-pane list-group" id="regexp">
                                                <!-- ngRepeat: entry in trigger.items.regexp -->
                                            </ul>
                                            <ul class="tab-pane list-group" id="trustee">
                                                <!-- ngRepeat: entry in trigger.items.trustee -->
                                            </ul>
                                            <div class="panel-footer">
                                                <a href="javascript:;" class="btn btn-default ng-binding" ng-click="trigger.addItem();" ng-bind="&#39;添加&#39; + trigger.labels[trigger.active]">添加包含关键字</a>
                                                <span class="help-block ng-binding" ng-bind-html="trigger.descriptions[trigger.active]">用户进行交谈时，对话中包含上述关键字就执行这条规则。</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        回复内容
                                    </div>
                                    <div id="content">

                                        <!-- <form id="form1" action="index.php" method="post" enctype="multipart/form-data"> -->

                                        <div class="fieldset flash" height="1px" width="10" id="fsUploadProgress">

                                        </div>
                                        <!--                <input type="text" name="" disabled="true" id="aa" value=""/><br />-->
                                        <div>
                                            <span id="spanButtonPlaceHolder"></span>
                                            <input id="btnCancel" type="button" value="取消" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
                                        </div>

                                        <!-- </form> -->
                                        <!-- <span id="dd"></span> -->
                                        <input type="hidden" name="file_name" id="dd"/><br />
                                        <span id="aa"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                    <input  type="submit" value="提交" class="btn btn-primary col-lg-1">
                </div>
            </div>
        </form>
    </div>
</div>
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