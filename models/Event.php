<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $datetime
 * @property string $date_added
 * @property string $place
 * @property integer $on_air
 * @property integer $id_server
 *
 * @property Server $server
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'datetime', 'place', 'id_server'], 'required'],
            [['description'], 'string'],
            [['datetime', 'date_added'], 'safe'],
            [['on_air', 'id_server'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['place'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'datetime' => 'Datetime',
            'date_added' => 'Date Added',
            'place' => 'Place',
            'on_air' => 'On Air',
            'id_server' => 'Id Server',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServer()
    {
        return $this->hasOne(Server::className(), ['id' => 'id_server']);
    }
}
