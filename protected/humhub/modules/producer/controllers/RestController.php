<?php
namespace humhub\modules\producer\controllers;

use \yii\rest\ActiveController;
use humhub\modules\producer\models\Producer;
use humhub\modules\producer\models\ProducerChannel;
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
        
        $channel = Yii::$app->request->getBodyParam('channel');
        
        $rawbody = Yii::$app->request->rawBody;

        $producer->guid = $guid;
        $producer->name = Yii::$app->request->getBodyParam('name');        
        $producer->tags = Yii::$app->request->getBodyParam('tags');        
        $producer->user_id = Yii::$app->user->id;
        $producer->country = Yii::$app->request->getBodyParam('countryCode');
        $producer->location= Yii::$app->request->getBodyParam('location');
        
        $currentDate = $this->getCurrentDate();
        $producer->created_at = $currentDate;
        $producer->updated_at = $currentDate;
        
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
    
    public function actionDelete($id){
        $producer = Producer::find()->where(['id' => $id])->one();
        ProducerChannel::deleteAll(['producer_id' => $producer->id]);
        
        if ($producer->delete()) {
            return $this->redirect(['producer/list']);
        } else {
            throw new Exception("Could not delete this item");
        }
    }
    
    public function actionRequest($id) {
        $producer = Producer::find()->where(['id' => $id])->one();
        $url = $producer->internet_address;

        $response = $this->callHttp($url);
        $responsebody = $response->getBody();
        return $responsebody;
    }

    private function getCurrentDate () {
        $format ='Y-m-d H:i:s';
        $date = gmdate($format);
        
        return $date;
    }
    
    private function callHttp($url){
        $client = new Client();
        $client->setUri($url);
        $client->setMethod("GET");
        $response = $client->send();
        return $response;
    }
    
    public function actionChannelcreate() {
        $producer_channel = new ProducerChannel();
        
        $producer_id = Yii::$app->request->getBodyParam("producer_id");        
        $http_method = Yii::$app->request->getBodyParam("http_method");
        $internet_address = Yii::$app->request->getBodyParam("internet_address");
        $name = Yii::$app->request->getBodyParam("name");
        $http_response = $this->callHttp($internet_address);
        $status = $http_response->getStatusCode();
        
        if($status<200 || $status>299){ 
            return $this->redirect(['producer/profile', 'id' => $producer_id, "error_message" => 'The URL used to create the channel was not valid']);
        }
        
        $producer_channel->http_method = $http_method;
        $producer_channel->internet_address = $internet_address;
        $producer_channel->producer_id = $producer_id;
        $producer_channel->name = $name;

        if ($producer_channel->save()) {
            return $this->redirect(['producer/profile', 'id' => $producer_channel->producer_id]);
        } else {
            throw new Exception("Could not save this item");
        }            
       
    }
    
    public function actionChannel() {
        $producer_channel = new ProducerChannel();
        $id = Yii::$app->request->getBodyParam("id");
        
        if(isset($id)){
            $producer_channel = ProducerChannel::findOne(['id' => $id]);
        }
        
        $producer_id = Yii::$app->request->getBodyParam("producer_id");        
        $http_method = Yii::$app->request->getBodyParam("http_method");
        $internet_address = Yii::$app->request->getBodyParam("internet_address");
        $name = Yii::$app->request->getBodyParam("name");
        $http_response = $this->callHttp($internet_address);
        $status = $http_response->getStatusCode();
        
        if($status<200 || $status>299){ 
            return $this->redirect(['producer/profile', 'id' => $producer_id, "error_message" => 'The URL used to create the channel was not valid']);
        }
        
        $producer_channel->http_method = $http_method;
        $producer_channel->internet_address = $internet_address;
        $producer_channel->producer_id = $producer_id;
        $producer_channel->name = $name;

        if(isset($id)){
            $producer_channel->update();
            return $this->redirect(['producer/profile', 'id' => $producer_id]);
            
        } else {
            if ($producer_channel->save()) {
                return $this->redirect(['producer/profile', 'id' => $producer_id]);
            } else {
                throw new Exception("Could not save this item");
            }    
        }
        
                
       
    }
    
}