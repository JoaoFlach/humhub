<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
?>
<div id="" class="panel panel-default left-navigation">
    <div class="panel-heading"><strong>Channels</strong></div>
    <div class="list-group">
        <?php foreach ($channels as $channel) : ?>
        <div class="list-group-item">
            <?= $channel->name ?>
            <div class="pull-right">
                <?php echo Html::a($channel->http_method, ['/producer/channel/request', 'channel_id' => $channel->id, 'producer_name' => $producer->name], ['class' => 'btn btn-info btn-xs', 'data-target' => '#globalModal']) ?>
                <?php if ($producer->isProducerOwner($user->id)) : ?>
                    <?php echo Html::a('Edt', ['/producer/channel/edit', 'id' => $channel->id], ['class' => 'btn btn-primary btn-xs', 'data-target' => '#globalModal']) ?>
                    <?php echo Html::a('Del', ['/producer/channel/delete', 'id' => $channel->id], ['class' => 'btn btn-danger btn-xs', 'data-target' => '#globalModal']) ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>