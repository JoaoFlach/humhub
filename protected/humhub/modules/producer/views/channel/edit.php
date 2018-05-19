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
                    <?php echo Yii::t("ProducerModule.views_producer_add_channel", 
                        "Edit Channel"); ?></h4>
        </div>

        <form method="post" action="/humhub/producer/rest/channel">
            <div class="modal-body">
                <label>Channel name</label>
                <?= Html::input('text', 'name', $channel->name, 
                        ['class' => 'form-control']) ?>
                
                <label>Address</label>
                <?= Html::input('text', 'internet_address', 
                        $channel->internet_address, ['class' => 'form-control']) ?>
                
                <label >Http Method</label>
                <?= Html::dropDownList('http_method', $channel->http_method, 
                        ["GET" => "GET", "POST" => "POST"], 
                        ['class' => 'form-control']) ?>
                
                <?= Html::input('hidden', 'producer_id', $channel->producer_id) ?>
                <?= Html::input('hidden', 'id', $channel->id) ?>
            </div>
            <div class="modal-footer">
                <?= Html::button('Close', ['class' => 'btn btn-primary', 
                    'data-dismiss' => 'modal']) ?>
                <?= Html::input('submit', '', 'Save', ['class' => 
                    'btn btn-info']) ?>
            </div>
        </form>
        
    </div>

</div>


<script type="text/javascript">
    // set focus to input for space name
    $('#recipient').focus();
</script>