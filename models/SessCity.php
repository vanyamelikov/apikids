<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sess_city".
 *
 * @property string $id
 * @property string $id_kids
 * @property string $id_city
 * @property string $input
 * @property string $output
 */
class SessCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sess_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kids', 'id_city', 'input', 'output'], 'required'],
            [['id_kids', 'id_city', 'input', 'output'], 'integer'],
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
            'id_city' => 'Id City',
            'input' => 'Input',
            'output' => 'Output',
        ];
    }
}
