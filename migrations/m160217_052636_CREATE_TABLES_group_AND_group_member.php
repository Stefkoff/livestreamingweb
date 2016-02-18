<?php

use yii\db\Schema;
use yii\db\Migration;

class m160217_052636_CREATE_TABLES_group_AND_group_member extends Migration
{
    public function up()
    {
        $this->createTable('group', [
            'id' => $this->primaryKey(11),
            'name' => $this->string(45)->notNull(),
        ]);

        $this->createTable('group_member', [
            'id' => $this->primaryKey(11),
            'id_group' => $this->integer(11),
            'id_user' => $this->integer(11)
        ]);

        $this->addForeignKey('fk_group_gm', 'group_member', 'id_group', 'group', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_user_gm', 'group_member', 'id_user', 'user', 'id', 'CASCADE', 'CASCADE');

        $this->insert('group', [
            'name' => '/level/admin'
        ]);

        $groupId = Yii::$app->db->lastInsertID;

        $this->insert('group', [
            'name' => '/level/moderator'
        ]);

        $this->insert('group', [
            'name' => '/level/user'
        ]);

        $this->insert('user', [
            'username' => 'admin',
            'email' => 'admin@live.com',
            'password' => Yii::$app->security->generatePasswordHash('admin'),
            'authKey' => Yii::$app->security->generateRandomString()
        ]);

        $userId = Yii::$app->db->lastInsertID;

        $this->insert('group_member', [
            'id_group' => $groupId,
            'id_user' => $userId
        ]);
    }

    public function down()
    {
        $this->dropForeignKey('fk_group_gm', 'group_member');
        $this->dropForeignKey('fk_user_gm', 'group_member');
        $this->dropTable('group');
        $this->dropTable('group_member');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
