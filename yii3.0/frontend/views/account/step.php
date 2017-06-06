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
            'siteurl': 'http://wcmall.bj165.com/web/index.php?c=account&a=post-step&uniacid=22&acid=22&step=4',
            'attachurl': 'http://wcmall.bj165.com/attachment/',
            'attachurl_local': 'http://wcmall.bj165.com/attachment/',
            'cookie' : {'pre': '8cee_'}
        };
    </script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery.zclip" src="ass/jquery.zclip.min.js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="biz" src="ass/biz.js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery" src="ass/jquery-1.11.1.min(1).js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="bootstrap" src="ass/bootstrap.min.js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="filestyle" src="ass/bootstrap-filestyle.min.js"></script></head>
<body>
<div class="gw-container" style="background-image:url(./public/css/images/gw-bg.jpg);min-height: 746px;">
    <div class="navbar navbar-static-top" role="navigation" style="padding-top:20px;">
        <div class="container-fluid">
            <ul class="nav navbar-nav pull-right" style="padding-top:10px;">
                <a href="index.php?r=account/list" class="tile img-rounded active">
                    <i class="fa fa-comments"></i>
                    <span>公众号管理</span>
                </a>
                <a href="http://wcmall.bj165.com/web/index.php?c=system&amp;a=welcome&amp;" class="tile img-rounded">
                    <i class="fa fa-sitemap"></i>
                    <span>系统</span>
                </a>
                <a href="index.php?r=login_login_out" class="tile img-rounded">
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
                <li class="normal"><a href="javascript:;">2. 设置公众号信息</a></li>
                <li class="normal"><a href="javascript:;">3. 设置权限</a></li>
                <li class="active"><a href="javascript:;">4. 引导页面</a></li>
            </ul>

            <div class="clearfix">
                <div class="panel panel-default guide">
                    <div class="panel-heading">
                        接入到公众平台
                    </div>

                    <div class="panel-body">
                        <h4 class="alert alert-info">您绑定的微信公众号：<em><?php echo $arr;?></em>，请按照下列引导完成配置。</h4>
                        <div class="list-group">
                            <div class="list-group-item">
                                <h5 class="page-header">登录 <a href="https://mp.weixin.qq.com/" target="_blank">微信公众平台</a>，点击左侧菜单最后一项，进入 [ <em>开发者中心</em> ]</h5>
                                <div class="con">
                                    <div class="img"><img src="ass/guide-01.png"></div>
                                    <p># 如果您未成为开发者，请勾选页面上的同意协议，再点击 [ <em>成为开发者</em> ] 按钮</p>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <h5 class="page-header">在开发者中心，找到［<em> 服务器配置</em> ］栏目下URL和Token设置</h5>
                                <div class="con">
                                    <div class="img"><img src="ass/guide-02.png"></div>
                                    <p># 将以下链接链接填入对应输入框：</p>
                                    <form action="http://wcmall.bj165.com/web/index.php?c=account&amp;a=post-step&amp;uniacid=22&amp;acid=22&amp;step=4" method="post" class="form-horizontal" role="form">
                                        <div class="form-group clip">
                                            <label class="col-xs-12 col-sm-2 col-md-1 col-lg-1 control-label">URL:</label>
                                            <div class="col-sm-9 col-xs-12 input-group ">
                                                <p class="form-control-static"><a href="javascript:;" title="点击复制Token"><?php echo $url;?></a><div class="zclip" id="zclip-ZeroClipboardMovie_1" style="position: absolute; left: 0px; top: 9px; width: 240px; height: 16px; z-index: 99;"><embed id="ZeroClipboardMovie_1" src="./resource/components/zclip/ZeroClipboard.swf" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="240" height="16" name="ZeroClipboardMovie_1" align="middle" allowscriptaccess="always" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="id=1&amp;width=240&amp;height=16" wmode="transparent"></div></p>
                                            </div>
                                        </div>
                                        <div class="form-group clip">
                                            <label class="col-xs-12 col-sm-2 col-md-1 col-lg-1 control-label">Token:</label>
                                            <div class="col-sm-9 col-xs-12 input-group">
                                                <p class="form-control-static"> <a href="javascript:;" title="点击复制Token"><?php echo $token?></a><div class="zclip" id="zclip-ZeroClipboardMovie_2" style="position: absolute; left: 0px; top: 9px; width: 234px; height: 16px; z-index: 99;"><embed id="ZeroClipboardMovie_2" src="./resource/components/zclip/ZeroClipboard.swf" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="234" height="16" name="ZeroClipboardMovie_2" align="middle" allowscriptaccess="always" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="id=2&amp;width=234&amp;height=16" wmode="transparent"></div></p>
                                            </div>
                                        </div>
                                        <div class="form-group clip">
                                            <label class="col-xs-12 col-sm-2 col-md-1 col-lg-1 control-label">EncodingAESKey:</label>
                                            <div class="col-sm-10 input-group">
                                                <p class="form-control-static"> <a href="javascript:;" title="点击复制EncodingAESKey">T35LNATCna379r37N523237YW22l7A555wy3z1w3299</a><div class="zclip" id="zclip-ZeroClipboardMovie_3" style="position: absolute; left: 0px; top: 9px; width: 348px; height: 16px; z-index: 99;"><embed id="ZeroClipboardMovie_3" src="./resource/components/zclip/ZeroClipboard.swf" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="348" height="16" name="ZeroClipboardMovie_3" align="middle" allowscriptaccess="always" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="id=3&amp;width=348&amp;height=16" wmode="transparent"></div></p>
                                            </div>
                                        </div>
                                    </form>
                                    <p># 如果以前已填写过URL和Token，请点击[<em> 修改配置 </em>] ，再填写上述链接</p>
                                    <p># 请点击 [<em> 启用 </em>] ，以启用服务器配置：</p>
                                    <div class="img"><img src="ass/guide-03.png" width="524"></div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <h5 class="page-header">

                                    <em>公众号 <?php echo $arr;?> 正在等待接入……请及时按照以上步骤操作接入公众平台</em>
                                </h5>
                                <div class="con">
                                    <p># 检查公众平台配置</p>
                                    <p># 编辑公众号 <a href="http://wcmall.bj165.com/web/index.php?c=account&amp;a=post&amp;acid=22&amp;uniacid=22"><?php echo $arr;?> </a></p>
                                    <a href="javascript:window.location.reload();" class="btn btn-success" style="color:#FFF">检测是否接入成功</a>&nbsp;&nbsp;&nbsp;<a href="index.php?r=user/news" class="btn btn-primary" style="color:#FFF">暂不接入，先去查看管理功能</a>
                                    <a href="index.php?r=account/list" class="btn btn-info" style="color:#FFF">返回公众号列表</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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