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
    <meta http-equiv="Refresh" content="<?= $time?>;URL=<?= $url?>">
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

    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery" src="public/js/jquery-1.js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="bootstrap" src="public/js/bootstrap.js"></script></head>
<body>
<div class="gw-container" style="min-height: 633px;">

    <div class="navbar navbar-static-top" role="navigation" style="padding-top:20px;">
        <div class="container-fluid">
            <ul class="nav navbar-nav pull-right" style="padding-top:10px;">
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
                        <p><?= $str?></p>
                        <p><a href="<?= $url?>" class="alert-link">如果你的浏览器没有自动跳转，请点击此链接</a></p>
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