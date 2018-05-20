<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
?>
<div>
    <h2>Producer profile</h2>
    <div class="text-danger"><?= $error_message ?></div>
    
    <div>
        <h4>Metadata</h4>
        <p>Name: <?= $producer->name ?></p>
        <p>Country: <?= $producer->country ?></p>
        <p>Tags: <?= $producer->tags ?></p>
        <p>Owned by: <?= $producer->getProducerOwnerName() ?></p>
        
        <h4>Channels</h4>
        <ul class="list-group">
            <?php foreach ($channels as $channel) : ?>
                <li class="list-group-item">
                    <div>
                        <?= $channel->name ?>
                        <div class="pull-right">
                        <?php echo Html::a($channel->http_method, ['/producer/producer/test', 'channel_id' => $channel->id, 'producer_name' => $producer->name], ['class' => 'btn btn-info btn-xs', 'data-target' => '#globalModal']) ?>
                        <?php echo Html::a('Edit', ['/producer/channel/edit', 'id' => $channel->id], ['class' => 'btn btn-primary btn-xs', 'data-target' => '#globalModal']) ?>
                        <?php echo Html::a('Delete', ['/producer/channel/delete', 'id' => $channel->id], ['class' => 'btn btn-danger btn-xs', 'data-target' => '#globalModal']) ?>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        
        <h4>Options</h4>
        <div class="btn-group-sm">
            <?php echo Html::a('Delete', ['/producer/rest/delete/', 
                'id' => $producer->id], ['class' => 'btn btn-danger', 
                    'data-target' => '#globalModal']); ?>
            <?php echo Html::a('Edit', ['/producer/producer/edit/', 
                'id' => $producer->id], ['class' => 'btn btn-primary', 
                    'data-target' => '#globalModal']); ?>
            <?php echo Html::a('+ Channel', ['/producer/producer/channel/', 
                'id' => $producer->id], ['class' => 'btn btn-primary', 
                    'data-target' => '#globalModal']); ?>
        </div>
    </div>
</div>