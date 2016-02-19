<?php

use yii\db\Schema;
use yii\db\Migration;

class m160219_173505_CREATE_TABLE_setting extends Migration
{
    public function up()
    {
        $this->createTable('setting', array(
            'id' => $this->primaryKey(11),
            'name' => $this->string(45)->notNull(),
            'value' => $this->string(255)->notNull()
        ));
    }

    public function down()
    {
        $this->dropTable('setting');
    }
}
