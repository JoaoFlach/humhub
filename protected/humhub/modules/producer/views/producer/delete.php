<?php 
use yii\helpers\Html;
?>
<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"
                id="myModalLabel"><?php echo Yii::t("ProducerModule.views_producer_add_channel", "Delete Producer"); ?></h4>
        </div>

        <form method="post" action="/humhub/producer/rest/delete-producer">
            <div class="modal-body">
                Are you sure of this action?
                <?= Html::input('hidden', 'id', $id) ?>
            </div>
            <div class="modal-footer">
                <?= Html::button('No', ['class' => 'btn', 'data-dismiss'=> 'modal']) ?>
                <?= Html::input('submit', '', 'Yes', ['class' => 'btn btn-info']) ?>
            </div>
        </form>

    </div>

</div>

<script type="text/javascript">
    // set focus to input for space name
    $('#recipient').focus();
</script>