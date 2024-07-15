<?php

use app\core\Application;
use app\core\Migration;

class M0001_initial extends Migration
{
    public function up()
    {
        $database = Application::$app->database;
        $query = "CREATE TABLE users(
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            email VARCHAR(30) NOT NULL UNIQUE,
            pwd VARCHAR(30) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $statement = $database->pdo->prepare($query);
        $statement->execute();

    }
    public function down()
    {
        $database = Application::$app->database;
        $query = "DROP TABLE users;";
        $statement = $database->pdo->prepare($query);
        $statement->execute();
    }
}