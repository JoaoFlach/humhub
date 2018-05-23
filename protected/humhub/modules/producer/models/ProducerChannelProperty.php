<?php

namespace humhub\modules\producer\models;
use Yii;
use humhub\modules\producer\models\ProducerChannel;

/**
 * This is the model class for table "producer".

 * @property integer $id
 * @property string $channel_id
 * @property string $property_name
 * @property string $type
 */
class ProducerChannelProperty extends \yii\db\ActiveRecord  
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producer_channel_property';
    }
    
    private $allowed_types = ['Number', 'Text', 'Boolean'];

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
        ];
    }    
   
    /**
     * @return ProducerChannel
     */
    public function getChannel()
    {
        $channel = ProducerChannel::findOne(['id' => $this->channel_id]);

        return $channel;
    }
    
    public function isValidType($type){
        return in_array($type, $this->allowed_types);
    }
   
}