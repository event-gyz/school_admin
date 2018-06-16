<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength' => 4,
                'maxLength' => 4,
                'height' => 47,
                'width' => 80
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');


    }
    public static function randColor(){
        $colors = array();
        for($i = 0;$i<6;$i++){
            $colors[] = dechex(rand(0,15));
        }
        return implode('',$colors);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {

            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        //替换布局文件
        $this->layout = false;

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLoginbak()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            echo "<script>window.parent.location.reload()</script>";
            exit;
            //return $this->goHome();
        }

        //替换布局文件
        $this->layout = 'empty';

        return $this->render('login_bak', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        if (isset($_GET['ref']) && $_GET['ref'] == 'gso') {
            setcookie("gso", "", time() - 3600, "/");
            return $this->redirect('/gso/login');
        }
        Yii::$app->user->logout();
        return $this->redirect('/site/login');
    }

    public function actionDemo() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        //替换布局文件
        $this->layout = false;

        return $this->render('demo', [
            'model' => $model,
        ]);
    }

    //语言切换
    public function actionLanguage(){
        $language=  \Yii::$app->request->get('lang');
        if(isset($language)){
            \Yii::$app->session['language']=$language;
        }
        //切换完语言哪来的返回到哪里
        $this->goBack(\Yii::$app->request->headers['Referer']);
    }


    public function actionHelp(){
        return $this->render('help');
    }
}




