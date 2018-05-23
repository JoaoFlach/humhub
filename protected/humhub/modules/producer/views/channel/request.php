<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
?>

<div class="modal-dialog">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"
                id="myModalLabel"><?php echo Yii::t("ProducerModule.views_producer_add_channel", $producer_name); ?></h4>
        </div>
        <div class="modal-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Property name
                        </th>
                        <th>
                            Current value
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($content as $key => $value) : ?>

                        <tr>
                            <td>
                                <?= $key ?>
                            </td>
                            <td>
                                <?= $value ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo Yii::t('ProducerModule.views_producer_add_channel', 'Close'); ?></button>
        </div>
    </div>
</div>
