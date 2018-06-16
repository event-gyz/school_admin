<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '数据展示';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Member'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'uid',
            'id',
//            'password',
             'nickname',
             'cellphone',
             'email:email',
            // 'wx_openid',
             'city',
            // 'address',
            // 'credit',
            // 'image_url:url',
            // 'father_image',
            // 'mother_image',
            // 'epaper',
            // 'show_id',
            // 'membership',
//             'share_time',
             'create_time:datetime',
             'agency_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
