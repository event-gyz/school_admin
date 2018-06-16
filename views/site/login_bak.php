<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>登录</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="/css/animate.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            background: #fff;
        }

        .content {
            width: 100%;
            overflow: hidden;
        }

        .logo {
            width: 1170px;
            margin: 0 auto;
            padding: 11px 0;
            overflow: hidden;
        }

        .logo a {
            margin-left: 20px;
            overflow: hidden;
            float: left;
        }

        .login_box {
            background: url('/images/login_bj.jpg') no-repeat center;
            background-size: 100% 100%;
            height: 640px;
            width: 100%;
        }

        .loginFrom {
            width: 1170px;
            margin: 0 auto;
            overflow: hidden;
            padding: 60px 0 0px;
        }

        .login {
            width: 316px;
            height: 390px;
            overflow: hidden;
            padding: 0 20px;
            background: #fff;
            border-radius: 4px;
            float: right;
        }

        .login header {
            height: 94px;
            line-height: 94px;
            text-align: center;
            color: #f97432;
            font-size: 26px;
        }

        .login .errorBox {
            color: #f32711;
            font-size: 13px;
            background: url('/images/errorIcon.jpg') no-repeat;
            padding-left: 20px;
        }

        .show {
            display: block;
        }

        .hide {
            display: none;
        }

        .login .formList {
            border: 1px solid #e0e6e9;
            border-bottom: none;
            margin-top: 13px;
        }

        .login .formList ul {
            list-style: none;
        }

        .login .formList ul li {
            border-bottom: 1px solid #e0e6e9;
            overflow: hidden;
        }

        .login .formList ul li span {
            display: block;
            float: left;
            width: 47px;
            height: 47px;
            border: none;
        }

        .login .formList ul li span img {
            display: block;
            width: 47px;
            height: 47px;
            border: none;
        }

        .login .formList ul li input {
            height: 47px;
            width: 244px;
            float: left;
            border: none;
            background: none;
            padding: 0 10px;
            outline: none;
        }

        .login .formList ul li .codeInput {
            width: 160px;
        }

        .login .formList ul li .codeImg {
            float: right;
            height: 47px;
            width: 70px;
            margin-right: 10px;
        }

        .remBox {
            overflow: hidden;
            font-size: 13px;
            margin-top: 10px;
        }

        .remBox div {
            float: left;
        }

        .remBox div input {
            float: left;
            margin-top: 1px;
            margin-right: 3px;
        }

        .remBox a {
            float: right;
            text-decoration: none;
            color: #0090c5;
        }

        .submitBtn {
            text-align: center;
            height: 41px;
            margin-top: 20px;
            line-height: 41px;
            border-radius: 4px;
        }

        .submitBtn a {
            color: #fff;
            text-decoration: none;
            display: block;
        }

        .foot {
            height: 100px;
            background: #f00;
            margin-top: 20px;
        }

        .field-loginform-verifycode p {
            margin: 0 0;
        }

        .btn-block {
            background: #f97432;
            border: 1px solid #f97432;
        }

        .btn-block:hover {
            background: #d65617;
            border: 1px solid #d65617;
        }

        .keTel {
            display: inline-block;
            float: right;
            margin-top: 8px;
            font-size: 15px;
        }

        .keTel span {
            color: #3360af;
            font-weight: 700;
            font-size: 24px;
            margin-left: 10px;
        }
    </style>
</head>

<body>
<header class="logo" id="header">
    <?php if(isset(Yii::$app->session['language']) && Yii::$app->session['language'] == 'en'){ ?>
        <a href="/"><img src="/images/en_login.png" alt=""></a>
    <?php }else { ?>
        <a href="/"><img src="/images/login.png" alt=""></a>
    <?php 
        }
    ?>
    <p class="keTel"><?= Yii::t('app', 'CONTACT US') ?> :<span>010-57458048</span></p>
