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

    public function getQuery(string $name, $defaultValue = null)
    {
        if (isset($this->getParams[$name])) {
            return $this->getParams[$name];
        }
        return $defaultValue;
    }

    public function getPost(string $name, $defaultValue = null)
    {
        if (isset($this->postParams[$name])) {
            return $this->postParams[$name];
        }
        return $defaultValue;
    }

    public function getUploadedFiles(string $name, $defaultValue = null)
    {
        if (isset($_FILES[$name])) {
            return $_FILES[$name];
        }
        return $defaultValue;
    }

    public function view($viewName, $data = [])
    {
        $dir = 'views/';
        $filename = $dir . $viewName . '.html';
        if (!file_exists($filename)) {
            require $dir . 'NotFound.html';
        } else {
            require $filename;
        }
    }

    public function sendResponse(int $code, string $message, $data = [])
    {
        http_response_code($code);
        $data = [
            'status' => $code,
            'message' => $message,
            'data' => $data
        ];
        echo json_encode($data);
    }
}