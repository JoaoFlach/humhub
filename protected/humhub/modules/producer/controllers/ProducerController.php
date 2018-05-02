<?php

namespace humhub\modules\producer\controllers;

use humhub\components\behaviors\AccessControl;
use humhub\modules\directory\components\UserPostsStreamAction;
use humhub\modules\producer\components\Controller;
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
        
    public function actionProfile($id) {
        $producer = Producer::find()->where(['id' => $id])->one();

        return $this->render('profile', ['producer' => $producer]);
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
}
