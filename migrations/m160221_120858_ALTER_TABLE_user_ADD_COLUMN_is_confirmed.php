<?php

use yii\db\Schema;
use yii\db\Migration;

class m160221_120858_ALTER_TABLE_user_ADD_COLUMN_is_confirmed extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'is_confirmed', $this->integer(1));
    }

    public function down()
    {
        $this->dropColumn('user', 'is_confirmed');
    }
}
