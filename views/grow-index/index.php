<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GrowIndexSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Grow Indices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grow-index-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Grow Index'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'uid',
            'stid',
            'type',
            'text',
            'detail:ntext',
            // 'advice:ntext',
            // 'age_min',
            // 'age_max',
            // 'image_file',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
