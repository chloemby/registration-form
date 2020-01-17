<?php


namespace Controllers;


abstract class BaseController
{
    private $getParams = [];
    private $postParams = [];

    public function __construct($getParams, $postParams)
    {
        $this->getParams = $getParams;
        $this->postParams = $postParams;
    }

    public function getQuery()
    {
        return $this->getParams;
    }

    public function getPost()
    {
        return $this->postParams;
    }

    public function view($viewName)
    {
        $dir = 'views/';
        $filename = $dir . $viewName . '.html';
        if (!file_exists($filename)) {
            include $dir . 'NotFound.html';
        } else {
            include $filename;
        }

    }
}