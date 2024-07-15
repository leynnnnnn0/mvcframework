<?php

use app\core\Application;
use app\core\Migration;

class M0003_change_column_name_pwd_to_password extends Migration
{
    public function up()
    {
        $db = Application::$app->database->pdo;
        $query = "ALTER TABLE users CHANGE pwd password VARCHAR(255) NOT NULL";
        $db->exec($query);
    }

    public function down()
    {
        echo "REMOVE FROM DATABASE...\n";
    }
}