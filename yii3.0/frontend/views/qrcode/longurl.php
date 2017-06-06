<?php
include_once('./pub/top.php');
include_once('./pub/config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="?r=qrcode/longurl">长链接转二维码</a></li>
    </ul>
    <div class="alert alert-danger">
        注意：使用长连接转短连接功能,您的公众号应该是"服务号"。如果您的公众号是普通订阅号,不能使用该功能
    </div>
    <div class="clearfix">
        <form class="form form-horizontal" action="http://wcmall.bj165.com/web/index.php?c=platform&amp;a=url2qr&amp;" method="post">
            <input type="hidden" name="id" value="">
            <div class="panel panel-default">
                <div class="panel-heading">
                    长链接转二维码
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">请输入长链接:</label>
                        <div class="col-sm-9 col-xs-12">
                            <div class="input-group">
                                <input type="text" name="longurl" class="form-control" id="longurl" value="" placeholder="请输入长链接" autocomplete="off">
                                <div class="input-group-btn">
                                    <span class="btn btn-primary" id="longurl_but" ><i class="fa fa-external-link"></i> 选择系统链接</span>
                                </div>

                            </div>
                            <div class="help-block">请输入您要转换的长链接，支持http://、https://、weixin://wxpay 格式的url</div>
                        </div>
                        <div id='urllist' style="text-align: center;height:100px;width:50%"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                        <div class="col-sm-9 col-xs-12">
                            <div class="input-group">
                                <span id="change" class="btn btn-primary">立即转换</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">生成的短连接 </label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="shorturl" id="shorturl" value="" class="form-control" readonly="">
                        </div>
                    </div>
                    <div class="form-group hide">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">二维码地址 </label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="qr" value="" class="form-control" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">生成的二维码</label>
                        <div class="col-sm-9 col-xs-12">
                            <img src="./长链接转二维码_files/index.php" id="qrsrc" style="border:2px solid #CCC;padding:0px;border-radius:4px;width:150px;height:150px">
                            <div class="help-block">默认显示本站的二维码</div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function(){
        $('#change').click(function()
        {
            var longurl = $('#longurl').val();
            if( longurl == ''){
                alert('请输入长链接地址！');
                return;
            }
            var reg=/^((https|http|weixin)?:\/\/)+[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/;
            if(!reg.test(longurl)){
                alert('请确认您的URL长链接地址，你的长链接地址不正确！');
                return;
            }
            $.ajax({
                'type' : 'GET',
                'url' : '?r=qrcode/long2short',
                'data' : {longurl:longurl},
                success : function(data){
                    var data1 = $.parseJSON(data);
                    if( data1['errcode'] != 1){
                        alert(data1['errmsg']);
                        return;
                    }
                    if( data1['errcode'] == 1 ){
                        $('#qrsrc').attr('src',data1.qrcode);
                        $('#shorturl').attr('value',data1['short_url']);
                    }
                },
                error : function(data){
                    alert('发生了未知错误，请检查！');
                }
            })
        })
    })
    $('#longurl_but').click(function(){
        $.ajax({
            'type' : 'GET',
            'url' : '?r=qrcode/findurls',
            success : function(data){
                var data = $.parseJSON(data);
                str = '<select id="ulist"><option value="">请选择本站URL</option>';
                $.each( data , function(i,v){
                    str += '<option value="http://127.0.0.1/yii2/frontend/web/index.php?r='+v.action+'">'+v.action+'</option>';
                })
                str += '</select>';
                $('#urllist').html(str);
            },
            error : function(data){
                alert(data)
            }
        })
    })
    $(document).delegate('#ulist','change',function (){
        var url = $(this).val();
        $('#longurl').attr('value',url);
        $('#urllist').html('');
    });

</script>