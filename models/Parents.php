<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parents".
 *
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property string $father_name
 * @property string $image
 * @property string $birthday
 * @property string $qr
 * @property string $status
 * @property string $date
 * @property string $phone
 * @property string $added_contacts
 * @property string $phone2
 * @property string $sms_code
 * @property string $token
 * @property string $photo
 * @property integer $deleted
 */
class Parents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birthday', 'status', 'date', 'sms_code', 'deleted'], 'integer'],
            [['email', 'password', 'name', 'surname', 'father_name', 'image', 'phone', 'added_contacts', 'phone2', 'photo'], 'string', 'max' => 255],
            [['qr', 'token'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'name' => 'Name',
            'surname' => 'Surname',
            'father_name' => 'Father Name',
            'image' => 'Image',
            'birthday' => 'Birthday',
            'qr' => 'Qr',
            'status' => 'Status',
            'date' => 'Date',
            'phone' => 'Phone',
            'added_contacts' => 'Added Contacts',
            'phone2' => 'Phone2',
            'sms_code' => 'Sms Code',
            'token' => 'Token',
            'photo' => 'Photo',
            'deleted' => 'Deleted',
        ];
    }

    public function getRelKidsParents()
    {
        return $this->hasMany(RelKidsParents::className(), ['id_parents' => 'id']);
    }

    public function getKids()
    {
        return $this->hasMany(Kids::className(), ['id' => 'id_kids'])->via('relKidsParents');
    }
}
