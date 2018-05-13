<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $role
 * @property string $registration_date
 * @property string $last_login_date
 *
 * @property Ticket[] $tickets
 * @property Ticket[] $tickets0
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['role'], 'integer'],
            [['registration_date', 'last_login_date'], 'safe'],
            [['name', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Név',
            'email' => 'E-mail cím',
            'password' => 'Password',
            'role' => 'Role',
            'registration_date' => 'Regisztráció',
            'last_login_date' => 'Utolsó belépés',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['admin_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets0()
    {
        return $this->hasMany(Ticket::className(), ['creator_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function isUserAdmin($email)
    {
        if (static::findOne(['email' => $email, 'role' => self::ROLE_ADMIN])) {
            return true;
        } else {
            return false;
        }
    }
}
