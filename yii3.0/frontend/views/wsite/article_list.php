<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/wx_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li ><a href="./index.php?r=wsite/article_add">添加文章</a></li>
        <li class="active"><a href="./index.php?r=wsite/article_list">文章列表</a></li>
    </ul>
    <style>
        .table td span{display:inline-block;margin-top:4px;}
        .table td input{margin-bottom:0;}
    </style>
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="a" value="article" />
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="do" value="display" />
                
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 control-label">关键字</label>
                    <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
                        <input class="form-control" name="keyword" id="" type="text" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 control-label">文章分类</label>
                    <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
                        
                        <script type="text/javascript">
                            window._category = [];
                        </script>
                        <script type="text/javascript">
                            function renderCategory(obj, name){
                                var index = obj.options[obj.selectedIndex].value;
                                require(['jquery', 'util'], function($, u){
                                    $selectChild = $('#'+name+'_child');
                                    var html = '<option value="0">请选择二级分类</option>';
                                    if (!window['_'+name] || !window['_'+name][index]) {
                                        $selectChild.html(html);
                                        return false;
                                    }
                                    for(var i=0; i< window['_'+name][index].length; i++){
                                        html += '<option value="'+window['_'+name][index][i]['id']+'">'+window['_'+name][index][i]['name']+'</option>';
                                    }
                                    $selectChild.html(html);
                                });
                            }
                        </script>
                        <div class="row row-fix tpl-category-container">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <select class="form-control tpl-category-parent" id="category_parent" name="category[parentid]" onchange="renderCategory(this,'category')">
                                    <option value="0">请选择一级分类</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <select class="form-control tpl-category-child" id="category_child" name="category[childid]">
                                    <option value="0">请选择二级分类</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="pull-right col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="table-responsive panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th style="width:50px">排序</th>
                    <th>标题</th>
                    <th style="width:180px;">属性</th>
                    <th style="width:200px; text-align:right;">操作</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        var category = [];
    </script>
</div>
</div>
</div>
<script>
    function subscribe(){
        $.post("./index.php?c=utility&a=subscribe&", function(){
            setTimeout(subscribe, 5000);
        });
    }
    function sync() {
        $.post("./index.php?c=utility&a=sync&", function(){
            setTimeout(sync, 60000);
        });
    }
    $(function(){
        subscribe();
        sync();
    });
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
<script type="text/javascript">
    require(['bootstrap']);
    $('.js-clip').each(function(){
        util.clip(this, $(this).attr('data-url'));
    });
</script>
</div>

