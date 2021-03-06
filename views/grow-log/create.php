<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GrowLog */

$this->title = Yii::t('app', 'Create Grow Log');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grow Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grow-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
