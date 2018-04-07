<?php

namespace humhub\modules\api\models;
use Yii;

/**
 * This is the model class for table "api_user".
 *
 * @property integer $id
 * @property string $ip
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
            [['ip'], 'string', 'max' => 16],
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
            'ip' => 'IP address',
            'port' => 'Port',
            'url' => 'URL',
            'active' => 'Active',
        ];
    }
}
