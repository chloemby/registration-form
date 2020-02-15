<?php


namespace Models;

use mysqli;
use Exception;

class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        try {
            $config = Config::$config;
            if (!self::$connection) {
                self::$connection = new mysqli($config['host'], $config['username'], $config['password']);
                self::$connection->select_db('application');
                if (self::$connection->error || self::$connection->connect_error) {
                    throw new Exception('Database error', 500);
                }
                return self::$connection;
            }
            return self::$connection;
        } catch (Exception $e) {
            return false;
        }
    }
}