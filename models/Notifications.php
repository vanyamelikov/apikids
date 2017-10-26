<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property integer $id
 * @property integer $id_parent
 * @property string $text
 * @property string $send_date
 * @property integer $is_read
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_parent', 'text', 'send_date', 'is_read'], 'required'],
            [['id_parent', 'is_read'], 'integer'],
            [['text'], 'string'],
            [['send_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_parent' => 'Id Parent',
            'text' => 'Text',
            'send_date' => 'Send Date',
            'is_read' => 'Is Read',
        ];
    }
}
