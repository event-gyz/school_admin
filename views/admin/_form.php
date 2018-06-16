<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

<!--    --><?php
//    if($model->isNewRecord){
//        echo $form->field($model, 'img')->widget(FileInput::classname(), [
//            'options' => ['multiple' => false],
//            'pluginOptions' => [
//                // 是否显示移除按钮，指input上面的移除按钮，非具体图片上的移除按钮
//                'showRemove' => true,
//                // 是否显示上传按钮，指input上面的上传按钮，非具体图片上的上传按钮
//                'showUpload' => false,
//                //是否显示[选择]按钮,指input上面的[选择]按钮,非具体图片上的上传按钮
//                'showBrowse' => true,
//                // 如果要设置具体图片上的移除、上传和展示按钮，需要设置该选项
//                'fileActionSettings' => [
//                    // 设置具体图片的查看属性为false,默认为true
//                    'showZoom' => false,
//                    // 设置具体图片的上传属性为true,默认为true
//                    'showUpload' => false,
//                    // 设置具体图片的移除属性为true,默认为true
//                    'showRemove' => false,
//                ],
//            ]
//        ]);
//    };
//    ?>
    <?php

    if(!empty($model->img)){
        ?>
        <div class="form-group">
            <label class="control-label">原头像</label>
         <?php
         echo "<img src='{$model->img}' style='width:100px;height:80px;' class=\"form-control\">";
         ?>
        </div>
    <?php
    }
    ?>
    <?php
    echo $form->field($model, 'img')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            // 是否显示移除按钮，指input上面的移除按钮，非具体图片上的移除按钮
            'showRemove' => true,
            // 是否显示上传按钮，指input上面的上传按钮，非具体图片上的上传按钮
            'showUpload' => false,
            //是否显示[选择]按钮,指input上面的[选择]按钮,非具体图片上的上传按钮
            'showBrowse' => true,
            // 如果要设置具体图片上的移除、上传和展示按钮，需要设置该选项
            'fileActionSettings' => [
                // 设置具体图片的查看属性为false,默认为true
                'showZoom' => false,
                // 设置具体图片的上传属性为true,默认为true
                'showUpload' => false,
                // 设置具体图片的移除属性为true,默认为true
                'showRemove' => false,
            ],
        ]
    ] );
    ?>
    <?php if(empty($model->type) || ($model->type == 3)){?>
        <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'type_of_cooperation')->textInput(['maxlength' => true]) ?>
    <?php }?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
