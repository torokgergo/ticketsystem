<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $priority
 * @property string $status
 * @property int $creator_id
 * @property int $admin_id
 * @property string $creation_date
 * @property string $last_modified
 *
 * @property User $admin
 * @property User $creator
 */
class Ticket extends \yii\db\ActiveRecord
{
    const TYPE_OPENED = 'opened';
    const TYPE_CLOSED = 'closed';

    const TYPE_NORMAL = 'normal';
    const TYPE_URGENT = 'urgent';
    const TYPE_CRITICAL = 'critical';

    const PRIORITY = [
        0 => 'normal',
        1 => 'urgent',
        2 => 'critical',
    ];

    const STATUS = [
        0 => 'opened',
        1 => 'closed'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'priority', 'status', 'creator_id'], 'required'],
            [['content'], 'string'],
            [['creator_id', 'admin_id'], 'integer'],
            [['creation_date', 'last_modified'], 'safe'],
            [['title', 'priority', 'status'], 'string', 'max' => 255],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['admin_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Cím',
            'content' => 'Leírás',
            'priority' => 'Prioritás',
            'status' => 'Státusz',
            'creator_id' => 'Feladó',
            'admin_id' => 'Admin',
            'creation_date' => 'Létrehozva',
            'last_modified' => 'Utoljára módosítva',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(User::className(), ['id' => 'admin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * @inheritdoc
     * @return TicketQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketQuery(get_called_class());
    }
}
