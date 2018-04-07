<?php
namespace humhub\modules\api\controllers;

use Yii;
use humhub\modules\api\controllers\BaseController;
use humhub\modules\api\models\Producer;

class ProducerController extends BaseController
{
    public $modelClass = 'humhub\modules\api\models\Producer';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['view'], $actions['delete'], $actions['update'], $actions['create']);
        return $actions;
    }
    
    public function actionIndex(){
        $query = Producer::find();
        return $query->all();
    }
    
    public function actionCreate() {
        $producer = new Producer();
        
        if(!Yii::$app->request->getBodyParam('url')){
            throw new \yii\web\BadRequestHttpException('url is required');
        } else {
            return "hora do show";
        }
    }

    public function actionGet(){
        return "banana";
    }
}
