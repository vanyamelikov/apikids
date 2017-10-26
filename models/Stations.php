<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stations".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_description
 * @property string $full_description
 * @property string $next_lesson
 * @property string $image
 * @property integer $id_scenario
 * @property integer $count_kids
 * @property string $hash
 * @property integer $price
 * @property integer $price_increment
 * @property string $id_city
 * @property string $capacity
 * @property string $min_age
 * @property string $status
 * @property integer $deleted
 */
class Stations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'short_description', 'full_description', 'next_lesson', 'image', 'id_scenario', 'count_kids', 'hash', 'price', 'price_increment', 'id_city', 'capacity', 'min_age', 'status', 'deleted'], 'required'],
            [['short_description', 'full_description', 'next_lesson', 'image'], 'string'],
            [['id_scenario', 'count_kids', 'price', 'price_increment', 'id_city', 'capacity', 'min_age', 'status', 'deleted'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['hash'], 'string', 'max' => 32],
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
            'short_description' => 'Short Description',
            'full_description' => 'Full Description',
            'next_lesson' => 'Next Lesson',
            'image' => 'Image',
            'id_scenario' => 'Id Scenario',
            'count_kids' => 'Count Kids',
            'hash' => 'Hash',
            'price' => 'Price',
            'price_increment' => 'Price Increment',
            'id_city' => 'Id City',
            'capacity' => 'Capacity',
            'min_age' => 'Min Age',
            'status' => 'Status',
            'deleted' => 'Deleted',
        ];
    }
}
