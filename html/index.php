<?php


namespace App;

use Models\Config;
use Exception;


require 'vendor/autoload.php';
$config = new Config();
$request = $_SERVER['REQUEST_URI'];
$request = str_replace('.html', '', $request);
$router = new Router($request);
try {
    $router->delegate();
} catch (Exception $e) {
    $response = [
        'status' => $e->getCode(),
        'message' => $e->getMessage()
    ];
    echo json_encode($response);
}
