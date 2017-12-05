<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mentor".
 *
 * @property string $id
 * @property string $name
 * @property string $surname
 * @property string $father_name
 * @property string $birthday
 * @property string $image
 * @property string $phone
 * @property string $qr
 * @property string $date
 * @property string $likes
 * @property string $dislikes
 * @property string $description
 * @property string $login
 * @property string $password
 * @property string $token
 * @property string $reg_id
 * @property string $id_city
 * @property string $id_station
 * @property string $deleted
 */
class Mentor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mentor';
    }

    public function extraFields()
    {
        return ['age', 'reviewCount'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'father_name', 'birthday', 'image', 'phone', 'qr', 'date', 'likes', 'dislikes', 'description', 'login', 'password', 'token', 'reg_id', 'id_city', 'id_station', 'deleted'], 'required'],
            [['birthday', 'date', 'likes', 'dislikes', 'id_city', 'id_station', 'deleted'], 'integer'],
            [['image', 'phone', 'description'], 'string'],
            [['name', 'surname', 'father_name', 'login', 'reg_id'], 'string', 'max' => 255],
            [['qr', 'password', 'token'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'father_name' => 'Father Name',
            'birthday' => 'Birthday',
            'image' => 'Image',
            'phone' => 'Phone',
            'qr' => 'Qr',
            'date' => 'Date',
            'likes' => 'Likes',
            'dislikes' => 'Dislikes',
            'description' => 'Description',
            'login' => 'Login',
            'password' => 'Password',
            'token' => 'Token',
            'reg_id' => 'Reg ID',
            'id_city' => 'Id City',
            'id_station' => 'Id Station',
            'deleted' => 'Deleted',
        ];
    }

    public function getReviewMentor()
    {
        return $this->hasMany(ReviewMentor::className(), ['id_mentor' => 'id']);
    }

    public function getReviewCount()
    {
        return $this->hasMany(ReviewMentor::className(), ['id_mentor' => 'id'])->count();
    }

    public function getAge()
    {
        return floor((time()-$this->birthday)/(60*60*24*365));
    }
}
