<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActionLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '统计报表');

?>
<style type="text/css" media="screen">
    .card-basic{
        border-right: 1px solid #ccc;
        margin: 20px 0 20px;
        overflow: hidden;
        padding: 5px 10px;
    }
    .card-basic .h2{
        font-family: inherit !important;
    }
    .card-basic.bn{
        border-right-width: 0;
    }
</style>
    <div class="dashboard">
        <div class="row">
            <div class="col-lg-3">
                <div class="card-basic">
                    <div class="h2 text-center"><?=$total_meeting?></div>
                    <div class="text-muted text-center m-t-xs">会议举办数量</div>
                </div>
            </div>
            <!--/.col-->
            <div class="col-lg-3">
                <div class="card-basic">
                    <div class="h2 text-center"><?=$brf_map_count;?></div>
                    <div class="text-muted text-center m-t-xs">询价酒店数量</div>
                </div>
            </div>
            <!--/.col-->
            <div class="col-lg-3">
                <div class="card-basic">
                    <div class="h2 text-center"><?=$brf_map_bj_count;?></div>
                    <div class="text-muted text-center m-t-xs">酒店报价数量</div>
                </div>
            </div>
            <!--/.col-->
            <div class="col-lg-3">
                <div class="card-basic bn">
                    <div class="h2 text-center">¥
                        <?=!empty($total_budget)?number_format($total_budget):'';?></div>
                    <div class="text-muted text-center m-t-xs">总预算费用</div>
                </div>
            </div>
            <!--/.col-->
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">会议类型</div>
                    <div class="panel-body">
                        <div id="meeting-type" style="width: 100%;min-height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">子公司举办会议统计</div>
                    <div class="panel-body">
                        <div id="branch-office" style="width: 100%;min-height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">酒店使用统计</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div id="hotel-total" style="width: 100%;min-height: 400px;"></div>
                            </div>
                            <div class="col-lg-6">
                                <div id="hotel" style="width: 100%;min-height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/js/echarts.common.min.js"></script>
    <script type="text/javascript">
    // 会议类型
    var colors = ['#5793f3', '#d14a61', '#675bba'];
    var meetingArr = [{'RFQ':<?=$demands_bit_type_count['internal']['rfq'];?>,
                       'AUCTION':<?=$demands_bit_type_count['internal']['auction'];?>},
                        {'RFQ':<?=$demands_bit_type_count['outside']['rfq'];?>,
                        'AUCTION':<?=$demands_bit_type_count['outside']['auction'];?>},
                        {'RFQ':<?=$demands_bit_type_count['plenary']['rfq'];?>,
                        'AUCTION':<?=$demands_bit_type_count['plenary']['auction'];?>}]  //会类型分类
    var branchOfficeArr = [
       // '76','25','155','56','34','90',
        <?php foreach($son_company as $value){
        $total_budget = number_format($value['total_budget']);
        echo "'{$total_budget}',";
        unset($total_budget);
    }?>
    ]  //会议总预算金额
    var meetingType = echarts.init(document.getElementById('meeting-type'));
    var meetingTypeOption = {
        backgroundColor: '#fff',
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)",
        },
        legend: {
            orient: 'vertical',
            x: 'left',
            itemWidth: 14,
            itemHeight: 14,
            align: 'left',
            data: ['内部会议', '外部会议','大会'],
            textStyle: {
                color: '#666'
            }
        },
        series: [{
            name: '会议类型',
            type: 'pie',
            radius: ['42%', '55%'],
            color: ['#0090c5', '#4cb6cb','#fad733'],
            itemStyle: {
                normal: {
                    label:{ 
                        show: true, 
                        formatter: function(val){
                            console.log(val)
                            return 'RFQ：'+ meetingArr[val.dataIndex]['RFQ'] + '\n' + 'AUCTION：'+ meetingArr[val.dataIndex]['AUCTION']
                        }
                    }
                },
                labelLine :{show:true}
            },
            data: [{
                value: <?=$demands_meeting_type_count['internal'];?>,
                name: '内部会议'
            }, {
                value: <?=$demands_meeting_type_count['outside'];?>,
                name: '外部会议'
            }, {
                value: <?=$demands_meeting_type_count['plenary'];?>,
                name: '大会'
            }]
        }]
    };
    meetingType.setOption(meetingTypeOption)
        //分公司
    var BranchOffice = echarts.init(document.getElementById('branch-office'));
    var BranchOfficeOption = {
        title : {
        subtext: '以举办会议数量为基准统计',
        x:'center'
        },
        backgroundColor: '#fff',
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)",
        },
        legend: {
            orient: 'vertical',
            x: 'left',
            itemWidth: 14,
            itemHeight: 14,
            align: 'left',
            data: [
                <?php
                $str = '';
                foreach($son_company as $value){
               // '苏州诺华', '爱尔康', '山德士', '北京诺华', '诺华(中国)', '上海诺华'
                $str .= "'".mb_substr($value['novartis_soncompany'],0,5,'utf-8')."...',";
                    //$str .= "'".$value['novartis_soncompany']."',";
            }
            echo rtrim($str,',');
            ?>
                //'苏州诺华', '爱尔康', '山德士', '北京诺华', '诺华(中国)', '上海诺华'
            ],
            textStyle: {
                color: '#666'
            }
        },
        series: [{
            name: '子公司',
            type: 'pie',
            radius: ['42%', '55%'],
            color: ['#e94043', '#e87d3d', '#f1a109', '#a5a814', '#7bad5b', '#7eacad', '#52b4d5', '#5fc7ff'],
            itemStyle: {
                normal: {
                    label:{ 
                        show: true, 
                        formatter: function(val){
                            console.log(val)
                            return '会议数量：'+val.value + '\n' + '总预算金额：'+ branchOfficeArr[val.dataIndex]
                        }
                    }
                },
                labelLine :{show:true}
            },
            data: [
                <?php foreach($son_company as $value){
                    $son_company_name = mb_substr($value['novartis_soncompany'],0,5,'utf-8')."...";
                echo "{value: {$value['count']}, name: '{$son_company_name}'}, ";

            }?>
            ]
        }]
    };
    BranchOffice.setOption(BranchOfficeOption)
        //酒店使用统计
    var hotel = echarts.init(document.getElementById('hotel'));
    var hotelOption = {
        tooltip: {
            trigger: 'axis',
            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        legend: {
            data: ['内部会议', '外部会议', '大会'],
            align: 'right',
            right: 10
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [{
            type: 'category',
            data: ['PCH酒店', '系统酒店']
        }],
        yAxis: [{
            type: 'value',
            name: '次数',
            axisLabel: {
                formatter: '{value}'
            }
        }],
        series: [{
            name: '内部会议',
            type: 'bar',
            barWidth: '30',
            data: [<?= !empty($hotel_use['pch'][1])?$hotel_use['pch'][1]:0;?>, <?= !empty($hotel_use['npch'][1])?$hotel_use['npch'][1]:0;?>],
            color: ['#0092ca']
        }, {
            name: '外部会议',
            type: 'bar',
            barWidth: '30',
            data: [<?= !empty($hotel_use['pch'][2])?$hotel_use['pch'][2]:0;?>, <?= !empty($hotel_use['npch'][2])?$hotel_use['npch'][2]:0;?>],
            color: ['#00b8ce']
        }, {
            name: '大会',
            type: 'bar',
            barWidth: '30',
            data: [<?= !empty($hotel_use['pch'][3])?$hotel_use['pch'][3]:0;?>, <?= !empty($hotel_use['npch'][3])?$hotel_use['npch'][3]:0;?>],
            color: ['#fad733']
        }]
    };
    hotel.setOption(hotelOption)

    // 
    var hotelTotalType = echarts.init(document.getElementById('hotel-total'));
    var hotelTotalTypeOption = {
        backgroundColor: '#fff',
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)",
        },
        legend: {
            orient: 'vertical',
            x: 'left',
            itemWidth: 14,
            itemHeight: 14,
            align: 'left',
            data: ['PCH酒店', '系统酒店'],
            formatter: function(name) {
                return name;
            },
            textStyle: {
                color: '#666'
            }
        },
        series: [{
            name: '总计数量',
            type: 'pie',
            radius: ['42%', '55%'],
            color: ['#5fc7ff','#52b4d5' ],
            itemStyle: {
                normal: {
                    label:{ 
                        show: true, 
                        formatter:'{b} : {c}\n({d}%)'
                    }
                },
                labelLine :{show:true}
            },
            data: [{
                value: <?= !empty($hotel_use['pchCount'])?$hotel_use['pchCount']:'';?>,
                name: 'PCH酒店'
            }, {
                value: <?= !empty($hotel_use['npchCount'])?$hotel_use['npchCount']:'';?>,
                name: '系统酒店'
            }]
        }]
    };
    hotelTotalType.setOption(hotelTotalTypeOption)
    </script>
