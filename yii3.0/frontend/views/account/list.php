
<html lang="zh-cn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>公众号列表 - 公众号 - 商城系统V1.7</title>
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
            'siteurl': 'http://wcmall.bj165.com/web/index.php?c=account&a=display&',
            'attachurl': 'http://wcmall.bj165.com/attachment/',
            'attachurl_local': 'http://wcmall.bj165.com/attachment/',
            'cookie' : {'pre': '8cee_'}
        };
    </script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery" src="ass/jquery-1.11.1.min(1).js"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="bootstrap" src="ass/bootstrap.min.js"></script></head>
<body >
<div class="gw-container" style="background-image:url(./public/css/images/gw-bg.jpg);min-height: 709px;">
    <div class="navbar navbar-static-top" role="navigation" style="padding-top:20px;">
        <div class="container-fluid">
            <ul class="nav navbar-nav pull-right" style="padding-top:10px;">
                <a href="index.php?r=account/list" class="tile img-rounded active">
                    <i class="fa fa-comments"></i>
                    <span>公众号管理</span>
                </a>
                <a href="index.php?r=user/news" class="tile img-rounded">
                    <i class="fa fa-sitemap"></i>
                    <span>系统</span>
                </a>
                <a href="index.php?r=login/login" class="tile img-rounded">
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
            </script>	<style>
                .alert{color:#666;padding:10px}
                .text-strong{font-size:14px;font-weight:bold;}
                .popover{max-width: 450px}
                .popover-content{padding-top: 0;line-height: 30px}
                .popover-content h5{padding-bottom: 5px}
            </style>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#">系统</a></li>
                <li class="active">公众号列表</li>
            </ol>
            <div class="clearfix" style="margin-bottom:5em;">
                <div class="alert alert-warning">
                    温馨提示：
                    <i class="fa fa-info-circle"></i>
                    Hi，<span class="text-strong">
                        <?php $session = \Yii::$app->session;
                        $res = $session->get('user');
                        echo $res['username'];
                        ?></span>，您所在的会员组 <span class="text-strong"><?php echo $group_name;?></span>，
                    账号有效期限：<span class="text-strong">
                        <?php
                        $session = \Yii::$app->session;
                        $res = $session->get('user');
                       if($res['username']=='admin'){?>
                           无限制
                       <?} else {?>
                           2017-05-11 ~ 2018-03-12
                      <?php }?>
                    </span>，
                    可添加 <span class="text-strong"><?php
                        $session = \Yii::$app->session;
                        $res = $session->get('user');
                        if($res['username']=='admin'){?>
                            无限制</span>公众号
                        <?} else{?>
                            <?php echo $big;?>个公众号 已添加<span class="text-strong"> <?php echo $now;?></span>个，还可添加 <span class="text-strong"><?php echo $big-$now;?></span>个公众号。
                      <?php  }?>
                </div>
                <form action="index.php?r=account/list" method="post" role="form" >
                    <input type="hidden" name="c" value="account">
                    <input type="hidden" name="a" value="display">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="请输入微信公众号名称" name="name" id="s_keyword" value="">
                            <input type="text" class="form-control hide" placeholder="请输入微信公众号ID" name="id" id="s_uniacid" value="">
                            <div class="input-group-btn">
                                <input type="hidden" name="_csrf" id="_csrf" value='<?php echo Yii::$app->request->csrfToken ?>'>
                                <i class="fa fa-search"><input type="submit" class="btn btn-default" value="搜索"></i>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="javascript:;" onclick="$(&#39;#s_uniacid&#39;).addClass(&#39;hide&#39;).val(&#39;&#39;);$(&#39;#s_keyword&#39;).removeClass(&#39;hide&#39;);">根据公众号名称搜索</a></li>
                                    <li><a href="javascript:;" onclick="$(&#39;#s_uniacid&#39;).removeClass(&#39;hide&#39;);$(&#39;#s_keyword&#39;).addClass(&#39;hide&#39;).val(&#39;&#39;);">根据公众号ID搜索</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="input-group">
                    <a class="btn btn-primary" href="index.php?r=account/add"><i class="fa fa-plus"></i> 添加公众号</a>
                </div>
                <ul class="list-unstyled account">
                    <?php foreach ($data as $key => $value )
                        {
                           ?>
                            <li>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row clearfix">
                                        <div class="col-xs-6">
								<span style="cursor:pointer; color:#999;" class="setmeal-hover" data-uid="8" data-uniacid="asdfsdf" data-groupid="2">
									套餐 : <?php echo $group_name;?>								</span>
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <a href="index.php?r=account/conf&id=<?php echo $value['id']?>" target="_blank" class="manage"><i class="fa fa-cog"></i>管理公众号</a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="panel-body list-group">
                                    <li class="row list-group-item" style="line-height:60px;">
                                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-1">
                                            <?php if(empty($value['head_url'])){?>
                                                <img src="ass/gw-wx.gif" class="" width="50" height="50" onerror="this.src=a/gw-wx.gif&#39;">
                                            <?php } else {?>
                                                <img src="<?php echo $value['head_url']?>" class="" width="50" height="50">
                                            <?php }?>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5 item" style="font-size:16px;">
                                            <?php if(isset($value['name'])){?>
                                                <?php echo $value['name'];?>
                                          <?php  } else {?>
                                                555
                                            <?php }?>												</div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 item text-right">
								<span style="width:80px; text-align:center; display:inline-block;">
                                    <i class="fa fa-2x fa-times-circle text-warning" style="position:absolute; top:15px;" data-toggle="tooltip" data-placement="top" title="公众号接入状态显示“未接入”解决方案：进入微信公众平台，依次选择: 开发者中心 -&gt; 修改配置，然后将对应公众号在
								平台的url和token复制到微信公众平台对应的选项，公众平台会自动进行检测"></i></span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="list-group-bottom">
                                    <div class="col-xs-6 list-group-bottom-left">
                                        <span>服务有效期 : 2017-05-11 ~ 2018-03-12</span>
                                    </div>
                                    <div class="col-xs-6 text-right list-group-bottom-right">
                                        <a href="index.php?r=account/node"><i class="fa fa-user"></i>操作员管理</a>
                                        <?php if(isset($value['id'])){?>
                                            <a href="index.php?r=account/update&account_id=<?php echo $value['id']?>"><i class="fa fa-edit"></i>编辑</a>
                                            <a href="index.php?r=account/delete&account_id=<?php echo $value['id']?>" onclick="return confirm(&#39;删除主公众号其所属的子公众号及其它数据会全部删除，确认吗？&#39;);return false;"><i class="fa fa-times"></i>删除</a>
                                        <?php  } else {?>
                                            <a href="index.php?r=account/update"><i class="fa fa-edit"></i>编辑</a>
                                            <a href="index.php?r=account/list" onclick="return confirm(&#39;删除主公众号其所属的子公众号及其它数据会全部删除，确认吗？&#39;);return false;"><i class="fa fa-times"></i>删除</a>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </li>
                  <?php }?>
                </ul>
            </div>
            <script type="text/javascript">
                require(['bootstrap'],function($){
                    $('[data-toggle="tooltip"]').hover(function(){
                        $(this).tooltip('show');
                    },function(){
                        $(this).tooltip('hide');
                    });
                    $('.setmeal-hover').hover(function(){
                        var uid = $(this).data('uid');
                        var groupid = $(this).data('groupid');
                        var title = $(this).data('uniacid');
                        var obj = $(this);
                        if(groupid == -1) {
                            obj.popover({
                                'html':true,
                                'placement':'right',
                                'trigger':'manual',
                                //'title':title,
                                'content':'<h5>可用的服务套餐</h5><div style="margin-top: -15px"><span class="label label-success">所有服务</span></div>'
                            });
                            obj.popover('show');
                        }else {
                            $.post("./index.php?r=account/list&", {uid:uid, groupid:groupid}, function(data){
                                var data = $.parseJSON(data);
                                var content = '';
                                if(data.message.message.groupname.length > 0) {
                                    content += '<h5>可用的服务套餐</h5>';
                                    content += '<div style="margin-top: -15px">';
                                    $.each(data.message.message.groupname, function (i,val) {
                                        content += '<span class="label label-success">'+val.name+'</span> ';
                                    });
                                    content += '</div>';
                                }
                                if(data.message.message.modules && data.message.message.modules.length > 0) {
                                    content += '<h5>附加的模块权限</h5>';
                                    content += '<div style="margin-top: -15px">';
                                    $.each(data.message.message.modules, function (i,val) {
                                        content += '<span class="label label-success">'+val.title+'</span> ';
                                    });
                                    content += '</div>';
                                }
                                if(data.message.message.templates && data.message.message.templates.length > 0) {
                                    content += '<h5>附加的模板权限</h5>';
                                    content += '<div style="margin-top: -15px">';
                                    $.each(data.message.message.templates, function (i,val) {
                                        content += '<span class="label label-success">'+val.title+'</span> ';
                                    });
                                    content += '</div>';
                                }
                                obj.popover({
                                    'html':true,
                                    'placement':'right',
                                    'trigger':'manual',
                                    //'title':title,
                                    'content':content
                                });
                                obj.popover('show');
                            });
                        }
                    }, function(){
                        $(this).popover('hide');
                    });
                });
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
    <script>
        var h = document.documentElement.clientHeight;
        $(".gw-container").css('min-height',h);
    </script>
</div>


</body></html>
