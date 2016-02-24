<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "server".
 *
 * @property integer $id
 * @property string $host
 * @property integer $port
 */
class Server extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'server';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['host', 'port'], 'required'],
            [['port'], 'integer'],
            [['host'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'host' => 'Host',
            'port' => 'Port',
        ];
    }

    public static function getServersArray(){
        $servers = self::find()->all();

        $result = array();

        foreach($servers as $server){
            /**
             * @var $server Server
             */
            $result[$server->id] = $server->host . ':' . $server->port;
        }

        return $result;
    }
}
