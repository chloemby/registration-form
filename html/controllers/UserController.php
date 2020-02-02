<?php


namespace Controllers;


use Models\User;

use Exception;

class UserController extends BaseController
{
    public function registrationAction()
    {
        $this->view('registration');
    }

    public function indexAction()
    {
        $this->view('user');
    }

    public function createAction()
    {
        try {
            $password = $this->getPost('password');
            $name = $this->getPost('name');
            $surname = $this->getPost('surname');
            $email = $this->getPost('email');
            $files = $this->getUploadedFiles();
            $user = new User;
            if (!isset($password) || !isset($name) || !isset($surname) || !isset($email)) {
                throw new Exception('Invalid data ' . $password, 400);
            }
            if (strlen($password) < 8) {
                throw new Exception('Password cant be shorter than 8 symbols!', 400);
            }
            if (strlen($name) == 0) {
                throw new Exception('Invalid name' . $name, 400);
            }
            if (strlen($surname) == 0) {
                throw new Exception('Invalid surname' . $surname, 400);
            }
            $pattern = '/(\w+)@\w+\.\w+/';
            if (!preg_match($pattern, $email)) {
                throw new Exception('Invalid email ' . $email, 400);
            }
            if (count($files) > 1 || !isset($files['image'])) {
                throw new Exception('Invalid image', 400);
            }
            $image = file_get_contents($files['image']['tmp_name']);
            $user->name = $name;
            $user->surname = $surname;
            $password = password_hash($password, PASSWORD_DEFAULT);
            $user->email = $email;
            $user->password = $password;
            $user->image = $image;
            $result = $user->save();
            if ($result == 0) {
                throw new Exception('User with your data already exist', 400);
            }
            $this->sendResponse(200, 'OK', $result);
        } catch (Exception $e) {
            $this->sendResponse($e->getCode(), $e->getMessage());
        }
    }

    public function authAction()
    {
        try {
            $email = $this->getPost('email');
            $password = $this->getPost('password');
            if (strlen($email) == 0 || strlen($password) == 0) {
                throw new Exception('Invalid login/password combination', 400);
            }
            $user = User::confirm($email, $password);
            if (!$user) {
                throw new Exception('Invalid login/password combination', 400);
            }
            $response = [
                'id' => $user->getId(),
                'email' => $user->email,
                'name' => $user->name,
                'surname' => $user->surname,
                'image' => $user->image
            ];
            $this->sendResponse(200, 'OK', $response);
        } catch (Exception $e) {
            $this->sendResponse($e->getCode(), $e->getMessage());
        }
    }
}