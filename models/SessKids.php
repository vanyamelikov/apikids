<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sess_kids".
 *
 * @property integer $id
 * @property integer $id_kids
 * @property integer $id_station
 * @property integer $id_mentor
 * @property integer $id_scenario
 * @property integer $action
 * @property integer $date
 */
class SessKids extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sess_kids';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kids', 'id_station', 'id_mentor', 'id_scenario', 'action', 'date'], 'required'],
            [['id_kids', 'id_station', 'id_mentor', 'id_scenario', 'action', 'date'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_kids' => 'Id Kids',
            'id_station' => 'Id Station',
            'id_mentor' => 'Id Mentor',
            'id_scenario' => 'Id Scenario',
            'action' => 'Action',
            'date' => 'Date',
        ];
    }

    public function getStation()
    {
        return $this->hasOne(Stations::className(), ['id' => 'id_station']);
    }
}
