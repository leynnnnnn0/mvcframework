<?php

namespace app\core;
use PDO;

class Database
{
    public PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'];
        $user = $config['user'];
        $password = $config['password'];
        $this->pdo = new PDO($dsn, $user, $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
    public function addMigrations(): void
    {
        // Creating migration table if not exist
        $this->initializeMigrationsTable();
        // Getting the existing migrations
        $existingMigrations = $this->getMigrations();
        // Getting the files from migrations directory
        $migrationFiles = scandir(Application::$ROOT_PATH.'/migrations');
        // filter the files to know what are the files that has not been migrated
        $newMigrations = array_diff($migrationFiles, $existingMigrations);
        $migrationsToAdd = [];
        foreach($newMigrations as $migration) {
            if($migration === '.' || $migration === '..') continue;
            require_once Application::$ROOT_PATH . '/migrations/'.$migration;
            // Getting the file name
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $migrationsToAdd[] = $migration;
            // Creating an instance of the class to be able to use the function inside
            $instance = new $className();
            $this->log("executing migration");
            $instance->up();
            $this->log("added migration");
        }
        if(empty($migrationsToAdd)) {
            $this->log("no migrations to add");
            return;
        }
        $this->saveMigration($migrationsToAdd);
        $this->log("Migration saved");

    }
    public function initializeMigrationsTable(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(
            id INT AUTO_INCREMENT PRIMARY KEY, 
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
    }

    public function getMigrations(): array
    {
        $query = "SELECT migration FROM migrations";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigration(array $migrations): void
    {
        $migrations = implode(",", array_map(fn($fileName) => "('$fileName')", $migrations));
        $query = "INSERT INTO migrations(migration) VALUES $migrations";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }

    public function log($message)
    {
        echo $message . PHP_EOL;
    }

    public function prepare($query)
    {
        return $this->pdo->prepare($query);
    }

}