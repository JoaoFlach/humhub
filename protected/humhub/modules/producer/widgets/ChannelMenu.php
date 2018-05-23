<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\producer\widgets;

use Yii;

/**
 * Directory Menu
 *
 * @since 0.21
 * @author Luke
 */
class ChannelMenu extends \yii\base\Widget
{

    public $channels;
    public $producer;

    public function run() {
        $render = $this->render('channelsMenu', 
                ['producer' => $this->producer, 'channels' => $this->channels, 
                    'user' => Yii::$app->user]);
        return $render;
    }

}
