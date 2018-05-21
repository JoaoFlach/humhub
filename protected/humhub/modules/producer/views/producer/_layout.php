<?php

use humhub\modules\producer\widgets\Menu;
use humhub\modules\producer\widgets\ProfileMenu;
use humhub\modules\producer\widgets\Sidebar;

\humhub\assets\JqueryKnobAsset::register($this);
?>

<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?= Menu::widget(); ?>
            <?php if(Yii::$app->controller->action->id == 'profile') :?>
                
            <?php endif; ?>
        </div>
        <div class="col-md-7">
            <?= $content; ?>
        </div>
        <div class="col-md-3">
            <?= Sidebar::widget(); ?>
        </div>
    </div>    
</div>
