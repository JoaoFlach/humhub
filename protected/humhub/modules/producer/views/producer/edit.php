<?php
use yii\helpers\Html;
use humhub\modules\user\models\fieldtype\CountrySelect;
?>
<div class="modal-dialog">
    <div class="modal-content">
        
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" 
                    aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">
                Edit Producer
            </h4>
        </div>

        <form method="post" action="/humhub/producer/rest/save-producer">
            <div class="modal-body">
                <div class="form-group">
                    <label>Producer name</label>
                    <?= Html::input('text', 'name', $producer->name, 
                        ['class' => 'form-control']) ?>
                </div>
                
                <div class="form-group">
                    <label>Tags</label>
                    <?= Html::input('text', 'tags', $producer->tags, 
                        ['class' => 'form-control']) ?>
                </div>
                
                <div class="form-group">
                    <label>Country</label>               
                    <?= Html::dropDownList('country', $producer->country, 
                            $countries, 
                            ['class' => 'form-control']) ?>

                    <?= Html::input('hidden', 'id', $producer->id) ?>
                </div>
            </div>
            <div class="modal-footer">
                <?= Html::button('Close', ['class' => 'btn btn-primary', 
                    'data-dismiss' => 'modal']) ?>
                <?= Html::input('submit', '', 'Save', ['class' => 'btn btn-info', 
                    'data-dismiss' => 'modal']) ?>
            </div>
        </form>
        
    </div>

</div>