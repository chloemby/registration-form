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
            $image = $this->getUploadedFiles('image');
            $user = new User;
            if (!isset($password) || !isset($name) || !isset($surname) || !isset($email)) {
                throw new Exception('Некорректные данные', 400);
            }
            if (strlen($password) < 8) {
                throw new Exception('Пароль не может быть короче 8 символов!', 401);
            }
            if (strlen($name) == 0) {
                throw new Exception('Некорректное имя ' . $name, 402);
            }
            if (strlen($surname) == 0) {
                throw new Exception('Некорректная фамилия ' . $surname, 403);
            }
            $pattern = '/(\w+)@\w+\.\w+/';
            if (!preg_match($pattern, $email)) {
                throw new Exception('Некорректный email: ' . $email, 404);
            }
            if ($image != null) {
                chdir('images');
                if (!move_uploaded_file($image['tmp_name'], $image['name'])) {
                    throw new Exception('Файл не может быть загружен!', 405);
                }
                $image = 'images/' . $image['name'];
            }
            $user->name = $name;
            $user->surname = $surname;
            $password = password_hash($password, PASSWORD_DEFAULT);
            $user->email = $email;
            $user->password = $password;
            $user->image = $image;
            $id = $user->save();
            if (!$id) {
                throw new Exception('Пользователь с такими данными уже существует', 406);
            }
            $result = [
                'id' => $id,
                'email' => $user->email,
                'name' => $user->name,
                'surname' => $user->surname,
                'image' => $user->image
            ];
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
                throw new Exception('Логин/пароль не может быть пустым', 400);
            }
            $user = User::confirm($email, $password);
            if (!$user) {
                throw new Exception('Неверная комбинация логин/пароль', 407);
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