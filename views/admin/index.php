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
                    'value' => function($model){
                        if(!empty($model['username'])){
                            $url = Yii::$app->params['link']['colavia_url'];
                            return $model['username'];
                        }else{
                            return '';
                        }
                    },
                    'format'=>'raw',
                ],
                [
                    'label'=>'合作类型',
                    'filter'=>false,
                    'value' => function($model){
                        return '巴布豆';
                    },
                    'format'=>'raw',
                ],
                [
                    'label'=>'地区',
                    'filter'=>false,
                    'value' => function($model){
                        return '北京';
                    },
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
                    'template' => '{update} {delete}',
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
                <div class="img_upload">
                    <p>
                        <img class="partner_img" src="" alt="">
                        <img class="defaule_img" src="../images/gogo-star.png" alt="">
                        <input class="upload_file"
                               ref="input"
                               type="file"
                               accept="image/gif,image/jpeg,image/png,image/bmp,image/jpg"
                        >
                    </p>
                    <span>(点击图片，重新上传)</span>
                    <input class="partner_name" type="text" placeholder="名称">
                    <input class="partner_type" type="text" placeholder="合作类型">
                    <input class="partner_address" type="text" placeholder="地区">
                    <button class="partner_manage_sub">提交</button>
                </div>
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
    