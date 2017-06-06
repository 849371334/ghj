1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
47
48
49
50
51
52
53
54
55
56
57
58
59
60
61
62
63
64
65
66
67
68
69
70
71
72
73
74
75
76
77
78
79
80
81
82
83
84
85
86
87
88
89
90
91
92
93
94
95
<?php
include_once('./pub/top.php');
include_once('./pub/config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <ul class="nav nav-tabs">
        <li><a href="?r=customer/customer&tab=1">管理多客服转接</a></li>
        <li><a href="?r=customer/customer&tab=2"><i class="fa fa-plus"></i> 添加多客服转接</a></li>
        <li class="active"><a href="?r=customer/customer&tab=3"> 客服聊天记录</a></li>
    </ul>
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <div class="form-horizontal" role="form" id="form1">
                <input type="hidden" name="page" value="1" id="page">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">粉丝昵称</label>
                    <div class="col-sm-6 col-md-8 col-lg-8">
                        <input type="text" class="form-control" name="nickname" id="nickname" placeholder="请输入粉丝昵称" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">粉丝openid</label>
                    <div class="col-sm-6 col-md-8 col-lg-8">
                        <input type="text" class="form-control" name="openid" id="openid" placeholder="请输入粉丝openid" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">时间</label>
                    <div class="col-sm-6 col-md-8 col-lg-8">
                        <input type="text" name="starttime"  value="<?php echo date('Y-m-d')?>" placeholder="<?php echo date('Y-m-d')?>" readonly="readonly" class="form-control" id='date' style="padding-left:12px;" />
                        <div class="help-block">公众平台不支持跨日查询</div>
                    </div>
                    <div class="pull-right col-xs-12 col-sm-3 col-md-2 col-lg-2">
                        <button class="btn btn-default" id="search"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .infol{margin-left:35px;padding:5px;max-width:60%;}
        .infor{margin-right:35px;padding:5px;max-width:60%;}
        .pull-left,.pull-right{position:relative;}
        .spanabsolute{position:absolute;top:50px;left:0;}
        .spanrabsolute{position:absolute;top:50px;right:10px;}
    </style>
    <div class="panel panel-default" style="margin-bottom:0">
        <div class="panel-heading">聊天记录</div>
        <div class="panel-body">
            <div class="text-center"><i class="fa fa-info-circle"> 没有符合条件的记录</i></div>
        </div>
    </div>

</div>
</div>
</div>
<script>
    $(function(){
        token = '1';
        function gettokens(){
            $.ajax({
                'type' : 'GET',
                'url'  : '?r=qrcode/gettoken',
                success: function(e){
                    token = e
                },
                error  : function(e){
                    alert('no token got');
                }
            })
        }
        gettokens()
        $('#search').click(function(){

            var nickname = $('#nickname').val();
            var openid   = $('#openid').val();
            var date     = $('date').val();
            $.ajax({
                type: 'GET',
                dataType:'jsonp',
                url : 'https://api.weixin.qq.com/customservice/msgrecord/getrecord?access_token='+token,
                data : {"starttime":1433120401,"endtime":date,"openid":openid,"pagesize":50,"pageindex":1},
                success: function(data){
                    console.log("返回的数据: " + data );
                    //入库操作需要正确的返回码以及相关测试数据，亟待完善
                },
                error:function(data){
                    console.log("返回的数据: " + data );
                    alert('please enable new custom service !')
                }
            })
        })
    })
</script>