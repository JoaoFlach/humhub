<?php

use yii\helpers\Html;
?>
<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" 
                    aria-hidden="true">&times;</button>
            <h4 class="modal-title"
                id="myModalLabel">
                    <?php echo Yii::t("ProducerModule.views_producer_add_channel", "Edit Channel");
                    ?></h4>
        </div>

        <form method="post" action="/humhub/producer/rest/save-channel">
            <div class="modal-body">
                <div class="form-group">
                    <label>Channel name</label>
                    <?= Html::input('text', 'name', $channel->name, ['class' => 'form-control'])
                    ?>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <?=
                    Html::input('text', 'internet_address', $channel->internet_address, ['class' => 'form-control'])
                    ?>
                </div>

                <div class="form-group">
                    <label >Http Method</label>
                    <?=
                    Html::dropDownList('http_method', $channel->http_method, ["GET" => "GET", "POST" => "POST"], ['class' => 'form-control'])
                    ?>

                    <?= Html::input('hidden', 'producer_id', $channel->producer_id) ?>
                    <?= Html::input('hidden', 'id', $channel->id) ?>
                </div>

                <label>Properties</label>
                <hr>
                <div id='channel-properties'>
                    <?php $index = 1 ?>
                    <?php foreach ($channel_properties as $cp) : ?>
                        <div class="form-group" id='channel-property-<?= $index ?>'>
                            <?= Html::input('hidden', 'property['.$index.'][id]', $cp->id) ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                    <input type='text' 
                                           name='property[<?= $index ?>][name]' 
                                           class='form-control'
                                           value='<?= $cp->property_name ?>'/>
                                </div>
                                <div class="col-md-6">
                                    <label>Type</label>
                                    <?=
                                    Html::dropDownList('property['.$index.'][type]', $cp->type, ["Number" => 'Number',
                                        "Text" => 'Text',
                                        "Boolean" => 'Boolean'], ["class" => "form-control"])
                                    ?>
                                    <button type="button" class="btn btn-danger btn-sm pull-right" id='<?= $index ?>'
                                            onclick="removeProperty(this)">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </div>                            
                            </div>                    
                        </div>
                        <?php $index++ ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="modal-footer">
                <?=
                Html::button('Close', ['class' => 'btn btn-primary',
                    'data-dismiss' => 'modal'])
                ?>
                <button type="button" class="btn btn-success" onclick="addProperty()"><?php echo 'Add property'; ?></button>
                <?=
                Html::input('submit', '', 'Save', ['class' =>
                    'btn btn-info'])
                ?>
            </div>
        </form>

    </div>

</div>


<script type="text/javascript">
    // set focus to input for space name
    $('#recipient').focus();
    function propertyFormGroup(id) {
        var new_channelprop_id = "channel-property-" + id;
        return "" +
                "<div class='form-group' id=" + new_channelprop_id + ">" +
                "<input type='hidden' name='property["+ id +"][id]' value=''>" +
                "<div class='row'>" +
                "<div class='col-md-6'>" +
                "<label>Name</label>" +
                "<input type='text' name='property[" + id + "][name]' class='form-control'/> " +
                "</div>" +
                "<div class='col-md-6'>" +
                "<label>Type</label>" +
                "<select class='form-control' name='property[" + id + "][type]'>" +
                "<option value='Number'>Number</option>" +
                "<option value='Text'>Text</option>" +
                "<option value='Boolean'>Boolean</option>" +
                "</select>" +
                "<button type='button' class='btn btn-danger btn-sm pull-right' id='" + id + "'" +
                "onclick='removeProperty(this)'>" +
                "<span class='glyphicon glyphicon-trash'></span>" +
                "</button>" +
                "</div>" +
                "</div>" +
                "</div>";
    }

    function addProperty() {
        var channel_properties = $('#channel-properties .form-group');
        var last_channel_property = channel_properties.last();
        var last_channelprop_id = last_channel_property.attr('id');
        var index = last_channelprop_id.lastIndexOf('-');
        var length = last_channelprop_id.length;
        var counter = last_channelprop_id.substring(index + 1, length);
        counter = parseInt(counter);
        counter = counter + 1;

        last_channel_property.after(propertyFormGroup(counter));
    }

    function removeProperty(event) {
        var channel_properties = $('#channel-properties .form-group');
        if (channel_properties.length > 1) {
            var id = event.getAttribute('id');
            var channel_property = $("#channel-property-" + id);
            channel_property.remove();
        }
    }


</script>