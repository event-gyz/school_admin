<?php

namespace app\controllers;

use Yii;
use app\models\Admin;
use app\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends BController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndexAdmin()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $search = Yii::$app->request->queryParams;
        $search['AdminSearch']['type'] = 3;
        $dataProvider = $searchModel->search($search);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Admin();
        if ($model->load(Yii::$app->request->post())) {
            $imageUploadFile =   UploadedFile::getInstance($model,'img');
            if($imageUploadFile != null ){
                $saveUrl = $this->qiniu($imageUploadFile);
                $model->img = $saveUrl;
            }
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $imageUploadFile =   UploadedFile::getInstance($model,'img');
            if($imageUploadFile != null ){
                $saveUrl = $this->qiniu($imageUploadFile);
                $model->img = $saveUrl;
            }

            $model->save();
            if($model->type==1){
                return $this->redirect(['update', 'id' => $model->uid]);
            }else{
                return $this->redirect(['index']);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function qiniu($imageUploadFile){
        $typeUrl = '/uploads/';
        $saveUrl = $this->saveImage($imageUploadFile, '', '', $typeUrl);
        return $saveUrl;
    }

    public function saveImage($imageUploadInstance, $width, $height, $type)
    {
        if ($imageUploadInstance == null)
        {
            return null;
        }
        $imageFileExt = strtolower($imageUploadInstance->getExtension());
        $save_path    = Yii::$app->getBasePath().'/web'.$type;
        if (!file_exists($save_path))
        {
            mkdir($save_path, 0777, true);
        }
        $ymd = date("Y/md");
        $save_path .= $ymd . '/';
        if (!file_exists($save_path))
        {
            mkdir($save_path, 0777, true);
        }
        $img_prefix    = date("YmdHis") . '_' . rand(10000, 99999);
        $imageFileName = $img_prefix . '.' . $imageFileExt;
        $save_path .= $imageFileName;
        $imageUploadInstance->saveAs($save_path);
        //$obj = Image::thumbnail($save_path, $width, $height)->save($save_path);
        return  $type.$ymd . '/'. $imageFileName;
    }
    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
