<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use humhub\modules\producer\widgets\Menu;
use humhub\modules\producer\widgets\ChannelMenu;
?>
<div class="row">
    <div class="col-md-12">
        <?= \humhub\modules\producer\widgets\ProfileHeader::widget(
                ['producer' => $producer, 'countConnections' => $countConnections]); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <?= Menu::widget(); ?>
    </div>
    <div class="col-md-7">
        <h2>Producer profile</h2>
        <div class="text-danger"><?= $error_message ?></div>

        <div>
            <h4>Metadata</h4>
            <p>Name: <?= $producer->name ?></p>
            <p>Country: <?= $producer->country ?></p>
            <p>Tags: <?= $producer->tags ?></p>
            <p>Owned by: <?= $producer->getProducerOwnerName() ?></p>
        </div>
    </div>
    <div class="col-md-3">
        <?= ChannelMenu::widget(['producer' => $producer, 'channels' => $channels]); ?>
    </div>
</div>

