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
    <div class="clearfix">
        <form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-heading">文章管理</div>
                <div class="panel-body">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">排序</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" placeholder="" name="displayorder" value="">
                            <span class="help-block">文章的显示顺序，越大则越靠前</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">标题</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" placeholder="" name="title" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">文章触发关键字</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" placeholder="" name="keyword" value="">
                            <div class="help-block">添加关键字以后,系统将生成一条图文规则,用户可以通过输入关键字来阅读文章。多个关键字请用英文“,”隔开</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">自定义属性</label>
                        <div class="col-sm-8 col-xs-12">
                            <label class="checkbox-inline"><input type="checkbox" name="option[hot]" value="1" > 头条[h]</label>
                            <label class="checkbox-inline"><input type="checkbox" name="option[commend]" value="1" > 推荐[c]</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">文章来源</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" placeholder="" name="source" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">文章作者</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" id="writer" name="author" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">缩略图</label>
                        <div class="col-sm-8 col-xs-12">

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
                                <img src="./resource/images/nopic.jpg" onerror="this.src='./resource/images/nopic.jpg'; this.title='图片未找到.'" class="img-responsive img-thumbnail"  width="150" />
                                <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
                            </div>					</div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                        <div class="col-sm-9 col-xs-12">
                            <label>
                                封面（大图片建议尺寸：360像素 * 200像素）
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                        <div class="col-sm-9 col-xs-12">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="incontent" value="1"  /> 封面图片显示在正文中
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">文章类别</label>
                        <div class="col-sm-8 col-xs-12">

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
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">选择内容模板</label>
                        <div class="col-sm-8 col-xs-12">
                            <select name="template" class="form-control">
                                <option value="">使用默认设置</option>
                                <option value="default">微站默认模板</option>
                                <option value="style_car">微站微汽车</option>
                                <option value="style99">微擎微站模板99</option>
                                <option value="style98">微擎微站模板98</option>
                                <option value="style96">微擎微站模板96</option>
                                <option value="style95">微擎微站模板95</option>
                                <option value="style94">微擎微站模板94</option>
                                <option value="style93">微擎微站模板93</option>
                                <option value="style92">微擎微站模板92</option>
                                <option value="style91">微擎模板91</option>
                                <option value="style90">微擎模板90</option>
                                <option value="style9">微擎style9</option>
                                <option value="style89">微擎模板89</option>
                                <option value="style88">微擎模板88</option>
                                <option value="style87">微擎模板87</option>
                                <option value="style86">微擎模板86</option>
                                <option value="style85">微擎模板85</option>
                                <option value="style84">微擎模板84</option>
                                <option value="style83">微擎模板83</option>
                                <option value="style82">微擎模板82</option>
                                <option value="style81">微擎模板81</option>
                                <option value="style80">微擎模板80</option>
                                <option value="style8">微擎style8</option>
                                <option value="style79">微擎模板79</option>
                                <option value="style78">微擎模板78</option>
                                <option value="style77">微擎模板77</option>
                                <option value="style76">微擎模板76</option>
                                <option value="style75">微擎模板75</option>
                                <option value="style74">微擎模板74</option>
                                <option value="style73">微擎模板73</option>
                                <option value="style72">微擎模板72</option>
                                <option value="style71">微擎模71</option>
                                <option value="style70">微擎模板70</option>
                                <option value="style7">微擎style7</option>
                                <option value="style69">微擎模板69</option>
                                <option value="style68">微擎模板68</option>
                                <option value="style67">微擎模板67</option>
                                <option value="style66">微擎模板66</option>
                                <option value="style65">微擎模板65</option>
                                <option value="style64">微擎模板64</option>
                                <option value="style63">微擎模板63</option>
                                <option value="style62">微擎模板62</option>
                                <option value="style61">微擎模板61</option>
                                <option value="style60">微擎模板60</option>
                                <option value="style6">微擎style6</option>
                                <option value="style59">微擎模板59</option>
                                <option value="style58">微擎模板58</option>
                                <option value="style57">微擎style57</option>
                                <option value="style56">微擎style56</option>
                                <option value="style55">微擎style55</option>
                                <option value="style54">微擎style54</option>
                                <option value="style53">微擎style53</option>
                                <option value="style52">微擎style52</option>
                                <option value="style51">微擎style51</option>
                                <option value="style50">微擎style50</option>
                                <option value="style5">微擎style5</option>
                                <option value="style49">微擎style49</option>
                                <option value="style48">微擎style48</option>
                                <option value="style47">微擎style47</option>
                                <option value="style46">微擎style46</option>
                                <option value="style45">微擎style45</option>
                                <option value="style44">微擎style44</option>
                                <option value="style43">微擎style43</option>
                                <option value="style42">微擎style42</option>
                                <option value="style41">微擎style41</option>
                                <option value="style40">微擎style40</option>
                                <option value="style4">微擎style4</option>
                                <option value="style39">微擎style39</option>
                                <option value="style38">微擎style38</option>
                                <option value="style37">微擎style37</option>
                                <option value="style36">微擎style36</option>
                                <option value="style35">微擎style35</option>
                                <option value="style34">微擎style34</option>
                                <option value="style33">微擎style33</option>
                                <option value="style32">微擎style32</option>
                                <option value="style31">微擎style31</option>
                                <option value="style30">微擎style30</option>
                                <option value="style3">微擎style3</option>
                                <option value="style29">微擎style29</option>
                                <option value="style28">微擎style28</option>
                                <option value="style27">微擎style27</option>
                                <option value="style26">微擎style26</option>
                                <option value="style25">微擎style25</option>
                                <option value="style24">微擎style24</option>
                                <option value="style22">微擎style22</option>
                                <option value="style21">微擎style21</option>
                                <option value="style23">微擎style23</option>
                                <option value="style19">微擎style19</option>
                                <option value="style18">微擎style18</option>
                                <option value="style17">微擎style17</option>
                                <option value="style2">微擎style2</option>
                                <option value="style16">微擎style16</option>
                                <option value="style15">微擎style15</option>
                                <option value="style14">微擎style14</option>
                                <option value="style13">微擎style13</option>
                                <option value="style12">微擎style12</option>
                                <option value="style20">微擎style20</option>
                                <option value="style118">微擎微站模板118</option>
                                <option value="style117">微擎微站模板117</option>
                                <option value="style116">微擎微站模板116</option>
                                <option value="style113">微擎微站模板113</option>
                                <option value="style112">微擎微站模板112</option>
                                <option value="style111">微擎微站模板111</option>
                                <option value="style110">微擎微站模板110</option>
                                <option value="style11">微擎style11</option>
                                <option value="style108">微擎微站模板108</option>
                                <option value="style107">微擎微站模板107</option>
                                <option value="style106">微擎微站模板106</option>
                                <option value="style105">微擎微站模板105</option>
                                <option value="style104">微擎微站模板104</option>
                                <option value="style103">微擎微站模板103</option>
                                <option value="style102">微擎微站模板102</option>
                                <option value="style101">微擎微站模板101</option>
                                <option value="style100">微擎微站模板100</option>
                                <option value="style10">微擎style10</option>
                                <option value="style1">微擎style1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">简介</label>
                        <div class="col-sm-8 col-xs-12">
                            <textarea class="form-control" name="description" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"></label>
                        <div class="col-sm-8">
                            <div class="help-block"><label class="checkbox-inline"><input type="checkbox" name="autolitpic" value="1" checked="true">提取内容的第一个图片为缩略图</label></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">内容</label>
                        <div class="col-sm-8 col-xs-12">
                            <script type="text/javascript" src="./resource/components/ueditor/ueditor.config.js"></script><script type="text/javascript" src="./resource/components/ueditor/ueditor.all.min.js"></script><script type="text/javascript" src="./resource/components/ueditor/lang/zh-cn/zh-cn.js"></script><textarea id="content" name="content" type="text/plain" style="height:200px;"></textarea>
                            <script type="text/javascript">
                                var ueditoroption = {
                                    'autoClearinitialContent' : false,
                                    'toolbars' : [['fullscreen', 'source', 'preview', '|', 'bold', 'italic', 'underline', 'strikethrough', 'forecolor', 'backcolor', '|',
                                        'justifyleft', 'justifycenter', 'justifyright', '|', 'insertorderedlist', 'insertunorderedlist', 'blockquote', 'emotion', 'insertvideo',
                                        'link', 'removeformat', '|', 'rowspacingtop', 'rowspacingbottom', 'lineheight','indent', 'paragraph', 'fontsize', '|',
                                        'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol',
                                        'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', '|', 'anchor', 'map', 'print', 'drafts']],
                                    'elementPathEnabled' : false,
                                    'initialFrameHeight': 200,
                                    'focus' : false,
                                    'maximumWords' : 9999999999999
                                };
                                var opts = {
                                    type :'image',
                                    direct : false,
                                    multi : true,
                                    tabs : {
                                        'upload' : 'active',
                                        'browser' : '',
                                        'crawler' : ''
                                    },
                                    path : '',
                                    dest_dir : '',
                                    global : false,
                                    thumb : false,
                                    width : 0
                                };
                                UE.registerUI('myinsertimage',function(editor,uiName){
                                    editor.registerCommand(uiName, {
                                        execCommand:function(){
                                            require(['fileUploader'], function(uploader){
                                                uploader.show(function(imgs){
                                                    if (imgs.length == 0) {
                                                        return;
                                                    } else if (imgs.length == 1) {
                                                        editor.execCommand('insertimage', {
                                                            'src' : imgs[0]['url'],
                                                            '_src' : imgs[0]['attachment'],
                                                            'width' : '100%',
                                                            'alt' : imgs[0].filename
                                                        });
                                                    } else {
                                                        var imglist = [];
                                                        for (i in imgs) {
                                                            imglist.push({
                                                                'src' : imgs[i]['url'],
                                                                '_src' : imgs[i]['attachment'],
                                                                'width' : '100%',
                                                                'alt' : imgs[i].filename
                                                            });
                                                        }
                                                        editor.execCommand('insertimage', imglist);
                                                    }
                                                }, opts);
                                            });
                                        }
                                    });
                                    var btn = new UE.ui.Button({
                                        name: '插入图片',
                                        title: '插入图片',
                                        cssRules :'background-position: -726px -77px',
                                        onclick:function () {
                                            editor.execCommand(uiName);
                                        }
                                    });
                                    editor.addListener('selectionchange', function () {
                                        var state = editor.queryCommandState(uiName);
                                        if (state == -1) {
                                            btn.setDisabled(true);
                                            btn.setChecked(false);
                                        } else {
                                            btn.setDisabled(false);
                                            btn.setChecked(state);
                                        }
                                    });
                                    return btn;
                                }, 19);

                                $(function(){
                                    var ue = UE.getEditor('content', ueditoroption);
                                    $('#content').data('editor', ue);
                                    $('#content').parents('form').submit(function() {
                                        if (ue.queryCommandState('source')) {
                                            ue.execCommand('source');
                                        }
                                    });
                                });
                            </script>					</div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">直接链接</label>
                        <div class="col-sm-8 col-xs-12">

                            <script type="text/javascript">
                                function showLinkDialog(elm) {
                                    require(["util","jquery"], function(u, $){
                                        var ipt = $(elm).parent().prev();
                                        u.linkBrowser(function(href){
                                            ipt.val(href);
                                        });
                                    });
                                }
                            </script>
                            <div class="input-group">
                                <input type="text" value="" name="linkurl" class="form-control " autocomplete="off">
                                <span class="input-group-btn">
			<button class="btn btn-default " type="button" onclick="showLinkDialog(this);">选择链接</button>
		</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">阅读次数</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" name="click" value="" class="form-control"/>
                            <div class="help-block">默认为0。您可以设置一个初始值,阅读次数会在该初始值上增加。</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">积分设置</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">是否赠送积分</label>
                        <div class="col-sm-8 col-xs-12">
                            <label class="radio-inline"><input type="radio" name="credit[status]" value="1"  id="credit1"> 赠送</label>
                            <label class="radio-inline"><input type="radio" name="credit[status]" value="0"  checked id="credit0"> 不赠送</label>
                            <span class="help-block">设置赠送积分后,粉丝在分享时赠送积分.粉丝的好友在点击阅读时,也会赠送积分</span>
                        </div>
                    </div>
                    <div id="credit-status1" style="display:none">
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">赠送积分上限</label>
                            <div class="col-sm-8 col-xs-12">
                                <input type="text" class="form-control" name="credit[limit]" value="">
                                <span class="help-block">设置赠送积分的上限,到达上限后将不再赠送积分</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">转发赠送积分</label>
                            <div class="col-sm-8 col-xs-12">
                                <input type="text" class="form-control"  name="credit[share]" value="">
                                <span class="help-block">设置转发时赠送积分</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">阅读赠送积分</label>
                            <div class="col-sm-8 col-xs-12">
                                <input type="text" class="form-control" name="credit[click]" value="">
                                <span class="help-block">设置阅读时赠送给分享人的积分</span>
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
        var category = [];
        $('#credit1').click(function(){
            $('#credit-status1').show();
        });
        $('#credit0').click(function(){
            $('#credit-status1').hide();
        });
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

