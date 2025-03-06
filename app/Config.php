<?php

declare(strict_types=1);

namespace App\PhpSSE;

class Config
{
    public static function make(): Config
    {
        return new Config();
    }

    public function getConfig()
    {
        $config = dirname(__DIR__, 2) . '/config/phpsse.php';
        if(file_exists($config)) {
            return require $config;
        }
        $config = dirname(__DIR__, 3) . '/config/phpsse.php';
        if(file_exists($config)) {
            return require $config;
        }
    }
}
