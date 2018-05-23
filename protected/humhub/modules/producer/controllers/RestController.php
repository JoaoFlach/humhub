<?php

namespace humhub\modules\producer\controllers;

use \yii\rest\ActiveController;
use \yii\base\Exception;
use humhub\modules\producer\models\Producer;
use humhub\modules\producer\models\ProducerChannel;
use humhub\modules\producer\models\ProducerChannelProperty;
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

    public function actionCreate() {
        $producer = new Producer();

        $channel = Yii::$app->request->getBodyParam('channel');

        $rawbody = Yii::$app->request->rawBody;

        $producer->guid = $guid;
        $producer->name = Yii::$app->request->getBodyParam('name');
        $producer->tags = Yii::$app->request->getBodyParam('tags');
        $producer->user_id = Yii::$app->user->id;
        $producer->country = Yii::$app->request->getBodyParam('countryCode');
        $producer->location = Yii::$app->request->getBodyParam('location');

        $currentDate = $this->getCurrentDate();
        $producer->created_at = $currentDate;
        $producer->updated_at = $currentDate;

        if ($producer->save()) {
            return $this->redirect(['producer/list']);
        } else {
            throw new Exception("Could not save this item");
        }
    }

    public function actionDelete($id) {
        $producer = Producer::find()->where(['id' => $id])->one();
        ProducerChannel::deleteAll(['producer_id' => $producer->id]);

        if ($producer->delete()) {
            return $this->redirect(['producer/list']);
        } else {
            throw new Exception("Could not delete this item");
        }
    }

    public function actionDeleteChannel() {
        $id = Yii::$app->request->getBodyParam('id');
        $channel = ProducerChannel::find()->where(['id' => $id])->one();
        $producer_id = $channel->producer_id;

        if ($channel->delete()) {
            return $this->redirect(['producer/profile',
                        'id' => $producer_id]);
        } else {
            throw new Exception("Could not delete this item");
        }
    }

    public function actionDeleteProducer() {
        $id = Yii::$app->request->getBodyParam('id');
        $producer = Producer::find()->where(['id' => $id])->one();

        if ($producer->delete()) {
            return $this->redirect(['producer/list']);
        } else {
            throw new Exception("Could not delete this item");
        }
    }

    public function actionSaveChannel() {
        $producer_channel = new ProducerChannel();
        $id = Yii::$app->request->getBodyParam("id");

        if (isset($id)) {
            $producer_channel = ProducerChannel::findOne(['id' => $id]);
        }

        $producer_channel->producer_id = Yii::$app->request->getBodyParam("producer_id");
        $producer_channel->http_method = Yii::$app->request->getBodyParam("http_method");
        $producer_channel->internet_address = Yii::$app->request->getBodyParam("internet_address");
        $producer_channel->name = Yii::$app->request->getBodyParam("name");

        if (!$producer_channel->save()) {
            throw new Exception("Could not save the ProducerChannel");
        }

        $form_properties = Yii::$app->request->getBodyParam("property");

        $current_channel_properties = 
                ProducerChannelProperty::findAll(
                        ['channel_id' => $producer_channel->id]);
        
        $ids_to_delete = array();
        foreach ($current_channel_properties as $current_channel_property){
            array_push($ids_to_delete, $current_channel_property->id);
        }
        
        foreach ($form_properties as $form_property) {
            $property_id = $form_property['id'];
            $property_obj = new ProducerChannelProperty();
            
            if($property_id!==''){
                $property_obj = ProducerChannelProperty::findOne(['id' => $property_id]);
            } 
            
            if (!$property_obj->isValidType($form_property['type'])) {
                throw new Exception("Invalid type value '" . $form_property['type'] . "'");
            }
            
            $property_obj->channel_id = $producer_channel->id;
            $property_obj->type = $form_property['type'];
            $property_obj->property_name = $form_property['name'];

            if (!$property_obj->save()) {
                throw new Exception("Could not save the ProducerChannelProperty");
            }
            $ids_to_delete = array_diff($ids_to_delete, [$property_obj->id]);
        }
        
        foreach ($ids_to_delete as $id_to_delete) {
            ProducerChannelProperty::deleteAll(['id' => $id_to_delete]);
        }

        return $this->redirect(['producer/profile',
                    'id' => $producer_channel->producer_id]);
    }

    public function actionSaveProducer() {
        $producer = new Producer();
        $id = Yii::$app->request->getBodyParam("id");

        if (isset($id)) {
            $producer = Producer::findOne(['id' => $id]);
        }

        $producer->name = Yii::$app->request->getBodyParam('name');
        $producer->tags = Yii::$app->request->getBodyParam('tags');
        $producer->country = Yii::$app->request->getBodyParam('country');
        $producer->location = Yii::$app->request->getBodyParam('location');

        $currentDate = $this->getCurrentDate();
        $producer->updated_at = $currentDate;

        if (!isset($id)) {
            $producer->created_at = $currentDate;
            $producer->user_id = Yii::$app->user->id;
            $guid = substr(com_create_guid(), 1, -1);
            $producer->guid = $guid;

            if ($producer->save()) {
                return $this->redirect(['producer/list']);
            } else {
                throw new Exception("Could not save this item");
            }
        } else {
            $producer->update();
            return $this->redirect(['producer/profile', 'id' => $id]);
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

        $response = $this->callHttp($url);
        $responsebody = $response->getBody();
        return $responsebody;
    }

    private function callHttp($url) {
        $client = new Client();
        $client->setUri($url);
        $client->setMethod("GET");
        $response = $client->send();
        return $response;
    }

    private function getCurrentDate() {
        $format = 'Y-m-d H:i:s';
        $date = gmdate($format);

        return $date;
    }

}
