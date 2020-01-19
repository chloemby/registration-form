<?php


namespace App;

use Models\Config;
use Models\Model;
use mysqli;

require 'vendor/autoload.php';
phpinfo();
$config = new Config();
$request = $_SERVER['REQUEST_URI'];
$request = str_replace('.html', '', $request);
$router = new Router($request);
$router->delegate();

