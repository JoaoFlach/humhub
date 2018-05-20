<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
?>
<div>
    <h2>Create a producer</h2>

    <form id="createProducerForm" action="/humhub/producer/rest/save-producer" method="post">
        <div class="form-group">
            <div class="form-group">
                <label class="control-label">Name</label>
                <input class="form-control is-invalid" type="text" name="name" required/>
            </div>

            <div class="form-group">
                <label class="control-label">Tags</label>
                <input class="form-control" type="" name="tags" />
            </div>

            <label class="control-label">Country</label>
            <div class="form-group">
                <?=
                Html::dropDownList('country', 'BR', 
                        $countries, ['class' => 'form-control'])
                ?>
            </div>

        </div>
        <?= Html::input('submit', '', 'Save', ['class' => 'btn btn-primary']) ?>
    </form>    
</div>
