<?php

namespace App\UserModel;

require_once __DIR__ . '/../Config/Database.php';

use App\Controller\UserController as UserController;
use App\Database\Database;

class UserModel
{
    public UserController $controller;
    public Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }
    public function isCorrect($email, $password)
    {
        $conf = $this->database->getDatabase();
        foreach ($conf as $key => $value) {
            if ($key === $email) {
                foreach ($value as $sub_key => $sub_val) {
                    if ($sub_key === 'password') {
                        return password_verify(123456, '$sub_val');
                    }
                }
            }
        }
        return null;
    }
}
