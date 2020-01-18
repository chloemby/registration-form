<?php


namespace App;

use mysqli;

require 'vendor/autoload.php';

$config = parse_ini_file('config.ini');
$db = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);

$request = $_SERVER['REQUEST_URI'];
$request = str_replace('.html', '', $request);
$router = new Router($request);
$router->delegate();


