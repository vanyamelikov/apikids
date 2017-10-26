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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mentor', 'id_user', 'like', 'text', 'date', 'status'], 'required'],
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
}
