<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Message;
use yii\web\NotFoundHttpException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramException;

class BotController extends Controller
{
    protected $conf;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->conf = Yii::$app->params;
    }

    public function actionSendMessage($message)
    {
        try
        {
            $telegram = new Telegram($this->conf['api_key'], $this->conf['bot_username']);
            Request::initialize($telegram);

            $telegram->useGetUpdatesWithoutDatabase();

            // Определяем случайно первого пользователя чата.
            //$chat_id = $telegram->handleGetUpdates()->result[0]->message['chat']['id'];
            $chat_id = 223536364;

            if ($message)
            {
                $result = Request::sendMessage([
                    'chat_id' => $chat_id,
                    'text'    => \yii\helpers\Html::encode($message),
                ]);
            }
        } catch (TelegramException $e) {
            echo $e->getMessage();
        }
    }
}
