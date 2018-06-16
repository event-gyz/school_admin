<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
if(empty($model->type) || ($model->type == 3)){
    $this->title = '合作商管理';
}else{
    $this->title = '账号管理';
}


?>
<div class="admin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
