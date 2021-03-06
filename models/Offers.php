<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "offers".
 *
 * @property integer $id
 * @property integer $id_city
 * @property integer $date
 * @property integer $time
 * @property integer $count_1
 * @property integer $count_2
 * @property integer $count_3
 * @property integer $count_4
 * @property integer $count_5
 * @property integer $count_6
 * @property integer $count_7
 * @property integer $count_8
 * @property integer $count_9
 * @property integer $summ
 * @property string $bankOrderId
 * @property string $bankFormUrl
 * @property integer $id_user
 * @property integer $sendMail
 * @property integer $finish_status
 */
class Offers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offers';
    }

    public function extraFields()
    {
        return ['dateText', 'timeText', 'countParents', 'countKids'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_city', 'date', 'time', 'count_1', 'count_2', 'count_3', 'count_4', 'count_5', 'count_6', 'count_7', 'count_8', 'count_9', 'summ', 'bankOrderId', 'bankFormUrl', 'id_user', 'sendMail', 'finish_status'], 'required'],
            [['id_city', 'date', 'time', 'count_1', 'count_2', 'count_3', 'count_4', 'count_5', 'count_6', 'count_7', 'count_8', 'count_9', 'summ', 'id_user', 'sendMail', 'finish_status'], 'integer'],
            [['bankOrderId'], 'string', 'max' => 255],
            [['bankFormUrl'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_city' => 'Id City',
            'date' => 'Date',
            'time' => 'Time',
            'count_1' => 'Count 1',
            'count_2' => 'Count 2',
            'count_3' => 'Count 3',
            'count_4' => 'Count 4',
            'count_5' => 'Count 5',
            'count_6' => 'Count 6',
            'count_7' => 'Count 7',
            'count_8' => 'Count 8',
            'count_9' => 'Count 9',
            'summ' => 'Summ',
            'bankOrderId' => 'Bank Order ID',
            'bankFormUrl' => 'Bank Form Url',
            'id_user' => 'Id User',
            'sendMail' => 'Send Mail',
            'finish_status' => 'Finish Status',
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

    public function getTimeText()
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

        $month = $arr[date("m", $this->time) - 1];

        return date("d $month Y", $this->time);
    }

    public function getCountParents()
    {
        $count = 0;
        if ($this->count_4 != 0)
            $count += $this->count_4;

        if ($this->count_5 != 0)
         $count += $this->count_5 * 2;

        if ($this->count_6 != 0)
            $count += $this->count_6;

        if ($this->count_8 != 0)
            $count += $this->count_8;

        return $count;
    }

    public function getCountKids()
    {
        $count = 0;

        if ($this->count_1 != 0)
            $count += $this->count_1;

        if ($this->count_2 != 0)
            $count += $this->count_2;

        if ($this->count_5 != 0)
            $count += $this->count_5 * 2;

        if ($this->count_6 != 0)
            $count += $this->count_6;

        if ($this->count_7 != 0)
            $count += $this->count_7;

        if ($this->count_9 != 0)
            $count += $this->count_9;

        return $count;
    }
}
