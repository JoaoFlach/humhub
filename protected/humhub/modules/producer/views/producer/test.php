<?php
use yii\helpers\Html;
use humhub\modules\user\widgets\Image;
use humhub\modules\directory\widgets\MemberActionsButton;
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
                    <?= Html::textInput("keyword", null, ['class' => 'form-control form-search', 'placeholder' => Yii::t('DirectoryModule.base', 'search for members')]); ?>
                    <?= Html::submitButton(Yii::t('DirectoryModule.base', 'Search'), ['class' => 'btn btn-default btn-sm form-button-search']); ?>
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
                    <div class="pull-right memberActions">
                        <?= MemberActionsButton::widget(['producer' => $producer]); ?>
                    </div>

                    <?= Image::widget(['producer' => $user, 'htmlOptions' => ['class' => 'pull-left']]); ?>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="<?= $producer->getUrl(); ?>"><?= Html::encode($producer->displayName); ?></a>                            
                        </h4>
                        <h5><?= Html::encode($producer->title); ?></h5>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

<div class="pagination-container">
    <?= \humhub\widgets\LinkPager::widget(['pagination' => $pagination]); ?>
</div>
