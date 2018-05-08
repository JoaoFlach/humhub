<?php
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"
                id="myModalLabel"><?php echo Yii::t("ProducerModule.views_producer_latest_data", "Latest data"); ?></h4>
        </div>
        <div class="modal-body">
            <?php echo $response; ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo Yii::t('ProducerModule.views_producer_latest_data', 'Close'); ?></button>
        </div>

        
    </div>

</div>


<script type="text/javascript">
    // set focus to input for space name
    $('#recipient').focus();
</script>