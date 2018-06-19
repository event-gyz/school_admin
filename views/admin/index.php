<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '合作商管理';
?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增合作商', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'filter'=>false,
                'attribute' => 'img',
                'value' => function($model){
                    if(!empty($model['img'])){
                        return "<img src='{$model['img']}' style='width:100px;height:80px;'>";
                    }else{
                        return '';
                    }
                },
                'format'=>'raw',
            ],
            'username',
            [
                'label'=>'推广链接',
                'filter'=>false,
                'attribute' => 'id',
                'value' => function($model){
                    if(!empty($model['uid'])){
                        $url = Yii::$app->params['link']['colavia_url'];
                        return "<a target='_blank' href='".$url."/cn/index.php?id=$model->uid'/>".$url."/cn/index.php?id=$model->uid</a>";
                    }else{
                        return '';
                    }
                },
                'format'=>'raw',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'view' => function($url, $model, $key) {
                        return Html::a('查看', $url);
                    },
                    'update' => function($url, $model, $key) {
                        return Html::a('编辑', $url);
                    },
                    'delete' => function($url, $model, $key) {
                        $options = [
                            'data-pjax' => 0,
                            'data-confirm' => '您确定要删除此项吗？',
                            'data-method' => 'post',
                        ];
                        return Html::a('删除', $url, $options);
                    }
                ],
                'headerOptions'=>['class' => 'text-center','style'=>'10%'],
                'header' => Yii::t('app', '操作'),
            ],
        ],
        'layout'=> '{items}<div class="text-center tooltip-demo">{pager}</div>',
        'pager'=>[
            'prevPageLabel'=>'<',
            'nextPageLabel'=>'>',
        ],
    ]); ?>
</div>
