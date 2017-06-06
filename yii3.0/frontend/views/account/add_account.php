<html lang="zh-cn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加/编辑公众号 - 商城系统V1.7</title>
    <meta name="keywords" content="商城系统">
    <meta name="description" content="商城系统">
    <link rel="shortcut icon" href="http://wcmall.bj165.com/attachment/images/global/wechat.jpg">
    <link href="ass/bootstrap.min.css" rel="stylesheet">
    <link href="ass/font-awesome.min.css" rel="stylesheet">
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
            'siteurl': 'http://wcmall.bj165.com/web/index.php?c=account&a=post-step&uniacid=0&step=2',
            'attachurl': 'http://wcmall.bj165.com/attachment/',
            'attachurl_local': 'http://wcmall.bj165.com/attachment/',
            'cookie' : {'pre': '8cee_'}
        };
    </script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="biz" src="ass/biz.js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery" src="ass/jquery-1.11.1.min(1).js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="bootstrap" src="ass/bootstrap.min.js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="filestyle" src="ass/bootstrap-filestyle.min.js"></script></head>
<body>
<div class="gw-container" style="background-image:url(./public/css/images/gw-bg.jpg);min-height: 746px;">
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
                <li class="normal"><a href="javascript:;">1. 一键获取公众号信息</a></li>
                <li class="active"><a href="javascript:;">2. 设置公众号信息</a></li>
                <li class="normal"><a href="javascript:;">3. 设置权限</a></li>
                <li class="normal"><a href="javascript:;">4. 引导页面</a></li>
            </ul>

            <div class="clearfix">
                <form action="index.php?r=account/add_do" method="post" class="form-horizontal" role="form" enctype="multipart/form-data" id="form1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            设置公众号信息
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 公众号名称</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" name="name" class="form-control" value="" autocomplete="off">
                                    <span class="help-block">填写公众号的帐号名称</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">描述</label>
                                <div class="col-sm-9 col-xs-12">
                                    <textarea style="height: 80px;" class="form-control" name="desc"></textarea>
                                    <span class="help-block">用于说明此公众号的功能及用途。</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">公众号帐号</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" name="account" class="form-control" value="" autocomplete="off">
                                    <span class="help-block">填写公众号的帐号，一般为英文帐号</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">原始ID</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" name="origina" class="form-control" value="" autocomplete="off">
                                    <span class="help-block">在给粉丝发送客服消息时,原始ID不能为空。建议您完善该选项</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">级别</label>
                                <div class="col-sm-9 col-xs-12">
                                    <label for="status_1" class="radio-inline"><input autocomplete="off" type="radio" name="type" id="status_1" value="1" checked=""> 普通订阅号</label>
                                    <label for="status_2" class="radio-inline"><input autocomplete="off" type="radio" name="type" id="status_2" value="2"> 普通服务号</label>
                                    <label for="status_3" class="radio-inline"><input autocomplete="off" type="radio" name="type" id="status_3" value="3"> 认证订阅号</label>
                                    <label for="status_4" class="radio-inline"><input autocomplete="off" type="radio" name="type" id="status_4" value="4"> 认证服务号/认证媒体/政府订阅号</label>
                                    <span class="help-block">注意：即使公众平台显示为“未认证”, 但只要【公众号设置】/【账号详情】下【认证情况】显示资质审核通过, 即可认定为认证号.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppId</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" name="appid" class="form-control" value="" autocomplete="off">
                                    <div class="help-block">请填写微信公众平台后台的AppId</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppSecret</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" name="appsecret" class="form-control" value="" autocomplete="off">
                                    <div class="help-block">请填写微信公众平台后台的AppSecret, 只有填写这两项才能管理自定义菜单</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">Oauth 2.0</label>
                                <div class="col-sm-9 col-xs-12">
                                    <p class="form-control-static">在微信公众号请求用户网页授权之前，开发者需要先到公众平台网站的【开发者中心】<b>网页服务</b>中配置授权回调域名。<a href="http://www.bj165.com/manual/dev:v0.6:qa:mobile_redirect_url_error" target="_black">查看详情</a></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">二维码</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="file" name="qrcode" value="" id="filestyle-0" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control " disabled=""> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="filestyle-0" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span> 上传图片</label></span></div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">头像</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="file" name="head_url" value="" id="filestyle-1" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control " disabled=""> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="filestyle-1" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span> 上传图片</label></span></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                            <a href="index.php?r=account/add" class="btn btn-default">返回上一步</a>
                            <input name="" type="submit" value="下一步" class="btn btn-primary">
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