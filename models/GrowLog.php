<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grow_log".
 *
 * @property integer $uid
 * @property integer $user_uid
 * @property integer $item_uid
 * @property string $log_time
 * @property integer $early
 * @property integer $type
 */
class GrowLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grow_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_uid', 'item_uid', 'early', 'type'], 'required'],
            [['user_uid', 'item_uid', 'early', 'type'], 'integer'],
            [['log_time'], 'safe'],
            [['user_uid', 'item_uid'], 'unique', 'targetAttribute' => ['user_uid', 'item_uid'], 'message' => 'The combination of User Uid and Item Uid has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'user_uid' => 'User Uid',
            'item_uid' => 'Item Uid',
            'log_time' => 'Log Time',
            'early' => 'Early',
            'type' => 'Type',
        ];
    }
}
