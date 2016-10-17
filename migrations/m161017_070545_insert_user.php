<?php

use yii\db\Migration;

class m161017_070545_insert_user extends Migration
{
    public function up()
    {
        $this->insert('user', [
            'id' => 1,
            'username' => 'admin',
            'password' => '$2y$13$setLk8BqoU5mmp9rbxUqW.9o/aUCs1T9A4MSEEKGwtlJ9nbPZHsXG',
        ]);
    }

    public function down()
    {
        $this->delete('user', ['id' => 1]);
    }

}
