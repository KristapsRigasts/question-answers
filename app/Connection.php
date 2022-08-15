<?php

namespace App;

use Doctrine\DBAL\DriverManager;

class Connection
{
    private static $connection = null;
    public static function connection()
    {
        if (self::$connection === null) {
            $connectionParams = [
                'dbname' => 'questions_answers',
                'user' => '###',
                'password' => '###',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            ];
            self::$connection = DriverManager::getConnection($connectionParams);

        }
        return self::$connection;
    }
}