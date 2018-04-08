<?php

namespace humhub\modules\api\controllers;

use Yii;
use humhub\modules\api\controllers\BaseController;
use humhub\modules\api\models\Producer;
use Zend\Http\Client;

class ProducerController extends BaseController {

    public $modelClass = 'humhub\modules\api\models\Producer';

    /**
     * @inheritdoc
     */
    public function actions() {
        $actions = parent::actions();
        unset($actions['index'], $actions['view'], $actions['delete'], $actions['update'], $actions['create']);
        return $actions;
    }

    public function actionIndex() {
        $query = Producer::find();
        return $query->all();
    }

    public function actionCreate() {
        $producer = new Producer();

        $producer->url = Yii::$app->request->getBodyParam('url');
        $producer->ip = Yii::$app->request->getBodyParam('ip');
        $producer->port = Yii::$app->request->getBodyParam('port');
        $producer->active = false;

        if ($producer->save()) {
            return $producer;
        } else {
            throw new Exception("Could not save this item");
        }
    }

    public function actionUpdate($id) {
        $producer = Producer::find()->where(['id' => $id])->one();

        $producer->url = Yii::$app->request->getBodyParam('url');
        $producer->ip = Yii::$app->request->getBodyParam('ip');
        $producer->port = Yii::$app->request->getBodyParam('port');


        if ($producer->save()) {
            return $producer;
        } else {
            throw new Exception("Could not update this item");
        }
    }

    public function actionView($id) {
        $producer = Producer::find()->where(['id' => $id])->one();

        return $producer;
    }

    public function actionAttributes() {
        $producer = new Producer();
        return $producer->attributes();
    }

    public function actionRequest($id) {
        $producer = Producer::find()->where(['id' => $id])->one();
        $url = $producer->url;

        $client = new Client();
        $client->setUri($url);
        $response = $client->send();
        $responsebody = $response->getBody();
        return $responsebody;
    }

}
