<?php

namespace humhub\modules\producer\models;

/**
 * This is the model class for table "producer_channel". 
 * @property integer $id
 * @property string $guid
 * @property string $http_method
 * @property string $name
 * @property string $internet_address
 * @property string $payload_schema
 * @property integer $producer_id
 * 
 */
class ProducerChannel extends \yii\db\ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producer_channel';
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
            'http_method' => 'HTTP Method',
            'guid' => 'GUID',
            'Internet_Address' => 'Internet Address',
            'name' => 'name'
        ];
    }
}