<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\core\Permission;
use yii\helpers\Url;
//use yii;


AppAsset::register($this);
$menu = array(
    'meeting'       =>array('meeting'),
    'sendrfp'       =>array('sendrfp'),
    'rfp'           =>array('rfp'),
    'hotel'         =>array('place'),
    'users'         =>array('users'),
    'subcompany'    =>array('subcompany'),
    'NearTheHotel'  =>array('search'),
	'SearchPlace'   =>array('psearch'),
    'tuanfangOrder' =>array('order'),
    'log'           =>array('action-log'),
    'yrfp'          =>array('yrfp'),
    'site'          =>array('index'),
);
function isActive($menuVal=array(),$returnBool=false){
    $controllerId = strtolower( Yii::$app->controller->id );
    $actionId     = strtolower( Yii::$app->controller->action->id );
    if( isset( $menuVal[$controllerId] ) ){
        if( in_array( $actionId, $menuVal[$controllerId]) ){
            return $returnBool ? true : 'active';
        }
    }else if( in_array( $controllerId, $menuVal) ) {
        return $returnBool ? true : 'active';
    }
    return $returnBool ? false : '';
}
//var_dump(isActive($menu['rfp']));exit;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="https:////cdn.bootcss.com/moment.js/1.0.0/moment.min.js"></script>
</head>
<style type="text/css">
    .jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}
    html,body{-ms-overflow-style: scrollbar;font-family: "Hiragino Sans GB","Hiragino Sans GB W3","微软雅黑","Microsoft Yahei",Arial,"Times New Roman",Times,serif !important}
    .text-danger{color:#fa2b23!important};
</style>
<body class="skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<style>
    .fixed {
        position: fixed;
        top: 0;
        z-index: 1000;
        width: 100%;
        -position: absolute;
        -top: expression(eval(document.documentElement.scrollTop))
    }
</style>
<div class="wrap">
    <div class="wrapper">

        <header class="main-header fixed">
            <!-- Logo -->
            <a href="/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>M</b>PS</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><?=Yii::t('app',Yii::t('app', 'Novartis eSourcing'))?></span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">

<!--                            <a href="/users/view?id=<?= Yii::$app->session['__id'] ?>" class="dropdown-toggle" data-toggle="dropdown">-->
                            <a href="/users/view?id=<?= Yii::$app->session['__id'] ?>" class="dropdown-toggle">
                                <span class="hidden-xs fa  fa-user">
                                        <?php 
                                            if(isset(Yii::$app->session['language']) && Yii::$app->session['language'] == 'en'){
                                                $name = \Yii::$app->user->isGuest ? '' : \Yii::$app->user->identity->en_name;
                                            } else {
                                                $name = \Yii::$app->user->isGuest ? '' : \Yii::$app->user->identity->real_name;
                                            }
                                            $_SESSION['name'] = $name;
                                            echo $name;
                                        ?>
                                </span>
                            </a>

                            <ul class="dropdown-menu">
                                <!--<li class="user-header">
                                    <img src="<?/*=Url::to('@web/img/user2-160x160.jpg');*/?>" class="img-circle" alt="User Image">

                                    <p>
                                        Alexander Pierce - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>-->
                               <!-- <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </div>
                                </li>-->
                                <!-- Menu Footer-->
<!--                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="/site/logout" class="btn btn-default btn-flat"><?= \Yii::t('app', 'Logout') ?></a>
                                    </div>
                                </li>-->
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->

                        <li>
                            <a href="/site/logout"><?= \Yii::t('app', 'Logout') ?></a>
                        </li>
<!--                        <li>-->
<!--                            <a href="/site/help">--><?//= \Yii::t('app', '使用手册') ?><!--</a>-->
<!--                        </li>-->
                        <li class="hide">
                            <a href="#" data-toggle="control-sidebar">
                                <i class="fa fa-gears"></i>
                                <?= \Yii::t('app', 'Theme') ?>
                            </a>
                        </li>
                        <li>
                            <a>|</a>
                        </li>
<!--                        <li>-->
<!--                            <a href="--><?//= Yii::$app->urlManager->createUrl(['/site/language','lang'=>'zh-CN']);?><!--">中文</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="--><?//= Yii::$app->urlManager->createUrl(['/site/language','lang'=>'en']);?><!--">English</a>-->
<!--                        </li>-->

                    </ul>
                </div>

            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar" style="margin-top: 20px;">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel user-default">
                    <div class="image"><!-- 这里是公司LOGO -->
                        <img src="<?= \Yii::$app->session['company']['company_logo'] ?>" onerror="javascript:this.src='/images/head.png';" class="img-circle" alt="">
                    </div>
                    <div class="info">
                        <p><?= $name ?></p>
                    </div>
                </div>
<?php

echo \yii\widgets\Menu::widget([
    'options'=>[ 'class'=>'sidebar-menu' ],
    'items' => [

//        [
//            'label' => Yii::t('app','PCH Hotel'),
//            'url' => [ Url::to('/tuanfang/search/index') ],
//            'options'=>['class'=>'treeview'],
//            'template'=>'<a href="{url}"><i class="fa fa-fw fa-binoculars"></i>&nbsp;&nbsp;<span>{label}</span></a>',
//            'active'=>isActive($menu['NearTheHotel'],true),
//            'visible'=>Permission::checkAccess('users/index')
//        ],
//        [
//            'label' => Yii::t('app','Bid Management'),
//            'url' => [ Url::to('/brfp/meeting/index') ],
//            //'options'=>['class'=>'treeview'],
//            'template'=>'<a href="{url}"><i class="fa fa-book"></i>&nbsp;&nbsp;<span>{label}</span></a>',
//            'active'=>isActive($menu['meeting'],true),
//        ],
//        [
//            'label' => Yii::t('app','Search Place'),
//            'url' => [ Url::to('/search-place/psearch/index') ],
//            'options'=>['class'=>'treeview'],
//            'template'=>'<a href="{url}"><i class="fa fa-fw fa-binoculars"></i>&nbsp;&nbsp;<span>{label}</span></a>',
//            'active'=>isActive($menu['SearchPlace'],true),
//            'visible'=>Permission::checkAccess('users/index')
//        ],
//        [
//            'label' => Yii::t('app','报表与数据'),
//            'url' => 'http://www.cubicube.net/main.html',
//            'options'=>['class'=>'treeview'],
//            'template'=>'<a href="{url}" target="_blank"><i class="fa fa-fw fa-database"></i>&nbsp;&nbsp;<span>{label}</span></a>',
//            'active'=>false,
//            'visible'=>true
//        ],
        [
            'label' => Yii::t('app','年度RFP'),
            'url' => [ Url::to('/yrfp/yrfp/index') ],
            //'options'=>['class'=>'treeview'],
            'template'=>'<a href="{url}"><i class="fa fa-fw fa-inbox"></i>&nbsp;&nbsp;<span>{label}</span></a>',
            'active'=>isActive($menu['yrfp'],true),
        ],
//        [
//            'label' => Yii::t('app','统计报表'),
//            'url' => [ Url::to('/site/index') ],
//            //'options'=>['class'=>'treeview'],
//            'template'=>'<a href="{url}"><i class="fa fa-fw fa-pie-chart"></i>&nbsp;&nbsp;<span>{label}</span></a>',
//            'active'=>isActive($menu['site'],true),
//        ],
        [
            'label' => Yii::t('app','User Management'), 
            'url' => [ Url::to('/users/index') ],
            //'options'=>['class'=>'treeview'],
            'template'=>'<a href="{url}"><i class="fa fa-fw fa-user"></i>&nbsp;&nbsp;<span>{label}</span></a>',
            'active'=>isActive($menu['users'],true),
        ],

//        [
//            'label' => Yii::t('app','Subcompanies'),
//            'url' => [ Url::to('/subcompany/index') ],
//            'options'=>['class'=>'treeview'],
//            'template'=>'<a href="{url}"><i class="fa fa-fw fa-cubes"></i>&nbsp;&nbsp;<span>{label}</span></a>',
//            'active'=>isActive($menu['subcompany'],true),
//        ],
//        [
//            'label' => Yii::t('app','Action Logs'),
//            'url' => [ Url::to('/action-log/index') ],
//            'options'=>['class'=>'treeview'],
//            'template'=>'<a href="{url}"><i class="fa fa-fw fa-list-alt"></i>&nbsp;&nbsp;<span>{label}</span></a>',
//            'active'=>isActive($menu['log'],true),
//            'visible'=>Permission::checkAccess('action-log/index')
//        ],
        
        
        
        
        /*[
            'label' => Yii::t('app','Hotel'), 
            'url' => [ Url::to('/place/index') ],
            'options'=>['class'=>'treeview'],
            'template'=>'<a href="{url}"><i class="fa fa-fw fa-list"></i>&nbsp;&nbsp;<span>{label}</span></a>',
            'active'=>isActive($menu['hotel'],true),
            'visible'=>Permission::checkAccess('place/index')
        ],
        [
            'label' => Yii::t('app','Rooms Order'),
            'url' => [ Url::to('/tuanfang/order/index') ],
            'options'=>['class'=>'treeview'],
            'template'=>'<a href="{url}"><i class="fa fa-fw fa-files-o"></i>&nbsp;&nbsp;<span>{label}</span></a>',
            'active'=>isActive($menu['tuanfangOrder'],true),
            'visible'=>Permission::checkAccess('users/index')
        ],
        [
            'label' => Yii::t('app','年度RFP演示版'),
            'url' => '/年度RFP',
            'options'=>['class'=>'treeview'],
            'template'=>'<a href="{url}" target="_blank"><i class="fa fa-fw fa-book"></i>&nbsp;&nbsp;<span>{label}</span></a>',
            'active'=>false,
            'visible'=>true
        ],*/

    ],
]);
?>

            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper" style="margin-top: 50px;">
                                                                            <section class="content-header none">
                                          <?= Breadcrumbs::widget([
                'homeLink'=>false,
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
    </section>
            <section class="content">
                            <?= $content ?>
            </section>
           
        </div>
 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Powered By <b><a href="http://www.eventown.com/" rel="external">Eventown.com</a></b>
    </div>
     <p class="pull-left">&copy; eventown.com <?= date('Y') ?></p>
        <p class="pull-left" style="padding-left:40px;">
            <span><?= yii::t('app', 'Eventown') ?></span>
            <span><?= yii::t('app', 'SITE China Chapter') ?></span>
        </p>
        <p class="pull-left" style="padding-left:40px;">
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010502031239" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;">
                <img style="float:left;" src="//links.eventown.com/images/footer/bei_an.png">
            </a>
        </p>
        <p class="pull-left">
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010502031239" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;">
                京公网安备 11010502031239号
            </a>
        </p>
  </footer>
    </div>
</div>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-user bg-yellow"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                            <p>New phone +1(800)555-1234</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                            <p>nora@example.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                            <p>Execution time 5 seconds</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="label label-danger pull-right">70%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Update Resume
                            <span class="label label-success pull-right">95%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Laravel Integration
                            <span class="label label-warning pull-right">50%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Back End Framework
                            <span class="label label-primary pull-right">68%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->

        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">


        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- <footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; eventown.com <?= date('Y') ?></p>
        <p class="pull-left" style="padding-left:40px;">
            <span>会唐网</span>
            <span><?= yii::t('app', 'SITE China Chapter') ?></span>
        </p>
        <p class="pull-left" style="padding-left:40px;">
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010502031239" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;">
                <img style="float:left;" src="//links.eventown.com/images/footer/bei_an.png">
            </a>
        </p>
        <p class="pull-left">
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010502031239" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;">
                京公网安备 11010502031239号
            </a>
        </p>
        
        <p class="pull-right">Powered By <a href="http://www.eventown.com/" rel="external">Eventown.com</a></p>
    </div>
</footer> -->
<?php $this->registerJsFile("/plugins/jQuery/jquery.cookie.js",['depends'=>  \app\assets\AppAsset::className()]) ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
