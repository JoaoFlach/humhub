<?php

namespace humhub\modules\producer\controllers;

use humhub\components\behaviors\AccessControl;
use humhub\modules\directory\components\UserPostsStreamAction;
use humhub\modules\producer\components\Controller;
use humhub\modules\producer\models\Producer;
use humhub\modules\producer\models\ProducerChannel;
use yii\data\Pagination;
use \Zend\Http\Client;


use Yii;


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
    public $modelClass = 'humhub\modules\producer\models\Producer';
    
    public function init() {
        return parent::init();
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'acl' => [
                'class' => AccessControl::className(),
                'guestAllowedActions' => ['groups', 'index', 'members', 'spaces', 'user-posts', 'stream']
            ]
        ];
    }

    public function actions() {
        return [
            'stream' => [
                'class' => UserPostsStreamAction::className(),
                'mode' => UserPostsStreamAction::MODE_NORMAL,
            ],
        ];
    }

    public function actionIndex() {
        return $this->redirect(['list']);
    }
    
    public function actionList() {
        $keyword = Yii::$app->request->get('keyword', '');
        $page = (int) Yii::$app->request->get('page', 1);
        $groupId = (int) Yii::$app->request->get('groupId', '');
        
        $searchOptions = [
            'model' => Producer::className()
        ];
        
        $query = Producer::find();
        $producers = $query->all();
        
        $pagination = new Pagination([
                    'totalCount' => 3,
                    'pageSize' => 3
        ]);
        
        return $this->render('list', [
                    'producers' => $producers,
                    'pagination' => $pagination
        ]);
    }
    
    public function actionCreate(){
        return $this->render('create');
    }
        
    public function actionProfile($id, $error_message = '') {
        $producer = Producer::find()->where(['id' => $id])->one();
        $channels = ProducerChannel::find()->where(['producer_id' => $id])->all();

        return $this->render('profile', ['producer' => $producer, 'channels' => $channels, 'error_message' => $error_message]);
    }
    
    public function actionLatest($id) {
        $producer = Producer::find()->where(['id' => $id])->one();
        $url = $producer->internet_address;

        $client = new Client();
        $client->setUri($url);
        $response = $client->send();
        $responsebody = $response->getBody();
        
        return $this->renderAjax('latestData', ['response' => $responsebody]);
    }
    
    public function actionChannel($id) {
//        $producer = Producer::find()->where(['id' => $id])->one();
        $error_status = Yii::$app->request->getBodyParam("error_status");
        return $this->renderAjax('addChannel', ['producer_id' => $id, 'error_status' => $error_status]);
    }

    public function actionAttributes() {
        $producer = new Producer();
        return $producer->attributes();
    }

    public function actionGuid () {
        $guid = substr(com_create_guid(),1,-1);
        
        return $guid;
    }
    
    public function actionUser(){
        $user = Yii::$app->user->getIdentity()->getId();
        return $user;
    }
    
    public function actionTest($channel_id, $producer_name){
        $channel = ProducerChannel::findOne(['id' => $channel_id]);
        $url = $channel->internet_address;

        $client = new Client();
        $client->setUri($url);
        $client->setHeaders(['Accept' => 'application/json']);
        $response = $client->send();
        if($response->getStatusCode()!=200){
            $responsebody = 'Error in this request. HTTP STATUS is '.$response->getStatusCode();
        } else {
            $responsebody = $response->getBody();
        }
        return $this->renderAjax('test', ['producer_name' => $producer_name, 'content' => $responsebody]);
    }
}
