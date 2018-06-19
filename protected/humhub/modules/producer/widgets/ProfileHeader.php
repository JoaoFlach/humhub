<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\producer\widgets;

use Yii;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use humhub\modules\space\models\Membership;
use humhub\modules\friendship\models\Friendship;
use humhub\modules\user\controllers\ImageController;
use humhub\modules\producer\models\Producer;

/**
 * Displays the profile header of a user
 * 
 * @since 0.5
 * @author Luke
 */
class ProfileHeader extends \yii\base\Widget
{

    /**
     * @var Producer
     */
    public $producer;
    
    /**
     * @var $connections
     */
    public $connections;

    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('profileHeader', array(
                    'producer' => $this->producer,
                    'isProfileOwner' => true,
                    'friendshipsEnabled' => false,
                    'followingEnabled' => true,
                    'connections' => $this->connections,                    
                    'allowModifyProfileImage' => false,
                    'allowModifyProfileBanner' => false,
        ));
    }

    /**
     * Returns the number of followed public space
     * 
     * @return int the follow count
     */
    protected function getFollowingSpaceCount()
    {
        return Membership::getUserSpaceQuery($this->user)
                        ->andWhere(['!=', 'space.visibility', Space::VISIBILITY_NONE])
                        ->andWhere(['space.status' => Space::STATUS_ENABLED])
                        ->count();
    }

}

?>
