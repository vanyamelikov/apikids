<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $id_profile
 * @property integer $sms_code
 * @property string $login
 * @property string $password
 * @property string $token
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const TYPE_PARENT = 1;
    const TYPE_KIDS = 2;

    static private $_token;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    public function extraFields()
    {
        return ['profile', 'offers', 'notifications'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'id_profile', 'sms_code'], 'integer'],
            [['id_profile', 'sms_code', 'login', 'password', 'token'], 'required'],
            [['login', 'password'], 'string', 'max' => 255],
            [['token'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'id_profile' => 'Id Profile',
            'sms_code' => 'Sms Code',
            'login' => 'Login',
            'password' => 'Password',
            'token' => 'Token',
        ];
    }

    public function getSessDevices()
    {
        return $this->hasMany(SessDevice::className(), ['id_user' => 'id']);
    }

    public function getProfile()
    {
        switch ($this->type)
        {
            case self::TYPE_PARENT:
                $class = Parents::className();
                break;
            case self::TYPE_KIDS:
                $class = Kids::className();
                break;
        }

        return $this->hasOne($class, ['id' => 'id_profile']);
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        static::$_token = $token;

        return Users::find()->joinWith('sessDevices')
            ->where(['sess_device.token' => $token])
            ->andWhere(['sess_device.end_date' => null])
            ->one();
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public function auth($type)
    {
        $sess = new SessDevice([
            'type' => $type,
            'start_date' => time(),
            'id_user' => $this->id,
            'token' => md5($this->login.time())
        ]);

        $sess->save();

        return $sess;
    }

    public function getCurrentDevice()
    {
        return $this->hasOne(SessDevice::className(), ['id_user' => 'id'])->where(['sess_device.token' => static::$_token]);
    }

    public function setRegId($id)
    {
        $device = $this->currentDevice;

        $device->reg_id = $id;
        $device->save();

        return $device;
    }

    public function logout()
    {
        $device = $this->currentDevice;

        $device->end_date = time();
        $device->save();

        return $device;
    }

    public function getOffers()
    {
        return $this->hasMany(Offers::className(), ['id_user' => 'id']);
    }

    public function updateProfile($name, $surname, $father_name, $birthday, $phone, $email)
    {
        $profile = $this->profile;

        $profile->name = $name;
        $profile->surname = $surname;
        $profile->father_name = $father_name;
        $profile->birthday = $birthday;
        $profile->email = $email;

        $profile->save();
    }

    public function getNotifications()
    {
        return $this->hasMany(Notifications::className(), ['id_parent' => 'id']);
    }
}
