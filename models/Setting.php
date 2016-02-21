<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\Json;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 */
class Setting extends \yii\db\ActiveRecord
{

    private static $allowedSettings = [
        'maintenance',
        'notifications',
        'show_panel_events',
        'stop_registrations',
        'send_confirmation_email'
    ];


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['name'], 'string', 'max' => 45],
            [['value'], 'string', 'max' => 255]
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
            'value' => 'Value',
        ];
    }

    /**
     * Save or update setting
     *
     * @param $param Setting name
     * @param $value Setting value
     * @return bool true|false
     */
    public static function set($param, $value){
        $existing = self::findOne([
            'name' => $param
        ]);

        if(in_array($param, self::$allowedSettings)) {
            if ($existing) {
                $existing->value = $value;

                return $existing->save();
            } else {
                $new = new Setting();
                $new->name = $param;
                $new->value = $value;

                return $new->save();
            }
        }
    }

    /**
     * Get value of setting
     *
     * @param $param Setting name
     * @param null $default Default return value
     * @return null|string Return setting (if not found, returns default)
     */
    public static function get($param, $default = null){
        if($param){
            $setting = self::findOne([
                'name' => $param
            ]);

            if($setting){
                return $setting->value;
            }

            return $default;
        }

        return $default;
    }

    public static function saveMultiple($data){
        if(!empty($data)){
            foreach($data as $key => $value){
                self::set($key, $value);
            }
        }
    }

    public static function getAll(){
        $command = new Query();
        $command->select('name, value')
            ->from(self::tableName());
        $data = $command->all();

        $result = [];

        if(!empty($data)){
            foreach($data as $item){
                $result[$item['name']] = $item['value'];
            }
        }

        return $result;
    }
}
