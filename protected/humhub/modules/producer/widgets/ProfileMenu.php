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
 * Directory ProducerMenu
 *
 */
class ProfileMenu extends \humhub\widgets\BaseMenu
{

    public $template = "@humhub/widgets/views/leftNavigation";

    public function init()
    {
        $this->addItemGroup(array(
            'id' => 'profile',
            'label' => Yii::t('ProducerModule.base', '<strong>Actions</strong> menu'),
            'sortOrder' => 100,
        ));
        
        $this->addItem(array(
            'label' => Yii::t('ProducerModule.base', 'Delete producer'),
            'group' => 'profile',
            'url' => Url::to(['/producer/rest/delete/']),
            'sortOrder' => 200,
        ));
        
        $this->addItem(array(
            'label' => Yii::t('ProducerModule.base', 'Add channel'),
            'group' => 'profile',
            'url' => Url::to(['/producer/producer/channel/']),
            'sortOrder' => 300,
        ));

        
        parent::init();
    }

}
