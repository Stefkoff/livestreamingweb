<?php

use yii\db\Schema;
use yii\db\Migration;

class m160224_214853_CREATE_TABLE_event extends Migration
{
    public function up()
    {
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'datetime' => $this->dateTime()->notNull(),
            'date_added' => $this->timestamp(),
            'place' => $this->string(45)->notNull(),
            'on_air' => $this->integer(1)->defaultValue(0),
            'id_server' => $this->integer(11)->notNull(),
        ]);

        $this->addForeignKey('fk_event_server', 'event', 'id_server', 'server', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk_event_server', 'event');
        $this->dropTable('event');
    }
}
