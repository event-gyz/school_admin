<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grow_index".
 *
 * @property integer $uid
 * @property integer $stid
 * @property string $type
 * @property string $text
 * @property string $detail
 * @property string $advice
 * @property double $age_min
 * @property double $age_max
 * @property string $image_file
 */
class GrowIndex extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grow_index';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stid', 'type', 'text', 'detail', 'advice', 'age_min', 'age_max', 'image_file'], 'required'],
            [['stid'], 'integer'],
            [['detail', 'advice'], 'string'],
            [['age_min', 'age_max'], 'number'],
            [['type'], 'string', 'max' => 10],
            [['text'], 'string', 'max' => 100],
            [['image_file'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'stid' => 'Stid',
            'type' => 'Type',
            'text' => 'Text',
            'detail' => 'Detail',
            'advice' => 'Advice',
            'age_min' => 'Age Min',
            'age_max' => 'Age Max',
            'image_file' => 'Image File',
        ];
    }
}
