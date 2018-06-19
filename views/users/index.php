<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '数据列表';
?>
<div class="users-index" style="width: 100%;  overflow-x: scroll; overflow-y: hidden;white-space: nowrap; ">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'uid',
            'nick_name',
            [
                'label'=>'城市',
                'attribute'=>'city',
                'value'=>'member.city'
            ],
            [
                'attribute' => 'age',
                'label'=>'年龄',
                'headerOptions' => ['style'=>'width:70px'],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'birth_day',
                    $searchModel::$age,['class' => 'form-control']),
                'value'=>
                    function($model){
                        $birthday = new \DateTime($model->birth_day);
                        $diff = $birthday->diff(new \DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');
                        return sprintf("%.1f",substr(sprintf("%.3f", $months/12), 0, -2));
                    },
            ],
            [
                'attribute' => 'gender',
                'label'=>'性别',
                'headerOptions' => ['style'=>'width:70px'],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'gender',
                    $searchModel::$gender,['class' => 'form-control']),
                'value'=>
                    function($model){
                        switch ($model->gender){
                            case 0:
                                return '男';
                                break;
                            case 1:
                                return '女';
                                break;
                        }

                    },
            ],
            [
                'label'=>'手机号',
                'attribute'=>'cellphone',
                'value'=>'member.cellphone'
            ],
            [
                'label'=>'微信昵称',
                'attribute'=>'nickname',
                'value'=>'member.nickname'
            ],
            [
                'label'=>'来源',
                'attribute'=>'agency_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'agency_id',
                    $searchModel->allAgency(),['class' => 'form-control']),
                'value'=>
                    function($model){
//                        return $model->member->agency_id;
                        if(empty($model->member->agency_id)){
                            return '无';
                        }
                        $uu = \app\models\Admin::find()->where(['uid'=>$model->member->agency_id])->asArray()->one();
                       return $uu['username'];
                    },
            ],
            [
                'attribute' => 'height_index',
                'label'=>'身高',
                'headerOptions' => ['style'=>'width:70px'],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'height_index',
                    $searchModel::$index,['class' => 'form-control']),
                'value'=>
                    function($model){
                        $height = \app\models\WapHeight::find()->where(['uid'=>$model->uid])->orderBy(['date' => SORT_DESC])->asArray()->one();
                        return $height['height'];
                    },
            ],

            [
                'attribute' => 'weight_index',
                'label'=>'体重',
                'headerOptions' => ['style'=>'width:70px'],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'weight_index',
                    $searchModel::$index,['class' => 'form-control']),
                'value'=>
                    function($model){
                        $weight = \app\models\WapWeight::find()->where(['uid'=>$model->uid])->orderBy(['date' => SORT_DESC])->asArray()->one();
                        return $weight['weight'];

                    },
            ],
            [
                'attribute' => 'type_0',
                'label'=>'语言',
                'headerOptions' => ['style'=>'width:70px'],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'type_0',
                    $searchModel::$index_type,['class' => 'form-control']),
                'value'=>
                    function($model){
                        if($model->type_0<30){
                            return '弱';
                        }else if($model->type_0<60){
                            return '中';
                        }else{
                            return '强';
                        }
                    },
            ],
            [
                'attribute' => 'type_1',
                'label'=>'人格',
                'headerOptions' => ['style'=>'width:70px'],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'type_1',
                    $searchModel::$index_type,['class' => 'form-control']),
                'value'=>
                    function($model){
                        if($model->type_1<30){
                            return '弱';
                        }else if($model->type_1<60){
                            return '中';
                        }else{
                            return '强';
                        }
                    },
            ],
            [
                'attribute' => 'type_2',
                'label'=>'大动作',
                'headerOptions' => ['style'=>'width:70px'],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'type_2',
                    $searchModel::$index_type,['class' => 'form-control']),
                'value'=>
                    function($model){
                        if($model->type_2<30){
                            return '弱';
                        }else if($model->type_2<60){
                            return '中';
                        }else{
                            return '强';
                        }
                    },
            ],
            [
                'attribute' => 'type_3',
                'label'=>'小动作',
                'headerOptions' => ['style'=>'width:70px'],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'type_3',
                    $searchModel::$index_type,['class' => 'form-control']),
                'value'=>
                    function($model){
                        if($model->type_3<30){
                            return '弱';
                        }else if($model->type_3<60){
                            return '中';
                        }else{
                            return '强';
                        }
                    },
            ],
            [
                'attribute' => 'type_4',
                'label'=>'认知',
                'headerOptions' => ['style'=>'width:70px'],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'type_4',
                    $searchModel::$index_type,['class' => 'form-control']),
                'value'=>
                    function($model){
                        if($model->type_4<30){
                            return '弱';
                        }else if($model->type_4<60){
                            return '中';
                        }else{
                            return '强';
                        }
                    },
            ],
            [
                'attribute' => 'type_5',
                'label'=>'自我帮助',
                'headerOptions' => ['style'=>'width:70px'],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'type_5',
                    $searchModel::$index_type,['class' => 'form-control']),
                'value'=>
                    function($model){
                        if($model->type_5<30){
                            return '弱';
                        }else if($model->type_5<60){
                            return '中';
                        }else{
                            return '强';
                        }
                    },
            ],
            [
                'attribute' => 'buds_index',
                'label'=>'牙齿',
                'headerOptions' => ['style'=>'width:70px'],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'buds_index',
                    $searchModel::$index_buds,['class' => 'form-control']),
                'value'=>
                    function($model){
                        $a = \app\models\WapBuds::find()->where(['uid'=>$model->supervisor_uid])->orderBy(['date' => SORT_ASC])->asArray()->one();
                        return $a['date'];
                    },
            ],


//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
