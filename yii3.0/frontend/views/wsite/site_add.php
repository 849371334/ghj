    <?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/wx_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li><a href="./index.php?r=wsite/site_list">站点列表</a></li>
        <li class="active"><a href="./index.php?r=wsite/site_add">站点添加</a></li>	</ul>
    <style>
        .template .item{position:relative;display:block;float:left;border:1px #ddd solid;border-radius:5px;background-color:#fff;padding:5px;width:190px;margin:0 20px 20px 0; overflow:hidden;}
        .template .title{margin:5px auto;line-height:2em;}
        .template .title a{text-decoration:none;}
        .template .item img{width:178px;height:270px; cursor:pointer;}
        .template .active.item-style img, .template .item-style:hover img{width:178px;height:270px;border:3px #009cd6 solid;padding:1px; }
        .template .title .fa{display:none}
        .template .active .fa.fa-check{display:inline-block;position:absolute;bottom:33px;right:6px;color:#FFF;background:#009CD6;padding:5px;font-size:14px;border-radius:0 0 6px 0;}
        .template .fa.fa-times{cursor:pointer;display:inline-block;position:absolute;top:10px;right:6px;color:#D9534F;background:#ffffff;padding:5px;font-size:14px;text-decoration:none;}
        .template .fa.fa-times:hover{color:red;}
        .template .item-bg{width:100%; height:342px; background:#000; position:absolute; z-index:1; opacity:0.5; margin:-5px 0 0 -5px;}
        .template .item-build-div1{position:absolute; z-index:2; margin:-5px 10px 0 5px; width:168px;}
        .template .item-build-div2{text-align:center; line-height:30px; padding-top:150px;}
        /*@media screen and (min-width:992px){#ListStyle{width:890px; margin:100px auto;}}*/
    </style>
    <form class="form-horizontal form" action="inde" method="post">
        <div class="clearfix">
            <div class="panel panel-default">
                <div class="panel-heading">
                    站点信息
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">微站名称</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="title" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否启用</label>
                        <div class="col-sm-9 col-xs-12">
                            <label class="radio-inline"><input type="radio" name="status" value="1" checked>是</label>
                            <label class="radio-inline"><input type="radio" name="status" value="0" >否</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">选择微站风格</label>
                        <div class="col-sm-8 col-xs-12">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ListStyle">选择风格</button>
                            <input type="hidden" name="styleid" id="styleid" value="" />
                        </div>
                    </div>
                    <div class="form-group" id="preview-style" style="display:none;">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">当前微站风格</label>
                        <div class="col-sm-8 col-xs-12">
                            <div class="template">
                                <div class="item item-style">
                                    <div class="title">
                                        <div style="overflow:hidden; height:28px;" id="current-title"></div>
                                        <a href="javascript:;">
                                            <img src="http://wcmall.bj165.com/app/themes//preview.jpg" id="current-preview" class="img-rounded">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 风格列表 -->
                    <div class="modal fade bs-example-modal-lg" id="ListStyle" aria-hidden="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">微站模板风格列表</h4>
                                </div>
                                <div class="modal-body template clearfix">
                                    <div class="item item-style ">
                                        <div class="title">
                                            <div class="title-38" style="overflow:hidden; height:28px;">微站默认模板_KAtb</div>
                                            <a href="javascript:;" class="change-style" data-styleid="38">
                                                <img src="http://wcmall.bj165.com/app/themes/default/preview.jpg" class="img-rounded preview-38">
                                            </a>
                                            <span class="fa fa-check"></span>
                                        </div>
                                        <div class="btn-group  btn-group-justified">
                                            <a href="javascript:;" class="btn btn-default btn-xs change-style" data-styleid="38">选择风格</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">触发关键字</label>
<!--                        <div class="col-sm-9 col-xs-12">-->
<!--                            <input type="text" name="keyword" class="form-control" value="" />-->
<!--                            <div class="help-block">用户触发关键字，系统回复此页面的图文链接</div>-->
<!--                        </div>-->
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">封面</label>
                        <div class="col-sm-9 col-xs-12">

                            <script type="text/javascript">
                                function showImageDialog(elm, opts, options) {
                                    require(["util"], function(util){
                                        var btn = $(elm);
                                        var ipt = btn.parent().prev();
                                        var val = ipt.val();
                                        var img = ipt.parent().next().children();
                                        options = {'global':false,'class_extra':'','direct':true,'multiple':false};
                                        util.image(val, function(url){
                                            if(url.url){
                                                if(img.length > 0){
                                                    img.get(0).src = url.url;
                                                }
                                                ipt.val(url.attachment);
                                                ipt.attr("filename",url.filename);
                                                ipt.attr("url",url.url);
                                            }
                                            if(url.media_id){
                                                if(img.length > 0){
                                                    img.get(0).src = "";
                                                }
                                                ipt.val(url.media_id);
                                            }
                                        }, null, options);
                                    });
                                }
                                function deleteImage(elm){
                                    require(["jquery"], function($){
                                        $(elm).prev().attr("src", "./resource/images/nopic.jpg");
                                        $(elm).parent().prev().find("input").val("");
                                    });
                                }
                            </script>
                            <div class="input-group ">
                                <input type="text" name="thumb" value="" class="form-control" autocomplete="off">
                                <span class="input-group-btn">
				<button class="btn btn-default" type="button" onclick="showImageDialog(this);">选择图片</button>
			</span>
                            </div>
                            <div class="input-group " style="margin-top:.5em;">
<!--                                <img src="./resource/images/nopic.jpg" onerror="this.src='./resource/images/nopic.jpg'; this.title='图片未找到.'" class="img-responsive img-thumbnail"  width="150" />-->
                                <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
                            </div>						<div class="help-block">用于用户触发关键字后，系统回复时的封面图片</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">页面描述</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="description" class="form-control" value="" />
                            <div class="help-block">用户通过微信分享给朋友时,会自动显示页面描述</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">绑定域名</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="bindhost" class="form-control" value="" />
                            <span class="help-block">绑定时请先将域名解析指向到本服务器，请只填写host部分，例如：www.baidu.com</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">底部自定义</label>
                        <div class="col-sm-9 col-xs-12">
                            <textarea style="height:150px;" class="form-control" cols="70" name="footer" autocomplete="off"></textarea>
                            <span class="help-block">自定义底部信息，支持HTML</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1" />
                    <input type="hidden" name="token" value="196752ed" />
                </div>
            </div>
        </div>
    </form>

</div>
