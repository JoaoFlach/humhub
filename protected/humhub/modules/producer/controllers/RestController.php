<?php
namespace humhub\modules\producer\controllers;

use \yii\rest\ActiveController;
use humhub\modules\producer\models\Producer;
use \Zend\Http\Client;
use Yii;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RestController extends ActiveController {
    public $modelClass = 'humhub\modules\producer\models\Producer';
    
    public function init() {
        return parent::init();
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            
        ];
    }

    public function actions() {
        return [
            
        ];
    }
    
    public function actionHello(){ 
        return "hello";
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
            return $this->redirect(['producer/list']);
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
    
    public function actionRequest($id) {
        $producer = Producer::find()->where(['id' => $id])->one();
        $url = $producer->internet_address;

        $client = new Client();
        $client->setUri($url);
        $response = $client->send();
        $responsebody = $response->getBody();
        return $responsebody;
    }

    private function getCurrentDate () {
        $format ='Y-m-d H:i:s';
        $date = gmdate($format);
        
        return $date;
    }
    
}