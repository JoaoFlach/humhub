<?php
?>
<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" action="/humhub/producer/rest/channel">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"
                    id="myModalLabel"><?php echo Yii::t("ProducerModule.views_producer_add_channel", "Add Channel"); ?></h4>
            </div>

            <div class="modal-body">                
                <select name="http_method">
                    <option value="GET">GET</option>
                    <option value="POST">POST</option>
                </select>
                <input type='text' name='internet_address' class='form-control'/>
                <input type="hidden" name="producer_id" value="<?php echo $producer->id ?>"/>
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