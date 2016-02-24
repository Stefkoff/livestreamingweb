<?php

use yii\db\Schema;
use yii\db\Migration;

class m160224_205700_CREATE_TABLE_server extends Migration
{
    public function up()
    {
        $this->createTable('server', [
            'id' => $this->primaryKey(11),
            'host' => $this->string(45)->notNull(),
            'port' => $this->integer(5)->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('server');
    }
}
