<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\UsersSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends BController
{
    /**
     * @inheritdocin
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams , $company_id);
        $role = Yii::$app->user->identity->role;
        return $this->render('index', [
            'role' => $role,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $company_id = Yii::$app->user->identity->company_id;
        $data = Company::find($company_id)->where('company_id='.$company_id)->asArray()->one();

        $role = Yii::$app->user->identity->role;
        return $this->render('view', [
            'info' => Yii::$app->user->identity,
            'role' => $role,
            'model' => $this->findModel($id),
            'company_name'=>$data['company_name']
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $id = Yii::$app->user->identity->user_id;
        $model = new Users();
        $model->setScenario('create');
        $userInfo = $model::find()->where('user_id='.$id)->asArray()->all();
        $model->role = 'operater';
        if ($model->load(Yii::$app->request->post())) {
            $model->company_id = 800067;
            $model->create_time = time();
            $model->mobile_num = ($model->mobile_num == NULL)?0:$model->mobile_num;
            $model->role = $model->role;
            if( $model->validate() ){
                $model->password = password_hash ( $model->password,PASSWORD_DEFAULT);
                if($model->save(false)){
                    return $this->redirect(['view', 'id' => $model->user_id]);
                }
            }else{
                //var_dump($model->getErrors());die();
                $model->mobile_num = ($model->mobile_num == 0)?NULL:$model->mobile_num;
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

        } else {
            //var_dump($model->getErrors());die();
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');

        if ( $model->load(Yii::$app->request->post()) && $model->validate() ) {
            if( empty( $model->password ) ){
                unset( $model->password );
            }else{
                $model->password = password_hash ( $model->password,PASSWORD_DEFAULT);
            }
            if( $model->save(false) ){
                return $this->redirect(['view', 'id' => $model->user_id]);
            }
        } else {
            //var_dump($model->getErrors());die();
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    //启用禁用
    public function actionChangeStatus($status , $id)
    {
        $model = new Users();
        $result = $model->ChangeStatus($status , $id);
        return $this->redirect('index');
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
