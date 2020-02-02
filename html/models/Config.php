<?php


namespace Models;


class Config
{
    public static $config = [];

    public function __construct()
    {
        self::$config = parse_ini_file('config.ini');
    }
}