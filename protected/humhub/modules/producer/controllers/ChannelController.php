<?php

namespace humhub\modules\producer\controllers;

use humhub\components\behaviors\AccessControl;
use humhub\modules\producer\components\Controller;
use humhub\modules\producer\models\ProducerChannel;
use \Zend\Http\Client;
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
        return $this->renderAjax('edit', ['channel' => $channel]);
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

}
