<?php
namespace app\controllers;

use app\models\BDemands;
use app\models\BDemandsNovartis;
use app\models\BRfp;
use app\models\BRfpMap;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RfpRequestForProposal;
use app\models\Order;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength' => 4,
                'maxLength' => 4,
                'height' => 47,
                'width' => 80
            ],
        ];
    }

    public function actionIndex()
    {

        if (\Yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }
        $id = \Yii::$app->user->identity->company_id;

        $rfpModel = new RfpRequestForProposal();

        //酒店数量 及 报价酒店数量
        $_user_id = \Yii::$app->user->identity->user_id;
        //$_user_id = 108;
        $total_meeting = count($this->getValidRfp());
        $mapCountArr = $this->getMapCount($_user_id);
       // echo '<pre>';print_r($mapCountArr);exit;
        $brf_map_count = $mapCountArr['brf_map_count'];
        $brf_map_bj_count = $mapCountArr['brf_demands_count'];
        //获取所有需求数量按meet_typ(1,2,3)分组统计
        $demands_meeting_type_count = $this->getDemandsMeetTypeCount($_user_id);
        //获取诺华需求 按 会议 竞标类型分组
        $demands_bit_type_count = $this->getNovartisBitTypeCount($_user_id);
        //获取诺华总预算费用
        $total_budget = $this->getNovartisTotalBudget($_user_id);
        $son_company = $this->son_company();

        $hotel_use = $this->hotel_use();
        //echo '<pre>';print_r($hotel_use);exit;
        return $this->render('index',[
            'total_meeting'=>$total_meeting,
            'brf_map_count' => $brf_map_count,
            'brf_map_bj_count' => $brf_map_bj_count,
            'total_budget' => $total_budget,
            'demands_meeting_type_count' => $demands_meeting_type_count,
            'demands_bit_type_count' => $demands_bit_type_count,
            'son_company'=>$son_company,
            'hotel_use'=>$hotel_use
        ]);

    }
    public static function randColor(){
        $colors = array();
        for($i = 0;$i<6;$i++){
            $colors[] = dechex(rand(0,15));
        }
        return implode('',$colors);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        //替换布局文件
        $this->layout = false;

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLoginbak()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            echo "<script>window.parent.location.reload()</script>";
            exit;
            //return $this->goHome();
        }

        //替换布局文件
        $this->layout = 'empty';

        return $this->render('login_bak', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        if (isset($_GET['ref']) && $_GET['ref'] == 'gso') {
            setcookie("gso", "", time() - 3600, "/");
            return $this->redirect('/gso/login');
        }
        Yii::$app->user->logout();
        return $this->redirect('/site/login');
    }

    public function actionDemo() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        //替换布局文件
        $this->layout = false;

        return $this->render('demo', [
            'model' => $model,
        ]);
    }

    //语言切换
    public function actionLanguage(){
        $language=  \Yii::$app->request->get('lang');
        if(isset($language)){
            \Yii::$app->session['language']=$language;
        }
        //切换完语言哪来的返回到哪里
        $this->goBack(\Yii::$app->request->headers['Referer']);
    }

    public function hotel_use(){
        $pchRfp = array();
        $npchRfp = array();
        $pch = array();
        $npch = array();

        $cooperative = \yii::$app->params['cooperative'];
        $all_rfp = $this->getValidRfp();
        $rfp_ids = array_column($all_rfp,'id');
        $demands_ids = array_column($all_rfp,'demands_id');

        $all_place = BRfpMap::find()->select(['rfp_id','place_id','demands_id'])->where(['in','rfp_id',$rfp_ids])->asArray()->all();

        $all_demands = BDemands::find()->select(['id','meeting_type'])->where(['id'=>$demands_ids])->asArray()->all();

        $all_demands = array_combine(array_column($all_demands,'id'),array_column($all_demands,'meeting_type'));

        foreach($all_place as $key => $value){
            if(isset($cooperative[$value['place_id']])){
                $pchRfp[$key]['rfp_id'] = $value['rfp_id'];
                $pchRfp[$key]['demands_id'] = $value['demands_id'];
                @$pch[$all_demands[$value['demands_id']]] ++;
            }else{
                $npchRfp[$key]['rfp_id'] = $value['rfp_id'];
                $npchRfp[$key]['demands_id'] = $value['demands_id'];
                @$npch[$all_demands[$value['demands_id']]] ++;
            }
        }
        $result['pchCount'] = count($pchRfp);
        $result['npchCount'] = count($npchRfp);
        $result['pch'] = $pch;
        $result['npch'] = $npch;
        return $result;
    }
    public function son_company(){
        $all_rfp = $this->getValidRfp();
        $demands_ids = array_column($all_rfp,'demands_id');
        $res = BDemandsNovartis::find()->select(['novartis_soncompany','count(id) as count'])->where(['in','demands_id',$demands_ids])->andWhere(['<>','novartis_soncompany',''])->groupBy(['novartis_soncompany'])->asArray()->all();
        foreach($res as &$value){
            $value['total_budget'] = '';
            $total_budget = '';
            $all_total_budget = BDemandsNovartis::find()->select(['total_budget'])->where(['novartis_soncompany'=>$value['novartis_soncompany']])->andWhere(['in','demands_id',$demands_ids])->asArray()->all();
            foreach($all_total_budget as $v){
                $value['total_budget'] += str_replace(array('￥',',',''), '',$v['total_budget']);;

            }

        }
//        echo '<pre>';print_r($res);exit;
        return $res;
    }

    //获取有效询单
    public function getValidRfp(){
        if(\Yii::$app->user->identity->role == 'surperadmin'){
            $rs = BRfp::find()->select('id,demands_id')->where(['in','status',['ing','finish','overtime','stop']])->andWhere(['company_id'=>\Yii::$app->user->identity->company_id])->asArray()->all();
        }else{
            $rs = BRfp::find()->select('id,demands_id')->where(['in','status',['ing','finish','overtime','stop']])->andWhere(['user_id'=>\Yii::$app->user->identity->user_id])->asArray()->all();
        }
        //$rs = BRfp::find()->select('id,demands_id')->where(['and', ['id' => $user_id], ['not in', 'status', ['new','close']]])->asArray()->all();

        return $rs;
    }

    //获取酒店数量 及 报价酒店数量
    public function getMapCount($user_id){
        $data['brf_map_count'] = 0; //酒店数量
        $data['brf_demands_count'] = 0; //酒店报价数量
        $rfps = $this->getValidRfp();
        if($rfps){
            $b_id_arr = array_column($rfps,'id');
            $brf_map_datas = BRfpMap::find()->where(['in', 'rfp_id', $b_id_arr])->asArray()->all();
            foreach($brf_map_datas as $v){
                if(in_array($v['map_status'], array(1,3,4))){
                    $data['brf_demands_count']++;
                }
                $data['brf_map_count']++;
            }
        }
        return $data;
    }

    //获取所有需求数量按meet_typ(1,2,3)分组统计
    public function getDemandsMeetTypeCount($user_id){
        $demands_meeting_type_count = array(
            'internal' => 0,  //内部会议
            'outside'  => 0,  //外部会议
            'plenary'  => 0   //大会
        );
        $rfps = $this->getValidRfp();
        if($rfps){
            $demands_id_arr = array_column($rfps,'demands_id');
            $demands_datas = BDemands::find()->select('id, meeting_type')->where(['in', 'id', $demands_id_arr])->asArray()->all();
            foreach($demands_datas as & $v){
                switch ($v['meeting_type']) {
                    case 1:
                        $demands_meeting_type_count['internal']++;
                        break;
                    case 2:
                        $demands_meeting_type_count['outside']++;
                        break;
                    case 3:
                        $demands_meeting_type_count['plenary']++;
                        break;
                }
            }
        }
        return $demands_meeting_type_count;
    }

    //获取诺华需求 按 会议 竞标类型分组
    public function getNovartisBitTypeCount($user_id){
        $data = array(
            'internal' => array(
                'rfq'     => 0,
                'auction' => 0,
            ),
            'outside' => array(
                'rfq'     => 0,
                'auction' => 0,
            ),
            'plenary' => array(
                'rfq'     => 0,
                'auction' => 0,
            ),
        );
        $rfps = $this->getValidRfp();
        if($rfps){
            $demands_id_arr = array_column($rfps,'demands_id');
            $rs1 = BDemandsNovartis::find()->where(['in', 'demands_id', $demands_id_arr])->asArray()->all();
            if($rs1){
                foreach($rs1 as $v){
                    $demand = BDemands::find()->select('id, meeting_type')->where(['id' => $v['demands_id']])->asArray()->one();
                    if($demand){
                        if($demand['meeting_type'] == '1'){
                            if($v['bit_type'] == 0){
                                $data['internal']['rfq']++;
                            }elseif($v['bit_type'] == 1){
                                $data['internal']['auction']++;
                            }
                        }elseif($demand['meeting_type'] == '2'){
                            if($v['bit_type'] == 0){
                                $data['outside']['rfq']++;
                            }elseif($v['bit_type'] == 1){
                                $data['outside']['auction']++;
                            }
                        }elseif($demand['meeting_type'] == '3'){
                            if($v['bit_type'] == 0){
                                $data['plenary']['rfq']++;
                            }elseif($v['bit_type'] == 1){
                                $data['plenary']['auction']++;
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }

    //获取诺华预算总费用
    public function getNovartisTotalBudget(){
        $total_budget = 0;
        $rfps = $this->getValidRfp();
        if($rfps){
            $demands_id_arr = array_column($rfps,'demands_id');
            $rs = BDemandsNovartis::find()->where(['in', 'demands_id', $demands_id_arr])->asArray()->all();
            foreach($rs as $v){
                $total_budget += str_replace(array('￥',','), '',$v['total_budget']);
            }
        }
        return $total_budget;
    }
    public function actionHelp(){
        return $this->render('help');
    }
}




