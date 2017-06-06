
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $title ?></title>
<meta name="keywords" content="<?= $keywords ?>">
<meta name="description" content="<?= $description ?>">
<link rel="shortcut icon" href="http://wcmall.bj165.com/attachment/images/global/wechat.jpg">
<link href="./public/css/bootstrap.css" rel="stylesheet">
<link href="./public/css/font-awesome.css" rel="stylesheet">
<link href="./public/css/common.css" rel="stylesheet">
<script>var require = { urlArgs: 'v=2017041021' };</script>
<script src="./public/js/jquery-1_002.js"></script>
<script src="./public/js/util.js"></script>
<script src="./public/js/require.js"></script>
<script src="./public/js/config.js"></script>
<script type="text/javascript">
    if(navigator.appName == 'Microsoft Internet Explorer'){
        if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
            alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
        }
    }

    window.sysinfo = {
        'uniacid': '12',
        'acid': '12',
        'uid': '8',
        'siteroot': 'http://wcmall.bj165.com/',
        'siteurl': 'http://wcmall.bj165.com/web/index.php?c=platform&a=reply&m=basic',
        'attachurl': 'http://wcmall.bj165.com/attachment/',
        'attachurl_local': 'http://wcmall.bj165.com/attachment/',
        'cookie' : {'pre': '8cee_'}
    };
</script>
<script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery" src="./public/js/jquery-1.js"></script>
<script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="bootstrap" src="./public/js/bootstrap.js"></script>
</head>
<div class="navbar navbar-inverse navbar-static-top" role="navigation" style="position:static;">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="?r=wsite/test"><i class="fa fa-cog"></i>微站设置</a>
            </li>
            <li class="active">
                <a href="?r=user/test"><i class="fa fa-cog"></i>系统设置</a>
            </li>
            <li class="active">
                <a href="?r=user/news"><i class="fa fa-cog"></i>基础设置</a>
            </li>
            <li>
                <a href="?r=make/fans"><i class="fa fa-life-bouy"></i>微站营销</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown topbar-notice">
                <a type="button" data-toggle="dropdown">
                    <i class="fa fa-bell"></i>
                    <span class="badge" id="notice-total">0</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dLabel">
                    <div class="topbar-notice-panel">
                        <div class="topbar-notice-arrow"></div>
                        <div class="topbar-notice-head">系统公告</div>
                        <div class="topbar-notice-body">
                            <ul id="notice-container"></ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i class="fa fa-group"></i>xpx <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#" target="_blank"><i class="fa fa-weixin fa-fw"></i> 编辑当前账号资料</a>
                    </li>
                    <li>
                        <a href="#" target="_blank"><i class="fa fa-cogs fa-fw"></i> 管理其它公众号</a>
                    </li>
                    <li>
                        <a href="#" target="_blank"><i class="fa fa-mobile fa-fw"></i> 模拟测试</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:185px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i class="fa fa-user"></i> <?php $session = \Yii::$app->session;
                    $res = $session->get('user');
                    echo $res['username'];
                    ?> (公众号管理员) <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#" target="_blank"><i class="fa fa-weixin fa-fw"></i> 我的账号</a></li>
                    <li><a href="index.php?r=login/login_out"><i class="fa fa-sign-out fa-fw"></i> 退出系统</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>