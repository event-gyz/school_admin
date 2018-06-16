<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GrowIndex */

$this->title = Yii::t('app', 'Create Grow Index');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grow Indices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grow-index-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
