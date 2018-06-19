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
                Connections List
            </h4>
        </div>

        <div class="modal-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Connection name
                        </th>
                        <th>
                            Updated at
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($connections as $connection) : ?>

                        <tr>
                            <td>
                                <?= $connection->name ?>
                            </td>
                            <td>
                                <?= $connection->updated_at ?>
                            </td>                            
                            <td>
                                <?=
                                Html::a('Edit', ['/producer/producer/connect',
                                    'connection_id' => $connection->id], ['class' => 'btn btn-danger btn-sm',
                                    'data-target' => '#globalModal']);
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

        <div class="modal-footer">
            <?=
            Html::button('Close', ['class' => 'btn btn-primary',
                'data-dismiss' => 'modal'])
            ?>
        </div>

    </div>

</div>
<script type="text/javascript">

</script>