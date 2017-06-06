<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>公众号列表 - 公众号 - 商城系统V1.7</title>
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
            'siteurl': 'http://wcmall.bj165.com/web/index.php?c=account&a=display&',
            'attachurl': 'http://wcmall.bj165.com/attachment/',
            'attachurl_local': 'http://wcmall.bj165.com/attachment/',
            'cookie' : {'pre': '8cee_'}
        };
    </script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery" src="ass/jquery-1.11.1.min(1).js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="bootstrap" src="ass/bootstrap.min.js"></script>
</head>
<body >
<div class="gw-container" style="background-image:url(./public/css/images/gw-bg.jpg)">
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
                <li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
                <li><a href="./index.php?c=system&a=welcome&">系统</a></li>
                <li><a href="index.php?r=account/list">公众号列表</a></li>
                <li class="active">账号操作员列表</li>
            </ol>
            <ul class="nav nav-tabs">
                <li class="active"><a href="">账号操作员列表</a></li>
            </ul>
            <div class="clearfix">
                <h5 class="page-header">设置可操作用户</h5>
                <div class="alert alert-info">
                    <i class="fa fa-exclamation-circle"></i> 操作员不允许删除公众号和编辑公众号资料，管理员无此限制
                </div>
                <div class="panel panel-default">
                    <div class="panel-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width:50px;">选择</th>
                                <th style="width:80px;">用户ID</th>
                                <th style="width:150px;">用户名</th>
                                <th style="width:200px;">角色</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr >
                                <td class="row-first"></td>
                                <td><?php echo $data['id'];?></td>
                                <td><?php echo $data['username'];?></td>
                                <td>
                                    <span class="label label-warning"><?php echo $group['group_name'];?></span>
                                </td>
                                <td>
                                    <?php if ($group['id'] ==12) {
                                       echo "$group[group_name]拥有公众号的所有权限，并且公众号的权限（模块、模板）根据$group[group_name]来获取";
                                   } elseif ($group['id'] ==11){
                                        echo "$group[group_name]拥有公众号的部分权限，并且公众号的权限（模块、模板）根据$group[group_name]来获取";
                                  } else {
                                        echo "$group[group_name]拥有公众号的回复权限，并且公众号的权限（模块、模板）根据$group[group_name]来获取";
                                    }?>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">
                                    <input type="hidden" name="_csrf" id="csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                                    <a class="btn btn-default" href="javascript:void " id="add-user">添加账号操作员</a>
                                    <input id="btn-revo" class="btn btn-default" type="button" value="删除选定操作">
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 添加用户模态框 -->
            <div class="modal fade" id="user-modal"  tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <form action="./index.php?c=account&a=permission&do=user&" method="post" class="form-horizontal" role="form" id="form1">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" id="myModalLabel">添加账号操作员</h3>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">用户名</label>
                                    <div class="col-sm-10 col-lg-9 col-xs-12">
                                        <input id="" name="username" type="text" class="form-control" value="" />
                                        <span class="help-block">请输入完整的用户名。你需要让新管理员先去注册一个”新账号“，再把他添加进来。</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <input type="submit" class="btn btn-primary" name="submit" value="确认" />
                                <input type="hidden" name="token" value="196752ed" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <script type="text/javascript">
                var seletedUserIds = ["8"];
                $(function(){
                        $('#add-user').click(function(){
                            $('#user-modal').modal('show');
                            $('#form1').submit(function(){
                                var username = $.trim($('#form1 :text[name="username"]').val());
                                var _csrf = $.trim($('#csrf').val());
                                if(!username) {
                                    util.message('没有输入用户名.', '', 'error');
                                    return false;
                                }
                                $.post("index.php?r=account/quan", {'username':username,'_csrf':_csrf}, function(data){
                                    if(data != 'success') {
                                        util.message(data, '', 'error');
                                    } else {
                                        util.message('添加账号操作员成功', "./index.php?r=account/node", 'success');}
                                });
                                return false;
                            });
                        });
                    });
            </script>
        </div>
    </div>

    <div class="center-block footer" role="footer">
        <div class="text-center">
        </div>
        <div class="text-center">
            商城系统
        </div>
    </div>
</div>
</body>
</html>
