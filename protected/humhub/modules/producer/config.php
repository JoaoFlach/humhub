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
        'producer/index' => 'producer/producer/index',
    ]   
];
?>