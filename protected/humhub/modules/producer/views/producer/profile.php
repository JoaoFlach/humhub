<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use humhub\modules\user\models\User;
?>
<div>
    <h2>Producer profile</h2>
    
    <div>
        <p>Name: <?= $producer->name ?></p
        <p>Guid: <?= $producer->guid ?></p>
        <p>Internet Address: <?= $producer->internet_address ?></p>
        <p>Country: <?= $producer->country ?></p>
        <p>Tags: <?= $producer->tags ?></p>
        <p>Created at: <?= $producer->created_at ?></p>
        <p>Owned by: <?= $producer->getProducerOwnerName() ?></p>
        
        <?php foreach ($channels as $channel) : ?>
            <p><?= $channel->http_method ?><?= $channel->internet_address ?></p>
        <?php endforeach; ?>
        
        <?php echo Html::a(Yii::t('ProducerModule.views_producer_profile', 'Get Latest Data'), ['/producer/producer/latest/', 'id' => $producer->id], array('class' => 'btn btn-info pull-right', 'data-target' => '#globalModal')); ?>
        <?php echo Html::a(Yii::t('ProducerModule.views_producer_profile', 'Delete'), ['/producer/rest/delete/', 'id' => $producer->id], array('class' => 'btn btn-danger pull-right')); ?>
        <?php echo Html::a(Yii::t('ProducerModule.views_producer_profile', 'Add Channel'), ['/producer/producer/channel/', 'id' => $producer->id], array('class' => 'btn btn-info pull-right', 'data-target' => '#globalModal')); ?>
    </div>
</div>