<?php


namespace Models;

use mysqli;

class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        $config = Config::$config;
        if (!self::$connection) {
            self::$connection = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
            return self::$connection;
        }
        return self::$connection;
    }
}