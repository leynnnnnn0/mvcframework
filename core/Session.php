<?php

namespace app\core;

class Session
{
    public const string FLASH_KEY = "_flash";
    public function __construct()
    {
        session_start();
    }

    public static function set_flash(string $key, string $value): void
    {
        $_SESSION[self::FLASH_KEY][$key] = $value;
    }

    public static function get_flash(string $key): string|bool
    {
        return $_SESSION[self::FLASH_KEY][$key] ?? false;
    }
}