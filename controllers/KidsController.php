<?php

namespace app\controllers;


use app\models\Users;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\ForbiddenHttpException;

class KidsController extends CController
{
    public $modelClass = 'app\models\Kids';

    public function actionMy()
    {
        $user = Yii::$app->user->identity;

        if ($user->type != Users::TYPE_PARENT)
            throw new ForbiddenHttpException('Вы не родитель!');

        return new ArrayDataProvider(['models' => $user->profile->kids]);
    }

    public function actionEvents()
    {
        $user = Yii::$app->user->identity;

        if ($user->type != Users::TYPE_KIDS)
            throw new ForbiddenHttpException('Вы не ребенок!');

        $dataProvider = new ArrayDataProvider([
            'models' => $user->profile->events
        ]);

        $dataProvider->pagination->pageSize = 10;

        return $dataProvider;
    }
}