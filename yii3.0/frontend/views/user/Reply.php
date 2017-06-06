<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/sys_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <div class="clearfix">
        <div class="panel panel-info">
            <div class="panel-heading">筛选</div>
            <div class="panel-body">
                <form action="" method="get" class="form-horizontal" role="form">
                    <input type="hidden" name="c" value="platform">
                    <input type="hidden" name="a" value="reply">
                    <input type="hidden" name="m" value="basic">
                    <input type="hidden" name="status" value="-1">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
                        <div class="col-sm-8 col-lg-9 col-xs-12">
                            <div class="btn-group">
                                <a href="">所有</a>
                                <a href="">启用</a>
                                <a href="" class="btn btn-default">禁用</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
                        <div class="col-sm-8 col-xs-12">
                            <input class="form-control" name="keyword" id="" type="text" value="">
                        </div>
                        <div class="col-xs-12 col-sm-2 col-lg-1 text-right">
                            <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>


