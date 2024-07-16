<?php

namespace app\core;

abstract class DbModel extends Model
{
    // To get the name of the table to work with
    abstract public function tableName() : string;
    // To get the attributes/property that the table need
    abstract public function attributes() : array;
    public function insertAndSave(): bool
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($item) => ":$item", $attributes);
        $query = "INSERT INTO $tableName (".implode(',', $attributes).") VALUES (".implode(',', $params).")";
        $statement = Application::$app->database->prepare($query);
        foreach($attributes as $attribute)
        {
            if($attribute === 'password')
            {
                $hashedPassword = password_hash($this->{$attribute}, PASSWORD_BCRYPT);
                $statement->bindParam(":$attribute", $hashedPassword);
                continue;
            }
            $statement->bindParam(":$attribute", $this->{$attribute});
        }
        return $statement->execute();

    }


}