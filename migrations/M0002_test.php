<?php

use app\core\Migration;

class M0002_test extends Migration
{
    public function up()
    {
        echo "INSERTING TO DATABASE...\n";
    }
    public function down()
    {
        echo "REMOVE FROM DATABASE...\n";
    }
}