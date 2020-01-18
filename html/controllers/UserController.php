<?php


namespace Controllers;


class UserController extends BaseController
{
    public function indexAction()
    {
        $data = [];
        $this->view('registration', $data);
    }

    public function registrationAction()
    {
        $this->view('registration');
    }

    public function createAction()
    {
        $this->view('user');
    }
}