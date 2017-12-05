<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review_mentor".
 *
 * @property integer $id
 * @property integer $id_mentor
 * @property integer $id_user
 * @property integer $like
 * @property string $text
 * @property integer $date
 * @property integer $status
 */
class ReviewMentor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review_mentor';
    }

    public function extraFields()
    {
        return ['dateText', 'userName'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mentor', 'id_user', 'text', 'date'], 'required'],
            [['id_mentor', 'id_user', 'like', 'date', 'status'], 'integer'],
            [['text'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_mentor' => 'Id Mentor',
            'id_user' => 'Id User',
            'like' => 'Like',
            'text' => 'Text',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }


    public function getDateText()
    {
        $arr = [
            'Января',
            'Февраля',
            'Марта',
            'Апреля',
            'Мая',
            'Июня',
            'Июля',
            'Августа',
            'Сентября',
            'Октября',
            'Ноября',
            'Декабря'
        ];

        $month = $arr[date("m", $this->date) - 1];

        return date("d $month Y", $this->date);
    }

    public function getUserName()
    {
        $user = $this->user;

        if (!$user)
            return "";

        $profile = $user->profile;
        if (!$profile)
            return "";

        $name = $profile->name;
        $surname = $profile->surname;

        return $name." ".$surname;
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }
}
