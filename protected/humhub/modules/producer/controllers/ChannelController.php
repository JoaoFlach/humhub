<?php

namespace humhub\modules\producer\controllers;

use humhub\components\behaviors\AccessControl;
use humhub\modules\producer\components\Controller;
use humhub\modules\producer\models\ProducerChannel;


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
}