</header>
<div class="content" id="content">
    <div class='login_box'>
        <div class="loginFrom">
            <section class="login">
                <form id="w0" action="/site/login" method="post" role="form">
                    <input type="hidden" name="_csrf" value="<?= yii::$app->request->getCsrfToken() ?>">
                    <header><?= Yii::t('app', 'User Login') ?></header>

                    <?php if ($model->getFirstErrors()): ?>
                    <div class="errorBox" id="errorBox">
                        <?php foreach ($model->getFirstErrors() as $error): ?>
                            <?= $error ?>
                            <?php break; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <div class="formList">
                        <ul>
                            <li>
                                <span><img src="/images/userName.jpg" alt=""></span>
                                <div class="form-group field-loginform-username required">

                                    <input type="text" id="loginform-username" class="userName" name="LoginForm[username]" placeholder="<?= Yii::t('app', 'Username') ?>" value="<?= $model->getIterator()['username'] ?>">

                                </div>
                                <!--                              <input type="text" class="userName" placeholder="企业账号">-->
                            </li>
                            <li>
                                <span><img src="/images/password.jpg" alt=""></span>
                                <div class="form-group field-loginform-password required">

                                    <input type="password" id="loginform-password" class="password" name="LoginForm[password]" placeholder="<?= Yii::t('app', 'Password') ?>" value="<?= $model->getIterator()['password'] ?>">

                                </div>
                            </li>
                            <li>
                                <div class="form-group field-loginform-verifycode">

                                    <span><img src="/images/code.jpg" alt=""></span>
                                    <input type="text" id="loginform-verifycode" class="codeInput" name="LoginForm[verifyCode]" placeholder="<?= Yii::t('app', 'Verification code') ?>" value="<?= $model->getIterator()['verifyCode'] ?>">
                                    <p class="codeImg" id="codeImg">
                                        <img id="loginform-verifycode-image" src="/site/captcha?v=58ca3b1f89bfc" alt="">
                                    </p>

                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="remBox">
                        <div>
                            <input id="rem" type="checkbox"> <label for="rem"><?= Yii::t('app', 'Remember Password') ?></label>
                        </div>

                        <!--                        <a href="javascript:;">忘记密码？</a>-->
                    </div>
                    <div class="submitBtn" id="submitBtn">
                        <button type="submit" class="btn btn-success btn-block" name="login-button"><?= Yii::t('app', 'Login') ?></button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<div class="w1170 clearfix">
    <div class="footer-copyright" style="background: none;">
    </div>
</div>
<script type="text/javascript">
    (function () {

        size();
        function size() {
            var h = $('#header')[0].clientHeight;
            var f = $('#footer').height();
            var wh = $(window).height();
            $('#content,.login_box').height(wh - h - f - 60);
        }

        $(document).resize(function () {
            size()
        });


        var rep = false;

        $("#loginform-verifycode-image").click(function () {
            $.get('/site/captcha?refresh=', function (res) {
                $("#loginform-verifycode-image").attr('src', res.url);
            })
        });
        /*
         $.post('url',{},function(data){
         if(data.url){
         $('#codeImg').find('img').attr('src',data.url);
         }
         })

         $('#codeImg').click(function(){
         $.post('url',{},function(data){
         if(data.url){
         $('#codeImg').find('img').attr('src',data.url);
         }
         })
         })

         function error(yn,txt){
         if(yn){
         if(txt){
         $('#errorBox').css('display','block').html(txt);
         }
         }else{
         $('#errorBox').css('display','none');
         }

         }

         $('#submitBtn').click(function(){
         if($('#rem').prop('checked')){
         rep=true;
         }else{
         rep=false;
         }

         var userName=$('.userName').val();
         var password=$('.password').val();
         var code=$('.codeInput').val();

         if(userName==''){
         error(1,'用户名不能为空');
         return false;
         }else if(userName.length<5){
         error(1,'用户名长度不能小于5');
         return false;
         }

         if(password==''){
         error(1,'密码不能为空');
         return false;
         }else if(password.length>30 || password.length<6){
         error(1,'密码长度为6~30个字符');
         return false;
         }

         if(code==''){
         error(1,'验证码不能为空');
         return false;
         }else if(code.length!=4){
         error(1,'验证码不正确');
         return false;
         }
         error(0)
         $.post('url',{'userName':userName,'password':password,'code':code},function(data){

         });
         })
         */
    }())

</script>
</body>

</html>
