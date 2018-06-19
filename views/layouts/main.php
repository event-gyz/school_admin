<?php
/* @var $this \yii\web\View */
/* @var $content string */
// use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
// AppAsset::register($this);
$menu = array(
    'admin'           =>array(
        'admin'       =>array('index','update'),
    ),
    'users' => [
        'users',
    ],


);
//function isActive($menuVal=array(),$returnBool=false){
//    $controllerId = strtolower( Yii::$app->controller->id );
//    $actionId     = strtolower( Yii::$app->controller->action->id );
//    if( isset( $menuVal[$controllerId] ) ){
//        if( in_array( $actionId, $menuVal[$controllerId]) ){
//            return $returnBool ? true : 'active';
//        }
//    }else if( in_array( $controllerId, $menuVal) ) {
//        return $returnBool ? true : 'active';
//    }
//    return $returnBool ? false : '';
//}
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>"  class="app">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="expires" content="0">
        <meta http-equiv="pragma" content="no-cache">
        <meta http-equiv="cache-control" content="no-cache">
        <meta name="msapplication-config" content="none"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="stylesheet" href="//at.alicdn.com/t/font_og13f713pkg1fw29.css">
        <?=Html::cssFile('@web/css/font.css')?>
        <?=Html::cssFile('@web/css/font_all.css')?>
        <?=Html::cssFile('@web/css/app.v2.css')?>
        <?=Html::cssFile('@web/css/style.css')?>
        <?=Html::cssFile('@web/css/webuploader/webuploader.css')?>
        <?=Html::jsFile('@web/js/app.v2.js')?>
        <?=Html::jsFile('@web/js/html5shiv.js')?>
        <?=Html::jsFile('@web/js/respond.min.js')?>

        <?=Html::jsFile('@web/js/jquery-1.8.2.js')?>

        <?=Html::jsFile('@web/js/plugins/select2/select2.full.js')?>


        <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <?=Html::jsFile('@web/js/plugins/webuploader/webuploader.min.js')?>

        <?=Html::jsFile('@web/js/plugins/suggest/bootstrap-suggest.min.js')?>
        <?=Html::jsFile('@web/plugins/datetimepicker/bootstrap-datetimepicker.min.js')?>
        <?=Html::cssFile('@web/plugins/datetimepicker/bootstrap-datetimepicker.min.css')?>




        <!--        --><?php //$this->registerJsFile("@web/js/layer.js");?>
        <?=Html::cssFile('@web/css/jquery-confirm.css')?>
        <?=Html::jsFile('@web/js/jquery-confirm.min.js')?>
        <?=Html::jsFile('@web/js/layer.js')?>
        <script src="https://cdn.bootcss.com/bluebird/3.5.1/bluebird.core.js"></script>
        <style>
            #browser_pop {position:absolute;width:100%;height:100%;left:0;top:0;background:#000;opacity:0.9;z-index:99999;display:none;}
            #browser_pop h2 {text-align:center;padding:50px 0;color:#fff;font-size:20px;}
            #browser_pop h2 a {color:red;}
        </style>
        <script>

            var Promise = window.Promise;
        </script>
    </head>
    <style>
        .fa-20x{font-family: 'Microsoft YaHei';font-size: 20px;line-height: 2em;}
        .fa-10x{font-family: 'Microsoft YaHei';font-size: 18px;line-height: 1em;}
        div.dataTables_wrapper select{width: auto;margin: 0 4px;}
        .navbar-brand .logo{max-height: 30px;border-radius: 3px;}
        table td{word-wrap: break-word;}
        .flleft{float: left;padding-left: 10%;}
    </style>
    <body  style="font-size: 12px;">
    <div id="browser_pop">
        <h2>本系统不支持IE浏览器，请使用其他浏览器查看，或<a href="http://rj.baidu.com/soft/detail/14744.html">下载chrome浏览器。</a></h2>
    </div>



    <?php $this->beginBody() ?>

    <section class="vbox">
        <header class="bg-dark dk header navbar navbar-fixed-top-xs">
            <div class="navbar-header aside-md">

                <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav" style="margin-left: 70%">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="/" class="navbar-brand">
                    <img src="<?=Url::to('@web/images/logo.png');?>" class="m-r-sm logo">
                </a>
                <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
                    <i class="fa fa-cog"></i>
                </a>

            </div>

            <div class="flleft">&nbsp;</div>
            <div>
                <ul class="nav navbar-nav navbar-right hidden-xs nav-user">

                    <li>
                        <a href="/site/logout">退出</a>
                    </li>
                </ul>
            </div>
        </header>
        <!--公用头部  end-->
        <script>
            function browserType(){
                if (window.navigator.userAgent.indexOf("MSIE")>=1)  {
                    $('#browser_pop').show();
                }else if (!!window.ActiveXObject || "ActiveXObject" in window){
                    $('#browser_pop').show();
                }

            }
            browserType();
        </script>
        <section>
            <section class="hbox stretch">
                <!-- 公用左侧导航  begin-->
                <aside class="bg-dark lter aside-md hidden-print" id="nav">
                    <section class="vbox">

                        <section class="w-f scrollable">
                            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                                <h1 style="text-align: center;"><b><?php echo \Yii::$app->user->identity->username;?></b></h1>
                                <!-- 左侧大导航 begin -->
                                <nav class="nav-primary hidden-xs">
                                    <ul class="nav">
                                        <li class="active">
