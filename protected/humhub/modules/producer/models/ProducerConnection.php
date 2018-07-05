<?php

namespace humhub\modules\producer\models;
use Yii;
use humhub\modules\content\components\ContentContainerActiveRecord;
use humhub\modules\user\models\User;

/**
 * This is the model class for table "producer".

 * @property integer $id
 * @property string $name
 * @property integer $producer_id
 * @property integer $origin_channel_id
 * @property integer $origin_producer_id
 * @property integer $when_property
 * @property string $condition_sign
 * @property string $condition_value
 * @property string $created_at
 * @property string $updated_at
 * @property integer $then_id
 * @property string $post_content
 * @property integer $post_channel_id
 */
class ProducerConnection extends \yii\db\ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producer_connection';
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
        ];
    }
    
    public function getConditionSignFormOptions() {
        $form_options = [];
        $form_options['1'] = 'is greater than';
        $form_options['2'] = 'is less than';
        $form_options['3'] = 'is equal to';
        
        return $form_options;
    }
    
    public function getThenFormOptions() {
        $form_options = [];
        $form_options['1'] = 'Make a social post';
        $form_options['2'] = 'Call this producer channel';
        
        return $form_options;
    }
    
}