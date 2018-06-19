<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use kartik\widgets\DepDrop;
use \yii\helpers\Url;
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

        <form id="connectForm" action="/humhub/producer/rest/save-producer-connection" method="post">
            <?= Html::input('hidden', 'connection[id]', $connection->id) ?>
            <?= Html::input('hidden', 'connection[producer_id]', $producer->id) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label">Name this connection</label>
                    <?= Html::input('text', 'connection[name]', $connection->name, ['class' => 'form-control'])
                    ?>
                </div>

                <div class="form-group">
                    <label class="control-label">Select an origin</label>
                    <?=
                    Html::dropDownList('connection[origin_producer_id]', $connection->producer_id, $origin_select_items, ['class' => 'form-control',
                        'id' => 'origin'])
                    ?>  


                </div>
                <div class="form-group">
                    <label class="control-label">Select a channel</label>
                    <?=
                    DepDrop::widget([
                        'name' => 'connection[origin_channel_id]',
                        'options' => ["id" => "origin-channels"],
                        'pluginOptions' => [
                            'depends' => ['origin'],
                            'placeholder' => 'Select a origin first',
                            'url' => $producer->createUrl(
                                    '/producer/channel/select-items', ['selected' => $connection->origin_channel_id])
                        ]
                    ])
                    ?>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>When</label>
                            <?=
                            DepDrop::widget([
                                'name' => 'connection[when_property]',
                                'options' => ["id" => "origin-channel-properties"],
                                'pluginOptions' => [
                                    'depends' => ['origin-channels'],
                                    'placeholder' => 'Select a channel first',
                                    'url' => Url::to('/humhub/producer/channel/channel-properties', true)
                                ]
                            ])
                            ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Condition</label>
                            <select class="form-control" name="connection[condition_sign]" >
                                <option value="1">is greater than</option>
                                <option value="2">is less than</option>
                                <option value="3">is equal to</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Value</label>
                            <input type="text" name="connection[condition_value]" class="form-control"/>
                        </div>                            
                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label">Then</label>
                    <select class="form-control" name="connection[then_id]" 
                            onchange="changeSelectFieldThen(this.value);">
                        <option value="1">Make a social post</option>
                        <option value="2">Call an actuator channel</option>
                    </select>
                </div>

                <div class="form-group then_group" id="make_social_post_textarea">
                    <label class="control-label">Social Post Content</label>
                    <textarea class="form-control" name="connection[social_post_content]"></textarea>
                </div>

                <div class="form-group then_group" id="actuator_channel_configuration" hidden>
                    <label class="control-label">Actuator channel configuration</label>
                    <?=
                    Html::dropDownList('connection[post_channel_id]', '', $channel_select_items, ['class' => 'form-control',
                        'id' => 'origin'])
                    ?>  
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
<script type="text/javascript">
    function changeSelectFieldThen(value) {
        var then_group = $('.then_group');
        then_group.hide();

        if (value == 1) {
            $('#make_social_post_textarea').show();
        }

        if (value == 2) {
            $('#actuator_channel_configuration').show();
        }
    }

</script>