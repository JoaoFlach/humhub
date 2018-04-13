<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\producer;

use yii\web\AssetBundle;

class Assets extends AssetBundle
{

    public $css = [
        'producer.css',
    ];
    public $js = [
        'producer.js'
    ];

    public function init()
    {
        $this->sourcePath = dirname(__FILE__) . '/assets';
        parent::init();
    }

}
