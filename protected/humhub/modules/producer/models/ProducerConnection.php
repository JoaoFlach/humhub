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
 * @property string $when_property
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
}