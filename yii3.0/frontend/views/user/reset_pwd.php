<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0033)http://www.bama555.com/auth/login -->
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>商城系统V1.7-后台管理系统</title>
    <link rel="stylesheet" type="text/css" href="public/css/base.css">
    <script type="text/javascript" src="public/js/jquery.js"></script>
    <script type="text/javascript" src="public/js/swipe.js"></script>
    <script>
        if (this.parent != this) {
            console.log(this.parent);
            this.parent.location.reload();
        }
    </script>
    <style type="text/css">
        body,div,p,ul,li,a{
            margin:0px;
            padding:0px;
        }
        body{background-repeat:no-repeat; background-position:center top;background-color: #abcdef}
        .loginbody{position:absolute; width:1030px; height:474px;  margin-top:-237px; margin-left:-465px;  left:50%; top:50%;}
        .newimgbox{background:url(./themes/default/inges/loginbg01.png) no-repeat; float:left; width:621px; height:474px; padding:4px 30px 4px 4px;}
        /*.loginbox{background:url(./themes/default/inges/loginbg02.png) no-repeat; float:right; width:380px; height:474px;}*/
        .logintop{margin:0px 30px; padding:20px 0 25px; line-height:160%; border-bottom:1px dashed #ccc}
        .logintop h1{font-size:20px; color:#0781c7;}
        .logintop p{font-size:13px; color:#999;}
        .login_table{padding-top:20px;}
        .login_table div{margin:20px auto;}
        /*.login_name{background:url(./themes/default/inges/login_name.jpg) no-repeat; width:317px; height:57px;}*/
        /*.login_pw{background:url(./themes/default/inges/login_pw.jpg) no-repeat; width:317px; height:57px;}*/
        .login_jz{line-height:30px; font-size:12px; color:#666;width:300px; height:30px; line-height:30px;}
        .login_input{margin:9px 5px 8px 60px; height:40px; line-height:40px; padding:0; border:none; width:250px; font-size:14px;}
        .login_button{width:317px; height:57px;}
        .input_button{background-color:#0781c7; width:317px; height:50px; color:#fff; border:none; font-size:20px; cursor:pointer; border-radius:3px;}
        
        .banner-box{
            width:647px;
            height: 474px;
            overflow: hidden;
            background:url(./themes/default/inges/loginbg01.png) no-repeat;
            float:left;
            padding:3px 0px ;
        }
        #banner{
            width:621px;
            height: 466px;
            overflow: hidden;
            position: relative;
        }
        #banner ul{
            width:100%;
            height: 100%;
            position: absolute;
            left:0;
            top:0;
        }
        #banner li{
            float: left;
            width:621px;
            height: 100%;
            overflow: hidden;
            display:inline-block;
            position: relative;
        }
        #banner li p{
            position: absolute;
            left:0;
            bottom:0;
            width:100%;
            height:30px;
            line-height: 30px;
            overflow: hidden;
            background: #000;
            opacity:0.7;
            color:#fff;
            padding-left:10px;
            box-sizing: border-box;
            font-size:14px;
        }
        .copyright{
            margin: 0;
            padding: 20px 0;
            width: 100%;
            text-align: center;
            bottom:10px;
            position: fixed;
        }
        .copyright a{
            
            font-size:16px;
            color: #fff;
        }
    </style>
</head>
<center>
    <body style="background-image:url(./themes/default/inges/3.jpg)">
    <div class="loginbody">
        <!--
        <div class="newimgbox">
        <ul class="clearfix">
        <img src="./themes/default/inges/login02_03.jpg" width="616" height="466"/>
        <img src="./themes/default/inges/login02_03.jpg" width="616" height="466"/>
        <img src="./themes/default/inges/login02_03.jpg" width="616" height="466"/>
        </div>
        -->
        
        <div class="loginbox">
            <div class="logintop">
                <h1>重设密码</h1>
                <p></p>
            </div>
            <form action="index.php?r=user/resetpwd" method="post" >
                <div class="login_table">
                    请输入密码: <div class="login_name"><input name="password" class="login_input" placeholder="请输入密码" type="text"></div>
                    再次确认密码: <div class="login_pw"><input name="repassword" class="login_input" placeholder="再次确认密码" ></div>
                    <div class="login_button"> <input name="submit" class="input_button" value="更改密码" type="submit">
                        <!-- <input name="token" value="196752ed" type="hidden"> -->
                        <input name="id" value="<?= $_GET['id'] ?>" type="text">
                        <input type="hidden" name="_csrf" value='<?= Yii::$app->request->csrfToken ?>'>
                    </div></div>
        </div>
        </form>
    </div>
    
    <div class="copyright"><a href="" target="_blank"> Powered by 商城系统V1.7© 2014-2015</a></div>
    <div style="display:none;">
    
    </body>
</center>
</html>