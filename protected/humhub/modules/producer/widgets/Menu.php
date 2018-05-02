<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\producer\widgets;

use Yii;
use yii\helpers\Url;

/**
 * Directory Menu
 *
 * @since 0.21
 * @author Luke
 */
class Menu extends \humhub\widgets\BaseMenu
{

    public $template = "@humhub/widgets/views/leftNavigation";

    public function init()
    {
        $this->addItemGroup(array(
            'id' => 'producer',
            'label' => Yii::t('ProducerModule.base', '<strong>Producer</strong> menu'),
            'sortOrder' => 100,
        ));

        $this->addItem(array(
            'label' => Yii::t('ProducerModule.base', 'Create new producer'),
            'group' => 'producer',
            'url' => Url::to(['/producer/create']),
            'sortOrder' => 200,
            'isActive' => (Yii::$app->controller->action->id == "create"),
        ));

        
        parent::init();
    }

}
