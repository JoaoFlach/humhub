<?php
namespace humhub\modules\api\controllers;

use Yii;
use humhub\modules\api\controllers\BaseController;

class SpaceController extends BaseController
{
    public $modelClass = 'humhub\modules\space\models\Space';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['update'], $actions['create']);
        return $actions;
    }
}