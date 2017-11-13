<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kids".
 *
 * @property string $id
 * @property string $name
 * @property string $surname
 * @property string $father_name
 * @property string $birthday
 * @property string $qr
 * @property string $id_rank
 * @property string $money
 * @property string $id_station
 * @property string $id_city
 * @property string $date
 * @property string $passport
 * @property string $inCity
 * @property string $photo
 * @property string $isLite
 * @property string $hour_count
 * @property string $deleted
 */
class Kids extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kids';
    }

    public function extraFields()
    {
        return ['stationName', 'age'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birthday', 'id_rank', 'money', 'id_station', 'id_city', 'date', 'passport', 'inCity', 'isLite', 'hour_count', 'deleted'], 'integer'],
            [['name', 'surname', 'father_name', 'photo'], 'string', 'max' => 255],
            [['qr'], 'string', 'max' => 32],
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
            'qr' => 'Qr',
            'id_rank' => 'Id Rank',
            'money' => 'Money',
            'id_station' => 'Id Station',
            'id_city' => 'Id City',
            'date' => 'Date',
            'passport' => 'Passport',
            'inCity' => 'In City',
            'photo' => 'Photo',
            'isLite' => 'Is Lite',
            'hour_count' => 'Hour Count',
            'deleted' => 'Deleted',
        ];
    }

    public function getRelKidsParents()
    {
        return $this->hasMany(RelKidsParents::className(), ['id_kids' => 'id']);
    }

    public function getParents()
    {
        return $this->hasMany(Parents::className(), ['id' => 'id_parents'])->via('relKidsParents');
    }

    public function getSessKids()
    {
        return $this->hasMany(SessKids::className(), ['id_kids' => 'id']);
    }

    public function getSessCity()
    {
        return $this->hasMany(SessCity::className(), ['id_kids' => 'id']);
    }

    public function getStation()
    {
        return $this->hasOne(Stations::className(), ['id' => 'id_station']);
    }

    public function getStationName()
    {
        $station = $this->station;

        if ($station)
            return $station->name;

        if ($this->id_city == 1)
            return "В городе";

        return "Не в городе";
    }

    public function getAge()
    {
        return floor((time()-$this->birthday)/(60*60*24*365));

    }

    public function getEvents()
    {
        $result = [];

        foreach ($this->sessKids as $kid)
        {
            if ($kid->action == 1)
                $action = "Вошёл на станцию";
            else
                $action = "Ушел со станции";

            $action .= " \"".$kid->station->name."\"";

            $result[$kid->date] = [
                'action' => $action,
                'date' => $kid->date,
                'dateText' => date("d.m.Y H:i:s", $kid->date)
            ];
        }

        foreach ($this->sessCity as $city)
        {
            $result[$city->input] = [
                'action' => "Вошел в город",
                'date' => $city->input,
                'dateText' => date("d.m.Y H:i:s", $city->input)
            ];

            $result[$city->output] = [
                'action' => "Вышел из города",
                'date' => $city->output,
                'dateText' => date("d.m.Y H:i:s", $city->output)
            ];
        }

        return $result;
    }
}
