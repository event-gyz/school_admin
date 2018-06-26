<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\UsersSearch;

/* @var $this yii\web\View */
/* @var $model app\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search search_content">

    <a href="/site/logout">退出</a>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?php
    $search = new UsersSearch();
    $data = $search->allAgency();
    ?>
    <?php
    if(\Yii::$app->user->identity->type==1) {
    ?>
    <select id="userssearch-agency_id" class="form-control search_type" name="UsersSearch[agency_id]">
        <?php
        if ($data) {
            foreach ( $data as $ckey => $cvalue ) {
                ?>
                <option value="<?php echo $ckey;?>" <?php if(isset($_GET['UsersSearch']['agency_id']) && (int)$_GET['UsersSearch']['agency_id'] == $ckey){echo
                'selected="selected"';}?>><?php echo $cvalue;?></option>
            <?php }}?>
    </select>

    <div class="form-group">
        <?= Html::submitButton('', ['class' => '']) ?>
    </div>
    <?php }?>
    <?php ActiveForm::end(); ?>

</div>
