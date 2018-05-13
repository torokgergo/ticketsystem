<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $author_id
 * @property int $ticket_id
 * @property string $content
 * @property string $creation_date
 *
 * @property User $author
 * @property Ticket $ticket
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'ticket_id'], 'required'],
            [['author_id', 'ticket_id'], 'integer'],
            [['content'], 'string'],
            [['creation_date'], 'safe'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::className(), 'targetAttribute' => ['ticket_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'ticket_id' => 'Ticket ID',
            'content' => 'Üzenet',
            'creation_date' => 'Creation Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }

    /**
     * @inheritdoc
     * @return MessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessageQuery(get_called_class());
    }
}
