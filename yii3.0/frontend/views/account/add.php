<!DOCTYPE html>
<!-- saved from url=(0060)http://wcmall.bj165.com/web/index.php?c=account&a=post-step& -->
<html lang="zh-cn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加/编辑公众号 - 商城系统V1.7</title>
    <meta name="keywords" content="商城系统">
    <meta name="description" content="商城系统">
    <link rel="shortcut icon" href="http://wcmall.bj165.com/attachment/images/global/wechat.jpg">
    <link href="ass/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/font-awesome.css" rel="stylesheet">
    <link href="ass/common.css" rel="stylesheet">
    <script>var require = { urlArgs: 'v=2017051116' };</script>
    <script src="ass/jquery-1.11.1.min.js"></script>
    <script src="ass/util.js"></script>
    <script src="ass/require.js"></script>
    <script src="ass/config.js"></script>
    <script type="text/javascript">
        if(navigator.appName == 'Microsoft Internet Explorer'){
            if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
                alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
            }
        }

        window.sysinfo = {
            'uniacid': '20',
            'acid': '20',
            'uid': '8',
            'siteroot': 'http://wcmall.bj165.com/',
            'siteurl': 'http://wcmall.bj165.com/web/index.php?c=account&a=post-step&',
            'attachurl': 'http://wcmall.bj165.com/attachment/',
            'attachurl_local': 'http://wcmall.bj165.com/attachment/',
            'cookie' : {'pre': '8cee_'}
        };
    </script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="biz" src="ass/biz.js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery" src="ass/jquery-1.11.1.min(1).js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="bootstrap" src="ass/bootstrap.min.js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="filestyle" src="ass/bootstrap-filestyle.min.js"></script></head>
<body>
<div class="gw-container" style="background-image:url(./public/css/images/gw-bg.jpg);min-height: 746px;" >

    <div class="navbar navbar-static-top" role="navigation" style="padding-top:20px;">
        <div class="container-fluid">
            <ul class="nav navbar-nav pull-right" style="padding-top:10px;">
                <a href="index.php?r=account/list" class="tile img-rounded active">
                    <i class="fa fa-comments"></i>
                    <span>公众号管理</span>
                </a>
                <a href="#" class="tile img-rounded">
                    <i class="fa fa-sitemap"></i>
                    <span>系统</span>
                </a>
                <a href="index.php?r=login/login_out" class="tile img-rounded">
                    <i class="fa fa-sign-out"></i>
                    <span>退出</span>
                </a>
            </ul>
        </div>
    </div>

    <div class="container-fluid">
        <div class="well">
            <script>
                var h = document.documentElement.clientHeight;
                $(".gw-container").css('min-height',h);
            </script><ol class="breadcrumb">
                <li><a href="http://wcmall.bj165.com/web/?refresh"><i class="fa fa-home"></i></a></li>
                <li><a href="index.php?r=account/list">公众号列表</a></li>
                <li class="active">编辑主公众号</li>
            </ol>
            <style>
                .nav-width{border-bottom:0;}
                .nav-width li.active{width:20%;text-align:center;overflow:hidden;height:40px;}
                .nav-width .normal{background:#EEEEEE;width:26.6%;text-align:center;overflow:hidden;height:40px;}
                .guide em{font-style:normal; color:#d9534f;}
                .guide .list-group .list-group-item a{color:#07d;}
                .guide .list-group .list-group-item{padding-top:20px;}
                .guide .img{margin-bottom:15px; display:inline-block; border:1px solid #cccccc;padding:3px;}
                .guide .con{padding: 10px 30px;}
            </style>
            <ul class="nav nav-tabs nav-width">
                <li class="active"><a href="javascript:;">1. 一键获取公众号信息</a></li>
                <li class="normal"><a href="javascript:;">2. 设置公众号信息</a></li>
                <li class="normal"><a href="javascript:;">3. 设置权限</a></li>
                <li class="normal"><a href="javascript:;">4. 引导页面</a></li>
            </ul>
            <div class="clearfix">
                <form action="index.php?r=account/login" method="post" class="form-horizontal" role="form" enctype="multipart/form-data" id="form1">
                    <input type="hidden" name="uniacid" value="0">
                    <input type="hidden" name="step" value="2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            一键获取公众号信息
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">公众登录用户</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" name="wxusername" id="username" class="form-control" value="" autocomplete="off">
                                    <span class="help-block">请输入你的公众平台用户名</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">公众登录密码</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="password" name="wxpassword" class="form-control" value="" autocomplete="off">
                                    <span class="help-block">请输入你的公众平台密码</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                            <input name="getinfo" type="submit" value="一键获取" class="btn btn-primary">
                            <a href="index.php?r=account/add_account" class="btn btn-default">不获取，直接填写</a>
                        </div>
                    </div>
                </form>
            </div>
            <script type="text/javascript">
                $('.clip p a').each(function(){
                    util.clip(this, $(this).text());
                });
                require(['biz', 'filestyle'], function(biz){
                    $(function(){
                        $('#username').blur(function(){
                            if ($('#username').val()) {
                                var type = $('input[name="type"]:checked').val() ? $('input[name="type"]:checked').val() : 1;
                                $('#imgverify').attr('src', './index.php?c=utility&a=wxcode&username=' + $('#username').val()+'&r='+Math.round(new Date().getTime()));
                                $('#imgverify').parent().parent().parent().show();
                                return false;
                            }
                        });
                        $('#toggle').click(function(){
                            if ($('#username').val()) {
                                var type = $('input[name="type"]:checked').val() ? $('input[name="type"]:checked').val() : 1;
                                $('#imgverify').attr('src', './index.php?c=utility&a=wxcode&username=' + $('#username').val()+'&r='+Math.round(new Date().getTime()));
                                $('#imgverify').parent().parent().parent().show();
                                return false;
                            }
                        });
                        $(".form-group").find(':file').filestyle({buttonText: '上传图片'});
                    });
                });
                function tokenGen() {
                    var letters = 'abcdefghijklmnopqrstuvwxyz0123456789';
                    var token = '';
                    for(var i = 0; i < 32; i++) {
                        var j = parseInt(Math.random() * (31 + 1));
                        token += letters[j];
                    }
                    $(':text[name="wetoken"]').val(token);
                }
                function EncodingAESKeyGen() {
                    var letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    var token = '';
                    for(var i = 0; i < 43; i++) {
                        var j = parseInt(Math.random() * 61 + 1);
                        token += letters[j];
                    }
                    $(':text[name="encodingaeskey"]').val(token);
                }
            </script>
        </div>
    </div>
    <script type="text/javascript">
        require(['bootstrap']);

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
    <div class="center-block footer" role="footer">
        <div class="text-center">
        </div>
        <div class="text-center">
            商城系统			</div>
    </div>
</div>


</body></html>