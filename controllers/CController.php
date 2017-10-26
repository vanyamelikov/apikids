<?php
/**
 * Created by PhpStorm.
 * User: alexe
 * Date: 25.10.2017
 * Time: 16:45
 */

namespace app\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\Response;

class CController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        $behaviors['authenticator']['class'] = QueryParamAuth::className();
        $behaviors['authenticator']['tokenParam'] = 'token';
        return $behaviors;
    }
}