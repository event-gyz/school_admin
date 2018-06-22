<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form about `app\models\Users`.
 */
class UsersSearch extends Users
{
    public static  $gender = [''=>'全部',0=>'男',1=>'女'];
    public static  $age = [''=>'全部',1=>'0-1',2=>'1-2',3=>'2-3',4=>'3-4',5=>'4-5',6=>'5-6'];
    public static  $index = [''=>'全部',1=>'偏高',2=>'偏低'];
    public static  $index_buds = [''=>'全部',9=>'偏早',11=>'偏晚'];
    public static  $index_type = [''=>'全部',3=>'强',2=>'中' ,1=>'弱'];

    public $city;
    public $province;
    public $cellphone;
    public $agency_id;

    public function allProvince(){
        $re = Member::find()->select(['province'])->distinct()->where(['<>','province',''])->asArray()->all();
        if(!empty($re)){
            $val = array_column($re,'province');
            $allProvince = array_combine($val,$val);
        }
        $allProvince[0] = '全部';
        return array_reverse($allProvince);
    }
    public function allCity($province_name=''){
        if(!empty($province_name)){
            $re = Member::find()->select(['city'])->distinct()->where(['<>','city',''])->andWhere(['province'=>$province_name])->asArray()->all();
        }else{
            $re = Member::find()->select(['city'])->distinct()->where(['<>','city',''])->asArray()->all();
        }
        if(!empty($re)){
            $val = array_column($re,'city');
            $allCity = array_combine($val,$val);
        }
        $allCity[0] = '全部';
        return array_reverse($allCity);
    }
    public function allAgency(){

        if(\Yii::$app->user->identity->type==1) {
            $all = Admin::find()->where(['type'=>3])->asArray()->all();
            $allAgency = array_combine(array_column($all,'uid'),array_column($all,'username'));
            $allAgency[0] = '全部';
        }else{
            $allAgency = [];
        }
        ksort($allAgency);
        return $allAgency;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'gender', 'supervisor_uid', 'buds_index'], 'integer'],
            [['id', 'last_name', 'first_name','city','province', 'agency_id', 'birth_day', 'image_url', 'type_0', 'type_1', 'type_2', 'type_3', 'type_4', 'type_5', 'weight_index', 'height_index','cellphone'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
 * Creates data provider instance with search query applied
 *
 * @param array $params
 *
 * @return ActiveDataProvider
 */
    public function search($params)
    {
        $query = Users::find();
        $query->joinWith(['member']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
//        echo '<pre>';print_r($params);exit;
        $this->load($params);
//        print_r($params);exit;
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'uid' => $this->uid,
            'gender' => $this->gender,
            'supervisor_uid' => $this->supervisor_uid,
            'buds_index' => $this->buds_index,
        ]);

        if(\Yii::$app->user->identity->type==1) {
            if (!empty($this->agency_id)) {
                $query->andFilterWhere(['member.agency_id' => $this->agency_id]);
            }
        }else{
            $query->andFilterWhere(['member.agency_id' => \Yii::$app->user->identity->uid]);
        }


        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'nick_name', $this->nick_name])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like','member.cellphone',$this->cellphone]);
        if(!empty($this->province)){
            $query->andFilterWhere(['like', 'member.province', $this->province]);
        }
        if(!empty($this->city)){
            $query->andFilterWhere(['like', 'member.city', $this->city]);
        }

        if($this->height_index == 1 ){
            $query->andFilterWhere(['>', 'height_index', 110]);
        }else if($this->height_index == 2){
            $query->andFilterWhere(['<', 'height_index', 90]);
        }

        if($this->weight_index == 1 ){
            $query->andFilterWhere(['>', 'weight_index', 110]);
        }else if($this->weight_index == 2){
            $query->andFilterWhere(['<', 'weight_index', 90]);
        }

        if($this->type_0 == 1 ){
            $query->andFilterWhere(['<', 'type_0', 30]);
        }else if($this->type_0 == 2){
            $query->andFilterWhere(['<', 'type_0', 60]);
            $query->andFilterWhere(['>=', 'type_0', 30]);
        }else if($this->type_0 == 3){
            $query->andFilterWhere(['<=', 'type_0', 100]);
            $query->andFilterWhere(['>=', 'type_0', 60]);
        }

        if($this->type_1 == 1 ){
            $query->andFilterWhere(['<', 'type_1', 30]);
        }else if($this->type_1 == 2){
            $query->andFilterWhere(['<', 'type_1', 60]);
            $query->andFilterWhere(['>=', 'type_1', 30]);
        }else if($this->type_1 == 3){
            $query->andFilterWhere(['<=', 'type_1', 100]);
            $query->andFilterWhere(['>=', 'type_1', 60]);
        }

        if($this->type_2 == 1 ){
            $query->andFilterWhere(['<', 'type_2', 30]);
        }else if($this->type_2 == 2){
            $query->andFilterWhere(['<', 'type_2', 60]);
            $query->andFilterWhere(['>=', 'type_2', 30]);
        }else if($this->type_2 == 3){
            $query->andFilterWhere(['<=', 'type_2', 100]);
            $query->andFilterWhere(['>=', 'type_2', 60]);
        }

        if($this->type_3 == 1 ){
            $query->andFilterWhere(['<', 'type_3', 30]);
        }else if($this->type_3 == 2){
            $query->andFilterWhere(['<', 'type_3', 60]);
            $query->andFilterWhere(['>=', 'type_3', 30]);
        }else if($this->type_3 == 3){
            $query->andFilterWhere(['<=', 'type_3', 100]);
            $query->andFilterWhere(['>=', 'type_3', 60]);
        }

        if($this->type_4 == 1 ){
            $query->andFilterWhere(['<', 'type_4', 30]);
        }else if($this->type_4 == 2){
            $query->andFilterWhere(['<', 'type_4', 60]);
            $query->andFilterWhere(['>=', 'type_4', 30]);
        }else if($this->type_4 == 3){
            $query->andFilterWhere(['<=', 'type_4', 100]);
            $query->andFilterWhere(['>=', 'type_4', 60]);
        }

        if($this->type_5 == 1 ){
            $query->andFilterWhere(['<', 'type_5', 30]);
        }else if($this->type_5 == 2){
            $query->andFilterWhere(['<', 'type_5', 60]);
            $query->andFilterWhere(['>=', 'type_5', 30]);
        }else if($this->type_5 == 3){
            $query->andFilterWhere(['<=', 'type_5', 100]);
            $query->andFilterWhere(['>=', 'type_5', 60]);
        }

        if($this->birth_day == 1 ){
            $query->andFilterWhere(['>=', 'birth_day', date('Y-m-d',strtotime("-1 year"))]);
        }else if($this->birth_day == 2){
            $query->andFilterWhere(['<', 'birth_day', date('Y-m-d',strtotime("-1 year"))]);
            $query->andFilterWhere(['>=', 'birth_day', date('Y-m-d',strtotime("-2 year"))]);
        }else if($this->birth_day == 3){
            $query->andFilterWhere(['<', 'birth_day', date('Y-m-d',strtotime("-2 year"))]);
            $query->andFilterWhere(['>=', 'birth_day', date('Y-m-d',strtotime("-3 year"))]);
        }else if($this->birth_day == 4){
            $query->andFilterWhere(['<', 'birth_day', date('Y-m-d',strtotime("-3 year"))]);
            $query->andFilterWhere(['>=', 'birth_day', date('Y-m-d',strtotime("-4 year"))]);
        }else if($this->birth_day == 5){
            $query->andFilterWhere(['<', 'birth_day', date('Y-m-d',strtotime("-4 year"))]);
            $query->andFilterWhere(['>=', 'birth_day', date('Y-m-d',strtotime("-5 year"))]);
        }else if($this->birth_day == 6){
            $query->andFilterWhere(['<', 'birth_day', date('Y-m-d',strtotime("-5 year"))]);
            $query->andFilterWhere(['>=', 'birth_day', date('Y-m-d',strtotime("-6 year"))]);
        }
        return $dataProvider;
