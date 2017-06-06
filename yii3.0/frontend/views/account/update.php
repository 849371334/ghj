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
<div class="gw-container">
    <div class="navbar navbar-inverse navbar-static-top" role="navigation" style="z-index:1001; margin-bottom:0;">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="active"><a href="?r=account/list"><i class="fa fa-cogs"></i>系统管理</a></li>
                <li><a href="index.php?r=account/conf&id=<?php echo $account['id']?>" target="_blank"><i class="fa fa-share"></i>继续管理公众号（<?= $account['name']?>）</a></li>

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
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"  style="display:block; max-width:150px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i class="fa fa-group"></i><?= $account['name']?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="?r=account/list" ><i class="fa fa-cogs fa-fw"></i> 管理其它公众号</a></li>
                        <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-mobile fa-fw"></i> 模拟测试</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:185px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i class="fa fa-user"></i><?= Yii::$app->session->get('user')['username'];?> (公众号管理员) <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="./index.php?c=user&a=profile&do=profile&" target="_blank"><i class="fa fa-weixin fa-fw"></i> 我的账号</a></li>
                        <li><a href="./index.php?c=user&a=logout&"><i class="fa fa-sign-out fa-fw"></i> 退出系统</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="navbar navbar-static-top" role="navigation" style="padding-top:20px;">
        <div class="container-fluid">
            <ul class="nav navbar-nav pull-right" style="padding-top:10px;">
                <a href="index.php?r=account/conf&id=<?php echo $account['id']?>" target='_blank' class="tile img-rounded">
                    <i class="fa fa-sitemap"></i>
                    <span>公众号管理</span>
                </a>
                <a href="index.php?r=account/list" class="tile img-rounded">
                    <i class="fa fa-sign-out"></i>
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
                <li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
                <li><a href="?r=account/list">公众号列表</a></li>
                <li class="active">编辑主公众号</li>
            </ol>
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">账号基本信息</a></li>
            </ul>

            <div class="clearfix">
                <form action="?r=account/update_do" method="post"  class="form-horizontal" role="form" enctype="multipart/form-data" id="form1">
                    <input type="hidden" name="id" value="<?=$account['id']?>" />
                    <h5 class="page-header">基础信息</h5>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">公众平台登录用户</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" id="username" class="form-control" value="<?=$account['name']?>" autocomplete="off" onblur="verifyGen()" />
                            <span class="help-block">请输入你的公众平台用户名</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">公众平台登录密码</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="password" class="form-control" value="" autocomplete="off"  />
                            <span class="help-block">请输入你的公众平台密码</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 主公众号名称</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="name" class="form-control" value="<?=$account['name']?>" autocomplete="off" />
                            <span class="help-block">填写公众号的帐号名称</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">描述</label>
                        <div class="col-sm-9 col-xs-12">
                            <textarea style="height: 80px;" class="form-control" name="desc"><?= $account['desc']?></textarea>
                            <span class="help-block">用于说明此公众号的功能及用途。</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">公众号帐号</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="account" class="form-control" value="<?= $account['account']?>" autocomplete="off" />
                            <span class="help-block">填写公众号的帐号，一般为英文帐号</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">原始ID</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="origina" class="form-control" value="<?= $account['origina']?>" autocomplete="off" />
                            <span class="help-block">在给粉丝发送客服消息时,原始ID不能为空。建议您完善该选项</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">引导关注素材</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="reply" value="<?= $account['reply']?>" class="form-control" autocomplete="off">
                            <span class="help-block">建议设置一条引导关注的素材链接,为空则跳转回测试起始界面。例:
					<a href="javascript:;" data-toggle="modal" data-target="#subscribeurl">点击查看</a>
				</span>
                        </div>
                    </div>
                    <!-- 引导素材示例模态框 -->
                    <div class="modal fade" id="subscribeurl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width:740px;">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">引导关注示例</h4>
                                </div>
                                <div class="modal-body">
                                    <h4>引导关注素材示例页面</h4>
                                    <span class="help-block">2017-05-28&nbsp;&nbsp;
						<a href="javascript:;"><?= $account['name']?></a></span>
                                    <img src="./uploads/subscribe.gif" />
                                    <span class="help-block">京华微商是由京华一诺深度开发的一款功能齐全的微信公众平台管理系统。</span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">级别</label>
                        <div class="col-sm-9 col-xs-12">
                            <label for="status_1" class="radio-inline"><input autocomplete="off" type="radio" name="type" id="status_1" value="1"  <?if($account['type'] == 1){echo 'checked';}?> > 普通订阅号</label>
                            <label for="status_2" class="radio-inline"><input autocomplete="off" type="radio" name="type" id="status_2" value="2"  <?if($account['type'] == 2){echo 'checked';}?> /> 普通服务号</label>
                            <label for="status_3" class="radio-inline"><input autocomplete="off" type="radio" name="type" id="status_3" value="3"  <?if($account['type'] == 3){echo 'checked';}?> /> 认证订阅号</label>
                            <label for="status_4" class="radio-inline"><input autocomplete="off" type="radio" name="type" id="status_4" value="4"  <?if($account['type'] == 4){echo 'checked';}?> /> 认证服务号/认证媒体/政府订阅号</label>
                            <span class="help-block">注意：即使公众平台显示为“未认证”, 但只要【公众号设置】/【账号详情】下【认证情况】显示资质审核通过, 即可认定为认证号.</span>
                        </div>
                    </div>
                    <div id="auth" >
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppId</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" name="appid" class="form-control" value="<?= $account['appid']?>" autocomplete="off"/>
                                <div class="help-block">请填写微信公众平台后台的AppId</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppSecret</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" name="appsecret" class="form-control" value="<?= $account['appsecret']?>" autocomplete="off"/>
                                <div class="help-block">请填写微信公众平台后台的AppSecret, 只有填写这两项才能管理自定义菜单</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">Oauth 2.0</label>
                            <div class="col-sm-9 col-xs-12">
                                <p class="form-control-static">在微信公众号请求用户网页授权之前，开发者需要先到公众平台网站的【开发者中心】<b>网页服务</b>中配置授权回调域名。<a href="http://www.bj165.com/manual/dev:v0.6:qa:mobile_redirect_url_error" target="_black"></a></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">接口地址</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" class="form-control" value="http://www.zyjfire.com/wx.php?id=<?= $account['id']?>" readonly="readonly" autocomplete="off"/>
                                <div class="help-block">设置“公众平台接口”配置信息中的接口地址</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" style="color:red">Token</label>
                            <div class="col-sm-9 col-xs-12">
                                <div class="input-group">
                                    <input type="text"  class="form-control tokens" value="kPgDeWweQ4D2I2eZ42Pnd5d51QSQ7X2U" readonly="readonly" />
                                    <span class="input-group-addon news_token" style="cursor:pointer" >生成新的</span>
                                </div>
                                <div class="help-block">与公众平台接入设置值一致，必须为英文或者数字，长度为3到32个字符. 请妥善保管, Token 泄露将可能被窃取或篡改平台的操作数据.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" style="color:red">EncodingAESKey</label>
                            <div class="col-sm-9 col-xs-12">
                                <div class="input-group">
                                    <input type="text"  class="form-control keys" value="dNDdVSsb3DN3lGVVbD5KdSV553Rz5oW5dkNd3BBokKx" readonly/>
                                    <span class="input-group-addon news_key" style="cursor:pointer" >生成新的</span>
                                </div>
                                <div class="help-block">与公众平台接入设置值一致，必须为英文或者数字，长度为43个字符. 请妥善保管, EncodingAESKey 泄露将可能被窃取或篡改平台的操作数据.</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">二维码</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="file" name="qcode" value="">
                            <span class="help-block">只支持JPG图片</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">头像</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="file" name="head_url" value="">
                            <span class="help-block">只支持JPG图片</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                            <input  type="submit" value="提交" class="btn btn-primary span2" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="center-block footer" role="footer">
        <div class="text-center">
        </div>
        <div class="text-center">
            商城系统			</div>
    </div>
</div>
<script language="javascript">
$(function(){
    $('.news_token').click(function(){
        var token = randomString(35);
        $('.tokens').val(token);
    });
    $('.news_key').click(function(){
        var token = randomString(45);
        $('.keys').val(token);
    });
});
function randomString(len) {
    len = len || 32;
    var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';    /****默认去掉了容易混淆的字符oOLl,9gq,Vv,Uu,I1****/
    var maxPos = $chars.length;
    var pwd = '';
    for (i = 0; i < len; i++) {
        pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
    }
    return pwd;
}
</script>

</body></html>
