<?php

namespace humhub\modules\producer\controllers;

use humhub\components\behaviors\AccessControl;
use humhub\modules\directory\components\UserPostsStreamAction;
use humhub\modules\producer\components\Controller;
use humhub\modules\producer\models\Producer;
use humhub\modules\producer\models\ProducerChannel;
use humhub\modules\producer\models\ProducerConnection;
use yii\data\Pagination;
use \Zend\Http\Client;
use humhub\modules\user\models\fieldtype\CountrySelect;


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

    public function actionAttributes() {
        $producer = new Producer();
        return $producer->attributes();
    }
    
    public function actionChannel($id) {
    //        $producer = Producer::find()->where(['id' => $id])->one();
        $error_status = Yii::$app->request->getBodyParam("error_status");
        return $this->renderAjax('addChannel', ['producer_id' => $id, 'error_status' => $error_status]);
    }
    
    public function actionConnect($producer_id){
        $producers = Producer::find()->all();
        $origin_select_items = $this->getConnectOriginSelectItems($producers);
        return $this->renderAjax('connect', [
            'producers' => $producers,
            'origin_select_items' => $origin_select_items
        ]);
    }
    
    public function actionCreate(){
        $countrySelect = new CountrySelect();
        $countries = $countrySelect->getSelectItems();
        return $this->render('create', ['countries' => $countries]);
    }
    
    public function actionDelete($id) {
        return $this->renderAjax('delete', ['id' => $id]);
    }  
    
    public function actionEdit($id) {
        $countrySelect = new CountrySelect();
        $countries = $countrySelect->getSelectItems();
        $producer = Producer::findOne(['id' => $id]);
        return $this->renderAjax('edit', ['producer' => $producer, 'countries' => $countries]);
    }
    
    public function actionGuid () {
        $guid = substr(com_create_guid(),1,-1);
        
        return $guid;
    }
    
    public function actionIndex() {
        return $this->redirect(['list']);
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
    
    public function actionProfile($id, $error_message = '') {
        $producer = Producer::find()->where(['id' => $id])->one();
        $channels = ProducerChannel::find()->where(['producer_id' => $id])->all();
        
        $countConnections = ProducerConnection::find()->all();
        $countConnections = count($countConnections);

        return $this->render('profile', 
                ['producer' => $producer, 
                    'channels' => $channels, 
                    'error_message' => $error_message,
                    'countConnections' => $countConnections
                    ]);
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
    
    public function actionUser(){
        $user = Yii::$app->user->getIdentity()->getId();
        return $user;
    }
    
    private function getConnectOriginSelectItems($producers) {
        $select_items = [];
        $select_items[''] = '';
        foreach($producers as $producer) {
            $key = $producer->id;
            $value = $producer->name;
            $select_items[$key] = $value;            
        }
        
        return $select_items;
    }
}
