<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>登录</title>
    <link href="/css/school_admin.css" rel="stylesheet">
</head>
<body>
<div id="login">
    <div class="login_bg"><p></p></div>
    <div class="logo"></div>
    <div class="modal">
        <div class="form">
            <p>— 成长日记后台管理系统 —</p>
            <form id="w0" action="/site/login" method="post" role="form">
                <input type="hidden" name="_csrf" value="<?= yii::$app->request->getCsrfToken() ?>">
                <?php if ($model->getFirstErrors()): ?>
                    <div class="errorBox" id="errorBox">
                        <?php foreach ($model->getFirstErrors() as $error): ?>
                            <?= $error ?>
                            <?php break; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="username">
                    <i></i>
                    <input type="text" name="LoginForm[username]" placeholder="请输入用户名/手机号" value="<?= $model->getIterator()['username'] ?>">
                </div>
                <div class="password">
                    <i></i>
                    <input type="password" id="loginform-password" name="LoginForm[password]" placeholder="密码" value="<?= $model->getIterator()['password'] ?>">
                </div>

        <div class="remember_forget">
            <a href="#">忘记密码？</a>
            <p>
                <input type="checkbox">
                记住密码
            </p>
        </div>

        <div class="submitBtn" id="submitBtn">
            <button class="login_sub btn btn-success btn-block" name="login-button" type="submit">登录</button>
        </div>
        </form>
        </div>
    </div>
</div>
</body>
<script src="/js/jquery-2.1.1.min.js"></script>
<script src="/js/main.js"></script>
</html>