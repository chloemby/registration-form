<?php


namespace Controllers;


class ErrorController extends BaseController
{
    public function IndexAction()
    {
        $this->view('error');
    }
}