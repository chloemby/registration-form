<?php


namespace Models;


abstract class Model
{
    private $allowedRows = [];
    private $tableName = '';
    protected static $connection = null;
    private $id = null;

    public function __construct()
    {
        if (!self::$connection) {
            self::$connection = Database::getConnection();
        }
    }

    public static function initConnection() {
        self::$connection = Database::getConnection();
    }
}