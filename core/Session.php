<?php

namespace app\core;

class Session
{
    public const string FLASH_KEY = "_flash";
    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY];
        echo "IM THE CONSTRUCTOR " . var_dump($flashMessages) ;
    }

    public static function set_flash(string $key, string $value): void
    {
        $_SESSION[self::FLASH_KEY][$key] = $value;
    }

    public static function get_flash(string $key): string|bool
    {
        return $_SESSION[self::FLASH_KEY][$key] ?? false;
    }
    public function __destruct()
    {
        echo  "DECONSTRUCTOR " . var_dump($_SESSION[self::FLASH_KEY]);
    }
}