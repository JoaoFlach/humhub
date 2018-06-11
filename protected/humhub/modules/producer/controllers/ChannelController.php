<?php

namespace humhub\modules\producer\controllers;

use humhub\components\behaviors\AccessControl;
use humhub\modules\producer\components\Controller;
use humhub\modules\producer\models\ProducerChannel;
use humhub\modules\producer\models\ProducerChannelProperty;
use \Zend\Http\Client;
use yii\helpers\Json;
use Yii;

/**
 * Description of ChannelController
 *
 * @author Flach
 */
class ChannelController extends Controller {

    public $modelClass = 'humhub\modules\producer\models\ProducerChannel';

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

    public function actionCreate($producer_id) {
        return $this->renderAjax('create', ['producer_id' => $producer_id]);
    }

    public function actionEdit($id) {
        $channel = ProducerChannel::findOne(['id' => $id]);
        $channel_properties = ProducerChannelProperty::findAll(['channel_id' => $id]);
        return $this->renderAjax('edit', ['channel' => $channel,
                    'channel_properties' => $channel_properties]);
    }

    public function actionDelete($id) {
        return $this->renderAjax('delete', ['id' => $id]);
    }

    public function actionRequest($channel_id, $producer_name) {
        $channel = ProducerChannel::findOne(['id' => $channel_id]);
        $url = $channel->internet_address;

        $client = new Client();
        $client->setUri($url);
        $client->setHeaders(['Accept' => 'application/json']);
        $response = $client->send();


        if ($response->getStatusCode() != 200) {
            $responsebody = 'Error in this request. HTTP STATUS is ' . $response->getStatusCode();
        } else {
            $responsebody = \GuzzleHttp\json_decode($response->getBody());
        }
        return $this->renderAjax('request', ['producer_name' => $producer_name, 'content' => $responsebody]);
    }

    public function actionSelectItems() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $producer_id = $parents[0];
                $out = self::getChannelList($producer_id);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                // ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                // ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }
    
    public function actionChannelProperties() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $channel_id = $parents[0];
                $out = self::getChannelProperties($channel_id);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                // ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                // ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }
    
    public function getChannelList($producer_id) {
        $channels = ProducerChannel::find()
                ->where(['producer_id' => $producer_id])
                ->select(["id", "name"])
                ->asArray()
                ->all();
        return $channels;
    }
    
    public function getChannelProperties($channel_id) {
        $channel_properties = ProducerChannelProperty::find()
                ->where(['channel_id' => $channel_id])
                ->select(["id", "name" => "property_name"])
                ->asArray()
                ->all();
        return $channel_properties;
    }

}
