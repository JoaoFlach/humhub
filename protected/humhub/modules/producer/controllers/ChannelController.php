<?php

namespace humhub\modules\producer\controllers;

use humhub\components\behaviors\AccessControl;
use humhub\modules\producer\components\Controller;
use humhub\modules\producer\models\Producer;
use humhub\modules\producer\models\ProducerChannel;
use yii\data\Pagination;
use \Zend\Http\Client;


use Yii;

/**
 * Description of ChannelController
 *
 * @author Flach
 */
class ChannelController extends Controller {
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

    public function actionIndex() {
        return $this->redirect(['list']);
    }
    
    public function actionEdit($id) {
        $channel = ProducerChannel::findOne(['id' => $id]);
        return $this->renderAjax('edit', ['channel' => $channel]);
    }
    
    public function actionDelete($id) {
        
    }
    
    public function actionTest(){
        return "banana";
    }
    
    public function actionCreate() {
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
    
    public function actionUpdate() {
        $producer_channel = new ProducerChannel();
        
        $id = Yii::$app->request->getBodyParam("id");    
        $producer_id = Yii::$app->request->getBodyParam("producer_id");        
        $http_method = Yii::$app->request->getBodyParam("http_method");
        $internet_address = Yii::$app->request->getBodyParam("internet_address");
        $name = Yii::$app->request->getBodyParam("name");
        $http_response = $this->callHttp($internet_address);
        $status = $http_response->getStatusCode();
        
        if($status<200 || $status>299){ 
            return $this->redirect(['producer/profile', 'id' => $producer_id, "error_message" => 'The URL used to create the channel was not valid']);
        }
        
        $producer_channel->id = $id;
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
}
