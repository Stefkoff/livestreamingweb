<?php

use yii\db\Schema;
use yii\db\Migration;

class m160217_072343_ALTER_TABLE_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'creation_date', $this->dateTime()->notNull());
        $this->addColumn('user', 'last_login_date', $this->dateTime());
        $this->addColumn('user', 'last_login_ip', $this->string(25));
    }

    public function down()
    {
        $this->dropColumn('user', 'creation_date');
        $this->dropColumn('user', 'last_login_date');
        $this->dropColumn('user', 'last_login_ip');
    }
}
