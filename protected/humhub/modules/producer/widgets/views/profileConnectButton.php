<?php

use yii\helpers\Html;

print Html::a("Connect", ['/producer/producer/connect/', 
                'id' => $producer->id], ['class' => 'btn btn-info',
            'data-target' => '#globalModal']);