<?php

namespace humhub\modules\producer\models;
use Yii;
use humhub\modules\content\components\ContentContainerActiveRecord;

/**
 * This is the model class for table "producer".

 * @property integer $id
 * @property string $guid
 * @property string $name
 * @property string $tags
 * @property string $internet_address
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $country
 * @property string $location
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
            'Internet_Address' => 'Internet Address',
        ];
    }
    
    public function getUrl(){
        return "/humhub/producer/profile/".$this->id;
    }
}