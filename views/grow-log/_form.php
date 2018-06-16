<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GrowLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grow-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_uid')->textInput() ?>

    <?= $form->field($model, 'item_uid')->textInput() ?>

    <?= $form->field($model, 'log_time')->textInput() ?>

    <?= $form->field($model, 'early')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
