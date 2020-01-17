<?php


namespace Models;


abstract class Model
{
    static private $databaseName = 'appDb';
    static private $tableName = '';

    public static function say()
    {
        echo 'sqy';
    }

}