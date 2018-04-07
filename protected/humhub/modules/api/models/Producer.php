<?php

namespace humhub\modules\api\models;
use Yii;

/**
 * This is the model class for table "api_user".
 *
 * @property integer $id
 * @property string $ipv4_address
 * @property string $port
 * @property string $url
 * @property boolean $active
 */
class Producer extends \yii\db\ActiveRecord 
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
            [['active'], 'boolean'],
            [['ipv4_address'], 'string', 'max' => 16],
            [['url'], 'string', 'max' => 255],
            [['port'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ipv4_address' => 'IPv4 Address',
            'port' => 'Port',
            'url' => 'URL',
            'active' => 'Active',
        ];
    }
}
