<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event_apply".
 *
 * @property integer $user_id
 * @property integer $event_id
 * @property integer $is_paid
 *
 * @property Event $event
 * @property User $user
 */
class EventApply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_apply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'event_id', 'is_paid'], 'integer'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'event_id' => 'Event ID',
            'is_paid' => 'Is Paid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return EventApplyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventApplyQuery(get_called_class());
    }
}
