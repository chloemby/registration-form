<?php


namespace App;

use Exception;
use Models\Model;
use mysqli_sql_exception;

class Router
{
    private $path;

    public function __construct($request)
    {
        $this->path = $request;
    }

    public function delegate()
    {
        try {
            $pattern = '/(rus|eng)\.json/';
            if (preg_match($pattern, $this->path, $matches)) {
                $file = file_get_contents('views/js/' . $matches[0]);
                echo $file;
            } else {
                $pattern = '/^\/?(\w+)[\?\/]?(\w+)?\??$/';
                preg_match_all($pattern, $this->path, $matches);
                $controller = $matches[1][0] ? ucfirst($matches[1][0]) : 'Index';
                $controller .= 'Controller';
                $action = $matches[2][0] ? $matches[2][0] : 'index';
                $action .= 'Action';
                $file = 'controllers/' . $controller . '.php';
                if (file_exists($file)) {
                    $namespace = "Controllers\\";
                    $className = $namespace . $controller;
                    $controller = new $className($_GET, $_POST);
                    if (!is_callable([$controller, $action])) {
                        throw new Exception('Not found ' . $action . " in $className" , 400);
                    }
                    $model = Model::initConnection();
                    if ($model === false) {
                        throw new Exception('Database error', 500);
                    }
                    $controller->$action();
                }
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            require 'views/error.html';
        }
    }



}