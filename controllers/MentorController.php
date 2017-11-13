<?php

namespace app\controllers;


use app\models\ReviewMentor;
use yii\data\ActiveDataProvider;

class MentorController extends CController
{
    public $modelClass = 'app\models\Mentor';

    public function actionReview($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ReviewMentor::find()->where(['id_mentor' => $id])
        ]);

        $dataProvider->pagination->pageSize = 10;

        return $dataProvider;
    }
}