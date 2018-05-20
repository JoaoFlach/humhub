<?php
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
                <label for="producerChannelHttpMethod">Channel name</label>
                <input type='text' name='name' class='form-control'/>
                
                <label for="producerChannelHttpMethod">Http Method</label>
                <select class="form-control" name="http_method" id="producerChannelHttpMethod">
                    <option value="GET">GET</option>
                    <option value="POST">POST</option>
                </select>
                
                <label for="producerChannelHttpMethod">Address</label>
                <input type='text' name='internet_address' class='form-control'/>
                
                <input type="hidden" name="producer_id" value="<?php echo $producer_id ?>"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo Yii::t('ProducerModule.views_producer_add_channel', 'Close'); ?></button>
                <input type="submit" class="btn btn-info" value="<?php echo Yii::t('ProducerModule.views_producer_add_channel', 'Save'); ?>"/>
            </div>
        </form>
        
    </div>

</div>


<script type="text/javascript">
    // set focus to input for space name
    $('#recipient').focus();
</script>