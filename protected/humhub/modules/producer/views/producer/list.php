<?php
use yii\helpers\Html;

?>
<div class="panel panel-default">

    <div class="panel-heading">
       
        <?= Yii::t('ProducerModule.base', '<strong>Producers</strong> list'); ?>
       
    </div>

    <div class="panel-body">
        <?= Html::beginForm('', 'get', ['class' => 'form-search']); ?>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-group form-group-search">
                    <?= Html::hiddenInput('page', '1'); ?>
                    <?= Html::textInput("keyword", null, ['class' => 'form-control form-search', 'placeholder' => Yii::t('ProducerModule.base', 'search for producers')]); ?>
                    <?= Html::submitButton(Yii::t('ProducerModule.base', 'Search'), ['class' => 'btn btn-default btn-sm form-button-search']); ?>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <?= Html::endForm(); ?>

        <?php if (count($producers) == 0): ?>
            <p><?= Yii::t('ProducerModule.base', 'No producers found!'); ?></p>
        <?php endif; ?>
    </div>

    <hr>

    <ul class="media-list">
        <?php foreach ($producers as $producer) : ?>
            <li>
                <div>
                    <p>Name: <?= $producer->name ?></p
                    <p>Guid: <?= $producer->guid ?></p>
                    <p>Internet Address: <?= $producer->internet_address ?></p>
                    <p>Country: <?= $producer->country ?></p>
                    <p>Tags: <?= $producer->tags ?></p>
                    <p>Created at: <?= $producer->created_at ?></p>
                    <p>Created by: <?= $producer->user_id ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

<div class="pagination-container">
    <?= \humhub\widgets\LinkPager::widget(['pagination' => $pagination]); ?>
</div>
