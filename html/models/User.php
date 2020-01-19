<?php


namespace Models;

class User extends Model
{
    private $allowedRows = ['password', 'email', 'name', 'surname', 'image', 'cookie'];
    private $tableName = 'users';
    public $name = '';
    public $surname = '';
    public $email = '';
    public $password = '';
    public $image = null;
    private $cookie = '';
    private $id = null;

}