<?php

namespace App\config;

class Config
{
    private static array $config = [];

    public static function get(string $key, $default = null)
    {
        if (!self::$config) {
            $global = require __DIR__ . '/main.php';
            $local = is_file(__DIR__ . '/main-local.php')
                ? require __DIR__ . '/main-local.php' : [];
            self::$config = array_merge($global, $local);
        }
        return self::$config[$key] ?? $default;
    }
}