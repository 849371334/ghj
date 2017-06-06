<!DOCTYPE html>
<html lang="zh-cn"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商城系统V1.7</title>
    <meta name="keywords" content="商城系统">
    <meta name="description" content="商城系统">
    <link rel="shortcut icon" href="http://wcmall.bj165.com/attachment/images/global/wechat.jpg">
    <link href="public/css/bootstrap.css" rel="stylesheet">
    <link href="public/css/font-awesome.css" rel="stylesheet">
    <link href="public/css/common.css" rel="stylesheet">
    <script>var require = { urlArgs: 'v=2017041109' };</script>
    <script src="public/js/jquery-1_002.js"></script>
    <script src="public/js/util.js"></script>
    <script src="public/js/require.js"></script>
    <script src="public/js/config.js"></script>
    <!--[if lt IE 9]>
    <script src="public/js/html5shiv.min.js"></script>
    <script src="public/js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        if(navigator.appName == 'Microsoft Internet Explorer'){
            if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
                alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
            }
        }

        window.sysinfo = {
            'uniacid': '12',
            'acid': '12',
            'siteroot': 'http://wcmall.bj165.com/',
            'siteurl': 'http://wcmall.bj165.com/web/index.php?c=user&a=login&',
            'attachurl': 'http://wcmall.bj165.com/attachment/',
            'attachurl_local': 'http://wcmall.bj165.com/attachment/',
            'cookie' : {'pre': '8cee_'}
        };
    </script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery" src="public/js/jquery-1.js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="bootstrap" src="public/js/bootstrap.js"></script></head>
<body>
<div class="gw-container" style="min-height: 633px;">

    <div class="navbar navbar-static-top" role="navigation" style="padding-top:20px;">
        <div class="container-fluid">
            <ul class="nav navbar-nav pull-right" style="padding-top:10px;">
                <a href="#" class="tile img-rounded">
                    <i class="fa fa-comments"></i>
                    <span>公众号管理</span>
                </a>
                <a href="#" class="tile img-rounded">
                    <i class="fa fa-sitemap"></i>
                    <span>系统</span>
                </a>
            </ul>
        </div>
    </div>

    <div class="container-fluid">
        <div>
            <div class="jumbotron clearfix alert alert-success">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
                        <i class="fa fa-5x fa-check-circle"></i>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
                        <h2></h2>
                        <p>一键获取信息失败,请手动设置公众号信息！</p>
                        <p> <a href="index.php?r=account/add" class="alert-link">[点击这里返回上一页]</a>
                            <a href="index.php?r=account/list" class="alert-link">[首页]</a></p>
                        <script type="text/javascript">
                            setTimeout(function () {
                                location.href = "./index.php?r=account/add";
                            }, 3000);
                        </script>
                    </div>
                </div>
            </div>
            <script>
                var h = document.documentElement.clientHeight;
                $(".gw-container").css('min-height',h);
            </script>			</div>
    </div>
    <script type="text/javascript">
        require(['bootstrap']);

    </script>
    <div class="center-block footer" role="footer">
        <div class="text-center">
        </div>
        <div class="text-center">
            商城系统			</div>
    </div>
</div>
</body></html>