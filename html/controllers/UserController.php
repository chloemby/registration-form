<?php


namespace Controllers;


use Models\User;

use mysqli;

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
        $rows['password'] = $this->getPost('password');
        $rows['name'] = $this->getPost('name');
        $rows['surname'] = $this->getPost('surname');
        $rows['email'] = $this->getPost('email');
        $rows['image'] = $this->getUploadedFiles();
        $query = "insert into users (password, email, name, surname, image) values (?, ?, ?, ?, ?)";
        $user = new User();
        if ($user) {
            $this->view('user');
        } else {
            $this->view('error');
        }
    }
}