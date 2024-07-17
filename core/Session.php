<?php

namespace app\core;

class Session
{
    public const string FLASH_KEY = "_flash";
    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMessages as $key => &$flashMessageDetails) {
            if(!$flashMessageDetails['remove'])
            {
                $flashMessageDetails['remove'] = true;
            }
        };
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public static function set_flash(string $key, string $value): void
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'message' => $value,
            'remove' => false
        ];
    }

    public static function get_flash(string $key): string|bool
    {
        return $_SESSION[self::FLASH_KEY][$key]['message'] ?? false;
    }
    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => $flashMessageDetails) {
            if ($flashMessageDetails['remove']) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    public function get(string $string)
    {
        return $_SESSION[$string] ?? false;
    }
}