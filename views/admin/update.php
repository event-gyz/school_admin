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
    <?php
    if(empty($model->type) || ($model->type == 3)){
    ?>
        <h3>您的推广链接<a target="_blank" href="<?=Yii::$app->params['link']['colavia_url'].'/cn/index.php?id='.$model->uid?>"><?=Yii::$app->params['link']['colavia_url'].'/cn/index.php?id='.$model->uid?></a></h3>
    <?php
    }
    ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
