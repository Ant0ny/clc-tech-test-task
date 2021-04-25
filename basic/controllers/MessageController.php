<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Message;
use yii\web\NotFoundHttpException;

class MessageController extends Controller
{
    public function actionCreate()
    {
        $model = new Message();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->runAction('bot/send-message',['message' => $model->text]);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionView($id)
    {
        $model = Message::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
