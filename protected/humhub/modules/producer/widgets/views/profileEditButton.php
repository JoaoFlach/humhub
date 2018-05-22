<?php

use yii\helpers\Html;

print Html::a("Edit", ['/producer/producer/edit/', 
                'id' => $producer->id], ['class' => 'btn btn-primary edit-account',
            'data-target' => '#globalModal']);