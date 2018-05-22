<?php

namespace humhub\modules\producer\widgets;

/**
 * HumHub
 * Copyright © 2014 The HumHub Project
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 */
use Yii;

/**
 * ProfileEditButtonWidget
 *
 * @author luke
 * @package humhub.modules_core.user.widgets
 * @since 0.11
 */
class ProfileEditButton extends \yii\base\Widget {

    public $user;
    public $producer;

    public function run() {
        if (Yii::$app->user->isGuest || !$this->producer->isProducerOwner($this->user->id)) {
            return;
        }

        $render = $this->render('profileEditButton', array('producer' => $this->producer));
        return $render;
    }

}
