<?php

namespace app\controllers;


use app\models\Users;
use Yii;
use yii\web\ForbiddenHttpException;

class ParentsController extends CController
{
    public $modelClass = 'app\models\Parents';

    public function actionMy()
    {
        $user = Yii::$app->user->identity;

        if ($user->type != Users::TYPE_KIDS)
            throw new ForbiddenHttpException('Вы не ребенок!');

        return $user->profile->parents;
    }
}