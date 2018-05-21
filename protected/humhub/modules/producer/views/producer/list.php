<?php
use yii\helpers\Html;
use humhub\modules\producer\widgets\Image;

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
                <div class="media">
                    <?= Image::widget(['producer' => $producer, 'htmlOptions' => ['class' => 'pull-left']]); ?>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="<?= $producer->getUrl(); ?>"><?= Html::encode($producer->name); ?></a>
                        </h4>
                        <h5>
                            <?= $producer->country ?>
                        </h5>
                        <h5>
                            Owned by <?= $producer->getProducerOwnerName() ?>
                        </h5>
                        <?php echo Html::a('Delete', 
                                ['/producer/producer/delete/', 
                                    'id' => $producer->id], 
                                ['class' => 'btn-xs btn-danger pull-right',
                                    'data-target' => '#globalModal']); ?>
                    </div>
                </div>                
            </li>        
        <?php endforeach; ?>
    </ul>

</div>

<div class="pagination-container">
    <?= \humhub\widgets\LinkPager::widget(['pagination' => $pagination]); ?>
</div>
