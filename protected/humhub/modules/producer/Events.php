<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\producer;

use Yii;
use yii\helpers\Url;

/**
 * Description of Events
 *
 * @author luke
 */
class Events extends \yii\base\Object
{
    /**
     * On build of the TopMenu, check if module is enabled
     * When enabled add a menu item
     *
     * @param type $event
     */
    public static function onTopMenuInit($event)
    {
        if (Yii::$app->user->isGuest) {
            return;
        }

        $event->sender->addItem(array(
            'label' => Yii::t('base', 'Producers'),
            'url' => Url::to(['/producer/index']),
            'icon' => '<i class="fa fa-cloud"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'producer'),
            'sortOrder' => 300,
        ));
    }

}
