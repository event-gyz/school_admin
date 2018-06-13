<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;
use app\models\Company;
use app\models\Users;

use yii\filters\VerbFilter;


use yii\web\UploadedFile;
use app\core\Sendmsg;

class RegisterController extends Controller
{
    public $layout = 'empty';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'register' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new Users;

        $model->setScenario('register');
        if( Yii::$app->request->isPost ){
            $model->create_time = time();
            $model->role = 'surperadmin';
            $model->load( Yii::$app->request->post() );
            if( $model->validate() && $companyId = $model->register() ){

                $url = '/register/complement?id='.$companyId[0].'&uid='.$companyId[1];
                header("Content-type: text/html; charset=utf-8");
                echo "<script>alert('注册成功');window.parent.location.href='".$url."' </script>";
                exit;
            }
        }
        return $this->render('index',[
            'model'=>$model
        ]);

    }

    public function actionComplement($id)
    {
        if (empty($id)) {
            $this->redirect('site/login');
            exit;
        }

        $model = new Company();
        $company = $model->getCompanyById($id);

        if (!$company) {
            $this->redirect('site/login');
            exit;
        }

        if ($company->load(Yii::$app->request->post())) {
            $image =  UploadedFile::getInstance($company, 'company_logo');

            //文件名
            $imageName = time().rand(1000,9999) . '.'.$image->getExtension();

            $image->saveAs('./uploads/' . $imageName);//设置图片的存储位置

            $company->company_logo = '/uploads/' . $imageName;

            $company->save();

            return $this->goHome();
        }

        return $this->render('complement', [
            'model' => $company,
        ]);
    }
    
    public function actionSecretKey(){
        $model = new \app\models\BkeysApply();
        return $this->render('secretKey',[ 'model'=>$model ]);
    }
    
    public function actionGetKey(){
        $post = Yii::$app->request->post();
        $model = new \app\models\BkeysApply();
        if ( Yii::$app->request->isPost && $model->load($post) ) {
            if( false == $model->validate() ){
                return $this->render('secretKey',[ 'model'=>$model ]);
            }else if( $model->save() ){
                $title = $post['BkeysApply']['name'].'申请了密钥';
                Sendmsg::sendEmail( Yii::$app->params['adminEmail'],$title,$title );
                return $this->render('getKey');
            }
        }
        echo "提交错误";
    }
}
