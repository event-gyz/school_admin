<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wap_weight".
 *
 * @property integer $id
 * @property string $date
 * @property string $height
 * @property string $weight
 * @property string $picurl
 * @property integer $uid
 */
class WapWeight extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wap_weight';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid'], 'integer'],
            [['date', 'height', 'weight', 'picurl'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => '精确到月的日期',
            'height' => '身高',
            'weight' => '体重',
            'picurl' => '照片',
            'uid' => '家长ID',
        ];
    }
}
