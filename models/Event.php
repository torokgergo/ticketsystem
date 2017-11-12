<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $event_name
 * @property string $description
 * @property string $event_date
 *
 * @property EventApply[] $eventApplies
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_name'], 'required'],
            [['description'], 'string'],
            [['event_date'], 'safe'],
            [['event_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_name' => 'Event Name',
            'description' => 'Description',
            'event_date' => 'Event Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventApplies()
    {
        return $this->hasMany(EventApply::className(), ['event_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventQuery(get_called_class());
    }
}
