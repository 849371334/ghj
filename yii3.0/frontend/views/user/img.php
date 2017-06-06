<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/sys_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
<script src="jquery.js"></script>

<link href="SWF/css/default.css" />
<script type="text/javascript" src="SWF/swfupload/swfupload.js"></script>
<script type="text/javascript" src="SWF/js/swfupload.queue.js"></script>
<script type="text/javascript" src="SWF/js/fileprogress.js"></script>
<script type="text/javascript" src="SWF/js/handlers.js"></script>

    <ul class="nav nav-tabs">
        <li class="active"><a href="index.php?r=user/news">添加基本图文回复</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <li class="active"><a href="index.php?r=user/img">添加基本音乐回复</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <li class="active"><a href="index.php?r=user/voice">添加基本语音回复</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <li class="active"><a href="index.php?r=user/video">添加基本视频回复</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </ul>
<script type="text/javascript">
    var swfu;

    window.onload = function() {
        var settings = {
            flash_url : "SWF/swfupload/swfupload.swf",
            upload_url: "http://www.yii.com/yii2/frontend/web/SWF/upload.php",	// Relative to the SWF file
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
 <form id="reply-form" class="form-horizontal form ng-pristine ng-valid" action="?r=reply/music" enctype="multipart/form-data" method="post">

     <div class="form-group">
         <div class="col-sm-12">
             <div class="panel panel-default">
                 <div class="panel-heading">添加回复规则 <span class="text-muted">删除，修改规则、关键字以及回复后，请提交以保存操作。</span></div>
                 <ul class="list-group">
                     <li class="list-group-item">
                         <div class="form-group">
                             <label class="col-xs-12 col-sm-3 col-md-2 control-label">回复规则名称</label>
                             <div class="col-sm-6 col-md-8 col-xs-12">
                                 <input type="text" class="form-control" placeholder="请输入回复规则的名称" name="name">
									<span class="help-block">
										您可以给这条规则起一个名字, 方便下次修改和查看. <br>
										<strong class="text-danger">选择高级设置: 将会提供一系列的高级选项供专业用户使用.</strong>
									</span>
                             </div>

                         </div>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
     <div class="panel panel-default">
            <div class="panel-heading">
                回复内容
            </div>
            <div id="content">
            <div class="fieldset flash" height="1px" width="10" id="fsUploadProgress">

                </div>
                <div>
                    <span id="spanButtonPlaceHolder"></span>
                    <input id="btnCancel" type="button" value="取消" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
                </div>
                <input type="text" name="file_name" id="dd"/><br />
                <span id="aa"></span>
            </div>
                </div>
            <div  id="reply-form" class="form-horizontal form ng-pristine ng-valid">
                <div class="panel-heading">
                    关键字
                </div>

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
            </div>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                <input  type="submit" value="提交" class="btn btn-primary col-lg-1">
            </div>
        </div>
        </form>
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

    </div>

<form action="index.php?r=user/login_do" method="post" >
    <div class="login_table">
        <div class="login_name">
            <?php $cookie = \Yii::$app->request->cookies;
            $user = $cookie->getValue('rember') ;
            if ($user){
                ?>
                <input name="username" class="login_input" placeholder="用户名\手机号\邮箱" type="text" value="<?php echo $user ?>">
            <?php } else { ?>
                <input name="username" class="login_input" placeholder="用户名\手机号\邮箱" type="text" >
            <?php } ?>
        </div>
        <div class="login_pw"><input name="password" class="login_input" placeholder="请输入密码" type="password"></div>
        <div class="login_jz"><input name="rember" value="1" type="checkbox">记住帐号</div>
        <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
        <div class="login_button"> <input name="submit" class="input_button" value="登 录" type="submit"> </div>
    </div>
</form>