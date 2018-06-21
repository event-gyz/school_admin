<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '数据列表';
?>
<ul class="data_active">
    <li class="data_total">
        <div class="data_size">
            <p>数据总量</p>
            <b>7800</b>
        </div>
        <div class="activity">
            <span>活跃度</span>
            <p class="data_total_chart"></p>
            <span>76%</span>
        </div>
    </li>
    <li class="new_membership_volume">
        <div class="data_size">
            <p>新增会员量</p>
            <b>567</b>
        </div>
        <div class="activity">
            <span>活跃度</span>
            <p class="new_membership_volume_chart"></p>
            <span>45%</span>
        </div>
    </li>
    <li class="average_activity">
        <div class="data_size">
            <p>平均活跃度</p>
            <b>276</b>
        </div>
        <div class="activity">
            <span>活跃度</span>
            <p class="average_activity_chart"></p>
            <span>57%</span>
        </div>
    </li>
</ul>
<div class="data_content">
    <section id="content" style="width:100%;height:100%">
        <section class="vbox">

            <section class="scrollable padder" id="scrollable">
                <div class="users-index" style="width: 100%;  overflow-x: scroll; overflow-y: hidden;white-space: nowrap; ">

                    <div class="data_search">
                        <button>PDF</button>
                        <button>打印</button>
                        <p>
                            <input class="search_key" type="text">
                            <i></i>
                        </p>
                        <span><?= Html::encode($this->title) ?></span>
                    </div>
                    <!-- <div class="data_list">
                        <ol>
                            <li>
                                <ul>
                                    <li>宝贝</li>
                                    <li>
                                        <p><input type="text" value="省"><i></i></p>
                                        <div class="province_list">
                                            <p class="active">全部</p>
                                        </div>
                                    </li>
                                    <li>
                                        <p><input type="text" value="市"><i></i></p>
                                        <div class="city_list">
                                            <p class="active">全部</p>
                                        </div>
                                    </li>
                                    <li>
                                        <p><input type="text" value="年龄"><i></i></p>
                                        <div class="old_list">
                                            <p class="active">全部</p>
                                            <p>1-2</p>
                                            <p>2-3</p>
                                            <p>3-4</p>
                                            <p>4-5</p>
                                            <p>5-6</p>
                                        </div>
                                    </li>
                                    <li>
                                        <p><input type="text" value="性别"><i></i></p>
                                        <div class="gender_type">
                                            <p class="active">全部</p>
                                            <p>男</p>
                                            <p>女</p>
                                        </div>
                                    </li>
                                    <li>电话</li>
                                    <li>微信号</li>
                                    <li>
                                        <p><input type="text" value="来源"><i></i></p>
                                        <div class="source_type">
                                            <p class="active">全部</p>
                                            <p>巴布豆</p>
                                            <p>宝贝星球</p>
                                            <p>雀巢</p>
                                        </div>
                                    </li>
                                    <li>
                                        <p><input type="text" value="身高"><i></i></p>
                                        <div class="height_type">
                                            <p class="active">全部</p>
                                            <p>偏高</p>
                                            <p>偏低</p>
                                        </div>
                                    </li>
                                    <li>
                                        <p><input type="text" value="体重"><i></i></p>
                                        <div class="weight_type">
                                            <p class="active">全部</p>
                                            <p>偏高</p>
                                            <p>偏低</p>
                                        </div>
                                    </li>
                                    <li>
                                        <p><input type="text" value="语言"><i></i></p>
                                        <div class="language_ability">
                                            <p class="active">全部</p>
                                            <p>强</p>
                                            <p>中</p>
                                            <p>弱</p>
                                        </div>
                                    </li>
                                    <li>
                                        <p><input type="text" value="人格"><i></i></p>
                                        <div class="personality_ability">
                                            <p class="active">全部</p>
                                            <p>强</p>
                                            <p>中</p>
                                            <p>弱</p>
                                        </div>
                                    </li>
                                    <li>
                                        <p><input type="text" value="大动作"><i></i></p>
                                        <div class="big_action_ability">
                                            <p class="active">全部</p>
                                            <p>强</p>
                                            <p>中</p>
                                            <p>弱</p>
                                        </div>
                                    </li>
                                    <li>
                                        <p><input type="text" value="小动作"><i></i></p>
                                        <div class="small_action_ability">
                                            <p class="active">全部</p>
                                            <p>强</p>
                                            <p>中</p>
                                            <p>弱</p>
                                        </div>
                                    </li>
                                    <li>
                                        <p><input type="text" value="认知"><i></i></p>
                                        <div class="cognitive_ability">
                                            <p class="active">全部</p>
                                            <p>强</p>
                                            <p>中</p>
                                            <p>弱</p>
                                        </div>
                                    </li>
                                    <li>
                                        <p><input type="text" value="自我帮助"><i></i></p>
                                        <div class="self_help_ability">
                                            <p class="active">全部</p>
                                            <p>强</p>
                                            <p>中</p>
                                            <p>弱</p>
                                        </div>
                                    </li>
                                    <li>
                                        <p><input type="text" value="牙齿"><i></i></p>
                                        <div class="tooth_situation">
                                            <p class="active">全部</p>
                                            <p>偏早</p>
                                            <p>偏晚</p>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li>光头强</li>
                                    <li>北京</li>
                                    <li>是</li>
                                    <li>5</li>
                                    <li>男</li>
                                    <li>13000000000</li>
                                    <li>fdfdf</li>
                                    <li>巴布豆</li>
                                    <li>偏高</li>
                                    <li>偏低</li>
                                    <li>中</li>
                                    <li>中</li>
                                    <li>强</li>
                                    <li>弱</li>
                                    <li>中</li>
                                    <li>弱</li>
                                    <li>偏早</li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li>光头强</li>
                                    <li>北京</li>
                                    <li>是</li>
                                    <li>5</li>
                                    <li>男</li>
                                    <li>13000000000</li>
                                    <li>fdfdf</li>
                                    <li>巴布豆</li>
                                    <li>偏高</li>
                                    <li>偏低</li>
                                    <li>中</li>
                                    <li>中</li>
                                    <li>强</li>
                                    <li>弱</li>
                                    <li>中</li>
                                    <li>弱</li>
                                    <li>偏早</li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li>光头强</li>
                                    <li>北京</li>
                                    <li>是</li>
                                    <li>5</li>
                                    <li>男</li>
                                    <li>13000000000</li>
                                    <li>fdfdf</li>
                                    <li>巴布豆</li>
                                    <li>偏高</li>
                                    <li>偏低</li>
                                    <li>中</li>
                                    <li>中</li>
                                    <li>强</li>
                                    <li>弱</li>
                                    <li>中</li>
                                    <li>弱</li>
                                    <li>偏早</li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li>光头强</li>
                                    <li>北京</li>
                                    <li>是</li>
                                    <li>5</li>
                                    <li>男</li>
                                    <li>13000000000</li>
                                    <li>fdfdf</li>
                                    <li>巴布豆</li>
                                    <li>偏高</li>
                                    <li>偏低</li>
                                    <li>中</li>
                                    <li>中</li>
                                    <li>强</li>
                                    <li>弱</li>
                                    <li>中</li>
                                    <li>弱</li>
                                    <li>偏早</li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li>光头强</li>
                                    <li>北京</li>
                                    <li>是</li>
                                    <li>5</li>
                                    <li>男</li>
                                    <li>13000000000</li>
                                    <li>fdfdf</li>
                                    <li>巴布豆</li>
                                    <li>偏高</li>
                                    <li>偏低</li>
                                    <li>中</li>
                                    <li>中</li>
                                    <li>强</li>
                                    <li>弱</li>
                                    <li>中</li>
                                    <li>弱</li>
                                    <li>偏早</li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                    <div class="page_size">
                        <p>
                            <span>共200条记录</span>
                            <span>共40页</span>
                            <span>每页</span>
                            <select name="" id="">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5" selected>5</option>
                            </select>
                            <span>条记录</span>
                            <span>当前1/1页</span>
                        </p>
                        <div class="paging">
                            <a href="#" class="first">首页</a>
                            <a href="#" class="prev">上一页</a>
                            <a href="#" class="next">下一页</a>
                            <a href="#" class="last">尾页</a>
                        </div>
                        <p>
                            <span>转到</span>
                            <select name="" id="">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <span>页</span>
                        </p>
                    </div> -->
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                //            ['class' => 'yii\grid\SerialColumn'],
                //            'uid',
                            'nick_name',
                            [
                                'label'=>'城市',
                                'attribute'=>'city',
                                'value'=>'member.city'
                            ],
                            [
                                'attribute' => 'age',
                                'label'=>'年龄',
                                'headerOptions' => ['style'=>'width:70px'],
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'birth_day',
                                    $searchModel::$age,['class' => 'form-control']),
                                'value'=>
                                    function($model){
                                        $birthday = new \DateTime($model->birth_day);
                                        $diff = $birthday->diff(new \DateTime());
                                        $months = $diff->format('%m') + 12 * $diff->format('%y');
                                        return sprintf("%.1f",substr(sprintf("%.3f", $months/12), 0, -2));
                                    },
                            ],
                            [
                                'attribute' => 'gender',
                                'label'=>'性别',
                                'headerOptions' => ['style'=>'width:70px'],
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'gender',
                                    $searchModel::$gender,['class' => 'form-control']),
                                'value'=>
                                    function($model){
                                        switch ($model->gender){
                                            case 0:
                                                return '男';
                                                break;
                                            case 1:
                                                return '女';
                                                break;
                                        }

                                    },
                            ],
                            [
                                'label'=>'手机号',
                                'attribute'=>'cellphone',
                                'value'=>'member.cellphone'
                            ],
                            [
                                'label'=>'微信昵称',
                                'attribute'=>'nickname',
                                'value'=>'member.nickname'
                            ],
                            [
                                'label'=>'来源',
                                'attribute'=>'agency_id',
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'agency_id',
                                    $searchModel->allAgency(),['class' => 'form-control']),
                                'value'=>
                                    function($model){
                //                        return $model->member->agency_id;
                                        if(empty($model->member->agency_id)){
                                            return '无';
                                        }
                                        $uu = \app\models\Admin::find()->where(['uid'=>$model->member->agency_id])->asArray()->one();
                                       return $uu['username'];
                                    },
                            ],
                            [
                                'attribute' => 'height_index',
                                'label'=>'身高',
                                'headerOptions' => ['style'=>'width:70px'],
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'height_index',
                                    $searchModel::$index,['class' => 'form-control']),
                                'value'=>
                                    function($model){
                                        $height = \app\models\WapHeight::find()->where(['uid'=>$model->uid])->orderBy(['date' => SORT_DESC])->asArray()->one();
                                        return $height['height'];
                                    },
                            ],

                            [
                                'attribute' => 'weight_index',
                                'label'=>'体重',
                                'headerOptions' => ['style'=>'width:70px'],
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'weight_index',
                                    $searchModel::$index,['class' => 'form-control']),
                                'value'=>
                                    function($model){
                                        $weight = \app\models\WapWeight::find()->where(['uid'=>$model->uid])->orderBy(['date' => SORT_DESC])->asArray()->one();
                                        return $weight['weight'];

                                    },
                            ],
                            [
                                'attribute' => 'type_0',
                                'label'=>'语言',
                                'headerOptions' => ['style'=>'width:70px'],
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'type_0',
                                    $searchModel::$index_type,['class' => 'form-control']),
                                'value'=>
                                    function($model){
                                        if($model->type_0<30){
                                            return '弱';
                                        }else if($model->type_0<60){
                                            return '中';
                                        }else{
                                            return '强';
                                        }
                                    },
                            ],
                            [
                                'attribute' => 'type_1',
                                'label'=>'人格',
                                'headerOptions' => ['style'=>'width:70px'],
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'type_1',
                                    $searchModel::$index_type,['class' => 'form-control']),
                                'value'=>
                                    function($model){
                                        if($model->type_1<30){
                                            return '弱';
                                        }else if($model->type_1<60){
                                            return '中';
                                        }else{
                                            return '强';
                                        }
                                    },
                            ],
                            [
                                'attribute' => 'type_2',
                                'label'=>'大动作',
                                'headerOptions' => ['style'=>'width:70px'],
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'type_2',
                                    $searchModel::$index_type,['class' => 'form-control']),
                                'value'=>
                                    function($model){
                                        if($model->type_2<30){
                                            return '弱';
                                        }else if($model->type_2<60){
                                            return '中';
                                        }else{
                                            return '强';
                                        }
                                    },
                            ],
                            [
                                'attribute' => 'type_3',
                                'label'=>'小动作',
                                'headerOptions' => ['style'=>'width:70px'],
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'type_3',
                                    $searchModel::$index_type,['class' => 'form-control']),
                                'value'=>
                                    function($model){
                                        if($model->type_3<30){
                                            return '弱';
                                        }else if($model->type_3<60){
                                            return '中';
                                        }else{
                                            return '强';
                                        }
                                    },
                            ],
                            [
                                'attribute' => 'type_4',
                                'label'=>'认知',
                                'headerOptions' => ['style'=>'width:70px'],
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'type_4',
                                    $searchModel::$index_type,['class' => 'form-control']),
                                'value'=>
                                    function($model){
                                        if($model->type_4<30){
                                            return '弱';
                                        }else if($model->type_4<60){
                                            return '中';
                                        }else{
                                            return '强';
                                        }
                                    },
                            ],
                            [
                                'attribute' => 'type_5',
                                'label'=>'自我帮助',
                                'headerOptions' => ['style'=>'width:70px'],
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'type_5',
                                    $searchModel::$index_type,['class' => 'form-control']),
                                'value'=>
                                    function($model){
                                        if($model->type_5<30){
                                            return '弱';
                                        }else if($model->type_5<60){
                                            return '中';
                                        }else{
                                            return '强';
                                        }
                                    },
                            ],
                            [
                                'attribute' => 'buds_index',
                                'label'=>'牙齿',
                                'headerOptions' => ['style'=>'width:70px'],
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'buds_index',
                                    $searchModel::$index_buds,['class' => 'form-control']),
                                'value'=>
                                    function($model){
                                        $a = \app\models\WapBuds::find()->where(['uid'=>$model->supervisor_uid])->orderBy(['date' => SORT_ASC])->asArray()->one();
                                        return $a['date'];
                                    },
                            ],


                //            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </section>
        </section>
    </section>

    <?php $this->endBody() ?>
</div>
<script>
    svgView('.data_total_chart', 76)
    svgView('.new_membership_volume_chart', 45)
    svgView('.average_activity_chart', 57)
    $(function(){
        var html = '<p class="active">全部</p>';
        for(var i = 0; i < provinceList.length; i++){
            html += '<p data-index=' + i + '>'+ provinceList[i] +'</p>'
        }
        $('.province_list').html(html)
    })

    $('.province_list').on('click','p',function(){
        var index = $(this).attr('data-index')
        var html = '<p class="active">全部</p>';
        for(var i = 0; i < cityList[index].length; i++){
            html += '<p>'+ cityList[index][i] +'</p>'
        }
        $('.city_list').html(html)
    })

    $('.data_list').on('click','li>p',function(){
        $(this).parent('li').siblings('li').children('div').slideUp()
        $(this).siblings('div').slideToggle()
    })

    $('.data_list').on('click','li>div>p',function(){
        $(this).addClass('active').siblings('.active').removeClass('active')
        $(this).parent().slideToggle()
        var queryStr = $(this).html()
    })
</script>