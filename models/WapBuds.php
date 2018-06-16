<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wap_buds".
 *
 * @property integer $id
 * @property string $buds_type
 * @property string $date
 * @property integer $uid
 */
class WapBuds extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wap_buds';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid'], 'integer'],
            [['buds_type', 'date'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '萌芽id',
            'buds_type' => '萌芽type a b c d e f g h i j k l m n o p q r s t ',
            'date' => '日期 年-月-日',
            'uid' => '父母id',
        ];
    }
}
