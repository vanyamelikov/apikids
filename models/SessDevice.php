<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sess_device".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $token
 * @property integer $start_date
 * @property integer $end_date
 * @property integer $type
 * @property string $reg_id
 */
class SessDevice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sess_device';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'start_date', 'end_date', 'type'], 'integer'],
            [['token', 'reg_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'token' => 'Token',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'type' => 'Type',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }
}
