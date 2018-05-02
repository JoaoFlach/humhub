<?php

use humhub\widgets\TopMenu;

return [
    'id' => 'producer',
    'class' => 'humhub\modules\producer\Module',
    'namespace' => 'humhub\modules\producer',
    'events' => [
        ['class' => TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\producer\Events', 'onTopMenuInit']],
    ],
    'urlManagerRules' => [
        'producer' => 'producer/producer/index',
        'producer/index' => 'producer/producer/index',
        'producer/create' => 'producer/producer/create',
        'producer/list' => 'producer/producer/list',
        'GET producer/profile/<id:\d+>' => 'producer/producer/profile',
    ]   
];
?>