<?php

use yii\helpers\Html;

print Html::a('+ Channel', ['/producer/channel/create/',
                    'producer_id' => $producer->id], ['class' => 'btn btn-success',
                    'data-target' => '#globalModal']);