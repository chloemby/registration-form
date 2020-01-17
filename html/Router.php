<?php


namespace App;

use Exception;

class Router
{
    private $path;

    public function __construct($request)
    {
        $this->path = $request;
    }

    public function delegate()
    {
        $pattern = '/^\/(\w+)\/(\w+)$/';
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
                throw new Exception('Not found');
            }
            $controller->$action();
        }
    }



}