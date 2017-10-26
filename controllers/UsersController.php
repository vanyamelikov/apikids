<?php

namespace app\controllers;

use app\models\Users;
use Yii;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class UsersController extends CController
{
    public $modelClass = 'app\models\Users';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['except'] = ['auth'];

        return $behaviors;
    }

    public function actionAuth($login, $password, $type)
    {
        $user = Users::findOne(['login' => $login, 'password' => md5($password)]);

        if (!$user)
            throw new ForbiddenHttpException('login or password incorrect');

        return $user->auth($type);
    }

    public function actionSetRegId($id)
    {
        $user = Yii::$app->user->identity;

        return $user->setRegId($id);
    }

    public function actionLogout()
    {
        $user = Yii::$app->user->identity;

        return $user->logout();
    }

    public function actionOffers()
    {
        return Yii::$app->user->identity->offers;
    }

    public function actionProfile()
    {
        return Yii::$app->user->identity->profile;
    }

    public function actionNotifications()
    {
        return Yii::$app->user->identity->notifications;
    }

    public function actionUpdateProfile($name, $surname, $father_name, $birthday, $phone, $email, $password = false)
    {
        $user = Yii::$app->user->identity;
        $user->updateProfile($name, $surname, $father_name, $birthday, $phone, $email);

        if ($password)
        {
            $user->password = md5($password);
            $user->save();
        }

        return $user->profile;
    }
}