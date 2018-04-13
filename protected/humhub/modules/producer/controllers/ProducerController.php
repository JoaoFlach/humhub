<?php

namespace humhub\modules\producer\controllers;

use Yii;
use humhub\modules\producer\models\Producer;
use humhub\components\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProducerController
 *
 * @author Flach
 */
class ProducerController extends Controller {
    
    public function init()
    {
        $this->appendPageTitle(Yii::t('DashboardModule.base', 'Dashboard'));
        return parent::init();
    }

    public $modelClass = 'humhub\modules\producer\models\Producer';

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
    
    public function actionList(){
        return $this->render("index",[]);
    }

}
