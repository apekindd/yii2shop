<?php

use yii\db\Migration;

class m161012_174711_create_table_user extends Migration
{
    public function up()
    {
        $this->createTable('user', array(
            'id' =>  $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'password' => $this->string(255)->notNull(),
            'auth_key' => $this->string(255)
        ));
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
