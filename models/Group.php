<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property string $name
 *
 * @property GroupMember[] $groupMembers
 */
class Group extends \yii\db\ActiveRecord
{

    const GROUP_ADMIN = '/level/admin';
    const GROUP_MODELRATOR = '/level/moderator';
    const GROUP_USER = '/level/user';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45]
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupMembers()
    {
        return $this->hasMany(GroupMember::className(), ['id_group' => 'id']);
    }

    public static function getGroupsArray(){
        $groups = self::find()->all();

        $result = array();

        foreach($groups as $group){
            $result[$group->id] = ucfirst(str_replace('/level/', '', $group->name));
        }

        return $result;
    }
}
