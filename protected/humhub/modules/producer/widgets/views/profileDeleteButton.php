<?php

use yii\helpers\Html;

print Html::a("Delete", ['/producer/producer/delete/', 
                'id' => $producer->id], ['class' => 'btn btn-danger',
            'data-target' => '#globalModal']);