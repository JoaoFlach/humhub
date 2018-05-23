<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
?>
<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" 
                    aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">
                Make a connection
            </h4>
        </div>

        <form id="connectForm" action="/humhub/producer/rest/save-producer" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-group">
                        <label class="control-label">Select an origin</label>
                        <?=
                        Html::dropDownList('origin', null, $origin_select_items, ['class' => 'form-control'])
                        ?>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <?=
                Html::button('Close', ['class' => 'btn btn-primary',
                    'data-dismiss' => 'modal'])
                ?>
                <?= Html::input('submit', '', 'Save', ['class' => 'btn btn-info']) ?>
            </div>
        </form>

    </div>

</div>