//        $sql=$query ->createCommand()->getRawSql();
//        var_dump($sql);die;
    }



    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchExprotData($params)
    {
        $query = Users::find();
        $query->joinWith(['member']);
        $this->load($params);
//        print_r($params);exit;

        // grid filtering conditions
        $query->andFilterWhere([
            'uid' => $this->uid,
            'gender' => $this->gender,
            'supervisor_uid' => $this->supervisor_uid,
            'buds_index' => $this->buds_index,
        ]);

        if(\Yii::$app->user->identity->type==1) {
            if (!empty($this->agency_id)) {
                $query->andFilterWhere(['member.agency_id' => $this->agency_id]);
            }
        }else{
            $query->andFilterWhere(['member.agency_id' => \Yii::$app->user->identity->uid]);
        }


        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'nick_name', $this->nick_name])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like','member.cellphone',$this->cellphone]);
        if(!empty($this->province)){
            $query->andFilterWhere(['like', 'member.province', $this->province]);
        }
        if(!empty($this->city)){
            $query->andFilterWhere(['like', 'member.city', $this->city]);
        }

        if($this->height_index == 1 ){
            $query->andFilterWhere(['>', 'height_index', 110]);
        }else if($this->height_index == 2){
            $query->andFilterWhere(['<', 'height_index', 90]);
        }

        if($this->weight_index == 1 ){
            $query->andFilterWhere(['>', 'weight_index', 110]);
        }else if($this->weight_index == 2){
            $query->andFilterWhere(['<', 'weight_index', 90]);
        }

        if($this->type_0 == 1 ){
            $query->andFilterWhere(['<', 'type_0', 30]);
        }else if($this->type_0 == 2){
            $query->andFilterWhere(['<', 'type_0', 60]);
            $query->andFilterWhere(['>=', 'type_0', 30]);
        }else if($this->type_0 == 3){
            $query->andFilterWhere(['<=', 'type_0', 100]);
            $query->andFilterWhere(['>=', 'type_0', 60]);
        }

        if($this->type_1 == 1 ){
            $query->andFilterWhere(['<', 'type_1', 30]);
        }else if($this->type_1 == 2){
            $query->andFilterWhere(['<', 'type_1', 60]);
            $query->andFilterWhere(['>=', 'type_1', 30]);
        }else if($this->type_1 == 3){
            $query->andFilterWhere(['<=', 'type_1', 100]);
            $query->andFilterWhere(['>=', 'type_1', 60]);
        }

        if($this->type_2 == 1 ){
            $query->andFilterWhere(['<', 'type_2', 30]);
        }else if($this->type_2 == 2){
            $query->andFilterWhere(['<', 'type_2', 60]);
            $query->andFilterWhere(['>=', 'type_2', 30]);
        }else if($this->type_2 == 3){
            $query->andFilterWhere(['<=', 'type_2', 100]);
            $query->andFilterWhere(['>=', 'type_2', 60]);
        }

        if($this->type_3 == 1 ){
            $query->andFilterWhere(['<', 'type_3', 30]);
        }else if($this->type_3 == 2){
            $query->andFilterWhere(['<', 'type_3', 60]);
            $query->andFilterWhere(['>=', 'type_3', 30]);
        }else if($this->type_3 == 3){
            $query->andFilterWhere(['<=', 'type_3', 100]);
            $query->andFilterWhere(['>=', 'type_3', 60]);
        }

        if($this->type_4 == 1 ){
            $query->andFilterWhere(['<', 'type_4', 30]);
        }else if($this->type_4 == 2){
            $query->andFilterWhere(['<', 'type_4', 60]);
            $query->andFilterWhere(['>=', 'type_4', 30]);
        }else if($this->type_4 == 3){
            $query->andFilterWhere(['<=', 'type_4', 100]);
            $query->andFilterWhere(['>=', 'type_4', 60]);
        }

        if($this->type_5 == 1 ){
            $query->andFilterWhere(['<', 'type_5', 30]);
        }else if($this->type_5 == 2){
            $query->andFilterWhere(['<', 'type_5', 60]);
            $query->andFilterWhere(['>=', 'type_5', 30]);
        }else if($this->type_5 == 3){
            $query->andFilterWhere(['<=', 'type_5', 100]);
            $query->andFilterWhere(['>=', 'type_5', 60]);
        }

        if($this->birth_day == 1 ){
            $query->andFilterWhere(['>=', 'birth_day', date('Y-m-d',strtotime("-1 year"))]);
        }else if($this->birth_day == 2){
            $query->andFilterWhere(['<', 'birth_day', date('Y-m-d',strtotime("-1 year"))]);
            $query->andFilterWhere(['>=', 'birth_day', date('Y-m-d',strtotime("-2 year"))]);
        }else if($this->birth_day == 3){
            $query->andFilterWhere(['<', 'birth_day', date('Y-m-d',strtotime("-2 year"))]);
            $query->andFilterWhere(['>=', 'birth_day', date('Y-m-d',strtotime("-3 year"))]);
        }else if($this->birth_day == 4){
            $query->andFilterWhere(['<', 'birth_day', date('Y-m-d',strtotime("-3 year"))]);
            $query->andFilterWhere(['>=', 'birth_day', date('Y-m-d',strtotime("-4 year"))]);
        }else if($this->birth_day == 5){
            $query->andFilterWhere(['<', 'birth_day', date('Y-m-d',strtotime("-4 year"))]);
            $query->andFilterWhere(['>=', 'birth_day', date('Y-m-d',strtotime("-5 year"))]);
        }else if($this->birth_day == 6){
            $query->andFilterWhere(['<', 'birth_day', date('Y-m-d',strtotime("-5 year"))]);
            $query->andFilterWhere(['>=', 'birth_day', date('Y-m-d',strtotime("-6 year"))]);
        }

        return $query->asArray()->all();
//        $sql=$query ->createCommand()->getRawSql();
//        var_dump($sql);die;
    }
}
