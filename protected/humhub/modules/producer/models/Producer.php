<?php

namespace humhub\modules\producer\models;
use Yii;
use humhub\modules\content\components\ContentContainerActiveRecord;
use humhub\modules\user\models\User;

/**
 * This is the model class for table "producer".

 * @property integer $id
 * @property string $guid
 * @property string $name
 * @property string $tags
 * @property string $country
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $location
 * @property integer $contentcontainer_id
 */
class Producer extends ContentContainerActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'guid' => 'GUID',
        ];
    }
    
    public function getUrl(){
        return "/humhub/producer/profile/".$this->id;
    }
    
    /**
     * @return string
     */
    public function getProducerOwnerName()
    {
        $user = User::findOne(['id' => $this->user_id]);

        if ($user !== null && $user->isActive()) {
            return $user->getDisplayName();
        }

        return '';
    }
}