<?php

use yii\helpers\Html;
?>
<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"
                id="myModalLabel"><?php echo Yii::t("ProducerModule.views_producer_add_channel", "Add Channel"); ?></h4>
        </div>

        <form method="post" action="/humhub/producer/rest/save-channel">
            <div class="modal-body">
                <div class="form-group">
                    <label for="producerChannelHttpMethod">Channel name</label>
                    <input type='text' name='name' class='form-control'/>
                </div>

                <div class="form-group">
                    <label for="producerChannelHttpMethod">Http Method</label>
                    <select class="form-control" name="http_method" id="producerChannelHttpMethod">
                        <option value="GET">GET</option>
                        <option value="POST">POST</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="producerChannelHttpMethod">Address</label>
                    <input type='text' name='internet_address' class='form-control'/>
                </div>

                <label>Properties</label>
                <hr>

                <div id='channel-properties'>
                    <div class="form-group" id='channel-property-1'>
                        <input type='hidden' name='property[1][id]' value=''>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                                <input type='text' name='property[1][name]' class='form-control'/>
                            </div>
                            <div class="col-md-6">
                                <label>Type</label>
                                <select class="form-control" name="property[1][type]">
                                    <option value="Number">Number</option>
                                    <option value="Text">Text</option>
                                    <option value="Boolean">Boolean</option>
                                </select>
                                <button type="button" class="btn btn-danger btn-sm pull-right" id='1'
                                        onclick="removeProperty(this)">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </div>                            
                        </div>                    
                    </div>
                </div>

                <input type="hidden" name="producer_id" value="<?php echo $producer_id ?>"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo Yii::t('ProducerModule.views_producer_add_channel', 'Close'); ?></button>
                <button type="button" class="btn btn-success" onclick="addProperty()"><?php echo 'Add property'; ?></button>
                <input type="submit" class="btn btn-info" value="<?php echo Yii::t('ProducerModule.views_producer_add_channel', 'Save'); ?>"/>
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
        "<div class='form-group' id="+new_channelprop_id+">" +
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
                    "<button type='button' class='btn btn-danger btn-sm pull-right' id='"+ id +"'" +
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
        var counter = last_channelprop_id.substring(index+1, length);
        counter = parseInt(counter);
        counter = counter+1;
        
        last_channel_property.after(propertyFormGroup(counter));
    }

    function removeProperty(event) {
        var channel_properties = $('#channel-properties .form-group');
        if(channel_properties.length > 1){
            var id = event.getAttribute('id');
            var channel_property = $("#channel-property-" + id);
            channel_property.remove();
        }
    }


</script>