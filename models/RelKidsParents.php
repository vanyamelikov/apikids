<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rel_kids_parents".
 *
 * @property string $id
 * @property string $id_kids
 * @property string $id_parents
 */
class RelKidsParents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rel_kids_parents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kids', 'id_parents'], 'required'],
            [['id_kids', 'id_parents'], 'integer'],
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
            'id_parents' => 'Id Parents',
        ];
    }
}
