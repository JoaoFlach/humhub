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
        return $this->redirect(['test']);
    }
    
    public function actionMembers()
    {
        $keyword = Yii::$app->request->get('keyword', '');
        $page = (int) Yii::$app->request->get('page', 1);
        $groupId = (int) Yii::$app->request->get('groupId', '');

        $group = null;
        if ($groupId) {
            $group = Group::findOne(['id' => $groupId, 'show_at_directory' => 1]);
        }

        $searchOptions = [
            'model' => User::className(),
            'page' => $page,
            'pageSize' => $this->module->pageSize,
        ];

        if ($this->module->memberListSortField != '') {
            $searchOptions['sortField'] = $this->module->memberListSortField;
        }

        if ($group !== null) {
            $searchOptions['filters'] = ['groups' => $group->id];
        }

        $searchResultSet = Yii::$app->search->find($keyword, $searchOptions);

        $pagination = new Pagination([
                    'totalCount' => $searchResultSet->total,
                    'pageSize' => $searchResultSet->pageSize
        ]);

        Event::on(Sidebar::className(), Sidebar::EVENT_INIT, function ($event) {
            $event->sender->addWidget(NewMembers::className(), [], ['sortOrder' => 10]);
            $event->sender->addWidget(MemberStatistics::className(), [], ['sortOrder' => 20]);
        });

        return $this->render('members', [
                    'keyword' => $keyword,
                    'group' => $group,
                    'users' => $searchResultSet->getResultInstances(),
                    'pagination' => $pagination
        ]);
    }
    
    public function actionTest() {
        $keyword = Yii::$app->request->get('keyword', '');
        $page = (int) Yii::$app->request->get('page', 1);
        $groupId = (int) Yii::$app->request->get('groupId', '');
        
        $query = Producer::find();
        $producers = $query->all();
        
        $pagination = new Pagination([
                    'totalCount' => 3,
                    'pageSize' => 3
        ]);
        
        return $this->render('test', [
                    'producers' => $producers,
                    'pagination' => $pagination
        ]);
    }
}
