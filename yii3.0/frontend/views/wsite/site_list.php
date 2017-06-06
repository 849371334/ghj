<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/wx_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li><a href="./index.php?r=wsite/site_list">站点列表</a></li>
        <li class="active"><a href="./index.php?r=wsite/site_add">站点添加</a></li>	</ul>
    <div class="clearfix template">
        <div class="panel panel-default">
            <div class="panel-heading">
                可用的微站
            </div>
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <th>微站名称</th>
                        <th style="width:100px;">关键字</th>
                        <th style="width:200px;">风格</th>
                        <th style="width:200px;">模板</th>
                        <th class="manage-menu" style="width:420px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="vertical-align:middle;">aushing<span class="label label-success">默认微站</span></td>
                        <td></td>
                        <td style="vertical-align:middle;">
                            微站默认模板_KAtb						</td>
                        <td>app/themes/default</td>
                        <td class="manage-menu" style="position:relative;">
                            <a href="./index.php?c=site&a=multi&do=post&multiid=29">编辑</a>
                            <a href="./index.php?c=site&a=slide&do=display&multiid=29">幻灯片</a>
                            <a href="./index.php?c=site&a=nav&do=home&multiid=29&f=multi">导航菜单</a>
                            <a href="./index.php?c=site&a=editor&do=quickmenu&multiid=29&type=2">快捷菜单</a>
                            <span><a class="js-clip" href="javascript:;" data-url="http://wcmall.bj165.com/app/index.php?i=24&c=home&t=29">复制链接</a></span>
                            <a href="./index.php?c=site&a=multi&do=copy&multiid=29">复制站点</a>
                            <a href="javascript:;" onclick="preview('38', '29');return false;">预览</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
