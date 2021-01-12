<?php

namespace app\config;


class Config
{
    const CONFIG = [
        'APP_ROOT' => APP_ROOT,
        'URL_ROOT' => 'url_root',
        'SITE_NAME' => 'site_name',
        'DB_HOST' => '127.0.0.1',
        'DB_USERNAME' => 'root',
        'DB_PASSWORD' => 'root',
        'DB_NAME' => 'db_name',
    ];

    public function __construct()
    {
        foreach (self::CONFIG as $variableName => $value) {
            define($variableName, $value);
        }
    }
}

define('APP_ROOT', dirname(__FILE__, 2));
