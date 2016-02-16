<?php

use yii\db\Schema;
use yii\db\Migration;

class m160216_083636_CREATE_USER_TABLE extends Migration
{
    public function up()
    {

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(45)->notNull(),
            'email' => $this->string(45)->notNull(),
            'password' => $this->string(255)->notNull(),
            'authKey' => $this->string(255)->notNull(),
            'accessToken' => $this->string(255)
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
