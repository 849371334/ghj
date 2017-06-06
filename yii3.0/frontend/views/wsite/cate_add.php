<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/wx_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li class="active"><a href="./index.php?r=wsite/cate_list">分类列表</a></li>
        <li ><a href="./index.php?r=wsite/cate_add">分类添加</a></li>
    </ul>

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
    </style>

    <div class="main">
        <form action="index.php?r=wsite/cate_add" method="post" class="form-horizontal form" id="form1">
            <input type="hidden" name="parentid" value="" />
            <div class="panel panel-default">
                <div class="panel-heading">分类详细设置</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">排序</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" name="displayorder" class="form-control" value="0" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">分类名称</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" name="cname" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">分类描述</label>
                        <div class="col-sm-8 col-xs-12">
                            <textarea name="description" class="form-control" cols="70"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">是否添加微站首页导航</label>
                        <div class="col-sm-8 col-xs-12">
                            <label for="isnav_1" class="radio-inline"><input type="radio" name="isnav" id="isnav_1" value="1" autocomplete="off" /> 是</label>
                            <label for="isnav_2" class="radio-inline"><input type="radio" name="isnav" id="isnav_2" value="0" autocomplete="off"  checked/> 否</label>
                            <div class="help-block">开启此选项后,系统在微站首页导航自动生成以分类名称为导航名称的记录.关闭此选项后,系统将删除对应的导航记录</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">是否作为首页使用</label>
                        <div class="col-sm-8 col-xs-12">
                            <label for="radio_1" class="radio-inline"><input type="radio" name="ishomepage" id="radio_1" value="1" autocomplete="off" /> 是</label>
                            <label for="radio_2" class="radio-inline"><input type="radio" name="ishomepage" id="radio_2" value="0" autocomplete="off"  checked/> 否</label>
                            <div class="help-block">注意：该选项仅对父级分类有效。开启此选项后，分类模板将直接引用首页模板（home.html[注:该文件在home文件夹下面]]），分类的二级分类将作为导航显示</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">当前分类风格</label>
                        <div class="col-sm-8 col-xs-12">
                            <div class="template">
                                <div class="item item-style">
                                    <div class="title">
                                        <div style="overflow:hidden; height:28px;" id="current-title"></div>
                                        <a href="javascript:;">
                                            <img src="http://wcmall.bj165.com/app/themes/default/preview.jpg" id="current-preview" class="img-rounded">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">选择分类风格</label>
                        <div class="col-sm-8 col-xs-12">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ListStyle">选择风格</button>
                            <input type="hidden" name="styleid" id="styleid" value="" />
                            <span class="help-block">
							新建分类风格时，请在您选择的风格对应的模板目录下新建“site”文件夹，默认的列表页面为list.html，默认的内容页面为detail.html。
						</span>
                        </div>
                    </div>

                    <!-- 风格列表 -->
                    <div class="modal fade" id="ListStyle" aria-hidden="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">微站模板风格列表</h4>
                                </div>
                                <div class="modal-body template clearfix">
                                    <div class="item item-style ">
                                        <div class="title">
                                            <div class="title-39" style="overflow:hidden; height:28px;">微擎style1_R0RR (style1)</div>
                                            <a href="javascript:;" class="change-style" data-styleid="39">
                                                <img src="http://wcmall.bj165.com/app/themes/style1/preview.jpg" class="img-rounded preview-39">
                                            </a>
                                            <span class="fa fa-check"></span>
                                        </div>
                                        <div class="btn-group  btn-group-justified">
                                            <a href="javascript:;" class="btn btn-default btn-xs change-style" data-styleid="39">选择风格</a>
                                        </div>
                                    </div>
                                    <div class="item item-style ">
                                        <div class="title">
                                            <div class="title-40" style="overflow:hidden; height:28px;">微站默认模板_gBG (default)</div>
                                            <a href="javascript:;" class="change-style" data-styleid="40">
                                                <img src="http://wcmall.bj165.com/app/themes/default/preview.jpg" class="img-rounded preview-40">
                                            </a>
                                            <span class="fa fa-check"></span>
                                        </div>
                                        <div class="btn-group  btn-group-justified">
                                            <a href="javascript:;" class="btn btn-default btn-xs change-style" data-styleid="40">选择风格</a>
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
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">直接链接</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" placeholder="" name="linkurl" value="">
                            <span class="help-block">链接必须是以http://或是https://开头。没有直接链接，请留空</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default" id="style">
                <div class="panel-heading">导航样式</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">图标类型</label>
                        <div class="col-sm-8 col-xs-12">
                            <label for="icontype1" class="radio-inline"><input type="radio"  checked value="1" name="icontype" id="icontype1" onclick="$('#iconsys').show();$('#iconuser').hide();colorpicker();" autocomplete="off"> 系统内置</label>&nbsp;&nbsp;&nbsp;
                            <label for="icontype2" class="radio-inline"><input type="radio"  value="2" name="icontype" id="icontype2" onclick="$('#iconsys').hide();$('#iconuser').show();" autocomplete="off"> 自定义上传</label>
                        </div>
                    </div>
                    <div class="" id="iconsys" >
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">系统图标</label>
                            <div class="col-sm-8 col-xs-12">
                                <div class="input-group"">

                                <script type="text/javascript">
                                    function showIconDialog(elm) {
                                        require(["util","jquery"], function(u, $){
                                            var btn = $(elm);
                                            var spview = btn.parent().prev();
                                            var ipt = spview.prev();
                                            if(!ipt.val()){
                                                spview.css("display","none");
                                            }
                                            u.iconBrowser(function(ico){
                                                ipt.val(ico);
                                                spview.show();
                                                spview.find("i").attr("class","");
                                                spview.find("i").addClass("fa").addClass(ico);
                                            });
                                        });
                                    }
                                </script>
                                <div class="input-group" style="width: 300px;">
                                    <input type="text" value="fa fa-external-link" name="icon[icon]" class="form-control" autocomplete="off">
                                    <span class="input-group-addon"><i class="fa fa-external-link fa"></i></span>
                                    <span class="input-group-btn">
			<button class="btn btn-default" type="button" onclick="showIconDialog(this);">选择图标</button>
		</span>
                                </div>
                            </div>
                            <span class="help-block">导航的背景图标，系统提供了丰富的图标ICON。</span></div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">图标颜色</label>
                        <div class="col-sm-8 col-xs-12">

                            <script type="text/javascript">
                                require(["jquery", "util"], function($, util){
                                    $(function(){
                                        $(".colorpicker").each(function(){
                                            var elm = this;
                                            util.colorpicker(elm, function(color){
                                                $(elm).parent().prev().prev().val(color.toHexString());
                                                $(elm).parent().prev().css("background-color", color.toHexString());
                                            });
                                        });
                                        $(".colorclean").click(function(){
                                            $(this).parent().prev().prev().val("");
                                            $(this).parent().prev().css("background-color", "#FFF");
                                        });
                                    });
                                });
                            </script>
                            <div class="row row-fix">
                                <div class="col-xs-8 col-sm-8" style="padding-right:0;">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="icon[color]" placeholder="请选择颜色" value="">
                                        <span class="input-group-addon" style="width:35px;border-left:none;background-color:"></span>
                                        <span class="input-group-btn">
						<button class="btn btn-default colorpicker" type="button">选择颜色 <i class="fa fa-caret-down"></i></button>
						<button class="btn btn-default colorclean" type="button"><span><i class="fa fa-remove"></i></span></button>
					</span>
                                    </div>
                                </div>
                            </div>
                            <span class="help-block">图标颜色，上传图标时此设置项无效</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">图标大小</label>
                        <div class="col-sm-8 col-xs-12">
                            <div class="input-group">
                                <input class="form-control" type="text" name="icon[size]" id="icon" value="35">
                                <span class="input-group-addon">PX</span>
                            </div>
                            <span class="help-block">图标的尺寸大小，单位为像素，上传图标时此设置项无效</span>
                        </div>
                    </div>
                </div>
                <div class="" id="iconuser"  style="display:none;">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">上传图标</label>
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
                                <input type="text" name="iconfile" value="" class="form-control" autocomplete="off">
                                <span class="input-group-btn">
				<button class="btn btn-default" type="button" onclick="showImageDialog(this);">选择图片</button>
			</span>
                            </div>
                            <div class="input-group " style="margin-top:.5em;">
                                <img src="./resource/images/nopic.jpg" onerror="this.src='./resource/images/nopic.jpg'; this.title='图片未找到.'" class="img-responsive img-thumbnail"  width="150" />
                                <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
                            </div>							<span class="help-block">自定义上传图标图片，“系统图标”优先于此项</span>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="form-group">
        <div class="col-sm-12">
            <input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
            <input type="hidden" name="token" value="196752ed" />
        </div>
    </div>
    </form>
</div>
<script type="text/javascript">
    <!--
    $("#form1").submit(function(){
        if($("input[name='cname']").val() == '') {
            util.message('请输入分类名称', '', 'error');
            return false;
        }
    });

    $('.change-style').click(function() {
        var styleId = parseInt($(this).data('styleid'));
        var title = $('.title-' + styleId).text();
        var preview = $('.preview-' + styleId).attr('src');
        $('.item-style').removeClass('active');
        $('#styleid').val(styleId);
        $('#current-title').text(title);
        $('#current-preview').attr('src', preview);
        $(this).parent().parent().addClass('active');
        $('#ListStyle').modal('hide');
    });

    //-->
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
