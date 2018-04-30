<?php

namespace humhub\modules\producer\controllers;

use humhub\components\behaviors\AccessControl;
use humhub\modules\directory\components\UserPostsStreamAction;
use yii\rest\ActiveController;
use humhub\modules\producer\models\Producer;
use yii\data\Pagination;


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
class ProducerController extends ActiveController {
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
    
   public function actionCreate() {
        $producer = new Producer();
        $guid = substr(com_create_guid(),1,-1);

        $producer->internet_address = Yii::$app->request->getBodyParam('internet_address');
        $producer->guid = $guid;
        $producer->name = Yii::$app->request->getBodyParam('name');        
        $producer->tags = Yii::$app->request->getBodyParam('tags');        
        $currentDate = $this->getCurrentDate();
        $producer->created_at = $currentDate;
        $producer->updated_at = $currentDate;
        $producer->user_id = Yii::$app->user->id;
        $producer->country = Yii::$app->request->getBodyParam('country');
        $producer->location= Yii::$app->request->getBodyParam('location');
        
        if ($producer->save()) {
            return 'success';
        } else {
            throw new Exception("Could not save this item");
        }
    }

    public function actionUpdate($id) {
        $producer = Producer::find()->where(['id' => $id])->one();

        $producer->internet_address = Yii::$app->request->getBodyParam('internet_address');
        $producer->name = Yii::$app->request->getBodyParam('name');        
        $producer->tags = Yii::$app->request->getBodyParam('tags');
        $producer->country = Yii::$app->request->getBodyParam('country');
        $producer->location->request->getBodyParam('location');
        $producer->updated_at = Yii::$app->request->getBodyParam('updated_at');

        if ($producer->save()) {
            return $producer;
        } else {
            throw new Exception("Could not update this item");
        }
    }

    public function actionView($id) {
        $producer = Producer::find()->where(['id' => $id])->one();

        return $this->render('profile', ['producer' => $producer]);
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
    
    public function actionGuid () {
        $guid = substr(com_create_guid(),1,-1);
        
        return $guid;
    }
    
    private function getCurrentDate () {
        $format ='Y-m-d H:i:s';
        $date = gmdate($format);
        
        return $date;
    }
    
    public function actionUser(){
        $user = Yii::$app->user->getIdentity()->getId();
        return $user;
    }
    
    public function actionNew(){
        return $this->render('create');
    }
    
}