<!--                                            --><?//= isActive($menu['admin']) ;?>
                                            <a href="">
                                                <i class="fa fa-user icon">
                                                    <b class="bg-success"></b>
                                                </i>
                                                <span class="pull-right">
                                                    <i class="fa fa-angle-down text"></i>
                                                    <i class="fa fa-angle-up text-active"></i>
                                                </span>
                                                <span>系统管理</span>
                                            </a>
                                            <ul class="nav lt">
                                                <li>
                                                    <a href="<?=Url::to(['admin/update?id='.Yii::$app->session['__id']]);?>">

                                                        <i class="fa fa-angle-down text"></i>
                                                        <i class="fa fa-angle-up text-active"></i>
                                                        <span>账号管理</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <?php if(\Yii::$app->user->identity->type==1){?>
                                            <ul class="nav lt">
                                                <li>
                                                    <a href="<?=Url::to(['admin/index']);?>">

                                                        <i class="fa fa-angle-down text"></i>
                                                        <i class="fa fa-angle-up text-active"></i>
                                                        <span>合作商管理</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <?php }?>
                                        </li>
                                        <li class="active">
<!--                                        <li class="--><?//= isActive($menu['member']) ?><!--">-->
                                            <a href="">
                                                <i class="fa fa-database icon">
                                                    <b class="bg-success"></b>
                                                </i>
                                                <span class="pull-right">
                                                    <i class="fa fa-angle-down text"></i>
                                                    <i class="fa fa-angle-up text-active"></i>
                                                </span>
                                                <span>数据中心</span>
                                            </a>
                                            <ul class="nav lt">
                                                <li>
                                                    <a href="<?=Url::to(['users/index']);?>">
                                                        <i class="fa fa-angle-down text"></i>
                                                        <i class="fa fa-angle-up text-active"></i>
                                                        <span>数据展示</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                                <!-- 左面大导航 end -->
                            </div>
                        </section>
                        <footer class="footer lt hidden-xs b-t b-dark">
                            <nav class=" on aside-md m-l-n dropup" id="chat">
                                <ul class="dropdown-menu aside-md panel-body">

                                </ul>
                            </nav>
                            <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
                                <i class="fa fa-angle-left text"></i>
                                <i class="fa fa-angle-right text-active"></i>
                                <i class="fa fa-angle-right text-active"></i>
                            </a>
                            <div class="btn-group hidden-nav-xs">

                            </div>
                        </footer>
                    </section>
                </aside>
                <!-- 公用左侧导航  end-->
                <section id="content" style="width:100%;">
                    <section class="vbox">

                        <section class="scrollable padder" id="scrollable">
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]) ?>
                            <?= $content ?>
                        </section>
                    </section>
                </section>

                <?php $this->endBody() ?>

    </body>
    </html>
<?php $this->endPage() ?>