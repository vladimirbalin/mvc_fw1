<?php

namespace app\config;


class Config
{
    const CONFIG = [
        'SITE_NAME' => 'Blog app',
        'URL_ROOT' => 'http://mvc.fw1',
        'DB_HOST' => '127.0.0.1',
        'DB_USERNAME' => 'root',
        'DB_PASSWORD' => 'root',
        'DB_NAME' => 'shareposts',
    ];

    public function __construct()
    {
        foreach (self::CONFIG as $variableName => $value) {
            define($variableName, $value);
        }
    }
}

define('APP_ROOT', dirname(dirname(__FILE__)));
