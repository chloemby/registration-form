<?php


namespace Controllers;


abstract class BaseController
{
    private $getParams;
    private $postParams;

    public function __construct($getParams, $postParams)
    {
        $this->getParams = $getParams;
        $this->postParams = $postParams;
    }

    public function getQuery(string $name, $defaultValue = '')
    {
        if (isset($this->getParams[$name])) {
            return $this->getParams[$name];
        }
        return $defaultValue;
    }

    public function getPost(string $name, $defaultValue = '')
    {
        if (isset($this->postParams[$name])) {
            return $this->postParams[$name];
        }
        return $defaultValue;
    }

    public function getUploadedFiles()
    {
        $file = $_FILES['file'];
        var_dump($file);
        return null;
    }

    public function view($viewName, $data = [])
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