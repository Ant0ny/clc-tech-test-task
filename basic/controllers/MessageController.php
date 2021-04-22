<?php

namespace app\controllers;

use yii\web\Controller;

class MessageController extends Controller
{
    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
