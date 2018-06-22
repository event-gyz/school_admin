<?php

namespace app\controllers;

use app\models\Member;
use Yii;
use app\models\Users;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends BController
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $agency_id = 0;
        $searchModel = new UsersSearch();
        $params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if(isset($params['UsersSearch']['agency_id']) && !empty($params['UsersSearch']['agency_id'])){
            $agency_id = $params['UsersSearch']['agency_id'];
        }
        $statistics = $this->getUserStatistics($agency_id);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statistice' =>$statistics,
        ]);
    }


    public function getUserStatistics($agency_id=0){
        $time = date("Y-m-d H:i:s", strtotime("-3 month"));
        if(empty($agency_id)){
            $result['all'] = Member::find()->asArray()->count();
            $result['new'] = Member::find()->andWhere(['>','create_time',$time])->asArray()->count();
            $result['ative'] = Member::find()->andWhere(['>','last_login_time',$time])->asArray()->count();
        }else{
            $result['all'] = Member::find()->where(['agency_id'=>$agency_id])->asArray()->count();
            $result['new'] = Member::find()->andWhere(['>','create_time',$time])->where(['agency_id'=>$agency_id])->asArray()->count();
            $result['ative'] = Member::find()->where(['agency_id'=>$agency_id])->andWhere(['>','last_login_time',$time])->asArray()->count();

        }
        return $result;
    }
    /**
     * Displays a single Users model.
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
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uid]);
        } else {
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uid]);
        } else {
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


    /**
     * 导出yrfp相关数据
     */
    public function actionExportData()
    {

        if(!empty(yii::$app->request->get())){
            $params = yii::$app->request->get()['params'];
        }else{
            $params = [];
        }
        $params = json_decode(base64_decode($params),true);
        $searchModel = new UsersSearch();
        $result = $searchModel->searchExprotData($params);

        if(empty($result)){
            echo '没有符合条件的数据';exit;
        }
        $title = date('Y-m-d H:i:s',time()).'导出数据';
        $this->exportExcel(['昵称','省份','城市','年龄','性别','手机号','微信昵称','来源','身高','体重','语言','人格','大动作','小动作','认知','自我帮助','牙齿'], $result, $title, './', true);

    }

    public function exportExcel($title=array(), $data=array(), $fileName='', $savePath='./', $isDown=false){
        $obj = new \PHPExcel();
        //横向单元格标识
        $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

        $obj->getActiveSheet(0)->setTitle('sheet名称');   //设置sheet名称
        $_row = 1;   //设置纵向单元格标识
        if($title){
            $i = 0;
            foreach($title AS $v){   //设置列标题
                $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i].$_row, $v);
                $i++;
            }
            $_row++;
        }

        //填写数据
        if($data){
            $i = 0;
            foreach($data AS $_v){
                $obj->getActiveSheet()->setCellValue('A' . ($i + $_row), $_v['nick_name']);
                $obj->getActiveSheet()->setCellValue('B' . ($i + $_row), $_v['member']['province']);
                $obj->getActiveSheet()->setCellValue('C' . ($i + $_row), $_v['member']['city']);

                $birthday = new \DateTime($_v['birth_day']);
                $diff = $birthday->diff(new \DateTime());
                $months = $diff->format('%m') + 12 * $diff->format('%y');
                $birth_day = sprintf("%.1f",substr(sprintf("%.3f", $months/12), 0, -2));
                $obj->getActiveSheet()->setCellValue('D' . ($i + $_row), $birth_day);

                $obj->getActiveSheet()->setCellValue('E' . ($i + $_row), ($_v['gender']==1)?'女':'男');
                $obj->getActiveSheet()->setCellValue('F' . ($i + $_row), $_v['member']['cellphone']);
                $obj->getActiveSheet()->setCellValue('G' . ($i + $_row), $_v['member']['nickname']);

                if(!empty($_v['member']['agency_id'])){
                    $uu = \app\models\Admin::findOne(['uid'=>$_v['member']['agency_id']])->toArray();
                    $agency = $uu['username'];
                }else{
                    $agency = '无';
                }
                $obj->getActiveSheet()->setCellValue('H' . ($i + $_row), $agency);

                //身高
                $height = \app\models\WapHeight::find()->where(['uid'=>$_v['uid']])->asArray()->one();
                $height_index = !empty($height['height'])?$height['height']:'无数据';
                $obj->getActiveSheet()->setCellValue('I' . ($i + $_row), $height_index);

                //体重
                $weight = \app\models\WapWeight::find()->where(['uid'=>$_v['uid']])->asArray()->one();
                $weight_index = !empty($weight['weight'])?$weight['weight']:'无数据';
                $obj->getActiveSheet()->setCellValue('J' . ($i + $_row), $weight_index);

                $obj->getActiveSheet()->setCellValue('K' . ($i + $_row), $this->handleTypeIndex($_v['type_0']));
                $obj->getActiveSheet()->setCellValue('L' . ($i + $_row), $this->handleTypeIndex($_v['type_1']));
                $obj->getActiveSheet()->setCellValue('M' . ($i + $_row), $this->handleTypeIndex($_v['type_2']));
                $obj->getActiveSheet()->setCellValue('N' . ($i + $_row), $this->handleTypeIndex($_v['type_3']));
                $obj->getActiveSheet()->setCellValue('O' . ($i + $_row), $this->handleTypeIndex($_v['type_4']));
                $obj->getActiveSheet()->setCellValue('P' . ($i + $_row), $this->handleTypeIndex($_v['type_5']));

                //牙齿
                $a = \app\models\WapBuds::find()->where(['uid'=>$_v['supervisor_uid']])->orderBy(['date' => SORT_ASC])->asArray()->one();
                $buds = !empty($a['date'])?$a['date']:'无数据';
                $obj->getActiveSheet()->setCellValue('Q' . ($i + $_row), $buds);
                $i++;
            }
        }

        //文件名处理
        if(!$fileName){
            $fileName = uniqid(time(),true);
        }

        $objWrite = \PHPExcel_IOFactory::createWriter($obj, 'Excel2007');

        if($isDown){   //网页下载
            header('pragma:public');
            header("Content-Disposition:attachment;filename=$fileName.xlsx");
            $objWrite->save('php://output');exit;
        }

        $_fileName = iconv("utf-8", "gb2312", $fileName);   //转码
        $_savePath = $savePath.$_fileName.'.xlsx';
        $objWrite->save($_savePath);

        return $savePath.$fileName.'.xlsx';

    }


    private function handleTypeIndex($num){
        if($num<30){
            return '弱';
        }else if($num<60){
            return '中';
        }else{
            return '强';
        }
    }
}
