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
    
<div class="modal-dialog" id="modal-window">
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
                    <?= Html::input('text', 'connection[name]', $connection->name, 
                            ['class' => 'form-control',
                                ])
                    ?>
                </div>

                <div class="form-group">
                    <label class="control-label">Select an origin</label>
                    <?=
                    Html::dropDownList('connection[origin_producer_id]', 
                            $connection->origin_producer_id, 
                            $origin_select_items, 
                            ['class' => 'form-control', 'id' => 'origin'])
                    ?>
                </div>
                <div class="form-group">
                    <label class="control-label">Select a channel</label>
                    <?=
                    DepDrop::widget([
                        'name' => 'connection[origin_channel_id]',
                        'options' => ["id" => "origin-channels"],
                        'data' => [$origin_channel->id=>$origin_channel->name],
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
                                'data' => [$origin_channel_property->id=>$origin_channel_property->property_name],
                                'pluginOptions' => [
                                    'depends' => ['origin-channels'],
                                    'placeholder' => 'Select a channel first',
                                    'url' => $producer->createUrl(
                                            '/producer/channel/channel-properties', ['selected' => $connection->when_property]
                                    )
                                ]
                            ])
                            ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Condition</label>
                            
                            <?= Html::dropDownList('connection[condition_sign]', 
                                    $connection->condition_sign, 
                                    $connection->getConditionSignFormOptions(), 
                                    ['class' => 'form-control', 'id' => 'origin'])
                            ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Value</label>
                            <?= Html::input('text', 'connection[condition_value]', 
                                    $connection->condition_value, 
                                    ['class' => 'form-control'])
                            ?>
                        </div>                            
                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label">Then</label>
                    <?= Html::dropDownList('connection[then_id]', 
                                    $connection->then_id, 
                                    $connection->getThenFormOptions(), 
                                    ['class' => 'form-control', 
                                        'id' => 'then',
                                        'onchange'=>'changeSelectFieldThen(this.value);'])
                            ?>
                </div>

                <div class="form-group then_group" id="make_social_post_textarea">
                    <label class="control-label">Social Post Content</label>
                    <?= Html::textarea('connection[social_post_content]',                             
                                    $connection->post_content, 
                                    ['class' => 'form-control'])
                            ?>
                </div>

                <div class="form-group then_group" id="actuator_channel_configuration" hidden>
                    <label class="control-label">Actuator channel configuration</label>
                    <?=
                    Html::dropDownList('connection[post_channel_id]', 
                            $connection->post_channel_id, $channel_select_items, 
                            ['class' => 'form-control',
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
    
    var then = $('#then');
    changeSelectFieldThen(then.val())
</script>