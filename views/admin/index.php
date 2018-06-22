<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '合作商管理';
?>
<div class="admin-index">
    <div class="partner_manage">
        <p>
            <span><?= Html::encode($this->title) ?></span>
            <a class="add_partner" href="javascript:void(0)">添加</a>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'columns' => [
                [
                    'filter'=>false,
                    "label" => "",
                    'attribute' => 'img',
                    'value' => function($model){
                        if(!empty($model['img'])){
                            return "<p><img src='{$model['img']}'></p>";
                        }else{
                            return '';
                        }
                    },
                    'format'=>'raw',
                ],
                [
                    'label'=>'名称',
                    'filter'=>false,
                    'attribute' => 'username',
                    'format'=>'raw',
                ],
                [
                    'label'=>'合作类型',
                    'filter'=>false,
                    'attribute' => 'type_of_cooperation',
                    'format'=>'raw',
                ],
                [
                    'label'=>'地区',
                    'filter'=>false,
                    'attribute' => 'area',

                    'format'=>'raw',
                ],
                [
                    'label'=>'网址',
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
                    'template' => '{update}',
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
                    'header' => Yii::t('app', ''),
                ],
            ],
            'layout'=> '{items}<div class="text-center tooltip-demo">{pager}</div>',
            'pager'=>[
                'prevPageLabel'=>'<',
                'nextPageLabel'=>'>',
            ]
        ]); ?>
        <div class="mask"></div>
        <div class="add_partner_manage">
            <p>添加合作商</p>
            <div class="partner_manage_form">
                <form action="/admin/add" method="post" enctype="multipart/form-data">
                    <div class="img_upload">
                        <p>
                            <?php
                            if(empty($model->img)){
                            ?>
                            <img class="defaule_img" src="../images/gogo-star.png" alt="">
                            <?php
                            }else{
                            ?>
                            <img class="partner_img" src="<?= $model->img?>" alt="">
                            <?php
                            }
                            ?>
                            <input class="upload_file"
                                   ref="input"
                                   type="file"
                                   name="file"
                                   accept="image/gif,image/jpeg,image/png,image/bmp,image/jpg"
                            >
                        </p>
                        <span>(点击图片，重新上传)</span>
                    </div>
                    <input class="partner_name" type="text" name="username" placeholder="名称">
                    <input class="partner_name" type="password" name="password" placeholder="登录密码">
                    <input class="partner_type" type="text" name="type_of_cooperation" placeholder="合作类型">
                    <input class="partner_address" type="text" name="area" placeholder="地区">
                    <button class="partner_manage_sub">提交</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.add_partner').click(function(){
        $('.mask').fadeIn()
        $('.add_partner_manage').fadeIn()
    })

    $('.mask').click(function(){
        $(this).fadeOut()
        $('.add_partner_manage').fadeOut()
    })
</script>
    